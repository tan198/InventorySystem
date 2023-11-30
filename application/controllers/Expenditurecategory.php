<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditurecategory extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Expenditure Category';

		$this->load->model('model_expenditurecategory');
		$this->load->model('model_expendituretype');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
		$expenditurecategory_data = $this->model_expenditurecategory->getExpenditureCategoryData();
        if(!in_array('viewExpenditureCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        

        $result = array();
        foreach($expenditurecategory_data as $k => $v){

            $result[$k]['expenditurecategory_info'] = $v;
			
            $expendituretype = $this->model_expenditurecategory->getExpenditureCategoryType($v['idHangMucChi']);
            $result[$k]['loai_hangchi'] = $expendituretype;
        }
        $this->data['expenditurecategory_data'] = $result;

		$this->render_template('expenditurecategory/index', $this->data);	
	}

    public function create()
	{
		if(!in_array('createExpenditureCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->form_validation->set_rules('expenditurecategory_name', 'Expenditure Category Name', 'trim|required');
		$this->form_validation->set_rules('expendituretype', 'Expenditure Category Type', 'required');
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
                'tenHangMucChi' => $this->input->post('expenditurecategory_name'),
                //'idLoaiHangMucChi'=> $this->input->post('expendituretype'),
        	);  

        	$create = $this->model_expenditurecategory->create($data,$this->input->post('expendituretype'));
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('expenditurecategory/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('expenditurecategory/create', 'refresh');
        	}
        }
        else {
            // false case
        	$expendituretype_data = $this->model_expendituretype->getExpenditureTypeData();
        	$this->data['expendituretype_data'] = $expendituretype_data;

            $this->render_template('expenditurecategory/create', $this->data);
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
		if(!in_array('updateExpenditureCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			$this->form_validation->set_rules('expenditurecategory_name', 'Expenditure Category Name', 'trim|required');
		    $this->form_validation->set_rules('expendituretype', 'Expenditure Category Type', 'required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        $data = array(
                    'tenHangMucChi' => $this->input->post('expenditurecategory_name'),
                );

                $update = $this->model_expenditurecategory->edit($data, $id, $this->input->post('expendituretype'));
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('expenditurecategory/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('expenditurecategory/edit/'.$id, 'refresh');
                }
	        }
	        else {
	            // false case
	        	$expenditurecategory_data = $this->model_expenditurecategory->getExpenditureCategoryData($id);
	        	$expendituretype = $this->model_expenditurecategory->getExpenditureCategoryType($id);

	        	$this->data['expenditurecategory_data'] = $expenditurecategory_data;
	        	$this->data['loai_hangchi'] = $expendituretype;

	            $expendituretype_data = $this->model_expendituretype->getExpenditureTypeData();
	        	$this->data['expendituretype_data'] = $expendituretype_data;

				$this->render_template('expenditurecategory/edit', $this->data);	
	        }	
		}	
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function delete($id)
	{
		if(!in_array('deleteExpenditureCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_expenditurecategory->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('expenditurecategory/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('expenditurecategory/delete/'.$id, 'refresh');
		        	}
			}	
			else {
				$this->data['idHangMucChi'] = $id;
				$this->render_template('expenditurecategory/delete', $this->data);
			}	
		}
	}

}