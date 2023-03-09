<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BranchRepositoryInterface;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
   protected $table;
   protected $model;

   public function __construct($table){
      $this->table = $table;
      $this->model = model('App\Models\AutoloadModel');
   }
   public function getAll(string $column = '*', array $join = []){
      return $this->model->_get_where([
         'select' => $column,
         'table' => $this->table,
         'where' => [
            'deleted_at' => 0,
         ]
      ], TRUE);
   }
   public function findByField($value, string $field){
      return $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.faculty_id,
            tb1.title,
            tb1.image,
            tb1.publish,
            tb1.description,
         ',
         'table' => $this->table.' as tb1',
         'where' => [
            $field => $value,
            'tb1.deleted_at' => 0
         ]
      ]);
   }

   public function countIndex($articleCatalogue){
      return $this->model->_get_where([
         'select' => '
            tb1.id
         ',
			'table' => $this->table.' as tb1',
			'where' => [
            'tb1.publish' => 1,
            'tb1.deleted_at' => 0,
         ],
         'query' => '
            tb3.article_catalogue_id IN (
               SELECT pc.id
               FROM article_catalogues as pc
               WHERE pc.lft >= '.$articleCatalogue['lft'].' AND pc.rgt <= '.$articleCatalogue['rgt'].'
            )
         ',
			'join' => [
				[
					'article_catalogue_article as tb3', 'tb1.id = tb3.article_id', 'inner'
				],
			],
			'group_by' => 'tb1.id',
			'count' => TRUE,
      ]);
   }

   public function paginateIndex(array $articleCatalogue, array $config, int $page){
      return  $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.article_catalogue_id,
            tb1.catalogue,
            tb1.image,
            tb1.viewed,
            tb1.order,
            tb1.created_at,
            tb1.album,
            tb1.publish,
            tb2.title,
            tb2.canonical,
            tb2.description,
         ',
         'table' => $this->table.' as tb1',
         'where' => [
            'tb1.publish' => 1,
            'tb1.deleted_at' => 0,
         ],
         'query' => '
            tb3.article_catalogue_id IN (
               SELECT pc.id
               FROM article_catalogues as pc
               WHERE pc.lft >= '.$articleCatalogue['lft'].' AND pc.rgt <= '.$articleCatalogue['rgt'].'
            )
         ',
			'join' => [
            [
               'article_translate as tb2', 'tb1.id = tb2.article_id', 'inner'
            ],
				[
					'article_catalogue_article as tb3', 'tb1.id = tb3.article_id', 'inner'
				],
			],
         'limit' => $config['per_page'],
         'start' => $page * $config['per_page'],
         'group_by' => 'tb1.id',
         'order_by'=> 'tb1.id desc'
      ], TRUE);
   }

   public function count(array $condition,  string $keyword, string $query = ''){
      return $this->model->_get_where([
         'select' => 'tb1.id',
			'table' => $this->table.' as tb1',
			'keyword' => $keyword,
			'where' => $condition,
			'query' => $query,
			'group_by' => 'tb1.id',
			'count' => TRUE,
      ]);
   }

   public function paginate(array $condition, string $keyword,  string $query = '', array $config, int $page){
      return  $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.faculty_id,
            tb1.title,
            tb1.image,
            tb1.created_at,
            tb1.publish,
            (SELECT fullname FROM users WHERE users.id = tb1.userid_created) as creator,
            (
               SELECT title
               FROM faculties
               WHERE tb1.faculty_id = faculties.id
            ) as cat_title,
         ',
         'table' => $this->table.' as tb1',
         'keyword' => $keyword,
			'where' => $condition,
			'query' => $query,	
         'limit' => $config['per_page'],
         'start' => $page * $config['per_page'],
         'group_by' => 'tb1.id',
         'order_by'=> 'tb1.id desc'
      ], TRUE);
   }

   public function search($keyword, $start, $language = 2){
      return  $this->model->_get_where([
         'select' => '
            tb1.id,
            tb2.title,
            tb1.image,
            tb2.canonical,
            tb2.description,
            tb2.content,

         ',
         'table' => $this->table.' as tb1',
         'keyword' => '(tb2.title LIKE \'%'.$keyword.'%\')',
         'where' => [
            'tb1.deleted_at' => 0,
            'tb2.language_id' => $language
         ],
			'join' => [
            [
               'article_translate as tb2', 'tb1.id = tb2.article_id', 'inner'
            ],
			],
         'limit' => 15,
         'start' => $start,
         'group_by' => 'tb1.id',
         'order_by'=> 'tb1.id desc'
      ], TRUE);

   }

   public function findProductByIdArray($id){
      return  $this->model->_get_where([
         'select' => '
            tb1.id,
            tb2.title,
            tb1.image,
            tb2.canonical,
            tb2.description,
            tb2.content,
         ',
         'table' => $this->table.' as tb1',
			'where' => [
            'tb1.deleted_at' => 0,
         ],
         'where_in' => $id,
         'where_in_field' => 'tb1.id',
			'join' => [
            [
               'article_translate as tb2', 'tb1.id = tb2.article_id', 'inner'
            ],
				[
					'article_catalogue_article as tb3', 'tb1.id = tb3.article_id', 'inner'
				],
			],
         'group_by' => 'tb1.id',
      ], TRUE);
   }

   public function articleRelate($article_catalogue_id = 0, $limit){
      return $this->model->_get_where([
         'select' => '
            tb1.id,
            tb1.image,
            tb2.title,
            tb2.canonical,
            tb2.description,
         ',
         'table' => $this->table.' as tb1',
         'join' => [
            [
               'article_translate as tb2', 'tb1.id = tb2.article_id', 'inner'
            ],
			],
         'where' => [
            'tb1.article_catalogue_id' => $article_catalogue_id
         ],
         'limit' => $limit,
         'order_by' => 'RAND()'
      ], TRUE);
   }


}
