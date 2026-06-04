<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit;
}

try {
    class ketnoiSV {
        function ketnoi($ketnoi) {
            $ketnoi = mysql_connect('localhost', 'SinhVien', '123456', 'qlhv');
            mysql_set_charset("utf8");
            if ($ketnoi) {
                return mysql_select_db('qlhv');
            } else {
                return false;
            }
        }
        function dongketnoi($ketnoi) {
            mysql_close($ketnoi);
        }
    }

    // Class xu ly Chat AI - Luu va lay tin nhan
    class mChatAI {
        var $kn;

        function mChatAI() {
            $p = new ketnoiSV();
            $this->kn = $p->ketnoi($ketnoi);
        }

        // Luu tin nhan vao database
        function LuuTinNhan($user_id, $sender_type, $message_content, $student_context) {
            if(!$this->kn) return false;

            $user_id = mysql_real_escape_string($user_id);
            $sender_type = mysql_real_escape_string($sender_type);
            $message_content = mysql_real_escape_string($message_content);
            $student_context = $student_context ? mysql_real_escape_string($student_context) : "NULL";
            $created_date = date("Y-m-d H:i:s");

            if ($student_context == "NULL") {
                $sql = "INSERT INTO chat_message (user_id, sender_type, message_content, student_context, is_read, created_date)
                        VALUES ('$user_id', '$sender_type', '$message_content', NULL, 0, '$created_date')";
            } else {
                $sql = "INSERT INTO chat_message (user_id, sender_type, message_content, student_context, is_read, created_date)
                        VALUES ('$user_id', '$sender_type', '$message_content', '$student_context', 0, '$created_date')";
            }
            return mysql_query($sql);
        }

        // Lay lich su chat cua sinh vien
        function LayLichSuChat($user_id, $limit) {
            if(!$this->kn) return false;

            $user_id = mysql_real_escape_string($user_id);
            $limit = intval($limit);

            $sql = "SELECT * FROM chat_message
                    WHERE user_id = '$user_id'
                    ORDER BY created_date DESC
                    LIMIT $limit";
            return mysql_query($sql);
        }

        // Lay ngữ cảnh hoc tap cua sinh vien
        function LayContextSV($user_id) {
            if(!$this->kn) return "";

            $user_id = mysql_real_escape_string($user_id);

            // Lay thong tin sinh vien
            $sql_sv = "SELECT sv.*, u.user_code, u.email, cn.tenchuyennganh, kv.tenkhoa
                       FROM sinhvien sv
                       JOIN user u ON sv.user_id = u.user_id
                       JOIN chuyennganh cn ON sv.id_chuyennganh = cn.id_chuyennganh
                       JOIN khoavien kv ON cn.id_khoa = kv.id_khoa
                       WHERE sv.user_id = '$user_id'";
            $qr_sv = mysql_query($sql_sv);
            $sv = mysql_fetch_assoc($qr_sv);

            // Lay diem gan nhat
            $diem_arr = array();
            if ($sv) {
                $sql_diem = "SELECT d.*, hp.tenhocphan
                             FROM diem d
                             JOIN hocphan hp ON d.id_hocphan = hp.id_hocphan
                             WHERE d.id_sinhvien = '" . $sv['id_sinhvien'] . "'
                             ORDER BY d.id_diem DESC LIMIT 5";
                $qr_diem = mysql_query($sql_diem);
                while($d = mysql_fetch_assoc($qr_diem)) {
                    $diem_arr[] = $d;
                }
            }

            // Lay khoa hoc hien tai
            $khoahoc_arr = array();
            if ($sv) {
                $sql_khoahoc = "SELECT hp.tenhocphan, hp.mahocphan, l.tenlophocphan
                                FROM hoctap h
                                JOIN sinhvien sv2 ON h.id_sinhvien = sv2.id_sinhvien
                                JOIN monlop m ON h.id = m.id
                                JOIN hocphan hp ON m.id_hocphan = hp.id_hocphan
                                JOIN lophocphan l ON m.id_lophocphan = l.id_lophocphan
                                WHERE sv2.id_sinhvien = '" . $sv['id_sinhvien'] . "'";
                $qr_khoahoc = mysql_query($sql_khoahoc);
                while($kh = mysql_fetch_assoc($qr_khoahoc)) {
                    $khoahoc_arr[] = $kh;
                }
            }

            // Tao context JSON
            $context = array(
                'student_info' => $sv,
                'scores' => $diem_arr,
                'current_courses' => $khoahoc_arr
            );

            // PHP 5.2 khong ho tro JSON_UNESCAPED_UNICODE nen dung utf8_encode
            return json_encode($context);
        }

        // Xoa lich su chat
        function XoaLichSuChat($user_id) {
            if(!$this->kn) return false;
            $user_id = mysql_real_escape_string($user_id);
            $sql = "DELETE FROM chat_message WHERE user_id = '$user_id'";
            return mysql_query($sql);
        }
    }

    $p = new ketnoiSV();
    $kn = $p->ketnoi($ketnoi);

    // Get user info from session
    $user_id = null;
    $tmp = "hocsinh";
    // lay vai tro
    if (isset($_SESSION['ma']) && isset($_SESSION['mk'])) {
        $mauser = $_SESSION['ma'];
        $sql = "SELECT * FROM user WHERE user_code = '$mauser'";
        $qr = mysql_query($sql);
        if ($qr && mysql_num_rows($qr) > 0) {
            $r = mysql_fetch_assoc($qr);
            $user_id = $r['user_id'];
            if ($r['vaitro'] == 0) {
                $tmp = "hocsinh";
            } else if ($r['vaitro'] == 1) {
                $tmp = "giangvien";
            } else {
                $tmp = "admin";
            }
        }
    }

    require './config.php';

    // Debug mode
    ini_set('display_errors', 0);
    error_reporting(0);
    set_time_limit(0);

    // Nhan du lieu tu request
    $data = json_decode(file_get_contents('php://input'), true);

    $prompt = isset($data['prompt']) && trim($data['prompt']) !== ''
        ? trim($data['prompt'])
        : "Nhap mon lap trinh hoc cai gi vay toi so qua";

    // =====================
    // ADMIN FLOW - Dung /chat-ai endpoint
    // =====================
    if ($tmp == "admin") {
        $ollamaUrl = CAL_LLM_CHAT;

        $payload = json_encode(array(
            "message" => $prompt,
            "role" => $tmp
        ));

        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $ollamaUrl);
        curl_setopt($ch1, CURLOPT_POST, true);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);

        $response1 = curl_exec($ch1);
        $httpCode1 = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
        $error1 = curl_error($ch1);

        curl_close($ch1);

        if ($error1) {
            echo json_encode(array('response' => "Loi ket noi: " . $error1));
            exit;
        }

        if ($httpCode1 !== 200) {
            echo json_encode(array('response' => "HTTP Error: " . $httpCode1 . " - Response: " . substr($response1, 0, 200)));
            exit;
        }

        $rs = json_decode($response1, true);

        $responseText = "";
        $extraTables = "";

        if (isset($rs['message'])) {
            $msgData = $rs['message'];
            $responseText = is_array($msgData) ? (isset($msgData['content']) ? $msgData['content'] : json_encode($msgData)) : $msgData;
        } elseif (isset($rs['response'])) {
            $msgData = $rs['response'];
            $responseText = is_array($msgData) ? (isset($msgData['content']) ? $msgData['content'] : json_encode($msgData)) : $msgData;
        } elseif (isset($rs['text'])) {
            $msgData = $rs['text'];
            $responseText = is_array($msgData) ? (isset($msgData['content']) ? $msgData['content'] : json_encode($msgData)) : $msgData;
        } elseif (isset($rs['output'])) {
            $msgData = $rs['output'];
            $responseText = is_array($msgData) ? (isset($msgData['content']) ? $msgData['content'] : json_encode($msgData)) : $msgData;
        } else {
            $responseText = is_string($rs) ? $rs : json_encode($rs);
        }

        if (isset($rs['sinhviens']) && is_array($rs['sinhviens']) && count($rs['sinhviens']) > 0) {
            $extraTables .= '<div class="chat-sv-table-wrapper" style="margin-top:16px;">
                <table class="chat-sv-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Ho ten</th>
                            <th>Ma SV</th>
                            <th style="width:65px;">GT</th>
                            <th style="width:90px;">Ngay sinh</th>
                            <th style="width:100px;">Khoa</th>
                            <th style="width:100px;">Lop</th>
                            <th style="width:120px;">Co so</th>
                            <th style="width:80px;">Trang thai</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>';
            $stt = 1;
            foreach ($rs['sinhviens'] as $sv) {
                $svTrangthai = isset($sv['trangthai']) ? $sv['trangthai'] : '';
                $statusClass = ($svTrangthai === 'Khoa') ? 'locked' : 'active';
                $extraTables .= '<tr>
                    <td style="text-align:center; color:#94A3B8; font-size:11px;">' . $stt++ . '</td>
                    <td class="sv-name">' . htmlspecialchars(isset($sv['tensinhvien']) ? $sv['tensinhvien'] : '') . '</td>
                    <td class="sv-code">' . htmlspecialchars(isset($sv['masosinhvien']) ? $sv['masosinhvien'] : '') . '</td>
                    <td style="text-align:center; font-size:11px;">' . htmlspecialchars(isset($sv['gioitinh']) ? $sv['gioitinh'] : '') . '</td>
                    <td style="font-size:11.5px;">' . htmlspecialchars(isset($sv['ngaysinh']) ? $sv['ngaysinh'] : '') . '</td>
                    <td class="sv-faculty">' . htmlspecialchars(isset($sv['khoa']) ? $sv['khoa'] : '') . '</td>
                    <td class="sv-class">' . htmlspecialchars(isset($sv['lop']) ? $sv['lop'] : '') . '</td>
                    <td style="font-size:11px; color:#64748B;">' . htmlspecialchars(isset($sv['cosodaotao']) ? $sv['cosodaotao'] : '') . '</td>
                    <td><span class="sv-status ' . $statusClass . '">' . htmlspecialchars($svTrangthai) . '</span></td>
                    <td class="sv-email" title="' . htmlspecialchars(isset($sv['email']) ? $sv['email'] : '') . '">' . htmlspecialchars(isset($sv['email']) ? $sv['email'] : '') . '</td>
                </tr>';
            }
            $extraTables .= '</tbody></table></div>';
        }

        $finalResponse = $responseText . $extraTables;
        echo json_encode(array('response' => $finalResponse));
        exit;
    }

    // =====================
    // NON-ADMIN FLOW (hocsinh, giangvien)
    // =====================

    // Khoi tao Model ChatAI
    $chatAI = new mChatAI();

    // Luu tin nhan cua user vao database
    if ($user_id && $prompt) {
        $context_sv = $chatAI->LayContextSV($user_id);
        $chatAI->LuuTinNhan($user_id, 'user', $prompt, $context_sv);
    }

    // Lay lich su chat gan day de dua vao prompt
    $chat_history = "";
    if ($user_id) {
        $lich_su = $chatAI->LayLichSuChat($user_id, 10);
        $messages = array();
        while ($row = mysql_fetch_assoc($lich_su)) {
            $messages[] = $row;
        }
        // Dao nguoc de lay dung thu tu (cu nhat truoc)
        $messages = array_reverse($messages);

        if (count($messages) > 0) {
            $chat_history = "Lich su tro chuyen gan day:\n";
            foreach ($messages as $msg) {
                $role = ($msg['sender_type'] == 'user') ? 'Sinh vien' : 'Tro ly AI';
                $chat_history .= $role . ": " . $msg['message_content'] . "\n";
            }
            $chat_history .= "\n---\n";
        }
    }

    // Buoc 1: Goi /chat de lay vector
    $payload = json_encode(array(
        "text" => $prompt
    ));
    ## goi chuyen hoa vector 
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "http://127.0.0.1:8000/chat");
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 30);

    $response1 = curl_exec($ch1);
    $httpCode1 = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
    $error1 = curl_error($ch1);

    curl_close($ch1);

    if ($error1) {
        echo json_encode(array('response' => "Loi ket noi: " . $error1));
        exit;
    }

    $rs = json_decode($response1, true);
    $vector_data = $rs['vector'];

    // Buoc 2: Search trong Qdrant so sanh vector
    $urlQdrant = "http://localhost:6333/collections/iuh_subjects/points/search";

    $dataQdrant = array(
        "vector" => $vector_data,
        "limit" => 5,
        "with_payload" => true
    );

    $ch2 = curl_init($urlQdrant);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_POST, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($dataQdrant));

    $response2 = curl_exec($ch2);
    curl_close($ch2);

    $result2 = json_decode($response2, true);

    // Ghep thanh context
    $context = "";

    if (isset($result2['result'])) {
        foreach ($result2['result'] as $i => $item) {
            $pItem = $item['payload'];
            $context .= "Mon " . ($i + 1) . ":\n";
            $context .= "- Ten: " . $pItem['tenhocphan'] . "\n";
            $context .= "- Nganh: " . $pItem['tenchuyennganh'] . "\n";
            $context .= "- Nhom: " . $pItem['nhom_mon'] . "\n";
            $context .= "- Mo ta: " . $pItem['text_content'] . "\n\n";
        }
    }

    $message = "
Bạn là trợ lý tư vấn môn học và chuyên ngành cho sinh viên.

DỮ LIỆU MÔN HỌC:
$context

LỊCH SỬ TRÒ CHUYỆN:
$chat_history

YÊU CẦU:
- Chỉ trả lời các nội dung liên quan đến môn học, học phần, chuyên ngành, giảng viên, lịch học hoặc gợi ý học tập.
- Nếu người dùng chỉ chào hỏi, gọi bot hoặc nói cần giúp đỡ thì trả lời thân thiện và hướng người dùng hỏi về môn học hoặc chuyên ngành.
- Nếu câu hỏi không liên quan đến phạm vi trên thì trả lời:
'Mình chỉ hỗ trợ các câu hỏi liên quan đến môn học, học phần, chuyên ngành, giảng viên, lịch học hoặc gợi ý học tập thôi nha.'
- Chỉ dùng dữ liệu môn học được cung cấp để trả lời.
- Không tự bịa thêm môn học, giảng viên, phòng học hoặc lịch học.
- Không tự suy đoán người nổi tiếng, nhân vật, địa danh hoặc sự kiện là sinh viên.
- Không nói kiểu AI như 'dựa trên dữ liệu', 'theo thông tin cung cấp', 'theo ngữ cảnh'.
- Trả lời tự nhiên, thân thiện, ngắn gọn, dễ hiểu.

CÂU HỎI CỦA SINH VIÊN:
$prompt
    ";

    // Buoc 3: Goi /chat-ai voi context
    $ollamaUrl = CAL_LLM_CHAT;

    $payloadFinal = json_encode(array(
        'message' => $message,
        'role' => $tmp
    ));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ollamaUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadFinal);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        echo json_encode(array('response' => "Loi ket noi den AI: " . $error));
        exit;
    }

    if ($httpCode !== 200) {
        echo json_encode(array('response' => "API AI tra ve ma loi: " . $httpCode));
        exit;
    }
    // trả kết quả từ model AI gửi về 
    $result = json_decode($response, true);

    if (isset($result['message'])) {
        $responseText = is_array($result['message']) ? $result['message']['content'] : $result['message'];
    } elseif (isset($result['response'])) {
        $responseText = is_array($result['response']) ? $result['response']['content'] : $result['response'];
    } else {
        $responseText = is_string($result) ? $result : json_encode($result);
    }

    // Luu phan hoi cua AI vao database
    if ($user_id && $responseText) {
        $context_sv = $chatAI->LayContextSV($user_id);
        $chatAI->LuuTinNhan($user_id, 'ai', $responseText, $context_sv);
    }
// trả về kết quả cho người dùng 
    echo json_encode(array('response' => $responseText));

} catch (Exception $e) {
    echo json_encode(array('response' => "Loi: " . $e->getMessage()));
}
?>
