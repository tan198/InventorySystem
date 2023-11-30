<?php 

class Model_fund extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getFundData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `taikhoan` where idTaiKhoan = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `taikhoan` ORDER BY idTaiKhoan DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('taikhoan', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idTaiKhoan', $id);
			$update = $this->db->update('taikhoan', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idTaiKhoan', $id);
			$delete = $this->db->delete('taikhoan');
			return ($delete == true) ? true : false;
		}
	}

}