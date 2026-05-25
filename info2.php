<?php
ob_start();
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Thông Tin Admin</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --primary: #4F46E5;
    --primary-dark: #4338CA;
    --primary-light: #818CF8;
    --secondary: #10B981;
    --secondary-dark: #059669;
    --danger: #EF4444;
    --warning: #F59E0B;
    --bg-body: #F9FAFB;
    --bg-card: #FFFFFF;
    --text-primary: #1F2937;
    --text-secondary: #6B7280;
    --text-light: #9CA3AF;
    --border-color: #E5E7EB;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, var(--bg-body) 0%, #EEF2FF 100%);
    min-height: 100vh;
    color: var(--text-primary);
    line-height: 1.6;
}

/* ===================== TOPBAR ===================== */
.topbar {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    padding: 14px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3);
}

.topbar-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.topbar-title {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-title i { font-size: 1.4rem; }

.topbar-actions { display: flex; gap: 12px; }

.btn-home {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.2s;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-home:hover { background: rgba(255, 255, 255, 0.25); transform: translateY(-1px); }

/* ===================== MAIN CONTAINER ===================== */
.main-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px;
}

/* ===================== PROFILE HEADER ===================== */
.profile-header {
    background: var(--bg-card);
    border-radius: 20px;
    box-shadow: var(--shadow);
    padding: 40px;
    margin-bottom: 32px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 120px;
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
}

.profile-avatar {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: var(--shadow-lg);
    position: relative;
    z-index: 1;
    margin-top: 20px;
}

.profile-name {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-top: 20px;
    margin-bottom: 8px;
}

.profile-role {
    display: inline-block;
    padding: 6px 16px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 20px;
}

.profile-actions {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 10px;
    font-size: 0.95rem;
    font-weight: 600;
    font-family: inherit;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4); }

.btn-secondary {
    background: #fff;
    color: var(--text-primary);
    border: 2px solid var(--border-color);
}

.btn-secondary:hover { border-color: var(--primary); color: var(--primary); }

.btn-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #DC2626 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4); }

/* ===================== CONTENT CARD ===================== */
.content-card {
    background: var(--bg-card);
    border-radius: 16px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
    margin-bottom: 32px;
}

.card-header-custom {
    padding: 20px 28px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #FAFAFA;
}

.card-header-custom h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header-custom h3 i { color: var(--primary); }

.card-body-custom { padding: 28px; }

/* ===================== INTRO BOX ===================== */
.intro-box {
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    border-left: 4px solid var(--primary);
    border-radius: 12px;
    padding: 24px;
    margin-top: 24px;
}

.intro-box h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.intro-box p {
    color: var(--text-secondary);
    line-height: 1.8;
    font-size: 1rem;
}

.intro-box .empty-state {
    color: var(--text-light);
    font-style: italic;
}

/* ===================== FORM STYLES ===================== */
.form-container {
    max-width: 500px;
    margin: 0 auto;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
}

.form-label {
    font-weight: 500;
    color: var(--text-primary);
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label i { color: var(--primary); width: 20px; }

.form-control-modern {
    padding: 14px 18px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 1rem;
    font-family: inherit;
    transition: all 0.2s;
    background: #fff;
}

.form-control-modern:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-control-modern::placeholder { color: var(--text-light); }

textarea.form-control-modern {
    min-height: 150px;
    resize: vertical;
    line-height: 1.6;
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 32px;
}

/* ===================== ALERT BOX ===================== */
.alert-box {
    padding: 16px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 500;
}

.alert-success { background: #D1FAE5; color: #059669; border: 1px solid #A7F3D0; }
.alert-error { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }
.alert-warning { background: #FEF3C7; color: #D97706; border: 1px solid #FDE68A; }

/* ===================== BUTTON ICON ===================== */
.btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #fff;
    border: 2px solid var(--border-color);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.2s;
    font-size: 1.1rem;
}

.btn-icon:hover { border-color: var(--primary); color: var(--primary); transform: translateY(-2px); box-shadow: var(--shadow); }

.btn-icon.edit { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); color: #fff; border-color: transparent; }
.btn-icon.edit:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4); }

/* ===================== FOOTER ===================== */
.footer {
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    color: #fff;
    padding: 48px 0 0;
    margin-top: 48px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr;
    gap: 48px;
    padding-bottom: 40px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-brand { display: flex; flex-direction: column; gap: 16px; }
.footer-brand-logo { width: 60px; height: 60px; border-radius: 14px; object-fit: cover; }
.footer-brand p { color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; line-height: 1.7; }

.footer-section h4 { font-size: 1rem; font-weight: 600; margin-bottom: 16px; color: #fff; }

.footer-links { list-style: none; padding: 0; margin: 0; }
.footer-links li { margin-bottom: 10px; }
.footer-links a { color: rgba(255, 255, 255, 0.7); text-decoration: none; font-size: 0.9rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; }
.footer-links a:hover { color: #fff; }
.footer-links a i { font-size: 0.7rem; color: var(--primary-light); }

.footer-contact-item { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; }
.footer-contact-item i { width: 32px; height: 32px; border-radius: 8px; background: rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary-light); }

.footer-bottom { text-align: center; padding: 20px 0; color: rgba(255, 255, 255, 0.5); font-size: 0.85rem; }

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    .footer-grid { grid-template-columns: 1fr; gap: 32px; text-align: center; }
    .profile-header { padding: 24px; }
    .profile-avatar { width: 100px; height: 100px; }
    .profile-name { font-size: 1.4rem; }
    .card-body-custom { padding: 16px; }
    .form-container { padding: 0 16px; }
}

/* ===================== STICKY ===================== */
.sticky {
    position: fixed;
    top: -15px;
    padding-top: 15px;
    width: 100%;
    height: 10px;
    z-index: 8;
    background-color: rgba(255, 255, 255, 0.92);
    box-shadow: 0.1px 0.1px 0.1px yellow;
}
</style>
</head>

<body>
<?php

if(!isset($_REQUEST['user'])){
    echo header("refresh:0,url='index.php'");
}
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
$ma=$_REQUEST['user'];
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
<?php 
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$p->ketnoi($ketnoi);
$bm=$_REQUEST['user'];
$sql="select * from admin a join user u on a.user_id=u.user_id where u.user_code='$bm'";
$qr=mysql_query($sql);
$x=mysql_fetch_assoc($qr);
$a= $x['user_code'];
$b= $_REQUEST['user'];
if(!isset($_REQUEST['user'])){
    echo header("refresh:0,url='index.php'");
}
if($b != $a){
    echo header("refresh:0,url='index.php'");
}

$anh=$x['anh'];
?>

<!-- ===================== TOPBAR ===================== -->
<div class="topbar" id="codinh">
    <div class="topbar-content">
        <div class="topbar-title">
            <i class="fas fa-user-shield"></i>
            <span>Thông Tin Admin</span>
        </div>
        <div class="topbar-actions">
            <a href="homeAD.php?bm=<?php echo $_REQUEST['user']; ?>" class="btn-home">
                <i class="fas fa-home"></i>
                Trang Chủ
            </a>
        </div>
    </div>
</div>

<!-- ===================== MAIN CONTENT ===================== -->
<div class="main-container">
    <!-- ===================== PROFILE HEADER ===================== -->
    <div class="profile-header">
        <?php if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){ ?>
            <img src="<?php echo $anh?>" alt="Avatar" class="profile-avatar" />
        <?php } else { ?>
            <img src="img/<?php echo $anh?>" alt="Avatar" class="profile-avatar" />
        <?php } ?>
        
        <h1 class="profile-name"><?php echo $x['hotenadmin']; ?></h1>
        <span class="profile-role">
            <i class="fas fa-user-shield"></i>
            Quản Trị Viên
        </span>
        
        <div class="profile-actions">
            <a href="info2.php?user=<?php echo $_REQUEST['user']; ?>&&dmk" class="btn btn-primary">
                <i class="fas fa-key"></i>
                Đổi Mật Khẩu
            </a>
            <a href="dxuat.php?xuat" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i>
                Đăng Xuất
            </a>
        </div>
    </div>

    <?php
    if(isset($_POST['s'])){
        $a=$_POST['a'];
        $id=$x['user_id'];
        $sql="update admin set loigioithieu='$a' where user_id='$id'";
        $qr=mysql_query($sql);
        echo header("refresh:0,url='info2.php?user=".$_REQUEST['user']."'");
    }
    ?>

    <!-- ===================== CONTENT CARD ===================== -->
    <div class="content-card">
        <?php if(isset($_REQUEST['lgt'])){ ?>
            <div class="card-header-custom">
                <h3><i class="fas fa-edit"></i> Chỉnh Sửa Lời Giới Thiệu</h3>
                <a href="info2.php?user=<?php echo $_REQUEST['user']; ?>" class="btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body-custom">
                <div class="form-container">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-pen"></i>
                                Nội dung lời giới thiệu
                            </label>
                            <textarea name="a" class="form-control-modern" placeholder="Nhập lời giới thiệu của bạn..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="s" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Lưu Lời Giới Thiệu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }
        elseif(isset($_REQUEST['dmk'])){ ?>
            <div class="card-header-custom">
                <h3><i class="fas fa-key"></i> Đổi Mật Khẩu</h3>
                <a href="info2.php?user=<?php echo $_REQUEST['user']; ?>" class="btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body-custom">
                <div class="form-container">
                    <?php
                    if(isset($_POST['d'])){
                        $ma=$_REQUEST['user'];
                        $mk=md5($_POST['a']);
                        $a=$_POST['a'];
                        $b=$_POST['b'];
                        $xm=$_POST['xm'];
                        $sql="select * from user where user_code='$ma'";
                        $qr=mysql_query($sql);
                        $e=mysql_fetch_assoc($qr);
                        $mkc=$e['matkhau'];
                        if(md5($xm)!=$mkc){
                            echo '<div class="alert-box alert-error"><i class="fas fa-exclamation-circle"></i> Nhập mật khẩu cũ không đúng !</div>';
                        }
                        elseif($b!=$a){
                            echo '<div class="alert-box alert-error"><i class="fas fa-exclamation-circle"></i> Mật khẩu nhập lại không khớp !</div>';
                        }
                        else{
                            $sql="update user set matkhau='$mk' where user_code='$ma'";
                            $qr=mysql_query($sql);
                            echo '<div class="alert-box alert-success"><i class="fas fa-check-circle"></i> Đổi mật khẩu hoàn tất !</div>';
                        }
                    }
                    ?>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>
                                Mật Khẩu Cũ
                            </label>
                            <input type="password" name="xm" class="form-control-modern" placeholder="Nhập mật khẩu cũ" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-key"></i>
                                Mật Khẩu Mới
                            </label>
                            <input type="password" name="a" class="form-control-modern" placeholder="Nhập mật khẩu mới" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-key"></i>
                                Nhập Lại Mật Khẩu Mới
                            </label>
                            <input type="password" name="b" class="form-control-modern" placeholder="Nhập lại mật khẩu mới" required/>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="d" class="btn btn-primary">
                                <i class="fas fa-check"></i>
                                Xác Nhận
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }
        else{ ?>
            <div class="card-header-custom">
                <h3><i class="fas fa-address-card"></i> Giới Thiệu</h3>
                <a href="info2.php?user=<?php echo $_REQUEST['user']; ?>&&lgt" class="btn-icon edit">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
            <div class="card-body-custom">
                <div class="intro-box">
                    <h4><i class="fas fa-quote-left"></i> Lời Giới Thiệu</h4>
                    <?php if($x['loigioithieu']==null){ ?>
                        <p class="empty-state">
                            <i class="fas fa-user-clock"></i>
                            Người này lười ghê ! Không ghi gì cả ...
                        </p>
                    <?php } else { ?>
                        <p><?php echo $x['loigioithieu']; ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="./img/jahja.jpg" alt="Logo" class="footer-brand-logo"/>
                <p>Chào Mừng Các Bạn Đến Với Hệ Thống Quản Trị Thông Minh - Giải pháp quản lý toàn diện cho mọi nhu cầu.</p>
            </div>
            <div class="footer-section">
                <h4>Liên Kết Nhanh</h4>
                <ul class="footer-links">
                    <li><a href="homeAD.php?bm=<?php echo $_REQUEST['user']; ?>"><i class="fas fa-chevron-right"></i> Trang Chủ</a></li>
                    <li><a href="info2.php?user=<?php echo $_REQUEST['user']; ?>&&dmk"><i class="fas fa-chevron-right"></i> Đổi Mật Khẩu</a></li>
                    <li><a href="dxuat.php?xuat"><i class="fas fa-chevron-right"></i> Đăng Xuất</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Liên Hệ</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-building"></i>
                    <span>Trung Tâm Quản Trị Hệ Thống</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>0143.234.563 - ext 808</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>csm@gmail.com</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Hệ Thống Quản Trị. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
</body>
</html>
