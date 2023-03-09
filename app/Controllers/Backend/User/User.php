<?php
namespace App\Controllers\Backend\User;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends BaseController{
   protected $userService;
   protected $authentication;
   protected $language;
   protected $userRepository;
   protected $userCatalogueRepository;
   protected $facultyRepository;

	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'users';
      $this->userService = service('UserService',
         ['language' => $this->language, 'module' => $this->module]
      );
      $this->authentication = service('Auth');
      $this->userRepository = service('UserRepository', $this->module);
      $this->userCatalogueRepository = service('UserCatalogueRepository', 'user_catalogues');
      $this->facultyRepository = service('facultyRepository', 'faculties');
	}

	public function index($page = 1){
      if(!$this->authentication->gate('backend.user.user.index')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $idLogin = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
      $user = $this->userService->paginate($page);
      $userCatalogue = convertArrayByValue('Nhóm Thành Viên', $this->userCatalogueRepository->getAll('id, title'), 'id', 'title');
      $faculty = convertArrayByValue('Liên chi Đoàn', $this->facultyRepository->getAll('id, title'), 'id', 'title');
      $module = $this->module;
      
      $template = route('backend.user.user.index');
      return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'user', 'module', 'userCatalogue','idLogin','faculty','page'
         )
      );
	}

	public function create(){
      if(!$this->authentication->gate('backend.user.user.create')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
		if($this->request->getMethod() == 'post'){
         // dd($_POST);
         // $validate = $this->validation();
         // if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->userService->create()){
               $this->session->setFlashdata('message-success', 'Thêm mới bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.user.user.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Thêm mới bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.user.user.index'));
            }
         // }else{
         //    $validate = $this->validator->listErrors();
         // }
		}
      $idLogin = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
      $method = 'create';
      $title = 'Thêm mới Đoàn Viên';
      $userCatalogue = convertArrayByValue('Nhóm Thành Viên', $this->userCatalogueRepository->getAll('id, title'), 'id', 'title');
      $ethnic = convertArrayByValue('Dân tộc', $this->userRepository->getSynthesis('vn_ethnic'), 'id', 'name');
      $religion = convertArrayByValue('Tôn giáo', $this->userRepository->getSynthesis('vn_religion'), 'id', 'name');
      $province = convertArrayByValue('Nơi cấp', $this->userRepository->getProvince('vn_province '), 'provinceid', 'name');
      $faculty = convertArrayByValue('Liên chi Đoàn', $this->facultyRepository->getAll('id, title'), 'id', 'title');
      $template = route('backend.user.user.store');
		return view(route('backend.dashboard.layout.home'),
         compact('method', 'validate', 'template', 'title', 'userCatalogue','faculty','ethnic','religion','province','idLogin')
      );
	}
	public function createExcel(){
      if(!$this->authentication->gate('backend.user.user.create')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $userCompare = $this->userRepository-> getUserCompare($this->request->getPost('faculty_id'),$this->request->getPost('class_id'));
      // dd($userCompare);
		if($this->request->getMethod() == 'post'){
         $path 			= 'public/csvfile/';
         $json 			= [];
         $file_name 		= $this->request->getFile('file');
         $file_name 		= $this->uploadFile($path, $file_name);
         $arr_file 		= explode('.', $file_name);
         $extension 		= end($arr_file);
         if('csv' == $extension) {
            $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
         } else {
            $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
         }
         $spreadsheet 	= $reader->load($file_name);
         $sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
         // dd($sheet_data);
         $list 			= [];
         $password = $this->userService->renderPassword(PASSWORD);

         foreach($sheet_data as $key => $val) {
            if($key != 0) {
               $list [] = [
                  'fullname' => $val[1],
                  'id_student' => $val[2],
                  // 'birthday' => date('Y-m-d', strtotime(str_replace('/', '-', date("d/m/Y", strtotime($val[3]))))),
                  'birthday' => date('Y-m-d', strtotime(str_replace('/', '-', $val[3]))),
                  'gender' => (strtolower($val[4]) == 'nam') ? '2' : '1',
                  'phone' => $val[5],
                  'email' => $val[6],
                  'user_catalogue_id' => "10",
                  'union_position' => "10",
                  'faculty_id' => $this->request->getPost('faculty_id'),
                  'class_id' => $this->request->getPost('class_id'),
                  'publish' => '1',
                  'salt' => $password['salt'],
                  'password' => $password['password'],
               ];
               // if($val[0] == 'null'){
               //    break;
               // }
               if(!filter_var($val[6], FILTER_VALIDATE_EMAIL) || $val[6] == 'null'){
                  $this->session->setFlashdata('message-danger', 'Email của Đoàn viên số thứ tự : '.$val[0].' bị thiếu hoặc sai định dạng!');
                  return redirect()->to($_SERVER['REQUEST_URI']);
               }
               if(!preg_match('/0[0-9]{9}$/', $val[5]) || $val[5] == 'null'){
                  $this->session->setFlashdata('message-danger', 'Số điện thoại của Đoàn viên số thứ tự : '.$val[0].' bị thiếu hoặc sai định dạng!');
                  return redirect()->to($_SERVER['REQUEST_URI']);
               }
               if(!preg_match('/^[0-9]{10}$/', $val[2]) || $val[2] == 'null'){
                  $this->session->setFlashdata('message-danger', 'Mã sinh viên của Đoàn viên số thứ tự : '.$val[0].' bị thiếu hoặc sai định dạng!');
                  return redirect()->to($_SERVER['REQUEST_URI']);
               }
               if(($val[1] == 'null')){
                  $this->session->setFlashdata('message-danger', 'Họ và Tên của Đoàn viên số thứ tự : '.$val[0].' bị thiếu!');
                  return redirect()->to($_SERVER['REQUEST_URI']);
               }
               foreach ($userCompare as $keyCompare => $valCompare) {
                  // dd($valCompare);
                  if(($val[2] == $valCompare['id_student'])){
                     $this->session->setFlashdata('message-danger', 'Đã tồn tại Đoàn viên có mã sinh viên: '.$val[2].' !');
                     return redirect()->to($_SERVER['REQUEST_URI']);
                  }
               }
            }
            
         }
         // dd($list);
         $validate = $this->validationExcel();
         if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->userService->createExcel($list)){
               $this->session->setFlashdata('message-success', 'Thêm mới bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.user.user.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Thêm mới bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.user.user.index'));
            }
         }else{
            $validate = $this->validator->listErrors();
         }
		}
      $faculty = convertArrayByValue('Liên chi Đoàn', $this->facultyRepository->getAll('id, title'), 'id', 'title');
      $method = 'create';
      $title = 'Thêm mới Đoàn Viên';
      $template = route('backend.user.user.storeexcel');
		return view(route('backend.dashboard.layout.home'),
         compact('method', 'validate', 'template', 'title', 'userCatalogue','faculty','ethnic','religion','province')
      );
	}


	public function update($id = 0){
      
      $id = (int)$id;
      if(!$this->authentication->gate('backend.user.user.update')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $user = $this->userRepository->findByField($id, 'tb1.id');
      if(!isset($user) || is_array($user) == false || count($user) == 0){
         $this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
         return redirect()->to(BASE_URL.route('backend.user.user.index'));
      }

      if($this->request->getMethod() == 'post'){
         // dd($_POST);
         // $validate = $this->validation();
         // if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->userService->update($id)){
               $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
               return redirect()->to(BASE_URL.route('backend.user.user.index'));
            }else{
               $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
               return redirect()->to(BASE_URL.route('backend.user.catalogue.index'));
            }
         // }else{
         //    $validate = $this->validator->listErrors();
         // }
      }
      $idLogin = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
      $method = 'update';
      $title = 'Cập nhật Đoàn Viên';
      $userCatalogue = convertArrayByValue('Nhóm Thành Viên', $this->userCatalogueRepository->getAll('id, title'), 'id', 'title');
      $ethnic = convertArrayByValue('Dân tộc', $this->userRepository->getSynthesis('vn_ethnic'), 'id', 'name');
      $religion = convertArrayByValue('Tôn giáo', $this->userRepository->getSynthesis('vn_religion'), 'id', 'name');
      $province = convertArrayByValue('Nơi cấp', $this->userRepository->getProvince('vn_province '), 'provinceid', 'name');
      $faculty = convertArrayByValue('Liên chi Đoàn', $this->facultyRepository->getAll('id, title'), 'id', 'title');

      $template = route('backend.user.user.store');
      return view(route('backend.dashboard.layout.home'), compact(
         'dropdown', 'method', 'validate', 'template', 'title', 'userCatalogue', 'user','faculty','ethnic','religion','province','idLogin'
         )
      );
	}

	public function delete($id = 0){

      $id = (int)$id;
      if(!$this->authentication->gate('backend.user.user.delete')){
         $this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
         return redirect()->to(BASE_URL.route('backend.dashboard.dashboard.index'));
      }
      $id = (int)$id;
      $user = $this->userRepository->findByField($id, 'tb1.id');
      if(!isset($user) || is_array($user) == false || count($user) == 0){
         $this->session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
         return redirect()->to(BASE_URL.route('backend.user.user.index'));
      }

      if($this->request->getPost('delete')){
         if($this->userService->delete($id)){
            $this->session->setFlashdata('message-success', 'Cập nhật bản ghi thành công!');
            return redirect()->to(BASE_URL.route('backend.user.user.index'));
         }else{
            $this->session->setFlashdata('message-danger', 'Cập nhật bản ghi không thành công!');
            return redirect()->to(BASE_URL.route('backend.user.user.index'));
         }
      }
      $userCatalogue = convertArrayByValue('Nhóm Thành Viên', $this->userCatalogueRepository->getAll('id, title'), 'id', 'title');
      $template = route('backend.user.user.delete');
      return view(route('backend.dashboard.layout.home'),
         compact('template', 'user', 'userCatalogue')
      );
	}

	private function validation(){
		if($this->request->getPost('password')){
			 $validate['password'] = 'required|min_length[6]';
		}
		$validate = [
			// 'email' => 'required|valid_email|check_email_exist',
			// 'user_catalogue_id' => 'is_natural_no_zero',
			// 'fullname' => 'required',
		];
		$errorValidate = [
			// 'email' => [
			// 	'check_email_exist' => 'Email đã tồn tại trong hệ thống!',
			// ],
			// 'user_catalogue_id' => [
			// 	'is_natural_no_zero' => 'Bạn phải lựa chọn giá trị cho trường Nhóm Thành Viên'
			// ]
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}
	private function validationExcel(){
	
		$validate = [
			'faculty_id' => 'is_natural_no_zero',
			'class_id' => 'is_natural_no_zero',
		];
		$errorValidate = [
			'faculty_id' => [
				'is_natural_no_zero' => 'Bạn phải lựa chọn giá trị cho trường Khoa trực thuộc'
         ],
			'class_id' => [
				'is_natural_no_zero' => 'Bạn phải lựa chọn giá trị cho trường Chi đoàn trực thuộc'
			]
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

   public function uploadFile($path, $image) {
      if (!is_dir($path)) 
        mkdir($path, 0777, TRUE);
     if ($image->isValid() && ! $image->hasMoved()) {
        $newName = $image->getRandomName();
        $image->move('./'.$path, $newName);
        return $path.$image->getName();
     }
     return "";
  }
}
