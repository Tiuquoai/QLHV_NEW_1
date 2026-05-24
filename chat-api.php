<?php
session_start();
header('Content-Type: application/json');
class ketnoiSV{
	function ketnoi($ketnoi){
		$ketnoi=mysql_connect('localhost','SinhVien','123456','qlhv');
		mysql_set_charset("utf8");
		if($ketnoi){
			return mysql_select_db('qlhv');
		}
		else{
			return false;
		}
		
	}
	function dongketnoi($ketnoi){
		mysql_close($ketnoi);
	}
}
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
// var_dump($_SESSION);
$mauser = $_SESSION['ma'];
$sql = "SELECT * FROM user WHERE user_code = '$mauser'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
$tmp = null;
if($r['vaitro'] == 0) {
    $tmp = "hocsinh";
}else if($r['vaitro'] == 1) {
    $tmp = "giangvien";
}else {
    $tmp = "admin";
}

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
    : "vậy trong ngành hệ thống thông tin tôi phải hc những môn gì vậy ??? kể tên vài môn đi";

$payload = json_encode(array(
    "text" => $prompt
));

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "http://127.0.0.1:8000/chat");
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

// đúng

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


// đugs


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


// $kaka = $prompt;



$ollamaUrl = CAL_LLM_CHAT;

$payload = json_encode(array(
    // 'model' => 'llama3.2:3b',
    'message' => $message,
    'role' => $tmp
    // 'asking' => $kaka
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

// var_dump($response);
// var_dump($httpCode);
// exit;
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

// var_dump($result);
// exit;


if (isset($result['message'])) {
    echo json_encode(array('response' => $result['message']));
} else {
    echo json_encode(array(
        'error' => 'Không nhận được phản hồi từ AI',
        'debug' => 'Response: ' . substr($response, 0, 500)
    ));
}
