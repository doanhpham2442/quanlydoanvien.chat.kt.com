<?php

namespace App\Repositories\Interfaces;

/**
 * Interface PostCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
   public function count(array $condition, string $keyword ,array $query);
   public function paginate(array $condition, string $keyword, array $query, array $config, int $page);
   public function softDeleteUserByCatalogueID(int $catID);
}
