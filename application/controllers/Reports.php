<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$current_lang = $this->session->userdata('site_lang');

        if (!$current_lang || $current_lang == 'english') {
            $this->lang->load('form_validation', 'english');
            $this->lang->load('content_lang','english');
            
        } 
        elseif ($current_lang == 'vietnam') {
            $this->lang->load('content_lang','vietnam');
            $this->lang->load('form_validation', 'vietnam');
        }
		$this->data['page_title'] = $this->lang->line('Reports');
		$this->load->model('model_reports');
	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		if(!in_array('viewReports', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		$parking_data = $this->model_reports->getExpenditureData($today_year);
		$this->data['report_years'] = $this->model_reports->getExpenditureYear();

		$advances_data = $this->model_reports->getAdvancesData($today_year);
		$buymaterial_data = $this->model_reports->getBuyMaterialData($today_year);
		$otherexpenditure_data = $this->model_reports->getOtherExpeditureData($today_year);

		$refund_data = $this->model_reports->getRefundData($today_year);
		$material_income_data = $this->model_reports->getMaterialData($today_year);
		$other_income_data = $this->model_reports->getOtherIncomeData($today_year);
		$income_data = $this->model_reports->getIncomeData($today_year);
		
		$final_parking_data = array();
		$totalAdvances = array();
		$totalBuyMaterial = array();
		$totalOtherMaterial = array();

		$total_refund = array();
		$total_material_income = array();
		$total_other_income = array();
		$final_income_data = array();

		//show detail reports expenditure

		/******************************* Advances, Buy Material, Other Expenditure ********************************/

		foreach($advances_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_advances = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_advances[] = $v1['tongTien'];						
					}
				}
				$totalAdvances[$key] = array_sum($total_amount_advances);	
			}
			else {
				$totalAdvances[$key] = 0;	
			}
		}

		foreach($buymaterial_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_buymaterial = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_buymaterial[] = $v1['tongTien'];						
					}
				}
				$totalBuyMaterial[$key] = array_sum($total_amount_buymaterial);	
			}
			else {
				$totalBuyMaterial[$key] = 0;	
			}
		}

		foreach($otherexpenditure_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_other = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_other[] = $v1['tongTien'];						
					}
				}
				$totalOtherMaterial[$key] = array_sum($total_amount_other);	
			}
			else {
				$totalOtherMaterial[$key] = 0;	
			}
		}

		
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_expenditure = array();
				
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_expenditure[] = $v2['tongTien'];						
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_expenditure);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
		}

		//Reports income

		foreach($refund_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_refund = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_refund[] = $v1['tongTien'];						
					}
				}
				$total_refund[$key] = array_sum($total_amount_refund);	
			}
			else {
				$total_refund[$key] = 0;	
			}
		}

		foreach($material_income_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_material_income = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_material_income[] = $v1['tongTien'];						
					}
				}
				$total_material_income[$key] = array_sum($total_amount_material_income);	
			}
			else {
				$total_material_income[$key] = 0;	
			}
		}

		foreach($other_income_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_other_income = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_other_income[] = $v1['tongTien'];						
					}
				}
				$total_other_income[$key] = array_sum($total_amount_other_income);	
			}
			else {
				$total_other_income[$key] = 0;	
			}
		}

		foreach($income_data  as $key => $value) {
			if(count($value) > 1) {
				$total_amount_income = array();
				
				foreach ($value as $k1 => $v1) {
					if($v1) {
						$total_amount_income[] = $v1['tongTien'];						
					}
				}
				$final_income_data[$key] = array_sum($total_amount_income);	
			}
			else {
				$final_income_data[$key] = 0;	
			}
		}
		
		$this->data['selected_year'] = $today_year;
		$this->data['company_currency'] = $this->company_currency();
		$this->data['advances'] = $totalAdvances;
		$this->data['buymaterial'] = $totalBuyMaterial;
		$this->data['other_expenditure'] = $totalOtherMaterial;
		$this->data['refund'] = $total_refund;
		$this->data['material_income'] = $total_material_income;
		$this->data['other_income'] = $total_other_income;
		$this->data['income'] = $final_income_data;
		$this->data['results'] = $final_parking_data;

		$this->render_template('reports/index', $this->data);
	}
}