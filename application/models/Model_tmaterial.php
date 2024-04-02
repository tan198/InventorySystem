<?php
	class Model_tmaterial extends CI_Model{

		public  function __construct() {
			parent::__construct();
		}

		public function getTmaterialData($id = null){
			if($id) {
				$sql = "SELECT * FROM typematerial WHERE  id=?";
				$query = $this->db->query( $sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM typematerial ORDER BY id DESC";
			$query = $this->db->query( $sql);
			return $query->result_array();
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('typematerial', $data );
				return ($insert == true) ? true : false;
			}
		}

		public function update($id, $data) {
			if($id && $data){
				$this->db->where('id', $id);
				$update = $this->db->update('typematerial',$data);
				return ($update == true) ? true : false;
			}
		}

		public function remove($id){
			if($id){
				$this->db->where('id', $id);
				$delete = $this->db->delete('typematerial');
				return ($delete == true) ? true : false;
			}
		}
	}
?>