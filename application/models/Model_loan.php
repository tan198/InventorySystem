<?php
	class Model_loan extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		public function getLoansData($id = null){
			if ($id != null) {
				$sql = "SELECT * FROM `chomuonchi` WHERE idChoMuonChi=?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `chomuonchi` ORDER BY idChoMuonChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('chomuonchi', $data);
				return ($insert == true) ? true : false;
			}
		}

		public function update($data,$id){
			if($data && $id){
				$this->db->where('idChoMuonChi',$id);
				$update = $this->db->update('chomuonchi',$data);
				return ($update == true) ? true : false;
			}
		}

		public function remove($id){
			if($id){
				$this->db->where('idChoMuonChi',$id);
				$delete = $this->db->delete('chomuonchi');
				return ($delete == true) ? true : false;
			}
		}
	}
?>