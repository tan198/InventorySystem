<?php
	class Model_otherexpenditure extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		public function getTransaction($idBangChi){
			if($idBangChi){
				$sql = "SELECT receive_account FROM taobangchi WHERE idBangChi=?";
				$query = $this->db->query($sql, array($idBangChi));
				return $query->row_array();
			}
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('taobangchi',$data);
				return ($insert == true) ? true : false;
			}
		}

		public function update($id, $data){
			if($id && $data){
				$this->db->where('idBangChi', $id);
				$update=$this->db->update( 'taobangchi' , $data );
				return ($update == true) ? true : false;
			}
		}

		public function delete($id){
			if($id){
				$this->db->where( 'idBangChi', $id );
				$delete = $this->db->delete('taobangchi');
				return ($delete == true) ? true : false;
			}
		}
	}
?>