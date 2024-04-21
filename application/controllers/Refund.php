<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Refund extends Admin_Controller{
		public function  __construct(){
			parent::__construct();
			$this->not_logged_in();

			$current_lang = $this->session->userdata('site_lang');

			if (!$current_lang || $current_lang == 'english') {
				$this->lang->load('form_validation', 'english');
				$this->lang->load('content_lang','english');
				
			} 
			elseif ($current_lang == 'vietnam') {
				$this->lang->load('content_lang','vietnam');
				$this->lang->load('form_validation', 'vietnam');
			}

			$this->data['page_title'] = $this->lang->line('Refund');

			$this->load->model('model_refund');
			$this->load->model('model_users');
			$this->load->model('model_fund');
			$this->load->model('model_income');
			$this->load->model('model_payment');
		}

		public function index(){
			if(!in_array('viewRefund', $this->permission)) {
				redirect('dashboard','refresh');
			}

			$this->render_template('income/index', $this->data);
		}

		public function getPaymentById($idTaiKhoan){
			if($idTaiKhoan){
				$data = $this->model_refund->getPaymentId($idTaiKhoan);
				echo json_encode($data);
			}

			return false;
		}

		public function create(){
			if(!in_array('createRefund',$this->permission)){
				redirect('dashboard', 'refresh');
			}

			$this->form_validation->set_rules('payer_name', 'Payer Name', 'required');
			$this->form_validation->set_rules('receiver_name', 'Receiver Name', 'required');
			$this->form_validation->set_rules('fund', 'Type Payment', 'required');
			$this->form_validation->set_rules('note','Note', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('date_refund','Date Refund', 'required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nguoiChi' => $this->input->post('payer_name'),
					'ghiChu' => $this->input->post('note'),
					'nguoiThu' => $this->input->post('receiver_name'),
					'idTaiKhoan' => $this->input->post('fund'),
					'ngayThu' => $this->input->post('date_refund'),
					'tongTien' => $this->input->post('amount'),
				);

				$create = $this->model_refund->create($data);
				if($create == true){
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('income/', 'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('refund/create/', 'refresh');
				}
			}else{
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();

				$this->render_template('refund/create',$this->data);
			}
		}

		public function update($id){
			if(!in_array('updateRefund', $this->permission)){
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
			$this->form_validation->set_rules('date_refund','Date Refund', 'required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() == TRUE){
				$data =  array(
					'nguoiChi' => $this->input->post('payer_name'),
					'ghiChu' => $this->input->post('note'),
					'idTaiKhoan' => $this->input->post('fund'),
					'ngayThu' => $this->input->post('date_refund'),
					'nguoiThu' => $this->input->post('receiver_name'),
					'tongTien' => $this->input->post('amount')
				);

				$update = $this->model_refund->update( $id, $data);

				if($update == true){
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('income/', 'refresh');
					   	
				}else{
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('refund/update/'.$id,'refresh');
				}
			}else{
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();
				$this->data['payment'] = $this->model_payment->getPaymentData();

				$refund = $this->model_income->getincomeData($id);
				$this->data['refund'] = $refund;
				$this->render_template('refund/edit', $this->data);
			}
		}

		public function remove(){
			if(!in_array('deleteRefund', $this->permission)){
				redirect('dashboard','refresh');
			}

			$idRefund = $this->input->post('idBangChi');

			$response = array();
			if($idRefund){
				$delete = $this->model_refund->delete($idRefund);
				if($delete == true){
					$response['success'] = true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the refund information";
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Refresh the page again!!";
			}

			echo json_encode($response);
		}
	}
?>