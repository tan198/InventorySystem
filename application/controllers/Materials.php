<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materials extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$current_lang = $this->session->userdata('site_lang');

        if ($current_lang == 'english') {
            $this->lang->load('form_validation', 'english');
            $this->lang->load('content_lang','english');
            
        } 
        elseif ($current_lang == 'vietnam') {
            $this->lang->load('content_lang','vietnam');
            $this->lang->load('form_validation', 'vietnam');
        }

		$this->data['page_title'] = $this->lang->line('Materials');

		$this->load->model('model_materials');
		$this->load->model('model_tmaterial');
	}

	/* 
	* It only redirects to the manage category page
	*/
	public function index()
	{

		if(!in_array('viewMaterials', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['type_materials'] = $this->model_tmaterial->getTmaterialData();
		$this->data['materials'] = $this->model_materials->getMaterialsData();
		$this->render_template('materials/index', $this->data);	
	}	

	/*
	* It checks if it gets the category id and retreives
	* the category information from the category model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchMaterialsDataById($id) 
	{
		if($id) {
			$data = $this->model_materials->getMaterialsData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the category value from the category table 
	* this function is called from the datatable ajax function
	*/
	public function fetchMaterialsData()
	{
		$result = array('data' => array());

		$data = $this->model_materials->getMaterialsData();

		foreach ($data as $key => $value) {

			$tmaterial_data =  $this->model_tmaterial->getTmaterialData($value['loaiVatTu']);
			// button
			$buttons = '';

			if(in_array('updateMaterials', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['idVatTu'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteMaterials', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idVatTu'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
				
			$result['data'][$key] = array(
				
				$value['tenVatTu'],
				$tmaterial_data['name'],
				$value['soLuong'],
				$value['giaTien'],
				//$value['tongTien'],
				//$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function getTypeMaterial(){
		$tmaterial =  $this->model_tmaterial->getTmaterialData();
		echo json_encode($tmaterial);
	}
	public function create()
	{
		if(!in_array('createMaterials', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('materials_name', 'Materials name', 'trim|required');
		$this->form_validation->set_rules('type_material', 'Type Material', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'tenVatTu' => $this->input->post('materials_name'),
				'loaiVatTu' => $this->input->post('type_material'),
				'soLuong' => $this->input->post('quantity'),
				'giaTien' => $this->input->post('amount'),	
        	);

        	$create = $this->model_materials->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the materials information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        //$data['type_materials'] = $this->model_tmaterial->getTmaterialData();

		echo  json_encode($response);
	}

	/*
	* Its checks the category form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateMaterials', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_materials_name', 'Edit material name', 'trim|required');
			$this->form_validation->set_rules('edit_type_material', 'Type Material', 'trim|required');
			$this->form_validation->set_rules('edit_quantity', 'Edit Quantity', 'trim|required');
			$this->form_validation->set_rules('edit_amount', 'Edit amount', 'trim|required');
			

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			
	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'tenVatTu' => $this->input->post('edit_materials_name'),
					'loaiVatTu'=>$this->input->post('edit_type_material'),
	        		'soLuong' => $this->input->post('edit_quantity'),
					'giaTien' => $this->input->post('edit_amount'),
	        	);

	        	$update = $this->model_materials->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the materials information';			
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
		if(!in_array('deleteMaterials', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$idVatTu = $this->input->post('idVatTu');

		$response = array();
		if($idVatTu) {
			$delete = $this->model_materials->remove($idVatTu);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the materials information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}