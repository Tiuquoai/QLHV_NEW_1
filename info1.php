<?php
	include_once("controller/cTKGV.php");
	$p=new cTKGV();
	if(isset($_POST['capnhatgv'])){
		     $td=$_POST['trinhdo'];
		     $email=$_POST['email'];
			 $sdt=$_POST['dt'];
			 if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/",$email)){
					echo "<script>alert('Email không đúng định dạng')</script>";
				}
			 elseif(!preg_match("/[0-9]{10}/",$sdt)){
				 echo "<script>alert('Số Điện Thoại là 10 số')</script>";
			 }
			 else {
		$p->CapNhatInfoGV1();
		$p->CapNhatInfoGV();
		echo "<script>Cập Nhật Thành Công !</script>";
		echo header("refresh:0,url='info1.php?bm=".$_REQUEST['bm']."");
			 }
	}
?>
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
$ma=$r['user_code'];
$mk=$r['matkhau'];
$k=$_SESSION['mk'];
$m=$_SESSION['ma'];
if($k != $mk || $m != $ma){
	echo header("refresh:0,url='index.php'");
}
?>
<?php
include_once("Controller/cTKGV.php");
$p=new cTKGV();
$u=$p->ktbm();
$a=mysql_fetch_assoc($u);
$b=$_REQUEST['bm'];
$c=$a['user_code'];
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
if($c!=$b){
	echo header("refresh:0,url='index.php'");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thông Tin Giảng Viên</title>
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
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    color: #333;
}

/* Top Bar */
.top-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 10px 0;
    font-size: 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.top-bar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-bar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    transition: all 0.3s;
}

.top-bar a:hover {
    opacity: 0.8;
}

.top-bar i {
    margin-right: 5px;
}

/* Header */
.header-section {
    background: white;
    padding: 20px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.logo-section {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo-section img {
    height: 70px;
    width: auto;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

.logo-section h1 {
    font-size: 24px;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Navigation */
.main-nav {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    padding: 0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.nav-container {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 0 auto;
}

.nav-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-menu li {
    position: relative;
}

.nav-menu li a {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 18px 30px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
}

.nav-menu li a:hover,
.nav-menu li a.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom-color: #ffd700;
}

.nav-menu li a i {
    font-size: 18px;
}

/* Content Section */
.content-section {
    padding: 50px 0;
    min-height: 60vh;
}

.content-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.section-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 30px;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

/* Profile Header */
.profile-header {
    text-align: center;
    margin-bottom: 40px;
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #667eea;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    margin-bottom: 20px;
}

.profile-name {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 10px;
}

.profile-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.action-btn.secondary {
    background: #6c757d;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.info-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid #e0e0e0;
}

.info-card h4 {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #667eea;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-card h4 i {
    color: #667eea;
}

.info-item {
    display: flex;
    margin-bottom: 15px;
    font-size: 15px;
}

.info-item strong {
    width: 150px;
    color: #555;
    flex-shrink: 0;
}

.info-item span {
    color: #1a1a2e;
    word-break: break-word;
}

/* Form Styles */
.form-section {
    background: white;
    padding: 30px;
    border-radius: 15px;
    margin-top: 30px;
}

.form-section h4 {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-section h4 i {
    color: #667eea;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 500;
    color: #555;
    margin-bottom: 8px;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="tel"],
.form-group input[type="password"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group textarea {
    min-height: 120px;
    resize: vertical;
}

.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 40px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

/* Password Change */
.password-form {
    max-width: 500px;
    margin: 0 auto;
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    padding: 40px;
    border-radius: 20px;
    border: 1px solid #e0e0e0;
}

.password-form h4 {
    text-align: center;
    font-size: 24px;
    color: #1a1a2e;
    margin-bottom: 30px;
}

/* Footer */
.main-footer {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    color: white;
    padding: 60px 0 30px;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-col h4 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 12px;
}

.footer-col h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.footer-col p {
    color: rgba(255,255,255,0.7);
    line-height: 1.8;
    margin-bottom: 10px;
}

.footer-col ul {
    list-style: none;
    padding: 0;
}

.footer-col ul li {
    margin-bottom: 12px;
}

.footer-col ul li a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer-col ul li a:hover {
    color: #667eea;
    padding-left: 5px;
}

.footer-col ul li a i {
    font-size: 12px;
}

.contact-info {
    list-style: none;
    padding: 0;
}

.contact-info li {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 18px;
    color: rgba(255,255,255,0.8);
}

.contact-info li i {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 25px;
    text-align: center;
    color: rgba(255,255,255,0.6);
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.footer-logo img {
    height: 60px;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .top-bar .container {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .nav-menu {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .nav-menu li a {
        padding: 12px 15px;
        font-size: 13px;
    }
    
    .content-card {
        padding: 25px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .footer-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-actions {
        flex-direction: column;
        align-items: center;
    }
}

/* Utility */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.text-center {
    text-align: center;
}

.mb-3 {
    margin-bottom: 30px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 20px;
    transition: all 0.3s;
}

.back-btn:hover {
    color: #764ba2;
    transform: translateX(-5px);
}
</style>
</head>

<body>
<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div>
            <i class="fas fa-phone"></i> 0143.234.563 - ext 808
            <a href="mailto:csm@gmail.com"><i class="fas fa-envelope"></i> csm@gmail.com</a>
        </div>
    </div>
</div>

<!-- Header -->
<header class="header-section">
    <div class="container">
        <div class="logo-section">
            <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo LMS">
            <h1>Hệ Thống LMS</h1>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="main-nav">
    <div class="nav-container">
        <ul class="nav-menu">
            <li><a href="homeGV.php?bm=<?php echo $_REQUEST['bm'] ?>"><i class="fas fa-home"></i> Trang Chủ</a></li>
            <li><a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>" class="active"><i class="fas fa-user-circle"></i> Thông Tin</a></li>
            <li><a href="dxuat.php?xuat"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="content-section">
<div class="container">

<?php 
include_once("Controller/cTKGV.php");
$p=new cTKGV();
$xuat=$p->XuatInfo();
$x=mysql_fetch_assoc($xuat);
$a= $x['user_code'];
$b= $_REQUEST['bm'];
if(!isset($_REQUEST['bm'])){
    echo header("refresh:0,url='index.php");
}
$anh=$x['anh'];
?>

<div class="content-card">

<?php if(isset($_REQUEST['chinhsuagv'])){ ?>
    <!-- Edit Form -->
    <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại</a>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <h4 class="section-title"><i class="fas fa-edit" style="margin-right:10px;color:#667eea;"></i>Chỉnh Sửa Thông Tin</h4>
        
        <div class="form-section">
            <h4><i class="fas fa-user"></i> Thông Tin Chung</h4>
            <div class="form-grid">
                <div class="form-group">
                    <label>Họ Tên Giảng Viên</label>
                    <strong><?php echo $x['hotengiangvien'];?></strong>
                </div>
                <div class="form-group">
                    <label>Mã Giảng Viên</label>
                    <strong><?php echo $x['magiangvien']; ?></strong>
                </div>
                <div class="form-group">
                    <label>Giới Tính</label>
                    <?php
                    if($x['gioitinh']==Nam){
                        $nam="checked";
                    }
                    elseif($x['gioitinh']==Nữ){
                        $nu="checked";
                    }
                    ?>
                    <div style="margin-top:8px;">
                        <input type="radio" name="gt" value="Nam" <?php echo $nam ?> /> Nam &nbsp;&nbsp;
                        <input type="radio" name="gt" value="Nữ" <?php echo $nu ?> required /> Nữ
                    </div>
                </div>
                <div class="form-group">
                    <label>Điện Thoại</label>
                    <input type="tel" name="dt" value="<?php echo $x['sdt'];?>" required />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $x['email'];?>" required />
                </div>
            </div>
            
            <div class="form-group" style="margin-top:20px;">
                <label>Địa Chỉ Liên Hệ</label>
                <input type="text" name="diachi" value="<?php echo $x['diachi'];?>" required />
            </div>
        </div>
        
        <div class="form-section" style="margin-top:30px;">
            <h4><i class="fas fa-graduation-cap"></i> Thông Tin Học Vị</h4>
            <div class="form-grid">
                <div class="form-group">
                    <label>Trình Độ</label>
                    <select name="trinhdo">
                        <option disabled class="btn-info"><?php echo $x['hocvi']; ?></option>
                        <option>Thạc Sĩ</option>
                        <option>Tiến Sĩ</option>
                        <option>Phó Giáo Sư</option>
                        <option>Giáo Sư</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Khoa Giảng Dạy</label>
                    <strong><?php echo $x['tenkhoa'];?></strong>
                </div>
                <div class="form-group">
                    <label>Chuyên Ngành</label>
                    <strong><?php echo $x['tenchuyennganh'];?></strong>
                </div>
                <div class="form-group">
                    <label>Cơ Sở Giảng Dạy</label>
                    <strong><?php echo $x['cosogiangday'];?></strong>
                </div>
            </div>
            
            <div class="form-group" style="margin-top:20px;">
                <label>Quá Trình Công Tác</label>
                <textarea name="quatrinhcongtac"><?php echo $x['quatrinhcongtac'] ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Chứng Chỉ Ngoại Ngữ</label>
                <input type="text" name="chungchi" value="<?php echo $x['chungchi'];?>" />
            </div>
            
            <div class="form-group">
                <label>Chứng Chỉ Khác</label>
                <textarea name="chungchikhac"><?php echo $x['chungchikhac'];?></textarea>
            </div>
            
            <div class="form-group">
                <label>Công Trình Khoa Học</label>
                <textarea name="congtrinhkhoahoc"><?php echo $x['congtrinhkhoahoctieubieu'];?></textarea>
            </div>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $x['user_id']; ?>" />
        <div style="text-align:center; margin-top:30px;">
            <button type="submit" name="capnhatgv" class="btn-submit"><i class="fas fa-save"></i> Lưu Thay Đổi</button>
        </div>
    </form>

<?php } elseif(isset($_REQUEST['dmk'])){ ?>
    <!-- Password Change Form -->
    <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại</a>
    
    <div class="password-form">
        <h4><i class="fas fa-key"></i> Đổi Mật Khẩu</h4>
        <?php
        if(isset($_POST['d'])){
            $ma=$_REQUEST['bm'];
            $mk=md5($_POST['a']);
            $a=$_POST['a'];
            $b=$_POST['b'];
            $xm=$_POST['xm'];
            $sql="select * from user where user_code='$ma'";
            $qr=mysql_query($sql);
            $e=mysql_fetch_assoc($qr);
            $mkc=$e['matkhau'];
            if(md5($xm)!=$mkc){
                echo "<script>alert('Nhập mật khẩu cũ không đúng !')</script>";
            }
            elseif($b!=$a){
                echo "<script>alert('Mật khẩu nhập lại không khớp !')</script>";
            }
            else{
                $sql="update user set matkhau='$mk' where user_code='$ma'";
                $qr=mysql_query($sql);
                echo "<script>alert('Đổi mật khẩu hoàn tất !')</script>";
            }
        }
        ?>
        <form action="#" method="post">
            <div class="form-group">
                <label>Mật Khẩu Cũ</label>
                <input type="password" name="xm" required />
            </div>
            <div class="form-group">
                <label>Mật Khẩu Mới</label>
                <input type="password" name="a" required />
            </div>
            <div class="form-group">
                <label>Nhập Lại Mật Khẩu</label>
                <input type="password" name="b" required />
            </div>
            <div style="text-align:center; margin-top:20px;">
                <button type="submit" name="d" class="btn-submit"><i class="fas fa-check"></i> Xác Nhận</button>
            </div>
        </form>
    </div>

<?php } else { ?>
    <!-- View Profile -->
    <div class="profile-header">
        <?php if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){ ?>
            <img src="<?php echo $anh?>" class="profile-avatar" />
        <?php } else { ?>
            <img src="img/<?php echo $anh?>" class="profile-avatar" />
        <?php } ?>
        <h2 class="profile-name"><?php echo $x['hotengiangvien'] ?></h2>
        <div class="profile-actions">
            <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>&&dmk" class="action-btn"><i class="fas fa-key"></i> Đổi Mật Khẩu</a>
            <a href="info1.php?bm=<?php echo $_REQUEST['bm']; ?>&&chinhsuagv" class="action-btn"><i class="fas fa-edit"></i> Chỉnh Sửa</a>
            <a href="dxuat.php?xuat" class="action-btn secondary"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
        </div>
    </div>
    
    <div class="info-grid">
        <div class="info-card">
            <h4><i class="fas fa-user"></i> Thông Tin Cá Nhân</h4>
            <div class="info-item">
                <strong>Mã GV:</strong>
                <span><?php echo $x['magiangvien']; ?></span>
            </div>
            <div class="info-item">
                <strong>Giới Tính:</strong>
                <span><?php echo $x['gioitinh'];?></span>
            </div>
            <div class="info-item">
                <strong>Điện Thoại:</strong>
                <span><?php echo $x['sdt'];?></span>
            </div>
            <div class="info-item">
                <strong>Email:</strong>
                <span><?php echo $x['email'];?></span>
            </div>
            <div class="info-item">
                <strong>Địa Chỉ:</strong>
                <span><?php echo $x['diachi'];?></span>
            </div>
        </div>
        
        <div class="info-card">
            <h4><i class="fas fa-graduation-cap"></i> Thông Tin Học Vị</h4>
            <div class="info-item">
                <strong>Trình Độ:</strong>
                <span><?php echo $x['hocvi']; ?></span>
            </div>
            <div class="info-item">
                <strong>Khoa:</strong>
                <span><?php echo $x['tenkhoa'];?></span>
            </div>
            <div class="info-item">
                <strong>Chuyên Ngành:</strong>
                <span><?php echo $x['tenchuyennganh'];?></span>
            </div>
            <div class="info-item">
                <strong>Cơ Sở:</strong>
                <span><?php echo $x['cosogiangday'];?></span>
            </div>
        </div>
        
        <div class="info-card">
            <h4><i class="fas fa-certificate"></i> Chứng Chỉ</h4>
            <div class="info-item">
                <strong>Ngoại Ngữ:</strong>
                <span><?php echo $x['chungchi'];?></span>
            </div>
            <div class="info-item">
                <strong>Chứng Chỉ Khác:</strong>
                <span><?php echo $x['chungchikhac'];?></span>
            </div>
        </div>
        
        <div class="info-card">
            <h4><i class="fas fa-briefcase"></i> Quá Trình Công Tác</h4>
            <div class="info-item">
                <span><?php echo $x['quatrinhcongtac'] ?></span>
            </div>
        </div>
    </div>
    
    <div class="info-card" style="margin-top:30px;">
        <h4><i class="fas fa-flask"></i> Công Trình Khoa Học Tiêu Biểu</h4>
        <div class="info-item">
            <span><?php echo $x['congtrinhkhoahoctieubieu'];?></span>
        </div>
    </div>
    
    <div style="text-align:center; margin-top:40px;">
        <a href="homeGV.php?bm=<?php echo $_REQUEST['bm'] ?>" class="action-btn"><i class="fas fa-home"></i> Quay Về Trang Chủ</a>
    </div>
<?php } ?>

</div>

</div>
</main>

<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="footer-logo">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" alt="Logo">
                    <h4 style="margin:0;color:white;">Hệ Thống LMS</h4>
                </div>
                <p>Chào mừng các bạn đến với Hệ Thống Học Trực Tuyến - Nền tảng hỗ trợ giảng dạy và học tập hiệu quả.</p>
            </div>
            <div class="footer-col">
                <h4>Liên Kết Nhanh</h4>
                <ul>
                    <li><a href="homeGV.php?bm=<?php echo $_REQUEST['bm'] ?>"><i class="fas fa-chevron-right"></i> Trang Chủ</a></li>
                    <li><a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><i class="fas fa-chevron-right"></i> Thông Tin Cá Nhân</a></li>
                    <li><a href="dxuat.php?xuat"><i class="fas fa-chevron-right"></i> Đăng Xuất</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Liên Hệ</h4>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Trung Tâm Quản Trị Hệ Thống</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>0143.234.563</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>csm@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Hệ Thống Học Trực Tuyến. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>