<?php
	
	class Model_customer extends CI_Model {
	
		public function __construct() {
			parent::__construct();
		}

		public function getCustomerData($id = null){
			if($id){
				$sql = "SELECT * FROM customer WHERE id=?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array(); //Returns a single row of data
			}

			$sql = "SELECT * FROM customer ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array(); //Return all the rows in an array
		}

		public function getNoteCustomer($id=null){
			$sql = "SELECT note FROM customer WHERE id=?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array(); //Returns a single row of data
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('customer', $data);
				$id = $this->db->insert_id();
				return ($insert == true) ? true : false;
			}
		}

		public function update($id,$data){
			if($id){
				$this->db->where('id',$id);
				$update = $this->db->update('customer',$data);
				return ($update == true) ? true : false;
			}
		}
		
		public function delete($id){
			$this->db->where('id',$id);
			$delete = $this->db->delete('customer');
			return ($delete == true) ? true : false;
		}
	
	}
	
	
?>