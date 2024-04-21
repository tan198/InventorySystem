<?php
	
	class Model_refund extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getPaymentId($idTaiKhoan){
			if($idTaiKhoan){
				$sql = "SELECT loaiThanhToan FROM `loaiThanhToan` 
				LEFT JOIN taikhoan ON loaiThanhToan.id = taikhoan.loaithanhtoan_id WHERE taikhoan.idTaiKhoan = ?";
				$query = $this->db->query($sql, array($idTaiKhoan));
				return $query->row_array();
			}
		}

		public function create($data){
			if($data){
				$insert = $this->db->insert('taobangthu',$data);
				return ($insert == true) ? true : false;
			}
		}

		public function update($id, $data){
			if($id && $data){
				$this->db->where('idBangThu', $id);
				$update=$this->db->update( 'taobangthu' , $data );
				return ($update == true) ? true : false;
			}
		}

		public function delete($id){
			if($id){
				$this->db->where( 'idBangThu', $id );
				$delete = $this->db->delete('taobangthu');
				return ($delete == true) ? true : false;
			}
		}
	}
?>