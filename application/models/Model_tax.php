<?php
	class Model_tax extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		public function getTaxsData($id = null){
			if($id != null){
				$sql = "SELECT * FROM `thue` WHERE idThue =?";
				$query = $this->db->query($sql,array($id));
				return $query->row_array();
			}
			
			$sql = "SELECT * FROM `thue` ORDER BY idThue DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('thue',$data);
				return ($insert == true) ? true : false;
			}
		}

		public function update($id, $data){
			if($id && $data){
				$this->db->where('idThue', $id);
				$update = $this->db->update('thue', $data);
				return ($update == true) ? true : false;
			}
		}

		public function remove($id){
			if($id){
				$this->db->where('idThue', $id);
				$delete = $this->db->delete('thue');
				return ($delete == true) ? true : false;
			}
		}
	}
?>