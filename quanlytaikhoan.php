<?php 
session_start();
ob_start();
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$p->ketnoi($ketnoi);
	if(isset($_POST['luutt'])){
		include_once("Controller/cTKADHT.php");
		$p=new cTKAD();
		$target_directory = "img/";
    $fname = $_FILES['f']['name'];
	$fkieu = $_FILES['f']['type'];
    $tfile = $target_directory . basename($fname);
	if (move_uploaded_file($_FILES['f']['tmp_name'], $tfile)) {}
		$p->suattsv();
	   	$p->suattsv1(); 
		 echo header("refresh:0,url='quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&xemchitiet&&mssv=".$_REQUEST['mssv']."&&page=".$_REQUEST['page']."'"); 
		
	}
	elseif(isset($_POST['ltd'])){
		include_once("Controller/cTKADHT.php");
		$p=new cTKAD();
		$target_directory = "img/";
    $fname = $_FILES['f']['name'];
	$fkieu = $_FILES['f']['type'];
    $tfile = $target_directory . basename($fname);
	if (move_uploaded_file($_FILES['f']['tmp_name'], $tfile)) {}
		$p->suattgv();
	   	$p->suattgv1(); 
		 echo header("refresh:0,url='quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&xemchitietgv&&mgv=".$_REQUEST['mgv']."&&page=".$_REQUEST['page']."'"); 
		
	
	}
	?>
<?php
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}

include_once("Controller/cTKADHT.php");
$p=new cTKAD();
$b=$p->ktbm();
$c=mysql_fetch_assoc($b);
$c1=$c['user_code'];
$a=$_REQUEST['bm'];
if($a != $c1){
	echo header("refresh:0,url='index.php'");
}
?>
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

<?php // Tải sinh viên theo chuyên ngành 
if(isset($_POST['tex'])){
include('PHPExcel/Classes/PHPExcel.php');
include('PHPExcel/Classes/PHPExcel/IOFactory.php');
$objPHPExcel= new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'STT')
->setCellValue('B1', 'MSSV')
->setCellValue('C1', 'Họ Và Tên')
->setCellValue('D1', 'Chuyên Ngành');

include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$p->ketnoi($ketnoi);
$a=$_POST['a'];
$sql="select * from sinhvien s join chuyennganh c on s.id_chuyennganh=c.id_chuyennganh
 where s.id_chuyennganh='$a'";
$qr=mysql_query($sql);

 $sql1="select * from sinhvien s join chuyennganh c on s.id_chuyennganh=c.id_chuyennganh
 where s.id_chuyennganh='$a'";
$qr1=mysql_query($sql1);
 $r=mysql_fetch_assoc($qr1);

 $key = 2;
 $a=1;
 while($ft = mysql_fetch_assoc($qr)) {

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$key, $a++)
            ->setCellValue('B'.$key, $ft['masosinhvien'])
            ->setCellValue('C'.$key, $ft['tensinhvien'])
            ->setCellValue('D'.$key, $ft['lopCN'])
			->setCellValue('D'.$key, $ft['machuyennganh']);
            $key ++;
 }
 $a++;

  $objPHPExcel->getActiveSheet()->setTitle("DanhSachSinhVien");
  $objWriter =  PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DSSV. Ngành '.$r['tenchuyennganh'].'.xlsx');
    header('Cache-Control: max-age=0');

    ob_end_clean();
    $objWriter->save('php://output');
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Quản Lý Tài Khoản</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
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
    max-width: 1400px;
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

.topbar-title i {
    font-size: 1.4rem;
}

.topbar-actions {
    display: flex;
    gap: 12px;
    align-items: center;
}

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

.btn-home:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-1px);
}

/* ===================== MAIN CONTAINER ===================== */
.main-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 24px;
}

/* ===================== NAV TABS ===================== */
.nav-tabs-custom {
    display: flex;
    gap: 12px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.nav-tab-item {
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

.nav-tab-item i {
    font-size: 1.1rem;
}

.nav-tab-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
    color: var(--primary);
    border-color: var(--primary-light);
}

.nav-tab-item.active {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
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
    padding: 20px 28px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
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

.card-header-custom h3 i {
    color: var(--primary);
}

.card-body-custom {
    padding: 28px;
}

/* ===================== TOOLBAR ===================== */
.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
}

.toolbar-left {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.toolbar-right {
    display: flex;
    gap: 12px;
}

/* ===================== BUTTONS ===================== */
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

.btn-success {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-export {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: #fff;
    padding: 10px 18px;
    font-size: 0.9rem;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.btn-sm {
    padding: 8px 16px;
    font-size: 0.85rem;
}

/* ===================== SEARCH FILTER ===================== */
.filter-bar {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
    align-items: center;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-input {
    padding: 10px 16px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.2s;
    min-width: 160px;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.btn-filter {
    padding: 10px 20px;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-filter:hover {
    background: var(--primary-dark);
}

/* ===================== TABLE ===================== */
.table-wrapper {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.data-table thead {
    background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
}

.data-table th {
    padding: 14px 16px;
    text-align: left;
    font-weight: 600;
    color: var(--text-primary);
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    white-space: nowrap;
    border-bottom: 2px solid var(--border-color);
}

.data-table td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-secondary);
    vertical-align: middle;
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

.data-table .stt {
    font-weight: 600;
    color: var(--text-primary);
    text-align: center;
    width: 50px;
}

/* ===================== BADGES ===================== */
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

.badge-warning {
    background: #FEF3C7;
    color: #D97706;
}

.badge-danger {
    background: #FEE2E2;
    color: #DC2626;
}

/* ===================== ACTION BUTTONS ===================== */
.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
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

.action-btn.mail {
    background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    color: #fff;
    padding: 6px 10px;
}

.action-btn.mail:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

.action-btn.mail.sent {
    background: #D1FAE5;
    color: #059669;
}

.table-thumb {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border-color);
}

/* ===================== PROFILE DETAIL ===================== */
.profile-container {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 32px;
}

@media (max-width: 992px) {
    .profile-container {
        grid-template-columns: 1fr;
    }
}

.profile-sidebar {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 32px;
    text-align: center;
    color: #fff;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(255, 255, 255, 0.3);
    margin-bottom: 20px;
}

.profile-name {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.profile-role {
    font-size: 0.9rem;
    opacity: 0.85;
    margin-bottom: 24px;
}

.profile-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.profile-stat {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
    padding: 16px;
}

.profile-stat-value {
    font-size: 1.2rem;
    font-weight: 700;
}

.profile-stat-label {
    font-size: 0.75rem;
    opacity: 0.8;
    text-transform: uppercase;
}

.profile-content {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.profile-section {
    background: #FAFAFA;
    border-radius: 12px;
    padding: 24px;
    border: 1px solid var(--border-color);
}

.profile-section-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.profile-section-title i {
    color: var(--primary);
}

.profile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.profile-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.profile-item label {
    font-size: 0.75rem;
    text-transform: uppercase;
    color: var(--text-light);
    font-weight: 600;
    letter-spacing: 0.05em;
}

.profile-item span {
    font-size: 0.95rem;
    color: var(--text-primary);
    font-weight: 500;
}

.profile-item span.readonly {
    padding: 8px 12px;
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 6px;
}

/* ===================== FORM STYLES ===================== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

@media (max-width: 992px) {
    .form-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label {
    font-weight: 500;
    color: var(--text-primary);
    font-size: 0.9rem;
}

.form-control-modern {
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.2s;
    background: #fff;
}

.form-control-modern:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-control-modern::placeholder {
    color: var(--text-light);
}

select.form-control-modern {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 44px;
}

textarea.form-control-modern {
    min-height: 120px;
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 32px;
    flex-wrap: wrap;
}

.form-actions-center {
    text-align: center;
    margin-top: 24px;
}

/* ===================== FILE UPLOAD ===================== */
.file-upload-area {
    border: 2px dashed var(--border-color);
    border-radius: 16px;
    padding: 48px 32px;
    text-align: center;
    transition: all 0.2s;
    background: #FAFAFA;
    max-width: 600px;
    margin: 0 auto;
}

.file-upload-area:hover {
    border-color: var(--primary);
    background: #F5F3FF;
}

.file-upload-area i {
    font-size: 3rem;
    color: var(--text-light);
    margin-bottom: 16px;
}

.file-upload-area p {
    color: var(--text-secondary);
    font-size: 1rem;
    margin-bottom: 16px;
}

.file-upload-area input[type="file"] {
    margin: 16px 0;
}

.download-template {
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
    margin-top: 20px;
}

.download-template:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

/* ===================== PAGINATION ===================== */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 32px;
    gap: 6px;
    flex-wrap: wrap;
}

.pagination-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 42px;
    padding: 0 14px;
    border-radius: 10px;
    background: #fff;
    border: 2px solid var(--border-color);
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.pagination-btn:hover:not(.active):not(.disabled) {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
}

.pagination-btn.active {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-color: var(--primary);
    color: #fff;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.35);
}

.pagination-btn.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}

.pagination-btn.nav {
    background: #fff;
    font-weight: 700;
}

.pagination-btn.nav:hover:not(.disabled) {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
}

.pagination-ellipsis {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 42px;
    color: var(--text-light);
    font-weight: 600;
}

.pagination-info {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: 16px;
    padding: 8px 16px;
    background: #F3F4F6;
    border-radius: 20px;
    font-size: 0.85rem;
    color: var(--text-secondary);
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

/* ===================== FOOTER ===================== */
.footer {
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    color: #fff;
    padding: 48px 0 0;
    margin-top: 48px;
}

.footer-content {
    max-width: 1400px;
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

.footer-brand {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.footer-brand-logo {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    object-fit: cover;
}

.footer-brand p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    line-height: 1.7;
}

.footer-section h4 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 16px;
    color: #fff;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.footer-links a:hover {
    color: #fff;
}

.footer-links a i {
    font-size: 0.7rem;
    color: var(--primary-light);
}

.footer-contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.footer-contact-item i {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-light);
}

.footer-bottom {
    text-align: center;
    padding: 20px 0;
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.85rem;
}

/* ===================== BACK BUTTON ===================== */
.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: #fff;
    border: 2px solid var(--border-color);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.2s;
}

.back-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
}

/* ===================== RADIO GROUP ===================== */
.radio-group {
    display: flex;
    gap: 16px;
    align-items: center;
}

.radio-item {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.radio-item input[type="radio"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--primary);
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 32px;
        text-align: center;
    }

    .toolbar {
        flex-direction: column;
        align-items: stretch;
    }

    .toolbar-left,
    .toolbar-right {
        justify-content: center;
    }

    .filter-bar {
        flex-direction: column;
    }

    .filter-group {
        width: 100%;
    }

    .form-input {
        width: 100%;
    }

    .nav-tabs-custom {
        justify-content: center;
    }

    .card-body-custom {
        padding: 16px;
    }
}

/* ===================== RADIO BUTTONS ===================== */
.form-radio-group {
    display: flex;
    gap: 20px;
    align-items: center;
}

.form-radio-item {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 8px 16px;
    border-radius: 8px;
    border: 2px solid var(--border-color);
    transition: all 0.2s;
}

.form-radio-item:has(input:checked) {
    border-color: var(--primary);
    background: #EEF2FF;
}

.form-radio-item input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: var(--primary);
}
</style>
</head>

<body>
<!-- ===================== TOPBAR ===================== -->
<div class="topbar" id="codinh">
    <div class="topbar-content">
        <div class="topbar-title">
            <i class="fas fa-users-cog"></i>
            <span>Quản Lý Tài Khoản Người Dùng</span>
        </div>
        <div class="topbar-actions">
            <a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>" class="btn-home">
                <i class="fas fa-home"></i>
                Về Trang Chủ
            </a>
        </div>
    </div>
</div>

<!-- ===================== MAIN CONTENT ===================== -->
<div class="main-container">
    <!-- ===================== NAV TABS ===================== -->
    <div class="nav-tabs-custom">
        <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1" class="nav-tab-item <?php if(isset($_REQUEST['sv'])) echo 'active'; ?>">
            <i class="fas fa-user-graduate"></i>
            Quản Lý Sinh Viên
        </a>
        <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=1" class="nav-tab-item <?php if(isset($_REQUEST['gv'])) echo 'active'; ?>">
            <i class="fas fa-chalkboard-teacher"></i>
            Quản Lý Giảng Viên
        </a>
    </div>

<?php
if(isset($_REQUEST['sv'])){
	?>
    <div class="content-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-list"></i> Danh Sách Sinh Viên</h3>
            <div style="display: flex; gap: 12px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&them" class="btn btn-success">
                    <i class="fas fa-plus"></i> Thêm Sinh Viên
                </a>
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&taiexcel" class="btn btn-export">
                    <i class="fas fa-file-excel"></i> Tải Excel
                </a>
            </div>
        </div>
        <div class="card-body-custom">
            <!-- Filter Bar -->
            <form action="#" method="post" enctype="multipart/form-data">
            <div class="filter-bar">
                <div class="filter-group">
                    <input type="text" name="ht" placeholder="Họ Tên SV" class="form-input" value="<?php if(isset($_POST['loc'])){ $sd=$p->loc(); $a=mysql_fetch_assoc($sd); echo $a['tensinhvien']; }?>"/>
                </div>
                <div class="filter-group">
                    <input type="text" name="mssv" placeholder="Mã Số SV" class="form-input" value="<?php if(isset($_POST['loc'])){ $sd=$p->loc(); $a=mysql_fetch_assoc($sd); echo $a['masosinhvien']; }?>"/>
                </div>
                <button type="submit" name="loc" class="btn-filter">
                    <i class="fas fa-search"></i> Lọc
                </button>
            </div>
            </form>

            <!-- Table -->
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sinh Viên</th>
                            <th>MSSV</th>
                            <th>Giới Tính</th>
                            <th>Lớp</th>
                            <th>Trạng Thái</th>
                            <th>Email</th>
                            <th style="text-align: center;">Gửi Mail</th>
                            <th style="text-align: center;">Chi Tiết</th>
                            <th style="text-align: center;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						 include_once("Controller/cTKADHT.php");
						 $p=new cTKAD();
						 if(isset($_POST['loc'])){
							 $xsv=$p->loc();
						 }
						 else{
						 $xsv=$p->laydanhsach();
						 }
						 $a=1;
						 $n=$_REQUEST['page'];
						 while($c=mysql_fetch_assoc($xsv)){
						 ?>
                        <tr>
                            <td class="stt"><?php if($n==1){ echo $a++; } elseif($n>=2){ echo (($n-1)*5)+$a++; }?></td>
                            <td style="font-weight: 500; color: var(--text-primary);"><?php echo $c['tensinhvien']; ?></td>
                            <td><span class="badge badge-primary"><?php echo $c['masosinhvien']; ?></span></td>
                            <td><?php echo $c['gioitinh']; ?></td>
                            <td><?php echo $c['lopCN']; ?></td>
                            <td>
                                <?php if($c['trangthai']==1){ echo '<span class="badge badge-success">Đang Học</span>'; }
                                elseif($c['trangthai']==2){ echo '<span class="badge badge-warning">Đã Tốt Nghiệp</span>'; }
                                else{ echo '<span class="badge badge-danger">Ngưng Học</span>'; }?>
                            </td>
                            <td><?php echo $c['email']; ?></td>
                            <td style="text-align: center;">
                                <?php if($c['ttguigmailctk']==0){ ?>
                                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&mssv=<?php echo md5($c['masosinhvien']) ?>&&guigmail&&page=<?php echo $_REQUEST['page']; ?>" class="action-btn mail">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <?php } else { ?>
                                <span class="action-btn mail sent"><i class="fas fa-check"></i></span>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitiet&&mssv=<?php echo md5($c['masosinhvien']) ?>&&page=<?php echo $_REQUEST['page'];?>" class="action-btn view">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="xoasv.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=<?php echo $_REQUEST['page']?>&xoasv=<?php echo md5($c['user_id']) ?>&xoa" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <?php
                if(isset($_POST['loc'])){
                }
                else{
                    $p->Page();
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
elseif(isset($_REQUEST['guigmail'])){
    include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$kn=$p->ketnoi($ketnoi);
if($kn){
 $mssv=$_REQUEST['mssv'];
 $sql2="select * from user u join sinhvien sv on u.user_id=sv.user_id where u.user_code='$mssv'";
 $qr2=mysql_query($sql2);
 $s=mysql_fetch_assoc($qr2);
 $e=$s['email'];
include "class.phpmailer.php";
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = "thuonghoaicute103@gmail.com";
$mail->Password = "apss kjci mxka pjby";
$mail->SetFrom("thuonghoaicute103@gmail.com");
$mail->AddAddress($e);
$mail->Subject = "Trung Tam Quan Tri He Thong LMS";
$mail->Body = "<p style='color:#000;'><strong>Xin Gửi Đến Sinh Viên Tài Khoản Và Mật Khẩu Đăng Nhập Hệ Thống !</strong> <br>
<p></p>
- Tên Sinh Viên: ".$s['tensinhvien']."<br/>
- Tên Tài Khoản: ".$s['masosinhvien']." <br/>
- Mật Khẩu: 123456 <br/>
- Mọi Thắc Mắc Xin Gửi Gmail Về Hệ Thống ! Xin Cảm Ơn ! </p>";
 if(!$mail->Send()){
    echo "Lỗi gửi mail: " . $mail->ErrorInfo;
    exit();
}
else{
}
	$sql="update user set ttguigmailctk='1' where user_code='$mssv'";
	$qr=mysql_query($sql);
	echo header("refresh:0,url='quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&sv&&page=".$_REQUEST['page']."'");
}
}
elseif(isset($_REQUEST['gv'])){
?>
    <div class="content-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-list"></i> Danh Sách Giảng Viên</h3>
            <div style="display: flex; gap: 12px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&themgv" class="btn btn-success">
                    <i class="fas fa-plus"></i> Thêm Giảng Viên
                </a>
            </div>
        </div>
        <div class="card-body-custom">
            <!-- Filter Bar -->
            <form action="#" method="post" enctype="multipart/form-data">
            <div class="filter-bar">
                <div class="filter-group">
                    <input type="text" name="htgv" placeholder="Họ Tên GV" class="form-input" value="<?php if(isset($_POST['loc1'])){ $sd=$p->loc1(); $a=mysql_fetch_assoc($sd); echo $a['tensinhvien']; }?>"/>
                </div>
                <div class="filter-group">
                    <input type="text" name="mgv" placeholder="Mã GV" class="form-input" value="<?php if(isset($_POST['loc1'])){ $sd=$p->loc1(); $a=mysql_fetch_assoc($sd); echo $a['masosinhvien']; }?>"/>
                </div>
                <button type="submit" name="loc1" class="btn-filter">
                    <i class="fas fa-search"></i> Lọc
                </button>
            </div>
            </form>

            <!-- Table -->
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ Tên Giảng Viên</th>
                            <th>Mã GV</th>
                            <th>Học Vị</th>
                            <th>Email</th>
                            <th style="text-align: center;">Gửi Mail</th>
                            <th style="text-align: center;">Chi Tiết</th>
                            <th style="text-align: center;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						 include_once("Controller/cTKADHT.php");
						 $p=new cTKAD();
						 if(isset($_POST['loc1'])){
							 $cs=$p->loc1();
						 }
						 else{
						 $cs=$p->laydanhsachgv();
						 }
						 $a=1;
						 $n=$_REQUEST['page'];
						 while($c=mysql_fetch_assoc($cs)){
						 ?>
                        <tr>
                            <td class="stt"><?php if($n==1){ echo $a++; } elseif($n>=2){ echo (($n-1)*5)+$a++; }?></td>
                            <td style="font-weight: 500; color: var(--text-primary);"><?php echo $c['hotengiangvien']; ?></td>
                            <td><span class="badge badge-primary"><?php echo $c['magiangvien']; ?></span></td>
                            <td><?php echo $c['hocvi']; ?></td>
                            <td><?php echo $c['email']; ?></td>
                            <td style="text-align: center;">
                                <?php if($c['ttguigmailctk']==0){ ?>
                                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&mgv=<?php echo md5($c['magiangvien']) ?>&&guigmail1&&page=<?php echo $_REQUEST['page']; ?>" class="action-btn mail">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <?php } else { ?>
                                <span class="action-btn mail sent"><i class="fas fa-check"></i></span>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitietgv&&mgv=<?php echo md5($c['magiangvien']) ?>&&page=<?php echo $_REQUEST['page'];?>" class="action-btn view">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="xoagv.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=<?php echo $_REQUEST['page']?>&xoagvien=<?php echo md5($c['user_id']) ?>&xoa" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <?php
                if(isset($_POST['loc1'])){
                }
                else{
                    $p->Pagegv();
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
elseif(isset($_REQUEST['guigmail1'])){
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$kn=$p->ketnoi($ketnoi);
if($kn){
 $mgv=$_REQUEST['mgv'];
 $sql2="select * from user u join giangvien gv on u.user_id=gv.user_id where u.user_code='$mgv'";
 $qr2=mysql_query($sql2);
 $s=mysql_fetch_assoc($qr2);
 $e=$s['email'];
include "class.phpmailer.php";
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "thuonghoaicute103@gmail.com";
$mail->Password = "apss kjci mxka pjby";
$mail->SetFrom("thuonghoaicute103@gmail.com");
$mail->AddAddress($e);
$mail->Subject = "Trung Tam Quan Tri He Thong LMS";
$mail->Body = "<p style='color:#000;'><strong>Xin Gửi Đến Quý Giảng Viên Tài Khoản Đăng Nhập Hệ Thống !</strong> <br>
<p></p>
- Họ Tên Giảng Viên: ".$s['hotengiangvien']."<br/>
- Tên Tài Khoản: ".$s['magiangvien']." <br/>
- Mật Khẩu: 123456 <br/>
- Mọi Thắc Mắc Xin Gửi Gmail Về Hệ Thống ! Xin Cảm Ơn ! </p>";
 if(!$mail->Send()){
   
}
else{
}
	$sql="update user set ttguigmailctk='1' where user_code='$mgv'";
	$qr=mysql_query($sql);
	echo header("refresh:0,url='quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&gv&&page=".$_REQUEST['page']."'");
}
}
elseif(isset($_REQUEST['suattgv'])){
	include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietGV());
	?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=<?php echo $_REQUEST['page'];?>" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-user-edit"></i> Sửa Thông Tin Giảng Viên</h3>
            </div>
            <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitietgv&&mgv=<?php echo $_REQUEST['mgv'] ?>&&page=<?php echo $_REQUEST['page']; ?>" class="btn btn-secondary">
                <i class="fas fa-eye"></i> Xem Chi Tiết
            </a>
        </div>
        <div class="card-body-custom">
            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Account Info -->
                <div class="profile-section" style="margin-bottom: 24px;">
                    <h4 class="profile-section-title"><i class="fas fa-user-circle"></i> Thông Tin Tài Khoản</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Mã Tài Khoản</label>
                            <span class="form-control-modern readonly">********** (Mã hóa MD5)</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tên Tài Khoản</label>
                            <input type="text" name="a" value="<?php echo $cot['tenuser']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mật Khẩu</label>
                            <span class="form-control-modern readonly">********** (Mã hóa MD5)</span>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Ảnh Hiện Tại</label>
                            <?php
                            $anh=$cot['anh'];
                            if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
                            ?>
                            <img src="<?php echo $anh?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--border-color);"/>
                            <?php } else { ?>
                            <img src="img/<?php echo $anh?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--border-color);"/>
                            <?php } ?>
                        </div>
                        <div class="form-group" style="margin-top: 16px;">
                            <label class="form-label">Thay Đổi Ảnh</label>
                            <input type="file" name="f"/>
                            <input type="hidden" name="f1" value="<?php echo $cot['anh'];?>"/>
                        </div>
                    </div>
                </div>

                <!-- GV Info -->
                <div class="profile-section">
                    <h4 class="profile-section-title"><i class="fas fa-chalkboard-teacher"></i> Thông Tin Giảng Viên</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Họ Tên Giảng Viên</label>
                            <input type="text" name="b" value="<?php echo $cot['hotengiangvien']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mã Giảng Viên</label>
                            <input type="text" value="<?php echo $cot['magiangvien'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Giới Tính</label>
                            <?php
                            if($cot['gioitinh']=='Nam'){ $nam="checked"; }
                            elseif($cot['gioitinh']=='Nữ'){ $nu="checked"; }
                            ?>
                            <div class="form-radio-group">
                                <label class="form-radio-item">
                                    <input type="radio" name="c" value="Nam" <?php echo $nam ?>/> Nam
                                </label>
                                <label class="form-radio-item">
                                    <input type="radio" name="c" value="Nữ" <?php echo $nu ?>/> Nữ
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số Điện Thoại</label>
                            <input type="text" name="d" value="<?php echo $cot['sdt'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" name="e" value="<?php echo $cot['email']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số CCCD</label>
                            <input type="text" name="g" value="<?php echo $cot['cccd']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Địa Chỉ</label>
                            <input type="text" name="h" value="<?php echo $cot['diachi'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Học Vị</label>
                            <select name="i" class="form-control-modern">
                                <option><?php echo $cot['hocvi']; ?></option>
                                <option>Thạc Sĩ</option>
                                <option>Tiến Sĩ</option>
                                <option>Phó Giáo Sư</option>
                                <option>Giáo Sư</option>
                            </select>
                        </div>
                        <div class="form-group" style="grid-column: span 3;">
                            <label class="form-label">Quá Trình Công Tác</label>
                            <textarea name="k" class="form-control-modern"><?php echo $cot['quatrinhcongtac'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cơ Sở Giảng Dạy</label>
                            <input type="text" name="l" value="<?php echo $cot['cosogiangday'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Khoa Giảng Dạy</label>
                            <span class="form-control-modern readonly"><?php echo $cot['tenkhoa'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Chuyên Môn Ngành</label>
                            <span class="form-control-modern readonly"><?php echo $cot['tenchuyennganh'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Chứng Chỉ</label>
                            <input type="text" name="m" value="<?php echo $cot['chungchi'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Chứng Chỉ Khác</label>
                            <textarea name="p" class="form-control-modern"><?php echo $cot['chungchikhac'];?></textarea>
                        </div>
                        <div class="form-group" style="grid-column: span 3;">
                            <label class="form-label">Công Trình Khoa Học Tiêu Biểu</label>
                            <textarea name="q" class="form-control-modern"><?php echo $cot['congtrinhkhoahoctieubieu'];?></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="ltd" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu Thay Đổi
                    </button>
                    <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=<?php echo $_REQUEST['page'];?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php
}
elseif(isset($_REQUEST['xemchitietgv'])){
	include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietGV());
	?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=<?php echo $_REQUEST['page'];?>" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-user"></i> Chi Tiết Giảng Viên</h3>
            </div>
            <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&suattgv&&mgv=<?php echo $_REQUEST['mgv'] ?>&&page=<?php echo $_REQUEST['page']; ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Sửa Thông Tin
            </a>
        </div>
        <div class="card-body-custom">
            <div class="profile-container">
                <div class="profile-sidebar">
                    <?php
                    $anh=$cot['anh'];
                    if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
                    ?>
                    <img src="<?php echo $anh?>" class="profile-avatar"/>
                    <?php } else { ?>
                    <img src="img/<?php echo $anh?>" class="profile-avatar"/>
                    <?php } ?>
                    <h3 class="profile-name"><?php echo $cot['hotengiangvien']; ?></h3>
                    <p class="profile-role"><?php echo $cot['hocvi']; ?></p>
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="profile-stat-value"><?php echo $cot['magiangvien'] ?></div>
                            <div class="profile-stat-label">Mã GV</div>
                        </div>
                        <div class="profile-stat">
                            <div class="profile-stat-value"><?php echo $cot['gioitinh'] ?></div>
                            <div class="profile-stat-label">Giới Tính</div>
                        </div>
                    </div>
                </div>
                <div class="profile-content">
                    <div class="profile-section">
                        <h4 class="profile-section-title"><i class="fas fa-id-card"></i> Thông Tin Liên Hệ</h4>
                        <div class="profile-grid">
                            <div class="profile-item">
                                <label>Số Điện Thoại</label>
                                <span><?php echo $cot['sdt'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Email</label>
                                <span><?php echo $cot['email']; ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Số CCCD</label>
                                <span><?php echo $cot['cccd']; ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Địa Chỉ</label>
                                <span><?php echo $cot['diachi'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="profile-section">
                        <h4 class="profile-section-title"><i class="fas fa-briefcase"></i> Thông Tin Công Tác</h4>
                        <div class="profile-grid">
                            <div class="profile-item">
                                <label>Cơ Sở Giảng Dạy</label>
                                <span><?php echo $cot['cosogiangday'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Khoa</label>
                                <span><?php echo $cot['tenkhoa'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Chuyên Ngành</label>
                                <span><?php echo $cot['tenchuyennganh'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Học Vị</label>
                                <span><?php echo $cot['hocvi'] ?></span>
                            </div>
                            <div class="profile-item" style="grid-column: span 2;">
                                <label>Quá Trình Công Tác</label>
                                <span><?php echo $cot['quatrinhcongtac'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="profile-section">
                        <h4 class="profile-section-title"><i class="fas fa-certificate"></i> Chứng Chỉ & Thành Tựu</h4>
                        <div class="profile-grid">
                            <div class="profile-item">
                                <label>Chứng Chỉ</label>
                                <span><?php echo $cot['chungchi'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Chứng Chỉ Khác</label>
                                <span><?php echo $cot['chungchikhac'] ?></span>
                            </div>
                            <div class="profile-item" style="grid-column: span 2;">
                                <label>Công Trình Khoa Học Tiêu Biểu</label>
                                <span><?php echo $cot['congtrinhkhoahoctieubieu'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
elseif(isset($_REQUEST['xemchitiet'])){
	include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietSV());
    // var_dump($cot);
    // exit;
	?>  
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=<?php echo $_REQUEST['page'];?>" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-user"></i> Chi Tiết Sinh Viên</h3>
            </div>
            <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&suatt&&mssv=<?php echo $_REQUEST['mssv'] ?>&&page=<?php echo $_REQUEST['page']; ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Sửa Thông Tin
            </a>
        </div>
        <div class="card-body-custom">
            <div class="profile-container">
                <div class="profile-sidebar">
                    <?php
                    $anh=$cot['anh'];
                    if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
                    ?>
                    <img src="<?php echo $anh?>" class="profile-avatar"/>
                    <?php } else { ?>
                    <img src="img/<?php echo $anh?>" class="profile-avatar"/>
                    <?php } ?>
                    <h3 class="profile-name"><?php echo $cot['tensinhvien']; ?></h3>
                    <p class="profile-role"><?php echo $cot['masosinhvien'] ?></p>
                    <div class="profile-stats">
                        <div class="profile-stat">
                            <div class="profile-stat-value"><?php echo $cot['lopCN'] ?></div>
                            <div class="profile-stat-label">Lớp</div>
                        </div>
                        <div class="profile-stat">
                            <div class="profile-stat-value"><?php echo $cot['gioitinh'] ?></div>
                            <div class="profile-stat-label">Giới Tính</div>
                        </div>
                    </div>
                </div>
                <div class="profile-content">
                    <div class="profile-section">
                        <h4 class="profile-section-title"><i class="fas fa-id-card"></i> Thông Tin Cá Nhân</h4>
                        <div class="profile-grid">
                            <div class="profile-item">
                                <label>Mã Số Sinh Viên</label>
                                <span><?php echo $cot['masosinhvien'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Giới Tính</label>
                                <span><?php echo $cot['gioitinh'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Ngày Sinh</label>
                                <span><?php 
                                $currentDate = $cot['ngaysinh'];
                                $convertedDate = date("d-m-Y", strtotime($currentDate));
                                echo $convertedDate;?></span>
                            </div>
                            <div class="profile-item">
                                <label>Số Điện Thoại</label>
                                <span><?php echo $cot['sdt'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Email</label>
                                <span><?php echo $cot['email']; ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Số CCCD</label>
                                <span><?php echo $cot['cccd']; ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Ngày Cấp</label>
                                <span><?php 
                                $currentDate = $cot['ngaycap'];
                                $convertedDate = date("d-m-Y", strtotime($currentDate));
                                echo $convertedDate;?></span>
                            </div>
                            <div class="profile-item">
                                <label>Nơi Cấp</label>
                                <span><?php echo $cot['noicap'] ?></span>
                            </div>
                            <div class="profile-item" style="grid-column: span 2;">
                                <label>Địa Chỉ Liên Hệ</label>
                                <span><?php echo $cot['diachilienhe'] ?></span>
                            </div>
                            <div class="profile-item" style="grid-column: span 2;">
                                <label>Hộ Khẩu Thường Trú</label>
                                <span><?php echo $cot['hokhauthuongtru'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="profile-section">
                        <h4 class="profile-section-title"><i class="fas fa-graduation-cap"></i> Thông Tin Học Tập</h4>
                        <div class="profile-grid">
                            <div class="profile-item">
                                <label>Khóa Học</label>
                                <span><?php echo $cot['khoa'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Lớp</label>
                                <span><?php echo $cot['lopCN'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Khoa</label>
                                <span><?php echo $cot['tenkhoa'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Chuyên Ngành</label>
                                <span><?php echo $cot['tenchuyennganh'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Cơ Sở Đào Tạo</label>
                                <span><?php echo $cot['cosodaotao'] ?></span>
                            </div>
                            <div class="profile-item">
                                <label>Trạng Thái</label>
                                <span>
                                    <?php if($cot['trangthai']==0){ echo "Ngưng Học"; }
                                    elseif($cot['trangthai']==1){ echo "Đang Học"; }
                                    elseif($cot['trangthai']==2){ echo "Đã Tốt Nghiệp"; }?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
elseif(isset($_REQUEST['suatt'])){
    include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietSV());
	?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=<?php echo $_REQUEST['page'];?>" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-user-edit"></i> Sửa Thông Tin Sinh Viên</h3>
            </div>
            <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitiet&&mssv=<?php echo $_REQUEST['mssv'] ?>&&page=<?php echo $_REQUEST['page']; ?>" class="btn btn-secondary">
                <i class="fas fa-eye"></i> Xem Chi Tiết
            </a>
        </div>
        <div class="card-body-custom">
            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Account Info -->
                <div class="profile-section" style="margin-bottom: 24px;">
                    <h4 class="profile-section-title"><i class="fas fa-user-circle"></i> Thông Tin Tài Khoản</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Mã Tài Khoản</label>
                            <span class="form-control-modern readonly">********** (Mã hóa MD5)</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tên Tài Khoản</label>
                            <input type="text" name="a" value="<?php echo $cot['tenuser']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mật Khẩu</label>
                            <span class="form-control-modern readonly">********** (Mã hóa MD5)</span>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Ảnh Hiện Tại</label>
                            <?php
                            $anh=$cot['anh'];
                            if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
                            ?>
                            <img src="<?php echo $anh?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--border-color);"/>
                            <?php } else { ?>
                            <img src="img/<?php echo $anh?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--border-color);"/>
                            <?php } ?>
                        </div>
                        <div class="form-group" style="margin-top: 16px;">
                            <label class="form-label">Thay Đổi Ảnh</label>
                            <input type="file" name="f"/>
                            <input type="hidden" name="f1" value="<?php echo $cot['anh']?>"/>
                        </div>
                    </div>
                </div>

                <!-- SV Info -->
                <div class="profile-section">
                    <h4 class="profile-section-title"><i class="fas fa-user-graduate"></i> Thông Tin Sinh Viên</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tên Sinh Viên</label>
                            <input type="text" name="b" value="<?php echo $cot['tensinhvien']; ?>" class="form-control-modern" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mã Số Sinh Viên</label>
                            <input type="text" name="c" value="<?php echo $cot['masosinhvien'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Giới Tính</label>
                            <?php
                            if($cot['gioitinh']=='Nam'){ $nam="checked"; }
                            elseif($cot['gioitinh']=='Nữ'){ $nu="checked"; }
                            ?>
                            <div class="form-radio-group">
                                <label class="form-radio-item">
                                    <input type="radio" name="d" value="Nam" <?php echo $nam ?>/> Nam
                                </label>
                                <label class="form-radio-item">
                                    <input type="radio" name="d" value="Nữ" <?php echo $nu ?>/> Nữ
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ngày Sinh</label>
                            <input type="date" name="e" value="<?php 
                            $currentDate = $cot['ngaysinh'];
                            $convertedDate = date("Y-m-d", strtotime($currentDate));
                            echo $convertedDate;?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số Điện Thoại</label>
                            <input type="text" name="g" value="<?php echo $cot['sdt'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" name="h" value="<?php echo $cot['email']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số CCCD</label>
                            <input type="text" name="i" value="<?php echo $cot['cccd']; ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ngày Cấp</label>
                            <input type="date" name="k" value="<?php 
                            $currentDate = $cot['ngaycap'];
                            $convertedDate = date("Y-m-d", strtotime($currentDate));
                            echo $convertedDate;?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nơi Cấp</label>
                            <input type="text" name="l" value="<?php echo $cot['noicap'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Địa Chỉ Liên Hệ</label>
                            <input type="text" name="m" value="<?php echo $cot['diachilienhe'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Hộ Khẩu Thường Trú</label>
                            <input type="text" name="n" value="<?php echo $cot['hokhauthuongtru'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Khóa Học</label>
                            <span class="form-control-modern readonly"><?php echo $cot['khoa'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lớp</label>
                            <input type="text" name="p" value="<?php echo $cot['lopCN'] ?>" class="form-control-modern"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Khoa</label>
                            <select name="q" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="#"><?php 
                                if(isset($_REQUEST['khoa'])){
                                    $khoa=$_REQUEST['khoa'];
                                    if($khoa==1){ echo "Công Nghệ Thông Tin"; }
                                    elseif($khoa==2){ echo "Quản Trị Kinh Doanh"; }
                                    elseif($khoa==3){ echo "Luật"; }
                                } else { echo $cot['tenkhoa']; }
                                ?></option>
                                <option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=<?php echo $cot['id_khoa']?>"><?php echo $cot['tenkhoa'] ?></option>
                                <?php if($cot['tenkhoa']!='Công Nghệ Thông Tin'){ ?><option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=1">Công Nghệ Thông Tin</option><?php } ?>
                                <?php if($cot['tenkhoa']!='Quản Trị Kinh Doanh'){ ?><option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=2">Quản Trị Kinh Doanh</option><?php } ?>
                                <?php if($cot['tenkhoa']!='Luật'){ ?><option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=3">Luật</option><?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Chuyên Ngành</label>
                            <select name="r" class="form-control-modern">
                                <option value="<?php echo $cot['id_chuyennganh'] ?>"><?php echo $cot['tenchuyennganh'];?></option>
                                <?php 
                                if(isset($_REQUEST['khoa'])){
                                    $p=new cTKAD();
                                    $a=$p->chuyenganh();
                                    while($c=mysql_fetch_assoc($a)){
                                ?>
                                <option value="<?php echo $c['id_chuyennganh']; ?>"><?php echo $c['tenchuyennganh']; ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cơ Sở Học</label>
                            <span class="form-control-modern readonly"><?php echo $cot['cosodaotao'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Trạng Thái</label>
                            <select name="s" class="form-control-modern">
                                <?php if($cot['trangthai']==0){ echo '<option value="0">Ngưng Học</option>'; }
                                elseif($cot['trangthai']==1){ echo '<option value="1">Đang Học</option>'; }
                                elseif($cot['trangthai']==2){ echo '<option value="2">Đã Tốt Nghiệp</option>'; }?>
                                <?php if($cot['trangthai']!=0){ ?><option value="0">Ngưng Học</option><?php } ?>
                                <?php if($cot['trangthai']!=1){ ?><option value="1">Đang Học</option><?php } ?>
                                <?php if($cot['trangthai']!=2){ ?><option value="2">Đã Tốt Nghiệp</option><?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="luutt" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu Thay Đổi
                    </button>
                    <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=<?php echo $_REQUEST['page'];?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php
}
elseif(isset($_REQUEST['themgv'])){
?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=1" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-user-plus"></i> Cấp Tài Khoản Giảng Viên</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <div class="file-upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Tải File Excel để cấp tài khoản giảng viên</p>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="file" name="f" required class="form-control-modern" accept=".xlsx,.xls" style="max-width: 300px; margin: 0 auto;"/>
                    <div class="form-actions-center">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Tải Lên
                        </button>
                    </div>
                </form>
                <p style="margin-top: 20px; color: var(--text-secondary);">Đây là mẫu dữ liệu file nhập để cấp tài khoản. Để lấy file mẫu vui lòng bấm tải xuống!</p>
                <a href="taixuong.php?fu=File_Cap_Tai_Khoan.xlsx" class="download-template">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" style="width: 24px; height: 24px;"/>
                    <span>Tải Mẫu File Excel</span>
                </a>
            </div>
        </div>
    </div>
<?php
if(isset($_REQUEST['themgv'])){
if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    if ($file_size > 20*1024*1024) {
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain','htm' => 'text/html','html' => 'text/html','php' => 'text/html','css' => 'text/css','js' => 'application/javascript','json' => 'application/json','xml' => 'application/xml','swf' => 'application/x-shockwave-flash','flv' => 'video/x-flv',
                'png' => 'image/png','jpe' => 'image/jpeg','jpeg' => 'image/jpeg','jpg' => 'image/jpeg','gif' => 'image/gif','bmp' => 'image/bmp','ico' => 'image/vnd.microsoft.icon','tiff' => 'image/tiff','tif' => 'image/tiff','svg' => 'image/svg+xml','svgz' => 'image/svg+xml',
                'zip' => 'application/zip','rar' => 'application/x-rar-compressed','exe' => 'application/x-msdownload','msi' => 'application/x-msdownload','cab' => 'application/vnd.ms-cab-compressed',
                'mp3' => 'audio/mpeg','qt' => 'video/quicktime','mov' => 'video/quicktime',
                'pdf' => 'application/pdf','psd' => 'image/vnd.adobe.photoshop','ai' => 'application/postscript','eps' => 'application/postscript','ps' => 'application/postscript',
                'doc' => 'application/msword','rtf' => 'application/rtf','xls' => 'application/vnd.ms-excel','xls1' => 'application/excel','xls2' => 'application/x-excel','xls3' => 'application/x-msexcel','ppt' => 'application/vnd.ms-powerpoint','docx' => 'application/msword','xlsx' => 'application/vnd.ms-excel','pptx' => 'application/vnd.ms-powerpoint',
                'odt' => 'application/vnd.oasis.opendocument.text','ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
		if (move_uploaded_file($_FILES['f']['tmp_name'], $target_file)) {
              try {
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
$file = 'file/'.$f;
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);
$objData->setReadDataOnly(true);
$objPHPExcel = $objData->load($file);
$sheet = $objPHPExcel->setActiveSheetIndex(1);
$Totalrow = $sheet->getHighestRow();
$LastColumn = $sheet->getHighestColumn();
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi($ketnoi);
if($kn){
$sheet = $objPHPExcel->setActiveSheetIndex(1);
$tdmtk= $sheet->getCellByColumnAndRow(1,1)->getValue();
$tdmgv= $sheet->getCellByColumnAndRow(7,1)->getValue();
if($tdmtk !="Mã Tài Khoản" || $tdmgv !="Mã Giảng Viên"){
	echo "<script>alert('Chọn không đúng file excel để cấp tài khoản !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    $ttk= $sheet->getCellByColumnAndRow(0,$row)->getValue();
	$ma= $sheet->getCellByColumnAndRow(1,$row)->getValue();
	$ma1=md5($ma);
	$mk= $sheet->getCellByColumnAndRow(2,$row)->getValue();
	$mk1=md5($mk);
	$email= $sheet->getCellByColumnAndRow(3,$row)->getValue();
	$anh= $sheet->getCellByColumnAndRow(4,$row)->getValue();
	$cccd= $sheet->getCellByColumnAndRow(5,$row)->getValue();
	$tengv= $sheet->getCellByColumnAndRow(6,$row)->getValue();
	$mgv= $sheet->getCellByColumnAndRow(7,$row)->getValue();
	$gioitinh= $sheet->getCellByColumnAndRow(8,$row)->getValue();
	$sdt= $sheet->getCellByColumnAndRow(9,$row)->getValue();
	$diachi= $sheet->getCellByColumnAndRow(10,$row)->getValue();
	$hocvi= $sheet->getCellByColumnAndRow(11,$row)->getValue();
	$qtct= $sheet->getCellByColumnAndRow(12,$row)->getValue();
	$csgd= $sheet->getCellByColumnAndRow(13,$row)->getValue();
	$chungchi= $sheet->getCellByColumnAndRow(14,$row)->getValue();
	$chungchikhac= $sheet->getCellByColumnAndRow(15,$row)->getValue();
	$congtrinh= $sheet->getCellByColumnAndRow(16,$row)->getValue();
	$id_cn1= $sheet->getCellByColumnAndRow(17,$row)->getValue();
	$sql="select * from chuyennganh where machuyennganh='$id_cn1'";
	$qr=mysql_query($sql);
	$d=mysql_fetch_assoc($qr);
	$id_cn=$d['id_chuyennganh'];
	$sql="select * from user where user_code='$ma1'";
	$qr=mysql_query($sql);
	$sql1="select * from giangvien where magiangvien='$ma'";
	$qr1=mysql_query($sql1);
	if(mysql_num_rows($qr)==1){
		echo "<center>Mã giảng viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
	}
	elseif(mysql_num_rows($qr1)==1){
		echo "<center>Mã giảng viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
	}
	elseif($mgv==null||$ma1==null){
	}
	else {
	 $sql="insert into user(user_code,tenuser,matkhau,vaitro,email,cccd,anh) values ('$ma1','$ttk','$mk1',1,'$email','$cccd','$anh')";
	 $qr=mysql_query($sql);
	 $sq2="insert into giangvien(user_id) select user_id from user where user_code='$ma1'";
     $qr2=mysql_query($sq2);
	 $sq3="update giangvien set hotengiangvien='$tengv', magiangvien='$mgv', gioitinh='$gioitinh',sdt='$sdt', diachi='$diachi', hocvi= '$hocvi', quatrinhcongtac='$qtct', cosogiangday='$csgd', chungchi='$chungchi',chungchikhac='$chungchikhac', congtrinhkhoahoctieubieu='$congtrinh', id_chuyennganh='$id_cn' where user_id=(select user_id from user where user_code='$ma1' )";
     $qr3=mysql_query($sq3);
	 echo header("refresh:0,url='quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&gv&&page=1'");
	}
}
}
}
} catch(Exception $e) {}
        } else {}
	}
	}
}
}
}
elseif(isset($_REQUEST['them'])){
?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-user-plus"></i> Cấp Tài Khoản Sinh Viên</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <div class="file-upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Tải File Excel để cấp tài khoản sinh viên</p>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="file" name="f" required class="form-control-modern" accept=".xlsx,.xls" style="max-width: 300px; margin: 0 auto;"/>
                    <div class="form-actions-center">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Tải Lên
                        </button>
                    </div>
                </form>
                <p style="margin-top: 20px; color: var(--text-secondary);">Đây là mẫu dữ liệu file nhập để cấp tài khoản. Để lấy file mẫu vui lòng bấm tải xuống!</p>
                <a href="taixuong.php?fu=File_Cap_Tai_Khoan.xlsx" class="download-template">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" style="width: 24px; height: 24px;"/>
                    <span>Tải Mẫu File Excel</span>
                </a>
            </div>
        </div>
    </div>
<?php
if(isset($_REQUEST['them'])){
if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    if ($file_size > 20*1024*1024) {
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain','htm' => 'text/html','html' => 'text/html','php' => 'text/html','css' => 'text/css','js' => 'application/javascript','json' => 'application/json','xml' => 'application/xml','swf' => 'application/x-shockwave-flash','flv' => 'video/x-flv',
                'png' => 'image/png','jpe' => 'image/jpeg','jpeg' => 'image/jpeg','jpg' => 'image/jpeg','gif' => 'image/gif','bmp' => 'image/bmp','ico' => 'image/vnd.microsoft.icon','tiff' => 'image/tiff','tif' => 'image/tiff','svg' => 'image/svg+xml','svgz' => 'image/svg+xml',
                'zip' => 'application/zip','rar' => 'application/x-rar-compressed','exe' => 'application/x-msdownload','msi' => 'application/x-msdownload','cab' => 'application/vnd.ms-cab-compressed',
                'mp3' => 'audio/mpeg','qt' => 'video/quicktime','mov' => 'video/quicktime',
                'pdf' => 'application/pdf','psd' => 'image/vnd.adobe.photoshop','ai' => 'application/postscript','eps' => 'application/postscript','ps' => 'application/postscript',
                'doc' => 'application/msword','rtf' => 'application/rtf','xls' => 'application/vnd.ms-excel','xls1' => 'application/excel','xls2' => 'application/x-excel','xls3' => 'application/x-msexcel','ppt' => 'application/vnd.ms-powerpoint','docx' => 'application/msword','xlsx' => 'application/vnd.ms-excel','pptx' => 'application/vnd.ms-powerpoint',
                'odt' => 'application/vnd.oasis.opendocument.text','ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
		if (move_uploaded_file($_FILES['f']['tmp_name'], $target_file)) {
              try {
ini_set('display_errors','off');
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
$file = 'file/'.$f;
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);
$objData->setReadDataOnly(true);
$objPHPExcel = $objData->load($file);
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$Totalrow = $sheet->getHighestRow();
$LastColumn = $sheet->getHighestColumn();
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi();
if($kn){
include "class.phpmailer.php";
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "phucable@gmail.com";
$mail->Password = "afbv blky ofzi vzsy";
$mail->SetFrom("quantrihethong@gmail.com");
$tdmtk= $sheet->getCellByColumnAndRow(1,1)->getValue();
$tdmssv= $sheet->getCellByColumnAndRow(7,1)->getValue();
if($tdmtk!="Mã Tài Khoản" || $tdmssv!="Mã Số Sinh Viên"){
	echo "<script>alert('Chọn không đúng file excel để cấp tài khoản !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    $ttk= $sheet->getCellByColumnAndRow(0,$row)->getValue();
	$ma= $sheet->getCellByColumnAndRow(1,$row)->getValue();
	$ma1=md5($ma);
	$mk= $sheet->getCellByColumnAndRow(2,$row)->getValue();
	$mk1=md5($mk);
	$email= $sheet->getCellByColumnAndRow(3,$row)->getValue();
	$sdt= $sheet->getCellByColumnAndRow(4,$row)->getValue();
	$anh= $sheet->getCellByColumnAndRow(5,$row)->getValue();
	$tensv= $sheet->getCellByColumnAndRow(6,$row)->getValue();
	$mssv= $sheet->getCellByColumnAndRow(7,$row)->getValue();
	$gioitinh= $sheet->getCellByColumnAndRow(8,$row)->getValue();
	$ngaysinh1=  PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow(9,$row)->getValue());
    $ngaysinh= date('Y-m-d', $ngaysinh1);
	$socccd= $sheet->getCellByColumnAndRow(10,$row)->getValue();
	$ngaycap1=  PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow(11,$row)->getValue());
    $ngaycap= date('Y-m-d', $ngaycap1);
	$noicap= $sheet->getCellByColumnAndRow(12,$row)->getValue();
	$diachi= $sheet->getCellByColumnAndRow(13,$row)->getValue();
	$hokhau= $sheet->getCellByColumnAndRow(14,$row)->getValue();
	$ngayvt1= PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow(15,$row)->getValue());
    $ngayvt= date('Y-m-d', $ngayvt1);
	$khoa= $sheet->getCellByColumnAndRow(16,$row)->getValue();
	$lop= $sheet->getCellByColumnAndRow(17,$row)->getValue();
	$csdt= $sheet->getCellByColumnAndRow(18,$row)->getValue();
	$trangthai= $sheet->getCellByColumnAndRow(19,$row)->getValue();
	$id_cn1= $sheet->getCellByColumnAndRow(20,$row)->getValue();
	$sql="select * from chuyennganh where machuyennganh='$id_cn1'";
	$qr=mysql_query($sql);
	$d=mysql_fetch_assoc($qr);
	$id_cn=$d['id_chuyennganh'];
	$sql="select * from user where user_code='$ma1'";
	$qr=mysql_query($sql);
	$sql1="select * from sinhvien where masosinhvien='$ma'";
	$qr1=mysql_query($sql1);
	if(mysql_num_rows($qr)==1){
		echo "<center>Mã số sinh viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
	}
	elseif(mysql_num_rows($qr1)==1){
		echo "<center>Mã số sinh viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
	}
	elseif($mssv==null||$ma1==null){
	}
	else {
     $sql="insert into user(user_code,tenuser,matkhau,vaitro,email,cccd,anh) values ('$ma1','$ttk','$mk1',0,'$email','$socccd','$anh')";
	 $qr=mysql_query($sql);
	 $sq2="insert into sinhvien(user_id) select user_id from user where user_code='$ma1'";
     $qr2=mysql_query($sq2);
	 $sq3="update sinhvien set tensinhvien='$tensv', masosinhvien='$mssv', gioitinh='$gioitinh', ngaysinh='$ngaysinh',sdt='$sdt', ngaycap='$ngaycap', noicap='$noicap', diachilienhe='$diachi', hokhauthuongtru= '$hokhau', ngayvaotruong='$ngayvt', khoa='$khoa', lopCN='$lop', cosodaotao='$csdt', trangthai='$trangthai', id_chuyennganh='$id_cn' where user_id=(select user_id from user where user_code='$ma1' )";
     $qr3=mysql_query($sq3);
	}
}
}
}
} catch(Exception $e) {}
        } else {}
	}
	}
}
}
}
elseif(isset($_REQUEST['taiexcel'])){
?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-file-export"></i> Tải Danh Sách Sinh Viên Theo Chuyên Ngành</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <div style="max-width: 500px; margin: 0 auto; text-align: center;">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group" style="margin-bottom: 24px;">
                        <label class="form-label">Chọn Chuyên Ngành</label>
                        <select name="a" class="form-control-modern" onchange="window.location.href=this.value;" style="width: 100%;">
                            <option value="<?php echo $_REQUEST['ic'] ?>"><?php
                            if($_REQUEST['ic']){ echo $_REQUEST['tic']; } else { echo "Chọn chuyên ngành"; }
                            ?></option>
                            <?php
                            include_once("Model/mKetNoiADHT.php");
                            $p=new ketnoiAD();
                            $p->ketnoi($ketnoi);
                            $sql="select * from chuyennganh";
                            $qr= mysql_query($sql);
                            while($h=mysql_fetch_assoc($qr)){
                            ?>
                            <option value="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm'] ?>&&taiexcel&&ic=<?php echo $h['id_chuyennganh'] ?>&&tic=<?php echo $h['tenchuyennganh'] ?>"><?php echo $h['tenchuyennganh'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="tex" class="btn btn-primary">
                        <i class="fas fa-download"></i> Tải Xuống
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php
}
else{
?>
    <div class="content-card">
        <div class="card-body-custom">
            <div class="info-box">
                <h3 style="font-size: 1.1rem; margin-bottom: 12px; color: var(--primary);">
                    <i class="fas fa-info-circle"></i> Giới thiệu chức năng "Quản Lý Tài Khoản Người Dùng"
                </h3>
                <p>Đây là các chức năng nền tảng và cơ bản cần có để thống nhất hệ thống một cách chuyên nghiệp.</p>
                <p style="margin-top: 12px;">Vì lý do trên, hệ thống được tích hợp các chức năng có thể quản lý dễ dàng hơn.</p>
                <p style="margin-top: 12px;">Các chức năng gồm có: Quản lý Sinh Viên, Quản lý Giảng Viên - đều được tạo ra và hỗ trợ thêm bằng Excel giúp xử lý công việc nhanh hơn.</p>
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
                    <li><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1"><i class="fas fa-chevron-right"></i> Quản Lý Sinh Viên</a></li>
                    <li><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=1"><i class="fas fa-chevron-right"></i> Quản Lý Giảng Viên</a></li>
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
