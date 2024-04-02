<?php
	
	class Model_supplier extends CI_Model {
	
		public function __construct() {
			parent::__construct();
		}

		public function getSupplierData($id = null){
			if($id){
				$sql = "SELECT * FROM supplier WHERE id=?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array(); //Returns a single row of data
			}

			$sql = "SELECT * FROM supplier ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array(); //Return all the rows in an array
		}

		public function getNoteSupplier($id = null){
			$sql =  "SELECT note FROM supplier WHERE id=?";
			$query = $this->db->query($sql,array($id));
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('supplier', $data);
				$id = $this->db->insert_id();
				return ($insert == true) ? true : false;
			}
		}

		public function update($id,$data){
			if($id){
				$this->db->where('id',$id);
				$update = $this->db->update('supplier',$data);
				return ($update == true) ? true : false;
			}
		}
		
		public function delete($id){
			$this->db->where('id',$id);
			$delete = $this->db->delete('supplier');
			return ($delete == true) ? true : false;
		}
	
	}
	
	
?>