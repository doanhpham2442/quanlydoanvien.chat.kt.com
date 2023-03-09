<?php
namespace App\Controllers\Backend\Dashboard;
use App\Controllers\BaseController;

class Dashboard extends BaseController{

	protected $userRepository;

	public function __construct(){
		$this->authentication = service('Auth');
		$this->language = $this->currentLanguage();
		$this->module = 'faculties';
		$this->userService = service('UserService',
			['language' => $this->language, 'module' => $this->module]
		);
		$this->userRepository = service('UserRepository', $this->module);
	}


	public function index( $page = 0){

		if(!$this->authentication->gate('backend.dashboard.dashboard.index')){
			$this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
			return redirect()->to(BASE_URL);
		}
		$value = 0;
		$field = 0;
		if(isset($_COOKIE['QLDVKT_backend'])){
			$user_cat_id = json_decode($_COOKIE['QLDVKT_backend'], true)['user_catalogue_id'];
			$class_id = json_decode($_COOKIE['QLDVKT_backend'], true)['class_id'];
			$faculty_id = json_decode($_COOKIE['QLDVKT_backend'], true)['faculty_id'];
   
			if($user_cat_id == 8){
			   $value = $faculty_id;
			   $field = 'tb1.id';
			   $userClass = $this->userRepository->getDashboardClass($value , $field);
			}
			if($user_cat_id == 9){
				$value = $class_id;
			   	$field = 'tb2.id';
				$userClass = $this->userRepository->getDashboardClass($value , $field);
			}	
		 }
		$users = $this->userRepository->getDashboard($value , $field);
		$userFaculty = $this->userRepository->getDashboardFaculty();
		// dd($userClass);
		$userEvent = $this->userRepository->getDashboardEvent();
		$template = route('backend.dashboard.home.index');
			return view(route('backend.dashboard.layout.home'),
			compact(
				'template', 'module', 'users' ,'userFaculty','userEvent','user_cat_id','userClass'
			)
		);
	}

}

