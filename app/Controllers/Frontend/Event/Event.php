<?php
namespace App\Controllers\Frontend\Event;
use App\Controllers\FrontendController;

class Event extends FrontendController{
   protected $eventService;
   protected $language;
   protected $systemRepository;
   protected $eventRepository;
   protected $promotionRepository;
   protected $reviewRepository;
   protected $reviewService;
   protected $cartBie;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'events';
      $this->eventService = service('EventService',
         ['language' => $this->language, 'module' => 'events']
      );

      $this->systemRepository = service('SystemRepository', 'systems');
      $this->eventRepository = service('EventRepository', 'events');
      $this->semesterRepository = service('SemesterRepository', 'semesters');
      $this->userRepository = service('userRepository', 'users');
      $this->facultyRepository = service('facultyRepository', 'faculties');
	}

	public function index($id = 0, $page = 1){

      
      $faculties = $this->facultyRepository->getHome();
      $event = $this->eventRepository->findByField($id, 'tb1.id');
      $semester =  $this->semesterRepository->getAll();
      $eventRelate = $this->eventRepository->eventRelate($event['semester_id'], 5);
      if(isset($_COOKIE['QLDVKT_backend'])){
         $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
         $user = $this->userRepository->getAccount($id,'tb1.id');
         $condition = [
            'user_id' => json_decode($_COOKIE['QLDVKT_backend'], true)['id'],
            'event_id' => $event['id'],
         ];
         $eventUser = $this->eventRepository->checkEventUser($condition);
      }
      if($this->request->getMethod() == 'post'){
         if(!isset($_COOKIE['QLDVKT_backend'])){
            $this->session->setFlashdata('message-danger', 'Bạn Phải đăng nhập trước khi gửi minh chứng!');
            header("Refresh:0");
         }
         else if( $eventUser > 0){
            $this->session->setFlashdata('message-danger', 'Bạn đã gửi minh chứng cuộc thi này!');
            header("Refresh:0");
         }else{
            // dd($_POST);
            $validate = $this->validation();
            if ($this->validate($validate['validate'], $validate['errorValidate'])){
               if($this->eventService->createEventUser()){
                  $this->session->setFlashdata('message-success', 'Gửi minh chứng thành công!');
                  header("Refresh:0");
               }else{
                  $this->session->setFlashdata('message-danger', 'Gửi minh chứng không thành công!');
                  header("Refresh:0");
               }
            }else{
               $validate = $this->validator->listErrors();
               $this->session->setFlashdata('message-danger', 'Bạn phải gửi hình ảnh minh chứng!');
            }
         }
		}
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      $template = route('frontend.event.event.index');
		return view(route('frontend.homepage.layout.home'),
         compact(
            'user','template', 'semester', 'event', 'general','eventRelate','faculties','eventUser','genneral'
         )
      );
	}
   private function validation(){
		$validate = [
			'image' => 'required',

		];
		$errorValidate = [
			'image' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],

		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}




}
