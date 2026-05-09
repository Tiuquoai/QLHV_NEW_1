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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Trang Chủ - Sinh Viên</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
<style>
	/* Course Grid & Cards */
	.courses-container {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
		gap: 20px;
		margin: 30px 0;
	}

	.course-card-item {
		background: white;
		border: 1px solid #e8e8f0;
		border-radius: 12px;
		padding: 20px;
		text-align: center;
		transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
		cursor: pointer;
		position: relative;
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(0,0,0,0.08);
	}

	.course-card-item::before {
		content: '';
		position: absolute;
		top: 0;
		left: -100%;
		width: 100%;
		height: 4px;
		background: linear-gradient(90deg, #667eea, #764ba2);
		transition: left 0.4s ease;
	}

	.course-card-item:hover::before {
		left: 0;
	}

	.course-card-item:hover {
		transform: translateY(-8px) scale(1.02);
		box-shadow: 0 12px 24px rgba(102, 126, 234, 0.3);
		border-color: #667eea;
		background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%);
	}

	.course-icon {
		font-size: 32px;
		margin-bottom: 12px;
		display: inline-block;
		animation: float 3s ease-in-out infinite;
	}

	@keyframes float {
		0%, 100% { transform: translateY(0px); }
		50% { transform: translateY(-8px); }
	}

	.course-card-item:hover .course-icon {
		animation: bounce 0.6s ease-in-out;
	}

	@keyframes bounce {
		0%, 100% { transform: translateY(0); }
		50% { transform: translateY(-12px); }
	}

	.course-card-item a {
		color: #333;
		font-weight: 700;
		text-decoration: none;
		font-size: 16px;
		display: block;
		margin: 12px 0;
		transition: color 0.3s ease;
	}

	.course-card-item:hover a {
		color: #667eea;
	}

	.course-code {
		font-size: 13px;
		color: #999;
		margin-top: 10px;
		font-weight: 500;
		letter-spacing: 0.5px;
		display: inline-block;
		background: #f5f5f5;
		padding: 4px 10px;
		border-radius: 20px;
	}

	.course-class {
		font-size: 14px;
		color: #667eea;
		margin-top: 12px;
		font-weight: 600;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 6px;
	}

	.course-class::before {
		content: '👥';
	}

	/* Pagination Styling */
	.pagination-wrapper {
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 8px;
		margin: 35px 0 20px 0;
		flex-wrap: wrap;
	}

	.pagination-wrapper a,
	.pagination-wrapper span {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 40px;
		height: 40px;
		border-radius: 8px;
		font-weight: 600;
		text-decoration: none;
		transition: all 0.3s ease;
		border: 2px solid #e8e8f0;
		color: #667eea;
		font-size: 14px;
	}

	.pagination-wrapper a:hover {
		background: linear-gradient(135deg, #667eea, #764ba2);
		color: white;
		border-color: #667eea;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}

	.pagination-wrapper span.current,
	.pagination-wrapper .active {
		background: linear-gradient(135deg, #667eea, #764ba2);
		color: white;
		border-color: #667eea;
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}

	.pagination-wrapper span.dots {
		border: none;
		color: #999;
		cursor: default;
	}

	.pagination-wrapper span.dots:hover {
		background: transparent;
		color: #999;
		border-color: #e8e8f0;
	}

	/* Responsive */
	/* Responsive */
	@media (max-width: 768px) {
		.courses-container {
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
			gap: 15px;
		}

		.pagination-wrapper a,
		.pagination-wrapper span {
			width: 36px;
			height: 36px;
			font-size: 13px;
		}

		.home-container .sidebar {
			background: white;
		}

		.sidebar-menu {
			display: flex;
			gap: 8px;
			flex-wrap: wrap;
		}

		.sidebar-menu li {
			flex: 1;
			min-width: 120px;
		}

		.sidebar-menu a {
			text-align: center;
			padding: 10px 10px;
		}

		.main-content {
			padding: 20px;
		}

		.main-content h2 {
			font-size: 22px;
		}

		.user-info {
			gap: 12px;
		}

		.user-avatar {
			width: 65px;
			height: 65px;
		}

		.user-details h3 {
			font-size: 16px;
		}
	}

	@media (max-width: 480px) {
		.courses-container {
			grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
			gap: 12px;
		}

		.course-card-item {
			padding: 15px 12px;
		}

		.course-icon {
			font-size: 28px;
		}

		.course-card-item a {
			font-size: 14px;
		}

		.pagination-wrapper {
			gap: 6px;
		}

		.pagination-wrapper a,
		.pagination-wrapper span {
			width: 32px;
			height: 32px;
			font-size: 12px;
		}

		.main-header {
			padding: 15px 0;
		}

		.main-header img {
			height: 55px;
		}

		.user-info {
			flex-direction: column;
			text-align: center;
			gap: 10px;
		}

		.user-avatar {
			width: 60px;
			height: 60px;
		}

		.user-details h3 {
			font-size: 14px;
		}

		.user-details p {
			font-size: 12px;
		}

		.main-content {
			padding: 15px;
			border-radius: 8px;
		}

		.main-content h2 {
			font-size: 18px;
		}

		.main-content > div:first-child {
			padding-bottom: 12px;
			margin-bottom: 20px;
		}

		.footer-content {
			grid-template-columns: 1fr;
			gap: 25px;
		}

		.footer {
			padding: 30px 15px;
			margin-top: 60px;
		}

		.mt button.b1 a,
		.mt button.b2 a {
			width: 32px;
			height: 32px;
			font-size: 12px;
		}
	}

	/* Main Content Heading */
	.main-content > div:first-child {
		border-bottom: 3px solid #667eea;
		padding-bottom: 15px;
		margin-bottom: 25px;
	}

	.main-content h2 {
		color: #333;
		font-size: 26px;
		margin: 0 0 8px 0;
		font-weight: 700;
		letter-spacing: -0.5px;
	}

	.main-content > div:first-child p {
		color: #999;
		font-size: 14px;
		margin: 8px 0 0 0 !important;
	}

	/* Sidebar Enhancements */
	.home-container .sidebar {
		background: linear-gradient(135deg, #f5f7fa 0%, #fff 100%);
		border: 1px solid #e8e8f0;
	}

	.sidebar-menu a {
		font-weight: 500;
		font-size: 15px;
		position: relative;
		overflow: hidden;
	}

	.sidebar-menu a::before {
		content: '';
		position: absolute;
		top: 0;
		left: -100%;
		width: 100%;
		height: 100%;
		background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
		transition: left 0.4s ease;
	}

	.sidebar-menu a:hover::before {
		left: 100%;
	}

	.sidebar-menu a.active {
		background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
		font-weight: 600;
	}

	/* Footer Enhancement */
	.footer {
		background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
		margin-top: 80px;
	}

	.footer-section {
		animation: fadeInUp 0.6s ease forwards;
		opacity: 0;
	}

	.footer-section:nth-child(1) {
		animation-delay: 0.1s;
	}

	.footer-section:nth-child(2) {
		animation-delay: 0.2s;
	}

	.footer-section:nth-child(3) {
		animation-delay: 0.3s;
	}

	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.footer-section ul li {
		transition: all 0.3s ease;
		padding-left: 8px;
	}

	.footer-section ul li:hover {
		padding-left: 16px;
		color: #667eea;
	}

	.contact-info {
		transition: all 0.3s ease;
	}

	.contact-info:hover {
		transform: translateX(5px);
	}

	.contact-info img {
		transition: transform 0.3s ease;
	}

	.contact-info:hover img {
		transform: scale(1.2);
	}

	/* Button Pagination Styling (for cPageM.php) */
	.mt button {
		margin: 4px 2px;
		padding: 0;
		border: none;
		background: transparent;
	}

	.mt button.b1 {
		display: inline-block;
	}

	.mt button.b1 a,
	.mt button.b2 a {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 40px;
		height: 40px;
		border-radius: 8px;
		font-weight: 600;
		text-decoration: none;
		transition: all 0.3s ease;
		border: 2px solid #e8e8f0;
		color: #667eea;
		font-size: 14px;
		cursor: pointer;
	}

	.mt button.b1 a:hover {
		background: linear-gradient(135deg, #667eea, #764ba2);
		color: white;
		border-color: #667eea;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}

	.mt button.b2 a {
		background: linear-gradient(135deg, #667eea, #764ba2);
		color: white;
		border-color: #667eea;
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}

	.mt button.b2 a:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
	}

	.mt button.b2 a cl {
		color: white;
		font-weight: 700;
	}

	@media (max-width: 768px) {
		.mt button.b1 a,
		.mt button.b2 a {
			width: 36px;
			height: 36px;
			font-size: 13px;
		}
	}

	@media (max-width: 480px) {
		.mt {
			text-align: center;
		}

		.mt button {
			margin: 3px 1px;
		}

		.mt button.b1 a,
		.mt button.b2 a {
			width: 32px;
			height: 32px;
			font-size: 12px;
		}
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
            <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo" style="height: 65px; width: auto; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" />
            
            <div class="user-info">
                <?php
                include_once("Model/mKetNoiADHT.php");
                $p=new ketnoiAD();
                $kn=$p->ketnoi($ketnoi);
                if($kn){
                    $bm=$_REQUEST['bm'];
                    $sql="select *from user u join sinhvien s on u.user_id=s.user_id where user_code='$bm' ";
                    $asv=mysql_query($sql);
                    $t=mysql_fetch_assoc($asv);
                }
                $anh=$t['anh'];
                ?>
                <div class="user-avatar">
                    <?php if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){ ?>
                        <a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="<?php echo $anh?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;" /></a>
                    <?php } else { ?>
                        <a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="img/<?php echo $anh?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;" /></a>
                    <?php } ?>
                </div>
                <div class="user-details">
                    <h3><?php echo $t['tensinhvien'] ?></h3>
                    <p><?php echo $t['user_code'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-custom">
    <div class="home-container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="#courses" class="active">📚 Các Khóa Học</a></li>
                <li><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>">👤 Thông Tin</a></li>
                <li><a href="dxuat.php?xuat=ahihi">🚪 Đăng Xuất</a></li>
            </ul>
        </div>

        <div class="main-content">
            <div style="margin-bottom: 10px;">
                <h2 style="color: #333; font-size: 24px; margin: 0;">📚 Các Khóa Học Của Bạn</h2>
                <p style="color: #999; font-size: 14px; margin: 8px 0 0 0;">Quản lý và theo dõi các khóa học hiện tại</p>
            </div>
            
            <div class="courses-container">
<?php
$is=md5($t['id_sinhvien']);
	$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:8;
	$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
    $start_from = ($tranghientai-1) * $bangghimoitrang;
	$sql="select * from sinhvien sv join hoctap h on sv.id_sinhvien=h.id_sinhvien
	join monlop m on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan
	join giangday gd on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien
	where md5(sv.id_sinhvien)='$is' limit $start_from,$bangghimoitrang";
	$laymh=mysql_query($sql);
	$pt="select count(h.id_hoctap) from sinhvien sv join hoctap h on sv.id_sinhvien=h.id_sinhvien
	join monlop m on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan
	join giangday gd on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien
	where md5(sv.id_sinhvien)='$is'";
	$qr=mysql_query($pt); 
    $cot = mysql_fetch_row($qr);  
    $tongbangghi = $cot[0];  
   	$tongsotrang = ceil($tongbangghi / $bangghimoitrang);
	while($tt=mysql_fetch_assoc($laymh)){
?>
                <div class="course-card-item">
                    <div class="course-icon">📖</div>
                    <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm']?>&&is=<?php echo $t['id_sinhvien'] ?>&&ihp=<?php echo md5($tt['id_hocphan']); ?>&&il=<?php echo $tt['id_lophocphan'] ?>&&ctmh">
                        <?php echo $tt['tenhocphan']; ?>
                    </a>
                    <div class="course-code"><?php echo $tt['mahocphan']; ?></div>
                    <div class="course-class"><?php echo $tt['tenlophocphan']; ?></div>
                </div>
<?php
	}
?>
            </div>

            <div class="pagination-wrapper">
                <?php include_once("Controller/cPageM.php"); ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" alt="School Logo" class="footer-logo" />
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
</body>
</html>