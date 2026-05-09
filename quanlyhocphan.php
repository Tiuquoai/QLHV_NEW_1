 <?php
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
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 20*1024*1024) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
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
$kn= $p->ketnoi($ketnoi);
if($kn){
// Kiểm tra file tải lên có chính xác hông nè ???
$tdmssv= $sheet->getCellByColumnAndRow(1,1)->getValue();
$tdhvt= $sheet->getCellByColumnAndRow(2,1)->getValue();
if($tdmssv!='MSSV' || $tdhvt!="Họ Và Tên"){
	echo "<script>alert('File Excel tải lên phân công sinh viên vào học phần không chính xác !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
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
					/* Trùng không thêm nữa */
				}
				elseif(mysql_num_rows($k3)==1){
					/* Trùng không thêm nữa */
				}
				else{
				$sql="insert into hoctap(id) select id from monlop where id_hocphan='$ihp' and id_lophocphan='$il'";
				$qr=mysql_query($sql);
				$sql1="update hoctap set id_sinhvien='$is', id_giangvienTH='$ith' where id=(select id from monlop where 
				id_hocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='')";
				$qr1=mysql_query($sql1);
				$sql3="insert into dkhp(id_sinhvien,id_hocphan,ngaydk) values ('$is','$ihp', now())";
				$qr3=mysql_query($sql3);
				/* echo header('refresh:0,url="quanlyhocphan.php?bm='.$_REQUEST['bm'].'&&sv-hp"'); */
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Phần</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
a:link{
	color:#000;
}
a:hover{
	color:#000;
}
a{
	color: #000;
}
.cs{
	background-color:#FFF;
}
.sticky {
  position:fixed;
  top: -15px;
  padding-top:15px;
  width:100%;
  height:10px;
  z-index:8;
  background-color:rgba(255,255,255,0.92);
  box-shadow:0.1px 0.1px 0.1px yellow;
}
.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
@media(min-width:246px) and (max-width:1000px){

		.table th, .table td {
    padding: 0rem !important;
		}
		html{
			    -webkit-text-size-adjust: 85%;
		}
		body{
			font-size:1.12rem;
		}
		.container {
    max-width: 1000px;
}
body{
	font-size: 25px;
	font-weight: 300;
}
h5{
	font-size:30px;
}
		
}
@media (max-width: 245px){
body {
    width: 100px !important;
    margin-left: -12px;
    font-size: 5px;
}
}
</style>
</head>

<body>
<div class="container mw-100 full-width-div border">

<div class="row header"  id="codinh">
<!--Đây là phần banner-->
<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Trang Admin Hệ Thống</p> 
<br>
</div>
<p></p>
</div>
<p></p>
<div class="row">
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
     <?php if(isset($_REQUEST['mhp'])){
		?>
		<button class="cs"><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&mhp">Môn Học Phần</a></button>
        <?php
    }
    else{
		?>
<button><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&mhp">Môn Học Phần</a></button>

<?php }?>
	</div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <?php if(isset($_REQUEST['lhp'])){
		?>
		<button class="cs"><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&lhp">Lớp Học Phần</a></button>
        <?php
    }
    else{
		?>
<button><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&lhp">Lớp Học Phần</a></button>
<?php }?>
	</div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <?php 
	if(isset($_REQUEST['gv-hp'])){
		?>
        <button class="cs"><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&gv-hp">GV - Học Phần</a></button>
        <?php
	}
	else{
	?>
<button><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&gv-hp">GV - Học Phần</a></button>
<?php
	}
?>
	</div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <?php
	if(isset($_REQUEST['sv-hp'])){ 
	?>
    <button class="cs"><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&sv-hp">SV - Học Phần</a></button>
    <?php }
	else{?>
<button><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'];?>&&sv-hp">SV - Học Phần</a></button>
<?php } ?>
	</div>
</div>
<p></p>
<?php if(isset($_REQUEST['mhp'])){
	?>
    <div class="border">
    
    <center>
    <p></p>
    	<table class="table-bordered col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	<thead>
            	<tr>
                	<th>STT</th>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Xem</th>
                    <th>Xóa</th>
                </tr>
                <?php
				include_once("Controller/cTKADHT.php");
				$p=new cTKAD();
				$ci=$p->dsmhp();
				$a=1;
				while($c=mysql_fetch_assoc($ci)){ 
				?>
                <tr>
                	<td><?php echo $a++; ?></td>
                    <td><?php echo $c['mahocphan']?></td>
                    <td><?php echo $c['tenhocphan']?></td>
                    <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&xem=<?php echo md5($c['mahocphan'])?>">Xem</a></td>
                    <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&xoaihp=<?php echo md5($c['id_hocphan'])?>">Xóa</a></td>
                </tr>
                    <?php
				}
				$a++;
				?>
                
            </thead>
        </table>
        <p></p>
        <button><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&themhp">Thêm+</a></button>
    <p></p>
    </center>
    </div>
    <?php
}
elseif(isset($_REQUEST['xoaihp'])){
	$p->xoahp();
	$p->xoahp1();
	$sql="delete from lophocphan l join monlop m on l.id_lophocphan=m.id_lophocphan
	join hocphan h on h.id_hocphan=m.id_hocphan where md5(m.id_hocphan)='$id'";
	$qr=mysql_query($sql);
	echo header("refresh:0,url='quanlyhocphan.php?bm=".$_REQUEST['bm']."&&mhp'");
	
}
elseif(isset($_REQUEST['xem'])){
	?>
    <div class="border">
    <br />
    <br />
    <br />
    <center><h5>THÔNG TIN HỌC PHẦN&nbsp;&nbsp;
    <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xem=<?php echo $_REQUEST['xem'] ?>&&ihp=<?php
	$ci=$p->dsmhp();
	$c=mysql_fetch_assoc($ci);
	$xem=$_REQUEST['xem'];
	$sql="select * from hocphan where md5(mahocphan)='$xem'";
	$qr=mysql_query($sql);
	$s=mysql_fetch_assoc($qr);
	echo md5($s['id_hocphan']);
    ?>&&suahp"><img src="https://tse1.mm.bing.net/th?id=OIP.B7zOpV_oMJAcGd85aSujHQHaHa&pid=Api&rs=1&c=1&qlt=95&w=99&h=99" height="20px" width="20px"/></h5></a></center>
    <p></p>
    <?php 
	include_once("Controller/cTKADHT.php");
	$p= new cTKAD();
	$a=mysql_fetch_assoc($p->xemct());
	?>
    <div class="row">
    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 border">
        <?php
		if(isset($_REQUEST['suahp'])){
			?>
            <form action="#" method="post" enctype="multipart/form-data">
            <strong>Tên Học Phần: &nbsp;</strong><input type="text" name="a" value="<?php echo $a['tenhocphan'] ?>" size="50" required="required" />
        <br />
  <strong>  Mã Học Phần:&nbsp;</strong><input type="text" name="b" value="<?php echo $a['mahocphan'] ?>" disabled="disabled" />
        <br />
       <strong> Loại Học Phần: &nbsp;</strong><input type="text" name="m" value="<?php echo $a['loaihp'] ?>" required="required"/>
       <br />
  <strong>  Số Tín Chỉ:&nbsp;</strong><input type="text" name="c" value="<?php echo $a['soTC'] ?>" size="1" required="required"/>
        <br />
  <strong>  Số Tín Chỉ LT:&nbsp;</strong><input type="text" name="d" value="<?php echo $a['TCLT'] ?>"  size="1" required="required"/>
        <br />
  <strong>  Số Tín  Chỉ TH:&nbsp;</strong><input type="text" name="e" value="<?php echo $a['TCTH'] ?>" size="1" required="required"/>
        <br />
       
  <strong>  Khoa Chủ Quản:&nbsp;</strong> <select name="g">
  <option value="<?php echo $a['id_khoa'] ?>" class="btn-info"><?php echo $a['tenkhoa'] ?></option><?php
		include_once("Model/mKetNoiADHT.php");
		$p=new ketnoiAD();
		$kn=$p->ketnoi();
		if($kn){
			$sql="select *from khoavien";
			$qr=mysql_query($sql);
			while($b=mysql_fetch_assoc($qr)){
				?>
                <option value="<?php echo $b['id_khoa'] ?>"><?php echo $b['tenkhoa']; ?></option>
                <?php
				
			}
			
		}
		
		?>
        </select>
        <br />
        <p></p>
        <center><input type="submit" name="s1" value="Lưu Thay Đổi" /></center>
        <br />
            </form>
        
            <?php
		}
		else{
		?>
        <strong>Tên Học Phần: &nbsp;</strong><?php echo $a['tenhocphan'] ?>
        <br />
  <strong>  Mã Học Phần:&nbsp;</strong><?php echo $a['mahocphan'] ?>
        <br />
        <strong>Loại Học Phần:&nbsp;</strong><?php echo $a['loaihp'] ?>
        <br />
  <strong>  Số Tín Chỉ:&nbsp;</strong><?php echo $a['soTC'] ?>
        <br />
  <strong>  Số Tín Chỉ LT:&nbsp;</strong><?php echo $a['TCLT'] ?>
        <br />
  <strong>  Số Tín  Chỉ TH:&nbsp;</strong><?php echo $a['TCTH'] ?>
        <br />
  <strong>  Khoa Chủ Quản:&nbsp;</strong><?php echo $a['tenkhoa'] ?>
        <br />
        <?php
		} 
		?>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        </div>
    </div>
    <p></p>
    <br />
    <br />
    <br />
    </div>
    <?php
}
elseif(isset($_REQUEST['themhp'])){
	?>
     
   <div class="border">
   <p></p>
   <center><h5>Thêm Môn Học Phần</h5></center>
   <p></p>
	<form action="#" method="POST" enctype="multipart/form-data">
    <br />
    <center>
    	Tải File Excel để tạo thêm học phần tại đây ! 
        <p></p>
        &nbsp;<input type="file" name="f" required="required"  />
        <p></p>
        &nbsp;<input type="submit" value="Tải lên" name="submit" />
        <p></p>
        <p>Đây là mẫu dữ liệu file nhập để tạo học phần. Để lấy 
        file mẫu vui lòng bấm tải xuống !</p>
        <a href="taixuong.php?fu=Tao_Hoc_Phan.xlsx"><img src=
        "https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" height="20px" width="20px" /></a>
        &nbsp;&nbsp;<a href="taixuong.php?fu=Tao_Hoc_Phan.xlsx">Mau_Tao_Hoc_Phan.xlsx</a>
        <p></p>
        <center><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>&&mhp"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
    </form>
    </center>
    <br />
   </div>
   <?php
if(isset($_REQUEST['themhp'])){
if(isset($_FILES['f'])) {
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["uploaded_file"]["size"];
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 30000000) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
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
$chp=  $sheet->getCellByColumnAndRow(0,1)->getValue();
$ck=  $sheet->getCellByColumnAndRow(6,1)->getValue();
if($chp!="Mã Học Phần" || $ck!="Khoa ( Lấy Theo Mã Khoa )"){
	echo "<script>alert('File Excel Tải Lên Để Thêm Học Phần Không Đúng ! ')</script>";
}
else{

for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
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
	if(mysql_num_rows($qr)==1){
		/* Kiểm tra có tên tồn tại sẽ không được thêm vào nhe ! */
	}
	elseif(mysql_num_rows($qr1)==1){
		/* Kiểm tra có tên tồn tại sẽ không được thêm vào nhe ! */
	}
	elseif($mahp==null){
		/* Kiểm tra không có mã ko thêm vào */
	}
	else
	{
	 $sql="insert into hocphan(mahocphan,tenhocphan,id_khoa) values ('$mahp','$tenhp','$idkhoa')";
	 $qr=mysql_query($sql);
	 $sq2="insert into ct_hocphan(id_hocphan) select id_hocphan from hocphan where mahocphan='$mahp'";
     $qr2=mysql_query($sq2);
	 $sq3="update ct_hocphan set loaihp='$loaihp', soTC='$stc',
	 TCLT='$tclt', TCTH='$tcth'
	 where id_hocphan=(select id_hocphan from hocphan where mahocphan='$mahp' )";
     $qr3=mysql_query($sq3);
	}
}
}
}


else{
}
} catch(Exception $e) {
    
}

        } else {
            
        }
	}
	}
}
}
?>
    <?php
}
elseif(isset($_REQUEST['lhp'])){
	?>
    <div class="border">
    
    <center>
    <p></p>
    	<table class="table-bordered col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	<thead>
            	<tr>
                	<th>STT</th>
                    <th>Mã Lớp Học Phần</th>
                    <th>Tên Lớp Học Phần</th>
                    <th>Tên Môn Học Phần</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                <?php
				include_once("Controller/cTKADHT.php");
				$p=new cTKAD();
				$ci=$p->dslhp();
				$a=1;
				while($c=mysql_fetch_assoc($ci)){ 
				?>
                <tr>
                	<td><?php echo $a++; ?></td>
                    <td><?php echo $c['malophocphan']?></td>
                    <td><?php echo $c['tenlophocphan']?></td>
                    <td><?php echo $c['tenhocphan']?></td>
                    <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&idlhp=<?php echo md5($c['id_lophocphan']) ?>&&sualhp">Sửa</a></td>
                    <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&idlhp=<?php echo md5($c['id_lophocphan']) ?>&&xoalhp">Xóa</a></td>
                </tr>
                    <?php
				}
				$a++;
				?>
                
            </thead>
        </table>
        <p></p>
        <button><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&themlhp">Thêm +</a></button>
    <p></p>
    </center>
    </div>
    <?php
}
elseif(isset($_REQUEST['sualhp'])){
	?>
    <p></p>
    <div class="border">
    <div class="row">
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    </div>
     <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    <center><h5>Sửa Thông Tin Lớp Học Phần</h5></center>
    <p></p>
    <p></p>
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
	else{
	}
	?>
    <form action="#" method="post" enctype="multipart/form-data">
    Mã Lớp Học Phần: <input type="text" name="a" value="<?php echo $a['malophocphan'] ?>" required="required" /> &nbsp; Tên Lớp Học Phần: &nbsp;<input type="text"
    name="b" value="<?php echo $a['tenlophocphan'] ?>" />&nbsp;<p></p>Tên Môn Học Phần: &nbsp;
    <input type="text" disabled="disabled" value="<?php echo $a['mahocphan'] ?>&nbsp;-&nbsp;<?php echo $a['tenhocphan'] ?>" size="50" />
    <p></p>
    Ngày Học LT ( Thứ ) : <select name="c">
    <option value="<?php echo $a['thuhocLT'] ?>" class="btn-info"><?php echo $a['thuhocLT'] ?></option>
    <option value="2">2</option>
     <option value="3">3</option>
      <option value="4">4</option>
       <option value="5">5</option>
        <option value="6">6</option>
         <option value="7">7</option>
          <option value="8">Chủ Nhật</option>
    </select>&nbsp;Tiết LT Từ:&nbsp;<select name="d">
    <option value="<?php echo $a['tietbatdauLT'] ?>" class="btn-info" ><?php echo $a['tietbatdauLT'] ?></option>
    <option value="1">1</option>
     <option value="4">4</option>
      <option value="7">7</option>
       <option value="10">10</option>
        <option value="13">13</option>
    </select>
    &nbsp;Đến Tiết: &nbsp;<select name="e">
    <option value="<?php echo $a['tietketthucLT'] ?>" class="btn-info" ><?php echo $a['tietketthucLT'] ?></option>
    <option value="3">3</option>
     <option value="6">6</option>
      <option value="9">9</option>
       <option value="12">12</option>
        <option value="15">15</option>
    </select>
    <p></p>
    Phòng Học LT: <input type="text" name="i" value="<?php echo $a['phonghocLT'] ?>" required="required" />
    <p></p>
    <?php
	include_once("Model/mKetNoiADHT.php");
	$p=new ketnoiAD();
	$ma=$a['mahocphan'];
	$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
	where hp.mahocphan='$ma'";
	$qr=mysql_query($sql);
	$r=mysql_fetch_assoc($qr);
	if($r['loaihp']=='LT & TH'){
	?>
     Ngày Học TH ( Thứ ) : <select name="f">
    <option value="<?php echo $a['thuhocTH'] ?>" class="btn-info" ><?php echo $a['thuhocTH'] ?></option>
    <option value="2">2</option>
     <option value="3">3</option>
      <option value="4">4</option>
       <option value="5">5</option>
        <option value="6">6</option>
         <option value="7">7</option>
          <option value="8">Chủ Nhật</option>
    </select>&nbsp;Tiết TH Từ:&nbsp;<select name="g">
    <option value="<?php echo $a['tietbatdauTH'] ?>" class="btn-info" ><?php echo $a['tietbatdauTH'] ?></option>
    <option value="1">1</option>
     <option value="4">4</option>
      <option value="7">7</option>
       <option value="10">10</option>
        <option value="13">13</option>
    </select>
    &nbsp;Đến Tiết: &nbsp;<select name="h">
    <option value="<?php echo $a['tietketthucTH'] ?>" class="btn-info" ><?php echo $a['tietketthucTH'] ?></option>
    <option value="3">3</option>
     <option value="6">6</option>
      <option value="9">9</option>
       <option value="12">12</option>
        <option value="15">15</option>
    </select>
    <p></p>
    Phòng Học TH: <input type="text" name="k" value="<?php echo $a['phonghocTH'] ?>" required="required" />
    <p></p>
    <?php
	}
	else{
	}
	?>
    <center><input type="submit" name="capnhat" value="Cập Nhật" /></center>
    <p></p>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    </div>
    </div>
    </div>
    </form>
    <?php
}
elseif(isset($_REQUEST['themlhp'])){
	?>
    <div class="border">
    <p></p>
    <center><strong><h5>Thêm Lớp Học Phần</h5></strong></center>
    <div class="row">
    	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <p></p>
        <form action="#" method="post" enctype="multipart/form-data">
        <center>Mã Lớp Học Phần: &nbsp; <input type="text" name="a" required="required" />&nbsp;&nbsp;Tên Lớp Học Phần:&nbsp;
        <input type="text" name="b" required="required"  /></center>
        <p></p>
        <center>Môn Học Phần: <select name="c" onchange="window.location.href=this.value;" required>
        <?php
		include_once("Model/mKetNoiADHT.php");
		$p=new ketnoiAD();
		$kn=$p->ketnoi();
		$ih=$_REQUEST['ih'];
		$sql="select *from hocphan where id_hocphan='$ih'";
		$qr=mysql_query($sql);
		$m=mysql_fetch_assoc($qr);
		?>
        <option value="<?php echo $m['id_hocphan'] ?>" class="btn-info"><?php 
		if(isset($_REQUEST['ih'])){
			echo $m['mahocphan'].'&nbsp;-&nbsp;'.$m['tenhocphan'];
			} ?></option>
            <option value="">Vui lòng chọn</option>
		<?php
		include_once("Model/mKetNoiADHT.php");
		$p=new ketnoiAD();
		$kn=$p->ketnoi();
		if($kn){
			$sql="select *from hocphan";
			$qr=mysql_query($sql);
			while($a=mysql_fetch_assoc($qr)){
				?>
                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&themlhp&&ih=<?php echo $a['id_hocphan'] ?>"><?php echo $a['mahocphan'] ?>&nbsp;-&nbsp;<?php echo $a['tenhocphan'] ?></option>
                <?php
			}
		}
		?></select></center>
        <center><p></p>Ngày Học LT ( Thứ ) :&nbsp; <select name="d"><option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">Chủ Nhật</option>
        </select>&nbsp;&nbsp; Tiết LT Từ :&nbsp;<select name="f"><option value="1">1</option>
        <option value="4">4</option>
        <option value="7">7</option>
        <option value="10">10</option>
        <option value="13">13</option></select>&nbsp;&nbsp; Đến:&nbsp;<select name="g">
        <option value="3">3</option>
        <option value="6">6</option>
        <option value="9">9</option>
        <option value="12">12</option>
        <option value="15">15</option>
        </select></center>
        <p></p>
        <center>Phòng Học LT: <input type="text" name="e" required="required" /> &nbsp;</center>
        <p></p>
        <?php
		include_once("Model/mKetNoiADHT.php");
		$p=new ketnoiAD();
		$ih=$_REQUEST['ih'];
		$sql="select *from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan 
		where hp.id_hocphan='$ih'";
		$qr=mysql_query($sql);
		$n=mysql_fetch_assoc($qr);
		if($n['loaihp']=='LT & TH'){
		?>
        <center><p></p>Ngày Học TH ( Thứ ) :&nbsp; <select name="h"><option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">Chủ Nhật</option>
        </select>
        &nbsp; Tiết TH Từ :&nbsp;<select name="k"><option value="1">1</option>
        <option value="4">4</option>
        <option value="7">7</option>
        <option value="10">10</option>
        <option value="13">13</option></select>&nbsp;&nbsp; Đến:&nbsp;<select name="l">
        <option value="3">3</option>
        <option value="6">6</option>
        <option value="9">9</option>
        <option value="12">12</option>
        <option value="15">15</option>
        </select>
        <p></p>
        &nbsp;Phòng Học TH: <input type="text" name="m" required="required" /> &nbsp;
        <?php }
		else{
		}?>
        <p></p>
        <center><input type="submit" name="tl" value="Thêm" /></center>
        </form>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        </div>
    </div>
    <p></p>
    </div>
    <?php
}
elseif(isset($_REQUEST['gv-hp'])){
	?>
    <p></p>
    <div class="border">
    <p></p>
    <center><h5>Phân Giảng Viên ( Học Phần )</h5></center>
    <p></p>
    <div class="row">
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 border">
    <form action="#" method="post" enctype="multipart/form-data">
    <?php 
	include_once("Model/mKetNoiADHT.php");
	$p=new ketnoiAD();
	$kn=$p->ketnoi($ketnoi);
	if($kn){
		$sql="select * from giangvien gv join chuyennganh cn on gv.id_chuyennganh=cn.id_chuyennganh
		join khoavien kv on cn.id_khoa=kv.id_khoa";
		$qr=mysql_query($sql);
			?>
            <strong>Họ Tên Giảng Viên:</strong>  
            <select name="a" onchange="window.location.href=this.value;">
            <option value="<?php echo $_REQUEST['cgv'] ?>" class="btn-info"><?php
			if(isset($_REQUEST['tengv'])){
				echo $_REQUEST['tengv'];
			}
            ?></option>
            <?php while($c=mysql_fetch_assoc($qr)){
				?>
                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&tengv=<?php echo $c['hotengiangvien'] ?>&&cgv=<?php echo $c['id_giangvien'] ?>&&khoa=<?php echo $c['tenkhoa'] ?>"><?php echo $c['hotengiangvien'] ?></option>
            	 <?php
				}?>
            </select>
            &nbsp;<strong>Khoa/ Viện:</strong>&nbsp;<input type="text" disabled="disabled" value="<?php 
			include_once("Model/mKetNoiADHT.php");
			$p=new ketnoiAD();
			$kn=$p->ketnoi($ketnoi);
			if($kn){
				$a=$_REQUEST['tengv'];
				$sql="select * from giangvien gv join chuyennganh cn on gv.id_chuyennganh=cn.id_chuyennganh
				join khoavien kv on cn.id_khoa=kv.id_khoa where gv.hotengiangvien='$a'";
				$qr=mysql_query($sql);
			$f=mysql_fetch_assoc($qr);
			echo $f['tenkhoa'] ?>" />&nbsp; <input type="text" disabled="disabled" value="<?php echo $f['tenchuyennganh'] ?>" />
            <?php }?>
            <p></p>
            <strong>Môn Học Phần:</strong> &nbsp;&nbsp;
            <select name="b" onchange="window.location.href=this.value;">
            <option value="<?php echo $_REQUEST['idhocphan'] ?>" class="btn-info" ><?php
			if(isset($_REQUEST['idhocphan'])){
				echo $_REQUEST['mahp']."&nbsp;-&nbsp;".$_REQUEST['monhocphan'];
			}
			?></option>
            	<?php 
				$k=$_REQUEST['khoa'];
				$sql1="select * from hocphan hp join khoavien k on hp.id_khoa=k.id_khoa
				where k.tenkhoa='$k' ";
				$qr1=mysql_query($sql1);
				while($d=mysql_fetch_assoc($qr1)){
				?>
                <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&tengv=<?php echo $_REQUEST['tengv'] ?>&&&&cgv=<?php 
				echo $_REQUEST['cgv'];?>&&mahp=<?php echo $d['mahocphan'] ?>&&monhocphan=<?php echo $d['tenhocphan'] ?>&&idhocphan=<?php echo $d['id_hocphan'] ?>&&khoa=<?php echo $_REQUEST['khoa']; ?>"><?php echo $d['mahocphan'] ?>&nbsp;-&nbsp;<?php echo $d['tenhocphan'] ?></option>
                <?php
				}
	
				?>
            </select>
            <p></p>
            <strong>Lớp Học Phần:</strong> &nbsp;<select name="c" onchange="window.location.href=this.value;">
            <option value="<?php echo $_REQUEST['ip'] ?>" class="btn btn-info"><?php if(isset($_REQUEST['ip'])){
							echo $_REQUEST['tlhp'];
						}?></option>
            <?php
			include_once("Model/mKetNoiADHT.php");
			$p=new ketnoiAD();
			$kn=$p->ketnoi($ketnoi);
			if($kn){
				if(isset($_REQUEST['idhocphan'])){
					$idhp=$_REQUEST['idhocphan'];
					$sql2="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan
					join lophocphan l on m.id_lophocphan=l.id_lophocphan where hp.id_hocphan='$idhp'";
					$qr2=mysql_query($sql2);
					while($f=mysql_fetch_assoc($qr2)){
						?>
                        <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&tengv=<?php echo $_REQUEST['tengv'] ?>&&&&cgv=<?php echo $_REQUEST['cgv'] ?>&&mahp=<?php echo $_REQUEST['mahp'] ?>&&monhocphan=<?php echo $_REQUEST['monhocphan'] ?>&&idhocphan=<?php echo $_REQUEST['idhocphan'] ?>&&khoa=<?php echo $_REQUEST['khoa']; ?>&&ip=<?php echo $f['id_lophocphan'] ?>&&tlhp=<?php echo $f['tenlophocphan']  ?>"><?php echo $f['tenlophocphan'] ?></option>
                        <?php
					}
				}
			}
			
			?>
            </select>
            <p></p>
            <div class="border col-xs-10 col-sm-10 col-lg-10 col-md-10">
            <p></p>
            <h5>Thông Tin Về Học Phần</h5>
            <p></p>
            <?php 
			include_once("Model/MKetNoiADHT.php");
			$p=new ketnoiAD();
			$kn=$p->ketnoi($ketnoi);
			if($kn){
				if(isset($_REQUEST['ip'])){
					$idhp=$_REQUEST['idhocphan'];
					$ip=$_REQUEST['ip'];
					$sql="select * from monlop m join hocphan hp on m.id_hocphan=hp.id_hocphan
					join ct_hocphan c on hp.id_hocphan= c.id_hocphan where m.id_hocphan='$idhp' and m.id_lophocphan='$ip'";
					$qr=mysql_query($sql);
					$tt=mysql_fetch_assoc($qr);
					?>
                    &nbsp;<strong>Môn Học Phần:</strong>&nbsp;<?php echo $_REQUEST['monhocphan'] ?>
                    <p></p>
                    &nbsp;<strong>Lớp Học Phần:</strong>&nbsp;<?php echo $_REQUEST['tlhp'] ?>
                    <p></p>
                    &nbsp;<strong>Loại Học Phần:</strong>&nbsp;<?php echo $tt['loaihp'] ?>
                    <p></p>
                    &nbsp;<strong>Tổng số Tín Chỉ:</strong>&nbsp;<?php echo $tt['soTC'] ?>&nbsp;&nbsp;(
                    <strong>Số TC Lý Thuyết:</strong>&nbsp;<?php echo $tt['TCLT'] ?>&nbsp;-&nbsp;
                    <strong>Số TC Thực Hành:</strong>&nbsp;<?php echo $tt['TCTH'] ?>)
                    <p></p>
                    <p><input type="hidden" name="k" value="<?php echo $tt['loaihp']; ?>" /></p>
                    <?php
					if($tt['loaihp']=="LT & TH")
					{
						?>
                        &nbsp;<strong>Ngày Học LT (Thứ):</strong> <?php echo $tt['thuhocLT'] ?>
                        |
                        <strong>Tiết Lý Thuyết Từ:</strong>&nbsp;<?php echo $tt['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $tt['tietketthucLT'] ?>
                        |
                        <strong>Phòng Học Lý Thuyết:</strong>&nbsp;<?php echo $tt['phonghocLT'] ?>
                        <p></p>
                         &nbsp;<strong>Ngày Học TH (Thứ):</strong> <?php echo $tt['thuhocTH'] ?>
                        |
                        <strong>Tiết Thực Hành Từ:</strong>&nbsp;<?php echo $tt['tietbatdauTH'] ?>&nbsp;-&nbsp;<?php echo $tt['tietketthucTH'] ?>
                        |
                        <strong>Phòng Học Thực Hành:</strong>&nbsp;<?php echo $tt['phonghocTH'] ?>
                        <p></p>
                        &nbsp;<strong>Giảng Viên Thực Hành 1:</strong> <select name="d"> 
						<option value="">Chọn Giảng Viên</option>
						<?php 
						include_once("Model/mKetNoiADHT.php");
						$p=new ketnoiAD();
						$kn=$p->ketnoi($ketnoi);
						if($kn){
							$khoa=$_REQUEST['khoa'];
							$sql="select * from giangvien gv join chuyennganh cn on 
							cn.id_chuyennganh=gv.id_chuyennganh join
							khoavien kv on cn.id_khoa=kv.id_khoa
							where kv.tenkhoa='$khoa'";
							$qr=mysql_query($sql);
							while($k=mysql_fetch_assoc($qr)){
								?>
                                
                                <option value="<?php echo $k['id_giangvien'] ?>"><?php echo $k['hotengiangvien'] ?></option>
                            <?php
							}
							
						}
						?>
                        </select>
                        <p></p>
                        &nbsp;<strong>Giảng Viên Thực Hành 2:</strong> <select name="e"> 
						<option value="">Chọn Giảng Viên</option>
						<?php 
						include_once("Model/mKetNoiADHT.php");
						$p=new ketnoiAD();
						$kn=$p->ketnoi($ketnoi);
						if($kn){
							$khoa=$_REQUEST['khoa'];
							$sql="select * from giangvien gv join chuyennganh cn on 
							cn.id_chuyennganh=gv.id_chuyennganh join
							khoavien kv on cn.id_khoa=kv.id_khoa
							where kv.tenkhoa='$khoa'";
							$qr=mysql_query($sql);
							while($k=mysql_fetch_assoc($qr)){
								?>
                                
                                <option value="<?php echo $k['id_giangvien'] ?>"><?php echo $k['hotengiangvien'] ?></option>
                            <?php
							}
							
						}
						?>
                        </select>
                        <p></p>
                        <?php
					}
					else{
						?>
                         &nbsp;<strong>Ngày Học LT (Thứ):</strong> <?php echo $tt['thuhocLT'] ?>
                        |
                        <strong>Tiết Lý Thuyết Từ:</strong>&nbsp;<?php echo $tt['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $tt['tietketthucLT'] ?>
                        |
                        <strong>Phòng Học Lý Thuyết:</strong>&nbsp;<?php echo $tt['phonghocLT'] ?>
                        <p></p>
                        <?php
					}?>
                    <p></p>
                     <p></p>
                     <center><input type="submit" name="pc" value="OK" /></center>
                     <p></p>
            
                    <?php
				}
			}
			?>
            </div>
         
             <br />
           
            <?php
		
	}
	?>
    </form>
             <center><h5>Danh Sách Giảng Viên Đã Phân Công</h5></center>
             <table class="table table-bordered xc">
             	<thead>
                	<tr>
                       <th>STT</th>
                       <th><center>Giảng Viên LT</center></th>
                       <th><center>Giảng Viên TH1</center></th>
                       <th><center>Giảng Viên TH2</center></th>
                       <th><center>Môn Học Phần</center></th>
                       <th><center>Lớp Học Phần</center></th>
                       <th><center>Ngày Giảng Dạy LT</center></th>
                       <th><center>Ngày Giảng Dạy TH</center></th>
                       <th>Xóa</th>
                    </tr>
                   
                    <?php
					include_once("Model/mKetNoiADHT.php");
						$p=new ketnoiAD();
						$kn=$p->ketnoi($ketnoi);
						if($kn){
					$sql="select * from giangday gd join monlop m on gd.id=m.id
					join giangvien gv on gv.id_giangvien=gd.id_giangvien join 
					hocphan hp on hp.id_hocphan=m.id_hocphan join lophocphan l
					on l.id_lophocphan=m.id_lophocphan";
					$qr=mysql_query($sql);
					$a=1;
					while($x=mysql_fetch_assoc($qr)){
						?>
                     <tr>
                        <td><?php echo $a++; ?></td>
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
                        <td>Phòng Học LT:&nbsp;<?php echo $x['phonghocLT']; ?><br />
                        Tiết Lý Thuyết:&nbsp;<?php echo $x['tietbatdauLT']?>-<?php echo $x['tietketthucLT']?></td>
                        <td><?php if($x['phonghocTH']==null){
						}
						else{?>Phòng Học TH:&nbsp;<?php echo $x['phonghocTH']; ?><br />
                        Tiết Thực Hành:&nbsp;<?php echo $x['tietbatdauTH']?>-<?php echo $x['tietketthucTH']?><?php } ?></td>
                        <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&gv-hp&&xoapc=<?php echo md5($x['id_giangday']) ?>">Xóa</a></td>
                     </tr>
                        <?php
					}
					$a++;
						}
					?>
                    
                </thead>
             </table>
             </div>
     <br />
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    </div>
    <p></p>
    </div>
    <p></p>
    <?php
}
elseif(isset($_REQUEST['pec'])){
	?>
    <div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
        	<p></p>
            <center><h5>Phân Công Sinh Viên - Học Phần ( Excel )</h5></center>
            <p></p>
            <form action="#" method="post" enctype="multipart/form-data">
            <p></p>
            <div class="row">
            	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 border">
                <p></p>
                <strong>Tải Lên Danh Sách SV:&nbsp&nbsp;</strong><input type="file" name="f" required="required" />
                <p></p>
                <strong>Môn Học Phần:&nbsp;&nbsp;</strong>
                <select name="a" onchange="window.location.href=this.value;">
                <option value="<?php echo $_REQUEST['ihp'] ?>"><?php if(isset($_REQUEST['ihp'])){
					echo $_REQUEST['thp'];
				}?></option>
                <?php
				$sql="select * from hocphan";
				$qr=mysql_query($sql);
				while($hp=mysql_fetch_assoc($qr)){
					?>
                    <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp&&pec&&ihp=<?php echo $hp['id_hocphan'] ?>&&thp=<?php  echo $hp['tenhocphan']
					?>"><?php 
					echo $hp['tenhocphan'] ?></option>
                    <?php
				}
				 
				?>
                
                </select>
                <p></p>
                <strong>Lớp Học Phần: &nbsp;&nbsp;</strong><select name="b" onchange="window.location.href=this.value;">
                <option value="<?php echo $_REQUEST['il'] ?>"><?php echo $_REQUEST['tl'] ?></option>
                <?php
				$ihp=$_REQUEST['ihp'];
				$sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan
				join lophocphan l on l.id_lophocphan=m.id_lophocphan where hp.id_hocphan='$ihp'";
				$qr=mysql_query($sql);
				while($l=mysql_fetch_assoc($qr)){
					?>
                    <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp&&pec&&ihp=<?php echo $_REQUEST['ihp'] ?>&&thp=<?php  echo $_REQUEST['thp']
					?>&&il=<?php echo $l['id_lophocphan'] ?>&&tl=<?php echo $l['tenlophocphan'] ?>"><?php echo $l['tenlophocphan'] ?></option>
                    <?php
				}
				?>
                </select>
                <p></p>
                <div class="border">
                Thông Tin Về Học Phần
                <p></p>
                <?php
				$ihp=$_REQUEST['ihp'];
				$il=$_REQUEST['il'];
				$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
				join monlop m on m.id_hocphan=hp.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan
				join giangday g on g.id=m.id
				where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
				$qr=mysql_query($sql);
				$f=mysql_fetch_assoc($qr);
				?>
                <strong>Môn Học Phần:&nbsp;</strong><?php echo $f['tenhocphan'] ?>
                <p></p>
                <strong>Lớp Học Phần: &nbsp;</strong><?php echo $f['tenlophocphan'] ?>
                <p></p>
                <strong>Loại Học Phần: &nbsp;</strong><?php echo $f['loaihp'] ?>
                <p></p>
    <strong>Tổng Số Tín Chỉ:</strong>&nbsp;<?php echo $f['soTC'] ?>&nbsp;(<strong>Số TC Lý Thuyết</strong>:&nbsp;<?php echo $f['TCLT'] ?> &nbsp;-&nbsp; <strong>Số TC Thực Hành</strong>:&nbsp;<?php echo $f['TCTH'] ?>&nbsp;)
    <p></p>
    <strong>Ngày Học LT ( Thứ ):&nbsp;</strong><?php echo $f['thuhocLT'] ?>&nbsp;|&nbsp;<strong>Tiết Lý Thuyết Từ:</strong>&nbsp;<?php echo $f['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $f['tietketthucLT'] ?>&nbsp;|&nbsp;<strong>Phòng Học Lý Thuyết:</strong>&nbsp;<?php echo $f['phonghocLT'] ?>
    <?php if($f['loaihp']=='LT & TH'){ ?>
    <p></p>
    <strong>Ngày Học TH ( Thứ ):&nbsp;</strong><?php echo $f['thuhocTH'] ?>&nbsp;|&nbsp;<strong>Tiết Thực Hành Từ:</strong>&nbsp;<?php echo $f['tietbatdauTH'] ?>&nbsp;-&nbsp;<?php echo $f['tietketthucTH'] ?>&nbsp;|&nbsp;<strong>Phòng Học Thực Hành:</strong>&nbsp;<?php echo $f['phonghocTH'];?>
     <p></p>
    
  <?php  } $g=$f['id_giangvien'];
	$sql="select * from giangvien where id_giangvien='$g'";
	$tt=mysql_query($sql);
	$e=mysql_fetch_assoc($tt);
	?>
    <p></p>
    &nbsp;&nbsp;<strong>Giảng Viên Lý Thuyết:</strong> <input type="text" value="<?php echo $e['hotengiangvien'] ?>" disabled="disabled" />
    <input type="hidden" name="ig" value="<?php echo $e['id_giangvien'] ?>" />
    <p></p>
    <?php if($f['loaihp']=='LT & TH'){
		?>
    <strong>&nbsp;&nbsp;Chọn Giảng Viên Thực Hành:</strong>
    <select name="c">
    	<option value="<?php echo $f['id_giangvienTH1']; ?>"><?php $n=$f['id_giangvienTH1'];
		$sql="select *from giangvien where id_giangvien='$n'";
		$ttgv=mysql_query($sql);
		$u=mysql_fetch_assoc($ttgv);
		echo $u['hotengiangvien']; ?></option>
        <?php $m=$f['id_giangvienTH2'];
		$sql="select *from giangvien where id_giangvien='$m'";
		$ttgv=mysql_query($sql);
		$u=mysql_fetch_assoc($ttgv);
		?>
        
		<option value="<?php echo $f['id_giangvienTH2']; ?>"><?php 
		if($f['id_giangvienTH2']==null){
			echo "...";
		}
		else{
			echo $u['hotengiangvien'];
		}?></option>
    </select>
    <p></p>
    <center><input type="submit" name="se" value="OK" /></center>
    <p></p>
     <?php } ?>
     
                </div>
                 <p></p>
    <center><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp"><img src="https://tse2.mm.bing.net/th?id=OIP.3kURCl0IVYwVdw5vriOg6AHaHa&pid=Api&P=0&h=180"
    height="30px" width="30px"  /></a></center>
                <p></p>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                </div>
            </div>
            
            </form>
            <p></p>
        </div>
    </div>
    <?php
}
elseif(isset($_REQUEST['sv-hp'])){
	?>
    <p></p>
    <div class="border">
    <p></p>
    <center><h5>Phân Sinh Viên ( Học Phần )&nbsp;&nbsp;|&nbsp;&nbsp;<a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp
    &&pec"><img src=
    "https://tse1.mm.bing.net/th?id=OIP.U0CtQVB5bE_YEsKgokMH4QHaHa&pid=Api&rs=1&c=1&qlt=95&w=122&h=122"
    height="50px" width="50px" /></a>&nbsp;&nbsp;</h5></center>
    <form action="#" method="post" enctype="multipart/form-data">
    <p></p>
    <div class="row">
    	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 border">
    <p></p>
    &nbsp; <strong>Họ Tên Sinh Viên:</strong>
    <select name="a" onchange="window.location.href=this.value;">
    <option value="<?php echo $_REQUEST['is'] ?>" class="btn-info"><?php
	if(isset($_REQUEST['is'])){
		echo $_REQUEST['ts'];
		
	}
    ?></option>
    	<?php
		$sql="select * from sinhvien";
		$ldssv=mysql_query($sql);
		while($c=mysql_fetch_assoc($ldssv)){
			?>
            <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&sv-hp&&is=<?php echo $c['id_sinhvien'] ?>&&ts=<?php
			echo $c['tensinhvien'] ?>"><?php echo $c['tensinhvien'] ?></option>
            <?php
		}
		?>
    </select>&nbsp;<strong>&nbsp;&nbsp;Khoa:</strong>&nbsp;
    <?php
	if(isset($_REQUEST['is'])){
		$is= $_REQUEST['is'];
		$sql="select * from sinhvien s join chuyennganh c on s.id_chuyennganh=c.id_chuyennganh
		join khoavien k on c.id_khoa=k.id_khoa
		where s.id_sinhvien='$is' ";
		$ksv=mysql_query($sql);
		$b=mysql_fetch_assoc($ksv);
	}
	?>
    <input type="text" disabled="disabled" value="<?php echo $b['tenkhoa'] ?>" />
    <strong>&nbsp;&nbsp;Chuyên Ngành:</strong>&nbsp;
    <?php
	if(isset($_REQUEST['is'])){
		$is=$_REQUEST['is'];
		$sql="select * from sinhvien s join chuyennganh c on s.id_chuyennganh=c.id_chuyennganh
		where s.id_sinhvien='$is'";
		$cnsv=mysql_query($sql);
		$a=mysql_fetch_assoc($cnsv);
	}
    ?>
    <input type="text" disabled="disabled" value="<?php if($_REQUEST['is']==null){
		?>
       
        <?php
	}
	else{
		echo $a['tenchuyennganh'];
	}?>" placeholder="..." />
    <p></p>
    &nbsp;&nbsp;<strong>Môn Học Phần: </strong>
    <select name="b" onchange="window.location.href=this.value;">
    <option value="<?php echo $_REQUEST['ihp'] ?>" class="btn-info"><?php
	if(isset($_REQUEST['ihp'])){
		echo $_REQUEST['thp'];
	}
    ?></option>
    	<?php
		$sql="select *from hocphan";
		$laymh=mysql_query($sql);
		while($a=mysql_fetch_assoc($laymh)){
			?>
            <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&sv-hp&&is=<?php echo $_REQUEST['is'] ?>&&ts=<?php
			echo $_REQUEST['ts'] ?>&&ihp=<?php echo $a['id_hocphan'] ?>&&thp=<?php echo $a['tenhocphan'] ?>"><?php echo $a['tenhocphan'] ?></option>
            <?php
		}
		?>
    </select>
    <p></p>
    &nbsp;&nbsp;<strong>Lớp Học Phần:</strong> 
    <select name="c" onchange="window.location.href=this.value;">
    <option value="<?php echo $_REQUEST['il']; ?>" class="btn-info">
    <?php
	if(isset($_REQUEST['il'])){
		echo $_REQUEST['tl'];
	}
	?>
    </option>
    	<?php
		$ihp=$_REQUEST['ihp'];
		$sql="select *from lophocphan l join monlop m on m.id_lophocphan=l.id_lophocphan join hocphan hp
		on hp.id_hocphan=m.id_hocphan where hp.id_hocphan='$ihp' "; 
		$laylhp=mysql_query($sql);
		while($d=mysql_fetch_assoc($laylhp)){
			?>
            <option value="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']?>&&sv-hp&&is=<?php echo $_REQUEST['is'] ?>&&ts=<?php
			echo $_REQUEST['ts'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&thp=<?php echo $_REQUEST['thp'] ?>&&il=<?php echo $d['id_lophocphan'] ?>&&tl=<?php echo $d['tenlophocphan'] ?>"><?php echo $d['tenlophocphan'] ?></option>
            <?php
		}
		?>
    </select>
    <p></p>
    <div class="border">
    &nbsp;&nbsp;THÔNG TIN VỀ HỌC PHẦN
    <p></p>
    <?php
if(isset($_REQUEST['il'])){
	$ihp=$_REQUEST['ihp'];
	$il=$_REQUEST['il'];
	$sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
	$tthp=mysql_query($sql);
	$q=mysql_fetch_assoc($tthp); 
}
	?>
     <?php
if(isset($_REQUEST['il'])){
	?>
    <strong>&nbsp;&nbsp;Môn Học Phần:</strong>&nbsp;<?php echo $q['tenhocphan'] ?>
    <p></p>
    <strong>&nbsp;&nbsp;Lớp Học Phần:</strong>&nbsp;<?php echo $q['tenlophocphan'] ?>
    <p></p>
    <strong>&nbsp;&nbsp;Loại Học Phần:</strong>&nbsp;<?php echo $q['loaihp'] ?>
    <p></p>
    <strong>&nbsp;&nbsp;Tổng Số Tín Chỉ:</strong>&nbsp;<?php echo $q['soTC'] ?>&nbsp;(<strong>Số TC Lý Thuyết</strong>:&nbsp;<?php echo $q['TCLT'] ?> &nbsp;-&nbsp; <strong>Số TC Thực Hành</strong>:&nbsp;<?php echo $q['TCTH'] ?>&nbsp;)
    <p></p>
    <strong>&nbsp;&nbsp;Ngày Học LT ( Thứ ):&nbsp;</strong><?php echo $q['thuhocLT'] ?>&nbsp;|&nbsp;<strong>Tiết Lý Thuyết Từ:</strong>&nbsp;<?php echo $q['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $q['tietketthucLT'] ?>&nbsp;|&nbsp;<strong>Phòng Học Lý Thuyết:</strong>&nbsp;<?php echo $q['phonghocLT'] ?>
    <p></p>
    <?php
	$sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan  
	where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
	$tthp=mysql_query($sql);
	$r=mysql_fetch_assoc($tthp); 
	$sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan 
	join giangday g on g.id=m.id 
	where m.id_hocphan='$ihp' and m.id_lophocphan='$il'";
	$tthp1=mysql_query($sql);
	$r1=mysql_fetch_assoc($tthp1); 
	if($r['loaihp']=='LT & TH'){
	?>
    <strong>&nbsp;&nbsp;Ngày Học TH ( Thứ ):</strong>&nbsp;<?php echo $q['thuhocTH'] ?>&nbsp;|&nbsp;<strong>Tiết Thực Hành Từ:</strong>&nbsp;<?php echo $q['tietbatdauTH'] ?>&nbsp;-&nbsp;<?php echo $q['tietketthucTH'] ?>&nbsp;|&nbsp;<strong>Phòng Học Thực Hành:</strong>&nbsp;<?php echo $q['phonghocTH'] ?>
    <p></p>
    
  <?php  } $g=$r1['id_giangvien'];
	$sql="select * from giangvien where id_giangvien='$g'";
	$tt=mysql_query($sql);
	$e=mysql_fetch_assoc($tt);
	?>
    &nbsp;&nbsp;<strong>Giảng Viên Lý Thuyết:</strong> <input type="text" value="<?php echo $e['hotengiangvien'] ?>" disabled="disabled" />
    <input type="hidden" name="e" value="<?php echo $e['id_giangvien'] ?>" />
    <p></p>
    <?php if($r['loaihp']=='LT & TH'){
		?>
    <strong>&nbsp;&nbsp;Chọn Giảng Viên Thực Hành:</strong>
    <select name="d">
    	<option value="<?php echo $r1['id_giangvienTH1']; ?>"><?php $n=$r1['id_giangvienTH1'];
		$sql="select *from giangvien where id_giangvien='$n'";
		$ttgv=mysql_query($sql);
		$u=mysql_fetch_assoc($ttgv);
		echo $u['hotengiangvien']; ?></option>
        <?php $m=$r1['id_giangvienTH2'];
		$sql="select *from giangvien where id_giangvien='$m'";
		$ttgv=mysql_query($sql);
		$u=mysql_fetch_assoc($ttgv);
		?>
        
		<option value="<?php echo $r1['id_giangvienTH2']; ?>"><?php 
		if($r1['id_giangvienTH2']==null){
			echo "...";
		}
		else{
			echo $u['hotengiangvien'];
		}?></option>
    </select>
    <p></p>
     <?php 
	}
	?>
    <?php if($e['hotengiangvien']==null){ } else{?>
    <center><input type="submit" name="uk" value="OK" /></center>
    <p></p>
    </div>
    <?php }
}
	?>
    <p></p>
    &nbsp;<i>( Lưu ý: Đối Chiếu Theo Chương Trình Khung Chuyên Ngành Sinh Viên Đang Theo Học Để Áp Cứng Học Phần Hợp Lý )</i>
    </form>
    <p></p>
    <p></p>
    </div>
    <br />
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p></p>
    <center><h5>Danh Sách Sinh Viên Đã Áp Cứng Môn Học</h5></center>
     <p></p>
    <form action="#" method="post">
    <input type="text" name="a" placeholder="Nhập mã số SV ..." />&nbsp;&nbsp;<input type="submit" name="lo" value="Lọc" />
    </form>
    <p></p>
    <table class="table table-bordered xc">
    	<thead>
        	<tr>
            	<th>STT</th>
                <th><center>Họ Tên Sinh Viên</center></th>
                <th>Mã Số Sinh Viên</th>
                <th>Lớp Học Phần</th>
                <th>Môn Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th><center>Chi Tiết Học Phần</center></th>
                <th>Xóa</th>
            </tr>
            <?php 
			if(isset($_POST['lo'])){
				$ms=$_POST['a'];
				$sql1="select * from hoctap h join monlop m on h.id=m.id
				join hocphan hp on hp.id_hocphan=m.id_hocphan
				join lophocphan l on l.id_lophocphan=m.id_lophocphan
				join ct_hocphan c on c.id_hocphan=hp.id_hocphan
				join sinhvien s on s.id_sinhvien=h.id_sinhvien where s.masosinhvien='$ms'";
			}
			
			$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:10;
			$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
    		$start_from = ($tranghientai-1) * $bangghimoitrang;
			$sql="select * from hoctap h join monlop m on h.id=m.id
			join hocphan hp on hp.id_hocphan=m.id_hocphan
			join lophocphan l on l.id_lophocphan=m.id_lophocphan
			join ct_hocphan c on c.id_hocphan=hp.id_hocphan
			join sinhvien s on s.id_sinhvien=h.id_sinhvien limit $start_from,$bangghimoitrang";
		if(isset($_POST['lo'])){
			$xtt=mysql_query($sql1);
		}
		else{
			$xtt=mysql_query($sql);
		}
			
			$sc="select count(id_hoctap) from hoctap h join monlop m on h.id=m.id
			join hocphan hp on hp.id_hocphan=m.id_hocphan
			join lophocphan l on l.id_lophocphan=m.id_lophocphan
			join ct_hocphan c on c.id_hocphan=hp.id_hocphan
			join sinhvien s on s.id_sinhvien=h.id_sinhvien";
			$st=mysql_query($sc);
			$cot = mysql_fetch_row($st);  
    		$tongbangghi = $cot[0];  
   			$tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
			
			$a=1;
			$p=$_REQUEST['page'];
			while($c=mysql_fetch_assoc($xtt)){
				if($a==0){
					echo "<tr>";
				}
				?>
                	<td><?php 
					if($p==2){
						echo 10*($p-1)+$a++;
					}
					else{
						echo $a++;
					}?></td>
                    <td><?php echo $c['tensinhvien']?></td>
                    <td><center><?php echo $c['masosinhvien']?></center></td>
                    <td><?php echo $c['tenlophocphan']?></td>
                    <td><?php echo $c['tenhocphan']?></td>
                    <td><?php echo $c['soTC'] ?></td>
                    <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&xect=<?php echo $c['id_hoctap'] ?>">Xem</a></td>
                    <td><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $c['id_sinhvien'] ?>&&ihp=<?php echo 
					$c['id_hocphan'] ?>&&xoat=<?php echo $c['id_hoctap'] ?>">Xóa</a></td>
                </tr>
                <?php
				if($a==1){
					echo "</tr>";
				}
			}
			$a++;
			
			?>
        </thead>
    </table>
    <p></p>
            <center><?php if(isset($_POST['lo'])){
			}
			else{include_once("Controller/cPageR.php");
			}?></center>
            <br />
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    </div>
    </div>
    <p></p>
    <?php
}
elseif(isset($_REQUEST['xect'])){
	?>
    <div class="row">
    	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 border">
        <p></p>
        <center><h5>Chi Tiết Học Phần Áp Cứng</h5></center>
        <p></p>
        <?php
		$xe=$_REQUEST['xect'];
		$sql="select * from monlop m join hoctap h on m.id=h.id
			join hocphan hp on hp.id_hocphan=m.id_hocphan
			join lophocphan l on l.id_lophocphan=m.id_lophocphan
			join ct_hocphan c on c.id_hocphan=hp.id_hocphan
			join sinhvien s on s.id_sinhvien=h.id_sinhvien where h.id_hoctap='$xe'";
			$xct=mysql_query($sql);
			$c=mysql_fetch_assoc($xct);
		?>
        <p></p>
        <hr />
        <p></p>
       <strong> Sinh Viên Áp Cứng:</strong> &nbsp; <?php echo $c['tensinhvien']?>
        <p></p>
        <strong>Lớp Học Phần:</strong>&nbsp;<?php echo $c['tenlophocphan']?>
        <p></p>
        <strong>Môn Học:</strong> &nbsp;<?php echo $c['tenhocphan']?>
        <p></p>
        <strong>Số Tín Chỉ:</strong> &nbsp;<?php echo $c['soTC']?>
        <p></p>
        <strong>Tín Chỉ Lý Thuyết:</strong> &nbsp; <?php echo $c['TCLT']?>&nbsp;<p></p><strong>Tín Chỉ Thực Hành:</strong>&nbsp;<?php echo $c['TCTH']?>
        <p></p>
        <hr />
        <p></p>
        <strong>Ngày Học LT :</strong> &nbsp;<?php if($c['thuhocLT']==8){
						echo "Chủ Nhật";
					}
					else{echo "T.".$c['thuhocLT']; }?><br />
                    <p></p>
                    <strong>Tiết LT Từ:</strong> <?php echo $c['tietbatdauLT']?>&nbsp;-&nbsp;<?php echo $c['tietketthucLT'] ?><br />
                    <p></p>
                    <strong>Phòng Học LT:</strong> <?php echo $c['phonghocLT'] ?><br />
                    <p></p>
                    <strong>Giảng Viên Lý Thuyết:</strong>&nbsp;<?php $e=$c['id'];
					$sql="select * from giangvien g join
					giangday gd on g.id_giangvien=gd.id_giangvien
					join monlop m on m.id=gd.id join hoctap h on h.id=m.id 
					join hocphan hp on hp.id_hocphan=m.id_hocphan
					join ct_hocphan c on c.id_hocphan=hp.id_hocphan
					where m.id='$e'"; 
					$qr=mysql_query($sql);
					$r=mysql_fetch_assoc($qr);
					echo $r['hotengiangvien'];?>
                    <hr />
                    <?php if($r['loaihp']=="LT & TH"){ ?>
                    <strong>Ngày Học TH :</strong> &nbsp;<?php if($c['thuhocTH']==8){
						echo "Chủ Nhật";
					}
					else{echo "T.".$c['thuhocTH'];} ?><br /><p></p>
                    <strong>Tiết TH Từ:</strong> <?php echo $c['tietbatdauTH']?>&nbsp;-&nbsp;<?php echo $c['tietketthucTH'] ?><br /><p></p>
                    <strong>Phòng Học TH:</strong> <?php echo $c['phonghocTH'] ?>
                
                  
                    <p></p>
                    <strong>Giảng Viên Thực Hành:</strong>&nbsp;<?php $j=$c['id_giangvienTH'];
					$sql="select * from giangvien where id_giangvien='$j'"; 
					$qr=mysql_query($sql);
					$w=mysql_fetch_assoc($qr);
					echo $w['hotengiangvien'];
					}
					else{
					};?>
        <p></p>
        <center><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm'] ?>&&sv-hp"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&rs=1&c=1&qlt=95&w=121&h=121" height="30px" width="30px" /></a></center>
        <p></p>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        </div>
        <p></p>
    </div>
    <?php
}
else{
  ?>
  <div class="row border">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
            <br />
           <h5> &nbsp;&nbsp;Giới thiệu chức năng "Quản Lý Học Phần"</h5>
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
  </div>
  <?php
}?>
<p></p>
<center><a href="homeAD.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse4.mm.bing.net/th?id=OIP.GcRlpNTMNf06GOD3l3pILgHaHa&pid=Api&P=0&h=180"
height="30px" width="30px" /></a></center>
<p></p>
<br />
<!--Đây là phần footer-->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
    </div>
</div>
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