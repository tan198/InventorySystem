<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv as WriterCsv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Expenditure extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        $current_lang = $this->session->userdata('site_lang');

        if (!$current_lang || $current_lang == 'english') {
            $this->lang->load('form_validation', 'english');
            $this->lang->load('content_lang','english');
            
        } 
        elseif ($current_lang == 'vietnam') {
            $this->lang->load('content_lang','vietnam');
            $this->lang->load('form_validation', 'vietnam');
        }
        
        $this->data['page_title'] =  $this->lang->line('Expenditure');

		$this->load->model('model_expenditure');
        $this->load->model('model_category');
		$this->load->model('model_fund');
        $this->load->model('model_materials');
        $this->load->model('model_tmaterial');
        $this->load->model('model_users');
        $this->load->model('model_supplier');
        $this->load->model('model_namecategory');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->render_template('expenditure/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
    public function fetchExpenditureData()
	{
		$result = array('data' => array());

		$data = $this->model_expenditure->getExpenditureData();


		foreach ($data as $key => $value) {

            $date_expenditure = date('d/m/Y',  strtotime($value['ngayChi']));
            $category_data = $this -> model_category->getCategoryData($value['idHangMuc']);
            $fund_data = $this -> model_fund->getFundData($value['idTaiKhoan']);
            $material_id = $this->model_expenditure->getMaterialItemData($value['idBangChi']);

            $material_status = $value['materialStatus'];
            if($material_id && $value['nguoiNhan'] == 0){
                $material_status = '<span class="label label-success">Yes</span>';
                $this->model_expenditure->updateMaterialStatus($value['idBangChi'],1);
            }elseif($material_id == 0 && $value['nguoiNhan'] == 0){
                $material_status = '<span class="label label-warning">No</span>';
                $this->model_expenditure->updateMaterialStatus($value['idBangChi'],0);
            }elseif($value['nguoiNhan'] && $material_id == 0){
                $material_status = $this->model_expenditure->updateMaterialStatus($value['idBangChi'],null);
            }

            //phân loại khoản chi tạm ứng, mua vật tư, các loại chi khác

            $typeother = $value['phanloai'];
            $type_expenditure = $value['typeExp'];
            if($material_status == null && $typeother == null){
                $this->model_expenditure->updateTypeExpenditure($value['idBangChi'],1);
                $type_expenditure = '<span class="label label-default">Advances</span>';
            } elseif($material_status == null && $typeother != null){
                $this->model_expenditure->updateTypeExpenditure($value['idBangChi'],3);
                $type_expenditure = '<span class="label label-primary">Others Expenditure</span>';
            }else{
                $this->model_expenditure->updateTypeExpenditure($value['idBangChi'],2);
                $type_expenditure = '<span class="label label-info">Buy Material</span>';
            }

            //phân loại tên người nhận và nhà cung cấp
            
            $receiver_name = '';
            if($material_status != null){
                $receiver = $this->model_supplier->getSupplierData($value['nguoiNhan']);
              
                $receiver_name = isset($receiver['name']) ? $receiver['name'] : '';
            }else{
                $receiver = $this->model_users->getUserData($value['nguoiNhan']) ;

                $firstname = isset($receiver['firstname']) ? $receiver['firstname'] : '';
                $lastname = isset($receiver['lastname']) ? $receiver['lastname'] : '';
    
                $receiver_name = trim($firstname . ' ' . $lastname);
            }



			// button
            $buttons = '';
            if($material_status == null && $typeother == null){
                if(in_array('updateAdvances',  $this->permission)){
                    $buttons .= '<a href="'.base_url('advances/update/'.$value['idBangChi']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
                }

            }elseif($material_status == null && $typeother != null){
                if(in_array('updateOtherExpenditure',  $this->permission)){
                    $buttons .= '<a href="'.base_url('otherexpenditure/update/'.$value['idBangChi']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
                }
            }else{
                if(in_array('updateExpenditure', $this->permission)) {
                    $buttons .= '<a href="'.base_url('expenditure/update/'.$value['idBangChi']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
                }
            }
            if(in_array('deleteExpenditure', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idBangChi'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            //$currency_unit = number_format((float)$value['soTienThu'],2,'.',','); 

			$result['data'][$key] = array(
                'idBangChi' => $value['idBangChi'],
                'typeExp'=> $type_expenditure,
                'nguoiNhan'=>$receiver_name,
                'idTaiKhoan'=>$fund_data['tenTaiKhoan'],
				'ngayChi'=>$date_expenditure,
                'tongTien'=>$value['tongTien'],
				'action'=>$buttons
			);
		} 
    
		echo json_encode($result);
	}

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage page
    */
	public function create()
	{
		if(!in_array('createExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('supplier', $this->lang->line('Supplier'), 'trim|required');
		$this->form_validation->set_rules('expenditurecategory', $this->lang->line('Expenditure Category'), 'required');
		$this->form_validation->set_rules('date_expenditure', 'Date expenditure', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim');
        $this->form_validation->set_rules('material_status', 'Material Status', 'required');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
            $user_id = $this->session->userdata('id');
        	$data = array(
                'nguoiChi' => $user_id,
                //'typeExp' =>  $this->input->post('typeExp'),
        		'nguoiNhan' => $this->input->post('supplier'),
        		'idHangMuc' => $this->input->post('expenditurecategory'),
                'tenHangMuc' => $this->input->post('name_expenditure'),
                'materialStatus' => $this->input->post('material_status'),
        		'ngayChi' => $this->input->post('date_expenditure'),
        		'soTien' => $this->input->post('tamount'),
                'tongTien' => $this->input->post('amountt_value'),
        		'idTaiKhoan' => $this->input->post('fund'),
                'ghiChu'=> $this->input->post('note_expenditure'),
        	);
            $data1 = array();

            $material_name = $this->input->post('material_name');
            $type_material = $this->input->post('type_material');
            $qty = $this->input->post('quantity');
            $rate = $this->input->post('rate');
            
            
            for ($i = 0; $i < count($material_name); $i++) {
                $data1[] = array(
                    'tenVatTu' => $material_name[$i],
                    'loaiVatTu' => $type_material[$i],
                    'soLuong' => $qty[$i],
                    'giaTien' => $rate[$i]
                );
            }
                if($data['materialStatus'] == 1){

                    $create = $this->model_expenditure->create1($data,$data1);
                    if($create == true ) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('expenditure/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('expenditure/create', 'refresh');
                    }
                }else{
                    $create1 = $this->model_expenditure->create($data);
                    if($create1 == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('expenditure/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('expenditure/create/', 'refresh');
                    }
                }
            
            }else{
        
			$this->data['category'] = $this->model_category->getCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();
            $this->data['supplier'] = $this->model_supplier->getSupplierData();  
            $this->data['materials'] = $this->model_materials->getMaterialsData();
            $this->data['users'] = $this->model_users->getUserData();
            $this->data['tmaterial'] = $this->model_tmaterial->getTmaterialData();
            $this->data['namecate'] = $this->model_namecategory->getNameCategory();
            $this->render_template('expenditure/create', $this->data);
        }
	}

    public function getMaterialName($idBangChi) {
        // Kiểm tra nếu không có idBangChi, trả về thông báo lỗi hoặc giá trị mặc định
        if (!$idBangChi) {
            echo json_encode(array('tenVatTu' => 'Material not found'));
            return;
        }
    
        $material_info = $this->model_expenditure->getMaterialInfo($idBangChi);
        $materialName = null;
    
        foreach ($material_info as $v) {
            $materialName[] = $v['tenVatTu'];
            //$note[] = nl2br($v['ghiChu']);
        }
    
        echo json_encode(array('tenVatTu' => $materialName));
    }

    public function getNoteExpenditureData($idBangChi){
        if (!$idBangChi) {
            echo json_encode(array('ghiChu' => 'Note not found'));
            return;
        }
        
        $expenditure_data = $this->model_expenditure->getNoteExpenditure1($idBangChi);
        $note = null;

        foreach($expenditure_data as $v){
            $materialname[] = $v['tenVatTu'];
            $note[0] = nl2br($v['ghiChu']);
        }

        echo json_encode(array('ghiChu' => $note, 'tenVatTu'=> $materialname));
    }
    
    public function getMaterialValueById(){
        $idVatTu  = $this->input->post('idVatTu');
        if($idVatTu){
            $material_data = $this->model_materials->getMaterialsData($idVatTu);
            echo json_encode($material_data);
        }
    }

	public function update($id)
	{      
        if(!in_array('updateExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('payer_name', 'Payer name', 'trim|required');
		$this->form_validation->set_rules('expenditurecategory', 'Expenditurecategory', 'required');
        $this->form_validation->set_rules('name_expenditure', 'Name Expenditure', 'trim|required');
		$this->form_validation->set_rules('date_expenditure', 'Date expenditure', 'required');
        $this->form_validation->set_rules('material_status', 'Material Status', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('tamount', 'Amount', 'trim');
        $this->form_validation->set_rules('amountt', 'Amountt','trim');
        //$this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|callback_quantity_require');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
        		'nguoiChi' => $this->input->post('payer_name'),
        		'idHangMuc' => $this->input->post('expenditurecategory'),
                'tenHangMuc' => $this->input->post('name_expenditure'),
                'materialStatus' => $this->input->post('material_status'),
        		'ngayChi' => $this->input->post('date_expenditure'),
        		'soTien' => $this->input->post('tamount'),
                'tongTien' => $this->input->post('amountt_value'),
        		'idTaiKhoan' => $this->input->post('fund'),
                'ghiChu'=> $this->input->post('note_expenditure')
        	);

            if($data['materialStatus'] == 1){
                $update = $this->model_expenditure->update($id, $data);
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect('expenditure/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('expenditure/update/'.$id, 'refresh');
                }
            }else{
                $update1 = $this->model_expenditure->update1($id,$data);
                if($update1 == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect('expenditure/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('expenditure/update/'.$id, 'refresh');
                }
            }
        }
        else {
            // false case
            $result = array();
            $expenditure_data = $this->model_expenditure->getExpenditureData($id);
            $result['expenditures'] = $expenditure_data;
            $materials_item = $this->model_expenditure->getMaterialItemData($expenditure_data['idBangChi']);

            foreach($materials_item as $k => $v){
                $result['material_item'][] = $v;
            }

            $this->data['expenditure_data'] = $result;
            $this->data['material'] = $this->model_materials->getMaterialsData();
            $this->data['category'] = $this->model_category->getCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();
            $this->data['supplier'] = $this->model_supplier->getSupplierData();
            $this->data['tmaterial'] = $this->model_tmaterial->getTmaterialData();
            $this->data['namecate'] = $this->model_namecategory->getNameCategory();
            $this->render_template('expenditure/edit', $this->data); 
        }   
	}

    /*x
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $idBangChi = $this->input->post('idBangChi');

        $response = array();
        if($idBangChi) {
            $delete = $this->model_expenditure->remove($idBangChi);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the expenditure information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

    public function removeMaterial($idVatTu){

        if($idVatTu){
            $deleteRow = $this->model_expenditure->removeMaterial($idVatTu);
            var_dump($deleteRow);
        }
        echo json_encode($deleteRow);
    }

    public function exportexcel(){
        $this->load->model('model_expenditure');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'font' => [
                'name' => 'Time New Roman',
                'size' => 12,
                'color' => ['rgb' => '000000'], // Mã màu RGB
            ],
        ];
        
        $sheet->getStyle('A1:H1')->applyFromArray($styleArray);
    
        $sheet->setCellValue('A1','Hạng Mục Chi');
        $sheet->setCellValue('B1','Tên Hạng Mục');
        $sheet->setCellValue('C1','Ghi Chú');
        $sheet->setCellValue('D1','Trạng Thái Vật Tư');
        $sheet->setCellValue('E1','Tài Khoản');
        $sheet->setCellValue('F1','Người Chi');
        $sheet->setCellValue('G1','Ngày Chi');
        $sheet->setCellValue('H1','Tổng Tiền');
    
        $info = $this->model_expenditure->getExportExcel();
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
            $sheet->setCellValue('F'.$x, is_string($row['NguoiChi']) ? mb_convert_encoding($row['NguoiChi'], 'UTF-8', 'UTF-8') : $row['NguoiChi']);
            $sheet->setCellValue('G'.$x, is_string($row['NgayChi']) ? mb_convert_encoding($row['NgayChi'], 'UTF-8', 'UTF-8') : $row['NgayChi']);
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
        $fileName = "Bang_Chi_export.csv";
        $writer->setUseBOM(true);
        $writer->setOutputEncoding('UTF-8');
    
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        $writer->save('php://output');
        exit;
    }    
    
}