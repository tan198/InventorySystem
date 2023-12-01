<?php
	class Model_project extends CI_Model{ 
		public function __construct()
		{
			parent::__construct();
		}

		//get data project

		public function getProjectData($id = null){
			if($id){
				$sql = "SELECT * FROM `duanchi` WHERE idDuAnChi = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `duanchi` ORDER BY idDuAnChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('project',$data);
				return ($insert==true) ? true : false;
			}
		}
		
	}
?>