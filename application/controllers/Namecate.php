<?php
	defined('BASEPATH') OR  exit('No direct script access allowed');

	class Namecate extends Admin_Controller{
		public function __construct(){
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
			$this->data['page title'] = $this->lang->line("Name Categories");

			$this->load->model('model_category');
			$this->load->model('model_namecategory');
		}

		public function index(){
			if(!in_array('viewNamecate',$this->permission)){
				redirect('dashboard', 'refresh');
			}
			$this->data['namecate'] = $this->model_namecategory->getNameCategory();
			$this->data['categories'] = $this->model_category->getCategoryData();
			$this->render_template('namecate/index',$this->data);
		}

		public function fetchNameCate(){
			$result = array('data' => array());
			
			$data = $this->model_namecategory->getNameCategory();

			foreach($data as $key => $value){
				$category_data = $this->model_category->getCategoryData( $value['id_hangmuc'] );

				$buttons =  '';
				if(in_array('updateNamecate', $this->permission)){
					$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
				}

				if(in_array('deleteNamecate',$this->permission)){
					$buttons .= '<button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				}

				$result['data'][$key] = array(
					$category_data['loaiHangMuc'],
					$value['name'],
					$buttons
				);
			}

			echo json_encode($result);
		}

		public function fetchNameCateDataById($id){
			if($id){
				$data = $this->model_namecategory->getNameCategory($id);
				echo json_encode($data);
			}
			return false;
		}

		public function getListName($idHangMuc){
			$nameData = $this->model_namecategory->getName($idHangMuc);
			echo json_encode($nameData);
		}

		public function create(){
			if(!in_array('createNamecate',$this->permission)){
				redirect('dashboard', 'refresh');
			}

			$response =  array();

			$this->form_validation->set_rules('categories', 'Categories', 'trim|required');
			$this->form_validation->set_rules('name_category', 'Name Category', 'trim|required');	
			
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'id_hangmuc' => $this->input->post('categories'),
					'name' => $this->input->post('name_category')
				);

				$create = $this->model_namecategory->create($data);
				if($create == true){
					$response['success'] = true;
					$response['message'] = 'Succesfully created';
				}else{
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the name categories information ';
				}
			}else{
				$response['success'] = false;
				foreach($_POST as $key => $value){
					$response['message'][$key] = form_error($key);
				}
			}

			echo json_encode($response);
		}

		public function update($id){
			if(!in_array('updateNamecate', $this->permission)){
				redirect('dashboard', 'refresh');
			}

			$response = array();

			if($id){
				$this->form_validation->set_rules('edit_catergories', 'Edit Catergories', 'required');
				$this->form_validation->set_rules('edit_name_category', 'Edit Name Category','required');

				$this->form_validation->set_error_delimiters('<p class ="text-danger" >','</p>');

				if($this->form_validation->run() == TRUE){
					$data = array(
						'id_hangmuc' => $this->input->post('edit_catergories'),
						'name' =>  $this->input->post('edit_name_category')
					);

					$update = $this->model_namecategory->update($id,$data);
					if($update == true){
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}else{
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the name category information';
					}
				}else{
					$response['success'] = false;
					foreach ($_POST as $key => $value){
						$response['messages'][$key] = form_error($key);
					}
				}
			}else{
				$response['success'] = false;
				$response['messages'] = 'Error please refresh the page again!!';
			}

			echo json_encode($response);
		}

		public function remove(){
			if(!in_array('deleteMaterials',$this->permission)){
				redirect('dashboard','refresh');
			}
			$id = $this->input->post('id');
			$response = array();
			if($id){
				$delete = $this->model_namecategory->delete($id);
				if($delete == true){
					$response['success'] = true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success']= false;
					$response['messages'] = "Error in the database while removing the name catergories information";
				}
			}
		}
	}
?>