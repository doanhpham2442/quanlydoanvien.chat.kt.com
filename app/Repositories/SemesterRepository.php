<?php

namespace App\Repositories;
use App\Repositories\Interfaces\SemesterRepositoryInterface;

class SemesterRepository extends BaseRepository implements SemesterRepositoryInterface
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
            tb1.id,
            tb1.title,
            tb1.parentid,
            tb1.lft,
            tb1.rgt,
            tb1.level,
            tb1.day_start,
            tb1.day_end,
            tb1.publish,
         ',
         'table' => $this->table.' as tb1',
         'where' => [
            $field => $value,
            'tb1.deleted_at' => 0,
            'tb1.publish' => 1
         ]
      ]);
   }
   public function getAll(){
      return $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.title,
            tb1.parentid,
            tb1.lft,
            tb1.rgt,
            tb1.level,
            tb1.day_start,
            tb1.day_end,
            tb1.publish,
         ',
         'table' => $this->table.' as tb1',
         'where' => [
            'tb1.publish' => 1,
            'tb1.deleted_at' => 0
         ]
      ],TRUE);
   }

   public function count(array $condition,  string $keyword){
    // dd($condition);
      return $this->model->_get_where([
         'select' => 'tb1.id',
         'table' => $this->table.' as tb1',
         'where' => $condition,
         'join' => [
            // ['article_catalogue_translate as tb2','tb1.id = tb2.article_catalogue_id','inner']
         ],
         'keyword' => $keyword,
         'count' => TRUE
      ]);
   }

   public function paginate(array $condition, string $keyword, array $config, int $page){
      return  $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.title,
            tb1.lft,
            tb1.rgt,
            tb1.level,
            tb1.day_start,
            tb1.day_end,
            tb1.publish,
            (SELECT fullname FROM users WHERE users.id = tb1.userid_created) as creator,
            tb1.userid_updated,
            tb1.publish,
            tb1.created_at,
            tb1.updated_at
         ',
         'table' => $this->table.' as tb1',
         'where' => $condition,
         'keyword' => $keyword,
         'join' => [
            // ['article_catalogue_translate as tb2','tb1.id = tb2.article_catalogue_id','inner']
         ],
         'limit' => $config['per_page'],
         'start' => $page * $config['per_page'],
         'order_by'=> 'lft asc'
      ], TRUE);
   }

   // public function search($keyword, $start, $language = 2){
   //    return  $this->model->_get_where([
   //       'select' => '
   //          tb1.id,
   //          tb2.title,
   //          tb1.image,
   //          tb2.canonical,

   //       ',
   //       'table' => $this->table.' as tb1',
   //       'keyword' => '(tb2.title LIKE \'%'.$keyword.'%\')',
   //       'where' => [
   //          'tb1.deleted_at' => 0,
   //          'tb2.language_id' => $language
   //       ],
	// 		'join' => [
   //          [
   //             'article_catalogue_translate as tb2', 'tb1.id = tb2.article_catalogue_id', 'inner'
   //          ],
	// 		],
   //       'limit' => 15,
   //       'start' => $start,
   //       'group_by' => 'tb1.id',
   //       'order_by'=> 'tb1.id desc'
   //    ], TRUE);

   // }

   // public function findByIdArray(array $catalogue_id){
   //    return   $this->model->_get_where([
   //       'select' => '
   //          tb1.id,
   //          tb1.lft,
   //          tb1.rgt,
   //          tb1.image,
   //          tb2.canonical,
   //          tb2.title
   //       ',
   //       'table' => $this->table.' as tb1',
   //       'where' => [
   //          'tb1.deleted_at' => 0,
   //       ],
   //       'join' => [
   //          [
   //             'article_catalogue_translate as tb2', 'tb1.id = tb2.article_catalogue_id', 'inner'
   //          ],
   //       ],
   //       'where_in' => $catalogue_id,
   //       'where_in_field' => 'tb1.id',
   //       'order_by'=> 'id desc',
   //    ], TRUE);
   // }
   public function getAllCatalogueLv1(string $table)
   {
      return $this->model->_get_where([
         'select' => '
            id,
            title,
         ',
         'table' => $table,
         'where' => [
            'publish' => 1,
            'deleted_at' => 0,
            'level' => 1
         ]
      ],TRUE);
   }

}
