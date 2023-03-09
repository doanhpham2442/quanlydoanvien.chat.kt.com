<?php
namespace App\Controllers\Backend\Organization;
use App\Controllers\BaseController;

class Faculty extends BaseController{
   protected $facultyService;
   protected $nestedsetbie;
   protected $authentication;
   protected $language;
   protected $facultyRepository;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'faculties';
      $this->facultyService = service('FacultyService',
         ['language' => $this->language, 'module' => $this->module]
      );
      // $this->nestedsetbie = service('Nestedsetbie',
      //    ['table' => $this->module,'language' => $this->language, 'foreignkey' => 'product_catalogue_id']
      // );
      $this->authentication = service('Auth');
      $this->facultyRepository = service('FacultyRepository', $this->module);
	}

	public function index($page = 1){
      if(!$this->authentication->gate('backend.organization.faculty.index')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		$faculty = $this->facultyService->paginate($page);
        // dd($faculty);
      $module = $this->module;
      $template = route('backend.organization.faculty.index');
		return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'faculty', 'module'
         )
      );
	}

	public function create(){
      if(!$this->authentication->gate('backend.organization.faculty.create')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }


		if($this->request->getMethod() == 'post'){
         $validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->facultyService->create()){
               $this->session->setFlashdata('message-success', 'Thêm mới bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Thêm mới bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}

      $method = 'create';
      $title = 'Thêm Mới Liên chi Đoàn';
    //   $dropdown = $this->nestedsetbie->dropdown();
      $template = route('backend.organization.faculty.store');
		return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title')
      );
	}

	public function update($id = 0){
		$id = (int)$id;
      if(!$this->authentication->gate('backend.organization.faculty.update')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $faculty = $this->facultyRepository->findByField($id, 'tb1.id');
   
      // dd($faculty);
		if(!isset($faculty) || is_array($faculty) == false || count($faculty) == 0){
			$this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
		}

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->facultyService->update($id)){
               $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}
      $method = 'update';
      $title = 'Cập nhật Liên chi Đoàn';
      $template = route('backend.organization.faculty.store');
		return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'faculty')
      );
	}

	public function delete($id = 0){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.organization.faculty.delete')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		$id = (int)$id;
      $faculty = $this->facultyRepository->findByField($id, 'tb1.id');

		if(!isset($faculty) || is_array($faculty) == false || count($faculty) == 0){
			$this->session->setFlashdata('message-danger', 'Liên chi Đoàn không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
		}

		if($this->request->getPost('delete')){
         if($this->facultyService->delete($id, $faculty)){
            $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
            return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
         }else{
            $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
            return redirect()->to(BASE_URL.route('backend.organization.faculty.index'));
         }
		}
      $method = 'delete';
      $title = 'Xóa Liên chi Đoàn';
      $template = route('backend.organization.faculty.delete');
		return view(route('backend.dashboard.layout.home'),
         compact('template', 'title', 'method', 'faculty')
      );
	}


	private function validation(){
		$validate = [
			'title' => 'required',
			// 'canonical' => 'required|check_router['.$this->module.']',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
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
