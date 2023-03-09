<?php
namespace App\Controllers\Backend\Organization;
use App\Controllers\BaseController;

class Branch extends BaseController{
   protected $branchService;
   protected $nestedsetbie;
   protected $authentication;
   protected $language;
   protected $branchRepository;
   protected $facultyRepository;



	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'classes';
      $this->branchService = service('BranchService',
         ['language' => $this->language, 'module' => $this->module]
      );
      // $this->nestedsetbie = service('Nestedsetbie',
      //    ['table' => 'branch_catalogues', 'language' => $this->language, 'foreignkey' => 'branch_catalogue_id']
      // );
      $this->authentication = service('Auth');
      $this->branchRepository = service('branchRepository', $this->module);
      $this->facultyRepository = service('facultyRepository', 'faculties');

	}

	public function index($page = 1){
      if(!$this->authentication->gate('backend.organization.branch.index')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		$branch = $this->branchService->paginate($page);
      $catalogue = $this->facultyRepository->getAllCatalogue('faculties');
      $dropdown = dropdown_no_language($catalogue);
      $module = $this->module;
      $template = route('backend.organization.branch.index');
		return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'branch', 'module', 'dropdown'
         )
      );
	}

	public function create(){
      if(!$this->authentication->gate('backend.organization.branch.create')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		if($this->request->getMethod() == 'post'){
         $validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->branchService->create()){
               $this->session->setFlashdata('message-success', 'Thêm mới bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.branch.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Thêm mới bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.branch.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}

      $module = 'branch';
      $method = 'create';
      $title = 'Thêm Mới Chi Đoàn';

      $catalogue = $this->facultyRepository->getAllCatalogue('faculties');
      $dropdown = dropdown_no_language($catalogue);
      // dd($dropdown);

      $template = route('backend.organization.branch.store');
		return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'module')
      );
	}

	public function update($id = 0){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.organization.branch.update')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $branch = $this->branchRepository->findByField($id, 'tb1.id');

		if(!isset($branch) || is_array($branch) == false || count($branch) == 0){
			$this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.branch.catalogue.index'));
		}

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->branchService->update($id)){
               $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.branch.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.organization.branch.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}
      $method = 'update';
      $title = 'Cập nhật Nhóm Bài Viết';
      $catalogue = $this->facultyRepository->getAllCatalogue('faculties');
      $dropdown = dropdown_no_language($catalogue);
      $template = route('backend.organization.branch.store');
      $module = 'branch';
      return view(route('backend.dashboard.layout.home'),
         compact('dropdown', 'method', 'validate', 'template', 'title', 'branch', 'module')
      );
	}

	public function delete($id = 0){
      $id = (int)$id;
      if(!$this->authentication->gate('backend.organization.branch.delete')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $branch = $this->branchRepository->findByField($id, 'tb1.id');

		if(!isset($branch) || is_array($branch) == false || count($branch) == 0){
			$this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.route('backend.branch.catalogue.index'));
		}

		if($this->request->getPost('delete')){
         if($this->branchService->delete($id)){
            $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
            return redirect()->to(BASE_URL.route('backend.organization.branch.index'));
         }else{
            $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
            return redirect()->to(BASE_URL.route('backend.organization.branch.index'));
         }
		}
      $template = route('backend.organization.branch.delete');
      return view(route('backend.dashboard.layout.home'),
         compact('template', 'branch')
      );
	}
	private function validation(){
		$validate = [
			'title' => 'required',
			'faculty_id' => 'is_natural_no_zero',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			'faculty_id' => [
				'is_natural_no_zero' => 'Bạn Phải chọn Liên chi Đoàn quản lý',
			],
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
