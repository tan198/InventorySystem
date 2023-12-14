<?php
	class Model_loan extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		public function getLoansData($id = null){
			if ($id != null) {
				$sql = "SELECT * FROM `chovaychi` WHERE idChoVayChi=?";
				$query = $this->db->query($sql, array($id));
				return $query->array_row();
			}

			$sql = "SELECT * FROM `chovaychi` ORDER BY idChoVayChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('chovaychi', $data);
				return ($insert == true) ? true : false;
			}
		}

		public function update($id,$data){
			if($data && $id){
				$this->db->where('idChoVayChi',$id);
				$update = $this->db->update('chovaychi',$data);
				return ($update == true) ? true : false;
			}
		}

		public function remove($id){
			if($id){
				$this->db->where('idChoVayChi',$id);
				$delete = $this->db->delete('chovaychi');
				return ($delete == true) ? true : false;
			}
		}
	}
?>