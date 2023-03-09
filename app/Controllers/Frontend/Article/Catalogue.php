<?php
namespace App\Controllers\Frontend\Article;
use App\Controllers\FrontendController;

class Catalogue extends FrontendController{
   protected $articleService;
   protected $language;
   protected $systemRepository;
   protected $articleRepository;
   protected $productRepository;
   protected $productCatalogueRepository;
   protected $cartBie;
   protected $widget;


	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'article_catalogues';
      $this->articleCatalogueRepository = service('ArticleCatalogueRepository', $this->module);
      $this->articleService = service('ArticleService',
         ['language' => $this->language, 'module' => 'articles']
      );
      $this->systemRepository = service('SystemRepository', 'systems');
      $this->articleRepository = service('ArticleRepository', 'articles');
      $this->productRepository = service('ProductRepository', 'products');
      $this->productCatalogueRepository = service('ProductCatalogueRepository', 'product_catalogues');
      $this->cartBie = service('cartbie');
      $this->widget = service('widget', ['language' => $this->language]);
      $this->userRepository = service('userRepository', 'users');
      $this->facultyRepository = service('facultyRepository', 'faculties');
	}

	public function index($id = 0, $page = 1){

      $module = $this->module;
	   $Catalogue = $this->articleCatalogueRepository->findByField($id, 'tb1.id');
      $article = $this->articleService->index($Catalogue, $page);
      $articleCatalogue =  $this->articleCatalogueRepository->getAll();
      $faculties = $this->facultyRepository->getHome();
      $general = convertGeneral($this->systemRepository->all('keyword, content'));

      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
      }
      $template = route('frontend.article.catalogue.index');
		return view(route('frontend.homepage.layout.home'),
         compact(
            'user','template', 'article', 'general','articleCatalogue','faculties'
         )
      );
	}


}
