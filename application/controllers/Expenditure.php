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
        $this->load->model('model_project');
        $this->load->model('model_expendituretype');
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

			$result['data'][$key] = array(
                $expenditurecategory_data['tenHangMucChi'],
                $fund_data['tenTaiKhoan'],
				$value['nguoiChi'],
				$date_expenditure,
                $value['soTien'],
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
		if(!in_array('createExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('payer_name', 'Payer name', 'trim|required');
		$this->form_validation->set_rules('expenditurecategory', 'Expenditurecategory', 'required');
		$this->form_validation->set_rules('date_expenditure', 'Date expenditure', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'nguoiChi' => $this->input->post('payer_name'),
        		'idHangMucChi' => $this->input->post('expenditurecategory'),
        		'ngayChi' => $this->input->post('date_expenditure'),
        		'soTien' => $this->input->post('amount'),
        		'idTaiKhoan' => $this->input->post('fund'),
        	);

        	$create = $this->model_expenditure->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('expenditure/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('expenditure/create', 'refresh');
        	}
        }else{

			$this->data['expenditurecategory'] = $this->model_expenditurecategory->getExpenditureCategoryData();
			$this->data['fund'] = $this->model_fund->getFundData();        	    	

            $this->render_template('expenditure/create', $this->data);
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
	public function update($idBangChi)
	{      
        if(!in_array('updateExpenditure', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$idBangChi) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('payer_name', 'Payer name', 'trim|required');
        $this->form_validation->set_rules('expenditurecategory', 'Expenditure Category', 'required');
        $this->form_validation->set_rules('date_expenditure', 'date_expenditure', 'required');
        $this->form_validation->set_rules('fund', 'Fund', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'nguoiChi' => $this->input->post('payer_name'),
        		'idHangMucChi' => $this->input->post('expenditurecategory'),
        		'ngayChi' => $this->input->post('date_expenditure'),
        		'soTien' => $this->input->post('amount'),
        		'idTaiKhoan' =>$this->input->post('fund'),
            );

            $update = $this->model_expenditure->update($data, $idBangChi);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('expenditure/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('expenditure/update/'.$idBangChi, 'refresh');
            }
        }
        else {
            // false case
            $this->data['expenditurecategory'] = $this->model_expenditurecategory->getExpenditureCategoryData();    	
			$this->data['fund'] = $this->model_fund->getFundData();            

            $expenditure_data = $this->model_expenditure->getExpenditureData($idBangChi);
            $this->data['expenditure_data'] = $expenditure_data;
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

}