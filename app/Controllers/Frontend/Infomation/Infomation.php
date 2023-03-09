<?php
namespace App\Controllers\Frontend\Infomation;
use App\Controllers\FrontendController;

class Infomation extends FrontendController{
   protected $language;
   protected $systemRepository;
   protected $userService;
   protected $userRepository;
   protected $userCatalogueRepository;
   protected $facultyRepository;


	public function __construct(){
      $this->language = $this->currentLanguage();
      $this->module = 'users';
      $this->userService = service('UserService',
         ['language' => $this->language, 'module' => $this->module]
      );
      $this->userRepository = service('UserRepository', $this->module);
      $this->userCatalogueRepository = service('UserCatalogueRepository', 'user_catalogues');
      $this->facultyRepository = service('facultyRepository', 'faculties');
      $this->systemRepository = service('SystemRepository', 'systems');

	}

	public function index($id = 0, $page = 1){
      if(!isset($_COOKIE['QLDVKT_backend'])){
         $this->session->setFlashdata('message-danger', 'Bạn phải đăng nhập trước khi sử dụng chức năng này!');
         return redirect()->to(BASE_URL);
      }
      $module = $this->module;
      $general = convertGeneral($this->systemRepository->all('keyword, content'));  
      $id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
      $user = $this->userRepository->getAccount($id,'tb1.id');

      $faculties = $this->facultyRepository->getHome();
      if($this->request->getMethod() == 'post'){
         // dd($_POST);
         // $validate = $this->validation();
         // if ($this->validate($validate['validate'], $validate['errorValidate'])){
            if($this->userService->update($id)){
               $this->session->setFlashdata('message-success', 'Cập nhật thông tin thành công!');
               return redirect()->to($_SERVER['REQUEST_URI']);
            }else{
               $this->session->setFlashdata('message-danger', 'Cập nhật thông tin không thành công!');
               return redirect()->to($_SERVER['REQUEST_URI']);
            }
         // }else{
         //    $validate = $this->validator->listErrors();
         // }
		}
      $general = convertGeneral($this->systemRepository->all('keyword, content'));
      $userCatalogue = convertArrayByValue('Nhóm Thành Viên', $this->userCatalogueRepository->getAll('id, title'), 'id', 'title');
      $ethnic = convertArrayByValue('Dân tộc', $this->userRepository->getSynthesis('vn_ethnic'), 'id', 'name');
      $religion = convertArrayByValue('Tôn giáo', $this->userRepository->getSynthesis('vn_religion'), 'id', 'name');
      $province = convertArrayByValue('Nơi cấp', $this->userRepository->getProvince('vn_province '), 'provinceid', 'name');
      $faculty = convertArrayByValue('Liên chi Đoàn', $this->facultyRepository->getAll('id, title'), 'id', 'title');
      $title = 'Thông tin cá nhân';
      $template = route('frontend.infomation.index');
		return view(route('frontend.homepage.layout.home'),
         compact(
            'template', 'title','js', 'userCatalogue','faculty','faculties','ethnic','religion','province','user','general'
         )
      );
	}
   private function validation(){
		// if($this->request->getPost('password')){
		// 	 $validate['password'] = 'required|min_length[6]';
		// }
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


}
