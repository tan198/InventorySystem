<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Income extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Income';

		$this->load->model('model_income');
        $this->load->model('model_incomecategory');
		$this->load->model('model_fund');
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
            $incomecategory_data = $this -> model_incomecategory->getIncomeCategoryData($value['idHangMucThu']);
            $fund_data = $this -> model_fund->getFundData($value['idTaiKhoan']);
            
			// button
            $buttons = '';
            if(in_array('updateIncome', $this->permission)) {
    			$buttons .= '<a href="'.base_url('income/update/'.$value['idBangThu']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteIncome', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idBangThu'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            //$currency_unit = number_format((float)$value['soTienThu'],2,'.',','); 

			$result['data'][$key] = array(
                $incomecategory_data['tenHangMucThu'],
                $fund_data['tenTaiKhoan'],
				$value['nguoiThu'],
				$date_income,
                $value['soTienThu'],
				$buttons
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
		if(!in_array('createIncome', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('receiver_name', 'Receiver name', 'trim|required');
		$this->form_validation->set_rules('incomecategory', 'Incomecategory', 'required');
		$this->form_validation->set_rules('date_income', 'Date income', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('amountt', 'Amountt', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'nguoiThu' => $this->input->post('receiver_name'),
        		'idHangMucThu' => $this->input->post('incomecategory'),
        		'ngayThu' => $this->input->post('date_income'),
        		'soTienThu' => $this->input->post('amountt'),
        		'idTaiKhoan' => $this->input->post('fund'),
        	);

        	$create = $this->model_income->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('income/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('income/create', 'refresh');
        	}
        }else{

			$this->data['incomecategory'] = $this->model_incomecategory->getIncomeCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();        	    	

            $this->render_template('income/create', $this->data);
        }	
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
	public function update($idBangThu)
	{      
        if(!in_array('updateIncome', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$idBangThu) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('receiver_name', 'Receiver name', 'trim|required');
        $this->form_validation->set_rules('incomecategory', 'Income Category', 'required');
        $this->form_validation->set_rules('date_income', 'date_income', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
        $this->form_validation->set_rules('amountt', 'Amount', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'nguoiThu' => $this->input->post('receiver_name'),
        		'idHangMucThu' => $this->input->post('incomecategory'),
        		'ngayThu' => $this->input->post('date_income'),
        		'soTienThu' => $this->input->post('amountt'),
        		'idTaiKhoan' =>$this->input->post('fund'),
            );

            $update = $this->model_income->update($data, $idBangThu);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('income/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('income/update/'.$idBangThu, 'refresh');
            }
        }
        else {
            // false case
            $this->data['incomecategory'] = $this->model_incomecategory->getIncomeCategoryData();    	
			$this->data['fund'] = $this->model_fund->getFundData();            

            $income_data = $this->model_income->getIncomeData($idBangThu);
            $this->data['income_data'] = $income_data;
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

}