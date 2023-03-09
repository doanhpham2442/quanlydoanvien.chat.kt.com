<?php

namespace App\Services;
use App\Libraries\Authentication as Auth;


class EventService
{

   protected $module;
   protected $language;
   protected $db;
   protected $request;
   protected $model;
	protected $nestedsetbie;
   protected $pagination;
   protected $eventRepository;
   protected $semesterRepository;

   public function __construct($param){
      $this->module = $param['module'];
      $this->language = $param['language'];
      $this->db = \Config\Database::connect();
      $this->request = \Config\Services::request();
      $this->pagination = service('Pagination');
      $this->nestedsetbie = service('Nestedsetbie',
         ['table' => 'semesters', 'language' => $this->language, 'foreignkey' => 'semester_id']
      );
      $this->eventRepository = service('EventRepository', $this->module);
      $this->semesterRepository = service('SemesterRepository', 'semesters');
      $this->userRepository = service('UserRepository', 'users');
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

      if($this->request->getGet('semester_id')){
         $semesterID = $this->request->getGet('semester_id');
         $catalogue = $this->semesterRepository->findByField($semesterID, 'tb1.id');
         $catalogue = ($catalogue) ?? [];
         $query = $this->query($catalogue);
      }
      $config['total_rows'] = $this->eventRepository->count($condition, $keyword, $query);

      
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.event.event.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$eventCatalogue = $this->eventRepository->paginate($condition, $keyword, $query, $config, $page);
		}
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($eventCatalogue) ?? [],
      ];
   }

   public function create(){
      $this->db->transBegin();
      try{
         $payload = requestAccept(['canonical','semester_id','title', 'description', 'content', 'score', 'day_start', 'day_end', 'scales', 'catalogue','image','album','publish','scales'], Auth::id());
         // dd($payload);
         $id = $this->eventRepository->create($payload);
         if($id > 0){
            $payloadRouters = router('Event','Event', $id, $this->module, $this->language, $payload['canonical']);
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
         $payload = requestAcceptUpdate(['semester_id','title', 'description', 'content', 'score', 'day_start', 'day_end', 'scales', 'catalogue','image','album','publish','canonical','scales'], Auth::id());
         $flag = $this->eventRepository->update($payload, $id);
         if($flag > 0){
            $this->routerRepository->deleteRouter($id, $this->module);
            $payloadRouters = router('Event','Event', $id, $this->module, $this->language, $payload['canonical']);
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
      try{
         $this->eventRepository->softDelete($id);
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

   private function query(array $catalogue): string{
      $extraQuery = '';
      if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
         $extraQuery = 'tb1.semester_id IN (SELECT id FROM semesters WHERE lft >= '.$catalogue['lft'].' AND rgt <= '.$catalogue['rgt'].')';
         // $extraQuery = 'tb1.semester_id = '.$catalogue['id'];
      }
      return $extraQuery;
   }

   private function relation($id){
      $catalogue = ($this->request->getPost('catalogue')) ?? [];
      $catalogueid = $this->request->getPost('semester_id');
      array_push($catalogue, $catalogueid);
      $newCatalogue = array_unique($catalogue);
      $relation = [];
      foreach($newCatalogue as $key => $val){
         $relation[] = [
            'event_id' => $id,
            'semester_id' => $val,
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

   public function index($eventCatalogue, $page){
      helper(['mypagination']);
      $page = (int)$page;
      $perpage = 1;
      $config['total_rows'] = $this->eventRepository->countIndex($eventCatalogue);
      // $config['base_url'] = write_url($eventCatalogue['canonical'], FALSE, TRUE);
      $config['base_url'] = write_url('chuong-trinh-su-kien', FALSE, TRUE);
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
         $product = $this->eventRepository->paginateIndex($eventCatalogue, $config, $page);
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
   public function indexAll($eventCatalogue, $page){
      helper(['mypagination']);
      $page = (int)$page;
      $perpage = 20;
      $config['total_rows'] = $this->eventRepository->countIndexAll($eventCatalogue);
      $config['base_url'] = write_url('chuong-trinh-su-kien', FALSE, TRUE);
      if($config['total_rows'] > 0){
         $config = pagination_frontend(['url' => $config['base_url'],'perpage' => $perpage], $config, $page);
         $this->pagination->initialize($config);
         $pagination = $this->pagination->create_links();
         $totalPage = ceil($config['total_rows']/$config['per_page']);
         $page = ($page <= 0)?1:$page;
         $page = ($page > $totalPage)?$totalPage:$page;
         if($page >= 20){
             $canonical = $config['base_url'].'/trang-'.$page.HTSUFFIX;
         }
         $page = $page - 1;
         $product = $this->eventRepository->paginateIndexAll($eventCatalogue, $config, $page);
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
   public function createEventUser(){
      $this->db->transBegin();
      try{
         $payload = requestAcceptTime(['image','note','event_id'], Auth::id());
         $payload['publish'] = 1;
         $payload['user_id'] = Auth::id();
         // dd($payload);
         $id = $this->eventRepository->createEventUser($payload);
         
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
   public function updateEventUser($id){
      $this->db->transBegin();
      try{
         $payload = requestAcceptTime(['image','note']);
         $payload['publish'] = 1;
         // dd($payload);
         $id = $this->eventRepository->updateEventUser($payload,$id);
         
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
  
   public function paginateEventUser($id, $page){
      helper(['mypagination']);
		$page = (int)$page;
		$id = (int)$id;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
      $keyword = $this->keyword();
      $condition = $this->condition();
      
      $catalogue = [];
      $query = [];
      $query = $this->queryPermission($id);

      $config['total_rows'] = $this->eventRepository->countEventUser($condition, $keyword, $query);
      // dd(123);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.event.event.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$eventCatalogue = $this->eventRepository->paginateEventUser($condition, $keyword, $query, $config, $page);
		}
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($eventCatalogue) ?? [],
      ];
   }
   public function paginateUserSemester($id, $page){
      helper(['mypagination']);
		$page = (int)$page;
		$id = (int)$id;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
      $keyword = $this->keyword();
      $condition = $this->condition();
      $condition['tb1.publish'] = '2';
      $condition['tb2.semester_id'] = $this->request->getGet('semester_2_id');
      if($this->request->getGet('faculty_id')){
         $condition['tb3.faculty_id'] = $this->request->getGet('faculty_id');
      }
      if($this->request->getGet('class_id')){
         $condition['tb3.class_id'] = $this->request->getGet('class_id');
      }
      // dd($condition);
      $catalogue = [];
      $query = [];
      $query = $this->queryPermission(0);
      $config['total_rows'] = $this->eventRepository->countUserSemester($condition, $keyword, $query);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.event.event.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$eventCatalogue = $this->eventRepository->paginateUserSemester($condition, $keyword, $query, $config, $page);
		}
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($eventCatalogue) ?? [],
      ];
   }
   public function excelAll(){
      helper(['mypagination']);
      $keyword = $this->keyword();
      $condition = $this->condition();
      $condition['tb1.publish'] = '2';
      $condition['tb2.semester_id'] = $this->request->getGet('semester_2_id');
      if($this->request->getGet('faculty_id')){
         $condition['tb3.faculty_id'] = $this->request->getGet('faculty_id');
      }
      if($this->request->getGet('class_id')){
         $condition['tb3.class_id'] = $this->request->getGet('class_id');
      }
      // dd($condition);
      $catalogue = [];
      $query = [];
      $query = $this->queryPermission(0);

		$eventCatalogue = $this->eventRepository->exportAll($condition, $keyword, $query);
		
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($eventCatalogue) ?? [],
      ];
   }
   private function queryPermission($id){
      $extraQuery = [];
      if(isset($_COOKIE['QLDVKT_backend'])){
         $user_cat_id = json_decode($_COOKIE['QLDVKT_backend'], true)['user_catalogue_id'];
         $class_id = json_decode($_COOKIE['QLDVKT_backend'], true)['class_id'];
         $faculty_id = json_decode($_COOKIE['QLDVKT_backend'], true)['faculty_id'];

         if($user_cat_id == 8){
            $extraQuery['tb3.faculty_id '] = $faculty_id;
         }
         if($user_cat_id == 9){
            $extraQuery['tb3.class_id '] = $class_id;
         }
      }
      if($id > 0){
         $extraQuery['tb1.event_id '] = $id;
      }
      // dd($extraQuery);
      return $extraQuery;
   }


}
