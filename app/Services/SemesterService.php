<?php

namespace App\Services;
use App\Libraries\Authentication as Auth;
use App\Libraries\Nestedsetbie;


class SemesterService
{

   protected $module;
   protected $language;
   protected $db;
   protected $request;
   protected $model;
	protected $nestedsetbie;
   protected $pagination;
   protected $semesterRepository;

   public function __construct($param){
      $this->module = $param['module'];
      $this->language = $param['language'];
      $this->db = \Config\Database::connect();
      $this->request = \Config\Services::request();
      $this->pagination = service('Pagination');
      $this->semesterRepository = service('SemesterRepository', $this->module);
      $this->routerRepository = service('routerRepository', 'routers');
      $this->nestedsetbie = service('Nestedsetbie',
         ['table' => $this->module]
      );
   }




   public function paginate($page){
      helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
      $keyword = $this->keyword();
      $condition = $this->condition();

      $config['total_rows'] = $this->semesterRepository->count($condition, $keyword);
      
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.organization.semester.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$semester = $this->semesterRepository->paginate($condition, $keyword, $config, $page);
		}

      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($semester) ?? '',
      ];
   }

   public function create(){
      $this->db->transBegin();
      try{
         $payload = requestAccept(['parentid','title','day_start','day_end','publish'], Auth::id());
         // dd($payload);
         $id = $this->semesterRepository->create($payload);
         $this->nestedsetbie();

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
         $payload = requestAcceptUpdate(['parentid','title','image','founding','description','publish'], Auth::id());
         $flag = $this->semesterRepository->update($payload, $id);
         $this->nestedsetbie();

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
      $this->db->transBegin();
      try{
         $flag = $this->semesterRepository->softDelete($id);
         
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
   public function nestedsetbie(){
      $this->nestedsetbie->GetNoLanguage('level ASC, order ASC');
      $this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
      $this->nestedsetbie->Action();
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
   public function index($semester, $page){
      // dd($semester);
      helper(['mypagination']);
      $page = (int)$page;
      $perpage = 10;
      $config['total_rows'] = $this->eventRepository->countIndex($semester);
      $config['base_url'] = write_url($semester['canonical'], FALSE, TRUE);
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
         $event = $this->eventRepository->paginateIndex($semester, $config, $page);
      }
      if(!isset($canonical) || empty($canonical)){
          $canonical = $config['base_url'].HTSUFFIX;
      }
      // dd($pagination);
      
      return [
         'catalogue_title' =>$semester['title'],
         'pagination' => ($pagination) ?? '',
         'list' => ($event) ?? [],
         'canonical' => $canonical,
      ];
   }

}
