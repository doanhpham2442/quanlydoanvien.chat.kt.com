<?php

namespace App\Services;
use App\Libraries\Authentication as Auth;
use App\Libraries\Nestedsetbie;


class FacultyService
{

   protected $module;
   protected $language;
   protected $db;
   protected $request;
   protected $model;
	protected $nestedsetbie;
   protected $pagination;
   protected $facultyRepository;

   public function __construct($param){
      $this->module = $param['module'];
      $this->language = $param['language'];
      $this->db = \Config\Database::connect();
      $this->request = \Config\Services::request();
      $this->pagination = service('Pagination');
      $this->facultyRepository = service('FacultyRepository', $this->module);
      $this->routerRepository = service('routerRepository', 'routers');
   }




   public function paginate($page){
      helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
      $keyword = $this->keyword();
      $condition = $this->condition();

      $config['total_rows'] = $this->facultyRepository->count($condition, $keyword);
      
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.organization.faculty.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$faculty = $this->facultyRepository->paginate($condition, $keyword, $config, $page);
		}

      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($faculty) ?? '',
      ];
   }

   public function create(){
      $this->db->transBegin();
      try{
         $payload = requestAccept(['title','image','founding','description','content','canonical','publish','short_title'], Auth::id());
         $id = $this->facultyRepository->create($payload);
         if($id > 0){
            $payloadRouters = router('Faculty','Faculty', $id, $this->module, $this->language, $payload['canonical']);
            $routerID = $this->routerRepository->create($payloadRouters);
         }
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
         $payload = requestAcceptUpdate(['title','image','founding','description','content','canonical','publish','short_title'], Auth::id());
         $flag = $this->facultyRepository->update($payload, $id);
         if($flag > 0){
            $this->routerRepository->deleteRouter($id, $this->module);
            $payloadRouters = router('Faculty','Faculty', $id, $this->module, $this->language, $payload['canonical']);
            $routerID = $this->routerRepository->create($payloadRouters);
         }
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
         $flag = $this->facultyRepository->softDelete($id);
         $this->routerRepository->deleteRouter($id, $this->module);
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

}
