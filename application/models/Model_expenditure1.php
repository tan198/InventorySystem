<?php
	
	class Model_expenditure1 extends CI_Model{
		public function __construct(){
			parent::__construct();
		}

		public function getExpenditureData1($id = null){
			if($id){
				$sql = "SELECT * FROM `taobangchi1` WHERE idBangChi = ?";
				$query = $this->db->query($sql, array($id));
				return $query->row_array();
			}

			$sql = "SELECT * FROM `taobangchi1` ORDER BY idBangChi DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function getMaterialDetail(){
			$sql = "SELECT taobangchi1.idBangChi, material_item.idVatTuChi, material_item.tenVatTu FROM material_item LEFT JOIN taobangchi1
			ON taobangchi1.idBangChi = material_item.idBangChi GROUP BY material_item.idBangChi ";
		}

		public function getMaterialItemData($idBangChi = null){
			if(!$idBangChi){
				return false;
			}
			$sql = "SELECT * FROM `material_item` WHERE idBangChi = ?";
			$query = $this->db->query($sql, array($idBangChi));
			return $query->result_array();
		}

		public function getStatusMaterial(){
			$sql = "SELECT * FROM `taoobangchi1` WHERE material_status=? ORDER BY idBangChi DESC";
			$query = $this->db->query($sql,array(0));
			return $query->result_array();
		}

		public function create($data){
			$this->db->insert('taobangchi1',$data);
			$idbangchi1 = $this->db->insert_id();
			$this->load->model('model_materials');
			$count_material = count($this->input->post('material'));
			for ($x = 0; $x < $count_material ; $x++) {
				$items = array(
					'idBangChi' => $idbangchi1,
					'idVatTuChi' => $this->input->post('material')[$x],
					'soLuong' => $this->input->post('quantity')[$x],
					'rate'=> $this->input->post('rate_value')[$x],
					'tongTien'=> $this->input->post('amount_value')[$x],
				);
				$this->db->insert('material_item',$items);
				$material_data = $this->model_materials->getMaterialsData($this->input->post('material')[$x]);
				$qty = (int) $material_data['soLuong'] - (int) $this->input->post('quantity')[$x];
				$update = array('soLuong'=> $qty);
				$this->model_materials->update($update,$this->input->post('material')[$x]);
			}

			return ($idbangchi1) ? $idbangchi1 : false;
		}

		public function create1($data){
			if($data) {
				$insert = $this->db->insert('taobangchi1', $data);
				return ($insert == true) ? true : false;
				
			}
		}

		public function countMaterialItem($idBangChi){
			if($idBangChi){
				$sql = "SELECT * FROM `material_item` WHERE idBangChi=?";
				$query = $this->db->query($sql, array($idBangChi));
				return $query->num_rows();
			}
		}
		
		public function update($id,$data){
			if($id){
				$this->db->where('idBangChi',$id);
				$update = $this->db->update('taobangchi1',$data);

				$this->load->model('model_materials');
				$get_materials_item = $this->getMaterialItemData($id);
				foreach ($get_materials_item as $key => $value) {
					$material_id = $value['idVatTuChi'];
					$qty_materials = $value['soLuong'];
					$material_data = $this->model_materials->getMaterialsData($material_id);
					$update_qty = (int)$qty_materials + (int)$material_data['soLuong'];
					$update_material_data = array('soLuong' => $update_qty);

					$this->model_materials->update($update_material_data,$material_id);
				}

				$this->db->where('idBangChi', $id);
				$this->db->delete('material_item');

				$count_material = count($this->input->post('material'));
				
				for($x = 0; $x < $count_material;$x++){
					$items = array(
						'idBangChi' => $id,
						'idVatTuChi' => $this->input->post('material')[$x],
						'soLuong' => $this->input->post('quantity')[$x],
						'rate' => $this->input->post('rate_value')[$x],
						'tongTien' => $this->input->post('amount_value')[$x],
					);
					$this->db->insert('material_item',$items);

					$material_data = $this->model_materials->getMaterialsData($this->input->post('material')[$x]);
					$qty_materials_remain = (int)$material_data['soLuong'] - (int)$this->input->post('quantity')[$x];
					$update_material =array('soLuong'=>$qty_materials_remain);
					$this->model_materials->update($update_material,$this->input->post('material')[$x]);
				}
				return true;
			}
		}
		
		public function remove($id)
		{
			if($id) {
				$this->db->where('idBangChi', $id);
				$delete = $this->db->delete('taobangchi1');
	
				$this->db->where('idBangchi', $id);
				$delete_item = $this->db->delete('material_item');
				return ($delete == true && $delete_item) ? true : false;
			}
		}
	}
?>