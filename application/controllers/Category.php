<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller 
{
	public function __construct()
	{
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

		$this->data['page_title'] = $this->lang->line('Category');

		$this->load->model('model_category');

	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
		$category_data = $this->model_category->getCategoryData();
        if(!in_array('viewCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        

        $result = array();
        foreach($category_data as $k => $v){

            $result[$k]['category_info'] = $v;
			
            
        }
        $this->data['category_data'] = $result;

		$this->render_template('category/index', $this->data);	
	}

    public function create()
	{
		if(!in_array('createCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
                'loaiHangMuc' => $this->input->post('category_name'),
        	);  

        	$create = $this->model_category->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('category/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('category/create', 'refresh');
        	}
        }
        else {
            // false case

            $this->render_template('category/create', $this->data);
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
		if(!in_array('updateCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');



			if ($this->form_validation->run() == TRUE) {
	            // true case
		        $data = array(
                    'tenHangMucChi' => $this->input->post('category_name'),
                );

                $update = $this->model_category->edit($data, $id);
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully created');
                    redirect('category/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('category/edit/'.$id, 'refresh');
                }
	        }
	        else {
	            // false case
	        	$category_data = $this->model_category->getCategoryData($id);
	        	

	        	$this->data['category_data'] = $category_data;

				$this->render_template('category/edit', $this->data);	
	        }	
		}	
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function delete($id)
	{
		if(!in_array('deleteCategory', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_category->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('category/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('category/delete/'.$id, 'refresh');
		        	}
			}	
			else {
				$this->data['idHangMuc'] = $id;
				$this->render_template('category/delete', $this->data);
			}	
		}
	}

}