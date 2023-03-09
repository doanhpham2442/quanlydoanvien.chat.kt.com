<?php
namespace App\Controllers\Backend\CheckEvent;
use App\Controllers\BaseController;

class CheckEvent extends BaseController{
   protected $eventService;
   protected $nestedsetbie;
   protected $authentication;
   protected $language;
   protected $eventRepository;
   protected $semesterRepository;
   protected $facultyRepository;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'events';
      $this->eventService = service('EventService',
         ['language' => $this->language, 'module' => $this->module]
      );
      $this->userService = service('UserService',
         ['language' => $this->language, 'module' => 'users']
      );

      $this->authentication = service('Auth');
      $this->eventRepository = service('eventRepository', $this->module);
      $this->semesterRepository = service('semesterRepository', 'semesters');
      $this->facultyRepository = service('facultyRepository', 'faculties');

	}

	public function index($page = 1){
      if(!$this->authentication->gate('backend.checkevent.checkevent.index')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      // dd(123);
		$event = $this->eventService->paginate($page);
      // dd($event);
      // $countEvent = $this->eventService->countEventUser($page);
      $catalogue = $this->semesterRepository->getAllCatalogue('semesters');
      $dropdown = dropdown_no_language($catalogue);
      
      $module = $this->module;
      $title = 'Danh sách chương trình, sự kiện cần duyệt';
      $template = route('backend.event.checkevent.index');
		return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'event', 'module', 'dropdown','title','countEvent'
         )
      );
	}

	public function checkUser($id = 0,$page = 1){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.checkevent.checkevent.checkuser')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $eventUser = $this->eventService->paginateEventUser($id,$page);

      $method = 'update';
      $title = 'Duyệt minh chứng tham gia';
      $catalogue = $this->semesterRepository->getAllCatalogue('semesters');
      $dropdown = dropdown_no_language($catalogue);

      $template = route('backend.event.checkevent.checkevent');
      $module = 'event';
      return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'eventUser', 'module','scales')
      );
	}

   // public function pointTraining($page = 1)
   // {
   //    if(!$this->authentication->gate('backend.checkevent.checkevent.pointtraining')){
   //       $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
   //       return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
   //    }
   //    // dd(123);
   //    if($id = $this->request->getGet('semester_2_id')){

   //       $userEvent = $this->eventService->paginateUserSemester($id,$page);
   //       // dd($userEvent);
   //    }
   //    // $id = semester_2_id
   //    $dropdown = convertArrayByValue('Năm học', $this->semesterRepository->getAllCatalogueLv1('semesters'), 'id', 'title');
      
   //    $module = $this->module;
   //    $title = 'Danh sách điểm rèn luyện';
   //    $template = route('backend.event.checkevent.index_point_training');
	// 	return view(route('backend.dashboard.layout.home'),
   //       compact(
   //          'template', 'event', 'module', 'dropdown','title','userEvent'
   //       )
   //    );
   // }


}
