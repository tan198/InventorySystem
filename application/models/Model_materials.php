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

		public function isLowestQuantity($materialid,$qtyinput){
			$material_data = $this->getMaterialsData($materialid);
    		$currentQuantity = (int) $material_data['soLuong'];
			return ($qtyinput >$currentQuantity);
		}

		public function create($data1)
	{
		if($data1) {
			$insert = $this->db->insert_batch('vattuchi', $data1);
			return ($insert == true) ? true : false;
		}
	}

	public function update($id, $data=array())
	{
		if($data && $id) {
			$this->db->where('idVatTuChi', $id);
			$update = $this->db->update_batch('vattuchi', $data );
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