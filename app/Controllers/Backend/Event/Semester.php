<?php
namespace App\Controllers\Backend\Event;
use App\Controllers\BaseController;

class Semester extends BaseController{
   protected $semesterService;
   protected $nestedsetbie;
   protected $authentication;
   protected $language;
   protected $semesterRepository;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'semesters';
      $this->semesterService = service('SemesterService',
         ['language' => $this->language, 'module' => $this->module]
      );
      $this->nestedsetbie = service('Nestedsetbie',
         ['table' => $this->module]
      );
      $this->authentication = service('Auth');
      $this->semesterRepository = service('SemesterRepository', $this->module);
	}

	public function index($page = 1){
      if(!$this->authentication->gate('backend.event.semester.index')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		$semester = $this->semesterService->paginate($page);
      //   dd($semester);
      $module = $this->module;
      $template = route('backend.event.semester.index');
		return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'semester', 'module'
         )
      );
	}

	public function create(){
      if(!$this->authentication->gate('backend.event.semester.create')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }


		if($this->request->getMethod() == 'post'){
         $validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->semesterService->create()){
               $this->session->setFlashdata('message-success', 'Thêm mới bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.event.semester.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Thêm mới bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.event.semester.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}

      $method = 'create';
      $title = 'Thêm Mới Học Kỳ';
      $dropdown = $this->nestedsetbie->DropdownNoLanguage();
      $template = route('backend.event.semester.store');
		return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title')
      );
	}

	public function update($id = 0){
		$id = (int)$id;
      if(!$this->authentication->gate('backend.event.semester.update')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $semester = $this->semesterRepository->findByField($id, 'tb1.id');
   
      // dd($semester);
		if(!isset($semester) || is_array($semester) == false || count($semester) == 0){
			$this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.event.semester.index'));
		}

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->semesterService->update($id)){
               $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.event.semester.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.event.semester.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}
      $method = 'update';
      $title = 'Cập nhật Học Kỳ';
      $dropdown = $this->nestedsetbie->DropdownNoLanguage();
      $template = route('backend.event.semester.store');
		return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'semester')
      );
	}

	public function delete($id = 0){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.event.semester.delete')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $semester = $this->semesterRepository->findByField($id, 'tb1.id');

		if(!isset($semester) || is_array($semester) == false || count($semester) == 0){
			$this->session->setFlashdata('message-danger', 'Thông tin học kỳ không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.event.semester.index'));
		}

		if($this->request->getPost('delete')){
         if($this->semesterService->delete($id, $semester)){
            $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
            return redirect()->to(BASE_URL.route('backend.event.semester.index'));
         }else{
            $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
            return redirect()->to(BASE_URL.route('backend.event.semester.index'));
         }
		}
      $method = 'delete';
      $title = 'Xóa Học Kỳ';
      $template = route('backend.event.semester.delete');
		return view(route('backend.dashboard.layout.home'),
         compact('template', 'title', 'method', 'semester')
      );
	}


	private function validation(){
		$validate = [
			'title' => 'required',
			'day_start' => 'required',
			'day_end' => 'required',
			// 'canonical' => 'required|check_router['.$this->module.']',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			'day_start' => [
				'required' => 'Bạn phải nhập ngày bắt đầu'
			],
			'day_end' => [
				'required' => 'Bạn phải nhập ngày kết thúc'
			],
			// 'canonical' => [
			// 	'required' => 'Bạn phải nhập giá trị cho trường đường dẫn',
			// 	'check_router' => 'Đường dẫn đã tồn tại, vui lòng chọn đường dẫn khác',
			// ],
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
