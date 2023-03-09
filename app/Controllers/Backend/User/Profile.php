<?php namespace App\Controllers\Backend\User;
use App\Controllers\BaseController;
use App\Models\AutoloadModel;
use App\Libraries\Mailbie;
use App\Libraries\Authentication as Auth;



class profile extends BaseController
{
	protected $data;
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'users';

	}

	public function profile($id = 0){
		$session = session();

		$id = (int)$id;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'id, fullname, phone, email, user_catalogue_id, birthday, gender, image',
			'table' => $this->data['module'],
			'where' => ['id' => $id, 'deleted_at' =>0],
		]);
		if($this->request->getPost('reset')){
			$validation = $this->validation_pass($this->data[$this->data['module']]);
			if($this->validate($validation['validate'],$validation['errorValidate'])){
				$update = $this->store();
				$flag = $this->AutoloadModel->_update(['table'=>$this->data['module'],'data' => $update, 'where' => ['id' => $id, 'deleted_at' =>0]]);
				if($flag > 0){

					$session = session();
					$session->setFlashdata('message-success', 'Cập nhật mật khẩu Thành Công');
					return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
				}	 
			}
			else{
				$this->data['validate'] = $this->validator->getErrors();
			}
		}

		$this->data['module'] = $this->data['module'];
		$this->data['template'] = 'backend/dashboard/common/profile';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function frontendChange($id = 0){
		$session = session();
		$id = json_decode($_COOKIE['QLDVKT_backend'], true)['id'];
		
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'id, fullname, phone, email, user_catalogue_id, birthday, gender,image',
			'table' => $this->data['module'],
			'where' => ['id' => $id, 'deleted_at' => 0 ],
		]);
		if(strlen($this->request->getPost('old-password')) > 0){
			$validation = $this->validation_pass($this->data[$this->data['module']]);
			if($this->validate($validation['validate'],$validation['errorValidate'])){
				$update = $this->store();
				$flag = $this->AutoloadModel->_update(['table'=>$this->data['module'],'data' => $update, 'where' => ['id' => $id, 'deleted_at' =>0]]);
				if($flag > 0){
					unset($_COOKIE[AUTH.'backend']);
					setcookie(AUTH.'backend', null, -1, '/');
					$session = session();
					$session->setFlashdata('message-success', 'Cập nhật mật khẩu Thành Công');
					return redirect()->to(BASE_URL);
				}	 
			}
			else{
				foreach ($this->validator->getErrors() as $key => $val) {
					$session->setFlashdata('message-danger', $val);
					break;
				}
				$this->data['validate'] = $this->validator->getErrors();
				return redirect()->to(BASE_URL);
			}
		}else{
			$session->setFlashdata('message-danger', 'Chưa nhập mật khẩu cũ');
			return redirect()->to(BASE_URL);
		}

		return view(BASE_URL);
		
	}

	private function validation_pass($user = ''){
		$validate = [
			'old-password' => 'check_pass['.$user['id'].']',
			'password' => 'required|min_length[6]',
			're_password' => 'required|matches[password]',

		];
		$errorValidate = [
			'old-password' => [
				'check_pass' => 'Nhập sai mật khẩu cũ!'
			],
			'password' => [
				'required' => 'Chưa nhập mật khẩu mới!',
				'min_length' => 'Mật khẩu mới chưa đạt độ dài tối thiểu!',
			],
			're_password' => [
				'required' => 'Chưa nhập lại mật khẩu mới!',
				'matches' => 'Mật khẩu nhập lại chưa trùng khớp!',
			],
		];

		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate
		];
	}


	private function store(){
		helper('text');
		$salt = random_string('alnum', 168);
		if($this->request->getPost('reset') ){
			$store['password'] = password_encode($this->request->getPost('password'),$salt);
			$store['salt'] = $salt;
			$store['publish'] = 1;
		}
		$store['updated_at'] = currentTime();
		$store['userid_updated'] = Auth::id();
		
		return $store;
	}
}
