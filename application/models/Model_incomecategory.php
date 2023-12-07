<?php

class Model_incomecategory extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getIncomeCategoryData($idHangMucThu = null) {
        if($idHangMucThu){
            $sql = "SELECT * FROM `hangmucthu` WHERE idHangMucThu = ?";
            $query = $this->db->query($sql,array($idHangMucThu));
            return $query->row_array();
        }

        $sql = "SELECT * FROM `hangmucthu` ORDER BY idHangMucThu DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    public function getIncomeCategoryType($idHangMucThu = null){
        if($idHangMucThu){
            $sql = "SELECT * FROM `loai_hangthu` WHERE idHangMucThu = ? ";
            $query = $this->db->query($sql,array($idHangMucThu));
            $result = $query->row_array();

            $idLoaiHangMucThu = $result['idLoaiHangMucThu'];
            $lt_sql = "SELECT * FROM `loaihangmucthu` WHERE idLoaiHangMucThu = ?";
            $lt_query = $this->db->query($lt_sql,array($idLoaiHangMucThu));
            $lt_result = $lt_query->row_array();
            return $lt_result;

        }
    }

    public function create($data='', $idLoaiHangMucThu = null){
        if($data && $idLoaiHangMucThu) {
			$create = $this->db->insert('hangmucthu', $data);

			$idHangMucThu = $this->db->insert_id();

			$incomecategorytype_data = array(
				'idHangMucThu' => $idHangMucThu,
				'idLoaiHangMucThu' => $idLoaiHangMucThu
			);

			$incomecategorytype_data = $this->db->insert('loai_hangthu', $incomecategorytype_data);

			return ($create == true && $incomecategorytype_data) ? true : false;
		}
    }

    public function edit($data = array(), $id = null, $idLoaiHangMucThu = null){
        $this->db->where('idHangMucThu', $id);
		$update = $this->db->update('hangmucthu', $data);

		if($idLoaiHangMucThu) {
			
			$update_incomecategorytype = array('idLoaiHangMucThu' => $idLoaiHangMucThu);
			$this->db->where('idHangMucThu', $id);
			$incomecategorytype = $this->db->update('loai_hangthu', $update_incomecategorytype);
			return ($update == true && $incomecategorytype == true) ? true : false;	
		}
			
		return ($update == true) ? true : false;	
    }

    public function delete($id)
	{
		$this->db->where('idHangMucThu', $id);
		$delete = $this->db->delete('hangmucthu');
		return ($delete == true) ? true : false;
	}
}