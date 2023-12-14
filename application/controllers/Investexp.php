<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Investexp extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Đâu Tu Chi';

		$this->load->model('model_investexp');
	}

	/* 
	* It only redirects to the manage category page
	*/
	public function index()
	{

		if(!in_array('viewInvestExp', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('investexp/index', $this->data);	
	}	

	/*
	* It checks if it gets the category id and retreives
	* the category information from the category model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchInvestexpDataById($id) 
	{
		if($id) {
			$data = $this->model_investexp->getInvestExpData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the category value from the category table 
	* this function is called from the datatable ajax function
	*/
	public function fetchInvestexpData()
	{
		$result = array('data' => array());

		$data = $this->model_investexp->getInvestExpData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateInvestExp', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['idDauTuChi'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteInvestExp', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idDauTuChi'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				
			$result['data'][$key] = array(
				
				$value['tenDauTuChi'],
				$value['tenNguoiNhan'],
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
		if(!in_array('createInvestExp', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('invest_name', 'Invest name', 'trim|required');
		$this->form_validation->set_rules('receiver', 'Receiver', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'tenDauTuChi' => $this->input->post('invest_name'),
				'tenNguoiNhan' => $this->input->post('receiver'),	
        	);

        	$create = $this->model_investexp->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
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

		if(!in_array('updateInvestExp', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_invest_name', 'Invest name', 'trim|required');
			$this->form_validation->set_rules('edit_receiver', 'Receiver', 'trim|required');
			

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			
	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'tenDauTuChi' => $this->input->post('edit_invest_name'),
	        		'tenNguoiNhan' => $this->input->post('edit_receiver'),
	        	);

	        	$update = $this->model_investexp->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
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
		if(!in_array('deleteInvestExp', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$idDauTuChi = $this->input->post('idDauTuChi');

		$response = array();
		if($idDauTuChi) {
			$delete = $this->model_investexp->remove($idDauTuChi);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}