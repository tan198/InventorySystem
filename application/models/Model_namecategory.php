<?php
	class Model_namecategory extends CI_Model {
		public function __construct(){
			parent::__construct() ;
		}

		public function getNameCategory($id = null){
			if($id){
				$sql = "SELECT * FROM namecate WHERE id=?";
				$query = $this->db->query( $sql, array($id) );
				return $query->row_array();
			}

			$sql = "SELECT * FROM namecate ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getName($idHangMuc){
			if($idHangMuc){
				$sql = "SELECT * FROM namecate WHERE id_hangmuc=?";
				$query = $this->db->query($sql, array($idHangMuc));
				return $query->result_array();
			}
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('namecate', $data);
				return  ($insert == true) ? true : false;
			}
		}

		public function update($id,$data){
			if($id && $data){
				$this->db->where('id', $id);
				$update=$this->db->update('namecate', $data);
				return ($update == true) ? true : false;
			}
		}

		public function delete($id){
			if($id){
				$this->db->where( 'id', $id);
				$delete = $this->db->delete( 'namecate' );
				return ($delete == true) ? true : false;
			}
		}
	}
?>