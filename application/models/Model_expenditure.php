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
        $sql = "SELECT vattu.tenVatTu, ghiChu FROM `taobangchi`
                LEFT JOIN material_item ON taobangchi.idBangChi = material_item.idBangChi
                LEFT JOIN vattu ON material_item.idVatTu = vattu.idVatTu
                WHERE taobangchi.idBangChi = ?";
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
                            'loaiVatTu' => $material['loaiVatTu'],
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

    public function countMaterialItem($idBangChi){
        if ($idBangChi) {
            $sql = "SELECT * FROM `material_item` WHERE idBangChi=?";
            $query = $this->db->query($sql, array($idBangChi));
            return $query->num_rows();
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

                //insert new row material
                $data2 = array();

                $material_name1 = $this->input->post('material_name1');
                $type_material1 = $this->input->post('type_material1');
                $qty1 = $this->input->post('quantity1');
                $rate1 = $this->input->post('rate1');

                if (
                    !is_array($material_name1) || 
                    !is_array($type_material1) || 
                    !is_array($qty1) || 
                    !is_array($rate1) ||
                    count($material_name1) !== count($type_material1) ||
                    count($material_name1) !== count($qty1) ||
                    count($material_name1) !== count($rate1)
                ) {
                    // Handle error or return, depending on your application logic
                    // For demonstration purposes, let's log an error and exit
                    return true; // Or return an error message, redirect, etc.
                }else{
                    for ($i = 0; $i < count($material_name1); $i++) {
                        $data2[] = array(
                            'tenVatTu' => $material_name1[$i],
                            'loaiVatTu' => $type_material1[$i],
                            'soLuong' => $qty1[$i],
                            'giaTien' => $rate1[$i]
                        );
                    }
                    $this->db->insert_batch('vattu', $data2);
                
                    $material_item_new = array();
                    foreach ($data2 as $material) {
                        $material_item_new[] = array(
                            'idBangChi' => $id, 
                            'idVatTu' => $this->db->insert_id(), // Assuming idVatTu is auto-incremented
                            'loaiVatTu' => $material['loaiVatTu'],
                            'soLuong' => $material['soLuong'],
                            'rate' => $material['giaTien'],
                            'tongTien' => $material['soLuong'] * $material['giaTien']
                        );
                    }
                    $this->db->insert_batch('material_item', $material_item_new);
                }
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

    public function updateTypeExpenditure($id,$typeExpenditure){
        if($id){
            $this->db->where('idBangChi',$id);
            $this->db->set('typeExp', $typeExpenditure);
            $updatesType = $this->db->update('taobangchi');
            return ($updatesType == true)?true:false;
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

    public function removeMaterial($id){

        $this->db->where('idVatTu',$id);
        $delete_item = $this->db->delete('vattu');

        $this->db->where('idVatTu', $id);
        $delete1 = $this->db->delete('material_item');

        return ( $delete1 == true && $delete_item ) ? true : false;
    }
    
}
