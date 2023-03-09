<?php
namespace App\Controllers\Frontend\Search;
use App\Controllers\FrontendController;

class Search extends FrontendController{
   protected $productService;
   protected $language;
   protected $systemRepository;
   protected $productRepository;
   protected $cartBie;
   protected $semesterRepository;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'event';
      $this->eventService = service('EventService',
         ['language' => $this->language, 'module' => 'events']
      );
      $this->articleService = service('ArticleService',
         ['language' => $this->language, 'module' => 'articles']
      );
      $this->systemRepository = service('SystemRepository', 'systems');
      $this->userRepository = service('UserRepository', 'users');
      $this->articleRepository = service('ArticleRepository', 'articles');
      // $this->facultyRepository = service('FacultyRepository', 'faculties');
      // $this->semesterRepository = service('SemesterRepository', 'semesters');
      // $this->eventRepository = service('EventRepository', 'events');
	}

	public function index( $page = 1){
      $module = $this->module;
      $data = [];
      if($this->request->getGet('search') && $this->request->getGet('keyword') != ''){
         $data = $this->articleService->searchFrontend();
      }
      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
      }
      // dd($data['list']);
      $keyword = $this->request->getGet('keyword');
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      // $dropdown = convertArrayByValue('Năm học', $this->semesterRepository->getAllCatalogueLv1('semesters'), 'id', 'title');
      $template = route('frontend.search.index');

		return view(route('frontend.homepage.layout.home'),
         compact(
            'template', 'general','user','data','keyword'
         )
      );
	}


}
