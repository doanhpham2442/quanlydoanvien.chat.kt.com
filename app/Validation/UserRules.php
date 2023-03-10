<?php
namespace App\Validation;
use App\Models\AutoloadModel;
use CodeIgniter\HTTP\RequestInterface;

class UserRules {

	protected $AutoloadModel;
	protected $user;
	protected $helper = ['mystring'];
	protected $request;

	public function __construct(){
		$this->AutoloadModel = new AutoloadModel();
		$this->request = \Config\Services::request();
		helper($this->helper);

	}

	public function checkAuth(string $password = '' ,string $email = ''): bool{
		$this->user = $this->AutoloadModel->_get_where([
			'table' => 'users',
			'select' => 'id, fullname, email, password, salt',
			// 'where' => [
			// 	'email' => $email,
			// 	// 'id_student' => $email,
			// 	'deleted_at' => 0
			// ],
			// 'query' => 'WHERE `email` = '.$email.' OR `id_student` = '.$email.' AND `deleted_at` = 0',
			'query' => '(`email` = "'.addslashes($email).'" OR `id_student` = "'.addslashes($email).'") AND `deleted_at` = 0',
		]);


		if(!isset($this->user) || is_array($this->user) == false || count($this->user) == 0){
			return false;
		}

		$passwordEncode = password_encode($password, $this->user['salt']);
		if($passwordEncode != $this->user['password']){
			return false;
		}

		return true;
	}

	public function check_pass($oldPass = 0, $id = ''): bool{

		$this->user = $this->AutoloadModel->_get_where([
			'table' => 'users',
			'select' => 'id, fullname, email,password, salt',
			'where' => ['id' => $id]
		]);
		$passwordEncode = password_encode($oldPass, $this->user['salt']);

		if(!isset($this->user) || is_array($this->user) == false || count($this->user) == 0){
			return false;
		}
		if($passwordEncode != $this->user['password']){
			return  false;
		}
		return true;
	}

	public function checkActive($password = '', $email = ''){
		$this->user = $this->AutoloadModel->_get_where([
			'table' => 'users',
			'select' => 'id, fullname, email, password, salt',
			// 'where' => ['email' => $email,'deleted_at' => 0,'publish' => 1],
			'query' => '(`email` = "'.addslashes($email).'" OR `id_student` = "'.addslashes($email).'") AND `deleted_at` = 0 AND `publish` = 1',
		]);

		if(!isset($this->user) || is_array($this->user) == false || count($this->user) == 0){
			return false;
		}

		return true;
	}

	public function check_email(string $email = ''){

		$count = $this->AutoloadModel->_get_where([
			'table' => 'users',
			'select' => 'id, fullname, email, password, salt',
			'where' => ['email' => $email,'deleted_at' => 0],
			'count' => TRUE,
		]);

		if($count == 0){
			return false;
		}

		return true;
	}

	public function check_email_member(string $email = ''){

		$count = $this->AutoloadModel->_get_where([
			'table' => 'member',
			'select' => 'id, fullname, email, password, salt',
			'where' => ['email' => $email,'deleted_at' => 0],
			'count' => TRUE,
		]);

		if($count == 0){
			return false;
		}

		return true;
	}

	public function check_otp(string $otp = ''){
		$token = $_GET['token'];
		$token = json_decode(base64_decode($token), TRUE);


		if(!isset($token) || is_array($token) == false || count($token) == 0){
			return false;
		}

		$user = $this->AutoloadModel->_get_where([
			'table' => 'users',
			'select' => 'otp, otp_live',
			'where' => ['id' => $token['id'],'deleted_at' => 0],
		]);

		$currentTime = gmdate('Y-m-d H:i:s', time() + 7*3600);

		if(strtotime($currentTime) > strtotime($user['otp_live'])){
			echo 2;die();
			return false;
		}

		if($user['otp'] != $otp){
			return false;
		}

		return true;

	}

	public function check_otp_member(string $otp = ''){
		$token = $_GET['token'];
		$token = json_decode(base64_decode($token), TRUE);

		if(!isset($token) || is_array($token) == false || count($token) == 0){
			return false;
		}

		$user = $this->AutoloadModel->_get_where([
			'table' => 'member',
			'select' => 'otp, otp_live',
			'where' => ['id' => $token['id'],'deleted_at' => 0],
		]);

		$currentTime = gmdate('Y-m-d H:i:s', time() + 7*3600);

		if(strtotime($currentTime) > strtotime($user['otp_live'])){
			return false;
		}

		if($user['otp'] != $otp){
			return false;
		}

		return true;

	}

	public function check_email_exist(string $email = ''){
		$emailOriginal = $this->request->getPost('email_original');
		$count = $this->AutoloadModel->_get_where([
			'table' => 'users',
			'select' => 'id',
			'where' => ['email' => $email,'deleted_at' => 0],
			'count' => TRUE,
		]);

		if($emailOriginal != $email){
			if($count > 0){
				return false;
			}
		}
		return true;
	}

	public function check_email_member_exist(string $email = ''){
		$emailOriginal = $this->request->getPost('email_original');
		$count = $this->AutoloadModel->_get_where([
			'table' => 'member',
			'select' => 'id',
			'where' => ['email' => $email,'deleted_at' => 0],
			'count' => TRUE,
		]);

		if($emailOriginal != $email){
			if($count > 0){
				return false;
			}
		}
		return true;
	}

}
