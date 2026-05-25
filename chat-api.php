<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
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
    
    $p = new ketnoiSV();
    $kn = $p->ketnoi($ketnoi);
    
    // Get user role from session
    $tmp = "hocsinh"; // Default to admin if session not set
    
    if (isset($_SESSION['ma']) && isset($_SESSION['mk'])) {
        $mauser = $_SESSION['ma'];
        $sql = "SELECT * FROM user WHERE user_code = '$mauser'";
        $qr = mysql_query($sql);
        if ($qr && mysql_num_rows($qr) > 0) {
            $r = mysql_fetch_assoc($qr);
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
    
    // Nhận dữ liệu từ request
    $data = json_decode(file_get_contents('php://input'), true);
    
    $prompt = isset($data['prompt']) && trim($data['prompt']) !== ''
        ? trim($data['prompt'])
        : "Nhập môn lập trình học cái gì vậy tôi sợ quá";
    
    // =====================
    // ADMIN FLOW - Dùng /chat-ai endpoint
    // =====================
    if ($tmp == "admin") {
        $ollamaUrl = CAL_LLM_CHAT;
        
        // Format đúng cho /chat-ai: {"message": "...", "role": "..."}
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
            echo json_encode(array('response' => "Lỗi kết nối: " . $error1));
            exit;
        }
        
        if ($httpCode1 !== 200) {
            echo json_encode(array('response' => "HTTP Error: " . $httpCode1 . " - Response: " . substr($response1, 0, 200)));
            exit;
        }
        
        $rs = json_decode($response1, true);
        
        // Handle different response formats
        if (isset($rs['message'])) {
            $responseText = is_array($rs['message']) ? $rs['message']['content'] : $rs['message'];
        } elseif (isset($rs['response'])) {
            $responseText = is_array($rs['response']) ? $rs['response']['content'] : $rs['response'];
        } elseif (isset($rs['text'])) {
            $responseText = is_array($rs['text']) ? $rs['text']['content'] : $rs['text'];
        } elseif (isset($rs['output'])) {
            $responseText = is_array($rs['output']) ? $rs['output']['content'] : $rs['output'];
        } else {
            $responseText = is_string($rs) ? $rs : json_encode($rs);
        }
        
        echo json_encode(array('response' => $responseText));
        exit;
    }
    
    // =====================
    // NON-ADMIN FLOW (hocsinh, giangvien)
    // =====================
    
    // Bước 1: Gọi /chat để lấy vector
    $payload = json_encode(array(
        "text" => $prompt
    ));
    
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
        echo json_encode(array('response' => "Lỗi kết nối: " . $error1));
        exit;
    }
    


    $rs = json_decode($response1, true);
    $vector_data = $rs['vector'];
    
//     var_dump($vector_data);
// exit;

    // Bước 2: Search trong Qdrant
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
    
    // Ghép thành context
    $context = "";
    
    if (isset($result2['result'])) {
        foreach ($result2['result'] as $i => $item) {
            $pItem = $item['payload'];
            $context .= "Môn " . ($i + 1) . ":\n";
            $context .= "- Tên: " . $pItem['tenhocphan'] . "\n";
            $context .= "- Ngành: " . $pItem['tenchuyennganh'] . "\n";
            $context .= "- Nhóm: " . $pItem['nhom_mon'] . "\n";
            $context .= "- Mô tả: " . $pItem['text_content'] . "\n\n";
        }
    }
    
    $message = "
        Bạn là một trợ lý tư vấn môn học cho sinh viên.

        Thông tin môn học:
        $context

        Yêu cầu:
        - Trả lời tự nhiên, thân thiện, dễ hiểu
        - Trả lời trực tiếp vào câu hỏi
        - Không dùng văn phong quá cứng nhắc hoặc học thuật
        - Không nói kiểu AI như:
        + 'dựa trên thông tin cung cấp'
        + 'theo dữ liệu'
        + 'theo ngữ cảnh'
        - Không tự thêm môn học không có trong dữ liệu
        - Nếu người dùng hỏi về một chuyên ngành cụ thể thì chỉ trả lời các môn thuộc chuyên ngành đó
        - Không hỏi ngược lại người dùng
        - Nếu câu hỏi không liên quan tới dữ liệu thì trả lời bình thường bằng hiểu biết chung

        Câu hỏi của sinh viên:
        $prompt
";
    
    // Bước 3: Gọi /chat-ai với context
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
        echo json_encode(array('response' => "Lỗi kết nối đến AI: " . $error));
        exit;
    }
    
    if ($httpCode !== 200) {
        echo json_encode(array('response' => "API AI trả về mã lỗi: " . $httpCode));
        exit;
    }
    
    $result = json_decode($response, true);
    
    if (isset($result['message'])) {
        $responseText = is_array($result['message']) ? $result['message']['content'] : $result['message'];
        echo json_encode(array('response' => $responseText));
    } elseif (isset($result['response'])) {
        $responseText = is_array($result['response']) ? $result['response']['content'] : $result['response'];
        echo json_encode(array('response' => $responseText));
    } else {
        echo json_encode(array('response' => is_string($result) ? $result : json_encode($result)));
    }
    
} catch (Exception $e) {
    echo json_encode(array('response' => "Lỗi: " . $e->getMessage()));
}
