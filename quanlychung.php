<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Chung</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
a{
		color:#000;
}
a:hover{
		color:#000;
}
</style>
</head>

<body>
<div class="container mw-100 border">
<div class="row header"  id="codinh">
<!--Đây là phần banner-->
<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Gọi Điện: 0143.234.563 - ext 808 &nbsp; &nbsp; Email: csm@gmail.com</p> 
</div>
</div>
<br />
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

<div class="row">
	&nbsp;&nbsp;<?php if(isset($_REQUEST['qlkv'])){
		?>
        <button style="background-color:#FFF;"><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv">Quản Lý Khoa/Viện</a></button>
        <?php
		}
		else{
			?><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlkv">Quản Lý Khoa/Viện</a></button>
			<?php }?>
            &nbsp;&nbsp;
    &nbsp;
    <?php if(isset($_REQUEST['qlcn'])){
		?>
        <button style="background-color:#FFF;"><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn">Quản Lý Chuyên Ngành</a></button>
        <?php
		}
		else{
			?><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlcn">Quản Lý Chuyên Ngành</a></button>
			<?php }?>
    <?php /* if(isset($_REQUEST['qlhk'])){
		?>
		&nbsp;&nbsp;
    &nbsp;
        <button style="background-color:#FFF;"><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlhk">Quản Lý Học Kỳ</a></button>
        <?php
		}
		else{
			?><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qlhk">Quản Lý Học Kỳ</a></button>
			<?php }*/ ?>
            
            &nbsp;&nbsp;&nbsp;
    <?php if(isset($_REQUEST['qltt'])){
		?>
        <button style="background-color:#FFF;"><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qltt">Quản Lý Tin Tức</a></button>
        <?php
		}
		else{
			?><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>&&qltt">Quản Lý Tin Tức</a></button>
			<?php }?>
</div>
<br />

<div class="row">
	<?php
	if(isset($_REQUEST['qlkv'])){
		?>
       		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <?php
			if(isset($_REQUEST['themkv'])){
				?>
                <center><h5>Thêm Mới Khoa/Viện</h5></center>
                <p></p>
                <form action="#" method="post" enctype="multipart/form-data">
                <center>Mã Khoa/Viện:&nbsp;<input type="text" name="a" required="required" />&nbsp;&nbsp;
                Tên Khoa/Viện:&nbsp;<input type="text" name="b" required="required" />
                </center>
                <p></p>
                <center><input type="submit" name="them" value="Thêm" /></center>
                </form>
                <?php
			}
			elseif(isset($_REQUEST['themkve'])){
				?>
                <center><h5>Thêm Mới Khoa/Viện</h5></center>
                <p></p>
                <form action="#" method="post" enctype="multipart/form-data">
                <center>Up File Excel: &nbsp; <input type="file" name="f" required="required" /></center>
                <p></p>
                <center><input type="submit" name="theme" value="Thêm" /></center>
                </form>
                <br />
                <center>&nbsp;<a href="taixuong.php?fu=Tao_Moi_Khoa_Vien.xlsx"><img src=
        "https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" height="20px" width="20px" />&nbsp;&nbsp;<a href="taixuong.php?fu=Tao_Moi_Khoa_Vien.xlsx">Mẫu Excel Thêm Mới Khoa/ Viện</a> . Vui lòng tải xuống !</center>
                <?php
			}
			elseif(isset($_REQUEST['suakv'])){
				$id=$_REQUEST['suakv'];
				$sql="select * from khoavien where id_khoa='$id'";
				$qr=mysql_query($sql);
				$kv=mysql_fetch_assoc($qr);
				?>
                 <center><h5>Sửa Khoa/Viện</h5></center>
                <p></p>
                <form action="#" method="post" enctype="multipart/form-data">
                <center>Mã Khoa/Viện:&nbsp;<input type="text" name="a" value="<?php echo $kv['makhoa'] ?>" required="required" />&nbsp;&nbsp;
                Tên Khoa/Viện:&nbsp;<input type="text" name="b" value="<?php echo $kv['tenkhoa'] ?>" required="required" />
                </center>
                <p></p>
                <center><input type="submit" name="sua" value="Sửa" /></center>
                </form>
                <?php
			}
			else{
            ?>
            <table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Mã Khoa</th>
                        <th>Tên Khoa</th>
                        <th><center>Sửa</center></th>
                        <th><center>Xóa</center></th>
                    </tr>
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
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $k['makhoa']; ?></td>
                        <td><?php echo $k['tenkhoa'];?></td>
                        <td><center><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&suakv=<?php echo $k['id_khoa'] ?>">Sửa</a></center></td>
                        <td><center><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&xoakv=<?php echo $k['id_khoa']?>">Xóa</a></center></td>
                    </tr>
                   <?php
					}
					$a++;
				   ?>
                </thead>
            </table>
            
            <br />
            <center><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&themkv">Thêm</a></button>
            <!-- &nbsp;|&nbsp;<button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlkv&&themkve">Thêm <img src="https://tse2.mm.bing.net/th?id=OIP.t_lBLLB7N4IOIAcQoIWMFwHaHa&pid=Api&P=0&h=20" /></a></button></center> -->
            <br />
            <center><a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse4.mm.bing.net/th?id=OIP.GcRlpNTMNf06GOD3l3pILgHaHa&pid=Api&P=0&h=180"
height="30px" width="30px" /></a></center>
<br />
            <?php } ?>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
        <?php
	}
	elseif(isset($_REQUEST['qlcn'])){
		?>
       		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <br />
            <?php
            if(isset($_REQUEST['themcn'])){
				?>
                <center><h5>Thêm Mới Chuyên Ngành</h5></center>
                <p></p>
                <form action="#" method="post" enctype="multipart/form-data">
                <center>Mã Chuyên Ngành:&nbsp;<input type="text" name="a" required="required" />&nbsp;&nbsp;
                Tên Chuyên Ngành:&nbsp;<input type="text" name="b" required="required" />
                <br />
                <br />
                Chọn Khoa/Viện: &nbsp;<select name="c">
               <?php
			   $sm="select * from khoavien";
					$q=mysql_query($sm);
					$a=1;
					while($cn=mysql_fetch_assoc($q)){
			   ?>
                <option value="<?php echo $cn['id_khoa'] ?>"><?php echo $cn['tenkhoa'] ?></option>
               <?php } ?>
                </select>
                </center>
                <p></p>
                <center><input type="submit" name="themc" value="Thêm" /></center>
                <?php
			}
			elseif(isset($_REQUEST['themcne'])){
				?>
                <center><h5>Thêm Mới Chuyên Ngành</h5></center>
                <p></p>
                <form action="#" method="post" enctype="multipart/form-data">
                <br />
                	<center>Up File Excel: &nbsp;<input type="file" name="f" /></center>
                    <br />
                    <center><input type="submit" value="Thêm" name="tecn" /></center>
                </form>
                <br />
                <center>&nbsp;<a href="taixuong.php?fu=Tao_Moi_Chuyen_Nganh.xlsx"><img src=
        "https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" height="20px" width="20px" />&nbsp;&nbsp;<a href="taixuong.php?fu=Tao_Moi_Chuyen_Nganh.xlsx">Mẫu Excel Thêm Mới Chuyên Ngành</a> . Vui lòng tải xuống !</center>
                <?php
			}
			elseif(isset($_REQUEST['suacn'])){
				?>
                <center><h5>Sửa Chuyên Ngành</h5></center>
                 <?php
			   $suacn=$_REQUEST['suacn'];
			   $sm="select * from chuyennganh c join khoavien k on c.id_khoa=k.id_khoa where 
			   c.id_chuyennganh='$suacn'";
			   $q=mysql_query($sm);
			   $cn=mysql_fetch_assoc($q);
			   ?>
                <p></p>
                <form action="#" method="post" enctype="multipart/form-data">
                <center>Mã Chuyên Ngành:&nbsp;<input type="text" name="a" value="<?php echo $cn['machuyennganh'] ?>" required=
                "required" />&nbsp;&nbsp;
                Tên Chuyên Ngành:&nbsp;<input type="text" name="b" required="required" value="<?php echo $cn['tenchuyennganh'] ?>" />
                <br />
                <br />
                Khoa/Viện: &nbsp;<select name="c">
                <option class="btn-info" value="<?php echo $cn['id_khoa'] ?>"><?php echo $cn['tenkhoa'] ?></option>
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
                </center>
                <p></p>
                <center><input type="submit" name="suac" value="Sửa" /></center>
                <?php
			}
			else{
			?>
              <table class="table table-bordered">
              	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Mã Chuyên Ngành</th>
                        <th>Tên Chuyên Ngành</th>
                        <th>Khoa</th>
                        <th><center>Sửa</center></th>
                        <th><center>Xóa</center></th>
                    </tr>
                    <?php
					$sm="select * from khoavien k join chuyennganh c on k.id_khoa=c.id_khoa";
					$q=mysql_query($sm);
					$a=1;
					while($cn=mysql_fetch_assoc($q)){
					?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $cn['machuyennganh']?></td>
                        <td><?php echo $cn['tenchuyennganh']?></td>
                        <td><?php echo $cn['tenkhoa']?></td>
                        <td><center><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlcn&&suacn=<?php echo $cn[
						'id_chuyennganh'] 
						?>">Sửa</a></center></td>
                        <td><center>
                        <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlcn&&xoacn=<?php echo $cn['id_chuyennganh'] 
						?>">Xóa</a></center></td>
                    </tr>
                    <?php
					}
					$a++;
					?>
                </thead>
              </table>
              <br />
              <center><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qlcn&&themcn">Thêm</a></button>
              </center>
              <br />
            <center><a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse4.mm.bing.net/th?id=OIP.GcRlpNTMNf06GOD3l3pILgHaHa&pid=Api&P=0&h=180"
height="30px" width="30px" /></a></center>
<br />
              <?php } ?>
            <br />
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
        <?php
	}
	elseif(isset($_REQUEST['qlhk'])){
		?>
       		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
        <?php
	}
	elseif(isset($_REQUEST['qltt'])){
		?>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <?php
		if(isset($_REQUEST['themtt'])){
			?>
            <center><h5>Thêm Mới Tin Tức</h5></center>
                <br />
                <form action="#" method="post" enctype="multipart/form-data">
                   <center> Up File Excel:&nbsp;<input type="file" name="f" /></center>
                   <p></p>
                   <center><input type="submit" name="dtl" value="Tải Lên" /></center>
                   
                </form>
                <br />
            <?php
		}
		else{
		?>
        <?php
		if(isset($_REQUEST['xe'])){
			?>
            <br />
            
            <?php
			$x=$_REQUEST['xe'];
			$sql="select * from tintuc where id_tintuc='$x'";
			$qr=mysql_query($sql);
			$e=mysql_fetch_assoc($qr);
			?>
            <h4><?php echo $e['tieude'] ?></h4>
            <p></p>
            <i><strong>Tác giả:</strong> &nbsp;<?php echo $e['tieude'] ?></i>&nbsp;|&nbsp;<i><strong>Ngày Đăng:</strong>&nbsp;<?php echo $e['ngaydangtai'] ?></i>
            <p></p>
            <?php echo $e['noidung'] ?>
            <p></p>
            <?php
		}
		else{
		?>
            <table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Ảnh Đại Diện</th>
                        <th>Tiêu Đề</th>
                        <th>Ngày Đăng Tải</th>
                        <th>Tác Giả</th>
                        <th>Xem Chi Tiết</th>
                        <th>Xóa</th>
                    </tr>
                    <?php
					$sql="select * from tintuc";
					$qr=mysql_query($sql);
					$a=1;
					while($r=mysql_fetch_assoc($qr)){
                        // var_dump($r);
                        // exit;
					?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><img src="<?php echo $r['anhdaidien']?>" height="100px" width="160px" /></td>
                        <td><?php echo $r['tieude']?></td>
                        <td><?php echo $r['ngaydangtai']?></td>
                        <td><?php echo $r['tacgia']?></td>
                        <td><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qltt&&xe=<?php echo $r['id_tintuc'] ?>">Chi 
                        Tiết</a></td>
                        <td><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qltt&&xoatt=<?php echo $r['id_tintuc'] ?>">Xóa
                        </a></td>
                    </tr>
                    <?php
					}
					$a++;
					?>
                </thead>
            </table>
            <br />
            <center><button><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm'] ?>&&qltt&&themtt">Thêm +</a></button></center>
            <br />
            <center><a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse4.mm.bing.net/th?id=OIP.GcRlpNTMNf06GOD3l3pILgHaHa&pid=Api&P=0&h=180"
height="30px" width="30px" /></a></center>
<br />
            <?php
		}
		?>
            <br />
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
        <?php
		}
	}
	else{
		?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
            <br />
           <h5> &nbsp;&nbsp;Giới thiệu chức năng "Quản Lý Chung"</h5>
            <p></p>
            &nbsp;&nbsp; Đây là các chức năng nền tảng và cơ bản cần có để thống nhất hệ thống một cách chuyên nghiệp.
            <br />
            &nbsp;&nbsp; Vì lý do ở trên, mà hệ thống được tích hợp các chức năng có thể quản lý dễ dàng hơn,...
            <br />
            &nbsp;&nbsp; Các chức năng gồm có : Chức năng A, B, C ,... đều được tạo ra và hỗ trợ thêm bằng Excel chắc chắn giúp xử lý 
            công việc nhanh hơn.
            <br />
            &nbsp;&nbsp; ...
            <br />
            <br />
            </div>
        <?php
	}
	?>
</div>
</div>

<br />
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="col-xs-4 col-sm-4 col-md-44 col-lg-4">
        <br />
       <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" height="75px" width="100px" />
        <p></p>
        <p>Chào Mừng Các Bạn Đến Với Hệ Thống ...</p>
        <br />
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p></p>
        <h5>Liên Kết</h5>
        <p></p>
        - Link Liên Kết 1<p></p>
        - Link Liên Kết 2<p></p>
        - ...
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p></p>
        <h5>Liên Hệ</h5>
        <p></p>
        Trung Tâm Quản Trị Hệ Thống - Trường ...
        <p></p>
        <img src="https://tse4.mm.bing.net/th?id=OIP.VMPvKsUQ9Q91rlEDRqsj8AHaHa&pid=Api&P=0&h=180" height="30px" width="30px" /> &nbsp; Phone :&nbsp;0143.234.563<p></p>
         <img src="https://tse3.mm.bing.net/th?id=OIP.Ye2A24tF7KlssZxi_cffWwHaGD&pid=Api&P=0&h=180" height="30px" width="30px" /> &nbsp; Email :&nbsp;abc@gmail.com
        
        </div>
     </div>
     </div>

</div>
</body>
</html>