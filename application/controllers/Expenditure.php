<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Expenditure';

		$this->load->model('model_expenditure');
        $this->load->model('model_expenditurecategory');
		$this->load->model('model_fund');
        $this->load->model('model_materials');
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
            //var_dump($material_info);
            $date_expenditure = date('d/m/Y',  strtotime($value['ngayChi']));
            $expenditurecategory_data = $this -> model_expenditurecategory->getExpenditureCategoryData($value['idHangMucChi']);
            $fund_data = $this -> model_fund->getFundData($value['idTaiKhoan']);
			// button
            $buttons = '';
            if(in_array('updateExpenditure', $this->permission)) {
    			$buttons .= '<a href="'.base_url('expenditure/update/'.$value['idBangChi']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteExpenditure', $this->permission)) { 
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

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('payer_name', 'Payer name', 'trim|required');
		$this->form_validation->set_rules('expenditurecategory', 'Expenditurecategory', 'required');
		$this->form_validation->set_rules('date_expenditure', 'Date expenditure', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim');
        $this->form_validation->set_rules('material_status', 'Material Status', 'required');
	
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
                'ghiChu'=> $this->input->post('note_expenditure'),
        	);
            $data1 = array();

            $material_name = $this->input->post('material_name');
            $qty = $this->input->post('quantity');
            $rate = $this->input->post('rate');
            
            
            for ($i = 0; $i < count($material_name); $i++) {
                $data1[] = array(
                    'tenVatTu' => $material_name[$i],
                    'soLuong' => $qty[$i],
                    'giaTien' => $rate[$i]
                );
            }
                if($data['materialStatus'] == 1){

                    $create = $this->model_expenditure->create1($data,$data1);
                    if($create == true ) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        var_dump($create);
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
        
			$this->data['expenditurecategory'] = $this->model_expenditurecategory->getExpenditureCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();  
            //$this->data['materials'] = $this->model_materials->getMaterialsData();      	    	

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
        }
    
        echo json_encode(array('tenVatTu' => $materialName));
    }

    public function getExpenditureData($idBangChi){
        if (!$idBangChi) {
            echo json_encode(array('ghiChu' => 'Note not found'));
            return;
        }
        $note = array();
        $expenditure_data = $this->model_expenditure->getExpenditureData($idBangChi);
    
        // Debugging: Check if expenditure_data is not empty
        if (empty($expenditure_data)) {
            echo "Expenditure data is empty";
            return;
        }
    
        foreach($expenditure_data as $v){
            // Debugging: Check the structure of each item
            print_r($v);
    
            if (is_array($v) && isset($v['ghiChu'])) {
                $note[] = nl2br($v['ghiChu']);
                echo 'Note: ' . $v['ghiChu'] . '<br>';
            }
        }
        // Debugging: Check the final note array
        print_r($note);
        echo json_encode($note);
    }
    
    public function getMaterialValueById(){
        $idVatTuChi  = $this->input->post('idVatTuChi');
        if($idVatTuChi){
            $material_data = $this->model_materials->getMaterialsData($idVatTuChi);
            echo json_encode($material_data);
        }
    }
    public function getTableMaterialRow(){
        $idVatTuChi  = $this->input->post('idVatTuChi');
        $materials = $this->model_materials->getMaterialsData( $idVatTuChi);
        echo json_encode($materials);
    }

    public function createTableMaterialRow(){
        $idBangChi = $this->input->post('idBangchi');
        if($idBangChi){
            $new_row = $this->model_expenditure->newRowUpdate($idBangChi);
            echo json_encode($new_row);
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
		$this->form_validation->set_rules('tamount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('amountt', 'Amountt','trim');
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
                'ghiChu'=> $this->input->post('note_expenditure')
        	);

            if($data['materialStatus'] == 1){
                $update = $this->model_expenditure->update($id, $data);
                //$create1 = $this->model_expenditure->newRowUpdate($id);
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
            $this->data['expenditurecategory'] = $this->model_expenditurecategory->getExpenditureCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData(); 
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
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

    public function reomveMaterial(){
        $idBangChi = $this->input->post('idBangChi');
        if($idBangChi){
            $deleteRow = $this->model_expenditure->removeMaterial($idBangChi);
        }
        echo json_encode($deleteRow);
    }

}