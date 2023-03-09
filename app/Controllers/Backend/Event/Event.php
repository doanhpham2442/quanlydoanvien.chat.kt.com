<?php
namespace App\Controllers\Backend\Event;
use App\Controllers\BaseController;

class Event extends BaseController{
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
      $this->authentication = service('Auth');
      $this->eventRepository = service('eventRepository', $this->module);
      $this->semesterRepository = service('semesterRepository', 'semesters');
      $this->facultyRepository = service('facultyRepository', 'faculties');

	}

	public function index($page = 1){
      if(!$this->authentication->gate('backend.event.event.index')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		$event = $this->eventService->paginate($page);
      $catalogue = $this->semesterRepository->getAllCatalogue('semesters');
      $dropdown = dropdown_no_language($catalogue);
      
      $module = $this->module;
      $title = 'Quản lý Chương trình, sự kiện';
      $template = route('backend.event.event.index');
		return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'event', 'module', 'dropdown'
         )
      );
	}
	public function create(){
      if(!$this->authentication->gate('backend.event.event.create')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		if($this->request->getMethod() == 'post'){
         $validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->eventService->create()){
               $this->session->setFlashdata('message-success', 'Thêm mới bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.event.event.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Thêm mới bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.event.event.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}

      $module = 'event';
      $method = 'create';
      $title = 'Thêm Mới Chương trình, sự kiện';

      $catalogue = $this->semesterRepository->getAllCatalogue('semesters');
      $dropdown = dropdown_no_language($catalogue);
      $faculty = $this->facultyRepository->getAllCatalogue('faculties');
      // $scales = dropdown_no_language($faculty);
      $template = route('backend.event.event.store');
		return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'module', 'scales')
      );
	}

	public function update($id = 0){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.event.event.update')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $event = $this->eventRepository->findByField($id, 'tb1.id');

		if(!isset($event) || is_array($event) == false || count($event) == 0){
			$this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.event.catalogue.index'));
		}

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->eventService->update($id)){
               $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.event.event.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.event.event.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}
      $method = 'update';
      $title = 'Cập nhật Chương trình, sự kiện';
      $catalogue = $this->semesterRepository->getAllCatalogue('semesters');
      $dropdown = dropdown_no_language($catalogue);
      $faculty = $this->facultyRepository->getAllCatalogue('faculties');
      $scales = dropdown_no_language($faculty);
      $template = route('backend.event.event.store');
      $module = 'event';
      return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'event', 'module','scales')
      );
	}

	public function delete($id = 0){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.event.event.delete')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $event = $this->eventRepository->findByField($id, 'tb1.id');

		if(!isset($event) || is_array($event) == false || count($event) == 0){
			$this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.event.catalogue.index'));
		}

		if($this->request->getPost('delete')){
         if($this->eventService->delete($id)){
            $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
            return redirect()->to(BASE_URL.route('backend.event.event.index'));
         }else{
            $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
            return redirect()->to(BASE_URL.route('backend.event.event.index'));
         }
		}
      $template = route('backend.event.event.delete');
      return view(route('backend.dashboard.layout.home'),
         compact('template', 'event')
      );
	}
	private function validation(){
		$validate = [
			'title' => 'required',
			'score' => 'required',
			'semester_id' => 'is_natural_no_zero',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			'score' => [
				'required' => 'Bạn phải nhập điểm được cộng'
			],
			'semester_id' => [
				'is_natural_no_zero' => 'Bạn phải chọn học kỳ sẽ tổ chức',
			],
			
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
