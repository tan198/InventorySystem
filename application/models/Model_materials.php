<?php
	class Model_materials extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getMaterialsData($id = null){
			if($id){
				$sql = "SELECT * FROM `vattu` WHERE idVatTu=?";
				$query = $this->db->query($sql,array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `vattu` ORDER BY idVatTu DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function isLowestQuantity($materialid,$qtyinput){
			$material_data = $this->getMaterialsData($materialid);
    		$currentQuantity = (int) $material_data['soLuong'];
			return ($qtyinput >$currentQuantity);
		}

		public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('vattu', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($id, $data)
	{
		if($data && $id) {
			$this->db->where('idVatTu', $id);
			$update = $this->db->update('vattu', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idVatTu', $id);
			$delete = $this->db->delete('vattu');
			return ($delete == true) ? true : false;
		}
	}
	}
?>