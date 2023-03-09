<?php
namespace App\Controllers\Frontend\Authentication;
use App\Controllers\BaseController;
use App\Libraries\Mailbie;

class Auth extends BaseController{
	protected $data;


	public function __construct(){
		$this->data = [];
	}

	public function login(){
		if($this->request->getMethod() == 'post'){
			$validate = [
				'email' => 'required',
				'password' => 'required|min_length[6]|checkAuth['.$this->request->getVar('email').']|checkActive['.$this->request->getVar('email').']',
			];
			$errorValidate = [
				'password' => [
					'checkAuth' => 'Email Hoặc Mật khẩu không chính xác!',
					'checkActive' => 'Tài khoản của bạn đang bị khóa!',
				],
			];

 		 	if ($this->validate($validate, $errorValidate)){
		 		$user = $this->AutoloadModel->_get_where([
		 			'table' => 'users',
		 			'select' => 'id, fullname, email, user_catalogue_id, class_id, faculty_id, (SELECT permission FROM user_catalogues WHERE user_catalogues.id = users.user_catalogue_id) as permission',
		 			// 'where' => ['email' => $this->request->getVar('email'),'deleted_at' => 0],
					'query' => '(`email` = "'.addslashes($this->request->getVar('email')).'" OR `id_student` = "'.addslashes($this->request->getVar('email')).'") AND `deleted_at` = 0 AND `publish` = 1',
		 		]);
		 		$cookieAuth = [
		 			'id' => $user['id'],
		 			'fullname' => $user['fullname'],
		 			'email' => $user['email'],
		 			'user_catalogue_id' => $user['user_catalogue_id'],
		 			'class_id' => $user['class_id'],
		 			'faculty_id' => $user['faculty_id'],
		 			// 'permission' => base64_encode($user['permission']),
		 		];
		 		setcookie(AUTH.'backend', json_encode($cookieAuth), time() + 1*24*3600, "/");
		 		$_update = [
		 			'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'user_agent' => $_SERVER['HTTP_USER_AGENT'],
					'remote_addr' => $_SERVER['REMOTE_ADDR']
		 		];
		 		$flag = $this->AutoloadModel->_update([
		 			'table' => 'users',
		 			'where' => ['id' => $user['id']],
		 			'data' => $_update
		 		]);
		 		if($flag > 0){
		 			$session = session();
		 			$session->setFlashdata('message-success', 'Đăng nhập thành công!');
					 header("Refresh:0");
		 			return redirect()->to(BASE_URL);
		 		}
		 		
	        }else{
				$session = session();
		 		$session->setFlashdata('message-danger', 'Sai tài khoản hoặc mật khẩu, vui lòng đăng nhập lại!');
	        	$this->data['validate'] = $this->validator->listErrors();
				return redirect()->to(BASE_URL);
	        }
		}
		return view('backend/authentication/login', $this->data);
	}

	public function logout(){
	 	unset($_COOKIE[AUTH.'backend']);
        setcookie(AUTH.'backend', null, -1, '/');
		$session = session();
		$session->setFlashdata('message-success', 'Đăng xuất thành công!');
		header("Refresh:0");
        return redirect()->to(BASE_URL);
	}
	public function forgot(){

		helper(['mymail']);
		if($this->request->getMethod() == 'post'){
			$validate = [
				'email' => 'required|valid_email|check_email',
			];
			$errorValidate = [
				'email' => [
					'check_email' => 'Email không tồn tại trong hệ thống!',
				],
			];
			if ($this->validate($validate, $errorValidate)){
		 		$user = $this->AutoloadModel->_get_where([
		 			'select' => 'id, fullname, email',
		 			'table' => 'users',
		 			'where' => ['email' => $this->request->getVar('email'),'deleted_at' => 0],
		 		]);

		 		$otp = $this->otp();
		 		$otp_live = $this->otp_time();
		 		$mailbie = new MailBie();
		 		$otpTemplate = otp_template([
		 			'fullname' => $user['fullname'],
		 			'otp' => $otp,
		 		]);

		 		$flag = $mailbie->send([
		 			'to' => $user['email'],
		 			'subject' => 'Quên mật khẩu cho tài khoản: '.$user['email'],
		 			'messages' => $otpTemplate,
		 		]);

		 		$update = [
		 			'otp' => $otp,
		 			'otp_live' => $otp_live,
		 		];
		 		$countUpdate = $this->AutoloadModel->_update([
		 			'table' => 'users',
		 			'data' => $update,
		 			'where' => ['id' => $user['id']],
		 		]);

		 		if($countUpdate > 0 && $flag == true){
		 			return redirect()->to(BASE_URL.'backend/authentication/auth/verify?token='.base64_encode(json_encode($user)));
		 		}
	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}


		return view('backend/authentication/forgot', $this->data);
	}


	private function otp(){
		helper(['text']);
		$otp = random_string('numeric', 6);
		return $otp;
	}

	private function otp_time(){
		$timeToLive = gmdate('Y-m-d H:i:s', time() + 7*3600 + 300);
		return $timeToLive;
	}

}
