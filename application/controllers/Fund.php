<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Funds';

		$this->load->model('model_fund');
		$this->load->model('model_payment');
        $this->load->model('model_expenditure');
        $this->load->model('model_income');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewFund', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('fund/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchFundData()
	{
		$result = array('data' => array());

		$data = $this->model_fund->getFundData();

		foreach ($data as $key => $value) {

            $payment_data = $this->model_payment->getPaymentData($value['loaithanhtoan_id']);
            $expenditure_totals = $this->model_expenditure->getTotalExpenditure();
            $income_totals = $this->model_income->getTotalIncome();

            $totalIncome = 0;
            foreach ($income_totals as $income_total) {
                if ($income_total['idTaiKhoan'] == $value['idTaiKhoan']) {
                    $totalIncome = $income_total['totalIncome'];
                    break;
                }

            $total = 0;
            foreach ($expenditure_totals as $expenditure_total) {
                if ($expenditure_total['idTaiKhoan'] == $value['idTaiKhoan']) {
                    $total = $expenditure_total['total'];
                    break;
                }
            }
        }

        $totalIncome1 = number_format((float)$totalIncome,2,'.',','); 
        $total1 = number_format((float)$total,2,'.',',');
        $remain1 = ((float)str_replace(',','',$value['soTienBanDau']) + (float)$totalIncome - (float)$total);
        $remain = number_format($remain1,2,'.',',');
			// button
            $buttons = '';
            if(in_array('updateFund', $this->permission)) {
    			$buttons .= '<a href="'.base_url('Fund/update/'.$value['idTaiKhoan']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteFund', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idTaiKhoan'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            } 

			$result['data'][$key] = array(
				$value['tenTaiKhoan'],
                $payment_data['loaiThanhToan'],
				$value['loaiTien'],
                $value['soTienBanDau'],
				$totalIncome1,
                $total1,
                $remain,
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
		if(!in_array('createFund', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
		$this->form_validation->set_rules('accounttype', 'Account Type', 'trim|required');
		$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        $this->form_validation->set_rules('initial_amount', 'Initial_amount', 'trim|required');
        // $this->form_validation->set_rules('incomed', 'Incomed', 'trim');
		// $this->form_validation->set_rules('expenditured', 'Expenditured', 'trim');
        // $this->form_validation->set_rules('remain', 'Remain', 'trim');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'tenTaiKhoan' => $this->input->post('account_name'),
        		'loaithanhtoan_id' => $this->input->post('accounttype'),
        		'loaiTien' => $this->input->post('currency'),
        		'soTienBanDau' => $this->input->post('initial_amount'),
                // 'daThu'=> $this->input->post('incomed'),
        		// 'daChi' => $this->input->post('expenditured'),
        		// 'conLai' => $this->input->post('remain'),
        	);

        	$create = $this->model_fund->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('fund/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('fund/create', 'refresh');
        	}
        }
        else {
       	
			$this->data['accounttype'] = $this->model_payment->getPaymentData();
            $this->data['incomed'] = $this->model_income->getIncomeData();
            $this->data['expenditured'] = $this->model_expenditure->getExpenditureData(); 	

            $this->render_template('fund/create', $this->data);
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
	public function update($idTaiKhoan)
	{      
        if(!in_array('updateFund', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$idTaiKhoan) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
		$this->form_validation->set_rules('accounttype', 'Account Type', 'trim|required');
		$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        $this->form_validation->set_rules('initial_amount', 'Initial_amount', 'trim|required');
        // $this->form_validation->set_rules('incomed', 'Incomed', 'trim');
		// $this->form_validation->set_rules('expenditured', 'Expenditured', 'trim');
        // $this->form_validation->set_rules('remain', 'Remain', 'trim');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'tenTaiKhoan' => $this->input->post('account_name'),
        		'loaithanhtoan_id' => $this->input->post('accounttype'),
        		'loaiTien' => $this->input->post('currency'),
        		'soTienBanDau' => $this->input->post('initial_amount'),
                // 'daThu'=> $this->input->post('incomed'),
        		// 'daChi' => $this->input->post('expenditured'),
        		// 'conLai' => $this->input->post('remain'),
            );

            $update = $this->model_fund->update($data, $idTaiKhoan);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('fund/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('fund/update/'.$idTaiKhoan, 'refresh');
            }
        }
        else {
            
            $this->data['accounttype'] = $this->model_payment->getPaymentData();        
            $this->data['expenditure'] = $this->model_expenditure->getExpenditureData();         
            $this->data['income'] = $this->model_income->getIncomeData();       

            $fund_data = $this->model_fund->getFundData($idTaiKhoan);
            $this->data['fund_data'] = $fund_data;
            $this->render_template('fund/edit', $this->data); 
        }   
	}

    /*x
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteFund', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $idTaiKhoan = $this->input->post('idTaiKhoan');

        $response = array();
        if($idTaiKhoan) {
            $delete = $this->model_fund->remove($idTaiKhoan);
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