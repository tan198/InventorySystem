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
		$sql = "SELECT taikhoan.idTaiKhoan, SUM(CAST(REPLACE(taobangchi.soTien, ',', '') AS float)) as total
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

    public function update($id, $data){
        if ($id) {
            $idBangChi_item = $this->db->select('idBangChi')->get('material_item')->result_array();
            $idVatTu_item = $this->db->select('idVatTu')->where('idBangChi',$id)->get('material_item')->result_array();
            print_r($idVatTu_item);
            $material_id = $this->db->select('idVatTu')->get('vattu')->result_array();
            $list_idVatTu_item = array_column($idVatTu_item,'idVatTu');
            $list_material_id = array_column($material_id,'idVatTu');
            $common_value = array_intersect($list_idVatTu_item,$list_material_id);
            $this->db->where('idBangChi',$id);
            $query = $this->db->get('taobangchi');
            if ($query->num_rows() > 0){
                $row = $query->row();
                $idBangChi = $row->idBangChi;
    
                // Sửa lỗi so sánh biến với mảng
                if(!array($idBangChi_item,$idBangChi)){
                    $data1 = array();
    
                    $material_name = $this->input->post('material_name');
                    $qty = $this->input->post('quantity');
                    $rate = $this->input->post('rate');
    
                    for ($i = 0; $i < count($material_name); $i++) {
                        $data1[] = array(
                            'tenVatTu' => $material_name[$i],
                            'soLuong' => $qty[$i],
                            'giaTien' => $rate[$i]
                        );
                    }
    
                    // Thay đổi cách thêm dữ liệu vào cơ sở dữ liệu
                    $add_mater = $this->db->insert_batch('vattu', $data1);
                    $idVatTu = $this->db->insert_id();
                    
                    var_dump($add_mater);
                    $materialitem_data = array();
                    // Lặp qua dữ liệu của 'vattu' để tạo dữ liệu cho 'material_item'
                    foreach ($idVatTu as $material) {
                        $materialitem_data[] = array(
                            'idBangChi' => $idBangChi,
                            'idVatTu' => $idVatTu,
                            'soLuong' => $data1[$material]['soLuong'],
                            'rate' => $data1[$material]['giaTien'],
                            'tongTien' => $data1[$material]['soLuong'] * $data1[$material]['giaTien'],
                        );
                        
                    }
    
                    // Thay đổi cách thêm dữ liệu vào cơ sở dữ liệu
                    $add_mater_item = $this->db->insert_batch('material_item', $materialitem_data);

                    return ($add_mater == true && $add_mater_item==true)? true:false;
                }
                //elseif($common_value){
                //    // Sửa lỗi so sánh biến với mảng và tối ưu hóa thêm dữ liệu
                //    $idVatTu2 = 
                //    $data1 = array();
                    
                //    $material_name = $this->input->post('material_name');
                //    $qty = $this->input->post('quantity');
                //    $rate = $this->input->post('rate');
    
                //    for ($i = 0; $i < count($material_name); $i++) {
                //        $data1[] = array(
                //            // Sửa lỗi truy cập biến không đúng cách
                //            'tenVatTu' => $material_name[$i],
                //            'soLuong' => $qty[$i],
                //            'giaTien' => $rate[$i]
                //        );
                //    }
                //    // Thay đổi cách thêm dữ liệu vào cơ sở dữ liệu
                //    $add1 = $this->db->update_batch('vattu',$data1);
                //    $idVatTu1 = $this->db->insert_id();
                //    var_dump($add1);
                //    $materialitem_data = array();
                //    $material_id = 0;
                //    // Lặp qua dữ liệu của 'vattu' để tạo dữ liệu cho 'material_item'
                //    foreach ($data1 as $material) {
                //        $materialitem_data[] = array(
                //            'idBangChi' => $idBangChi,
                //            'idVatTu' =>$idVatTu1,
                //            'soLuong' => $material['soLuong'],
                //            'rate' => $material['giaTien'],
                //            'tongTien' => $material['soLuong'] * $material['giaTien'],
                            
                //        );
                //        $idVatTu1++;
                //    }
                //    $add2 = $this->db->insert_batch('material_item', $materialitem_data);
                //    return ($add1 == true && $add2 == true)? true : false;
                //}
                else{
                    $this->db->where('idBangChi', $id);
                    $existing_ids = $this->db->select('idVatTu')->get('material_item')->result_array();
    
                    $existing_ids = array_column($existing_ids, 'idVatTu');
    
                    $material_name = $this->input->post('material_name');
                    $qty = $this->input->post('quantity');
                    $rate = $this->input->post('rate');
    
                    $data1 = array();
                    foreach ($existing_ids as $index => $idVatTu) {
                        $data1[] = array(
                            'idVatTu' => $idVatTu,
                            'tenVatTu' => $material_name[$index],
                            'soLuong' => $qty[$index],
                            'giaTien' => $rate[$index],
                        );
    
                    }
    
                    // Update 'vattu' table
                    $this->db->update_batch('vattu', $data1, 'idVatTu');
    
                    $material_item = array();
                    $material_id = 0;
                    foreach ($data1 as $materials) {
                        $material_item[] = array(
                            'idBangChi' => $id,
                            'idVatTu' => $materials['idVatTu'],
                            'soLuong' => $materials['soLuong'],
                            'rate' => $materials['giaTien'],
                            'tongTien' => $materials['soLuong'] * $materials['giaTien'],
                        );
                    }
                    // Update 'material_item' table
                    $this->db->update_batch('material_item', $material_item,'idVatTu');
    
                    // Update 'taobangchi' table
                    $this->db->where('idBangChi', $id);
                    $this->db->update('taobangchi', $data);
    
                    return true;
                }
            }
            $this->db->where('idBangChi',$id);
            $update = $this->db->update('taobangchi',$data);
            return ($update == true) ? true : false;
        }
    }
    

    public function update1($id,$data){
        $this->db->where('idBangChi',$id);
        $update = $this->db->update('taobangchi',$data);
        return ($update == true) ? true : false;
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

    //public function removeMaterial($id)
    //{
    //    $this->db->select('idVatTu');
    //    $this->db->where('idBangChi', $id);
    //    $query = $this->db->get('material_item');

    //    if ($query->num_rows() > 0) {
    //        foreach ($query->result() as $row) {
    //            $idVatTu = $row->idVatTu;

    //            // Xoá từ bảng material_item
    //            $this->db->where('idBangChi', $id);
    //            $this->db->where('idVatTu', $idVatTu);
    //            $this->db->delete('material_item');

    //            // Xoá từ bảng vattu
    //            $this->db->where('idVatTu', $idVatTu);
    //            $this->db->delete('vattu');
    //        }
    //    }
    //}
}
