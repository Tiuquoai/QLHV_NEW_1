<?php
session_start();
header('Content-Type: application/json');


require './config.php';

// Debug mode - bật để xem lỗi
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(0);
// Chỉ cho phép sinh viên đã đăng nhập
// if(!isset($_SESSION['ma']) || !isset($_SESSION['mk'])) {
//     echo json_encode(array('error' => 'Bạn cần đăng nhập để sử dụng chat AI'));
//     exit;
// }

// Nhận dữ liệu từ request
$data = json_decode(file_get_contents('php://input'), true);

// if (!isset($data['prompt'])) {
//     echo json_encode(array('error' => 'Vui lòng nhập câu hỏi'));
//     exit;
// }

$prompt = isset($data['prompt']) && trim($data['prompt']) !== ''
    ? trim($data['prompt'])
    : "Có môn nào liên quan đến học về trí tuệ nhân tạo (AI) trong chuyên ngành Hệ Thống Thông Tin hong ??";

$payload = json_encode(array(
    "text" => $prompt
));

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "http://127.0.0.1:8000/embedding");
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_TIMEOUT, 300);
curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 10);

$response1 = curl_exec($ch1);
$httpCode1 = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
$error1 = curl_error($ch1);

curl_close($ch1);
$rs = json_decode($response1, true);
$vector_data = $rs['vector'];



// var_dump($rs);

// exit;

$urlQdrant = "http://localhost:6333/collections/iuh_subjects/points/search";

$data = array(
    "vector" => $vector_data,
    "limit" => 5,
    "with_payload" => true
)

;

$ch2 = curl_init($urlQdrant);

curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json')
    
);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($data));

$response2 = curl_exec($ch2);
curl_close($ch2);

$result2 = json_decode($response2, true);



// ghép thành context
$context = "";

foreach ($result2['result'] as $i => $item) {
    $p = $item['payload'];

    $context .= "Môn " . ($i+1) . ":\n";
    $context .= "- Tên: " . $p['tenhocphan'] . "\n";
    $context .= "- Ngành: " . $p['tenchuyennganh'] . "\n";
    $context .= "- Nhóm: " . $p['nhom_mon'] . "\n";
    $context .= "- Mô tả: " . $p['text_content'] . "\n\n";
}

// var_dump($context);
// exit;

// $message = "
// Bạn là một AI hỗ trợ sinh viên, thân thiện và dễ hiểu.

// --- NGỮ CẢNH ---
// Dưới đây là thông tin về các môn học:
// $context


// --- QUY TẮC ---
// 1. Nếu câu hỏi liên quan đến ngành học:
//    - Trả lời dựa trên thông tin đã cho
//    - Có thể diễn giải lại cho dễ hiểu
//    - Không tự thêm môn học không có trong dữ liệu
//    - Không nhắc tới các môn ngoài chuyên ngành nếu người dùng hỏi cụ thể môn học trong chuyên ngành đó


// 2. Nếu câu hỏi KHÔNG liên quan đến dữ liệu:
//    - Trả lời bằng hiểu biết chung một cách hợp lý
//    - Không cần phụ thuộc vào context

// 3. Tuyệt đối:
//    - Không nói 'dựa trên văn bản', 'dữ liệu cung cấp'
//    - Không hỏi ngược lại
//    - Không yêu cầu thêm thông tin

// --- PHONG CÁCH ---
// - Tự nhiên, giống người thật
// - Ngắn gọn, rõ ràng
// - Trả lời trực tiếp vào vấn đề

// --- NHIỆM VỤ ---
// Hãy trả lời câu hỏi của sinh viên
// ";


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
";


$kaka = $prompt;



$ollamaUrl = CAL_LLM_CHAT;

$payload = json_encode(array(
    // 'model' => 'llama3.2:3b',
    'message' => $message,
    'asking' => $kaka
));

// Khởi tạo cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ollamaUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Log lỗi để debug
if ($error) {
    echo json_encode(array(
        'error' => 'Lỗi kết nối đến Ollama: ' . $error,
        'debug' => 'Kiểm tra xem Ollama có đang chạy trên port 11435 không'
    ));
    exit;
}

if ($httpCode !== 200) {
    echo json_encode(array(
        'error' => 'Ollama API lỗi (mã HTTP: ' . $httpCode . ')',
        'debug' => 'Response: ' . substr($response, 0, 500)
    ));
    exit;
}

$result = json_decode($response, true);

// var_dump($result['choices'][0]['message']['content']);
// exit;

if (isset($result['choices'][0]['message']['content'])) {
    echo json_encode(array('response' => $result['choices'][0]['message']['content']));
} else {
    echo json_encode(array(
        'error' => 'Không nhận được phản hồi từ AI',
        'debug' => 'Response: ' . substr($response, 0, 500)
    ));
}
