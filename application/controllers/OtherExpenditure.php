<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class OtherExpenditure extends Admin_Controller{
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

			$this->data['page_title'] = $this->lang->line('Other Expenditure');
			$this->load->model('model_otherexpenditure');
			$this->load->model('model_fund');
			$this->load->model('model_expenditure');
			$this->load->model('model_users');
		}

		public function create(){
			if(!in_array('createOtherExpenditure',$this->permission)){
				redirect('dashboard','refresh');
			}

			$this->form_validation->set_rules('distribute', 'Distribute', 'required');
			$this->form_validation->set_rules('payer_name', 'Payer Name', 'required');
			$this->form_validation->set_rules('note', 'Note', 'trim');
			$this->form_validation->set_rules('from_account', 'From Accounnt', 'required');
			$this->form_validation->set_rules('receiver', 'receiver', 'required');
			$this->form_validation->set_rules('to_account', 'To Accounnt', 'required');
			$this->form_validation->set_rules('date_orther', 'Date', 'trim|required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'phanloai' => $this->input->post('distribute'),
					'nguoiChi' => $this->input->post( 'payer_name'),
					'ghiChu' => $this->input->post('note'),
					'idTaiKhoan' => $this->input->post('from_account'),
					'nguoiNhan' => $this->input->post('receiver'),
					'tkhoan_nhan'=> $this->input->post('to_account'),
					'ngayChi' => $this->input->post('date_orther'),
					'tongTien' => $this->input->post('amount'),
				);
	
				$create = $this->model_otherexpenditure->create($data);
				if($create == true){
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('expenditure', 'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('otherexpenditure/create', $this->data);
				}
			}else{
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();

				$this->render_template('otherexpenditure/create', $this->data);
			}

		}

		public function update($id){
			if(!in_array('updateOtherExpenditure', $this->permission)){
				redirect('dashbroad', 'refresh');
			}

			if(!$id){
				redirect('dashboard', 'refresh');
			}

			$this->form_validation->set_rules('distribute', 'Distribute', 'required');
			$this->form_validation->set_rules('payer_name', 'Payer Name', 'required');
			$this->form_validation->set_rules('note', 'Note', 'trim');
			$this->form_validation->set_rules('from_account', 'From Accounnt', 'required');
			$this->form_validation->set_rules('receiver', 'receiver', 'required');
			$this->form_validation->set_rules('date_orther', 'Date', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'phanloai' => $this->input->post('distribute'),
					'nguoiChi' => $this->input->post( 'payer_name'),
					'ghiChu' => $this->input->post('note'),
					'idTaiKhoan' => $this->input->post('from_account'),
					'nguoiNhan' => $this->input->post('receiver'),
					'ngayChi' => $this->input->post('date_orther'),
					'tongTien' => $this->input->post('amount'),
				);

				$update = $this->model_otherexpenditure->update( $id, $data);

				if($update == true){
					$this->session->set_flashdata('success','Successfully created');
					redirect('expenditure/', 'refersh');
				}
			} else {
				$this->data['fund'] = $this->model_fund->getFundData();
				$this->data['users'] = $this->model_users->getUserData();
				$otherexpenditure = $this->model_expenditure->getExpenditureData( $id );
				$this->data['otherexpend'] = $otherexpenditure;
				$this->render_template('otherexpenditure/edit', $this->data);
			}
		}

		public function remove(){
			if(!in_array('deleteOtherExpenditer', $this->permission)){
				redirect('dashboard', 'refresh');
			}

			$idOtherexpend = $this->input->post('idBangChi');

			$response = array();
			if($idOtherexpend){
				$delete = $this->model_otherexpenditure->delete($idOtherexpend);
				if($delete == true){
					$response['success'] = true;
					$response['messages'] = "Successfully removed";
				}else{
					$response['success'] = false;
					$response['messages'] = "Error in the database while removing the other expenditure information";
				}
			}else{
				$response['success'] = false;
				$response['messages'] = "Refresh the page again!!";
			}
			echo json_encode($response);
		}

	}
?>