<?php
	class Model_debt extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getDebtsData($id = null){
			if($id != null){
				$sql = "SELECT * FROM `khoanno` WHERE idKhoanNo=?";
				$query = $this->db->query($sql,array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `khoanno` ORDER BY idKhoanNo DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('khoanno',$data);
				return ($insert == true) ? true : false;
			}
		}

		public function update($id,$data){
			if($data && $id){
				$this->db->where('idKhoanNo',$id);
				$update = $this->db->update('khoanno',$data);
				return ($update == true) ? true : false;
			}	
		}

		public function remove($id){
			if($id){
				$this->db->where('idKhoanNo',$id);
				$delete = $this->db->delete('khoanno');
				return ($delete == true) ? true : false;
			}
		}
	}
?>