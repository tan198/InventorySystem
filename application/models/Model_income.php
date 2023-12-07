<?php 

class Model_income extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getIncomeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `taobangthu` where idBangThu = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `taobangthu` ORDER BY idBangThu DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getTotalIncome() {
		$sql = "SELECT taikhoan.idTaiKhoan, SUM(CAST(REPLACE(taobangthu.soTienThu, ',', '') AS float)) as totalIncome
				FROM taikhoan
				LEFT JOIN taobangthu ON taikhoan.idTaiKhoan = taobangthu.idTaiKhoan
				GROUP BY taikhoan.idTaiKhoan";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('taobangthu', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('idBangThu', $id);
			$update = $this->db->update('taobangthu', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('idBangThu', $id);
			$delete = $this->db->delete('taobangthu');
			return ($delete == true) ? true : false;
		}
	}

}