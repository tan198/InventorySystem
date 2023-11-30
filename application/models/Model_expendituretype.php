<?php 

class Model_expendituretype extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */

	// public function getActiveExpenditureType()
	// {
	// 	$sql = "SELECT * FROM `loaihangmucchi` WHERE active = ?";
	// 	$query = $this->db->query($sql, array(1));
	// 	return $query->result_array();
	// }

	/* get the brand data */
	public function getExpenditureTypeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `loaihangmucchi` WHERE idLoaiHangMucChi = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `loaihangmucchi`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('loaihangmucchi', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idLoaiHangMucChi', $id);
			$update = $this->db->update('loaihangmucchi', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idLoaiHangMucChi', $id);
			$delete = $this->db->delete('loaihangmucchi');
			return ($delete == true) ? true : false;
		}
	}

}