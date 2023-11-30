<?php

class Model_expenditurecategory extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getExpenditureCategoryData($id = null) {
        if($id){
            $sql = "SELECT * FROM `hangmucchi` WHERE idHangMucChi = ?";
            $query = $this->db->query($sql,array($id));
            return $query->row_array();
        }

        echo $id;

        $sql = "SELECT * FROM `hangmucchi` ORDER BY idHangMucChi DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    public function getExpenditureCategoryType($idHangMucChi = null){
        if($idHangMucChi){
            $sql = "SELECT * FROM `loai_hangchi` WHERE idHangMucChi = ? ";
            $query = $this->db->query($sql,array($idHangMucChi));
            $result = $query->row_array();

            $idLoaiHangMucChi = $result['idLoaiHangMucChi'];
            $l_sql = "SELECT * FROM `loaihangmucchi` WHERE idLoaiHangMucChi = ?";
            $l_query = $this->db->query($l_sql,array($idLoaiHangMucChi));
            $l_result = $l_query->row_array();
            return $l_result;

        }
    }

    public function create($data='', $idLoaiHangMucChi = null){
        if($data && $idLoaiHangMucChi) {
			$create = $this->db->insert('hangmucchi', $data);

			$idHangMucChi = $this->db->insert_id();

			$expenditurecategorytype_data = array(
				'idHangMucChi' => $idHangMucChi,
				'idLoaiHangMucChi' => $idLoaiHangMucChi
			);

			$expenditurecategorytype_data = $this->db->insert('loai_hangchi', $expenditurecategorytype_data);

			return ($create == true && $expenditurecategorytype_data) ? true : false;
		}
    }

    public function edit($data = array(), $id = null, $idLoaiHangMucChi = null){
        $this->db->where('idHangMucChi', $id);
		$update = $this->db->update('hangmucchi', $data);

		if($idLoaiHangMucChi) {
			
			$update_expenditurecategorytype = array('idLoaiHangMucChi' => $idLoaiHangMucChi);
			$this->db->where('idHangMucChi', $id);
			$expenditurecategorytype = $this->db->update('loai_hangchi', $update_expenditurecategorytype);
			return ($update == true && $expenditurecategorytype == true) ? true : false;	
		}
			
		return ($update == true) ? true : false;	
    }

    public function delete($id)
	{
		$this->db->where('idHangMucChi', $id);
		$delete = $this->db->delete('hangmucchi');
		return ($delete == true) ? true : false;
	}
}