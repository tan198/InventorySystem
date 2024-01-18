<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure1 extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Expenditure';

		$this->load->model('model_expenditure1');
        $this->load->model('model_expenditurecategory');
		$this->load->model('model_fund');
        $this->load->model('model_materials');
        $this->load->library('form_validation');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewExpenditure1', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->render_template('expenditure1/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchExpenditureData1()
	{
		$result = array('data' => array());

		$data = $this->model_expenditure1->getExpenditureData1();

		foreach ($data as $key => $value) {
            //var_dump($material_info);
            $date_expenditure = date('d/m/Y',  strtotime($value['ngayChi']));
            $expenditurecategory_data = $this -> model_expenditurecategory->getExpenditureCategoryData($value['idHangMucChi']);
            $fund_data = $this -> model_fund->getFundData($value['idTaiKhoan']);
            //$material = $this->model_expenditure1->getMaterialItemData($value['idVatTuChi']);
			// button
            $buttons = '';
            if(in_array('updateExpenditure1', $this->permission)) {
    			$buttons .= '<a href="'.base_url('expenditure1/update/'.$value['idBangChi']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteExpenditure1', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idBangChi'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $material_status = ($value['materialStatus'] == "1") ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>';
            //$currency_unit = number_format((float)$value['soTienThu'],2,'.',','); 

			$result['data'][$key] = array(
                'idBangChi' => $value['idBangChi'],
                'idHangMucChi'=>$expenditurecategory_data['tenHangMucChi'],
                'tenHangMuc'=>$value['tenHangMuc'],
                'materialStatus'=>$material_status,
                'idTaiKhoan'=>$fund_data['tenTaiKhoan'],
				'nguoiChi'=>$value['nguoiChi'],
				'ngayChi'=>$date_expenditure,
                'soTien'=>$value['soTien'],
                'tongTien'=>$value['tongTien'],
				'action'=>$buttons
			);
		} // /foreach
    
		echo json_encode($result);
	}


    public function getMaterialName($idBangChi) {
        // Kiểm tra nếu không có idBangChi, trả về thông báo lỗi hoặc giá trị mặc định
        if (!$idBangChi) {
            echo json_encode(array('tenVatTu' => 'Material not found'));
            return;
        }
    
        $material_info = $this->model_expenditure1->getMaterialInfo($idBangChi);
        $materialName = null;
    
        foreach ($material_info as $v) {
            $materialName[] = $v['tenVatTu'];
        }
    
        echo json_encode(array('tenVatTu' => $materialName));
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createExpenditure1', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('payer_name', 'Payer name', 'trim|required');
		$this->form_validation->set_rules('expenditurecategory', 'Expenditurecategory', 'required');
        $this->form_validation->set_rules('name_expenditure', 'Name Expenditure', 'trim|required');
		$this->form_validation->set_rules('date_expenditure', 'Date expenditure', 'required');
        $this->form_validation->set_rules('material_status', 'Material Status', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('tamount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('amountt', 'Amountt','trim');
        $this->form_validation->set_rules('material[]', 'Material Name', 'trim|callback_material_require');
        $this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|callback_quantity_require');
        
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'nguoiChi' => $this->input->post('payer_name'),
        		'idHangMucChi' => $this->input->post('expenditurecategory'),
                'tenHangMuc' => $this->input->post('name_expenditure'),
                'materialStatus' => $this->input->post('material_status'),
        		'ngayChi' => $this->input->post('date_expenditure'),
        		'soTien' => $this->input->post('tamount'),
                'tongTien' => $this->input->post('amountt_value'),
        		'idTaiKhoan' => $this->input->post('fund'),
        	);

           

                if($data['materialStatus'] == 1){
                    $create1 = $this->model_expenditure1->create1($data);
                    if($create1 == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('expenditure1/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('expenditure1/create', 'refresh');
                    }
                }else{
                    $create = $this->model_expenditure1->create($data);
                    if($create == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('expenditure1/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('errors', 'Error occurred!!');
                        redirect('expenditure1/create/', 'refresh');
                    }
                }
            
            }else{
        
			$this->data['expenditurecategory'] = $this->model_expenditurecategory->getExpenditureCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();  
            $this->data['materials'] = $this->model_materials->getMaterialsData();      	    	

            $this->render_template('expenditure1/create', $this->data);
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
        $idVatTuChi  = $this->input->post('idVatTuChi');
        if($idVatTuChi){
            $material_data = $this->model_materials->getMaterialsData($idVatTuChi);
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
        if(!in_array('updateExpenditure1', $this->permission)) {
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
		$this->form_validation->set_rules('tamount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('amountt', 'Amountt','trim');
        $this->form_validation->set_rules('material[]', 'Material Name', 'trim|callback_material_require');
        //$this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|callback_quantity_require');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
        		'nguoiChi' => $this->input->post('payer_name'),
        		'idHangMucChi' => $this->input->post('expenditurecategory'),
                'tenHangMuc' => $this->input->post('name_expenditure'),
                'materialStatus' => $this->input->post('material_status'),
        		'ngayChi' => $this->input->post('date_expenditure'),
        		'soTien' => $this->input->post('tamount'),
                'tongTien' => $this->input->post('amountt_value'),
        		'idTaiKhoan' => $this->input->post('fund'),
        	);
            $update = $this->model_expenditure1->update($id, $data);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('expenditure1/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('expenditure1/update/'.$id, 'refresh');
            }
        }
        else {
            // false case
            $result = array();
            $expenditure_data = $this->model_expenditure1->getExpenditureData1($id);
            $result['expenditures'] = $expenditure_data;
            $materials_item = $this->model_expenditure1->getMaterialItemData($expenditure_data['idBangChi']);

            foreach($materials_item as $k => $v){
                $result['material_item'][] = $v;
            }

            $this->data['expenditure_data'] = $result;
            $this->data['material'] = $this->model_materials->getMaterialsData();
            $this->data['expenditurecategory'] = $this->model_expenditurecategory->getExpenditureCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData(); 
            $this->render_template('expenditure1/edit', $this->data); 
        }   
	}

    /*x
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteExpenditure1', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $idBangChi = $this->input->post('idBangChi');

        $response = array();
        if($idBangChi) {
            $delete = $this->model_expenditure1->remove($idBangChi);
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

}