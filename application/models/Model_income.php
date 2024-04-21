<?php
	
	class Model_income extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getIncomeData($id = null){
			if($id){
				$sql = "SELECT * FROM `taobangthu` WHERE idBangThu = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `taobangthu` ORDER BY idBangThu DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function updateTypeIncome($id,$typeIncome){
			if($id){
				$this->db->where('idBangThu',$id);
				$this->db->set('type_Income', $typeIncome);
				$updatesType = $this->db->update('taobangthu');
				return ($updatesType == true)?true:false;
			}
		}
		
		public function getTotalIncome() {
		$sql = "SELECT taikhoan.idTaiKhoan, SUM(CAST(REPLACE(taobangthu.tongTien, ',', '') AS float)) as totalIncome
				FROM taikhoan
				LEFT JOIN taobangthu ON taikhoan.idTaiKhoan = taobangthu.idTaiKhoan
				GROUP BY taikhoan.idTaiKhoan";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getNoteIncome($idBangThu = null){
        $sql = "SELECT ghiChu FROM `taobangthu` WHERE idBangThu=?";
        $query=$this->db->query($sql,array($idBangThu));
        return $query->result_array();
    }

    public function getMaterialInfo($idBangThu = null)
    {
        $sql = "SELECT taobangthu.idBangThu,taobangthu.ghiChu, vattu.tenVatTu, materialic_item.idVatTu, materialic_item.idVatTu AS materialId
				FROM taobangthu
				LEFT JOIN materialic_item ON taobangthu.idBangThu = materialic_item.idBangThu
				LEFT JOIN vattu ON materialic_item.idVatTu = vattu.idVatTu
				WHERE taobangthu.idBangThu = ?";
        $query = $this->db->query($sql, array($idBangThu));
        $result = $query->result_array();
        return $result;
    }

	public function getExportExcel(){
        $sql = 'SELECT hangmuc.loaiHangMuc AS tenHangMuc, taobangthu.tenHangMuc as tenCuaHangMuc, taobangthu.ghiChu AS ghiChu, taobangthu.materialStatus AS MaterialStatus, taikhoan.tenTaiKhoan AS TK, taobangthu.nguoiThu AS NguoiThu, taobangthu.ngayThu AS NgayThu,taobangthu.tongTien AS TongTien 
                FROM taobangthu
                LEFT JOIN hangmuc ON taobangthu.idHangMuc = hangmuc.idHangMuc
                LEFT JOIN taikhoan ON taobangthu.idTaiKhoan = taikhoan.idTaiKhoan';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	public function getMaterialItemData($idBangThu = null){
		if(!$idBangThu){
			return false;
		}
		$sql = "SELECT * FROM `materialic_item` WHERE idBangThu = ?";
		$query = $this->db->query($sql, array($idBangThu));
		return $query->result_array();
	}

		public function getStatusMaterial(){
			$sql = "SELECT * FROM `taobangthu` WHERE material_status=? ORDER BY idBangThu DESC";
			$query = $this->db->query($sql,array(0));
			return $query->result_array();
		}

		public function create($data){
			$this->db->insert('taobangthu',$data);
			$idBangThu = $this->db->insert_id();
			$this->load->model('model_materials');
			$count_material = count($this->input->post('material'));
			for ($x = 0; $x < $count_material ; $x++) {
				$items = array(
					'idBangThu' => $idBangThu,
					'idVatTu' => $this->input->post('material')[$x],
					'soLuong' => $this->input->post('quantity')[$x],
					'giaTien'=> $this->input->post('rate_value')[$x],
					'tongTien'=> $this->input->post('amount_value')[$x],
				);
				$this->db->insert('materialic_item',$items);
				$material_data = $this->model_materials->getMaterialsData($this->input->post('material')[$x]);
				$qty = (int) $material_data['soLuong'] - (int) $this->input->post('quantity')[$x];
				$update = array('soLuong'=> $qty);
				$this->model_materials->update($this->input->post('material')[$x],$update);
			}

			return ($idBangThu) ? $idBangThu : false;
		}

		public function create1($data){
			if($data) {
				$insert = $this->db->insert('taobangthu', $data);
				return ($insert == true) ? true : false;
			}
		}

		public function countMaterialItem($idBangThu){
			if($idBangThu){
				$sql = "SELECT * FROM `materialic_item` WHERE idBangThu=?";
				$query = $this->db->query($sql, array($idBangThu));
				return $query->num_rows();
			}
		}
		
		public function update($id,$data){
			if($id){
				$this->db->where('idBangThu',$id);
				$update = $this->db->update('taobangthu',$data);

				$this->load->model('model_materials');
				$get_materials_item = $this->getMaterialItemData($id);
				foreach ($get_materials_item as $key => $value) {
					$material_id = $value['idVatTu'];
					$qty_materials = $value['soLuong'];
					$material_data = $this->model_materials->getMaterialsData($material_id);

						$update_qty_materials = (int) $qty_materials + (int)$material_data['soLuong'];
						$update_material_data = array('soLuong' => $update_qty_materials);
	
						$this->model_materials->update($material_id, $update_material_data);
				}

				$this->db->where('idBangThu', $id);
				$this->db->delete('materialic_item');
				
				$material = $this->input->post('material');
				$quantity = $this->input->post('quantity');
				$rate_value = $this->input->post('rate_value');
				$amount_value = $this->input->post('amount_value');
				
				// Kiểm tra xem mảng có tồn tại và là mảng hợp lệ không trước khi sử dụng count()
				if ($material !== null && $quantity !== null && $rate_value !== null && $amount_value !== null 
					&& is_array($material) && is_array($quantity) && is_array($rate_value) && is_array($amount_value)) {
					
					$count_material = count($material);
					
					for ($x = 0; $x < $count_material; $x++) {
						// Kiểm tra xem phần tử tại vị trí $x của mỗi mảng có tồn tại không trước khi truy cập
						if (isset($material[$x]) && isset($quantity[$x]) && isset($rate_value[$x]) && isset($amount_value[$x])) {
							$items = array(
								'idBangThu' => $id,
								'idVatTu' => $material[$x],
								'soLuong' => $quantity[$x],
								'giaTien' => $rate_value[$x],
								'tongTien' => $amount_value[$x],
							);
							$this->db->insert('materialic_item',$items);
				
							$material_data = $this->model_materials->getMaterialsData($material[$x]);
							$qty_materials_remain = (int) $material_data['soLuong'] - (int)$quantity[$x];
							$update_material = array('soLuong' => $qty_materials_remain);
							$this->model_materials->update($material[$x], $update_material);
						} else {
							// Bỏ qua vòng lặp này hoặc thực hiện xử lý khác tùy thuộc vào yêu cầu của bạn
							continue;
						}
					}
					return true;
				}
			}
		}
		
		public function remove($id)
		{
			if($id) {
				$this->db->where('idBangThu', $id);
				$delete = $this->db->delete('taobangthu');
	
				$this->db->where('idBangThu', $id);
				$delete_item = $this->db->delete('materialic_item');
				return ($delete == true && $delete_item) ? true : false;
			}
		}

		public function updateMaterialStatus($id,$material_status){
			if($id){
				$this->db->where('idBangThu',$id);
				$this->db->set('materialStatus', $material_status);
				$updates = $this->db->update( 'taobangthu');
				return ($updates == true) ? true : false;
			}
		}

		public function removeMaterial($id){
			$this->db->select('id');
			$this->db->where('idBangThu', $id);
			$query = $this->db->get('materialic_item');
	
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$idVatTu = $row->idVatTu;
	
					// Xoá từ bảng material_item
					$this->db->where('idBangChi', $id);
					$this->db->where('idVatTu', $idVatTu);
					$this->db->delete('materialic_item');
				}
			}
		}
	}
?>