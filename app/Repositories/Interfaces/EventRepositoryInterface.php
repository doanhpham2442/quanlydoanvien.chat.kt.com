<?php

namespace App\Repositories\Interfaces;

/**
 * Interface PostCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface EventRepositoryInterface extends BaseRepositoryInterface
{
   public function count(array $condition, string $keyword, string $query);
   public function paginate(array $condition, string $keyword, string $query ,array $config, int $page);
   public function countEventUser(array $condition, string $keyword, array $query);
   public function paginateEventUser(array $condition, string $keyword, array $query ,array $config, int $page);
}
