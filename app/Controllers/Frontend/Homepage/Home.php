<?php
namespace App\Controllers\Frontend\Homepage;
use App\Controllers\FrontendController;

class Home extends FrontendController{

	public $data = [];
   protected $language;
   protected $systemRepository;

	public function __construct(){
	   $this->language = $this->currentLanguage();
      $this->systemRepository = service('SystemRepository', 'systems');

      $this->facultyRepository = service('facultyRepository', 'faculties');
      $this->eventRepository = service('eventRepository', 'events');
      $this->userRepository = service('userRepository', 'users');
      $this->articleRepository = service('articleRepository', 'articles');
      $this->slideRepository = service('SlideRepository', 'slides');
      
	}



	public function index(){

      // $province = converProvinceArray($this->provinceRepository->allProvince());
      $slide = $this->slideRepository->findByField('main-slide', 'keyword', $this->language);
      // $asideBanner = $this->slideRepository->findByField('aside', 'keyword', $this->language);
      // $productCatalogueList = $this->productCatalogueRepository->allProductCatalogue($this->language);
      // $productCatalogueList = recursive($productCatalogueList);
      // $product['count'] = $this->productRepository->count(['deleted_at' => 0]);
      // $widget = [
      //    'bestSeller' =>  $this->widget->getWidgetKeyword('best-seller', $this->language),
      //    'trending' =>  $this->widget->getWidgetKeyword('trending', $this->language),
      //    'newProduct' =>  $this->widget->getWidgetKeyword('new-product', $this->language),
      //    'feedback' =>  $this->widget->getWidgetKeyword('feedback', $this->language),
      //    'categories' =>  $this->widget->getWidgetKeyword('categories', $this->language),
      // ];

      $article = $this->articleRepository->getHome();
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      // dd($general);
      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
      }
      $faculties = $this->facultyRepository->getHome();
      $event = $this->eventRepository->getHome();


		$template = route('frontend.homepage.home.index');
      return view(route('frontend.homepage.layout.home'),
         compact(
            'template', 'general', 'faculties', 'event','user','article','slide'
         )
      );

	}
	public function grapesjs(){
      $article = $this->articleRepository->getHome();
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      // dd($general);
      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
      }
      $faculties = $this->facultyRepository->getHome();
      $event = $this->eventRepository->getHome();
		$template = route('frontend.homepage.home.grapesjs');
      return view(route('frontend.homepage.layout.home'),
         compact(
            'template', 'general', 'faculties', 'event','user','article','slide'
         )
      );

	}



}
