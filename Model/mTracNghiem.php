<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>
<body>
<?php
// Model cho Bài Tập Trắc Nghiệm
class TracNghiemModel {
    private $conn;
    
    function ketnoi() {
        $this->conn = mysql_connect('localhost', 'GiangVien', '123456');
        mysql_set_charset("utf8");
        if($this->conn) {
            return mysql_select_db('qlhv');
        }
        return false;
    }
    
    function dongketnoi() {
        mysql_close($this->conn);
    }
    
    // ===== BÀI TẬP TRẮC NGHIỆM =====
    
    // Lấy danh sách bài tập theo giảng dạy
    function getDanhSachBaiTap($id_giangday) {
        $sql = "SELECT * FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday' ORDER BY ngaydang DESC";
        return mysql_query($sql);
    }
    
    // Lấy thông tin bài tập
    function getBaiTap($id_bttracnghiem) {
        $sql = "SELECT * FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
        $qr = mysql_query($sql);
        return mysql_fetch_assoc($qr);
    }
    
    // Thêm bài tập mới
    function themBaiTap($tieude, $mota, $thoigianlambai, $soluongcauhoi, $diemmotcau, $batdaunop, $ketthucnop, $id_giangday) {
        $ngaydang = date('Y-m-d H:i:s');
        $sql = "INSERT INTO baitap_tracnghiem (tieude, mota, thoigianlambai, soluongcauhoi, diemmotcau, batdaunop, ketthucnop, ngaydang, id_giangday) 
                VALUES ('$tieude', '$mota', '$thoigianlambai', '$soluongcauhoi', '$diemmotcau', '$batdaunop', '$ketthucnop', '$ngaydang', '$id_giangday')";
        return mysql_query($sql);
    }
    
    // Sửa bài tập
    function suaBaiTap($id_bttracnghiem, $tieude, $mota, $thoigianlambai, $soluongcauhoi, $diemmotcau, $batdaunop, $ketthucnop) {
        $sql = "UPDATE baitap_tracnghiem SET 
                tieude = '$tieude', 
                mota = '$mota', 
                thoigianlambai = '$thoigianlambai', 
                soluongcauhoi = '$soluongcauhoi', 
                diemmotcau = '$diemmotcau', 
                batdaunop = '$batdaunop', 
                ketthucnop = '$ketthucnop' 
                WHERE id_bttracnghiem = '$id_bttracnghiem'";
        return mysql_query($sql);
    }
    
    // Xóa bài tập (xóa cả câu hỏi và đáp án liên quan)
    function xoaBaiTap($id_bttracnghiem) {
        // Lấy danh sách câu hỏi
        $sql_cauhoi = "SELECT id_cauhoi FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
        $qr_cauhoi = mysql_query($sql_cauhoi);
        while($cauhoi = mysql_fetch_assoc($qr_cauhoi)) {
            // Xóa đáp án
            mysql_query("DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '".$cauhoi['id_cauhoi']."'");
        }
        // Xóa câu hỏi
        mysql_query("DELETE FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
        // Xóa bài nộp
        mysql_query("DELETE FROM nopbai_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
        // Xóa bài tập
        $sql = "DELETE FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
        return mysql_query($sql);
    }
    
    // ===== CÂU HỎI =====
    
    // Lấy danh sách câu hỏi
    function getDanhSachCauHoi($id_bttracnghiem) {
        $sql = "SELECT * FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem' ORDER BY id_cauhoi";
        return mysql_query($sql);
    }
    
    // Lấy thông tin câu hỏi
    function getCauHoi($id_cauhoi) {
        $sql = "SELECT * FROM cauhoi_tracnghiem WHERE id_cauhoi = '$id_cauhoi'";
        $qr = mysql_query($sql);
        return mysql_fetch_assoc($qr);
    }
    
    // Thêm câu hỏi
    function themCauHoi($noidung, $hinhanh, $dokho, $id_bttracnghiem) {
        $sql = "INSERT INTO cauhoi_tracnghiem (noidung, hinhanh, dokho, id_bttracnghiem) 
                VALUES ('$noidung', '$hinhanh', '$dokho', '$id_bttracnghiem')";
        $result = mysql_query($sql);
        if($result) {
            return mysql_insert_id();
        }
        return false;
    }
    
    // Sửa câu hỏi
    function suaCauHoi($id_cauhoi, $noidung, $hinhanh, $dokho) {
        $sql = "UPDATE cauhoi_tracnghiem SET noidung = '$noidung', hinhanh = '$hinhanh', dokho = '$dokho' WHERE id_cauhoi = '$id_cauhoi'";
        return mysql_query($sql);
    }
    
    // Xóa câu hỏi (xóa cả đáp án)
    function xoaCauHoi($id_cauhoi) {
        mysql_query("DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi'");
        $sql = "DELETE FROM cauhoi_tracnghiem WHERE id_cauhoi = '$id_cauhoi'";
        return mysql_query($sql);
    }
    
    // ===== ĐÁP ÁN =====
    
    // Lấy danh sách đáp án
    function getDanhSachDapAn($id_cauhoi) {
        $sql = "SELECT * FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi'";
        return mysql_query($sql);
    }
    
    // Thêm đáp án
    function themDapAn($noidung, $ladapan_dung, $id_cauhoi) {
        $sql = "INSERT INTO dapan_tracnghiem (noidung, ladapan_dung, id_cauhoi) VALUES ('$noidung', '$ladapan_dung', '$id_cauhoi')";
        return mysql_query($sql);
    }
    
    // Xóa tất cả đáp án của câu hỏi
    function xoaTatCaDapAn($id_cauhoi) {
        $sql = "DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi'";
        return mysql_query($sql);
    }
    
    // ===== NỘP BÀI & CHẤM ĐIỂM =====
    
    // Kiểm tra sinh viên đã nộp bài chưa
    function kiemTraDaNop($id_bttracnghiem, $id_sinhvien) {
        $sql = "SELECT * FROM nopbai_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem' AND id_sinhvien = '$id_sinhvien'";
        $qr = mysql_query($sql);
        return mysql_fetch_assoc($qr);
    }
    
    // Lấy danh sách bài nộp theo bài tập
    function getDanhSachBaiNop($id_bttracnghiem) {
        $sql = "SELECT nb.*, sv.tensinhvien, sv.masosinhvien 
                FROM nopbai_tracnghiem nb 
                JOIN sinhvien sv ON nb.id_sinhvien = sv.id_sinhvien 
                WHERE nb.id_bttracnghiem = '$id_bttracnghiem' 
                ORDER BY nb.diem DESC";
        return mysql_query($sql);
    }
    
    // Lấy thông tin bài nộp
    function getBaiNop($id_nopbai) {
        $sql = "SELECT nb.*, sv.tensinhvien, sv.masosinhvien 
                FROM nopbai_tracnghiem nb 
                JOIN sinhvien sv ON nb.id_sinhvien = sv.id_sinhvien 
                WHERE nb.id_nopbai = '$id_nopbai'";
        $qr = mysql_query($sql);
        return mysql_fetch_assoc($qr);
    }
    
    // Nộp bài và chấm điểm
    function chamDiem($id_bttracnghiem, $id_sinhvien, $dapAnChon) {
        // Lấy thông tin bài tập
        $bt = $this->getBaiTap($id_bttracnghiem);
        if(!$bt) return false;
        
        $diemmotcau = $bt['diemmotcau'];
        $tongcau = 0;
        $socaudung = 0;
        
        // Lấy danh sách câu hỏi
        $ds_cauhoi = $this->getDanhSachCauHoi($id_bttracnghiem);
        $tongcau = mysql_num_rows($ds_cauhoi);
        
        while($cauhoi = mysql_fetch_assoc($ds_cauhoi)) {
            $id_cauhoi = $cauhoi['id_cauhoi'];
            
            // Lấy đáp án đúng của câu hỏi
            $sql_dung = "SELECT id_dapan FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi' AND ladapan_dung = 1";
            $qr_dung = mysql_query($sql_dung);
            $dapandung = mysql_fetch_assoc($qr_dung);
            
            // Kiểm tra đáp án sinh viên chọn
            $dapan_chon = isset($dapAnChon[$id_cauhoi]) ? $dapAnChon[$id_cauhoi] : 0;
            $dung_sai = ($dapan_chon == $dapandung['id_dapan']) ? 1 : 0;
            
            if($dung_sai) {
                $socaudung++;
            }
        }
        
        // Tính điểm
        $diem = round($socaudung * $diemmotcau, 2);
        
        // Lưu vào bảng nộp bài
        $thoigian_nop = date('Y-m-d H:i:s');
        
        // Xóa bài cũ nếu có
        $check = $this->kiemTraDaNop($id_bttracnghiem, $id_sinhvien);
        if($check) {
            // Cập nhật lại
            mysql_query("DELETE FROM chitiet_tracnghiem WHERE id_nopbai = '".$check['id_nopbai']."'");
            mysql_query("DELETE FROM nopbai_tracnghiem WHERE id_nopbai = '".$check['id_nopbai']."'");
        }
        
        // Thêm bài nộp mới
        $sql_nopbai = "INSERT INTO nopbai_tracnghiem (id_bttracnghiem, id_sinhvien, diem, socautraloi_dung, thoigian_nop, trangthai) 
                       VALUES ('$id_bttracnghiem', '$id_sinhvien', '$diem', '$socaudung', '$thoigian_nop', 'daday')";
        mysql_query($sql_nopbai);
        $id_nopbai = mysql_insert_id();
        
        // Lưu chi tiết
        $ds_cauhoi2 = $this->getDanhSachCauHoi($id_bttracnghiem);
        while($cauhoi = mysql_fetch_assoc($ds_cauhoi2)) {
            $id_cauhoi = $cauhoi['id_cauhoi'];
            
            // Lấy đáp án đúng
            $sql_dung = "SELECT id_dapan FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi' AND ladapan_dung = 1";
            $qr_dung = mysql_query($sql_dung);
            $dapandung = mysql_fetch_assoc($qr_dung);
            
            $dapan_chon = isset($dapAnChon[$id_cauhoi]) ? $dapAnChon[$id_cauhoi] : 0;
            $dung_sai = ($dapan_chon == $dapandung['id_dapan']) ? 1 : 0;
            
            $sql_chitiet = "INSERT INTO chitiet_tracnghiem (id_nopbai, id_cauhoi, id_dapan_chon, dung_sai) 
                           VALUES ('$id_nopbai', '$id_cauhoi', '$dapan_chon', '$dung_sai')";
            mysql_query($sql_chitiet);
        }
        
        return array(
            'diem' => $diem,
            'socaudung' => $socaudung,
            'tongcau' => $tongcau
        );
    }
    
    // Lấy kết quả chi tiết
    function getKetQuaChiTiet($id_nopbai) {
        $sql = "SELECT ct.*, ch.noidung as cauhoi, ch.dokho, da.noidung as dapan_chon, 
                (SELECT noidung FROM dapan_tracnghiem WHERE id_cauhoi = ct.id_cauhoi AND ladapan_dung = 1) as dapan_dung
                FROM chitiet_tracnghiem ct
                JOIN cauhoi_tracnghiem ch ON ct.id_cauhoi = ch.id_cauhoi
                LEFT JOIN dapan_tracnghiem da ON ct.id_dapan_chon = da.id_dapan
                WHERE ct.id_nopbai = '$id_nopbai'";
        return mysql_query($sql);
    }
    
    // Thống kê điểm theo bài tập
    function thongKeDiem($id_bttracnghiem) {
        $sql = "SELECT 
                    COUNT(*) as tong_sv,
                    AVG(diem) as diem_trung_binh,
                    MAX(diem) as diem_cao_nhat,
                    MIN(diem) as diem_thap_nhat,
                    SUM(CASE WHEN diem >= 8.5 THEN 1 ELSE 0 END) as sosv_gioi,
                    SUM(CASE WHEN diem >= 7 AND diem < 8.5 THEN 1 ELSE 0 END) as sosv_kha,
                    SUM(CASE WHEN diem >= 5 AND diem < 7 THEN 1 ELSE 0 END) as sosv_trungbinh,
                    SUM(CASE WHEN diem < 5 THEN 1 ELSE 0 END) as sosv_yeu
                FROM nopbai_tracnghiem 
                WHERE id_bttracnghiem = '$id_bttracnghiem' AND trangthai = 'daday'";
        $qr = mysql_query($sql);
        return mysql_fetch_assoc($qr);
    }
}
?>
</body>
</html>
