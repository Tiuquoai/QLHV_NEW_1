<?php
session_start();
if(!isset($_REQUEST['bm'])){
    echo header("refresh:0,url='index.php'");
}
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
$ma=$_REQUEST['bm'];
$sql="select * from user where user_code='$ma'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
$user_id = $r['user_id'];
$ma=$r['user_code'];
$mk=$r['matkhau'];
$k=$_SESSION['mk'];
$m=$_SESSION['ma'];
if($k != $mk || $m != $ma){
    echo header("refresh:0,url='index.php'");
}

// Xử lý gửi tin nhắn
if(isset($_POST['gui_tin_nhan'])) {
    include_once("Controller/cChatAI.php");
    $chat = new cChatAI();
    $chat->XuLyGuiTinNhan();
}

// Xử lý xóa chat
if(isset($_POST['xoa_chat'])) {
    include_once("Controller/cChatAI.php");
    $chat = new cChatAI();
    $chat->XoaLichSuChat($user_id);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Chat AI - Hỗ Trợ Học Tập</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
<style>
/* Chat Container */
.chat-wrapper {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
.chat-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 20px;
    border-radius: 16px 16px 0 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-header h2 {
    margin: 0;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.ai-badge {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
}

.btn-xoa-chat {
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
}

.btn-xoa-chat:hover {
    background: rgba(255,255,255,0.3);
}

/* Messages Area */
.chat-messages {
    background: #f8f9fa;
    min-height: 400px;
    max-height: 500px;
    overflow-y: auto;
    padding: 20px;
    border-left: 1px solid #e8e8f0;
    border-right: 1px solid #e8e8f0;
}

.message {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.message.user {
    align-items: flex-end;
}

.message.ai {
    align-items: flex-start;
}

.message-content {
    max-width: 75%;
    padding: 14px 18px;
    border-radius: 16px;
    line-height: 1.6;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.message.user .message-content {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-bottom-right-radius: 4px;
}

.message.ai .message-content {
    background: white;
    color: #333;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.message-time {
    font-size: 11px;
    color: #999;
    margin-top: 6px;
    padding: 0 8px;
}

.message.user .message-time {
    text-align: right;
}

/* Typing indicator */
.typing-indicator {
    display: none;
    align-items: flex-start;
    margin-bottom: 20px;
}

.typing-indicator.active {
    display: flex;
}

.typing-content {
    background: white;
    padding: 14px 18px;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-bottom-left-radius: 4px;
}

.typing-dots {
    display: flex;
    gap: 4px;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    background: #999;
    border-radius: 50%;
    animation: typing 1.4s infinite;
}

.typing-dots span:nth-child(2) { animation-delay: 0.2s; }
.typing-dots span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
    30% { transform: translateY(-8px); opacity: 1; }
}

/* Quick Actions */
.quick-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
}

.quick-btn {
    background: white;
    border: 1px solid #e0e0e0;
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s;
    color: #667eea;
}

.quick-btn:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

/* Input Area */
.chat-input-area {
    background: white;
    padding: 20px;
    border-radius: 0 0 16px 16px;
    border: 1px solid #e8e8f0;
    border-top: none;
}

.input-group {
    display: flex;
    gap: 12px;
}

.chat-input {
    flex: 1;
    padding: 14px 18px;
    border: 2px solid #e8e8f0;
    border-radius: 12px;
    font-size: 15px;
    transition: border-color 0.3s;
    resize: none;
    font-family: inherit;
}

.chat-input:focus {
    outline: none;
    border-color: #667eea;
}

.btn-gui {
    padding: 14px 28px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-gui:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-gui:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Empty State */
.empty-chat {
    text-align: center;
    padding: 60px 20px;
    color: #999;
}

.empty-chat-icon {
    font-size: 64px;
    margin-bottom: 20px;
}

.empty-chat h3 {
    color: #667eea;
    margin-bottom: 10px;
}

/* Scrollbar */
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #999;
}

/* Responsive */
@media (max-width: 768px) {
    .chat-wrapper {
        padding: 10px;
    }
    
    .message-content {
        max-width: 90%;
    }
    
    .chat-header {
        padding: 15px;
    }
    
    .chat-header h2 {
        font-size: 18px;
    }
}

/* Back button */
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 15px;
    padding: 10px 0;
}

.back-link:hover {
    text-decoration: underline;
}
</style>
</head>

<body>
<div class="header-top">
    <p>
        <span>📞 Gọi Điện: 0143.234.563 - ext 808</span>
        <span>📧 Email: csm@gmail.com</span>
    </p>
</div>

<div class="main-header">
    <div class="container-custom">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <img src="./img/jahja.jpg" alt="Logo" style="height: 65px; width: auto; border-radius: 10px;" />
            <a href="homeSV.php?bm=<?php echo $_REQUEST['bm'] ?>" class="back-link">
                ← Quay lại trang chủ
            </a>
        </div>
    </div>
</div>

<div class="container-custom">
    <div class="chat-wrapper">
        <div class="chat-header">
            <h2>
                🤖 Chat AI Hỗ Trợ Học Tập
                <span class="ai-badge">AI Assistant</span>
            </h2>
            <form method="post" style="margin: 0;">
                <button type="submit" name="xoa_chat" class="btn-xoa-chat" onclick="return confirm('Bạn có chắc muốn xóa toàn bộ lịch sử chat?')">
                    🗑️ Xóa Chat
                </button>
            </form>
        </div>

        <div class="chat-messages" id="chatMessages">
            <?php
            include_once("Controller/cChatAI.php");
            $chat = new cChatAI();
            $lich_su = $chat->LayLichSuChat($user_id);
            
            if(mysql_num_rows($lich_su) == 0) {
            ?>
            <div class="empty-chat">
                <div class="empty-chat-icon">💬</div>
                <h3>Chào mừng bạn!</h3>
                <p>Mình là trợ lý AI, sẵn sàng hỗ trợ bạn về:<br>
                📊 Điểm số | 📅 Lịch học | 📝 Bài tập | 📚 Khóa học</p>
            </div>
            <?php } else { 
                // Hiển thị tin nhắn cũ (đảo ngược để hiển thị đúng thứ tự)
                $messages = [];
                while($row = mysql_fetch_assoc($lich_su)) {
                    $messages[] = $row;
                }
                $messages = array_reverse($messages);
                
                foreach($messages as $msg) {
                    $class = ($msg['sender_type'] == 'user') ? 'user' : 'ai';
                    $icon = ($msg['sender_type'] == 'user') ? '👤' : '🤖';
                    $time = date('H:i', strtotime($msg['created_date']));
            ?>
            <div class="message <?php echo $class ?>">
                <div class="message-content"><?php echo $icon ?> <?php echo htmlspecialchars($msg['message_content']) ?></div>
                <div class="message-time"><?php echo $time ?></div>
            </div>
            <?php } } ?>
        </div>

        <div class="chat-input-area">
            <div class="quick-actions">
                <button class="quick-btn" onclick="setQuestion('Xem điểm của tôi')">📊 Điểm số</button>
                <button class="quick-btn" onclick="setQuestion('Lịch học hôm nay')">📅 Lịch học</button>
                <button class="quick-btn" onclick="setQuestion('Bài tập cần nộp')">📝 Bài tập</button>
                <button class="quick-btn" onclick="setQuestion('Khóa học hiện tại')">📚 Khóa học</button>
            </div>
            <form method="post" id="chatForm">
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <div class="input-group">
                    <input type="text" name="tin_nhan" id="chatInput" class="chat-input" placeholder="Nhập câu hỏi của bạn..." autocomplete="off" required>
                    <button type="submit" name="gui_tin_nhan" class="btn-gui" id="sendBtn">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Scroll to bottom of chat
function scrollToBottom() {
    var chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Set question from quick buttons
function setQuestion(question) {
    document.getElementById('chatInput').value = question;
    document.getElementById('chatInput').focus();
}

// Show typing indicator
document.getElementById('chatForm').addEventListener('submit', function() {
    var btn = document.getElementById('sendBtn');
    btn.disabled = true;
    btn.innerHTML = 'Đang gửi...';
    
    // Show typing indicator
    var chatMessages = document.getElementById('chatMessages');
    var typingDiv = document.createElement('div');
    typingDiv.className = 'typing-indicator active';
    typingDiv.id = 'typingIndicator';
    typingDiv.innerHTML = '<div class="typing-content"><div class="typing-dots"><span></span><span></span><span></span></div></div>';
    chatMessages.appendChild(typingDiv);
    scrollToBottom();
});

// Scroll to bottom on page load
window.onload = function() {
    scrollToBottom();
};
</script>

</body>
</html>
