<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Incometype extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Income Category Type';

		$this->load->model('model_incometype');
	}

	/* 
	* It only redirects to the manage category page
	*/
	public function index()
	{

		if(!in_array('viewIncomeType', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('incometype/index', $this->data);	
	}	

	/*
	* It checks if it gets the category id and retreives
	* the category information from the category model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchIncomeTypeDataById($id) 
	{
		if($id) {
			$data = $this->model_incometype->getIncomeTypeData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the category value from the category table 
	* this function is called from the datatable ajax function
	*/
	public function fetchIncomeTypeData()
	{
		$result = array('data' => array());

		$data = $this->model_incometype->getIncomeTypeData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateIncomeType', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['idLoaiHangMucThu'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteIncomeType', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idLoaiHangMucThu'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['tenLoaiHangMucThu'],
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
		if(!in_array('createIncomeType', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('incometype_name', 'IncomeType name', 'trim|required');
		// $this->form_validation->set_rules('', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'tenLoaiHangMucThu' => $this->input->post('incometype_name'),
        		// 'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_incometype->create($data);
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

		if(!in_array('updateIncomeType', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_incometype_name', 'tenLoaiHangMucThu', 'trim|required');
			// $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'tenLoaiHangMucThu' => $this->input->post('edit_incometype_name'),
	        		// 'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_incometype->update($data, $id);
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
		if(!in_array('deleteIncomeType', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$idLoaiHangMucThu = $this->input->post('idLoaiHangMucThu');

		$response = array();
		if($idLoaiHangMucThu) {
			$delete = $this->model_incometype->remove($idLoaiHangMucThu);
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