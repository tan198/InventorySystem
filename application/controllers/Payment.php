<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Payment Type';

		$this->load->model('model_payment');
	}

	/* 
	* It only redirects to the manage category page
	*/
	public function index()
	{

		if(!in_array('viewPayment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('payment/index', $this->data);	
	}	

	/*
	* It checks if it gets the category id and retreives
	* the category information from the category model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchPaymentDataById($id) 
	{
		if($id) {
			$data = $this->model_payment->getPaymentData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the category value from the category table 
	* this function is called from the datatable ajax function
	*/
	public function fetchPaymentData()
	{
		$result = array('data' => array());

		$data = $this->model_payment->getPaymentData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updatePayment', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deletePayment', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['loaiThanhToan'],
				//$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createPayment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('payment_name', 'Payment name', 'trim|required');
		// $this->form_validation->set_rules('', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'loaiThanhToan' => $this->input->post('payment_name'),
        		// 'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_payment->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the payment information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updatePayment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_payment_name', 'Edit Payment Name', 'trim|required');
			// $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'loaiThanhToan' => $this->input->post('edit_payment_name'),
	        		// 'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_payment->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the payment type information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the category information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deletePayment', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('id');

		$response = array();
		if($id) {
			$delete = $this->model_payment->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the payment information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}