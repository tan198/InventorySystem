<?php
	defined('BASEPATH'  ) OR exit ('No direct script access allowed');
	
	class Department extends Admin_Controller{
		public function __construct(){
			parent::__construct();
			$this->not_logged_in();
			$this->data['page_title'] = 'Department';
			$this->load->model('model_department');
			
		}

		public function index(){
			if(!in_array('viewDepartment',$this->permission)){
				redirect('dashboard','refresh');
			}

			$this->render_template('department/index',$this->data);
		}

		public function fetchDepartmentData(){
			$result = array('data' => array());
			$data = $this->model_department->getDepartment();

			foreach($data as $key => $value){
				// button
				$buttons = '';
				if(in_array('updateDepartment',$this->permission)){
					$buttons .= '<button class="btn btn-default"  data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
				}

				if(in_array('deleteDepartment',$this->permission)){
					$buttons .= ' <button type="button" class="btn btn-default" onclick="removeDepartment('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-trash"></i></button>';
				}

				$result['data'][$key] = array(
					$value['name'],
					$buttons
				);
			}

			echo json_encode($result);
		}

		public function fetchDepartmentDataById($id){
			if($id){
				$data = $this->model_department->getDepartment($id);
				echo json_encode($data);
			}

			return false;
		}

		public function create(){
			if(!in_array('createDepartment', $this->permission)) {
				redirect('dashboard','refresh');
			}

			$response = array();

			$this->form_validation->set_rules('department_name', 'Department name', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation-> run() == TRUE){
				$data = array(
					'name' => $this->input->post('department_name'),
				);

				$create = $this->model_department->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the department information';			
				}
			}else{
				$response['success'] = false;
				foreach ($_POST as $key => $value) {
					$response['messages'][$key] = form_error($key);
				}
			}

			echo json_encode($response);
		}

		public function update($id){
			if(in_array('updateDepartment',$this->permission)){
				redirect('dashboard','refresh');
			}

			$response = array();
			
			$this->form_validation->set_rules('edit_department_name', 'Department Name',  'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'name'=> $this->input->post('edit_department_name'),
				);

				$update = $this->model_department-> update($data,$id);
				if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the department information';			
	        	}
			} else {
				$response['success'] = false;
    			$response['messages'] = 'Error please refresh the page again!!';
			}
			echo json_encode($response);
		}

		public function remove(){
			if(!in_array('deleteDepartment', $this->permission)) {
				redirect('dashboard', 'refresh');
			}
			
			$id = $this->input->post('id');

			$response = array();
			if($id) {
				$delete = $this->model_department->remove($id);
				if($delete == true) {
					$response['success'] = true;
					$response['messages'] = "Successfully removed";	
				}
				else {
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the department information";
				}
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Refersh the page again!!";
			}

			echo json_encode($response);
		}
	}
?>