<?php
	
	class Model_expenditure1 extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getExpenditure1Data($id = null){
			if($id){
				$sql = "SELECT * FROM `taobangchi1` WHERE id = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `taobangchi1` ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getCategoryItemData($idBangChi = null){
			if(!$idBangChi){
				return false;
			}
			$sql = "SELECT * FROM `danhmuc` WHERE idBangChi = ?";
			$query = $this->db->query($sql, array($idBangChi));
			return $query->result_array();
		}
	}
?>