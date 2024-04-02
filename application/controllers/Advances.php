<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Advances extends Admin_Controller{
		public function  __construct(){
			parent::__construct();
			$this->not_logged_in();

			$this->data['page_title'] = 'Advances';

			$this->load->model('model_advances');
			$this->load->model('model_users');
			$this->load->model('model_fund');
			$this->load->model('model_expenditure');
			$this->load->model('model_payment');
		}

		public function index(){
			if(!in_array('viewAdvances', $this->permission)) {
				redirect('dashboard','refresh');
			}

			$this->render_template('expenditure/index', $this->data);
		}

		public function getPaymentById($idTaiKhoan){
			if($idTaiKhoan){
				$data = $this->model_advances->getPaymentId($idTaiKhoan);
				echo json_encode($data);
			}

			return false;
		}

		public function create(){
			if(!in_array('createAdvances',$this->permission)){
				redirect('dashboard', 'refresh');
			}

			$this->form_validation->set_rules('payer_name', 'Payer Name', 'required');
			$this->form_validation->set_rules('receiver_name', 'Receiver Name', 'required');
			$this->form_validation->set_rules('fund', 'Type Payment', 'required');
			$this->form_validation->set_rules('note','Note', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('date_advances','Date Advances', 'required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nguoiChi' => $this->input->post('payer_name'),
					'ghiChu' => $this->input->post('note'),
					'nguoiNhan' => $this->input->post('receiver_name'),
					'idTaiKhoan' => $this->input->post('fund'),
					'ngayChi' => $this->input->post('date_advances'),
					'tongTien' => $this->input->post('amount'),
				);

				$create = $this->model_advances->create($data);
				if($create == true){
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('expenditure/', 'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('advances/create/', 'refresh');
				}
			}else{
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();

				$this->render_template('advances/create',$this->data);
			}
		}

		public function update($id){
			if(!in_array('updateAdvances', $this->permission)){
				redirect('dashboard', 'refresh');
			}

			if(!$id){
				redirect('dashboard', 'refresh');
			}

			$this->form_validation->set_rules('payer_name', 'Payer  Name','required');
			$this->form_validation->set_rules('receiver_name', 'Receiver Name','required');
			$this->form_validation->set_rules('fund', 'Fund','required');
			$this->form_validation->set_rules('note', 'Note', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('date_advances','Date Advances', 'required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() == TRUE){
				$data =  array(
					'nguoiChi' => $this->input->post('payer_name'),
					'ghiChu' => $this->input->post('note'),
					'idTaiKhoan' => $this->input->post('fund'),
					'ngayChi' => $this->input->post('date_advances'),
					'nguoiNhan' => $this->input->post('receiver_name'),
					'tongTien' => $this->input->post('amount')
				);

				$update = $this->model_advances->update( $id, $data);

				if($update == true){
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('expenditure/', 'refresh');
					   	
				}else{
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('advances/update/'.$id,'refresh');
				}
			}else{
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();
				$this->data['payment'] = $this->model_payment->getPaymentData();

				$advances = $this->model_expenditure->getExpenditureData($id);
				$this->data['advances'] = $advances;
				$this->render_template('advances/edit', $this->data);
			}
		}

		public function remove(){
			if(!in_array('deleteAdvances', $this->permission)){
				redirect('dashboard','refresh');
			}

			$idAdvances = $this->input->post('idBangChi');

			$response = array();
			if($idAdvances){
				$delete = $this->model_advances->delete($idAdvances);
				if($delete == true){
					$response['success'] = true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the advances information";
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Refresh the page again!!";
			}

			echo json_encode($response);
		}
	}
?>