<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trang LMS - Hệ Thống Học Trực Tuyến</title>
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
    position: sticky;
    top: 0;
    z-index: 1000;
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

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.hero-section h2 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.hero-section p {
    font-size: 18px;
    opacity: 0.95;
    max-width: 700px;
    margin: 0 auto;
    position: relative;
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

/* Feature Cards */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.feature-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 30px;
    border-radius: 15px;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2);
    border-color: #667eea;
}

.feature-card .icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.feature-card .icon i {
    font-size: 28px;
    color: white;
}

.feature-card h4 {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 10px;
}

.feature-card p {
    color: #666;
    font-size: 14px;
    line-height: 1.7;
}

/* Benefits List */
.benefits-list {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.benefits-list li {
    padding: 15px 20px;
    margin-bottom: 12px;
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-left: 4px solid #667eea;
    border-radius: 0 10px 10px 0;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s;
}

.benefits-list li:hover {
    transform: translateX(10px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.benefits-list li i {
    color: #667eea;
    font-size: 20px;
}

/* Content Text */
.content-text {
    line-height: 1.9;
    color: #555;
    font-size: 15px;
}

.content-text strong {
    color: #1a1a2e;
}

.content-text img {
    max-width: 100%;
    border-radius: 15px;
    margin: 25px 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.content-text p {
    margin-bottom: 20px;
}

.sub-title {
    font-size: 20px;
    font-weight: 600;
    color: #764ba2;
    margin: 30px 0 15px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sub-title i {
    color: #667eea;
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

/* News Section */
.news-item {
    display: flex;
    gap: 20px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-radius: 15px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
    text-decoration: none;
    color: inherit;
}

.news-item:hover {
    transform: translateX(10px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
    border-color: #667eea;
}

.news-item img {
    width: 150px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
}

.news-content h4 {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 8px;
}

.news-content span {
    font-size: 13px;
    color: #888;
}

.news-content span i {
    margin-right: 5px;
    color: #667eea;
}

/* News Detail */
.news-detail h3 {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 20px;
}

.news-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9ecef;
}

.news-meta span {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #666;
    font-size: 14px;
}

.news-meta span i {
    color: #667eea;
}

/* Author Credit */
.author-credit {
    text-align: right;
    font-style: italic;
    color: #888;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.author-credit strong {
    color: #667eea;
}

/* Responsive */
@media (max-width: 768px) {
    .top-bar .container {
        flex-direction: column;
        gap: 10px;
    }
    
    .hero-section {
        padding: 50px 20px;
    }
    
    .hero-section h2 {
        font-size: 28px;
    }
    
    .nav-menu {
        flex-wrap: wrap;
    }
    
    .nav-menu li a {
        padding: 12px 15px;
        font-size: 13px;
    }
    
    .content-card {
        padding: 25px;
    }
    
    .news-item {
        flex-direction: column;
    }
    
    .news-item img {
        width: 100%;
        height: 150px;
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
            <h1>Hệ Thống Học Trực Tuyến</h1>
        </div>
    </div>
</header>

<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!-- Navigation -->
<nav class="main-nav">
    <div class="nav-container">
        <ul class="nav-menu">
            <li><a href="index.php?page=home" class="<?php echo $page == 'home' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Trang Chủ</a></li>
            <li><a href="login-sv.php"><i class="fas fa-user-graduate"></i> Sinh Viên</a></li>
            <li><a href="login-gv.php"><i class="fas fa-chalkboard-teacher"></i> Giảng Viên</a></li>
            <li><a href="login-ad.php"><i class="fas fa-user-shield"></i> AdminHT</a></li>
            <li><a href="index.php?page=tintuc&tintuc" class="<?php echo $page == 'tintuc' ? 'active' : ''; ?>"><i class="fas fa-newspaper"></i> Tin Tức</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="content-section">
<div class="container">

<?php
if(isset($_REQUEST['tintuc'])){
    if(isset($_REQUEST['ct'])){
        include_once("Model/mKetNoiSV.php");
        $p=new ketnoiSV();
        $p->ketnoi($ketnoi);
        $ct=$_REQUEST['ct'];
        $sql="select * from tintuc where id_tintuc='$ct'";
        $qr=mysql_query($sql);
        $m=mysql_fetch_assoc($qr);
        ?>
        <div class="content-card news-detail">
            <a href="index.php?tintuc&&page=tintuc" style="display:inline-flex;align-items:center;gap:8px;color:#667eea;text-decoration:none;margin-bottom:20px;font-size:14px;">
                <i class="fas fa-arrow-left"></i> Quay lại Tin Tức
            </a>
            <h3><?php echo $m['tieude'] ?></h3>
            <div class="news-meta">
                <span><i class="fas fa-user"></i> Tác giả: <strong><?php echo $m['tacgia'] ?></strong></span>
                <span><i class="fas fa-calendar"></i> Ngày Đăng: <strong><?php echo $m['ngaydangtai'] ?></strong></span>
            </div>
            <div class="content-text">
                <?php echo $m['noidung'] ?>
            </div>
        </div>
        <?php
    }
    else{
        ?>
        <div class="content-card">
            <h2 class="section-title"><i class="fas fa-newspaper" style="margin-right:10px;color:#667eea;"></i>Tin Tức</h2>
            <div class="features-grid">
            <?php
            include_once("Model/mKetNoiSV.php");
            $p=new ketnoiSV();
            $p->ketnoi($ketnoi);
            $sql="select * from tintuc";
            $qr=mysql_query($sql);
            while($x=mysql_fetch_assoc($qr)){
                ?>
                <a href="index.php?tintuc&&ct=<?php echo $x['id_tintuc'] ?>&&page=tintuc" class="news-item">
                    <img src="<?php echo $x['anhdaidien'] ?>" alt="<?php echo $x['tieude'] ?>">
                    <div class="news-content">
                        <h4><?php echo $x['tieude'] ?></h4>
                        <span><i class="fas fa-user"></i> <?php echo $x['tacgia'] ?></span> &nbsp;|&nbsp;
                        <span><i class="fas fa-calendar"></i> <?php echo $x['ngaydangtai'] ?></span>
                    </div>
                </a>
                <?php
            }
            ?>
            </div>
        </div>
        <?php
    }
}
else{
    ?>
    <!-- Hero Section -->
    <div class="hero-section">
        <h2>Chào Mừng Đến Với Hệ Thống Học Trực Tuyến</h2>
        <p>Nền tảng học tập hiện đại, kết nối Giảng Viên và Sinh Viên mọi lúc, mọi nơi</p>
    </div>
    
    <!-- Intro Content -->
    <div class="content-card">
        <h2 class="section-title"><i class="fas fa-info-circle" style="margin-right:10px;color:#667eea;"></i>Giới Thiệu</h2>
        
        <p class="content-text">
            <strong>Xin chào!</strong> Đây là Hệ Thống Học Trực Tuyến được thiết kế để hỗ trợ giảng dạy và học tập hiệu quả. Hệ thống được tích hợp các chức năng hữu ích, cần thiết và giúp ích cho việc giảng dạy và học tập được diễn ra suôn sẻ hơn.
        </p>
        
        <h4 class="sub-title"><i class="fas fa-star"></i> Những lợi ích hệ thống mang lại:</h4>
        <ul class="benefits-list">
            <li><i class="fas fa-check-circle"></i> Thuận lợi trong việc lưu trữ tài liệu học tập</li>
            <li><i class="fas fa-check-circle"></i> Tăng cường tương tác giữa Giảng Viên và Sinh Viên</li>
            <li><i class="fas fa-check-circle"></i> Khả năng học tập linh hoạt mọi lúc, mọi nơi</li>
            <li><i class="fas fa-check-circle"></i> Cập nhật bài giảng nhanh chóng và dễ dàng</li>
        </ul>
        
        <h4 class="sub-title"><i class="fas fa-lightbulb"></i> Giải pháp học tập hiệu quả:</h4>
        
        <p class="content-text">
            <strong>Lựa chọn môi trường học tập phù hợp</strong><br>
            Môi trường là yếu tố có ảnh hưởng lớn đến hiệu quả của buổi học. Một không gian yên tĩnh, không ồn ào, thoáng mát là những tiêu chí để tạo môi trường lý tưởng cho buổi học online.
        </p>
        
        <img src="https://o.rada.vn/data/image/2021/05/24/Hoc-online.jpg" alt="Học online">
        
        <p class="content-text">
            <strong>Tham khảo tài liệu trước khi học online</strong><br>
            Trước khi bắt đầu buổi học trực tuyến, bạn nên đọc trước tài liệu, bài giảng để nắm trước những kiến thức sẽ được dạy. Điều này giúp việc tiếp thu bài giảng hiệu quả hơn.
        </p>
        
        <p class="content-text">
            <strong>Rèn luyện thói quen học tập hàng ngày</strong><br>
            Phương pháp học online muốn đạt hiệu quả cao đòi hỏi bạn cần nghiêm túc, tạo thói quen tốt trong quá trình học tập. Khi có thời gian rảnh, bạn nên vào bài học mỗi ngày.
        </p>
        
        <p class="content-text">
            <strong>Cải thiện kỹ năng đọc nhanh</strong><br>
            Rèn luyện đọc nhanh giúp bạn nắm bắt được nhiều thông tin dễ dàng và nâng cao hiệu quả trong học tập.
        </p>
        
        <p class="content-text">
            <strong>Rèn luyện khả năng ghi chép thường xuyên</strong><br>
            Khi tham gia học tập trực tuyến, đừng quên ghi chép lại những kiến thức cần thiết. Hãy tận dụng kỹ năng ghi chép để lưu lại thông tin quan trọng.
        </p>
        
        <p class="content-text">
            <strong>Tạo nhóm học tập hiệu quả</strong><br>
            Để đạt kết quả cao trong học online, bạn nên tạo nhóm học tập để trao đổi thông tin và thảo luận đề tài với nhau.
        </p>
        
        <img src="https://tuyengiao.vn/Uploads/2022/12/9/10/HN1.jpg" alt="Học nhóm">
        
        <p class="author-credit">— <strong>Phuc Nguyen</strong></p>
    </div>
    
    <!-- Features -->
    <div class="content-card">
        <h2 class="section-title"><i class="fas fa-rocket" style="margin-right:10px;color:#667eea;"></i>Tính Năng Nổi Bật</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon"><i class="fas fa-book-open"></i></div>
                <h4>Tài Liệu Học Tập</h4>
                <p>Lưu trữ và chia sẻ tài liệu học tập dễ dàng, tổ chức khoa học theo từng môn học.</p>
            </div>
            <div class="feature-card">
                <div class="icon"><i class="fas fa-comments"></i></div>
                <h4>Tương Tác Trực Tuyến</h4>
                <p>Kết nối giữa Giảng Viên và Sinh Viên qua hệ thống tin nhắn và thảo luận.</p>
            </div>
            <div class="feature-card">
                <div class="icon"><i class="fas fa-tasks"></i></div>
                <h4>Quản Lý Bài Tập</h4>
                <p>Phân công, nộp và chấm điểm bài tập nhanh chóng, minh bạch.</p>
            </div>
            <div class="feature-card">
                <div class="icon"><i class="fas fa-chart-line"></i></div>
                <h4>Theo Dõi Tiến Độ</h4>
                <p>Theo dõi và đánh giá tiến độ học tập của từng Sinh Viên.</p>
            </div>
        </div>
    </div>
    <?php
}
?>	

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
                    <li><a href="index.php"><i class="fas fa-chevron-right"></i> Trang Chủ</a></li>
                    <li><a href="login-sv.php"><i class="fas fa-chevron-right"></i> Đăng Nhập Sinh Viên</a></li>
                    <li><a href="login-gv.php"><i class="fas fa-chevron-right"></i> Đăng Nhập Giảng Viên</a></li>
                    <li><a href="login-ad.php"><i class="fas fa-chevron-right"></i> Quản Trị Hệ Thống</a></li>
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
                        <span>abc@gmail.com</span>
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