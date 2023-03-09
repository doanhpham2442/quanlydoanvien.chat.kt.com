<?php namespace Config;

use CodeIgniter\Config\Services as CoreServices;

require_once SYSTEMPATH . 'Config/Services.php';

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends CoreServices
{



   /* SERVICE LAYER */

   public static function SystemService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('SystemService', $param);
       }

       return new \App\Services\SystemService($param);
   }
   public static function SlideService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('SlideService', $param);
       }

       return new \App\Services\SlideService($param);
   }


   public static function LanguageService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('LanguageService', $param);
       }

       return new \App\Services\LanguageService($param);
   }

   public static function ArticleCatalogueService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('ArticleCatalogueService', $param);
       }

       return new \App\Services\ArticleCatalogueService($param);
   }

   public static function ArticleService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('ArticleService', $param);
       }

       return new \App\Services\ArticleService($param);
   }

   public static function UserCatalogueService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('UserCatalogueService', $param);
       }

       return new \App\Services\UserCatalogueService($param);
   }
   public static function UserService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('UserService', $param);
       }

       return new \App\Services\UserService($param);
   }
   public static function BranchService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('BranchService', $param);
       }

       return new \App\Services\BranchService($param);
   }
   public static function FacultyService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('FacultyService', $param);
       }

       return new \App\Services\FacultyService($param);
   }
   public static function SemesterService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('SemesterService', $param);
       }

       return new \App\Services\SemesterService($param);
   }
   public static function EventService($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('EventService', $param);
       }

       return new \App\Services\EventService($param);
   }


   /* REPOSITORY LAYER  */

   public static function SystemRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('SystemRepository', $table);
       }

       return new \App\Repositories\SystemRepository($table);
   }
   public static function SlideRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('SlideRepository', $table);
       }

       return new \App\Repositories\SlideRepository($table);
   }

   public static function LanguageRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('LanguageRepository', $table);
       }

       return new \App\Repositories\LanguageRepository($table);
   }
   public static function ArticleCatalogueRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('ArticleCatalogueRepository', $table);
       }

       return new \App\Repositories\ArticleCatalogueRepository($table);
   }

   public static function RouterRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('RouterRepository', $table);
       }

       return new \App\Repositories\RouterRepository($table);
   }

   public static function ArticleRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('ArticleRepository', $table);
       }

       return new \App\Repositories\ArticleRepository($table);
   }

   public static function UserCatalogueRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('UserCatalogueRepository', $table);
       }

       return new \App\Repositories\UserCatalogueRepository($table);
   }

   public static function UserRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('UserRepository', $table);
       }

       return new \App\Repositories\UserRepository($table);
   }
   public static function BranchRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('BranchRepository', $table);
       }

       return new \App\Repositories\BranchRepository($table);
   }
   public static function FacultyRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('FacultyRepository', $table);
       }

       return new \App\Repositories\FacultyRepository($table);
   }
   public static function SemesterRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('SemesterRepository', $table);
       }

       return new \App\Repositories\SemesterRepository($table);
   }
   public static function EventRepository($table = '', $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('EventRepository', $table);
       }

       return new \App\Repositories\EventRepository($table);
   }



   /* LIBRARY */

   public static function Blade($views, $cache, $debug, $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('Blade', $views, $cache, $debug);
       }

       return new \App\Libraries\Blade($views, $cache, $debug);
   }

   public static function Widget($param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('Widget', $param);
       }

       return new \App\Libraries\Widget($param);
   }

   public static function Auth($getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('Auth');
       }

       return new \App\Libraries\Authentication();
   }

   public static function Pagination($getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('Pagination');
       }

       return new \App\Libraries\Pagination();
   }
   public static function Nestedsetbie(array $param = [], $getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('Nestedsetbie', $param);
       }

       return new \App\Libraries\Nestedsetbie($param);
   }
   public static function Cartbie($getShared = true)
   {
       if ($getShared)
       {
           return static::getSharedInstance('Cartbie');
       }

       return new \App\Libraries\Cartbie();
   }
}
