<?php
namespace App\Controllers\Ajax;
use App\Controllers\BaseController;

use App\Models\AutoloadModel;
use App\Libraries\Authentication as Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class User extends BaseController{
	protected $userService;
   	protected $userRepository;

	public function __construct(){
		$this->language = $this->currentLanguage();
      	$this->module = 'users';
		$this->userService = service('UserService',
			['language' => $this->language, 'module' => $this->module]
		);
		$this->userRepository = service('UserRepository', $this->module);
	}

    public function resetKey()
    {
        $id = $this->request->getPost('id');
        $update = $this->store();
		$flag = $this->AutoloadModel->_update([
            'table'=>'users',
            'data' => $update, 
            'where' => ['id' => $id, 'deleted_at' => 0]]);
        if($flag > 0){
            $data = "Reset mật khẩu thành công! <br> (Mật khẩu mặc định là 'dvkt@123')";
        }else{
            $data = "Reset mật khẩu thất bại!";
        }

        echo $data; die();
    }
    private function store(){
		helper('text');
		$salt = random_string('alnum', 168);
        $password = 'dvkt@123';

        $store['password'] = password_encode($password,$salt);
        $store['salt'] = $salt;
        $store['publish'] = 1;
		$store['updated_at'] = currentTime();
		$store['userid_updated'] = Auth::id();
		
		return $store;
	}




	public function delete_all(){
		$id = $this->request->getPost('id');
		$module = $this->request->getPost('module');
		$flag = $this->AutoloadModel->_update([
			'table' => $module,
			'data' => ['deleted_at' => 1],
			'where_in' => $id,
			'where_in_field' => 'id',
		]);
		echo $flag;die();
	}



	public function update_field(){
		$post['id'] = $this->request->getPost('id');
		$post['module'] = $this->request->getPost('module');
		$post['field'] = $this->request->getPost('field');
		$module = $post['module'];
		$object = $this->AutoloadModel->_get_where([
			'select' => 'id, '.$post['field'],
			'table' => $post['module'],
			'where' => ['id' => $post['id']],
		]);
		if(!isset($object) || is_array($object) == false || count($object) == 0){
			echo 0;
			die();
		}

		$_update[$post['field']] = (($object[$post['field']] == 1)?0:1);
		$flag = $this->AutoloadModel->_update([
			'data' => $_update,
			'table' => $post['module'],
			'where' => ['id' => $post['id']]
		]);
		echo json_encode([
			'flag' => $flag,
			'value' => $_update[$post['field']],
		]);
		die();
	}
	public function export_all(){
		// $page = $this->request->getGet('page');
		$union_position = $this->request->getGet('union_position');
		$gender = $this->request->getGet('gender');
		$faculty_id = $this->request->getGet('faculty_id');
		$class_id = $this->request->getGet('class_id');
		$keyword = $this->request->getGet('keyword');
		$user = $this->userService->excelAll();

		$fileName = 'DanhSachDoanVien-'.date('d-m-y-his').'.xlsx';  
		$spreadsheet = new Spreadsheet();
	
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'STT');
		$sheet->setCellValue('B1', 'Mã Sinh Viên');
		$sheet->setCellValue('C1', 'Họ và Tên');
		$sheet->setCellValue('D1', 'Ngày sinh');
		$sheet->setCellValue('E1', 'Giới tính');
		$sheet->setCellValue('F1', 'Dân Tộc');       
		$sheet->setCellValue('G1', 'Tôn giáo');       
		$sheet->setCellValue('H1', 'Quê quán');       
		$sheet->setCellValue('I1', 'Chi Đoàn');       
		$sheet->setCellValue('J1', 'Liên chi Đoàn');       
		$sheet->setCellValue('K1', 'Chức vụ');       
		$sheet->setCellValue('L1', 'Số điện thoại');       
		$sheet->setCellValue('M1', 'Email');       
		$rows = 2;
		
	
		foreach ($user['list'] as $key => $val){
			foreach(UNION_POSITION as $key1 => $val1){
				if($val['union_position'] == $key1){
				   $position = UNION_POSITION[$key1];
				}
			}
			$sheet->setCellValue('A' . $rows, $key+1);
			$sheet->setCellValue('B' . $rows, $val['id_student']);
			$sheet->setCellValue('C' . $rows, $val['fullname']);
			$sheet->setCellValue('D' . $rows, $val['birthday']);
			$sheet->setCellValue('E' . $rows, ($val['gender'] == 2) ? 'Nam' : 'Nữ');
			$sheet->setCellValue('F' . $rows, $val['name_ethnic']);
			$sheet->setCellValue('G' . $rows, $val['name_religion']);
			$sheet->setCellValue('H' . $rows, $val['countryside_address']." ,".$val['name_ward'].", ".$val['name_district'].", ".$val['name_city']);
			$sheet->setCellValue('I' . $rows, $val['name_class']);
			$sheet->setCellValue('J' . $rows, $val['name_faculty']);
			$sheet->setCellValue('K' . $rows, $position);
			$sheet->setCellValue('L' . $rows, $val['phone']);
			$sheet->setCellValue('M' . $rows, $val['email']);
			$rows++;
		} 
		$writer = new Xlsx($spreadsheet);
		$writer->save("upload/export-excel/".$fileName);
		$flag = "upload/export-excel/".$fileName;


		echo $flag;die();
	}
	public function export_select(){
		$id = $this->request->getPost('id');
		$user = $this->userRepository->exportSelect($id);

		$fileName = 'DanhSachDoanVien-'.date('d-m-y-his').'.xlsx';  
		$spreadsheet = new Spreadsheet();
	
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'STT');
		$sheet->setCellValue('B1', 'Mã Sinh Viên');
		$sheet->setCellValue('C1', 'Họ và Tên');
		$sheet->setCellValue('D1', 'Ngày sinh');
		$sheet->setCellValue('E1', 'Giới tính');
		$sheet->setCellValue('F1', 'Dân Tộc');       
		$sheet->setCellValue('G1', 'Tôn giáo');       
		$sheet->setCellValue('H1', 'Quê quán');       
		$sheet->setCellValue('I1', 'Chi Đoàn');       
		$sheet->setCellValue('J1', 'Liên chi Đoàn');       
		$sheet->setCellValue('K1', 'Chức vụ');       
		$sheet->setCellValue('L1', 'Số điện thoại');       
		$sheet->setCellValue('M1', 'Email');       
		$rows = 2;
		
	
		foreach ($user as $key => $val){
			foreach(UNION_POSITION as $key1 => $val1){
				if($val['union_position'] == $key1){
				   $position = UNION_POSITION[$key1];
				}
			}
			$sheet->setCellValue('A' . $rows, $key+1);
			$sheet->setCellValue('B' . $rows, $val['id_student']);
			$sheet->setCellValue('C' . $rows, $val['fullname']);
			$sheet->setCellValue('D' . $rows, $val['birthday']);
			$sheet->setCellValue('E' . $rows, ($val['gender'] == 2) ? 'Nam' : 'Nữ');
			$sheet->setCellValue('F' . $rows, $val['name_ethnic']);
			$sheet->setCellValue('G' . $rows, $val['name_religion']);
			$sheet->setCellValue('H' . $rows, $val['countryside_address']." ,".$val['name_ward'].", ".$val['name_district'].", ".$val['name_city']);
			$sheet->setCellValue('I' . $rows, $val['name_class']);
			$sheet->setCellValue('J' . $rows, $val['name_faculty']);
			$sheet->setCellValue('K' . $rows, $position);
			$sheet->setCellValue('L' . $rows, $val['phone']);
			$sheet->setCellValue('M' . $rows, $val['email']);
			$rows++;
		} 
		$writer = new Xlsx($spreadsheet);
		$writer->save("upload/export-excel/".$fileName);
		$flag = "upload/export-excel/".$fileName;


		echo $flag;die();
	}


}
