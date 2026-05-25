<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>
<body>
<?php
// Controller xử lý Bài Tập Trắc Nghiệm
include_once("Model/mTracNghiem.php");

class TracNghiemController {
    private $model;
    
    function __construct() {
        $this->model = new TracNghiemModel();
        $this->model->ketnoi();
    }
    
    function __destruct() {
        $this->model->dongketnoi();
    }
    
    // ===== GIẢNG VIÊN =====
    
    // Xử lý thêm bài tập
    function xuLyThemBaiTap() {
        if(isset($_POST['them_baitap'])) {
            $tieude = $_POST['tieude'];
            $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
            $thoigianlambai = $_POST['thoigianlambai'];
            $soluongcauhoi = $_POST['soluongcauhoi'];
            $diemmotcau = $_POST['diemmotcau'];
            $batdaunop = $_POST['batdaunop'];
            $ketthucnop = $_POST['ketthucnop'];
            $id_giangday = $_POST['id_giangday'];
            
            $result = $this->model->themBaiTap($tieude, $mota, $thoigianlambai, $soluongcauhoi, $diemmotcau, $batdaunop, $ketthucnop, $id_giangday);
            
            if($result) {
                return array('success' => true, 'message' => 'Thêm bài tập thành công!');
            } else {
                return array('success' => false, 'message' => 'Thêm bài tập thất bại!');
            }
        }
        return null;
    }
    
    // Xử lý sửa bài tập
    function xuLySuaBaiTap() {
        if(isset($_POST['sua_baitap'])) {
            $id_bttracnghiem = $_POST['id_bttracnghiem'];
            $tieude = $_POST['tieude'];
            $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
            $thoigianlambai = $_POST['thoigianlambai'];
            $soluongcauhoi = $_POST['soluongcauhoi'];
            $diemmotcau = $_POST['diemmotcau'];
            $batdaunop = $_POST['batdaunop'];
            $ketthucnop = $_POST['ketthucnop'];
            
            $result = $this->model->suaBaiTap($id_bttracnghiem, $tieude, $mota, $thoigianlambai, $soluongcauhoi, $diemmotcau, $batdaunop, $ketthucnop);
            
            if($result) {
                return array('success' => true, 'message' => 'Sửa bài tập thành công!');
            } else {
                return array('success' => false, 'message' => 'Sửa bài tập thất bại!');
            }
        }
        return null;
    }
    
    // Xử lý xóa bài tập
    function xuLyXoaBaiTap() {
        if(isset($_GET['xoabaitap'])) {
            $id_bttracnghiem = $_GET['xoabaitap'];
            $result = $this->model->xoaBaiTap($id_bttracnghiem);
            
            if($result) {
                return array('success' => true, 'message' => 'Xóa bài tập thành công!');
            } else {
                return array('success' => false, 'message' => 'Xóa bài tập thất bại!');
            }
        }
        return null;
    }
    
    // Xử lý thêm câu hỏi
    function xuLyThemCauHoi() {
        if(isset($_POST['them_cauhoi'])) {
            $noidung = $_POST['noidung'];
            $hinhanh = isset($_POST['hinhanh']) ? $_POST['hinhanh'] : '';
            $dokho = isset($_POST['dokho']) ? $_POST['dokho'] : 'trungbinh';
            $id_bttracnghiem = $_POST['id_bttracnghiem'];
            
            $id_cauhoi = $this->model->themCauHoi($noidung, $hinhanh, $dokho, $id_bttracnghiem);
            
            if($id_cauhoi) {
                // Thêm các đáp án
                if(isset($_POST['dap_an'])) {
                    foreach($_POST['dap_an'] as $index => $noidung_dapan) {
                        if(!empty($noidung_dapan)) {
                            $ladung = (isset($_POST['dapan_dung']) && $_POST['dapan_dung'] == $index) ? 1 : 0;
                            $this->model->themDapAn($noidung_dapan, $ladung, $id_cauhoi);
                        }
                    }
                }
                
                return array('success' => true, 'message' => 'Thêm câu hỏi thành công!');
            } else {
                return array('success' => false, 'message' => 'Thêm câu hỏi thất bại!');
            }
        }
        return null;
    }
    
    // Xử lý xóa câu hỏi
    function xuLyXoaCauHoi() {
        if(isset($_GET['xoacauhoi'])) {
            $id_cauhoi = $_GET['xoacauhoi'];
            $result = $this->model->xoaCauHoi($id_cauhoi);
            
            if($result) {
                return array('success' => true, 'message' => 'Xóa câu hỏi thành công!');
            } else {
                return array('success' => false, 'message' => 'Xóa câu hỏi thất bại!');
            }
        }
        return null;
    }
    
    // ===== SINH VIÊN =====
    
    // Xử lý nộp bài
    function xuLyNopBai() {
        if(isset($_POST['nop_bai'])) {
            $id_bttracnghiem = $_POST['id_bttracnghiem'];
            $id_sinhvien = $_POST['id_sinhvien'];
            $dapAnChon = $_POST['dap_an'];
            
            $result = $this->model->chamDiem($id_bttracnghiem, $id_sinhvien, $dapAnChon);
            
            if($result) {
                return array('success' => true, 'data' => $result);
            } else {
                return array('success' => false, 'message' => 'Nộp bài thất bại!');
            }
        }
        return null;
    }
    
    // Lấy danh sách bài tập
    function getDanhSachBaiTap($id_giangday) {
        return $this->model->getDanhSachBaiTap($id_giangday);
    }
    
    // Lấy thông tin bài tập
    function getBaiTap($id_bttracnghiem) {
        return $this->model->getBaiTap($id_bttracnghiem);
    }
    
    // Lấy danh sách câu hỏi
    function getDanhSachCauHoi($id_bttracnghiem) {
        return $this->model->getDanhSachCauHoi($id_bttracnghiem);
    }
    
    // Lấy đáp án của câu hỏi
    function getDanhSachDapAn($id_cauhoi) {
        return $this->model->getDanhSachDapAn($id_cauhoi);
    }
    
    // Kiểm tra đã nộp bài chưa
    function kiemTraDaNop($id_bttracnghiem, $id_sinhvien) {
        return $this->model->kiemTraDaNop($id_bttracnghiem, $id_sinhvien);
    }
    
    // Lấy danh sách bài nộp
    function getDanhSachBaiNop($id_bttracnghiem) {
        return $this->model->getDanhSachBaiNop($id_bttracnghiem);
    }
    
    // Lấy kết quả bài nộp
    function getBaiNop($id_nopbai) {
        return $this->model->getBaiNop($id_nopbai);
    }
    
    // Lấy kết quả chi tiết
    function getKetQuaChiTiet($id_nopbai) {
        return $this->model->getKetQuaChiTiet($id_nopbai);
    }
    
    // Thống kê điểm
    function thongKeDiem($id_bttracnghiem) {
        return $this->model->thongKeDiem($id_bttracnghiem);
    }
    
    // Lấy câu hỏi
    function getCauHoi($id_cauhoi) {
        return $this->model->getCauHoi($id_cauhoi);
    }
    
    // Sửa câu hỏi
    function suaCauHoi($id_cauhoi, $noidung, $hinhanh, $dokho, $ds_dapan) {
        // Cập nhật câu hỏi
        $this->model->suaCauHoi($id_cauhoi, $noidung, $hinhanh, $dokho);
        
        // Xóa tất cả đáp án cũ
        $this->model->xoaTatCaDapAn($id_cauhoi);
        
        // Thêm lại đáp án mới
        foreach($ds_dapan as $index => $noidung_dapan) {
            if(!empty($noidung_dapan)) {
                $ladung = (isset($_POST['dapan_dung']) && $_POST['dapan_dung'] == $index) ? 1 : 0;
                $this->model->themDapAn($noidung_dapan, $ladung, $id_cauhoi);
            }
        }
        
        return true;
    }
}
?>
</body>
</html>
