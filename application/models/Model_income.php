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
	

	public function getNoteIncome($idBangThu = null){
		$sql = "SELECT ghiChu FROM `taobangthu` WHERE idBangThu=?";
		$query = $this->db->query($sql, array($idBangThu));
		return $query->result_array();
	}

	public function getMaterialInfo($idBangThu = null)
    {
        $sql = "SELECT taobangthu.idBangThu, vattuchi.tenVatTu, material_itemic.idVatTuChi, materialic_item.idVatTuChi AS materialId
				FROM taobangthu
				LEFT JOIN materialic_item ON taobangthu.idBangThu = material_itemic.idBangThu
				LEFT JOIN vattuchi ON materialic_item.idVatTuChi = vattuchi.idVatTuChi
				WHERE taobangThu.idBangThu = ?";
        $query = $this->db->query($sql, array($idBangThu));
        $result = $query->result_array();
        return $result;
    }

	public function getExportExcel(){
        $sql = 'SELECT hangmucchi.tenHangMucChi AS tenHangMuc, taobangthu.tenHangMuc as tenCuaHangMuc, taobangthu.ghiChu AS ghiChu, taobangthu.materialStatus AS MaterialStatus, taikhoan.tenTaiKhoan AS TK, taobangthu.nguoiChi AS NguoiChi, taobangthu.ngayChi AS NgayChi,taobangthu.tongTien AS TongTien 
                FROM taobangthu
                LEFT JOIN hangmucchi ON taobangthu.idHangMucChi = hangmucchi.idHangMucChi
                LEFT JOIN taikhoan ON taobangthu.idTaiKhoan = taikhoan.idTaiKhoan';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	public function getMaterialicItemData($idBangThu = null){
		if(!$idBangThu){
			return false;
		}

		$sql = "SELECT * FROM `taobangthu` WHERE idBangThu =?";
		$query = $this->db->query($sql,array($idBangThu));
		return $query->result_array();
	}

	public function create($data,$data1){
		
	}

	public function create1($data)
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