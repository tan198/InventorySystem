<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projectexpend extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dự Án Chi';

		$this->load->model('model_projectexpenditure');
		$this->load->model('model_materials');
	}

	public function fetchProjectExpenditureData()
	{
		$result = array('data' => array());

		$data = $this->model_projectexpenditure->getProjectExpendData();

		foreach ($data as $key => $value) {
            $materials_data = $this -> model_materials->getMaterialsData($value['idVatTuChi']);
            
			// button
            $buttons = '';
            if(in_array('updateProjectExpend', $this->permission)) {
    			$buttons .= '<a href="'.base_url('projectexpend/update/'.$value['idDuAnChi']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProjectExpend', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['idDuAnChi'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

			$result['data'][$key] = array(
				$value['tenDuAn'],
				empty($materials_data['tenVatTu']) ? '' : $materials_data['tenVatTu'],
                $value['ship'],
				$value['thueNgoai'],
				$buttons
			);
		} // /foreach
    
		echo json_encode($result);
	}
    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewProjectExpend', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('projectexpend/index', $this->data);	
	}
    public function create()
	{
		if(!in_array('createProjectExpend', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
		$this->form_validation->set_rules('material', 'Materials', 'trim');
		$this->form_validation->set_rules('ship', 'Ship', 'trim');
		$this->form_validation->set_rules('rent', 'Rent', 'trim');

        if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
				'tenDuAn' => $this->input->post('project_name'),
				'idVatTuChi' => $this->input->post('material'),
				'ship' => $this->input->post('ship'),
				'thueNgoai' => $this-> input->post('rent')
        	);  

        	$create = $this->model_projectexpenditure->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('projectexpend/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('projectexpend/create', 'refresh');
        	}
        }
        else {
            // false case
        	$materials_data = $this->model_materials->getMaterialsData();
        	$this->data['materials_data'] = $materials_data;

            $this->render_template('projectexpend/create', $this->data);
        }	

    }
    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($idDuAnChi = null)
	{
		if(!in_array('updateProjectExpend', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($idDuAnChi) {
			$this->form_validation->set_rules('project_name', 'Edit Project Name', 'trim|required');
			$this->form_validation->set_rules('material', 'Edit Materials', 'trim|required');
			$this->form_validation->set_rules('ship', 'Edit Ship', 'trim|required');
			$this->form_validation->set_rules('rent', 'Edit Rent', 'trim|required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        $data = array(
					'tenDuAn' => $this->input->post('project_name'),
					'idVatTuChi' => $this->input->post('material'),
					'ship' => $this->input->post('ship'),
					'thueNgoai' => $this-> input->post('rent')	
                );

                $update = $this->model_projectexpenditure->update($data, $idDuAnChi);
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('projectexpend/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('projectexpend/edit/'.$idDuAnChi, 'refresh');
                }
	        }
	        else {
	            // false case
				$this->data['material'] = $this->model_materials->getMaterialsData();

				$projectexpend_data = $this->model_projectexpenditure->getProjectExpendData($idDuAnChi);
				$this->data['projectexpend_data'] = $projectexpend_data;
				$this->render_template('projectexpend/edit', $this->data);	
	        }	
		}	
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
		if(!in_array('deleteProjectExpend', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $idDuAnChi = $this->input->post('idDuAnChi');

        $response = array();
        if($idDuAnChi) {
            $delete = $this->model_projectexpenditure->remove($idDuAnChi);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}