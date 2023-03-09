<?php

namespace App\Services;
use App\Libraries\Authentication as Auth;


class BranchService
{

   protected $module;
   protected $language;
   protected $db;
   protected $request;
   protected $model;
	protected $nestedsetbie;
   protected $pagination;
   protected $branchRepository;
   protected $facultyRepository;

   public function __construct($param){
      $this->module = $param['module'];
      $this->language = $param['language'];
      $this->db = \Config\Database::connect();
      $this->request = \Config\Services::request();
      $this->pagination = service('Pagination');
      $this->nestedsetbie = service('Nestedsetbie',
         ['table' => 'faculties', 'language' => $this->language, 'foreignkey' => 'faculty_id']
      );
      $this->branchRepository = service('BranchRepository', $this->module);
      $this->facultyRepository = service('FacultyRepository', 'faculties');
      $this->routerRepository = service('routerRepository', 'routers');
   }




   public function paginate($page){
      helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
      $keyword = $this->keyword();
      $condition = $this->condition();

      $catalogue = [];
      $query = '';
      if($this->request->getGet('faculty_id')){
         $facultyID = $this->request->getGet('faculty_id');
         $catalogue = $this->facultyRepository->findByField($facultyID, 'tb1.id');
         $catalogue = ($catalogue) ?? [];
         $query = $this->query($catalogue);
      }
      $config['total_rows'] = $this->branchRepository->count($condition, $keyword, $query);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.organziration.branch.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$branch = $this->branchRepository->paginate($condition, $keyword, $query, $config, $page);
         // dd($branch);
		}
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($branch) ?? [],
      ];
   }

   public function create(){
      $this->db->transBegin();
      try{
         $payload = requestAccept(['faculty_id', 'title','image','description','publish'], Auth::id());
         $id = $this->branchRepository->create($payload);
         
         $this->db->transCommit();
         $this->db->transComplete();
         return true;

      }catch(\Exception $e ){
         $this->db->transRollback();
         $this->db->transComplete();
         echo $e->getMessage();die();
         return false;
      }
   }

   public function update($id){
      $this->db->transBegin();
      try{
         $payload = requestAcceptUpdate(['faculty_id', 'title','image','description','publish'], Auth::id());
         $flag = $this->branchRepository->update($payload, $id);
         
         $this->db->transCommit();
         $this->db->transComplete();
         return true;

      }catch(\Exception $e ){
         $this->db->transRollback();
         $this->db->transComplete();
         dd($e);
         return false;
      }
   }

   public function delete($id){
      $id = (int)$id;
      try{
         $this->branchRepository->softDelete($id);

         $this->db->transCommit();
         $this->db->transComplete();
         return true;

      }catch(\Exception $e ){
         $this->db->transRollback();
         $this->db->transComplete();
         dd($e);
         return false;
      }

   }

   private function query(array $catalogue): string{
      $extraQuery = '';
      if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
         $extraQuery = 'tb1.faculty_id = '.$catalogue['id'];
      }
      return $extraQuery;
   }

   private function relation($id){
      $catalogue = ($this->request->getPost('catalogue')) ?? [];
      $catalogueid = $this->request->getPost('faculty_id');
      array_push($catalogue, $catalogueid);
      $newCatalogue = array_unique($catalogue);
      $relation = [];
      foreach($newCatalogue as $key => $val){
         $relation[] = [
            'article_id' => $id,
            'faculty_id' => $val,
         ];
      }
      return $relation;
   }


   private function condition(){
      $condition = [];
      if($this->request->getGet('publish')){
         $condition['tb1.publish'] = $this->request->getGet('publish');
      }
      $condition['tb1.deleted_at'] = 0;
      // $condition['tb2.language_id'] = $this->language;

      return $condition;
   }

   private function keyword(): string{
      $search = '';
      if(!empty($this->request->getGet('keyword'))){
         $fieldSearch = ['title','description'];

         $keyword = $this->request->getGet('keyword');
         if(isset($fieldSearch) && is_array($fieldSearch) && count($fieldSearch)){
            foreach($fieldSearch as $key => $val){
               if(empty($search)){
                  $search = '(tb1.'.$val.' LIKE \'%'.$keyword.'%\')';
               }else{
                  $search = $search.' OR '.'(tb1.'.$val.' LIKE \'%'.$keyword.'%\')';
               }

            }
         }
      }
      return $search;
   }

   public function index($articleCatalogue, $page){
      helper(['mypagination']);
      $page = (int)$page;
      $perpage = 12;
      $config['total_rows'] = $this->articleRepository->countIndex($articleCatalogue);
      $config['base_url'] = write_url($articleCatalogue['canonical'], FALSE, TRUE);
      if($config['total_rows'] > 0){
         $config = pagination_frontend(['url' => $config['base_url'],'perpage' => $perpage], $config, $page);
         $this->pagination->initialize($config);
         $pagination = $this->pagination->create_links();
         $totalPage = ceil($config['total_rows']/$config['per_page']);
         $page = ($page <= 0)?1:$page;
         $page = ($page > $totalPage)?$totalPage:$page;
         if($page >= 2){
             $canonical = $config['base_url'].'/trang-'.$page.HTSUFFIX;
         }
         $page = $page - 1;
         $product = $this->articleRepository->paginateIndex($articleCatalogue, $config, $page);
      }
      if(!isset($canonical) || empty($canonical)){
          $canonical = $config['base_url'].HTSUFFIX;
      }
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($product) ?? [],
         'canonical' => $canonical,
      ];
   }


}
