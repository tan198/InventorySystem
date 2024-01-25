<?php

class Model_category extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getCategoryData($id = null) {
        if($id){
            $sql = "SELECT * FROM `hangmuc` WHERE idHangMuc = ?";
            $query = $this->db->query($sql,array($id));
            return $query->row_array();
        }

        echo $id;

        $sql = "SELECT * FROM `hangmuc` ORDER BY idHangMuc DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
    }

    public function create($data=''){
        if($data ) {
			$create = $this->db->insert('hangmuc', $data);
			$idHangMuc = $this->db->insert_id();
			return ($create == true ) ? true : false;
		}
    }

    public function edit($data = array(), $id = null){
        $this->db->where('idHangMuc', $id);
		$update = $this->db->update('hangmuc', $data);
		return ($update == true) ? true : false;	
    }

    public function delete($id)
	{
		$this->db->where('idHangMuc', $id);
		$delete = $this->db->delete('hangmuc');
		return ($delete == true) ? true : false;
	}
}