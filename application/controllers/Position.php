<?php
	defined('BASEPATH') OR  exit('No direct script access allowed');

	class Position extends Admin_Controller{
		public function __construct(){
			parent::__construct();
			$this->not_logged_in();

			$this->data['page_title'] = 'Position';
			$this->load->model('model_position');
		}

		public function index(){
			if(!in_array('viewPosition',$this->permission)){
				redirect('dashboard','refresh');
			}

			$this->render_template('position/index',$this->data);
		}

		public function fetchPositionData(){
			$result = array('data'=> array());

			$data = $this->model_position->getPostision();
			
			foreach ($data as $key => $value) {
				// button
				$buttons = '';
				if(in_array('updatePosition', $this->permission)) {
					$buttons .= '<a href="'.base_url('position/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
				}

				if(in_array('deletePosition',$this->permission)){
					$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				}

				$result['data'][$key] = array(
					$value['name'],
					$buttons,
				);
			}

			echo json_encode($result);
		}

		public function fetchPositionDataByID($id){
			if($id){
				$data = $this->model_position->getPositionData($id);
				echo json_encode($data);
			}

			return false;
		}

		public function create(){
			$response = array();
			$this->form_validation->set_rules('department', 'Department', 'required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'name' => $this->input->post('position_name'),
				);

				$create = $this->model_position->create($data);

				if($create == true) {
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('position/', 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('position/create', 'refresh');
				}
			} else {
				$this->data['departments'] = $this->model_department->getDepartment();

				$this->render_template('position/create', $this->data);
			}
			
		}

		public function update($id){
			if(!in_array('updatePosition',$this->permission)){
				redirect('dashboard','refresh');
			}

			if(!$id){
				redirect('dashboard','refresh');
			}

			$this->form_validation->set_rules('position_name','Position Name','required|trim');

			if ($this->form_validation->run() == TRUE) {
				
				$data = array(
					'name' => $this->input->post('position_name'),
				);

				$update = $this->model_position->update($data,$id);
				if($update == true) {
					$this->session->set_flashdata('success', 'Successfully updated');
					redirect('position/', 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('position/update/'.$id, 'refresh');
				}
			} else {
				$this->data['departments'] = $this->model_department->getDepartment();
				$position_data = $this->model_position->getPostision($id);
				$this->data['position_data'] = $position_data;
				$this->render_template('position/edit',$this->data);
			}
		}

		public function remove()
	{
        if(!in_array('deletePosition', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $id = $this->input->post('id');

        $response = array();
        if($id) {
            $delete = $this->model_position->remove($id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the position information";
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