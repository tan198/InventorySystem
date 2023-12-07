<?php
	class Model_projectexpenditure extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getProjectExpendData($id = null){
			if($id){
				$sql = "SELECT * FROM `duanchi` WHERE idDuAnChi =?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `duanchi` ORDER BY idDuAnChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('duanchi', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idDuAnChi', $id);
			$update = $this->db->update('taobangchi', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idDuAnChi', $id);
			$delete = $this->db->delete('duanchi');
			return ($delete == true) ? true : false;
		}
	}
	}
?>