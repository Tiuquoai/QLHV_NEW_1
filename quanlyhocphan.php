<?php
session_start();
ob_start();
	include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
      if(isset($_POST['s1'])){
		   $p->cnhp1();
		   $p->cnhp2();
	       echo header("refresh:0,url='quanlyhocphan.php?bm=".$_REQUEST['bm']."&&xem=".$_REQUEST['xem']."'");
	   }
			?>
            <?php /* Xóa Phân Công Giảng Viên Giảng Dạy */ ?>
            <?php
			include_once("Model/mKetNoiADHT.php");
			$p=new ketnoiAD();
			$kn=$p->ketnoi($ketnoi);
			if($kn){
				if(isset($_REQUEST['xoapc'])){
					$xoapc=$_REQUEST['xoapc'];
				  	$sql="delete from giangday where md5(id_giangday)='$xoapc' ";
					$qr=mysql_query($sql);
					echo header('refresh:0,url="quanlyhocphan.php?bm='.$_REQUEST['bm'].'&&gv-hp"');
				}
			}
			?>
            <?php
			if(isset($_REQUEST['xoat'])){
				$id=$_REQUEST['xoat'];
				$is=$_REQUEST['is'];
				$ihp=$_REQUEST['ihp'];
				$sql="delete from hoctap where id_hoctap='$id'";
				$xoa=mysql_query($sql);
				$sql1="delete from dkhp where id_sinhvien='$is' and id_hocphan='$ihp'";
				$xoa1=mysql_query($sql1);
				echo header('refresh:0,url="quanlyhocphan.php?bm='.$_REQUEST['bm'].'&&sv-hp"');
			}
			?>
             <?php /* Phân Công Giảng Viên Giảng Dạy */ ?>
    <?php
	 include_once("Model/mKetNoiADHT.php");
	 $p=new ketnoiAD();
	 $kn=$p->ketnoi($ketnoi);
	 if($kn){
			if(isset($_POST['pc'])){
				$idgv=$_POST['a'];
				$idhp=$_POST['b'];
				$idlhp=$_POST['c'];
				$gvth=$_POST['d'];
				$gvth2=$_POST['e'];
				$gvth3=$_POST['f'];
				$loaihp=$_POST['k'];
				if($loaihp=='LT & TH'&&$gvth==null&&$gvth2==null){
					echo "<script>alert('Không chọn giảng viên thực hành r !')</script>";
				}
				else{
			$sqr="select * from giangday where id_giangvien='$idgv' and id=(select id from monlop where id_hocphan='$idhp' and 
			id_lophocphan='$idlhp')";
			$ql=mysql_query($sqr);
			
			$kt="select * from giangday where id=(select id from monlop where id_hocphan='$idhp' and 
			id_lophocphan='$idlhp')";
			$ql1=mysql_query($kt);
			if(mysql_num_rows($ql)==1){
				echo "<script>alert('Phân công giảng viên trùng lớp và môn học phần !')</script>";
			}
			elseif(mysql_num_rows($ql1)==1){
				echo "<script>alert('Phân công giảng viên trùng lớp và môn học phần !')</script>";
			}
			else{
				$sql="insert into giangday(id) select id from monlop where id_hocphan='$idhp' and id_lophocphan='$idlhp' ";
				$qr=mysql_query($sql);
			
			
			$sql1="update giangday set id_giangvien='$idgv', id_giangvienTH1='$gvth', 
			id_giangvienTH2='$gvth2'
		    where id=(select id from monlop where id_hocphan='$idhp' and id_lophocphan='$idlhp') ";
				$qr1=mysql_query($sql1);
				echo header('refresh:0,url="quanlyhocphan.php?bm='.$_REQUEST['bm'].'&&gv-hp"');
			
				}
			}
	 }
	 }
			?>
            <?php
			if(isset($_POST['uk'])){
				$is=$_POST['a'];
				$ihp=$_POST['b'];
				$il=$_POST['c'];
				$igvlt=$_POST['e'];
				$igvth=$_POST['d'];
				$kt="select * from hoctap where id_sinhvien='$is' and id_giangvienTH='$igvth'
				and id=(select id from monlop where id_hocphan='$ihp' and id_lophocphan='$il')";
				$k=mysql_query($kt);
				$kt3="select * from dkhp where id_sinhvien='$is' and id_hocphan='$ihp'";
				$k3=mysql_query($kt3);
				if(mysql_num_rows($k)==1){
					echo "<script>alert('Sinh Viên Này Đã Được Áp Cứng Môn Này Rồi Nha !')</script>";
				}
				elseif(mysql_num_rows($k3)==1){
					echo "<script>alert('Sinh Viên Này Đã Được Áp Cứng Môn Này Rồi Nha !')</script>";
				}
				else{
				$sql="insert into hoctap(id) select id from monlop where id_hocphan='$ihp' and id_lophocphan='$il'";
				$qr=mysql_query($sql);
				$sql1="update hoctap set id_sinhvien='$is', id_giangvienTH='$igvth' where id=(select id from monlop where 
				id_hocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='')";
				$qr1=mysql_query($sql1);
				$sql3="insert into dkhp(id_sinhvien,id_hocphan,ngaydk) values ('$is','$ihp', now())";
				$qr3=mysql_query($sql3);
				/* echo header('refresh:0,url="quanlyhocphan.php?bm='.$_REQUEST['bm'].'&&sv-hp"'); */
				}
			}
			if(isset($_POST['se'])){
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
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$Totalrow = $sheet->getHighestRow();
$LastColumn = $sheet->getHighestColumn();
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi($ketnoi);
if($kn){
$tdmssv= $sheet->getCellByColumnAndRow(1,1)->getValue();
$tdhvt= $sheet->getCellByColumnAndRow(2,1)->getValue();
if($tdmssv!='MSSV' || $tdhvt!="Họ Và Tên"){
	echo "<script>alert('File Excel tải lên phân công sinh viên vào học phần không chính xác !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
	$mas= $sheet->getCellByColumnAndRow(1,$row)->getValue();
	$sql="select * from sinhvien where masosinhvien='$mas'";
	$qr=mysql_query($sql);
	$d=mysql_fetch_assoc($qr);
	$is=$d['id_sinhvien'];
	$ig=$_POST['ig'];
	$ith=$_POST['c'];
	$ihp=$_POST['a'];
	$il=$_POST['b'];
	$kt="select * from hoctap where id_sinhvien='$is' and id_giangvienTH='$ith'
				and id=(select id from monlop where id_hocphan='$ihp' and id_lophocphan='$il')";
				$k=mysql_query($kt);
				$kt3="select * from dkhp where id_sinhvien='$is' and id_hocphan='$ihp'";
				$k3=mysql_query($kt3);
				if(mysql_num_rows($k)==1){
				}
				elseif(mysql_num_rows($k3)==1){
				}
				else{
				$sql="insert into hoctap(id) select id from monlop where id_hocphan='$ihp' and id_lophocphan='$il'";
				$qr=mysql_query($sql);
				$sql1="update hoctap set id_sinhvien='$is', id_giangvienTH='$ith' where id=(select id from monlop where 
				id_hocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='')";
				$qr1=mysql_query($sql1);
				$sql3="insert into dkhp(id_sinhvien,id_hocphan,ngaydk) values ('$is','$ihp', now())";
				$qr3=mysql_query($sql3);
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
		?>
  <?php
	include_once("Model/mKetNoiADHT.php");
	$p=new ketnoiAD();
	$kn=$p->ketnoi($ketnoi);
	if($kn){
		if(isset($_POST['tl'])){
			$mlhp=$_POST['a'];
			$tlhp=$_POST['b'];
			$idhp=$_POST['c'];
			$thult=$_POST['d'];
			$tutietlt=$_POST['f'];
			$dentietlt=$_POST['g'];
			$phonghoclt=$_POST['e'];
			$thuth=$_POST['h'];
			$tutietth=$_POST['k'];
			$dentietth=$_POST['l'];
			$phonghocth=$_POST['m'];
			$sql4="select * from lophocphan where malophocphan='$mlhp'";
			$qr4=mysql_query($sql4);
			if(mysql_num_rows($qr4)==1){
			}
			else{
				$sql="insert into lophocphan(malophocphan,tenlophocphan) values('$mlhp','$tlhp')";
				$qr=mysql_query($sql);
				$sql2="insert into monlop(id_lophocphan) select id_lophocphan from lophocphan
				where malophocphan='$mlhp'";
				$qr2=mysql_query($sql2);
				$sql3="update monlop set thuhocLT='$thult', thuhocTH='$thuth', tietbatdauLT='$tutietlt', 
				tietketthucLT='$dentietlt', tietbatdauTH='$tutietth', tietketthucTH='$dentietth', 
				phonghocLT='$phonghoclt', phonghocTH='$phonghocth', id_hocphan='$idhp'
				where id_lophocphan=(select id_lophocphan from lophocphan where malophocphan='$mlhp')";
				$qr3=mysql_query($sql3);
				echo header("refresh:0, url='quanlyhocphan.php?bm=".$_REQUEST['bm']."&&lhp'");
			}
			
			
		}
	}
	?>
    <?php
	if(isset($_REQUEST['xoalhp'])){
		include_once("Model/mKetNoiADHT.php");
	$p=new ketnoiAD();
	$kn=$p->ketnoi($ketnoi);
	if($kn){
		$idlhp=$_REQUEST['idlhp'];
		$sql="delete from lophocphan where md5(id_lophocphan)='$idlhp'";
		$qr=mysql_query($sql);
		$sql1="delete from monlop where md5(id_lophocphan)='$idlhp'";
		$qr1=mysql_query($sql1);
		echo header("refresh:0, url='quanlyhocphan.php?bm=".$_REQUEST['bm']."&&lhp'");
		
	}
	else{
	}
		
	}
	?>
      <?php
	  if(isset($_POST['capnhat'])){
	include_once("Model/mKetNoiADHT.php");
	$p=new ketnoiAD();
	$kn=$p->ketnoi($ketnoi);
	if($kn){
		$mlhp= $_POST['a'];
		$tlhp=$_POST['b'];
		$thult=$_POST['c'];
		$tietbdlt=$_POST['d'];
		$tietktlt=$_POST['e'];
		$phonghoclt=$_POST['i'];
		$thuth=$_POST['f'];
		$tietbdth=$_POST['g'];
		$tietktth=$_POST['h'];
		$phonghocth=$_POST['k'];
		$idlhp=$_REQUEST['idlhp'];
		$sql="select * from lophocphan where malophocphan='$mlhp'";
		$qr=mysql_query($sql);
		if(mysql_num_rows($qr)==1){
		}
		else{
			$sql1="update lophocphan set malophocphan='$mlhp', tenlophocphan='$tlhp' where md5(id_lophocphan)='$idlhp'";
			$qr1=mysql_query($sql1);
			$sql2="update monlop set thuhocLT='$thult', thuhocTH='$thuth', tietbatdauLT='$tietbdlt', tietketthucLT='$tietktlt',
			tietbatdauTH='$tietbdth', tietketthucTH='$tietktth', phonghocLT='$phonghoclt', phonghocTH='$phonghocth'
			where md5(id_lophocphan)='$idlhp'";
			$qr2=mysql_query($sql2);
			echo header("refresh:0, url='quanlyhocphan.php?bm=".$_REQUEST['bm']."&&lhp'");
		}
		
		
	}
	else{
	}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Quản Lý Học Phần</title>
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
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 24px;
}

/* ===================== NAV TABS ===================== */
.nav-tabs-custom {
    display: flex;
    gap: 10px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.nav-tab-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s;
    border: 2px solid transparent;
    background: var(--bg-card);
    color: var(--text-secondary);
    box-shadow: var(--shadow-sm);
}

.nav-tab-item i { font-size: 1rem; }

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

.card-header-custom h3 i { color: var(--primary); }

.card-body-custom { padding: 28px; }

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
    transition: all 0.3s;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4); }

.btn-success {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-success:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); }

.btn-secondary {
    background: #fff;
    color: var(--text-primary);
    border: 2px solid var(--border-color);
}

.btn-secondary:hover { border-color: var(--primary); color: var(--primary); }

.btn-export {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: #fff;
    padding: 10px 18px;
    font-size: 0.9rem;
}

.btn-export:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4); }

.btn-sm { padding: 8px 16px; font-size: 0.85rem; }

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

.action-btn.edit { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); color: #fff; }
.action-btn.edit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4); }

.action-btn.delete { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); color: #fff; }
.action-btn.delete:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4); }

.action-btn.view { background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #fff; }
.action-btn.view:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4); }

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

.data-table tbody tr { transition: background 0.2s; }
.data-table tbody tr:hover { background: #F9FAFB; }
.data-table tbody tr:last-child td { border-bottom: none; }

.data-table .stt { font-weight: 600; color: var(--text-primary); text-align: center; width: 50px; }

/* ===================== BADGES ===================== */
.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-primary { background: #EEF2FF; color: var(--primary); }
.badge-success { background: #D1FAE5; color: #059669; }

/* ===================== FORM STYLES ===================== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

@media (max-width: 992px) { .form-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 576px) { .form-grid { grid-template-columns: 1fr; } }

.form-group { display: flex; flex-direction: column; gap: 8px; }

.form-label { font-weight: 500; color: var(--text-primary); font-size: 0.9rem; }

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

.form-control-modern::placeholder { color: var(--text-light); }

select.form-control-modern {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 44px;
}

.form-actions { display: flex; justify-content: center; gap: 16px; margin-top: 32px; flex-wrap: wrap; }

/* ===================== FILE UPLOAD ===================== */
.file-upload-area {
    border: 2px dashed var(--border-color);
    border-radius: 16px;
    padding: 40px 32px;
    text-align: center;
    transition: all 0.2s;
    background: #FAFAFA;
    max-width: 600px;
    margin: 0 auto;
}

.file-upload-area:hover { border-color: var(--primary); background: #F5F3FF; }
.file-upload-area i { font-size: 3rem; color: var(--text-light); margin-bottom: 16px; }
.file-upload-area p { color: var(--text-secondary); font-size: 1rem; margin-bottom: 16px; }

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

.download-template:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); }

/* ===================== INFO SECTION ===================== */
.info-section {
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    border-left: 4px solid var(--primary);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 24px;
}

.info-section h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-top: 16px;
}

.info-item { display: flex; flex-direction: column; gap: 4px; }
.info-item label { font-size: 0.75rem; text-transform: uppercase; color: var(--text-light); font-weight: 600; }
.info-item span { font-size: 0.95rem; color: var(--text-primary); font-weight: 500; }

/* ===================== SECTION BOX ===================== */
.section-box {
    background: #FAFAFA;
    border-radius: 12px;
    padding: 24px;
    border: 1px solid var(--border-color);
    margin-bottom: 24px;
}

.section-box h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-box h4 i { color: var(--primary); }

/* ===================== PAGINATION ===================== */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 32px;
    gap: 8px;
}

.pagination-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
}

.pagination-item:hover { border-color: var(--primary); color: var(--primary); }
.pagination-item.active { background: var(--primary); border-color: var(--primary); color: #fff; }

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

.back-btn:hover { border-color: var(--primary); color: var(--primary); transform: translateY(-2px); }

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
    .nav-tabs-custom { justify-content: center; }
    .card-body-custom { padding: 16px; }
}

/* ===================== SPECIFIC LAYOUT ===================== */
.form-row { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 16px; }
.form-row .form-group { flex: 1; min-width: 200px; }

.inline-form { display: inline-flex; align-items: center; gap: 8px; }
.inline-form select, .inline-form input { margin: 0; }

.text-center { text-align: center; }
.mb-2 { margin-bottom: 16px; }
.mt-2 { margin-top: 16px; }
</style>
</head>

<body>
<!-- ===================== TOPBAR ===================== -->
<div class="topbar" id="codinh">
    <div class="topbar-content">
        <div class="topbar-title">
            <i class="fas fa-book-open"></i>
            <span>Quản Lý Học Phần</span>
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
        <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&mhp" class="nav-tab-item <?php if(isset($_REQUEST['mhp'])) echo 'active'; ?>">
            <i class="fas fa-book"></i>
            Môn Học Phần
        </a>
        <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&lhp" class="nav-tab-item <?php if(isset($_REQUEST['lhp'])) echo 'active'; ?>">
            <i class="fas fa-layer-group"></i>
            Lớp Học Phần
        </a>
        <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&gv-hp" class="nav-tab-item <?php if(isset($_REQUEST['gv-hp'])) echo 'active'; ?>">
            <i class="fas fa-chalkboard-teacher"></i>
            GV - Học Phần
        </a>
        <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&sv-hp" class="nav-tab-item <?php if(isset($_REQUEST['sv-hp'])) echo 'active'; ?>">
            <i class="fas fa-user-graduate"></i>
            SV - Học Phần
        </a>
    </div>

<?php if(isset($_REQUEST['mhp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-list"></i> Danh Sách Môn Học Phần</h3>
            <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&themhp" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm Mới
            </a>
        </div>
        <div class="card-body-custom">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Học Phần</th>
                            <th>Tên Học Phần</th>
                            <th style="text-align: center;">Xem</th>
                            <th style="text-align: center;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("Controller/cTKADHT.php");
                        $p=new cTKAD();
                        $ci=$p->dsmhp();
                        $a=1;
                        while($c=mysql_fetch_assoc($ci)){ 
                        ?>
                        <tr>
                            <td class="stt"><?php echo $a++; ?></td>
                            <td><span class="badge badge-primary"><?php echo $c['mahocphan']?></span></td>
                            <td style="font-weight: 500; color: var(--text-primary);"><?php echo $c['tenhocphan']?></td>
                            <td style="text-align: center;">
                                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&xem=<?php echo md5($c['mahocphan'])?>" class="action-btn view">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&xoaihp=<?php echo md5($c['id_hocphan'])?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['xoaihp'])){
    include_once("Controller/cTKADHT.php");
    $pDel=new cTKAD();
    $pDel->xoahp();
    $pDel->xoahp1();
    echo header("refresh:0,url='quanlyhocphan.php?bm=".$_REQUEST['bm']."&&mhp'");
}
elseif(isset($_REQUEST['xem'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&mhp" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-info-circle"></i> Thông Tin Học Phần</h3>
            </div>
            <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xem=<?php echo $_REQUEST['xem'] ?>&&suahp" class="btn btn-primary">
                <i class="fas fa-edit"></i> Sửa
            </a>
        </div>
        <div class="card-body-custom">
            <?php 
            include_once("Controller/cTKADHT.php");
            $p= new cTKAD();
            $a=mysql_fetch_assoc($p->xemct());
            ?>
            <?php if(isset($_REQUEST['suahp'])){ ?>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tên Học Phần</label>
                            <input type="text" name="a" value="<?php echo $a['tenhocphan'] ?>" class="form-control-modern" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mã Học Phần</label>
                            <input type="text" value="<?php echo $a['mahocphan'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Loại Học Phần</label>
                            <input type="text" name="m" value="<?php echo $a['loaihp'] ?>" class="form-control-modern" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số Tín Chỉ</label>
                            <input type="text" name="c" value="<?php echo $a['soTC'] ?>" class="form-control-modern" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số Tín Chỉ LT</label>
                            <input type="text" name="d" value="<?php echo $a['TCLT'] ?>" class="form-control-modern" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số Tín Chỉ TH</label>
                            <input type="text" name="e" value="<?php echo $a['TCTH'] ?>" class="form-control-modern" required/>
                        </div>
                        <div class="form-group" style="grid-column: span 3;">
                            <label class="form-label">Khoa Chủ Quản</label>
                            <select name="g" class="form-control-modern">
                                <option value="<?php echo $a['id_khoa'] ?>"><?php echo $a['tenkhoa'] ?></option>
                                <?php
                                include_once("Model/mKetNoiADHT.php");
                                $p=new ketnoiAD();
                                $kn=$p->ketnoi();
                                if($kn){
                                    $sql="select *from khoavien";
                                    $qr=mysql_query($sql);
                                    while($b=mysql_fetch_assoc($qr)){
                                ?>
                                <option value="<?php echo $b['id_khoa'] ?>"><?php echo $b['tenkhoa']; ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="s1" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu Thay Đổi
                        </button>
                    </div>
                </form>
            <?php } else { ?>
                <div class="info-section">
                    <h4><i class="fas fa-graduation-cap"></i> Thông Tin Chi Tiết Học Phần</h4>
                    <div class="info-grid">
                        <div class="info-item"><label>Tên Học Phần</label><span><?php echo $a['tenhocphan'] ?></span></div>
                        <div class="info-item"><label>Mã Học Phần</label><span><?php echo $a['mahocphan'] ?></span></div>
                        <div class="info-item"><label>Loại Học Phần</label><span><?php echo $a['loaihp'] ?></span></div>
                        <div class="info-item"><label>Số Tín Chỉ</label><span><?php echo $a['soTC'] ?></span></div>
                        <div class="info-item"><label>Tín Chỉ Lý Thuyết</label><span><?php echo $a['TCLT'] ?></span></div>
                        <div class="info-item"><label>Tín Chỉ Thực Hành</label><span><?php echo $a['TCTH'] ?></span></div>
                        <div class="info-item"><label>Khoa Chủ Quản</label><span><?php echo $a['tenkhoa'] ?></span></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['themhp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>&&mhp" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-plus-circle"></i> Thêm Môn Học Phần</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <div class="file-upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Tải File Excel để tạo thêm học phần</p>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <input type="file" name="f" required class="form-control-modern" accept=".xlsx,.xls" style="max-width: 300px; margin: 0 auto;"/>
                    <div class="form-actions" style="margin-top: 20px;">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Tải Lên
                        </button>
                    </div>
                </form>
                <p style="margin-top: 20px; color: var(--text-secondary);">Đây là mẫu dữ liệu file nhập để tạo học phần. Để lấy file mẫu vui lòng bấm tải xuống!</p>
                <a href="taixuong.php?fu=Tao_Hoc_Phan.xlsx" class="download-template">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" style="width: 24px; height: 24px;"/>
                    <span>Tải Mẫu File Excel</span>
                </a>
            </div>
        </div>
    </div>
<?php if(isset($_REQUEST['themhp'])){
if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    if ($file_size > 30000000) { echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>"; }
    $mimes = array(
                'txt' => 'text/plain','htm' => 'text/html','html' => 'text/html','php' => 'text/html','css' => 'text/css','js' => 'application/javascript','json' => 'application/json','xml' => 'application/xml','swf' => 'application/x-shockwave-flash','flv' => 'video/x-flv',
                'png' => 'image/png','jpe' => 'image/jpeg','jpeg' => 'image/jpeg','jpg' => 'image/jpeg','gif' => 'image/gif','bmp' => 'image/bmp','ico' => 'image/vnd.microsoft.icon','tiff' => 'image/tiff','tif' => 'image/tiff','svg' => 'image/svg+xml','svgz' => 'image/svg+xml',
                'zip' => 'application/zip','rar' => 'application/x-rar-compressed','exe' => 'application/x-msdownload','msi' => 'application/x-msdownload','cab' => 'application/vnd.ms-cab-compressed',
                'mp3' => 'audio/mpeg','qt' => 'video/quicktime','mov' => 'video/quicktime',
                'pdf' => 'application/pdf','psd' => 'image/vnd.adobe.photoshop','ai' => 'application/postscript','eps' => 'application/postscript','ps' => 'application/postscript',
                'doc' => 'application/msword','rtf' => 'application/rtf','xls' => 'application/vnd.ms-excel','xls1' => 'application/excel','xls2' => 'application/x-excel','xls3' => 'application/x-msexcel','ppt' => 'application/vnd.ms-powerpoint','docx' => 'application/msword','xlsx' => 'application/vnd.ms-excel','pptx' => 'application/vnd.ms-powerpoint',
                'odt' => 'application/vnd.oasis.opendocument.text','ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    if (file_exists($_FILES['f']==$file_name)) { echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>"; }
    else {
        $file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;
        if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){ echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>"; }
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
$chp=  $sheet->getCellByColumnAndRow(0,1)->getValue();
$ck=  $sheet->getCellByColumnAndRow(6,1)->getValue();
if($chp!="Mã Học Phần" || $ck!="Khoa ( Lấy Theo Mã Khoa )"){
    echo "<script>alert('File Excel Tải Lên Để Thêm Học Phần Không Đúng ! ')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    $mahp= $sheet->getCellByColumnAndRow(0,$row)->getValue();
    $tenhp= $sheet->getCellByColumnAndRow(1,$row)->getValue();
    $loaihp= $sheet->getCellByColumnAndRow(2,$row)->getValue();
    $stc= $sheet->getCellByColumnAndRow(3,$row)->getValue();
    $tclt= $sheet->getCellByColumnAndRow(4,$row)->getValue();
    $tcth= $sheet->getCellByColumnAndRow(5,$row)->getValue();
    $idkhoa1= $sheet->getCellByColumnAndRow(6,$row)->getValue();
    $sql="select * from khoavien where makhoa='$idkhoa1'";
    $qr=mysql_query($sql);
    $e=mysql_fetch_assoc($qr);
    $idkhoa=$e['id_khoa'];
    $sql="select * from hocphan where mahocphan='$mahp'";
    $qr=mysql_query($sql);
    $sql1="select * from ct_hocphan ct join hocphan hp on ct.id_hocphan=hp.id_hocphan where hp.mahocphan='$mahp'";
    $qr1=mysql_query($sql1);
    if(mysql_num_rows($qr)==1){}
    elseif(mysql_num_rows($qr1)==1){}
    elseif($mahp==null){}
    else {
     $sql="insert into hocphan(mahocphan,tenhocphan,id_khoa) values ('$mahp','$tenhp','$idkhoa')";
     $qr=mysql_query($sql);
     $sq2="insert into ct_hocphan(id_hocphan) select id_hocphan from hocphan where mahocphan='$mahp'";
     $qr2=mysql_query($sq2);
     $sq3="update ct_hocphan set loaihp='$loaihp', soTC='$stc', TCLT='$tclt', TCTH='$tcth' where id_hocphan=(select id_hocphan from hocphan where mahocphan='$mahp' )";
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
} }
elseif(isset($_REQUEST['lhp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-layer-group"></i> Danh Sách Lớp Học Phần</h3>
            <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&themlhp" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm Mới
            </a>
        </div>
        <div class="card-body-custom">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Lớp HP</th>
                            <th>Tên Lớp Học Phần</th>
                            <th>Tên Môn HP</th>
                            <th style="text-align: center;">Sửa</th>
                            <th style="text-align: center;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("Controller/cTKADHT.php");
                        $p=new cTKAD();
                        $ci=$p->dslhp();
                        $a=1;
                        while($c=mysql_fetch_assoc($ci)){ 
                        ?>
                        <tr>
                            <td class="stt"><?php echo $a++; ?></td>
                            <td><span class="badge badge-primary"><?php echo $c['malophocphan']?></span></td>
                            <td style="font-weight: 500; color: var(--text-primary);"><?php echo $c['tenlophocphan']?></td>
                            <td><?php echo $c['tenhocphan']?></td>
                            <td style="text-align: center;">
                                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&idlhp=<?php echo md5($c['id_lophocphan']) ?>&&sualhp" class="action-btn edit">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&idlhp=<?php echo md5($c['id_lophocphan']) ?>&&xoalhp" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['sualhp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&lhp" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-edit"></i> Sửa Thông Tin Lớp Học Phần</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <?php 
            include_once("Model/mKetNoiADHT.php");
            $p=new ketnoiAD();
            $kn=$p->ketnoi($ketnoi);
            if($kn){
                $idlhp=$_REQUEST['idlhp'];
                $sql="select * from lophocphan l join monlop m on l.id_lophocphan=m.id_lophocphan
                join hocphan hp on hp.id_hocphan=m.id_hocphan where md5(l.id_lophocphan)='$idlhp' ";
                $qr=mysql_query($sql);
                $a=mysql_fetch_assoc($qr);
            }
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Mã Lớp Học Phần</label>
                        <input type="text" name="a" value="<?php echo $a['malophocphan'] ?>" class="form-control-modern" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tên Lớp Học Phần</label>
                        <input type="text" name="b" value="<?php echo $a['tenlophocphan'] ?>" class="form-control-modern"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Môn Học Phần</label>
                        <input type="text" value="<?php echo $a['mahocphan'] ?>&nbsp;-&nbsp;<?php echo $a['tenhocphan'] ?>" class="form-control-modern" disabled/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ngày Học LT (Thứ)</label>
                        <select name="c" class="form-control-modern">
                            <option value="<?php echo $a['thuhocLT'] ?>"><?php echo $a['thuhocLT'] ?></option>
                            <option value="2">2</option><option value="3">3</option><option value="4">4</option>
                            <option value="5">5</option><option value="6">6</option><option value="7">7</option>
                            <option value="8">Chủ Nhật</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tiết LT Từ</label>
                        <select name="d" class="form-control-modern">
                            <option value="<?php echo $a['tietbatdauLT'] ?>"><?php echo $a['tietbatdauLT'] ?></option>
                            <option value="1">1</option><option value="4">4</option><option value="7">7</option>
                            <option value="10">10</option><option value="13">13</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Đến Tiết</label>
                        <select name="e" class="form-control-modern">
                            <option value="<?php echo $a['tietketthucLT'] ?>"><?php echo $a['tietketthucLT'] ?></option>
                            <option value="3">3</option><option value="6">6</option><option value="9">9</option>
                            <option value="12">12</option><option value="15">15</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phòng Học LT</label>
                        <input type="text" name="i" value="<?php echo $a['phonghocLT'] ?>" class="form-control-modern" required/>
                    </div>
                    <?php
                    $ma=$a['mahocphan'];
                    $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan where hp.mahocphan='$ma'";
                    $qr=mysql_query($sql);
                    $r=mysql_fetch_assoc($qr);
                    if($r['loaihp']=='LT & TH'){
                    ?>
                    <div class="form-group">
                        <label class="form-label">Ngày Học TH (Thứ)</label>
                        <select name="f" class="form-control-modern">
                            <option value="<?php echo $a['thuhocTH'] ?>"><?php echo $a['thuhocTH'] ?></option>
                            <option value="2">2</option><option value="3">3</option><option value="4">4</option>
                            <option value="5">5</option><option value="6">6</option><option value="7">7</option>
                            <option value="8">Chủ Nhật</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tiết TH Từ</label>
                        <select name="g" class="form-control-modern">
                            <option value="<?php echo $a['tietbatdauTH'] ?>"><?php echo $a['tietbatdauTH'] ?></option>
                            <option value="1">1</option><option value="4">4</option><option value="7">7</option>
                            <option value="10">10</option><option value="13">13</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Đến Tiết</label>
                        <select name="h" class="form-control-modern">
                            <option value="<?php echo $a['tietketthucTH'] ?>"><?php echo $a['tietketthucTH'] ?></option>
                            <option value="3">3</option><option value="6">6</option><option value="9">9</option>
                            <option value="12">12</option><option value="15">15</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phòng Học TH</label>
                        <input type="text" name="k" value="<?php echo $a['phonghocTH'] ?>" class="form-control-modern" required/>
                    </div>
                    <?php } ?>
                </div>
                <div class="form-actions">
                    <button type="submit" name="capnhat" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập Nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['themlhp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&lhp" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-plus-circle"></i> Thêm Lớp Học Phần</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Mã Lớp Học Phần</label>
                        <input type="text" name="a" class="form-control-modern" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tên Lớp Học Phần</label>
                        <input type="text" name="b" class="form-control-modern" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Môn Học Phần</label>
                        <select name="c" class="form-control-modern" onchange="window.location.href=this.value;" required>
                            <?php
                            $ih=$_REQUEST['ih'];
                            $sql="select *from hocphan where id_hocphan='$ih'";
                            $qr=mysql_query($sql);
                            $m=mysql_fetch_assoc($qr);
                            ?>
                            <option value="<?php echo $m['id_hocphan'] ?>"><?php if(isset($_REQUEST['ih'])){ echo $m['mahocphan'].' - '.$m['tenhocphan']; } ?></option>
                            <option value="">Vui lòng chọn</option>
                            <?php
                            $sql="select *from hocphan";
                            $qr=mysql_query($sql);
                            while($a=mysql_fetch_assoc($qr)){
                            ?>
                            <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&themlhp&&ih=<?php echo $a['id_hocphan'] ?>"><?php echo $a['mahocphan'] ?>&nbsp;-&nbsp;<?php echo $a['tenhocphan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ngày Học LT (Thứ)</label>
                        <select name="d" class="form-control-modern">
                            <option value="2">2</option><option value="3">3</option><option value="4">4</option>
                            <option value="5">5</option><option value="6">6</option><option value="7">7</option>
                            <option value="8">Chủ Nhật</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tiết LT Từ</label>
                        <select name="f" class="form-control-modern">
                            <option value="1">1</option><option value="4">4</option><option value="7">7</option>
                            <option value="10">10</option><option value="13">13</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Đến Tiết</label>
                        <select name="g" class="form-control-modern">
                            <option value="3">3</option><option value="6">6</option><option value="9">9</option>
                            <option value="12">12</option><option value="15">15</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phòng Học LT</label>
                        <input type="text" name="e" class="form-control-modern" required/>
                    </div>
                    <?php
                    $ih=$_REQUEST['ih'];
                    $sql="select *from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan where hp.id_hocphan='$ih'";
                    $qr=mysql_query($sql);
                    $n=mysql_fetch_assoc($qr);
                    if($n['loaihp']=='LT & TH'){
                    ?>
                    <div class="form-group">
                        <label class="form-label">Ngày Học TH (Thứ)</label>
                        <select name="h" class="form-control-modern">
                            <option value="2">2</option><option value="3">3</option><option value="4">4</option>
                            <option value="5">5</option><option value="6">6</option><option value="7">7</option>
                            <option value="8">Chủ Nhật</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tiết TH Từ</label>
                        <select name="k" class="form-control-modern">
                            <option value="1">1</option><option value="4">4</option><option value="7">7</option>
                            <option value="10">10</option><option value="13">13</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Đến Tiết</label>
                        <select name="l" class="form-control-modern">
                            <option value="3">3</option><option value="6">6</option><option value="9">9</option>
                            <option value="12">12</option><option value="15">15</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phòng Học TH</label>
                        <input type="text" name="m" class="form-control-modern" required/>
                    </div>
                    <?php } ?>
                </div>
                <div class="form-actions">
                    <button type="submit" name="tl" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['gv-hp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-chalkboard-teacher"></i> Phân Giảng Viên Giảng Dạy Học Phần</h3>
        </div>
        <div class="card-body-custom">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="section-box">
                    <h4><i class="fas fa-user-plus"></i> Thông Tin Phân Công</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Họ Tên Giảng Viên</label>
                            <select name="a" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['cgv'] ?>"><?php if(isset($_REQUEST['tengv'])){ echo $_REQUEST['tengv']; } ?></option>
                                <?php
                                $sql="select * from giangvien gv join chuyennganh cn on gv.id_chuyennganh=cn.id_chuyennganh join khoavien kv on cn.id_khoa=kv.id_khoa";
                                $qr=mysql_query($sql);
                                while($c=mysql_fetch_assoc($qr)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&tengv=<?php echo $c['hotengiangvien'] ?>&&cgv=<?php echo $c['id_giangvien'] ?>&&khoa=<?php echo $c['tenkhoa'] ?>"><?php echo $c['hotengiangvien'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Khoa/Viện</label>
                            <?php
                            $a=$_REQUEST['tengv'];
                            $sql="select * from giangvien gv join chuyennganh cn on gv.id_chuyennganh=cn.id_chuyennganh join khoavien kv on cn.id_khoa=kv.id_khoa where gv.hotengiangvien='$a'";
                            $qr=mysql_query($sql);
                            $f=mysql_fetch_assoc($qr);
                            ?>
                            <input type="text" value="<?php echo $f['tenkhoa'] ?>" class="form-control-modern" disabled/>
                            <input type="text" value="<?php echo $f['tenchuyennganh'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Môn Học Phần</label>
                            <select name="b" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['idhocphan'] ?>"><?php if(isset($_REQUEST['idhocphan'])){ echo $_REQUEST['mahp']." - ".$_REQUEST['monhocphan']; } ?></option>
                                <?php
                                $k=$_REQUEST['khoa'];
                                $sql1="select * from hocphan hp join khoavien k on hp.id_khoa=k.id_khoa where k.tenkhoa='$k' ";
                                $qr1=mysql_query($sql1);
                                while($d=mysql_fetch_assoc($qr1)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&tengv=<?php echo $_REQUEST['tengv'] ?>&&cgv=<?php echo $_REQUEST['cgv']?>&&mahp=<?php echo $d['mahocphan'] ?>&&monhocphan=<?php echo $d['tenhocphan'] ?>&&idhocphan=<?php echo $d['id_hocphan'] ?>&&khoa=<?php echo $_REQUEST['khoa']; ?>"><?php echo $d['mahocphan'] ?>&nbsp;-&nbsp;<?php echo $d['tenhocphan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lớp Học Phần</label>
                            <select name="c" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['ip'] ?>"><?php if(isset($_REQUEST['ip'])){ echo $_REQUEST['tlhp']; }?></option>
                                <?php
                                if(isset($_REQUEST['idhocphan'])){
                                    $idhp=$_REQUEST['idhocphan'];
                                    $sql2="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan join lophocphan l on m.id_lophocphan=l.id_lophocphan where hp.id_hocphan='$idhp'";
                                    $qr2=mysql_query($sql2);
                                    while($f=mysql_fetch_assoc($qr2)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&tengv=<?php echo $_REQUEST['tengv'] ?>&&cgv=<?php echo $_REQUEST['cgv'] ?>&&mahp=<?php echo $_REQUEST['mahp'] ?>&&monhocphan=<?php echo $_REQUEST['monhocphan'] ?>&&idhocphan=<?php echo $_REQUEST['idhocphan'] ?>&&khoa=<?php echo $_REQUEST['khoa']; ?>&&ip=<?php echo $f['id_lophocphan'] ?>&&tlhp=<?php echo $f['tenlophocphan']  ?>"><?php echo $f['tenlophocphan'] ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php if(isset($_REQUEST['ip'])){ ?>
                <div class="info-section">
                    <h4><i class="fas fa-info-circle"></i> Thông Tin Học Phần</h4>
                    <?php
                    $idhp=$_REQUEST['idhocphan'];
                    $ip=$_REQUEST['ip'];
                    $sql="select * from monlop m join hocphan hp on m.id_hocphan=hp.id_hocphan join ct_hocphan c on hp.id_hocphan= c.id_hocphan where m.id_hocphan='$idhp' and m.id_lophocphan='$ip'";
                    $qr=mysql_query($sql);
                    $tt=mysql_fetch_assoc($qr);
                    ?>
                    <div class="info-grid">
                        <div class="info-item"><label>Môn Học Phần</label><span><?php echo $_REQUEST['monhocphan'] ?></span></div>
                        <div class="info-item"><label>Lớp Học Phần</label><span><?php echo $_REQUEST['tlhp'] ?></span></div>
                        <div class="info-item"><label>Loại Học Phần</label><span><?php echo $tt['loaihp'] ?></span></div>
                        <div class="info-item"><label>Tổng Số Tín Chỉ</label><span><?php echo $tt['soTC'] ?> (LT: <?php echo $tt['TCLT'] ?> - TH: <?php echo $tt['TCTH'] ?>)</span></div>
                    </div>
                    <input type="hidden" name="k" value="<?php echo $tt['loaihp']; ?>" />
                    <?php if($tt['loaihp']=="LT & TH"){ ?>
                    <div class="form-grid" style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Ngày Học LT (Thứ)</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['thuhocLT'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tiết Lý Thuyết</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $tt['tietketthucLT'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phòng Học LT</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['phonghocLT'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ngày Học TH (Thứ)</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['thuhocTH'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tiết Thực Hành</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['tietbatdauTH'] ?>&nbsp;-&nbsp;<?php echo $tt['tietketthucTH'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phòng Học TH</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['phonghocTH'] ?></span>
                        </div>
                    </div>
                    <div class="form-grid" style="margin-top: 16px;">
                        <div class="form-group">
                            <label class="form-label">Giảng Viên Thực Hành 1</label>
                            <select name="d" class="form-control-modern">
                                <option value="">Chọn Giảng Viên</option>
                                <?php
                                $khoa=$_REQUEST['khoa'];
                                $sql="select * from giangvien gv join chuyennganh cn on cn.id_chuyennganh=gv.id_chuyennganh join khoavien kv on cn.id_khoa=kv.id_khoa where kv.tenkhoa='$khoa'";
                                $qr=mysql_query($sql);
                                while($k=mysql_fetch_assoc($qr)){
                                ?>
                                <option value="<?php echo $k['id_giangvien'] ?>"><?php echo $k['hotengiangvien'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Giảng Viên Thực Hành 2</label>
                            <select name="e" class="form-control-modern">
                                <option value="">Chọn Giảng Viên</option>
                                <?php
                                $sql="select * from giangvien gv join chuyennganh cn on cn.id_chuyennganh=gv.id_chuyennganh join khoavien kv on cn.id_khoa=kv.id_khoa where kv.tenkhoa='$khoa'";
                                $qr=mysql_query($sql);
                                while($k=mysql_fetch_assoc($qr)){
                                ?>
                                <option value="<?php echo $k['id_giangvien'] ?>"><?php echo $k['hotengiangvien'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-grid" style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Ngày Học LT (Thứ)</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['thuhocLT'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tiết Lý Thuyết</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $tt['tietketthucLT'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phòng Học LT</label>
                            <span class="form-control-modern" style="background: #f3f4f6;"><?php echo $tt['phonghocLT'] ?></span>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-actions" style="margin-top: 24px;">
                        <button type="submit" name="pc" class="btn btn-primary">
                            <i class="fas fa-check"></i> Xác Nhận Phân Công
                        </button>
                    </div>
                </div>
                <?php } ?>
            </form>

            <div class="section-box" style="margin-top: 24px;">
                <h4><i class="fas fa-list"></i> Danh Sách Giảng Viên Đã Phân Công</h4>
                <div class="table-wrapper" style="border: none;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Giảng Viên LT</th>
                                <th>GV TH1</th>
                                <th>GV TH2</th>
                                <th>Môn HP</th>
                                <th>Lớp HP</th>
                                <th>Thông Tin LT</th>
                                <th>Thông Tin TH</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql="select * from giangday gd join monlop m on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien join hocphan hp on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan";
                            $qr=mysql_query($sql);
                            $a=1;
                            while($x=mysql_fetch_assoc($qr)){
                            ?>
                            <tr>
                                <td class="stt"><?php echo $a++; ?></td>
                                <td><?php echo $x['hotengiangvien']; ?></td>
                                <td><?php 
                                $r=$x['id_giangvienTH1'];
                                if($r!=null){
                                    $sql1="select *from giangvien where id_giangvien='$r'";
                                    $qr1=mysql_query($sql1);
                                    $h=mysql_fetch_assoc($qr1);
                                    echo $h['hotengiangvien'];
                                }?></td>
                                <td><?php 
                                $s=$x['id_giangvienTH2'];
                                if($s!=null){
                                    $sql2="select *from giangvien where id_giangvien='$s'";
                                    $qr2=mysql_query($sql2);
                                    $h2=mysql_fetch_assoc($qr2);
                                    echo $h2['hotengiangvien'];
                                }?></td>
                                <td><?php echo $x['mahocphan']; ?>&nbsp;-&nbsp;<?php echo $x['tenhocphan']; ?></td>
                                <td><?php echo $x['tenlophocphan']; ?></td>
                                <td>PH: <?php echo $x['phonghocLT']; ?><br/>Tiết: <?php echo $x['tietbatdauLT']?>-<?php echo $x['tietketthucLT']?></td>
                                <td><?php if($x['phonghocTH']==null){ echo "-"; } else { ?>PH: <?php echo $x['phonghocTH']; ?><br/>Tiết: <?php echo $x['tietbatdauTH']?>-<?php echo $x['tietketthucTH']?><?php } ?></td>
                                <td style="text-align: center;">
                                    <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&xoapc=<?php echo md5($x['id_giangday']) ?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['pec'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-file-import"></i> Phân Sinh Viên Vào Học Phần (Excel)</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="section-box">
                    <h4><i class="fas fa-upload"></i> Tải Lên Danh Sách SV</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Môn Học Phần</label>
                            <select name="a" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['ihp'] ?>"><?php if(isset($_REQUEST['ihp'])){ echo $_REQUEST['thp']; }?></option>
                                <?php
                                $sql="select * from hocphan";
                                $qr=mysql_query($sql);
                                while($hp=mysql_fetch_assoc($qr)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp&&pec&&ihp=<?php echo $hp['id_hocphan'] ?>&&thp=<?php echo $hp['tenhocphan']?>"><?php echo $hp['tenhocphan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lớp Học Phần</label>
                            <select name="b" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['il'] ?>"><?php echo $_REQUEST['tl'] ?></option>
                                <?php
                                $ihp=$_REQUEST['ihp'];
                                $sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan where hp.id_hocphan='$ihp'";
                                $qr=mysql_query($sql);
                                while($l=mysql_fetch_assoc($qr)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp&&pec&&ihp=<?php echo $_REQUEST['ihp'] ?>&&thp=<?php echo $_REQUEST['thp']?>&&il=<?php echo $l['id_lophocphan'] ?>&&tl=<?php echo $l['tenlophocphan'] ?>"><?php echo $l['tenlophocphan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php if(isset($_REQUEST['il'])){ ?>
                <div class="info-section">
                    <h4><i class="fas fa-info-circle"></i> Thông Tin Học Phần</h4>
                    <?php
                    $ihp=$_REQUEST['ihp'];
                    $il=$_REQUEST['il'];
                    $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan join monlop m on m.id_hocphan=hp.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan join giangday g on g.id=m.id where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
                    $qr=mysql_query($sql);
                    $f=mysql_fetch_assoc($qr);
                    ?>
                    <div class="info-grid">
                        <div class="info-item"><label>Môn Học Phần</label><span><?php echo $f['tenhocphan'] ?></span></div>
                        <div class="info-item"><label>Lớp Học Phần</label><span><?php echo $f['tenlophocphan'] ?></span></div>
                        <div class="info-item"><label>Loại Học Phần</label><span><?php echo $f['loaihp'] ?></span></div>
                        <div class="info-item"><label>Tín Chỉ</label><span><?php echo $f['soTC'] ?> (LT: <?php echo $f['TCLT'] ?> - TH: <?php echo $f['TCTH'] ?>)</span></div>
                        <div class="info-item"><label>Ngày Học LT</label><span><?php echo $f['thuhocLT'] ?>&nbsp;|&nbsp;Tiết: <?php echo $f['tietbatdauLT'] ?>-<?php echo $f['tietketthucLT'] ?>&nbsp;|&nbsp;PH: <?php echo $f['phonghocLT'] ?></span></div>
                        <?php if($f['loaihp']=='LT & TH'){ ?>
                        <div class="info-item"><label>Ngày Học TH</label><span><?php echo $f['thuhocTH'] ?>&nbsp;|&nbsp;Tiết: <?php echo $f['tietbatdauTH'] ?>-<?php echo $f['tietketthucTH'] ?>&nbsp;|&nbsp;PH: <?php echo $f['phonghocTH'];?></span></div>
                        <?php } ?>
                    </div>
                    <?php $g=$f['id_giangvien'];
                    $sql="select * from giangvien where id_giangvien='$g'";
                    $tt=mysql_query($sql);
                    $e=mysql_fetch_assoc($tt);
                    ?>
                    <input type="hidden" name="ig" value="<?php echo $e['id_giangvien'] ?>" />
                    <div class="form-grid" style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Giảng Viên Lý Thuyết</label>
                            <input type="text" value="<?php echo $e['hotengiangvien'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <?php if($f['loaihp']=='LT & TH'){ ?>
                        <div class="form-group">
                            <label class="form-label">Chọn Giảng Viên TH</label>
                            <select name="c" class="form-control-modern">
                                <option value="<?php echo $f['id_giangvienTH1']; ?>"><?php $n=$f['id_giangvienTH1']; $sql="select *from giangvien where id_giangvien='$n'"; $ttgv=mysql_query($sql); $u=mysql_fetch_assoc($ttgv); echo $u['hotengiangvien']; ?></option>
                                <option value="<?php echo $f['id_giangvienTH2']; ?>"><?php $m=$f['id_giangvienTH2']; $sql="select *from giangvien where id_giangvien='$m'"; $ttgv=mysql_query($sql); $u=mysql_fetch_assoc($ttgv); echo $u['hotengiangvien']; ?></option>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="form-group" style="grid-column: span 3;">
                            <label class="form-label">File Excel Danh Sách Sinh Viên</label>
                            <input type="file" name="f" class="form-control-modern" required/>
                        </div>
                    </div>
                    <div class="form-actions" style="margin-top: 24px;">
                        <button type="submit" name="se" class="btn btn-primary">
                            <i class="fas fa-check"></i> Xác Nhận
                        </button>
                    </div>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['sv-hp'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <h3><i class="fas fa-user-graduate"></i> Phân Sinh Viên Vào Học Phần</h3>
            <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp&&pec" class="btn btn-export">
                <i class="fas fa-file-excel"></i> Phân Excel
            </a>
        </div>
        <div class="card-body-custom">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="section-box">
                    <h4><i class="fas fa-user-plus"></i> Thông Tin Sinh Viên</h4>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Họ Tên Sinh Viên</label>
                            <select name="a" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['is'] ?>"><?php if(isset($_REQUEST['is'])){ echo $_REQUEST['ts']; } ?></option>
                                <?php
                                $sql="select * from sinhvien";
                                $ldssv=mysql_query($sql);
                                while($c=mysql_fetch_assoc($ldssv)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&sv-hp&&is=<?php echo $c['id_sinhvien'] ?>&&ts=<?php echo $c['tensinhvien'] ?>"><?php echo $c['tensinhvien'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if(isset($_REQUEST['is'])){ 
                            $is= $_REQUEST['is'];
                            $sql="select * from sinhvien s join chuyennganh c on s.id_chuyennganh=c.id_chuyennganh join khoavien k on c.id_khoa=k.id_khoa where s.id_sinhvien='$is' ";
                            $ksv=mysql_query($sql);
                            $b=mysql_fetch_assoc($ksv);
                        ?>
                        <div class="form-group">
                            <label class="form-label">Khoa</label>
                            <input type="text" value="<?php echo $b['tenkhoa'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Chuyên Ngành</label>
                            <input type="text" value="<?php echo $b['tenchuyennganh'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="form-label">Môn Học Phần</label>
                            <select name="b" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['ihp'] ?>"><?php if(isset($_REQUEST['ihp'])){ echo $_REQUEST['thp']; } ?></option>
                                <?php
                                $sql="select *from hocphan";
                                $laymh=mysql_query($sql);
                                while($a=mysql_fetch_assoc($laymh)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&sv-hp&&is=<?php echo $_REQUEST['is'] ?>&&ts=<?php echo $_REQUEST['ts'] ?>&&ihp=<?php echo $a['id_hocphan'] ?>&&thp=<?php echo $a['tenhocphan'] ?>"><?php echo $a['tenhocphan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lớp Học Phần</label>
                            <select name="c" class="form-control-modern" onchange="window.location.href=this.value;">
                                <option value="<?php echo $_REQUEST['il']; ?>"><?php if(isset($_REQUEST['il'])){ echo $_REQUEST['tl']; }?></option>
                                <?php
                                $ihp=$_REQUEST['ihp'];
                                $sql="select *from lophocphan l join monlop m on m.id_lophocphan=l.id_lophocphan join hocphan hp on hp.id_hocphan=m.id_hocphan where hp.id_hocphan='$ihp'"; 
                                $laylhp=mysql_query($sql);
                                while($d=mysql_fetch_assoc($laylhp)){
                                ?>
                                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&sv-hp&&is=<?php echo $_REQUEST['is'] ?>&&ts=<?php echo $_REQUEST['ts'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&thp=<?php echo $_REQUEST['thp'] ?>&&il=<?php echo $d['id_lophocphan'] ?>&&tl=<?php echo $d['tenlophocphan'] ?>"><?php echo $d['tenlophocphan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php if(isset($_REQUEST['il'])){
                    $ihp=$_REQUEST['ihp'];
                    $il=$_REQUEST['il'];
                    $sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan join ct_hocphan c on c.id_hocphan=hp.id_hocphan where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
                    $tthp=mysql_query($sql);
                    $q=mysql_fetch_assoc($tthp);
                    $sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan join ct_hocphan c on c.id_hocphan=hp.id_hocphan join giangday g on g.id=m.id where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
                    $tthp1=mysql_query($sql);
                    $r1=mysql_fetch_assoc($tthp1);
                ?>
                <div class="info-section">
                    <h4><i class="fas fa-info-circle"></i> Thông Tin Học Phần</h4>
                    <div class="info-grid">
                        <div class="info-item"><label>Môn Học Phần</label><span><?php echo $q['tenhocphan'] ?></span></div>
                        <div class="info-item"><label>Lớp Học Phần</label><span><?php echo $q['tenlophocphan'] ?></span></div>
                        <div class="info-item"><label>Loại Học Phần</label><span><?php echo $q['loaihp'] ?></span></div>
                        <div class="info-item"><label>Tín Chỉ</label><span><?php echo $q['soTC'] ?> (LT: <?php echo $q['TCLT'] ?> - TH: <?php echo $q['TCTH'] ?>)</span></div>
                        <div class="info-item"><label>Ngày Học LT</label><span><?php echo $q['thuhocLT'] ?>&nbsp;|&nbsp;Tiết: <?php echo $q['tietbatdauLT'] ?>-<?php echo $q['tietketthucLT'] ?>&nbsp;|&nbsp;PH: <?php echo $q['phonghocLT'] ?></span></div>
                        <?php if($q['loaihp']=='LT & TH'){ ?>
                        <div class="info-item"><label>Ngày Học TH</label><span><?php echo $q['thuhocTH'] ?>&nbsp;|&nbsp;Tiết: <?php echo $q['tietbatdauTH'] ?>-<?php echo $q['tietketthucTH'] ?>&nbsp;|&nbsp;PH: <?php echo $q['phonghocTH'] ?></span></div>
                        <?php } ?>
                    </div>
                    <?php $g=$r1['id_giangvien'];
                    $sql="select * from giangvien where id_giangvien='$g'";
                    $tt=mysql_query($sql);
                    $e=mysql_fetch_assoc($tt);
                    ?>
                    <input type="hidden" name="e" value="<?php echo $e['id_giangvien'] ?>" />
                    <div class="form-grid" style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="form-label">Giảng Viên Lý Thuyết</label>
                            <input type="text" value="<?php echo $e['hotengiangvien'] ?>" class="form-control-modern" disabled/>
                        </div>
                        <?php if($q['loaihp']=='LT & TH'){ ?>
                        <div class="form-group">
                            <label class="form-label">Chọn Giảng Viên TH</label>
                            <select name="d" class="form-control-modern">
                                <option value="<?php echo $r1['id_giangvienTH1']; ?>"><?php $n=$r1['id_giangvienTH1']; $sql="select *from giangvien where id_giangvien='$n'"; $ttgv=mysql_query($sql); $u=mysql_fetch_assoc($ttgv); echo $u['hotengiangvien']; ?></option>
                                <option value="<?php echo $r1['id_giangvienTH2']; ?>"><?php $m=$r1['id_giangvienTH2']; $sql="select *from giangvien where id_giangvien='$m'"; $ttgv=mysql_query($sql); $u=mysql_fetch_assoc($ttgv); echo $u['hotengiangvien']; ?></option>
                            </select>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if($e['hotengiangvien']==null){ } else{?>
                    <div class="form-actions" style="margin-top: 24px;">
                        <button type="submit" name="uk" class="btn btn-primary">
                            <i class="fas fa-check"></i> Xác Nhận
                        </button>
                    </div>
                    <?php } ?>
                </div>
                <p style="color: var(--text-light); font-style: italic; margin-top: 16px;">
                    <i class="fas fa-exclamation-circle"></i> Lưu ý: Đối chiếu theo chương trình khung chuyên ngành sinh viên đang theo học để áp cứng học phần hợp lý
                </p>
                <?php } ?>
            </form>

            <div class="section-box" style="margin-top: 24px;">
                <h4><i class="fas fa-list"></i> Danh Sách Sinh Viên Đã Áp Cứng Môn Học</h4>
                <div class="table-wrapper" style="border: none;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ Tên SV</th>
                                <th>MSSV</th>
                                <th>Lớp HP</th>
                                <th>Môn HP</th>
                                <th>Tín Chỉ</th>
                                <th style="text-align: center;">Chi Tiết</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:10;
                            $tranghientai=!empty($_GET['page'])?$_GET['page']:1;
                            $start_from = ($tranghientai-1) * $bangghimoitrang;
                            $sql="select * from hoctap h join monlop m on h.id=m.id join hocphan hp on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan join ct_hocphan c on c.id_hocphan=hp.id_hocphan join sinhvien s on s.id_sinhvien=h.id_sinhvien limit $start_from,$bangghimoitrang";
                            $xtt=mysql_query($sql);
                            $sc="select count(id_hoctap) from hoctap h join monlop m on h.id=m.id join hocphan hp on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan join ct_hocphan c on c.id_hocphan=hp.id_hocphan join sinhvien s on s.id_sinhvien=h.id_sinhvien";
                            $st=mysql_query($sc);
                            $cot = mysql_fetch_row($st);  
                            $tongbangghi = $cot[0];  
                            $tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
                            $a=1;
                            $p=$_REQUEST['page'];
                            while($c=mysql_fetch_assoc($xtt)){
                            ?>
                            <tr>
                                <td class="stt"><?php 
                                if($p==2){ echo 10*($p-1)+$a++; }
                                else{ echo $a++; }?></td>
                                <td style="font-weight: 500;"><?php echo $c['tensinhvien']?></td>
                                <td><span class="badge badge-primary"><?php echo $c['masosinhvien']?></span></td>
                                <td><?php echo $c['tenlophocphan']?></td>
                                <td><?php echo $c['tenhocphan']?></td>
                                <td><?php echo $c['soTC'] ?></td>
                                <td style="text-align: center;">
                                    <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&xect=<?php echo $c['id_hoctap'] ?>" class="action-btn view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $c['id_sinhvien'] ?>&&ihp=<?php echo $c['id_hocphan'] ?>&&xoat=<?php echo $c['id_hoctap'] ?>" class="action-btn delete" onclick="return confirm('Bạn có chắc chắn?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    <?php include_once("Controller/cPageR.php"); ?>
                </div>
            </div>
        </div>
    </div>
<?php }
elseif(isset($_REQUEST['xect'])){ ?>
    <div class="content-card">
        <div class="card-header-custom">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3><i class="fas fa-info-circle"></i> Chi Tiết Học Phần Áp Cứng</h3>
            </div>
        </div>
        <div class="card-body-custom">
            <?php
            $xe=$_REQUEST['xect'];
            $sql="select * from monlop m join hoctap h on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan join ct_hocphan c on c.id_hocphan=hp.id_hocphan join sinhvien s on s.id_sinhvien=h.id_sinhvien where h.id_hoctap='$xe'";
            $xct=mysql_query($sql);
            $c=mysql_fetch_assoc($xct);
            ?>
            <div class="info-section">
                <h4><i class="fas fa-user-graduate"></i> Thông Tin Sinh Viên</h4>
                <div class="info-grid">
                    <div class="info-item"><label>Sinh Viên</label><span><?php echo $c['tensinhvien']?></span></div>
                    <div class="info-item"><label>MSSV</label><span><?php echo $c['masosinhvien']?></span></div>
                </div>
            </div>
            <div class="info-section">
                <h4><i class="fas fa-book"></i> Thông Tin Học Phần</h4>
                <div class="info-grid">
                    <div class="info-item"><label>Lớp Học Phần</label><span><?php echo $c['tenlophocphan']?></span></div>
                    <div class="info-item"><label>Môn Học</label><span><?php echo $c['tenhocphan']?></span></div>
                    <div class="info-item"><label>Số Tín Chỉ</label><span><?php echo $c['soTC']?></span></div>
                    <div class="info-item"><label>Tín Chỉ LT</label><span><?php echo $c['TCLT']?></span></div>
                    <div class="info-item"><label>Tín Chỉ TH</label><span><?php echo $c['TCTH']?></span></div>
                </div>
            </div>
            <div class="info-section">
                <h4><i class="fas fa-clock"></i> Lịch Giảng Dạy</h4>
                <div class="info-grid">
                    <div class="info-item"><label>Ngày Học LT</label><span><?php if($c['thuhocLT']==8){ echo "Chủ Nhật"; } else{ echo "T.".$c['thuhocLT']; }?></span></div>
                    <div class="info-item"><label>Tiết LT</label><span><?php echo $c['tietbatdauLT']?>&nbsp;-&nbsp;<?php echo $c['tietketthucLT'] ?></span></div>
                    <div class="info-item"><label>Phòng Học LT</label><span><?php echo $c['phonghocLT'] ?></span></div>
                    <?php $e=$c['id'];
                    $sql="select * from giangvien g join giangday gd on g.id_giangvien=gd.id_giangvien join monlop m on m.id=gd.id join hoctap h on h.id=m.id join hocphan hp on hp.id_hocphan=m.id_hocphan join ct_hocphan c on c.id_hocphan=hp.id_hocphan where m.id='$e'"; 
                    $qr=mysql_query($sql);
                    $r=mysql_fetch_assoc($qr);
                    ?>
                    <div class="info-item"><label>GV Lý Thuyết</label><span><?php echo $r['hotengiangvien'];?></span></div>
                    <?php if($r['loaihp']=="LT & TH"){ ?>
                    <div class="info-item"><label>Ngày Học TH</label><span><?php if($c['thuhocTH']==8){ echo "Chủ Nhật"; } else{ echo "T.".$c['thuhocTH'];} ?></span></div>
                    <div class="info-item"><label>Tiết TH</label><span><?php echo $c['tietbatdauTH']?>&nbsp;-&nbsp;<?php echo $c['tietketthucTH'] ?></span></div>
                    <div class="info-item"><label>Phòng Học TH</label><span><?php echo $c['phonghocTH'] ?></span></div>
                    <div class="info-item"><label>GV Thực Hành</label><span><?php $j=$c['id_giangvienTH']; $sql="select * from giangvien where id_giangvien='$j'"; $qr=mysql_query($sql); $w=mysql_fetch_assoc($qr); echo $w['hotengiangvien']; ?></span></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php }
else{ ?>
    <div class="content-card">
        <div class="card-body-custom">
            <div class="info-section">
                <h4><i class="fas fa-info-circle"></i> Giới thiệu chức năng "Quản Lý Học Phần"</h4>
                <p style="color: var(--text-secondary); line-height: 1.8;">Đây là các chức năng nền tảng và cơ bản cần có để thống nhất hệ thống một cách chuyên nghiệp. Vì lý do trên, hệ thống được tích hợp các chức năng có thể quản lý dễ dàng hơn. Các chức năng gồm có: Quản lý Môn Học Phần, Lớp Học Phần, Phân Giảng Viên, Phân Sinh Viên - đều được tạo ra và hỗ trợ thêm bằng Excel giúp xử lý công việc nhanh hơn.</p>
            </div>
            <div style="text-align: center; margin-top: 24px;">
                <p style="color: var(--text-light);">Chọn một tab phía trên để bắt đầu quản lý</p>
            </div>
        </div>
    </div>
<?php } ?>
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
                    <li><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&mhp"><i class="fas fa-chevron-right"></i> Môn Học Phần</a></li>
                    <li><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&lhp"><i class="fas fa-chevron-right"></i> Lớp Học Phần</a></li>
                    <li><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&gv-hp"><i class="fas fa-chevron-right"></i> GV - Học Phần</a></li>
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
