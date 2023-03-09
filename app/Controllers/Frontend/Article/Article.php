<?php
namespace App\Controllers\Frontend\Article;
use App\Controllers\FrontendController;

class Article extends FrontendController{
   protected $articleService;
   protected $language;
   protected $systemRepository;
   protected $articleRepository;
   protected $promotionRepository;
   protected $reviewRepository;
   protected $reviewService;
   protected $cartBie;
   protected $widget;
   protected $productCatalogueRepository;
   protected $provinceRepository;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'articles';
         $this->articleRepository = service('ArticleRepository', $this->module);
      $this->articleCatalogueRepository = service('ArticleCatalogueRepository', 'article_catalogues');
      $this->articleService = service('ArticleService',
         ['language' => $this->language, 'module' => 'articles']
      );
      $this->systemRepository = service('SystemRepository', 'systems');
      $this->userRepository = service('UserRepository', 'users');
      $this->facultyRepository = service('facultyRepository', 'faculties');

	}

	public function index($id = 0, $page = 1){
      $article = $this->articleRepository->findByField($id, 'tb1.id');
      $articleCatalogue =  $this->articleCatalogueRepository->getAll();
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      $faculties = $this->facultyRepository->getHome();

      // /* article relate and promotion  */
      $articleRelate = $this->articleRepository->articleRelate($article['article_catalogue_id'], 5);

      // $productCatalogueList = $this->productCatalogueRepository->allProductCatalogue($this->language);
      // $productCatalogueList = recursive($productCatalogueList);

      // $widget = [
      //    'post' =>  $this->widget->getWidgetKeyword('post-highlight', $this->language),
      // ];

      // $province = converProvinceArray($this->provinceRepository->allProvince());
      // $seo = seo($article, $canonical, 'article');
      // $cart = $this->cartBie->formatCart($this->cart);
      // $js = ['cart','core'];
      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
      }
      $template = route('frontend.article.article.index');
		return view(route('frontend.homepage.layout.home'),
         compact(
            'template','canonical', 'article', 'general','articleCatalogue','user','articleRelate','faculties'
         )
      );
	}




}
