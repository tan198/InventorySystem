<?php

class Model_expenditure extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getExpenditureData($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM `taobangchi` WHERE idBangChi = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM `taobangchi` ORDER BY idBangChi DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	public function getTotalExpenditure() {
		$sql = "SELECT taikhoan.idTaiKhoan, SUM(CAST(REPLACE(taobangchi.tongTien, ',', '') AS float)) as total
				FROM taikhoan
				LEFT JOIN taobangchi ON taikhoan.idTaiKhoan = taobangchi.idTaiKhoan
				GROUP BY taikhoan.idTaiKhoan";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    public function getNoteExpenditure1($idBangChi = null){
        $sql = "SELECT ghiChu FROM `taobangchi` WHERE idBangChi=?";
        $query=$this->db->query($sql,array($idBangChi));
        return $query->result_array();
    }

    public function getMaterialInfo($idBangChi = null)
    {
        $sql = "SELECT taobangchi.idBangChi,taobangchi.ghiChu, vattu.tenVatTu, material_item.idVatTu, material_item.idVatTu AS materialId
				FROM taobangchi
				LEFT JOIN material_item ON taobangchi.idBangChi = material_item.idBangChi
				LEFT JOIN vattu ON material_item.idVatTu = vattu.idVatTu
				WHERE taobangchi.idBangChi = ?";
        $query = $this->db->query($sql, array($idBangChi));
        $result = $query->result_array();
        return $result;
    }

    public function getExportExcel(){
        $sql = 'SELECT hangmuc.loaiHangMuc AS tenHangMuc, taobangchi.tenHangMuc as tenCuaHangMuc, taobangchi.ghiChu AS ghiChu, taobangchi.materialStatus AS MaterialStatus, taikhoan.tenTaiKhoan AS TK, taobangchi.nguoiChi AS NguoiChi, taobangchi.ngayChi AS NgayChi,taobangchi.tongTien AS TongTien 
                FROM taobangchi
                LEFT JOIN hangmuc ON taobangchi.idHangMuc = hangmuc.idHangMuc
                LEFT JOIN taikhoan ON taobangchi.idTaiKhoan = taikhoan.idTaiKhoan';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMaterialItemData($idBangChi = null)
    {
        if (!$idBangChi) {
            return false;
        }
        $sql = "SELECT * FROM `material_item` WHERE idBangChi=?";
        $query = $this->db->query($sql, array($idBangChi));
        return $query->result_array();
    }


    public function getStatusMaterial()
    {
        $sql = "SELECT * FROM `taobangchi` WHERE material_status=? ORDER BY idBangChi DESC";
        $query = $this->db->query($sql, array(0));
        return $query->result_array();
    }

    public function create($data)
    {
        if ($data) {
            $insert = $this->db->insert('taobangchi', $data);
            return ($insert == true) ? true : false;

        }
    }
    public function create1($data = '', $data1 = '')
    {
        if (!empty($data)) {
            // Thêm dữ liệu vào bảng 'taobangchi'
            $create = $this->db->insert('taobangchi', $data);
            $idBangChi = $this->db->insert_id();

            // Kiểm tra xem $data1 là một mảng
            if ($create && is_array($data1)) {
                // Thêm dữ liệu vào bảng 'vattu'
                $create1 = $this->db->insert_batch('vattu', $data1);
                $idVatTu = $this->db->insert_id();
                if ($create1) {
                    $materialitem_data = array();
                    // Lặp qua dữ liệu của 'vattu' để tạo dữ liệu cho 'material_item'
                    foreach ($data1 as $material) {
                        $materialitem_data[] = array(
                            'idBangChi' => $idBangChi,
                            'idVatTu' => $idVatTu,
                            'soLuong' => $material['soLuong'],
                            'rate' => $material['giaTien'],
                            'tongTien' => $material['soLuong'] * $material['giaTien'],
                        );
                        $idVatTu++;
                    }

                    // Thêm dữ liệu vào bảng 'material_item'
                    $materialitem_inserted = $this->db->insert_batch('material_item', $materialitem_data);

                    return ($materialitem_inserted) ? true : false;
                }
            }
        }

        return false;
    }

    public function countMaterialItem($idBangChi)
    {
        if ($idBangChi) {
            $sql = "SELECT * FROM `material_item` WHERE idBangChi=?";
            $query = $this->db->query($sql, array($idBangChi));
            return $query->num_rows();
        }
    }

    public function createNewRow($id){
        if($id){
            $data[] = array(
                'tenVatTu' => $this->input->post('material_name1'),
                'loaiVatTu' => $this->input->post('type_material1'),
                'soLuong' => $this->input->post('quantity1'),
                'giaTien' => $this->input->post('rate1'),
            );

            $create = $this->db->insert_batch('vattu', $data);
            $idVatTu = $this->db->insert_id();

            if($create){
                $material_item = array();
                foreach($data as $material){
                    $material_item[] = array(
                        'idBangChi' => $id,
                        'idVatTu' =>  $idVatTu,
                        'loaiVatTu' => $material['loaiVatTu'],
                        'soLuong' => $material['soLuong'],
                        'rate' => $material['giaTien'],
                        'tongTien' => $material['soLuong'] * $material['giaTien']
                    );
                    $idVatTu++;
                }

                $materialitem_inserted = $this->db->insert_batch('material_item', $material_item);

                return ($materialitem_inserted) ? true : false;
            }

            return true;
        }
    }
    
    public function update($id, $data) {
        if ($id){
            $this->db->select('idVatTu');
            $this->db->where('idBangChi', $id);
            $query = $this->db->get('material_item');
            $rows = $query->result();
    
            $data1 = array();
            $material_name = $this->input->post('material_name');
            $type_material = $this->input->post('type_material');
            $qty = $this->input->post('quantity');
            $rate = $this->input->post('rate');
            foreach ($rows as $index => $row) {
                $idVatTu = $row->idVatTu;
            
                $data1[] = array(
                    'idVatTu' => $idVatTu,
                    'tenVatTu' => $material_name[$index], 
                    'loaiVatTu' => $type_material[$index],
                    'soLuong' => $qty[$index],
                    'giaTien' => $rate[$index]
                );
            }
    
            // Perform batch update for vatTu table
            $this->db->update_batch('vattu', $data1, 'idVatTu');
    
            $material_item = array();
            foreach ($data1 as $materials) {
                $material_item[] = array(
                    'idBangChi' => $id,
                    'idVatTu' => $materials['idVatTu'],
                    'loaiVatTu' => $materials['loaiVatTu'],
                    'soLuong' => $materials['soLuong'],
                    'rate' => $materials['giaTien'],
                    'tongTien' =>(int) $materials['soLuong'] * (int) $materials['giaTien'],
                );
            }
            // Update 'material_item' table
            $this->db->update_batch('material_item', $material_item,'idVatTu');
    
            $this->db->where('idBangChi', $id);
            $update = $this->db->update('taobangchi', $data);
            return ($update == true) ? true : false;
        }
    }

    public function update1($id,$data){
        $this->db->where('idBangChi',$id);
        $update = $this->db->update('taobangchi',$data);
        return ($update == true) ? true : false;
    }

    public function updateMaterialStatus($id,$material_status){
        if($id){
            $this->db->where('idBangChi',$id);
            $this->db->set('materialStatus', $material_status);
            $updates = $this->db->update( 'taobangchi');
            return ($updates == true) ? true : false;
        }
    }



    public function remove($id)
    {
        if ($id) {
            $this->db->where('idBangChi', $id);
            $delete = $this->db->delete('taobangchi');
            $this->db->where('idBangChi', $id);
            $delete_item = $this->db->delete('material_item');
            // Lấy idVatTu từ bảng material_item
            $this->db->select('idVatTu');
            $this->db->where('idBangChi', $id);
            $query = $this->db->get('material_item');

            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $idVatTu = $row->idVatTu;
                    // Xoá từ bảng vattu
                    $this->db->where('idVatTu', $idVatTu);
                    $delete_material = $this->db->delete('vattu');
                }
                return ($delete_material == true) ? true : false;
            }

            // Xoá từ bảng taobangchi

            return ($delete == true && $delete_item == true) ? true : false;
        }
    }

    public function removeMaterial($id)
    {
        $response = array('success' => false, 'message' => '');
    
        $this->db->select('idVatTu');
        $this->db->where('idBangChi', $id);
        $query = $this->db->get('material_item');
    
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $idVatTu = $row->idVatTu;
    
                // Xoá từ bảng material_item
                $this->db->where('idBangChi', $id);
                if (!$this->db->delete('material_item')) {
                    $response['message'] .= 'Failed to delete material items. ';
                }
    
                // Xoá từ bảng vattu
                $this->db->where('idVatTu', $idVatTu);
                if (!$this->db->delete('vattu')) {
                    $response['message'] .= 'Failed to delete materials. ';
                }
            }
        }
    
        if (empty($response['message'])) {
            $response['success'] = true;
        } else {
            $response['message'] = rtrim($response['message']);
        }
    
        return $response;
    }
    
}
