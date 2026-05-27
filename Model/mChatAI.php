<?php
class mChatAI {
    // Lấy kết nối database
    private function getConnection() {
        include_once("mKetNoiSV.php");
        $p = new ketnoiSV();
        $p->ketnoi($ketnoi);
        return $ketnoi;
    }

    // Lưu tin nhắn của sinh viên hoặc AI
    function LuuTinNhan($user_id, $sender_type, $message_content, $student_context = null) {
        $kn = $this->getConnection();
        if($kn) {
            $user_id = mysql_real_escape_string($user_id);
            $sender_type = mysql_real_escape_string($sender_type);
            $message_content = mysql_real_escape_string($message_content);
            $student_context = $student_context ? mysql_real_escape_string($student_context) : null;
            $created_date = date("Y-m-d H:i:s");

            $sql = "INSERT INTO chat_message (user_id, sender_type, message_content, student_context, is_read, created_date) 
                    VALUES ('$user_id', '$sender_type', '$message_content', " . ($student_context ? "'$student_context'" : "NULL") . ", 0, '$created_date')";
            $qr = mysql_query($sql);
            return $qr;
        }
        return false;
    }

    // Lấy lịch sử chat của sinh viên
    function LayLichSuChat($user_id, $limit = 50) {
        $kn = $this->getConnection();
        if($kn) {
            $user_id = mysql_real_escape_string($user_id);
            $limit = (int)$limit;
            $sql = "SELECT * FROM chat_message 
                    WHERE user_id = '$user_id' 
                    ORDER BY created_date DESC 
                    LIMIT $limit";
            $qr = mysql_query($sql);
            return $qr;
        }
        return false;
    }

    // Lấy tin nhắn chưa đọc
    function LayTinNhanChuaDoc($user_id) {
        $kn = $this->getConnection();
        if($kn) {
            $user_id = mysql_real_escape_string($user_id);
            $sql = "SELECT * FROM chat_message 
                    WHERE user_id = '$user_id' AND is_read = 0 AND sender_type = 'ai' 
                    ORDER BY created_date DESC";
            $qr = mysql_query($sql);
            return $qr;
        }
        return false;
    }

    // Đánh dấu tin nhắn đã đọc
    function DanhDauDaDoc($user_id) {
        $kn = $this->getConnection();
        if($kn) {
            $user_id = mysql_real_escape_string($user_id);
            $sql = "UPDATE chat_message SET is_read = 1 WHERE user_id = '$user_id' AND sender_type = 'ai'";
            $qr = mysql_query($sql);
            return $qr;
        }
        return false;
    }

    // Xóa lịch sử chat
    function XoaLichSuChat($user_id) {
        $kn = $this->getConnection();
        if($kn) {
            $user_id = mysql_real_escape_string($user_id);
            $sql = "DELETE FROM chat_message WHERE user_id = '$user_id'";
            $qr = mysql_query($sql);
            return $qr;
        }
        return false;
    }

    // Lấy ngữ cảnh học tập của sinh viên (để AI có cái nhìn toàn cảnh)
    function LayContextSV($user_id) {
        $kn = $this->getConnection();
        if($kn) {
            $user_id = mysql_real_escape_string($user_id);
            
            // Lấy thông tin sinh viên
            $sql_sv = "SELECT sv.*, u.user_code, u.email, cn.tenchuyennganh, kv.tenkhoa 
                       FROM sinhvien sv 
                       JOIN user u ON sv.user_id = u.user_id 
                       JOIN chuyennganh cn ON sv.id_chuyennganh = cn.id_chuyennganh 
                       JOIN khoavien kv ON cn.id_khoa = kv.id_khoa 
                       WHERE sv.user_id = '$user_id'";
            $qr_sv = mysql_query($sql_sv);
            $sv = mysql_fetch_assoc($qr_sv);

            // Lấy điểm gần nhất
            $sql_diem = "SELECT d.*, hp.tenhocphan 
                         FROM diem d 
                         JOIN hocphan hp ON d.id_hocphan = hp.id_hocphan 
                         WHERE d.id_sinhvien = '" . $sv['id_sinhvien'] . "' 
                         ORDER BY d.id_diem DESC LIMIT 5";
            $qr_diem = mysql_query($sql_diem);
            $diem = [];
            while($d = mysql_fetch_assoc($qr_diem)) {
                $diem[] = $d;
            }

            // Lấy khóa học hiện tại
            $sql_khoahoc = "SELECT hp.tenhocphan, hp.mahocphan, l.tenlophocphan 
                            FROM hoctap h 
                            JOIN sinhvien sv2 ON h.id_sinhvien = sv2.id_sinhvien 
                            JOIN monlop m ON h.id = m.id 
                            JOIN hocphan hp ON m.id_hocphan = hp.id_hocphan 
                            JOIN lophocphan l ON m.id_lophocphan = l.id_lophocphan 
                            WHERE sv2.id_sinhvien = '" . $sv['id_sinhvien'] . "'";
            $qr_khoahoc = mysql_query($sql_khoahoc);
            $khoahoc = [];
            while($kh = mysql_fetch_assoc($qr_khoahoc)) {
                $khoahoc[] = $kh;
            }

            // Lấy bài tập chưa nộp
            $sql_bt = "SELECT bt.tieude, bt.batdaunop, bt.ketthucnop, hp.tenhocphan 
                       FROM baitaplythuyet bt 
                       JOIN giangday gd ON bt.id_giangday = gd.id_giangday 
                       JOIN hocphan hp ON gd.id = hp.id_hocphan 
                       JOIN hoctap h ON h.id_sinhvien = '" . $sv['id_sinhvien'] . "' 
                       WHERE NOW() < bt.ketthucnop";
            $qr_bt = mysql_query($sql_bt);
            $baitap = [];
            while($bt = mysql_fetch_assoc($qr_bt)) {
                $baitap[] = $bt;
            }

            // Tạo context JSON
            $context = [
                'student_info' => $sv,
                'scores' => $diem,
                'current_courses' => $khoahoc,
                'pending_assignments' => $baitap
            ];

            return json_encode($context, JSON_UNESCAPED_UNICODE);
        }
        return null;
    }
}
?>
