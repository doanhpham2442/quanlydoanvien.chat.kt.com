<?php

namespace App\Repositories;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
   protected $table;
   protected $model;

   public function __construct($table){
      $this->table = $table;
      $this->model = model('App\Models\AutoloadModel');
   }

   public function findByField($value, string $field){
      return $this->model->_get_where([
         'select' => '
            tb1.*,
         ',
         'table' => $this->table.' as tb1',
         'where' => [
            $field => $value,
            'tb1.deleted_at' => 0
         ]
      ]);
   }
   public function getAccount($value, string $field){
      return $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.image,
            tb1.fullname,
            tb1.*,
            tb2.title as name_cat,
         ',
         'table' => $this->table.' as tb1',
         'join' => [
            ['user_catalogues as tb2','tb1.user_catalogue_id = tb2.id','inner'],
         ],
         'where' => [
            $field => $value,
            'tb1.deleted_at' => 0
         ]
      ]);
   }

   public function count(array $condition,  string $keyword, array $query){
      return $this->model->_get_where([
         'select' => 'tb1.id',
         'table' => $this->table.' as tb1',
         'where' => $condition,
         'query' => $query,
         'keyword' => $keyword,
         'count' => TRUE
      ]);
   }

   public function paginate(array $condition, string $keyword, array $query, array $config, int $page){
      return  $this->model->_get_where([
         'select' => '
            tb1.*,
            tb2.title as name_faculty,
            tb3.title as name_class,
            tb4.title as name_cat,
            tb5.name as name_city,
            tb6.name as name_district,
            tb7.name as name_ward,
            tb8.name as name_ethnic,
            tb9.name as name_religion,
         ',
         'table' => $this->table.' as tb1',
         'where' => $condition,
         'query' => $query,
         'keyword' => $keyword,
         'join' => [
            ['faculties as tb2','tb1.faculty_id = tb2.id','inner'],
            ['classes as tb3','tb1.class_id = tb3.id','inner'],
            ['user_catalogues as tb4','tb1.user_catalogue_id = tb4.id','inner'],
            ['vn_province as tb5','tb1.countryside_cityid = tb5.provinceid','left'],
            ['vn_district as tb6','tb1.countryside_districtid = tb6.districtid','left'],
            ['vn_ward as tb7','tb1.countryside_wardid = tb7.wardid','left'],
            ['vn_ethnic as tb8','tb1.ethnic = tb8.id','left'],
            ['vn_religion as tb9','tb1.religion = tb9.id','left'],
         ],
         'limit' => $config['per_page'],
         'start' => $page * $config['per_page'],
         'order_by'=> 'id asc'
      ], TRUE);
   }
   public function exportAll(array $condition, string $keyword, array $query){
      return  $this->model->_get_where([
         'select' => '
            tb1.*,
            tb2.title as name_faculty,
            tb3.title as name_class,
            tb4.title as name_cat,
            tb5.name as name_city,
            tb6.name as name_district,
            tb7.name as name_ward,
            tb8.name as name_ethnic,
            tb9.name as name_religion,
         ',
         'table' => $this->table.' as tb1',
         'where' => $condition,
         'query' => $query,
         'keyword' => $keyword,
         'join' => [
            ['faculties as tb2','tb1.faculty_id = tb2.id','inner'],
            ['classes as tb3','tb1.class_id = tb3.id','inner'],
            ['user_catalogues as tb4','tb1.user_catalogue_id = tb4.id','inner'],
            ['vn_province as tb5','tb1.countryside_cityid = tb5.provinceid','left'],
            ['vn_district as tb6','tb1.countryside_districtid = tb6.districtid','left'],
            ['vn_ward as tb7','tb1.countryside_wardid = tb7.wardid','left'],
            ['vn_ethnic as tb8','tb1.ethnic = tb8.id','left'],
            ['vn_religion as tb9','tb1.religion = tb9.id','left'],
         ],
         'order_by'=> 'id asc'
      ], TRUE);
   }
   public function exportSelect(array $id){
      return  $this->model->_get_where([
         'select' => '
            tb1.*,
            tb2.title as name_faculty,
            tb3.title as name_class,
            tb4.title as name_cat,
            tb5.name as name_city,
            tb6.name as name_district,
            tb7.name as name_ward,
            tb8.name as name_ethnic,
            tb9.name as name_religion,
         ',
         'table' => $this->table.' as tb1',
         'join' => [
            ['faculties as tb2','tb1.faculty_id = tb2.id','inner'],
            ['classes as tb3','tb1.class_id = tb3.id','inner'],
            ['user_catalogues as tb4','tb1.user_catalogue_id = tb4.id','inner'],
            ['vn_province as tb5','tb1.countryside_cityid = tb5.provinceid','left'],
            ['vn_district as tb6','tb1.countryside_districtid = tb6.districtid','left'],
            ['vn_ward as tb7','tb1.countryside_wardid = tb7.wardid','left'],
            ['vn_ethnic as tb8','tb1.ethnic = tb8.id','left'],
            ['vn_religion as tb9','tb1.religion = tb9.id','left'],
         ],
         'where_in' => $id,
         'where_in_field' => 'tb1.id',
         'group_by' => 'tb1.id'
      ], TRUE);
   }

   public function softDeleteUserByCatalogueID(int $catID){
      return $this->model->_update([
         'table' => $this->table,
         'where' => [
            'user_catalogue_id' => $catID
         ],
         'data' => [
            'deleted_at' => 1,
         ]
      ]);
   }
   public function getSynthesis($table){
      return $this->model->_get_where([
         'select' => '
            id,name
         ',
         'table' => $table,
         'order_by'=> 'id asc'
      ],TRUE);
   }
   public function getProvince($table){
      return $this->model->_get_where([
         'select' => '
         provinceid,name
         ',
         'table' => $table,
         'order_by'=> 'provinceid asc'
      ],TRUE);
   }
   public function getUserCompare($faculty = '',$class =''){
      return $this->model->_get_where([
         'select' => '
            tb1.id_student
         ',
         'table' => $this->table.' as tb1',
         // 'where' => [
         //    'faculty_id' => $faculty,
         //    'class_id' => $class,
         // ],
      ],TRUE);
   }

   public function getDashboard( $value, string $field){
      return $this->model->_get_where([
         'select' => '
            COUNT(DISTINCT tb1.id) as count_faculty,
            COUNT(DISTINCT tb2.id) as count_class,
            COUNT(DISTINCT tb3.id) as count_user,
            tb1.id,
            tb1.title,
         ',
         'table' => 'faculties as tb1',
         'join' => [
            ['classes as tb2','tb1.id = tb2.faculty_id','left'],
            ['users as tb3','tb1.id = tb3.faculty_id','left']
         ],
         'where' => [
            $field => $value,
            'tb1.deleted_at' => 0,
            'tb1.publish' => 1,
         ],
      ]);
   }
   public function getDashboardFaculty(){
      return $this->model->_get_where([
         'select' => '
             tb1.id,
             tb1.short_title,
             COUNT(DISTINCT tb3.id) AS count_user,
             COUNT(DISTINCT tb2.id) AS count_class,
             SUM(CASE WHEN tb3.gender = 2 THEN 1 ELSE 0 END) AS count_user_man,
             SUM(CASE WHEN tb3.gender = 1 THEN 1 ELSE 0 END) AS count_user_girl,
         ',
         'table' => 'faculties AS tb1',
         'join' => [
             ['classes AS tb2', 'tb1.id = tb2.faculty_id', 'left'],
             ['users AS tb3', 'tb2.id = tb3.class_id', 'left']
         ],
         'where' => [
             'tb1.deleted_at' => 0,
             'tb1.publish' => 1
         ],
         'group_by' => 'tb1.id'
     ], TRUE);
     
   }
   public function getDashboardClass($value, string $field){
      return $this->model->_get_where([
         'select' => '
             tb1.id,
             tb1.short_title,
             COUNT(DISTINCT tb3.id) AS count_user,
             COUNT(DISTINCT tb2.id) AS count_class,
             SUM(CASE WHEN tb3.gender = 2 THEN 1 ELSE 0 END) AS count_user_man,
             SUM(CASE WHEN tb3.gender = 1 THEN 1 ELSE 0 END) AS count_user_girl,
             GROUP_CONCAT(DISTINCT tb2.title) as name_class,
             tb2.id as class_id
         ',
         'table' => 'faculties AS tb1',
         'join' => [
             ['classes AS tb2', 'tb1.id = tb2.faculty_id', 'left'],
             ['users AS tb3', 'tb2.id = tb3.class_id', 'left']
         ],
         'where' => [
               $field => $value,
             'tb1.deleted_at' => 0,
             'tb1.publish' => 1
         ],
         'group_by' => 'tb1.id ,tb2.id'
     ], TRUE);
   }
   public function getDashboardEvent(){
      return $this->model->_get_where([
         'select' => '
             tb1.id,
             tb1.title as title_semester,
             tb2.title as title_event,
             COUNT(DISTINCT tb2.id) AS count_event,
             COUNT(DISTINCT tb3.id) AS count_checkevent,
             SUM(CASE WHEN tb3.publish = 2 THEN 1 ELSE 0 END) AS count_checkevent_succsess,             
         ',
         'table' => 'semesters AS tb1',
         'join' => [
             ['events AS tb2', 'tb1.id = tb2.semester_id', 'left'],
             ['event_user AS tb3', 'tb2.id = tb3.event_id', 'left']
         ],
         'where' => [
             'tb1.deleted_at' => 0,
             'tb1.publish' => 1,
             'tb1.level' => 2,
            //  'tb3.deleted_at' => 0,
             
         ],
         'group_by' => 'tb1.id',
         // 'limit' => 2,
     ], TRUE);
     
   }

  



}
