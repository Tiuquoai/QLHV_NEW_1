<?php
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Quản Lý Chung</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, var(--bg-body) 0%, #EEF2FF 100%);
    min-height: 100vh;
    color: var(--text-primary);
    line-height: 1.6;
}

/* ===================== TOP BAR ===================== */
.topbar {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    padding: 12px 0;
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
    color: #fff;
}

.topbar-contact {
    display: flex;
    gap: 24px;
    font-size: 0.9rem;
}

.topbar-contact a {
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.2s;
}

.topbar-contact a:hover {
    opacity: 0.85;
}

.topbar-contact i {
    font-size: 0.85rem;
}

/* ===================== MAIN CONTAINER ===================== */
.main-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px;
}

/* ===================== NAVIGATION TABS ===================== */
.nav-tabs {
    display: flex;
    gap: 12px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.nav-tab {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    background: var(--bg-card);
    color: var(--text-secondary);
    box-shadow: var(--shadow-sm);
}

.nav-tab i {
    font-size: 1.1rem;
}

.nav-tab:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
    color: var(--primary);
    border-color: var(--primary-light);
}

.nav-tab.active {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
}

.nav-tab.active i {
    color: #fff;
}

/* ===================== CONTENT CARD ===================== */
.content-card {
    background: var(--bg-card);
    border-radius: 16px;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.card-header-custom {
    padding: 24px 32px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.card-header-custom h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 12px;
}

.card-header-custom h3 i {
    color: var(--primary);
}

.card-body {
    padding: 32px;
}

/* ===================== TABLE STYLES ===================== */
.table-container {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

.data-table thead {
    background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
}

.data-table th {
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    color: var(--text-primary);
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.data-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-secondary);
}

.data-table tbody tr {
    transition: background 0.2s;
}

.data-table tbody tr:hover {
    background: #F9FAFB;
}

.data-table tbody tr:last-child td {
    border-bottom: none;
}

.data-table .stt-col {
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    width: 60px;
}

/* ===================== ACTION BUTTONS ===================== */
.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.action-btn.edit {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    color: #fff;
}

.action-btn.edit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

.action-btn.delete {
    background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    color: #fff;
}

.action-btn.delete:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

.action-btn.view {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: #fff;
}

.action-btn.view:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

/* ===================== FORM STYLES ===================== */
.form-container {
    max-width: 800px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-control-custom {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 1rem;
    font-family: inherit;
    transition: all 0.2s;
    background: #fff;
}

.form-control-custom:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-control-custom::placeholder {
    color: var(--text-light);
}

select.form-control-custom {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 44px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 640px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.file-upload-wrapper {
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    padding: 32px;
    text-align: center;
    transition: all 0.2s;
    background: #FAFAFA;
}

.file-upload-wrapper:hover {
    border-color: var(--primary);
    background: #F5F3FF;
}

.file-upload-wrapper i {
    font-size: 2.5rem;
    color: var(--text-light);
    margin-bottom: 12px;
}

.file-upload-wrapper p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.file-upload-wrapper input[type="file"] {
    margin-top: 12px;
}

/* ===================== BUTTONS ===================== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 32px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    font-family: inherit;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
}

.btn-secondary {
    background: #fff;
    color: var(--text-primary);
    border: 2px solid var(--border-color);
}

.btn-secondary:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.btn-back {
    background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
    color: #fff;
    padding: 10px 20px;
    font-size: 0.9rem;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(107, 114, 128, 0.4);
}

.btn-add {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 32px;
    flex-wrap: wrap;
}

/* ===================== SECTION TITLE ===================== */
.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 8px;
}

.section-subtitle {
    text-align: center;
    color: var(--text-secondary);
    margin-bottom: 32px;
}

/* ===================== INFO BOX ===================== */
.info-box {
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    border-left: 4px solid var(--primary);
    border-radius: 8px;
    padding: 20px 24px;
    margin-bottom: 24px;
}

.info-box p {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.7;
}

/* ===================== DOWNLOAD LINK ===================== */
.download-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 24px;
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    border-radius: 10px;
    text-decoration: none;
    color: #92400E;
    font-weight: 500;
    transition: all 0.2s;
    margin-top: 16px;
}

.download-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.download-link img {
    width: 24px;
    height: 24px;
}

/* ===================== NEWS DETAIL ===================== */
.news-detail {
    background: #fff;
    border-radius: 12px;
    padding: 32px;
}

.news-title {
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
}

.news-meta {
    display: flex;
    gap: 24px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border-color);
    flex-wrap: wrap;
}

.news-meta span {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.news-meta i {
    color: var(--primary);
}

.news-content {
    color: var(--text-secondary);
    line-height: 1.8;
    font-size: 1rem;
}

.news-image {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
}

/* ===================== EMPTY STATE ===================== */
.empty-state {
    text-align: center;
    padding: 48px 24px;
    color: var(--text-secondary);
}

.empty-state i {
    font-size: 3rem;
    color: var(--text-light);
    margin-bottom: 16px;
}

/* ===================== FOOTER ===================== */
.footer {
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    color: #fff;
    padding: 60px 0 0;
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
    padding-bottom: 48px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-brand {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.footer-brand-logo {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.footer-brand p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
    line-height: 1.7;
}

.footer-section h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #fff;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    border-radius: 2px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.footer-links a:hover {
    color: #fff;
    padding-left: 8px;
}

.footer-links a i {
    font-size: 0.75rem;
    color: var(--primary-light);
}

.footer-contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
}

.footer-contact-item i {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-light);
    font-size: 0.9rem;
}

.footer-bottom {
    text-align: center;
    padding: 24px 0;
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.875rem;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 32px;
        text-align: center;
    }

    .footer-section h4::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .footer-contact-item {
        justify-content: center;
    }

    .topbar-contact {
        flex-direction: column;
        gap: 8px;
    }

    .nav-tabs {
        gap: 8px;
    }

    .nav-tab {
        padding: 10px 16px;
        font-size: 0.85rem;
    }

    .card-body {
        padding: 20px;
    }

    .data-table th,
    .data-table td {
        padding: 12px 10px;
        font-size: 0.85rem;
    }
}

/* ===================== BADGE ===================== */
.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-primary {
    background: #EEF2FF;
    color: var(--primary);
}

.badge-success {
    background: #D1FAE5;
    color: #059669;
}

/* ===================== TABLE IMAGE ===================== */
.table-thumb {
    width: 80px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid var(--border-color);
}
</style>
</head>

<body>
<!-- ===================== TOP BAR ===================== -->
<div class="topbar" id="codinh">
    <div class="topbar-content">
        <div class="topbar-contact">
            <a href="tel:0143234563">
                <i class="fas fa-phone"></i>
                <span>Gọi Điện: 0143.234.563 - ext 808</span>
            </a>
            <a href="mailto:csm@gmail.com">
                <i class="fas fa-envelope"></i>
                <span>Email: csm@gmail.com</span>
            </a>
        </div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>" class="btn btn-back" style="text-decoration: none;">
                <i class="fas fa-home"></i>
                Về Trang Chủ
            </a>
        </div>
    </div>
</div>

<?php

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
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$p->ketnoi($ketnoi);
if(isset($_POST['them'])){
	$mak=$_POST['a'];
	$tenk=$_POST['b'];
	$kt="select * from khoavien where makhoa='$mak'";
	$qt=mysql_query($kt);
	if(mysql_num_rows($qt)==1){
		// Có rồi không thêm nữa
	}
	else{
	$q="insert into khoavien(makhoa,tenkhoa) values('$mak','$tenk') ";
	$m=mysql_query($q);
	echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlkv"');
	}
	
}
elseif(isset($_POST['theme'])){
if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 5*1024*1024) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',
                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',
                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
				'xls1' => 'application/excel',
				'xls2' => 'application/x-excel',
				'xls3' => 'application/x-msexcel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'docx' => 'application/msword',
                'xlsx' => 'application/vnd.ms-excel',
                'pptx' => 'application/vnd.ms-powerpoint',
                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    // 2. Kiểm tra tên tập tin được phép
	/* if($_FILES['f']['type'] != $mimes['xlsx']||$_FILES['f']['type'] != $mimes['xlsx1']||$_FILES['f']['type'] != $mimes['xlsx2']||$_FILES['f']['type'] != $mimes['xlsx3']){
		echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}  */
    // 3. Kiểm tra xem tệp tin đã tồn tại hay chưa
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
        // 5. Tạo tên tệp tin mới để tránh ghi đè
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;

        // 6. Di chuyển tệp tin từ thư mục tạm lên thư mục đích
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
		if (move_uploaded_file($_FILES['f']['tmp_name'], $target_file)) {
              try {
ini_set('display_errors','off');
//Nhúng file PHPExcel
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
//Đường dẫn file
$file = 'file/'.$f;
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);


//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: A là 0, B là 1, C là 2,D là 3
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
$highestRow = $sheet->getHighestRow(); 

// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
$highestColumn = $sheet->getHighestColumn();

// Khai báo mảng $rowData chứa dữ liệu

//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi();
if($kn){
// Kiểm tra file excel tải lên có đúng không ?
$mak= $sheet->getCellByColumnAndRow(1,1)->getValue();
if($mak!="Mã Khoa"){
	echo "<script>alert('File Excel Tải Lên Để Thêm Mới Khoa Không Đúng !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
	$ma= $sheet->getCellByColumnAndRow(1,$row)->getValue();
	$tenk= $sheet->getCellByColumnAndRow(2,$row)->getValue();
    $kt="select *from khoavien where makhoa='$ma'";
	$qt=mysql_query($kt);
	if(mysql_num_rows($qt)==1){
	}
	else{
       $sql="insert into khoavien(makhoa,tenkhoa) values('$ma','$tenk')";
	   $qr=mysql_query($sql);
	   echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlkv"');
	   
	}
	 }
	}
}
} catch(Exception $e) {
    
}

        } else {
            
        }
	}
	}
}
}
elseif(isset($_POST['tecn'])){
	if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 5*1024*1024) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',
                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',
                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
				'xls1' => 'application/excel',
				'xls2' => 'application/x-excel',
				'xls3' => 'application/x-msexcel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'docx' => 'application/msword',
                'xlsx' => 'application/vnd.ms-excel',
                'pptx' => 'application/vnd.ms-powerpoint',
                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    // 2. Kiểm tra tên tập tin được phép
	/* if($_FILES['f']['type'] != $mimes['xlsx']||$_FILES['f']['type'] != $mimes['xlsx1']||$_FILES['f']['type'] != $mimes['xlsx2']||$_FILES['f']['type'] != $mimes['xlsx3']){
		echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}  */
    // 3. Kiểm tra xem tệp tin đã tồn tại hay chưa
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
        // 5. Tạo tên tệp tin mới để tránh ghi đè
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;

        // 6. Di chuyển tệp tin từ thư mục tạm lên thư mục đích
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
		if (move_uploaded_file($_FILES['f']['tmp_name'], $target_file)) {
              try {
ini_set('display_errors','off');
//Nhúng file PHPExcel
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
//Đường dẫn file
$file = 'file/'.$f;
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);


//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: A là 0, B là 1, C là 2,D là 3
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
$highestRow = $sheet->getHighestRow(); 

// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
$highestColumn = $sheet->getHighestColumn();

// Khai báo mảng $rowData chứa dữ liệu

//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi();
if($kn){
$macn= $sheet->getCellByColumnAndRow(1,1)->getValue();
if($macn!="Mã Chuyên Ngành"){
	echo "<script>alert('File Excel Tải Lên Để Thêm Mới Chuyên Ngành Không Đúng !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
	$ma= $sheet->getCellByColumnAndRow(1,$row)->getValue();
	$tencn= $sheet->getCellByColumnAndRow(2,$row)->getValue();
	$i=$sheet->getCellByColumnAndRow(3,$row)->getValue();
	$sql="select * from khoavien where makhoa='$i'";
	$qr=mysql_query($sql);
	$u=mysql_fetch_assoc($qr);
	$ik=$u['id_khoa'];
    $kt="select *from chuyennganh where machuyennganh='$ma'";
	$qt=mysql_query($kt);
	if(mysql_num_rows($qt)==1){
	}
	else{
       $sql="insert into chuyennganh(machuyennganh,tenchuyennganh,id_khoa) values('$ma','$tencn','$ik')";
	   $qr=mysql_query($sql);
	   echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlcn"');
	   
	}
	 }
	}
}
} catch(Exception $e) {
    
}

        } else {
            
        }
	}
	}
}
}
elseif(isset($_POST['sua'])){
	$id=$_REQUEST['suakv'];
	$a=$_POST['a'];
	$b=$_POST['b'];
	$kt="select * from khoavien where id_khoa='$id'";
    // var_dump($kt);
	$qt=mysql_query($kt);
    // var_dump(mysql_num_rows($qt));
    // exit;
    if(mysql_num_rows($qt)==0){
        echo "<script>alert('Không có dữ liệu nào !!!')</script>";
	}
	else{
	$sql="update khoavien set makhoa='$a', tenkhoa='$b' where id_khoa='$id'";
	$qr=mysql_query($sql);
    // var_dump($qr);
    //     exit;
        echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlkv"');
	}
}
elseif(isset($_REQUEST['xoakv'])){
	$ir=$_REQUEST['xoakv'];
	$sql="delete from khoavien where id_khoa='$ir'";
	$qr=mysql_query($sql);
	$sql1="delete from chuyennganh where id_khoa='$ir'";
	$qr1=mysql_query($sql1);
	echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlkv"');
}
elseif(isset($_POST['themc'])){
	$a=$_POST['a'];
	$b=$_POST['b'];
	$c=$_POST['c'];
	$kt="select *from chuyennganh where machuyennganh='$a'";
	$qk=mysql_query($kt);
	if(mysql_num_rows($qk)==1){
		//Có rồi không thêm nữa 
	}
	else{
	$sql="insert into chuyennganh( machuyennganh, tenchuyennganh, id_khoa) values ('$a','$b','$c') ";
	$qr=mysql_query($sql);
	echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlcn"');
	}
}
elseif(isset($_POST['suac'])){
	$id=$_REQUEST['suacn'];
	$a=$_POST['a'];
	$b=$_POST['b'];
	$c=$_POST['c'];
	$kt="select * from chuyennganh where id_chuyennganh='$id'";
	$qt=mysql_query($kt);
    // var_dump(mysql_num_rows($qt));
    // exit;
	if(mysql_num_rows($qt)<=0){
        echo "<script>alert('Không có dữ liệu nào !!!')</script>";
	}
	else{
	$sql="update chuyennganh set machuyennganh='$a', tenchuyennganh= '$b' , id_khoa='$c' where id_chuyennganh='$id'";
	$qr=mysql_query($sql);
	echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlcn"');
	}
}
elseif(isset($_REQUEST['xoacn'])){
	$id=$_REQUEST['xoacn'];
	$a=$_POST['a'];
	$b=$_POST['b'];
	$c=$_POST['c'];
	$sql="delete from chuyennganh where id_chuyennganh='$id'";
	$qr=mysql_query($sql);
	echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qlcn"');
}
elseif(isset($_POST['dtl'])){
	if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 5*1024*1024) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',
                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',
                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
				'xls1' => 'application/excel',
				'xls2' => 'application/x-excel',
				'xls3' => 'application/x-msexcel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'docx' => 'application/msword',
                'xlsx' => 'application/vnd.ms-excel',
                'pptx' => 'application/vnd.ms-powerpoint',
                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    // 2. Kiểm tra tên tập tin được phép
	/* if($_FILES['f']['type'] != $mimes['xlsx']||$_FILES['f']['type'] != $mimes['xlsx1']||$_FILES['f']['type'] != $mimes['xlsx2']||$_FILES['f']['type'] != $mimes['xlsx3']){
		echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}  */
    // 3. Kiểm tra xem tệp tin đã tồn tại hay chưa
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
        // 5. Tạo tên tệp tin mới để tránh ghi đè
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;

        // 6. Di chuyển tệp tin từ thư mục tạm lên thư mục đích
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
		if (move_uploaded_file($_FILES['f']['tmp_name'], $target_file)) {
              try {
ini_set('display_errors','off');
//Nhúng file PHPExcel
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
//Đường dẫn file
$file = 'file/'.$f;
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);


//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: A là 0, B là 1, C là 2,D là 3
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
$highestRow = $sheet->getHighestRow(); 

// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
$highestColumn = $sheet->getHighestColumn();

// Khai báo mảng $rowData chứa dữ liệu

//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi();
if($kn){
// Kiểm tra up đúng file không ???
$tdtiu= $sheet->getCellByColumnAndRow(0,1)->getValue();
$tdnd= $sheet->getCellByColumnAndRow(1,1)->getValue();
if($tdtiu!="Tiêu Đề" || $tdnd!="Nội Dung"){
    // var_dump($tdtiu);
    // var_dump($tdnd);
    // exit;
	echo "<script>alert('File Excel Tải Lên Để Thêm Mới Tin Tức Không Đúng !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
	$td= $sheet->getCellByColumnAndRow(0,$row)->getValue();
	$nd= $sheet->getCellByColumnAndRow(1,$row)->getValue();
	$tg=$sheet->getCellByColumnAndRow(2,$row)->getValue();
	$anh=$sheet->getCellByColumnAndRow(3,$row)->getValue();
    $kt="select *from tintuc where tieude='$td' and noidung='$nd'";
	$qt=mysql_query($kt);
	if(mysql_num_rows($qt)==1){
	}
	else{
       $sql="insert into tintuc(tieude,noidung,ngaydangtai,tacgia,anhdaidien) values('$td','$nd',now(),'$tg','$anh')";
	   $qr=mysql_query($sql);
	   echo header('refresh:0,url="quanlychung.php?bm='.$_REQUEST['bm'].'&&qltt"');
	   
	}
	 }
	}
}
} catch(Exception $e) {
    
}

        } else {
            
        }
	}
	}
}
}
elseif(isset($_REQUEST['xoatt'])){
	$xoatt= $_REQUEST['xoatt'];
	$sql="delete from tintuc where id_tintuc='$xoatt'";
	$qr=mysql_query($sql);
}
?>

<!-- ===================== MAIN CONTENT ===================== -->
<div class="main-container">
    <!-- ===================== NAVIGATION TABS ===================== -->
    <div class="nav-tabs">
        <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv" class="nav-tab <?php if(isset($_REQUEST['qlkv'])) echo 'active'; ?>">
            <i class="fas fa-building"></i>
            Quản Lý Khoa/Viện
        </a>
        <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn" class="nav-tab <?php if(isset($_REQUEST['qlcn'])) echo 'active'; ?>">
            <i class="fas fa-graduation-cap"></i>
            Quản Lý Chuyên Ngành
        </a>
        <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qltt" class="nav-tab <?php if(isset($_REQUEST['qltt'])) echo 'active'; ?>">
            <i class="fas fa-newspaper"></i>
            Quản Lý Tin Tức
        </a>
    </div>

    <!-- ===================== CONTENT SECTION ===================== -->
    <?php
	if(isset($_REQUEST['qlkv'])){
		?>
        <div class="content-card">
            <?php
			if(isset($_REQUEST['themkv'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-plus-circle"></i> Thêm Mới Khoa/Viện</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mã Khoa/Viện</label>
                                    <input type="text" name="a" class="form-control-custom" required="required" placeholder="Nhập mã khoa/viện"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tên Khoa/Viện</label>
                                    <input type="text" name="b" class="form-control-custom" required="required" placeholder="Nhập tên khoa/viện"/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="them" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Thêm Mới
                                </button>
                                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay Lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
			}
			elseif(isset($_REQUEST['themkve'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-file-import"></i> Thêm Mới Khoa/Viện (Import Excel)</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <div class="file-upload-wrapper">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Chọn file Excel để import dữ liệu khoa/viện</p>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <input type="file" name="f" class="form-control-custom" required="required" accept=".xlsx,.xls" style="max-width: 300px; margin: 16px auto;"/>
                                <div class="form-actions">
                                    <button type="submit" name="theme" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Tải Lên
                                    </button>
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay Lại
                                    </a>
                                </div>
                            </form>
                            <a href="taixuong.php?fu=Tao_Moi_Khoa_Vien.xlsx" class="download-link">
                                <img src="https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107"/>
                                <span>Tải Mẫu Excel Thêm Mới Khoa/Viện</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
			}
			elseif(isset($_REQUEST['suakv'])){
				$id=$_REQUEST['suakv'];
				$sql="select * from khoavien where id_khoa='$id'";
				$qr=mysql_query($sql);
				$kv=mysql_fetch_assoc($qr);
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-edit"></i> Sửa Khoa/Viện</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mã Khoa/Viện</label>
                                    <input type="text" name="a" value="<?php echo $kv['makhoa'] ?>" class="form-control-custom" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tên Khoa/Viện</label>
                                    <input type="text" name="b" value="<?php echo $kv['tenkhoa'] ?>" class="form-control-custom" required="required"/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="sua" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Lưu Thay Đổi
                                </button>
                                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay Lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
			}
			else{
            ?>
            <div class="card-header-custom">
                <h3><i class="fas fa-building"></i> Danh Sách Khoa/Viện</h3>
                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&themkv" class="btn btn-add">
                    <i class="fas fa-plus"></i> Thêm Mới
                </a>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-container" style="border: none; border-radius: 0;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Khoa</th>
                                <th>Tên Khoa</th>
                                <th style="text-align: center;">Sửa</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
							include_once("Model/mKetNoiADHT.php");
							$p=new ketnoiAD();
							$p->ketnoi($ketnoi);
							$s="select * from khoavien";
							$q=mysql_query($s);
							$a=1;
							while($k=mysql_fetch_assoc($q)){
							?>
                            <tr>
                                <td class="stt-col"><?php echo $a++; ?></td>
                                <td><span class="badge badge-primary"><?php echo $k['makhoa']; ?></span></td>
                                <td style="font-weight: 500; color: var(--text-primary);"><?php echo $k['tenkhoa'];?></td>
                                <td style="text-align: center;">
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&suakv=<?php echo $k['id_khoa'] ?>" class="action-btn edit">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&xoakv=<?php echo $k['id_khoa']?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                           <?php
							}
							$a++;
						   ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
	}
	elseif(isset($_REQUEST['qlcn'])){
		?>
        <div class="content-card">
            <?php
            if(isset($_REQUEST['themcn'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-plus-circle"></i> Thêm Mới Chuyên Ngành</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mã Chuyên Ngành</label>
                                    <input type="text" name="a" class="form-control-custom" required="required" placeholder="Nhập mã chuyên ngành"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tên Chuyên Ngành</label>
                                    <input type="text" name="b" class="form-control-custom" required="required" placeholder="Nhập tên chuyên ngành"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Khoa/Viện</label>
                                <select name="c" class="form-control-custom">
                               <?php
							   $sm="select * from khoavien";
								$q=mysql_query($sm);
								$a=1;
								while($cn=mysql_fetch_assoc($q)){
							   ?>
                                <option value="<?php echo $cn['id_khoa'] ?>"><?php echo $cn['tenkhoa'] ?></option>
                               <?php } ?>
                                </select>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="themc" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Thêm Mới
                                </button>
                                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay Lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
			}
			elseif(isset($_REQUEST['themcne'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-file-import"></i> Thêm Mới Chuyên Ngành (Import Excel)</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <div class="file-upload-wrapper">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Chọn file Excel để import dữ liệu chuyên ngành</p>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <input type="file" name="f" class="form-control-custom" required="required" accept=".xlsx,.xls" style="max-width: 300px; margin: 16px auto;"/>
                                <div class="form-actions">
                                    <button type="submit" name="tecn" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Tải Lên
                                    </button>
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay Lại
                                    </a>
                                </div>
                            </form>
                            <a href="taixuong.php?fu=Tao_Moi_Chuyen_Nganh.xlsx" class="download-link">
                                <img src="https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107"/>
                                <span>Tải Mẫu Excel Thêm Mới Chuyên Ngành</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
			}
			elseif(isset($_REQUEST['suacn'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-edit"></i> Sửa Chuyên Ngành</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <?php
					   $suacn=$_REQUEST['suacn'];
					   $sm="select * from chuyennganh c join khoavien k on c.id_khoa=k.id_khoa where 
					   c.id_chuyennganh='$suacn'";
					   $q=mysql_query($sm);
					   $cn=mysql_fetch_assoc($q);
					   ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mã Chuyên Ngành</label>
                                    <input type="text" name="a" value="<?php echo $cn['machuyennganh'] ?>" class="form-control-custom" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tên Chuyên Ngành</label>
                                    <input type="text" name="b" value="<?php echo $cn['tenchuyennganh'] ?>" class="form-control-custom" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Khoa/Viện</label>
                                <select name="c" class="form-control-custom">
                                <option value="<?php echo $cn['id_khoa'] ?>"><?php echo $cn['tenkhoa'] ?></option>
                               <?php
							   $sm="select * from khoavien";
								$q=mysql_query($sm);
								$a=1;
								while($k=mysql_fetch_assoc($q)){
							     ?>
                                <option value="<?php echo $k['id_khoa'] ?>"><?php echo $k['tenkhoa'] ?></option>
                                 <?php
									}
								 ?>
                                </select>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="suac" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Lưu Thay Đổi
                                </button>
                                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay Lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
			}
			else{
			?>
            <div class="card-header-custom">
                <h3><i class="fas fa-graduation-cap"></i> Danh Sách Chuyên Ngành</h3>
                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlcn&&themcn" class="btn btn-add">
                    <i class="fas fa-plus"></i> Thêm Mới
                </a>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-container" style="border: none; border-radius: 0;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Chuyên Ngành</th>
                                <th>Tên Chuyên Ngành</th>
                                <th>Khoa/Viện</th>
                                <th style="text-align: center;">Sửa</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$sm="select * from khoavien k join chuyennganh c on k.id_khoa=c.id_khoa";
							$q=mysql_query($sm);
							$a=1;
							while($cn=mysql_fetch_assoc($q)){
							?>
                            <tr>
                                <td class="stt-col"><?php echo $a++; ?></td>
                                <td><span class="badge badge-primary"><?php echo $cn['machuyennganh']?></span></td>
                                <td style="font-weight: 500; color: var(--text-primary);"><?php echo $cn['tenchuyennganh']?></td>
                                <td><span class="badge badge-success"><?php echo $cn['tenkhoa']?></span></td>
                                <td style="text-align: center;">
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlcn&&suacn=<?php echo $cn['id_chuyennganh'] ?>" class="action-btn edit">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlcn&&xoacn=<?php echo $cn['id_chuyennganh'] ?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php
							}
							$a++;
							?>
                        </tbody>
                    </table>
                </div>
            </div>
              <?php } ?>
        </div>
        <?php
	}
	elseif(isset($_REQUEST['qlhk'])){
		?>
        <div class="content-card">
            <div class="card-body">
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p>Chức năng đang được phát triển</p>
                </div>
            </div>
        </div>
        <?php
	}
	elseif(isset($_REQUEST['qltt'])){
		?>
        <div class="content-card">
            <?php
			if(isset($_REQUEST['themtt'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-file-import"></i> Thêm Mới Tin Tức (Import Excel)</h3>
                </div>
                <div class="card-body">
                    <div class="form-container">
                        <div class="file-upload-wrapper">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Chọn file Excel để import dữ liệu tin tức</p>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <input type="file" name="f" class="form-control-custom" required="required" accept=".xlsx,.xls" style="max-width: 300px; margin: 16px auto;"/>
                                <div class="form-actions">
                                    <button type="submit" name="dtl" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Tải Lên
                                    </button>
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qltt" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Quay Lại
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
			}
			elseif(isset($_REQUEST['xe'])){
				?>
                <div class="card-header-custom">
                    <h3><i class="fas fa-newspaper"></i> Chi Tiết Tin Tức</h3>
                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qltt" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay Lại
                    </a>
                </div>
                <div class="card-body">
                    <?php
					$x=$_REQUEST['xe'];
					$sql="select * from tintuc where id_tintuc='$x'";
					$qr=mysql_query($sql);
					$e=mysql_fetch_assoc($qr);
					?>
                    <div class="news-detail">
                        <h2 class="news-title"><?php echo $e['tieude'] ?></h2>
                        <div class="news-meta">
                            <span><i class="fas fa-user"></i> <strong>Tác giả:</strong> <?php echo $e['tacgia'] ?></span>
                            <span><i class="fas fa-calendar"></i> <strong>Ngày đăng:</strong> <?php echo $e['ngaydangtai'] ?></span>
                        </div>
                        <?php if($e['anhdaidien']){ ?>
                        <img src="<?php echo $e['anhdaidien']?>" alt="Ảnh đại diện" class="news-image"/>
                        <?php } ?>
                        <div class="news-content">
                            <?php echo $e['noidung'] ?>
                        </div>
                    </div>
                </div>
                <?php
			}
			else{
			?>
            <div class="card-header-custom">
                <h3><i class="fas fa-newspaper"></i> Danh Sách Tin Tức</h3>
                <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qltt&&themtt" class="btn btn-add">
                    <i class="fas fa-plus"></i> Thêm Mới
                </a>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-container" style="border: none; border-radius: 0;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh Đại Diện</th>
                                <th>Tiêu Đề</th>
                                <th>Ngày Đăng</th>
                                <th>Tác Giả</th>
                                <th style="text-align: center;">Xem Chi Tiết</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$sql="select * from tintuc";
							$qr=mysql_query($sql);
							$a=1;
							while($r=mysql_fetch_assoc($qr)){
							?>
                            <tr>
                                <td class="stt-col"><?php echo $a++; ?></td>
                                <td><img src="<?php echo $r['anhdaidien']?>" class="table-thumb"/></td>
                                <td style="font-weight: 500; color: var(--text-primary); max-width: 200px;"><?php echo $r['tieude']?></td>
                                <td><?php echo $r['ngaydangtai']?></td>
                                <td><?php echo $r['tacgia']?></td>
                                <td style="text-align: center;">
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qltt&&xe=<?php echo $r['id_tintuc'] ?>" class="action-btn view">
                                        <i class="fas fa-eye"></i> Chi Tiết
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qltt&&xoatt=<?php echo $r['id_tintuc'] ?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php
							}
							$a++;
							?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
			}
			?>
        </div>
        <?php
		}
	else{
		?>
        <div class="content-card">
            <div class="card-body">
                <div class="info-box">
                    <h3 style="font-size: 1.2rem; margin-bottom: 12px; color: var(--primary);">
                        <i class="fas fa-info-circle"></i> Giới thiệu chức năng "Quản Lý Chung"
                    </h3>
                    <p>Đây là các chức năng nền tảng và cơ bản cần có để thống nhất hệ thống một cách chuyên nghiệp.</p>
                    <p style="margin-top: 12px;">Vì lý do trên, hệ thống được tích hợp các chức năng có thể quản lý dễ dàng hơn.</p>
                    <p style="margin-top: 12px;">Các chức năng gồm có: Quản lý Khoa/Viện, Quản lý Chuyên Ngành, Quản lý Tin Tức - đều được tạo ra và hỗ trợ thêm bằng Excel giúp xử lý công việc nhanh hơn.</p>
                </div>
                <div style="text-align: center; margin-top: 24px;">
                    <p style="color: var(--text-light);">Chọn một tab phía trên để bắt đầu quản lý</p>
                </div>
            </div>
        </div>
        <?php
	}
	?>
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
                    <li><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv"><i class="fas fa-chevron-right"></i> Quản Lý Khoa/Viện</a></li>
                    <li><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn"><i class="fas fa-chevron-right"></i> Quản Lý Chuyên Ngành</a></li>
                    <li><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qltt"><i class="fas fa-chevron-right"></i> Quản Lý Tin Tức</a></li>
                    <li><a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>"><i class="fas fa-chevron-right"></i> Trang Chủ Admin</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Liên Hệ</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-building"></i>
                    <span>Trung Tâm Quản Trị Hệ Thống - Trường...</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>0143.234.563</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>abc@gmail.com</span>
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
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("codinh");

var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
