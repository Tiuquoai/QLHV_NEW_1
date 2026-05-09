<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quên Mật Khẩu - Hệ Thống LMS</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.wrapper {
    width: 100%;
    max-width: 500px;
}

.card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    padding: 30px;
    text-align: center;
    color: white;
}

.card-header .logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 15px;
    border: 3px solid rgba(255,255,255,0.2);
}

.card-header h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 5px;
}

.card-header p {
    font-size: 14px;
    opacity: 0.8;
}

.card-body {
    padding: 40px;
}

.form-title {
    text-align: center;
    margin-bottom: 30px;
}

.form-title h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 10px;
}

.form-title h3 i {
    color: #667eea;
    margin-right: 10px;
}

.form-title p {
    color: #666;
    font-size: 14px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 500;
    color: #1a1a2e;
    margin-bottom: 8px;
    font-size: 14px;
}

.input-group {
    position: relative;
}

.input-group i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #667eea;
    font-size: 18px;
}

.input-group input {
    width: 100%;
    padding: 14px 14px 14px 45px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.input-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
}

.input-group input::placeholder {
    color: #aaa;
}

.btn {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.btn:active {
    transform: translateY(0);
}

.back-link {
    text-align: center;
    margin-top: 25px;
}

.back-link a {
    color: #667eea;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.back-link a:hover {
    color: #764ba2;
    gap: 12px;
}

/* Footer */
.footer {
    text-align: center;
    padding: 20px;
    color: rgba(255,255,255,0.9);
    font-size: 13px;
}

.footer a {
    color: white;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 480px) {
    .card-body {
        padding: 25px;
    }
    
    .card-header {
        padding: 25px;
    }
    
    .card-header h2 {
        font-size: 20px;
    }
}
</style>
</head>

<body>

<div class="wrapper">
    <div class="card">
        <div class="card-header">
            <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo" class="logo">
            <h2>Hệ Thống LMS</h2>
            <p>Học Trực Tuyến</p>
        </div>
        
        <div class="card-body">
            <div class="form-title">
                <h3><i class="fas fa-key"></i>Lấy Lại Mật Khẩu</h3>
                <p>Nhập thông tin tài khoản giảng viên của bạn</p>
            </div>
            
            <form action="sendOTP.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Mã Tài Khoản *</label>
                    <div class="input-group">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="ma" placeholder="Nhập mã giảng viên" size="26" required="required" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Họ Và Tên *</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="ht" placeholder="Nhập họ và tên" required="required" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Số CCCD *</label>
                    <div class="input-group">
                        <i class="fas fa-id-card-alt"></i>
                        <input type="text" name="cccd" placeholder="Nhập số CCCD" required="required" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Email *</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Nhập email" required="required" />
                    </div>
                </div>
                
                <button type="submit" name="kiemtra1" class="btn">
                    <i class="fas fa-check-circle"></i> Xác Minh
                </button>
            </form>
            
            <div class="back-link">
                <a href="index.php">
                    <i class="fas fa-arrow-left"></i> Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Gọi Điện: 0143.234.563 - ext 808 | Email: csm@gmail.com</p>
    </div>
</div>

</body>
</html>
