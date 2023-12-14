<?php
	class Model_Investexp extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getInvestExpData($id = null){
			if($id){
				$sql = "SELECT * FROM `dautuchi` WHERE idDauTuChi=?";
				$query = $this->db->query($sql,array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `dautuchi` ORDER BY idDauTuChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('dautuchi', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idDauTuChi', $id);
			$update = $this->db->update('dautuchi', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idDauTuChi', $id);
			$delete = $this->db->delete('dautuchi');
			return ($delete == true) ? true : false;
		}
	}
	}

	
?>