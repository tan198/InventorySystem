<?php
	defined('BASEPATH') OR exit('No direct scrpit access allowed');

	class Supplier extends Admin_Controller{
		public function __construct() {
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
			$this->data['page_title'] = $this->lang->line('Supplier');
			$this->load->model('model_supplier');
		}

		public function index(){
			if(!in_array('viewSupplier',$this->permission)){
				redirect('dashboard','refresh');
			}
			$this->render_template('supplier/index',$this->data);
		}

		public function fetchSupplierDataById($id){
			if($id){
				$data = $this->model_supplier->getSupplierData($id);
				echo json_encode($data);
			}

			return false;
		}

		public function fetchSupplierData(){
			$result = array('data'=> array());
			
			$data = $this->model_supplier->getSupplierData();

			foreach ($data as $key => $value){
				$buttons = '';

				if(in_array('updateSupplier',$this->permission)){
					$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
				}

				if(in_array('deleteSupplier', $this->permission)){
					$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';				}
				$result['data'][$key] = array(
					'id' => $value['id'],
					'name'=>$value['name'],
					'taxcode'=>$value['taxcode'],
					'address'=>$value['address'],
					'phone'=>$value['phone'],

					'action'=>$buttons,
				);
			}
			echo json_encode($result);
		}

		public function getNoteSupplierData($id){
			if(!$id){
				echo json_encode(array('note' => 'Note not found'));
				return;
			}

			$supplier_data = $this->model_supplier->getNoteSupplier($id);
			$note = null;

			foreach($supplier_data as $v){
				$note[] = nl2br($v['note']);
			}

			echo json_encode(array('note' => $note));
		}

		public function create(){
			if(!in_array('createSupplier',$this->permission)) {
				redirect('dashboard','refresh');
			}

			$response = array();
			$this->form_validation->set_rules('name','Name','required|trim');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() == TRUE){
				$data = array(
					
					'name'=> $this->input->post('name'),
					'taxcode' => $this->input->post('tcode'),
					'address' => $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'note' => $this->input->post('note')
				);

				$create = $this->model_supplier->create($data);
				if($create == true){
					$response['success'] = true;
					$response['message'] = 'Succesfully created';
				}else{
					$response['success'] = false;
					$response['message'] = 'Error in the database while creating the supplier information';
				}
			}else{
				$response['success'] = false;
				foreach($_POST as $key => $value){
					$response['messages'][$key] = form_error($key);
				}
			}
			echo json_encode($response);
		}


		public function update($id){
			if(!in_array('updateSupplier',$this->permission)){
				redirect('dashboard','refresh');
			}

			$response = array();

			if($id){
				$this->form_validation->set_rules('edit_name','Name','required|trim');
				$this->form_validation->set_rules('edit_address', 'Address', 'trim|required');
				$this->form_validation->set_rules('edit_phone', 'Phone', 'trim|required');

				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

				if($this->form_validation->run() == TRUE){
					$data = array(
						'name'=> $this->input->post('edit_name'),
						'taxcode' => $this->input->post('edit_tcode'),
						'address' => $this->input->post('edit_address'),
						'phone' => $this->input->post('edit_phone'),
						'note' => $this->input->post('edit_note')
					);

					$update = $this->model_supplier->update($id,$data);

					if($update == true){
						$response['success'] = true;
						$response['message'] = 'Successfully updated';
					}else{
						$response['success'] = false;
						$response['message'] = 'Error in the database while updated the supplier type infomation';
					}
				}else{
					$response['success'] = false;
					foreach($_POST as $key => $value){
						$response['messages'][$key] = form_error($key);
					}
				}
			}else{
				$response['success'] = false;
				$response['message'] = 'Error please referesh the page again!!';
			}
			echo json_encode($response);
		}

		public function remove(){
			if(!in_array('deleteSupplier',$this->permission)){
				redirect('dashboard','refresh');
			}

			$id = $this->input->post('id');

			$response = array();
			if($id) {
				$delete = $this->model_payment->remove($id);
				if($delete == true){
					$response['success'] =  true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the supplier infomation";
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Referesh the page again!!";
			}

			echo json_encode($response);
		}
	}
?>