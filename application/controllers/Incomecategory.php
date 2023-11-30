<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Incomecategory extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Income Category';

		$this->load->model('model_incomecategory');
		$this->load->model('model_incometype');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewIncomeCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $incomecategory_data = $this->model_incomecategory->getIncomeCategoryData();
        $result = array();
        foreach($incomecategory_data as $k => $v){
            $result[$k]['incomecategory_info'] = $v;
            $incometype = $this->model_incomecategory->getIncomeCategoryType($v['idHangMucThu']);
            $result[$k]['loai_hangthu'] = $incometype;
        }
        $this->data['incomecategory_data'] = $result;

		$this->render_template('incomecategory/index', $this->data);	
	}

    public function create()
	{
		if(!in_array('createIncomeCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->form_validation->set_rules('incomecategory_name', 'Income Category Name', 'trim|required');
		$this->form_validation->set_rules('incometype', 'Income Category Type', 'required');
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
                'tenHangMucThu' => $this->input->post('incomecategory_name'),
                
        	);  

        	$create = $this->model_incomecategory->create($data,$this->input->post('incometype'));
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('incomecategory/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('incomecategory/create', 'refresh');
        	}
        }
        else {
            // false case
        	$incometype_data = $this->model_incometype->getIncomeTypeData();
        	$this->data['incometype_data'] = $incometype_data;

            $this->render_template('incomecategory/create', $this->data);
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
	public function edit($id = null)
	{
		if(!in_array('updateIncomeCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			$this->form_validation->set_rules('incomecategory_name', 'Income Category Name', 'trim|required');
		    $this->form_validation->set_rules('incometype', 'Income Category Type', 'required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        $data = array(
                    'tenHangMucThu' => $this->input->post('incomecategory_name'),
                );

                $update = $this->model_incomecategory->edit($data, $id, $this->input->post('incometype'));
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('incomecategory/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('incomecategory/edit/'.$id, 'refresh');
                }
	        }
	        else {
	            // false case
	        	$incomecategory_data = $this->model_incomecategory->getIncomeCategoryData($id);
	        	$incometype = $this->model_incomecategory->getIncomeCategoryType($id);

	        	$this->data['incomecategory_data'] = $incomecategory_data;
	        	$this->data['loai_hangthu'] = $incometype;

	            $incometype_data = $this->model_incometype->getIncomeTypeData();
	        	$this->data['incometype_data'] = $incometype_data;

				$this->render_template('incomecategory/edit', $this->data);	
	        }	
		}	
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function delete($id)
	{
		if(!in_array('deleteIncomeCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_incomecategory->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('incomecategory/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('incomecategory/delete/'.$id, 'refresh');
		        	}
			}	
			else {
				$this->data['idHangMucThu'] = $id;
				$this->render_template('incomecategory/delete', $this->data);
			}	
		}
	}

}