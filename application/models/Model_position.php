<?php
	class Model_position extends CI_Model{
		public function __construct(){
			parent :: __construct();
		}

		public function getPostision($id=null){
			if($id){
				$sql = "SELECT * FROM position WHERE id=?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM position ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('position', $data);
				return  ($insert == true) ? true : false;
			}
		}

		public function update($data,$id){
			if($data && $id){
				$this->db->where('id',$id);
				$update = $this->db->update('position', $data);
				return  ($update == true) ? true : false;
			}
		}

		public function delete($id){
			$this->db->where('id',$id);
			$delete = $this->db->delete('position');
			return  ($delete == true) ? true : false;
		}
	}
?>