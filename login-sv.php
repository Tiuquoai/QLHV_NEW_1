<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Đăng Nhập - Hệ Thống Quản Lý Học Vụ</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
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
        <div class="logo-section">
            <img src="./img/jahja.jpg" alt="Logo" />
            <div class="school-info">
                <h2>Hệ Thống Quản Lý Học Vụ</h2>
                <p>Student Learning Management System</p>
            </div>
        </div>
    </div>
</div>

<div class="login-container">
    <div class="login-content">
        <div class="login-box">
            <h3>🎓 Đăng Nhập Sinh Viên</h3>
            
            <form action="dntc.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Mã Sinh Viên</label>
                    <input type="text" id="username" name="a" placeholder="Nhập mã sinh viên" required="required" />
                </div>

                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <input type="password" id="password" name="p" placeholder="Nhập mật khẩu" required="required" />
                </div>

                <?php
                    $length=5;
                    if(isset($_GET["len"]))
                        $length=$_GET["len"];
                    $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                                     .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                                     .'0123456789!@#$%^&*');
                    shuffle($seed);
                    $rand = '';
                    foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
                    $text= $rand;
                    $text1=$rand;
                    $_SESSION['captcha'] = $text;
                ?>

                <div class="form-group">
                    <label for="captcha">Mã Xác Nhận</label>
                    <div class="captcha-group">
                        <input type="text" id="captcha" name="cap" placeholder="Nhập mã Captcha" />
                        <button type="button" class="captcha-btn" onclick="document.location.reload();">
                            <?php echo $_SESSION['captcha']; ?>
                        </button>
                        <a href="login-sv.php?return" class="refresh-captcha">🔄</a>
                    </div>
                </div>

                <input type="hidden" name="cd" value="<?php echo $_SESSION['captcha'];?>" />
                <input type="hidden" name="dn" value="tiuquoaiiiii" />
<div style="display:flex; gap:16px; margin-top:20px;">

    <a href="index.php"
       style="
       flex:1;
       height:48px;
       background:#f1f5f9;
       color:#334155;
       border:1px solid #dbe2ea;
       border-radius:12px;
       font-size:15px;
       font-weight:600;
       text-decoration:none;
       display:flex;
       align-items:center;
       justify-content:center;
       transition:0.25s;
       ">
       Quay Về
    </a>

    <button type="submit"
        style="
        flex:1;
        height:48px;
        border:none;
        border-radius:12px;
        font-size:15px;
        font-weight:600;
        cursor:pointer;
        color:white;
        background:linear-gradient(135deg,#4f46e5,#7c3aed);
        box-shadow:0 4px 12px rgba(124,58,237,0.25);
        display:flex;
        align-items:center;
        justify-content:center;
        ">
        📱 Đăng Nhập
    </button>

</div>
              
                
                <div class="forgot-pass">
                    <a href="resetpass.php">❓ Quên Mật Khẩu?</a>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <img src="./img/jahja.jpg" alt="School Logo" class="footer-logo" />
                <p><strong>Chào Mừng Đến Với Hệ Thống Quản Lý Học Vụ</strong></p>
                <p>Nền tảng hiện đại để quản lý và theo dõi hoạt động học tập của bạn.</p>
            </div>
            
            <div class="footer-section">
                <h5>⚡ Tính Năng Chính</h5>
                <ul>
                    <li>Xem lịch học</li>
                    <li>Quản lý điểm số</li>
                    <li>Đơn xin phép</li>
                    <li>Thông báo học tập</li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h5>📞 Liên Hệ</h5>
                <div class="contact-info">
                    <img src="https://tse4.mm.bing.net/th?id=OIP.VMPvKsUQ9Q91rlEDRqsj8AHaHa&pid=Api&P=0&h=180" alt="Phone" />
                    <span>0143.234.563</span>
                </div>
                <div class="contact-info">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.Ye2A24tF7KlssZxi_cffWwHaGD&pid=Api&P=0&h=180" alt="Email" />
                    <span>csm@gmail.com</span>
                </div>
                <p style="margin-top: 15px; font-size: 12px;">Trung Tâm Quản Trị Hệ Thống - Trường Đại Học</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 Hệ Thống Quản Lý Học Vụ. Tất cả các quyền được bảo lưu.</p>
        </div>
    </footer>
</div>

</body>
</html>