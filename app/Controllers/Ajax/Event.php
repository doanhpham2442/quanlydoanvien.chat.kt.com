<?php
namespace App\Controllers\Ajax;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Event extends BaseController{

	protected $authentication;
	protected $language;
	protected $eventService;
	protected $eventRepository;

	public function __construct(){
		$this->language = $this->currentLanguage();
		$this->semesterRepository = service('semesterRepository', 'semesters');
		$this->semesterService = service('SemesterService',
        	['language' => 2, 'module' => 'semesters']
     	);
		 $this->module = 'events';
		 $this->eventService = service('EventService',
			['language' => $this->language, 'module' => $this->module]
		 );
		$this->eventRepository = service('eventRepository', $this->module);

	}

	public function check_event(){
		$id = $this->request->getPost('id');
		$field = $this->request->getPost('field');
		$where = $this->request->getPost('where');
		$object = $this->AutoloadModel->_get_where([
			'select' => 'id, '.$field,
			'table' => 'event_user',
			'where' => ['id' => $id],
		]);
		if(!isset($object) || is_array($object) == false || count($object) == 0){
			echo 0;
			die();
		}
		if($this->request->getPost('note')){
			$_update['note_reviewer'] = $this->request->getPost('note');
		}
		$_update[$field] = $where;
		$flag = $this->AutoloadModel->_update([
			'data' => $_update,
			'table' => 'event_user',
			'where' => ['id' => $id]
		]);
		
		echo $where;
		die();
	}
	public function get_semester(){
		$post = $this->request->getPost('param');
		$data = $this->semesterRepository->findByField($post['id'], 'tb1.id');


		$object = $this->AutoloadModel->_get_where([
			'select' => $post['select'],
			'table' => $post['table'].' as tb1',
			'where' => [
				'parentid' => $post['id'],
			],

			 'query' => '
			 tb1.id IN (
				SELECT pc.id
				FROM '.$post['table'].' as pc
				WHERE pc.lft >= '.$data['lft'].' AND pc.rgt <= '.$data['rgt'].'
			 )
		  ',
			'order_by' => 'title asc'
		], TRUE);
		// pre($object);
		


		$html = '<option value="0">'.$post['text'].'</option>';
		if(isset($object) && is_array($object) && count($object)){
			foreach($object as $key => $val){
				$html = $html . '<option value="'.$val['id'].'">'.$val['title'].'</option>';
			}
		}
		echo json_encode([
			'html' => $html
		]); die();
	}

	public function export_all(){
		
		$semester_1_id = $this->request->getGet('semester_1_id');
		$semester_2_id = $this->request->getGet('semester_2_id');
		$faculty_id = $this->request->getGet('faculty_id');
		$class_id = $this->request->getGet('class_id');
		$keyword = $this->request->getGet('keyword');
		$user = $this->eventService->excelAll();

		$fileName = 'DiemRenLuyen-'.date('d-m-y-his').'.xlsx';  
		$spreadsheet = new Spreadsheet();
	
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'STT');
		$sheet->setCellValue('B1', 'M?? Sinh Vi??n');
		$sheet->setCellValue('C1', 'H??? v?? T??n');
		$sheet->setCellValue('D1', 'Ng??y sinh');
		$sheet->setCellValue('E1', 'Gi???i t??nh');
		$sheet->setCellValue('F1', 'Chi ??o??n');       
		$sheet->setCellValue('G1', 'Li??n chi ??o??n');       
		$sheet->setCellValue('H1', 'Ch???c v???');       
		$sheet->setCellValue('I1', 'S??? ho???t ?????ng tham gia');       
		$sheet->setCellValue('J1', 'T???ng s??? ??i???m theo ho???t ?????ng');       
		$sheet->setCellValue('K1', 'S??? ??i???m t???i ??a');       
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
			$sheet->setCellValue('E' . $rows, ($val['gender'] == 2) ? 'Nam' : 'N???');
			$sheet->setCellValue('F' . $rows, $val['name_class']);
			$sheet->setCellValue('G' . $rows, $val['name_faculty']);
			$sheet->setCellValue('H' . $rows, $position);
			$sheet->setCellValue('I' . $rows, $val['count_event']);
			$sheet->setCellValue('J' . $rows, $val['sum_score']);
			$sheet->setCellValue('K' . $rows, ($val['sum_score'] > 15)? '15' : $val['sum_score']);
			$rows++;
		} 
		$writer = new Xlsx($spreadsheet);
		$writer->save("upload/export-excel/".$fileName);
		$flag = "upload/export-excel/".$fileName;


		echo $flag;die();
	}
	public function export_select(){
		
		$id = $this->request->getPost('id');
		$user = $this->eventRepository->exportSelect($id);

		$fileName = 'DiemRenLuyen-'.date('d-m-y-his').'.xlsx';  
		$spreadsheet = new Spreadsheet();
	
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'STT');
		$sheet->setCellValue('B1', 'M?? Sinh Vi??n');
		$sheet->setCellValue('C1', 'H??? v?? T??n');
		$sheet->setCellValue('D1', 'Ng??y sinh');
		$sheet->setCellValue('E1', 'Gi???i t??nh');
		$sheet->setCellValue('F1', 'Chi ??o??n');       
		$sheet->setCellValue('G1', 'Li??n chi ??o??n');       
		$sheet->setCellValue('H1', 'Ch???c v???');       
		$sheet->setCellValue('I1', 'S??? ho???t ?????ng tham gia');       
		$sheet->setCellValue('J1', 'T???ng s??? ??i???m theo ho???t ?????ng');       
		$sheet->setCellValue('K1', 'S??? ??i???m t???i ??a');       
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
			$sheet->setCellValue('E' . $rows, ($val['gender'] == 2) ? 'Nam' : 'N???');
			$sheet->setCellValue('F' . $rows, $val['name_class']);
			$sheet->setCellValue('G' . $rows, $val['name_faculty']);
			$sheet->setCellValue('H' . $rows, $position);
			$sheet->setCellValue('I' . $rows, $val['count_event']);
			$sheet->setCellValue('J' . $rows, $val['sum_score']);
			$sheet->setCellValue('K' . $rows, ($val['sum_score'] > 15)? '15' : $val['sum_score']);
			$rows++;
		} 
		$writer = new Xlsx($spreadsheet);
		$writer->save("upload/export-excel/".$fileName);
		$flag = "upload/export-excel/".$fileName;


		echo $flag;die();
	}
}
