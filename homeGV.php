<?php
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
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
<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Giảng Viên</title>
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

/* User Info */
.user-section {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
    transition: all 0.3s;
}

.user-avatar:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.user-name {
    font-weight: 600;
    color: #1a1a2e;
    font-size: 15px;
}

.user-name a {
    color: #1a1a2e;
    text-decoration: none;
    transition: all 0.3s;
}

.user-name a:hover {
    color: #667eea;
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

/* Course Cards */
.course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.course-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
    text-decoration: none;
    color: inherit;
    display: block;
}

.course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.25);
    border-color: #667eea;
}

.course-card-image {
    width: 100%;
    height: 120px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.course-card-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.course-card-image i {
    font-size: 40px;
    color: white;
    position: relative;
    z-index: 1;
}

.course-card-content {
    padding: 25px;
}

.course-card h4 {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 10px;
    line-height: 1.4;
}

.course-card .course-code {
    font-size: 14px;
    color: #667eea;
    font-weight: 500;
    margin-bottom: 15px;
}

.course-card .course-info {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #666;
    margin-top: 10px;
}

.course-card .course-info i {
    color: #667eea;
    width: 20px;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.pagination-wrapper a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin: 0 5px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.pagination-wrapper a:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
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
    
    .course-grid {
        grid-template-columns: 1fr;
    }
    
    .footer-grid {
        grid-template-columns: 1fr;
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

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 25px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    color: white;
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
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div class="logo-section">
                <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo LMS">
                <h1>Hệ Thống LMS</h1>
            </div>
            <div class="user-section">
                <?php
                include_once("Model/mKetNoiADHT.php");
                $p=new ketnoiAD();
                $kn=$p->ketnoi($ketnoi);
                if($kn){
                    $bm=$_REQUEST['bm'];
                    $sql="select *from user u join giangvien g on u.user_id=g.user_id where user_code='$bm' ";
                    $asv=mysql_query($sql);
                    $t=mysql_fetch_assoc($asv);
                }
                $anh=$t['anh'];
                if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
                    ?>
                    <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="<?php echo $anh?>" class="user-avatar" /></a>
                <?php } else { ?>
                    <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="img/<?php echo $anh?>" class="user-avatar" /></a>
                <?php } ?>
                <div class="user-name">
                    <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><i class="fas fa-user"></i> <?php echo $t['hotengiangvien'] ?></a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="main-nav">
    <div class="nav-container">
        <ul class="nav-menu">
            <li><a href="homeGV.php?bm=<?php echo $_REQUEST['bm'] ?>" class="active"><i class="fas fa-home"></i> Trang Chủ</a></li>
            <li><a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><i class="fas fa-user-circle"></i> Thông Tin</a></li>
            <li><a href="dxuat.php?xuat"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="content-section">
<div class="container">

<!-- Course Section -->
<div class="content-card">
    <h2 class="section-title"><i class="fas fa-book-open" style="margin-right:10px;color:#667eea;"></i>Khóa Học Giảng Dạy</h2>
    
    <div class="course-grid">
    <?php
    $ig=md5($t['id_giangvien']);
    $bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:8;
    $tranghientai=!empty($_GET['page'])?$_GET['page']:1;
    $start_from = ($tranghientai-1) * $bangghimoitrang;
    $sql="select *from giangday d join giangvien gv on d.id_giangvien=gv.id_giangvien
    join monlop m on m.id=d.id join hocphan hp on hp.id_hocphan=m.id_hocphan
    join lophocphan l on l.id_lophocphan=m.id_lophocphan
    join ct_hocphan c on c.id_hocphan=hp.id_hocphan
    where md5(d.id_giangvien)='$ig' or md5(d.id_giangvienTH1)='$ig' or md5(d.id_giangvienTH2)='$ig' limit $start_from,$bangghimoitrang";
    $laymh=mysql_query($sql);
    $bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:8;
    $tranghientai=!empty($_GET['page'])?$_GET['page']:1;
    $pt="select count(d.id_giangday) from giangvien gv join giangday d on gv.id_giangvien=d.id_giangvien
    join monlop m on m.id=d.id join hocphan hp on hp.id_hocphan=m.id_hocphan
    join lophocphan l on l.id_lophocphan=m.id_lophocphan
    join ct_hocphan c on c.id_hocphan=hp.id_hocphan
    where md5(d.id_giangvien)='$ig' or md5(d.id_giangvienTH1)='$ig' or md5(d.id_giangvienTH2)='$ig' ";
    $qr=mysql_query($pt); 
    $cot = mysql_fetch_row($qr);  
    $tongbangghi = $cot[0];  
    $tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
    while($tt=mysql_fetch_assoc($laymh)){
        $lt=$tt['thuhocLT'];
        $plt=$tt['phonghocLT'];
        $th=$tt['thuhocTH'];
        $pth=$tt['phonghocTH'];
    ?>
        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm']?>&&ig=<?php echo $t['id_giangvien'] ?>&&ihp=<?php echo md5($tt['id_hocphan']); ?>&&il=<?php echo $tt['id_lophocphan'] ?>&&ctmh" class="course-card">
            <div class="course-card-image">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="course-card-content">
                <h4><?php echo $tt['tenhocphan'] ?></h4>
                <p class="course-code"><?php echo $tt['mahocphan'] ?></p>
                <div class="course-info">
                    <i class="fas fa-users"></i>
                    <span>Lớp: <?php echo $tt['tenlophocphan'] ?></span>
                </div>
            </div>
        </a>
    <?php } ?>
    </div>
    
    <div class="pagination-wrapper">
        <?php include_once("Controller/cPageG.php"); ?>
    </div>
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


