<?php

namespace App\Services;
use App\Libraries\Authentication as Auth;



class UserService
{

   protected $module;
   protected $language;
   protected $db;
   protected $request;
   protected $pagination;
   protected $userRepository;

   public function __construct($param){
      $this->module = $param['module'];

      $this->language = $param['language'];
      $this->db = \Config\Database::connect();
      $this->request = \Config\Services::request();
      $this->pagination = service('Pagination');
      $this->userRepository = service('UserRepository', $this->module);
      $this->userCatalogueRepository = service('UserCatalogueRepository', 'user_catalogues');
   }


   public function paginate($page){
      helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
      $keyword = $this->keyword();
      $condition = $this->condition();
      $catalogue = [];
      $gender = '';
      $union_position = '';
      $query = [];
      $query = $this->queryPermission();

      $config['total_rows'] = $this->userRepository->count($condition, $keyword, $query);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => route('backend.user.user.index'),'perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$pagination = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$user = $this->userRepository->paginate($condition, $keyword, $query, $config, $page);
		}
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($user) ?? [],
      ];
   }
   public function excelAll(){
      helper(['mypagination']);
      $keyword = $this->keyword();
      $condition = $this->condition();
      $catalogue = [];
      $gender = '';
      $union_position = '';
      $query = [];
      $query = $this->queryPermission();

      $user = $this->userRepository->exportAll($condition, $keyword, $query);
		
      return [
         'pagination' => ($pagination) ?? '',
         'list' => ($user) ?? [],
      ];
   }
   
   public function create(){
      $this->db->transBegin();
      $field = [
         'id_student',
         'user_catalogue_id',
         'email',
         'class_id',
         'faculty_id',
         'fullname',
         'birthday',
         'gender',
         'ethnic',
         'religion',
         'id_card',
         'date_id_card',
         'issued_id_card',
         'profession',
         'level_education',
         'level_specialize',
         'level_politics',
         'level_computer',
         'level_language',
         'day_in_union',
         'number_resolution',
         'number_union',
         'book_union',
         'day_in_communist_party',
         'phone',
         'image',
         'union_position',
         'association_position',
         'residence_address',
         'residence_cityid',
         'residence_districtid',
         'residence_wardid',
         'countryside_address',
         'countryside_cityid',
         'countryside_districtid',
         'countryside_wardid',
      ];
      try{
         $payload = requestAccept($field, Auth::id());
         $payload['publish'] = 1;
         $password = $this->renderPassword($this->request->getPost('password'));
         $payload['salt'] = $password['salt'];
         $payload['password'] = $password['password'];
         // dd($payload);
         $id = $this->userRepository->create($payload);
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
   public function createExcel($data = []){
      $this->db->transBegin();
      try{
         $id = $this->userRepository->createBatch($data,'users');
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
      $field = [
         'id_student',
         'user_catalogue_id',
         'email',
         'class_id',
         'faculty_id',
         'fullname',
         'birthday',
         'gender',
         'ethnic',
         'religion',
         'id_card',
         'date_id_card',
         'issued_id_card',
         'profession',
         'level_education',
         'level_specialize',
         'level_politics',
         'level_computer',
         'level_language',
         'day_in_union',
         'number_resolution',
         'number_union',
         'book_union',
         'day_in_communist_party',
         'phone',
         'image',
         'union_position',
         'association_position',
         'residence_address',
         'residence_cityid',
         'residence_districtid',
         'residence_wardid',
         'countryside_address',
         'countryside_cityid',
         'countryside_districtid',
         'countryside_wardid',
      ];
      $this->db->transBegin();
      try{
         $payload = requestAcceptUpdate($field, Auth::id());
         $flag = $this->userRepository->update($payload, $id);
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
         /* Xóa bản ghi - xóa user */
         $this->userRepository->softDelete($id);

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

   public function renderPassword($password_base = ''){
      helper('text');
      $salt = random_string('alnum', 168);
      ($password_base)? $password_base : PASSWORD;
   	$password = password_encode($password_base, $salt);
      return [
         'salt' => $salt,
         'password' => $password,
      ];
   }

   private function condition(){
      $condition = [];
      if($this->request->getGet('publish')){
         $condition['tb1.publish'] = $this->request->getGet('publish');
      }
      $condition['tb1.deleted_at'] = 0;
      if($this->request->getGet('gender')){
         $condition['tb1.gender'] = $this->request->getGet('gender');
      }
      if($this->request->getGet('union_position')){
         $condition['tb1.union_position'] = $this->request->getGet('union_position');
      }
      if($this->request->getGet('user_catalogue_id')){
         $condition['tb1.user_catalogue_id'] = $this->request->getGet('user_catalogue_id');
      }
      if($this->request->getGet('faculty_id')){
         $condition['tb1.faculty_id'] = $this->request->getGet('faculty_id');
      }
      if($this->request->getGet('class_id')){
         $condition['tb1.class_id'] = $this->request->getGet('class_id');
      }

      return $condition;
   }

   private function keyword(): string{
      $search = '';
      if(!empty($this->request->getGet('keyword'))){
         $fieldSearch = ['fullname', 'email', 'id_student','phone'];

         $keyword = $this->request->getGet('keyword');
         if(isset($fieldSearch) && is_array($fieldSearch) && count($fieldSearch)){
            foreach($fieldSearch as $key => $val){
               if(empty($search)){
                  $search = '('.$val.' LIKE \'%'.$keyword.'%\')';
               }else{
                  $search ='('.$search.' OR '.'('.$val.' LIKE \'%'.$keyword.'%\'))';
               }

            }
         }
      }
      return $search;
   }





   private function query(array $catalogue){
      $extraQuery = [];
      if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
         $extraQuery['tb1.user_catalogue_id'] = $catalogue['id'];
      }
      $condition['tb1.deleted_at'] = 0;
      // dd($extraQuery);
      return $extraQuery;
   }

   private function queryPermission(){
      $extraQuery = [];
      if(isset($_COOKIE['QLDVKT_backend'])){
         $user_cat_id = json_decode($_COOKIE['QLDVKT_backend'], true)['user_catalogue_id'];
         $class_id = json_decode($_COOKIE['QLDVKT_backend'], true)['class_id'];
         $faculty_id = json_decode($_COOKIE['QLDVKT_backend'], true)['faculty_id'];

         if($user_cat_id == 8){
            $extraQuery['tb1.faculty_id '] = $faculty_id;
         }
         if($user_cat_id == 9){
            $extraQuery['tb1.class_id '] = $class_id;
         }
      }
      // dd($extraQuery);
      return $extraQuery;
   }
   
   

   


}
