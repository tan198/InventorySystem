<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class OtherIncome extends Admin_Controller{
		public function __construct(){
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

			$this->data['page_title'] = $this->lang->line('Other Income');
			$this->load->model('model_otherincome');
			$this->load->model('model_fund');
			$this->load->model('model_income');
			$this->load->model('model_users');
		}

		public function create(){
			if(!in_array('createOtherIncome',$this->permission)){
				redirect('dashboard','refresh');
			}

			$this->form_validation->set_rules('distribute', 'Distribute', 'required');
			$this->form_validation->set_rules('payer_name', 'Payer Name', 'required');
			$this->form_validation->set_rules('note', 'Note', 'trim');
			$this->form_validation->set_rules('sending_account', 'Sending Accounnt', 'required');
			$this->form_validation->set_rules('receiver', 'receiver', 'required');
			$this->form_validation->set_rules('receiver_account', 'Receiver Account', 'required');
			$this->form_validation->set_rules('date_orther', 'Date', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'phanloai' => $this->input->post('distribute'),
					'nguoiChi' => $this->input->post( 'payer_name'),
					'ghiChu' => $this->input->post('note'),
					'idTaiKhoan' => $this->input->post('receiver_account'),
					'nguoiThu' => $this->input->post('receiver'),
					'tk_chuyen'=> $this->input->post('sending_account'),
					'ngayThu' => $this->input->post('date_orther'),
					'tongTien' => $this->input->post('amount'),
				);
	
				$create = $this->model_otherincome->create($data);
				if($create == true){
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('income', 'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('otherincome/create', $this->data);
				}
			}else{
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();

				$this->render_template('otherincome/create', $this->data);
			}

		}

		public function update($id){
			if(!in_array('updateOtherIncome', $this->permission)){
				redirect('dashbroad', 'refresh');
			}

			if(!$id){
				redirect('dashboard', 'refresh');
			}

			$this->form_validation->set_rules('distribute', 'Distribute', 'required');
			$this->form_validation->set_rules('payer_name', 'Payer Name', 'required');
			$this->form_validation->set_rules('note', 'Note', 'trim');
			$this->form_validation->set_rules('sending_account', 'Sending Accounnt', 'required');
			$this->form_validation->set_rules('receiver', 'receiver', 'required');
			$this->form_validation->set_rules('receiver_account', 'Receiver Account', 'required');
			$this->form_validation->set_rules('date_orther', 'Date', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'phanloai' => $this->input->post('distribute'),
					'nguoiChi' => $this->input->post( 'payer_name'),
					'ghiChu' => $this->input->post('note'),
					'idTaiKhoan' => $this->input->post('receiver_account'),
					'nguoiThu' => $this->input->post('receiver'),
					'tk_chuyen'=> $this->input->post('sending_account'),
					'ngayThu' => $this->input->post('date_orther'),
					'tongTien' => $this->input->post('amount'),
				);

				$update = $this->model_otherincome->update( $id, $data);

				if($update == true){
					$this->session->set_flashdata('success','Successfully created');
					redirect('income/', 'refersh');
				}
			} else {
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();
				$otherincome = $this->model_income->getIncomeData( $id );
				$this->data['otherincome'] = $otherincome;
				$this->render_template('otherincome/edit', $this->data);
			}
		}

		public function remove(){
			if(!in_array('deleteOtherIncome', $this->permission)){
				redirect('dashboard', 'refresh');
			}

			$idOtherIncome = $this->input->post('idBangThu');

			$response = array();
			if($idOtherIncome){
				$delete = $this->model_otherincome->delete($idOtherIncome);
				if($delete == true){
					$response['success'] = true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the other income information";
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Refresh the page again!!";
			}
			echo json_encode($response);
		}

	}
?>