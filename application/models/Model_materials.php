<?php
	class Model_materials extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getMaterialsData($id = null){
			if($id){
				$sql = "SELECT * FROM `vattuchi` WHERE idVatTuChi=?";
				$query = $this->db->query($sql,array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `vattuchi` ORDER BY idVatTuChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('vattuchi', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idVatTuChi', $id);
			$update = $this->db->update('vattuchi', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idVatTuChi', $id);
			$delete = $this->db->delete('vattuchi');
			return ($delete == true) ? true : false;
		}
	}
	}

	
?>