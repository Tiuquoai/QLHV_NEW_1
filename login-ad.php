<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Đăng Nhập - Quản Trị Viên</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
</head>
<body>
    <!-- HEADER TOP BAR -->
    <div class="header-top">
        <div class="container-custom">
            <p>
                <span>📞 Gọi Điện: 0143.234.563 - ext 808</span>
                <span>📧 Email: csm@gmail.com</span>
            </p>
        </div>
    </div>

    <!-- MAIN HEADER -->
    <div class="main-header">
        <div class="container-custom">
            <div class="logo-section">
                <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo" />
                <div class="school-info">
                    <h2>Hệ Thống Quản Lý Học Vụ</h2>
                    <p>Admin Learning Management System</p>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGIN FORM -->
     <div class="login-container">
        <div class="login-content">
            <div class="login-box" >
            <h3>Đăng Nhập Quản Trị Viên</h3>
            <p class="subtitle">Vui lòng nhập thông tin đăng nhập</p>
            
            <form action="dntc.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Mã Quản Trị Viên</label>
                    <input type="text" id="username" name="a" placeholder="Nhập mã quản trị viên" required />
                </div>

                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <input type="password" id="password" name="p" placeholder="Nhập mật khẩu" required />
                </div>

                <input type="hidden" name="dnad" value="hoài heheheheheheheh" />

                <button type="submit" class="btn-login">
                    🚀 Đăng Nhập
                </button>
            </form>
            </div>
        </div>
     </div>


    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" alt="School Logo" class="footer-logo" />
                <p><strong>Chào Mừng Đến Với Hệ Thống Quản Lý Học Vụ</strong></p>
                <p>Nền tảng quản trị dành cho các nhà quản lý hệ thống.</p>
            </div>
            <div class="footer-section">
                <h5>⚙️ Quản Lý</h5>
                <ul>
                    <li>Quản lý tài khoản</li>
                    <li>Quản lý khóa học</li>
                    <li>Quản lý sinh viên</li>
                    <li>Báo cáo hệ thống</li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>📞 Liên Hệ Hỗ Trợ</h5>
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
</body>
</html>
