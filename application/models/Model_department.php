<?php

class Model_department  extends CI_Model {

	public function  __construct(){
		parent::__construct();
	}

	public function getDepartment($id = null){
		if ($id !=null) {
			$sql ="SELECT * FROM department WHERE id=?";
			$query=$this->db->query($sql,array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM department ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function create($data){
		if($data){
			$insert = $this->db->insert('department', $data);
			return  ($insert == true) ? true : false;
		}
	}

	public function  update($data,$id){
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('department',$data);
			return ($update == true) ? true : false;
		}
	}

	public function  remove($id){
		$this->db->where('id',$id);
		$delete = $this->db->delete('department');
		return  ($delete == true) ? true : false;
	}
}
?>