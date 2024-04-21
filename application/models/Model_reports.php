<?php 

class Model_reports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*getting the total months*/
	private function months()
	{
		return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	}

	/* getting the year of the orders */
	public function getExpenditureYear()
	{
		$sql = "SELECT * FROM `taobangchi`";
		$query = $this->db->query($sql, array());
		$result = $query->result_array();
		
		$return_data = array();
		foreach ($result as $k => $v) {
			$date = date('Y', strtotime($v['ngayChi']));
			$return_data[] = $date;
		}

		$return_data = array_unique($return_data);
		return $return_data;
	}

	public function getAdvancesData($year){
		if($year){
			$months = $this->months();

			$sql = "SELECT * FROM `taobangchi` WHERE typeExp = ?";
			$query = $this->db->query($sql, array(1));
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayChi']));

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	


			return $final_data;
		}
	}

	public function getBuyMaterialData($year){
		if($year){
			$months = $this->months();

			$sql = "SELECT * FROM `taobangchi` WHERE typeExp = ?";
			$query = $this->db->query($sql, array(2));
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayChi']));

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	


			return $final_data;
		}
	}

	public function getOtherExpeditureData($year){
		if($year){
			$months = $this->months();

			$sql = "SELECT * FROM `taobangchi` WHERE typeExp = ?";
			$query = $this->db->query($sql, array(3));
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayChi']));

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	


			return $final_data;
		}
	}

	// getting the expenditure reports based on the year and moths
	public function getExpenditureData($year)
	{	
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `taobangchi`";
			$query = $this->db->query($sql, array());
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayChi']));

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	


			return $final_data;
			
		}
	}

	// getting the income reports based on the year and moths

	public function getIncomeData($year){
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `taobangthu`";
			$query = $this->db->query($sql, array());
			$result = $query->result_array();

			$income_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$income_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayThu']));

					if($get_mon_year == $month_year) {
						$income_data[$get_mon_year][] = $v;
					}
				}
			}	
			return $income_data;
		}
	}

	public function getRefundData($year){
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `taobangthu` WHERE type_income = ?";
			$query = $this->db->query($sql, array(1));
			$result = $query->result_array();

			$income_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$income_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayThu']));

					if($get_mon_year == $month_year) {
						$income_data[$get_mon_year][] = $v;
					}
				}
			}	
			return $income_data;
		}
	}

	public function getMaterialData($year){
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `taobangthu` WHERE type_income = ?";
			$query = $this->db->query($sql, array(2));
			$result = $query->result_array();

			$income_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$income_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayThu']));

					if($get_mon_year == $month_year) {
						$income_data[$get_mon_year][] = $v;
					}
				}
			}	
			return $income_data;
		}
	}

	public function getOtherIncomeData($year){
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `taobangthu`WHERE type_income = ?";
			$query = $this->db->query($sql, array(3));
			$result = $query->result_array();

			$income_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$income_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['ngayThu']));

					if($get_mon_year == $month_year) {
						$income_data[$get_mon_year][] = $v;
					}
				}
			}	
			return $income_data;
		}
	}
}