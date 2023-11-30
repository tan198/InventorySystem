<?php 

class Model_expenditure extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getExpenditureData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `taobangchi` where idBangChi = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `taobangchi` ORDER BY idBangChi DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function getTotalExpenditure() {
		$sql = "SELECT taikhoan.idTaiKhoan, SUM(CAST(REPLACE(taobangchi.soTien, ',', '') AS float)) as total
				FROM taikhoan
				LEFT JOIN taobangchi ON taikhoan.idTaiKhoan = taobangchi.idTaiKhoan
				GROUP BY taikhoan.idTaiKhoan";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('taobangchi', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idBangChi', $id);
			$update = $this->db->update('taobangchi', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idBangChi', $id);
			$delete = $this->db->delete('taobangchi');
			return ($delete == true) ? true : false;
		}
	}

}