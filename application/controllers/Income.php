<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv as WriterCsv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Income extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Income';

		$this->load->model('model_income');
        $this->load->model('model_category');
		$this->load->model('model_fund');
        $this->load->model('model_materials');
        $this->load->library('form_validation');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewIncome', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->render_template('income/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchIncomeData()
	{
		$result = array('data' => array());

		$data = $this->model_income->getIncomeData();

		foreach ($data as $key => $value) {
            
            $date_income = date('d/m/Y',  strtotime($value['ngayThu']));
            $incomecategory_data = $this -> model_category->getCategoryData($value['idHangMuc']);
            $fund_data = $this -> model_fund->getFundData($value['idTaiKhoan']);
            //$material = $this->model_expenditure1->getMaterialItemData($value['idVatTu']);
			// button
            $buttons = '';
            if(in_array('updateIncome', $this->permission)) {
    			$buttons .= '<a href="'.base_url('income/update/'.$value['idBangThu']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteIncome', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idBangThu'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $material_status = ($value['materialStatus'] == "1") ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>';
            //$currency_unit = number_format((float)$value['soTienThu'],2,'.',','); 

			$result['data'][$key] = array(
                'idBangThu' => $value['idBangThu'],
                'idHangMuc'=>$incomecategory_data['loaiHangMuc'],
                'tenHangMuc'=>$value['tenHangMuc'],
                'materialStatus'=>$material_status,
                'idTaiKhoan'=>$fund_data['tenTaiKhoan'],
				'nguoiThu'=>$value['nguoiThu'],
                //$material['tenVatTu'],
				'ngayThu'=>$date_income,
                'soTienThu'=>$value['soTienThu'],
                'tongTien'=>$value['tongTien'],
                
				'action'=>$buttons
			);
		} // /foreach
    
		echo json_encode($result);
	}

    public function fetchDataIncomeDetails(){
        $result = array('data' => array());
        $data = $this->model_income->getIncomeData();
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createIncome', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('receiver_name', 'Receiver name', 'trim|required');
		$this->form_validation->set_rules('incomecategory', 'Incomecategory', 'required');
        $this->form_validation->set_rules('name_income', 'Name Income', 'trim|required');
		$this->form_validation->set_rules('date_income', 'Date income', 'required');
        $this->form_validation->set_rules('material_status', 'Material Status', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('tamount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('amountt', 'Amountt','trim');
        $this->form_validation->set_rules('material[]', 'Material Name', 'trim|callback_material_require');
        $this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|callback_quantity_require');
        
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'nguoiThu' => $this->input->post('receiver_name'),
        		'idHangMuc' => $this->input->post('incomecategory'),
                'tenHangMuc' => $this->input->post('name_income'),
                'materialStatus' => $this->input->post('material_status'),
        		'ngayThu' => $this->input->post('date_income'),
                'ghiChu' => $this->input->post('note_income'),
        		'soTienThu' => $this->input->post('tamount'),
                'tongTien' => $this->input->post('amountt_value'),
        		'idTaiKhoan' => $this->input->post('fund'),
        	);

                if($data['materialStatus'] === 0){
                    $create1 = $this->model_income->create1($data);
                    if($create1 == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('income/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('income/create', 'refresh');
                    }
                }else{
                    $create = $this->model_income->create($data);
                    if($create == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('income/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('income/create/', 'refresh');
                    }
                }
            
            }else{
        
			$this->data['incomecategory'] = $this->model_category->getCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();  
            $this->data['materials'] = $this->model_materials->getMaterialsData();      	    	

            $this->render_template('income/create', $this->data);
        }	
	}

    public function material_require($value){
        $material_status = $this->input->post('material_status');

        // Check if material_status is '1' and material is empty
        if ($material_status == '1' && empty($value)) {
            $this->form_validation->set_message('material_require', 'The Material field is required when Material Status is Yes.');
            return false;
        }

        return true;
    }

    public function quantity_require(){
        $this->load->model('model_materials');
        $count_material = count($this->input->post('material'));
        for($i=0; $i < $count_material; $i++){
            $materialid = $this->input->post('material')[$i];
            $inputqty = $this->input->post('quantity')[$i];
            $material_data = $this->model_materials->getMaterialsData($materialid);
        }

        if($material_data['soLuong'] < $inputqty || $material_data['soLuong'] === 0){
            $this->form_validation->set_message('quantity_require','The Quantity you entered is more than what we have in stock.');
            return false;
        }

        return true;
    }

    public function getMaterialValueById(){
        $idVatTu  = $this->input->post('idVatTu');
        if($idVatTu){
            $material_data = $this->model_materials->getMaterialsData($idVatTu);
            echo json_encode($material_data);
        }
    }

    public function getTableMaterialRow(){
        $materials = $this->model_materials->getMaterialsData();
        echo json_encode($materials);
    }
    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	
    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */

	public function update($id)
	{      
        if(!in_array('updateIncome', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('receiver_name', 'Receiver name', 'trim|required');
		$this->form_validation->set_rules('incomecategory', 'Incomecategory', 'required');
        $this->form_validation->set_rules('name_income', 'Name income', 'trim|required');
		$this->form_validation->set_rules('date_income', 'Date income', 'required');
        $this->form_validation->set_rules('material_status', 'Material Status', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('tamount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('amountt', 'Amountt','trim');
        $this->form_validation->set_rules('material[]', 'Material Name', 'trim|callback_material_require');
        $this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|callback_quantity_require');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
        		'nguoiThu' => $this->input->post('receiver_name'),
        		'idHangMuc' => $this->input->post('incomecategory'),
                'tenHangMuc' => $this->input->post('name_income'),
                'materialStatus' => $this->input->post('material_status'),
                'ghiChu' => $this->input->post('note_income'),
        		'ngayThu' => $this->input->post('date_income'),
        		'soTienThu' => $this->input->post('tamount'),
                'tongTien' => $this->input->post('amountt_value'),
        		'idTaiKhoan' => $this->input->post('fund'),
        	);
            $update = $this->model_income->update($id, $data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('income/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('income/update/'.$id, 'refresh');
            }
        }
        else {
            // false case
            $result = array();
            $income_data = $this->model_income->getIncomeData($id);
            $result['incomes'] = $income_data;
            $materials_item = $this->model_income->getMaterialItemData($income_data['idBangThu']);

            foreach($materials_item as $k => $v){
                $result['materialic_item'][] = $v;
            }

            $this->data['income_data'] = $result;
            $this->data['material'] = $this->model_materials->getMaterialsData();
            $this->data['incomecategory'] = $this->model_category->getCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData(); 
            $this->render_template('income/edit', $this->data); 
        }   
	}

    /*x
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteIncome', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $idBangThu = $this->input->post('idBangThu');

        $response = array();
        if($idBangThu) {
            $delete = $this->model_income->remove($idBangThu);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

    public function getMaterialName($idBangThu) {
        // Kiểm tra nếu không có idBangChi, trả về thông báo lỗi hoặc giá trị mặc định
        if (!$idBangThu) {
            echo json_encode(array('tenVatTu' => 'Material not found'));
            return;
        }
    
        $material_info = $this->model_income->getMaterialInfo($idBangThu);
        $materialName = null;
    
        foreach ($material_info as $v) {
            $materialName[] = $v['tenVatTu'];
        }
    
        echo json_encode(array('tenVatTu' => $materialName));
    }

    public function getNoteIncomeData($idBangThu){
        if (!$idBangThu) {
            echo json_encode(array('ghiChu' => 'Note not found'));
            return;
        }
        
        $income_data = $this->model_income->getNoteIncome($idBangThu);
        $note = null;

        foreach($income_data as $v){
            $note[] = nl2br($v['ghiChu']);
        }
        echo json_encode(array('ghiChu' => $note));
    }


    public function exportexcel(){
        $this->load->model('model_income');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $sheet->setCellValue('A1','Hạng Mục Thu');
        $sheet->setCellValue('B1','Tên Hạng Mục');
        $sheet->setCellValue('C1','Ghi Chú');
        $sheet->setCellValue('D1','Trạng Thái Vật Tư');
        $sheet->setCellValue('E1','Tài Khoản');
        $sheet->setCellValue('F1','Người Chi');
        $sheet->setCellValue('G1','Ngày Chi');
        $sheet->setCellValue('H1','Tổng Tiền');
    
        $info = $this->model_income->getExportExcel();
        //print_r($info);
        $x = 2;
        foreach($info as $row){
            // Check if the value is a string before using mb_convert_encoding
            $sheet->setCellValue('A'.$x, is_string($row['tenHangMuc']) ? mb_convert_encoding($row['tenHangMuc'], 'UTF-8', 'UTF-8') : $row['tenHangMuc']);
            $sheet->setCellValue('B'.$x, is_string($row['tenCuaHangMuc']) ? mb_convert_encoding($row['tenCuaHangMuc'], 'UTF-8', 'UTF-8') : $row['tenCuaHangMuc']);
            $sheet->setCellValue('C'.$x, is_string($row['ghiChu']) ? mb_convert_encoding($row['ghiChu'], 'UTF-8', 'UTF-8') : $row['ghiChu']);
            
            $valueToSet = $row['MaterialStatus'] == 1 ? 'Có' : 'Không';
            $sheet->setCellValue('D'.$x, is_string($valueToSet) ? mb_convert_encoding($valueToSet, 'UTF-8', 'UTF-8') : $valueToSet);
            $sheet->setCellValue('E'.$x, is_string($row['TK']) ? mb_convert_encoding($row['TK'], 'UTF-8', 'UTF-8') : $row['TK']);
            $sheet->setCellValue('F'.$x, is_string($row['NguoiThu']) ? mb_convert_encoding($row['NguoiThu'], 'UTF-8', 'UTF-8') : $row['NguoiThu']);
            $sheet->setCellValue('G'.$x, is_string($row['NgayThu']) ? mb_convert_encoding($row['NgayThu'], 'UTF-8', 'UTF-8') : $row['NgayThu']);
            $sheet->setCellValue('H'.$x, $row['TongTien']);
            $x++;
        }
    
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
    
        $writer = new WriterCsv($spreadsheet);
        $fileName = "Bang_Thu_export.csv";
        $writer->setUseBOM(true);
        $writer->setOutputEncoding('UTF-8');
    
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        $writer->save('php://output');
        exit;
    } 

}