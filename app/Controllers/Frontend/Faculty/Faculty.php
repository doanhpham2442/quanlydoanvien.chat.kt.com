<?php
namespace App\Controllers\Frontend\Faculty;
use App\Controllers\FrontendController;

class Faculty extends FrontendController{
   protected $facultyService;
   protected $language;
   protected $systemRepository;
   protected $facultyRepository;
   protected $promotionRepository;
   protected $reviewRepository;
   protected $reviewService;
   protected $cartBie;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'faculties';
      $this->facultyRepository = service('FacultyRepository', $this->module);
      $this->facultyService = service('FacultyService',
         ['language' => $this->language, 'module' => 'faculties']
      );
      $this->reviewService = service('ReviewService',
         ['language' => $this->language, 'module' => 'faculty_reviews']
      );
      $this->systemRepository = service('SystemRepository', 'systems');
      $this->promotionRepository = service('PromotionRepository', 'promotions');
      $this->cartBie = service('cartbie');
      $this->userRepository = service('userRepository', 'users');

	}

	public function index($id = 0, $page = 1){
      $faculty = $this->facultyRepository->findByField($id, 'tb1.id');
      $facultyCatalogue = $this->facultyRepository->getHome();
      $faculties = $this->facultyRepository->getHome();
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      // dd($facultyCatalogue);
      // $facultyCatalogue =  $this->facultyCatalogueRepository->findByField($faculty['faculty_catalogue_id'], 'tb1.id');
      // $faculty['promotion'] = $this->promotionRepository->findPromotionByFacultyId($faculty['id']);


      // // $canonical = $faculty['canonical'];
      // $canonical = write_url($faculty['canonical'], TRUE, TRUE);
      // $faculty['count'] = $this->facultyRepository->count(['deleted_at' => 0]);
      // $facultyCatalogueList = $this->facultyCatalogueRepository->allFacultyCatalogue($this->language);
      // $facultyCatalogueList = recursive($facultyCatalogueList);
      // /* faculty relate and promotion  */
      // $facultyRelate = $this->facultyRepository->facultyRelate($faculty['faculty_catalogue_id'], 5);
      // if(isset($facultyRelate) && is_array($facultyRelate) && count($facultyRelate)){
      //    foreach($facultyRelate as $key => $val){
      //       $facultyRelate[$key]['promotion'] = $this->promotionRepository->findPromotionByFacultyId($val['id']);
      //       $facultyRelate[$key]['review'] = $this->reviewRepository->averateReviewByFacultyId($val['id']);
      //    }
      // }

      // $seo = seo($faculty, $canonical, 'faculty');
      // $cart = $this->cartBie->formatCart($this->cart);
      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
      }
      $template = route('frontend.faculty.faculty.index');
      // $js = ['review','cart','core'];
		return view(route('frontend.homepage.layout.home'),
         compact(
            'template', 'faculty','facultyCatalogue', 'general','user','faculties'
         )
      );
	}




}
