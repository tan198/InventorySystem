<?php 

class Model_incometype extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	// public function getActiveIncomeType()
	// {
	// 	$sql = "SELECT * FROM `loaihangmucthu` WHERE active = ?";
	// 	$query = $this->db->query($sql, array(1));
	// 	return $query->result_array();
	// }

	/* get the brand data */
	public function getIncomeTypeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `loaihangmucthu` WHERE idLoaiHangMucThu = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `loaihangmucthu`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('loaihangmucthu', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idLoaiHangMucThu', $id);
			$update = $this->db->update('loaihangmucthu', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idLoaiHangMucThu', $id);
			$delete = $this->db->delete('loaihangmucthu');
			return ($delete == true) ? true : false;
		}
	}

}