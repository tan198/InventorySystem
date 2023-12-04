<?php
	class Model_expenditure1 extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getExpendtureData($id = null){
			if($id){
				$sql = "SELECT * FROM `taobangchi` WHERE idBangChi=?";
				$query = $this->db->query($sql,array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `taobangchi` ORDER BY idBangChi DESC ";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getProjectData($idDuAnChi = null){
			if(!$idDuAnChi){
				return false;
			}

			$sql = "SELECT * FROM `duanchi` WHERE idDuAnChi = ?";
			$query = $this->db->query($sql, array($idDuAnChi));
			return $query->result_array();
		}

		public function create(){
			$data = array(

			);

			$insert = $this->db->insert('taobangchi', $data);
			$idBangChi = $this->db->insert_id();

			
		}

	}
?>