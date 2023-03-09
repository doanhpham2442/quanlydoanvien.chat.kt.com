<?php
namespace App\Controllers\Frontend\Infomation;
use App\Controllers\FrontendController;

class Score extends FrontendController{
   protected $language;
   protected $systemRepository;
   protected $userRepository;
   protected $userCatalogueRepository;
   protected $facultyRepository;


	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'users';
      $this->systemRepository = service('SystemRepository', 'systems');
      $this->userRepository = service('UserRepository', $this->module);
      $this->eventRepository = service('EventRepository', 'events');
      $this->eventService = service('EventService',
         ['language' => $this->language, 'module' => $this->module]
      );
      $this->userCatalogueRepository = service('UserCatalogueRepository', 'user_catalogues');
      $this->facultyRepository = service('facultyRepository', 'faculties');
      $this->eventService = service('EventService',
         ['language' => $this->language, 'module' => 'events']
      );
	}

	public function index($id = 0, $page = 1){
      if(isset($_COOKIE['QLDVKT_backend'])){
        $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
        $user = $this->userRepository->getAccount($id,'tb1.id');
        $module = $this->module;
        $faculties = $this->facultyRepository->getHome();
        $general = convertGeneral($this->systemRepository->all('keyword, content'));
        $eventWaiting = $this->eventRepository->getEventUser('1','tb1.publish',$id);
        $eventAccept = $this->eventRepository->getEventUser('2','tb1.publish',$id);
        $eventIgnore = $this->eventRepository->getEventUser('3','tb1.publish',$id);
        $userEvent = $this->eventRepository->paginateUserSemesterFrontend($id);
      //   dd($userEvent);
         if($this->request->getMethod() == 'post'){
            if(!isset($_COOKIE['QLDVKT_backend'])){
               $this->session->setFlashdata('message-danger', 'Bạn Phải đăng nhập trước khi gửi minh chứng!');
               header("Refresh:0");
               
            }else{
               $id = $this->request->getPost('event_user_id');
               // $validate = $this->validation();
               // if ($this->validate($validate['validate'], $validate['errorValidate'])){
                  if($this->eventService->updateEventUser($id)){
                     $this->session->setFlashdata('message-success', 'Gửi minh chứng thành công!');
                     header("Refresh:1");
                  }else{
                     $this->session->setFlashdata('message-danger', 'Gửi minh chứng không thành công!');
                     header("Refresh:0");
                  }
               // }else{
               //    $validate = $this->validator->listErrors();
               // }
            }
         }
         
         
      }else{
      $this->session->setFlashdata('message-danger', 'Bạn cần đăng nhập để tiếp tục!');
        header("location:".BASE_URL);
      }
   // dd($event_accept);

      $template = route('frontend.infomation.score');
		return view(route('frontend.homepage.layout.home'),
         compact(
            'template', 'userCatalogue','faculties','user','eventWaiting','eventAccept','eventIgnore','userEvent','general'
         )
      );
	}


}
