<?php
session_start();



// var_dump($r);
// exit;

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
$ma=$r['user_code'];
$mk=$r['matkhau'];
$k=$_SESSION['mk'];
$m=$_SESSION['ma'];
if($k != $mk || $m != $ma){
    echo header("refresh:0,url='index.php'");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Chat AI - Sinh Viên</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    
    .chat-container {
        max-width: 900px;
        margin: 20px auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        overflow: hidden;
        min-height: calc(100vh - 40px);
        display: flex;
        flex-direction: column;
    }
    
    .chat-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .chat-header h2 {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.4rem;
    }
    
    .back-btn {
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 0.9rem;
    }
    
    .back-btn:hover {
        background: rgba(255,255,255,0.3);
    }
    
    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #f8f9fa;
        min-height: 400px;
        max-height: calc(100vh - 250px);
    }
    
    .message {
        margin-bottom: 15px;
        display: flex;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .message.user {
        justify-content: flex-end;
    }
    
    .message.ai {
        justify-content: flex-start;
    }
    
    .message-content {
        max-width: 75%;
        padding: 12px 18px;
        border-radius: 15px;
        line-height: 1.6;
        word-wrap: break-word;
    }
    
    .message.user .message-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom-right-radius: 5px;
    }
    
    .message.ai .message-content {
        background: white;
        color: #333;
        border-bottom-left-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .message-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin: 0 10px;
    }
    
    .message.user .message-avatar {
        background: #667eea;
        color: white;
        order: 1;
    }
    
    .message.ai .message-avatar {
        background: #e8e8f0;
        color: #667eea;
    }
    
    .chat-input-container {
        padding: 20px;
        background: white;
        border-top: 1px solid #e8e8f0;
    }
    
    .chat-input-form {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }
    
    .chat-input {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #e8e8f0;
        border-radius: 25px;
        font-size: 1rem;
        outline: none;
        transition: all 0.3s;
        resize: none;
        min-height: 50px;
        max-height: 120px;
        font-family: inherit;
    }
    
    .chat-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .send-btn {
        padding: 15px 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .send-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }
    
    .send-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .typing-indicator {
        display: flex;
        gap: 5px;
        padding: 15px 18px;
    }
    
    .typing-indicator span {
        width: 8px;
        height: 8px;
        background: #667eea;
        border-radius: 50%;
        animation: bounce 1.4s infinite ease-in-out;
    }
    
    .typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
    .typing-indicator span:nth-child(2) { animation-delay: -0.16s; }
    
    @keyframes bounce {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }
    
    .welcome-message {
        text-align: center;
        padding: 40px 20px;
        color: #666;
    }
    
    .welcome-message h3 {
        color: #667eea;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }
    
    .welcome-message p {
        line-height: 1.8;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .error-message {
        background: #fee;
        color: #c00;
        padding: 10px 15px;
        border-radius: 8px;
        margin: 10px 20px;
        text-align: center;
    }
</style>
</head>
<body>
<?php
$bm = $_REQUEST['bm'];
$is = $_REQUEST['is'];
$ihp = isset($_REQUEST['ihp']) ? $_REQUEST['ihp'] : '';
$il = isset($_REQUEST['il']) ? $_REQUEST['il'] : '';
?>
<div class="chat-container">
    <div class="chat-header">
        <h2>
            <svg width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15z"/>
            </svg>
            Chat AI Assistant
        </h2>
        <a href="ctmonhoc.php?bm=<?php echo $bm; ?>&is=<?php echo $is; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&kh" class="back-btn">
            ← Quay Lại
        </a>
    </div>
    
    <div class="chat-messages" id="chatMessages">
        <div class="welcome-message">
            <h3>Xin chào! 👋</h3>
            <p>Tôi là AI Assistant, sẵn sàng giúp bạn trả lời các câu hỏi về bài giảng, bài tập, và hỗ trợ việc học tập của bạn.</p>
            <p style="margin-top: 15px; font-size: 0.9rem; color: #888;">Gõ tin nhắn của bạn và nhấn Gửi để bắt đầu trò chuyện!</p>
        </div>
    </div>
    
    <div class="chat-input-container">
        <form class="chat-input-form" id="chatForm" method="post">
            <textarea 
                class="chat-input" 
                name="message" 
                id="messageInput" 
                placeholder="Nhập câu hỏi của bạn..." 
                rows="1"
                required
            ></textarea>
            <button type="submit" class="send-btn" id="sendBtn">
                <span>Gửi</span>
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
// Auto-resize textarea
const textarea = document.getElementById('messageInput');
textarea.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

// Handle form submit
document.getElementById('chatForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const message = document.getElementById('messageInput').value.trim();
    if (!message) return;
    
    const chatMessages = document.getElementById('chatMessages');
    const sendBtn = document.getElementById('sendBtn');
    
    // Clear welcome message if first message
    const welcome = chatMessages.querySelector('.welcome-message');
    if (welcome) welcome.remove();
    
    // Add user message
    addMessage(message, 'user');
    
    // Clear input and disable button
    document.getElementById('messageInput').value = '';
    textarea.style.height = 'auto';
    sendBtn.disabled = true;
    
    // Add typing indicator
    const typingDiv = document.createElement('div');
    typingDiv.className = 'message ai';
    typingDiv.id = 'typingIndicator';
    typingDiv.innerHTML = `
        <div class="message-avatar">🤖</div>
        <div class="message-content">
            <div class="typing-indicator">
                <span></span><span></span><span></span>
            </div>
        </div>
    `;
    chatMessages.appendChild(typingDiv);
    scrollToBottom();
    
    try {
        // Call API
        const response = await fetch('/plhv_hoai-main/chat-api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ prompt: message })
        });
        // console.log(response);
        const data = await response.json();
        
        // Remove typing indicator
        document.getElementById('typingIndicator').remove();

        
        if (data.error) {
            addMessage('Xin lỗi, đã xảy ra lỗi: ' + data.error, 'ai');
        } else {
            addMessage(data.response, 'ai');
        }
    } catch (error) {
        console.log(error);
        document.getElementById('typingIndicator').remove();
        addMessage('Xin lỗi, không thể kết nối với AI. Vui lòng thử lại sau.', 'ai');
    }
    
    sendBtn.disabled = false;
    document.getElementById('messageInput').focus();
});

function addMessage(content, sender ) {
    const chatMessages = document.getElementById('chatMessages');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message ' + sender;
    
    const avatar = sender === 'user' ? '👤' : '🤖';
    const role = sender === 'user' ? 'Bạn' : 'AI';
    
    // Convert markdown-like text to HTML
    let formattedContent = content
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.*?)\*/g, '<em>$1</em>')
        .replace(/`(.*?)`/g, '<code style="background:#f0f0f0;padding:2px 6px;border-radius:4px;">$1</code>')
        .replace(/\n/g, '<br>');
    
    messageDiv.innerHTML = `
        <div class="message-avatar">${avatar}</div>
        <div class="message-content">
            <div style="font-weight:600;margin-bottom:5px;color:${sender === 'user' ? '#fff' : '#667eea'};font-size:0.85rem;">${role}</div>
            ${formattedContent}
        </div>
    `;
    
    chatMessages.appendChild(messageDiv);
    scrollToBottom();
}

function scrollToBottom() {
    const chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
}
</script>
</body>
</html>
