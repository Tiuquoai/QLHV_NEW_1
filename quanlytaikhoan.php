<?php 
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
<title>Quản Lý Tài Khoản</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
button{
	background-color:#FFF;
}
.abc{
	background-color:#333;
	color: white;
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
a{
	color: #000;
}
a:hover{
	color: #000;
}
.them{
	margin-top:15px;
	margin-right:15px;
}
.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
cl{
	color: black;
}
textarea{
	height:200px;
	width: 300px;
}
.bt{
	background-color:#fff;
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
<br/>
<div class="row">
&nbsp;<p><?php if(isset($_REQUEST['sv'])){ ?>
<button class="bt"><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1">Sinh Viên</a></button>
<?php }
else{?>
<button><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1">Sinh Viên</a></button>
<?php } ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php if(isset($_REQUEST['gv'])){ ?><button class="bt"><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=1">Giảng Viên</a></button></p>
<?php }
else{
	?>
    <button><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=1">Giảng Viên</a></button>
    <?php } ?>
</div>

<div class="border">
<?php
if(isset($_REQUEST['sv'])){
	?>
    <p></p>
    <center><h5>Quản Lý Sinh Viên</h5></center>
    <p align="right" class="them"><button><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&them">Thêm+</a></button>
    &nbsp;&nbsp; <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&taiexcel"><img src="https://tse2.mm.bing.net/th?id=OIP.U0CtQVB5bE_YEsKgokMH4QHaHa&pid=Api&P=0&h=180" height="30px" width="30px" />Tải</a> </p>
    <p></p>&nbsp;&nbsp;
    <form action="#" method="post" enctype="multipart/form-data">
    	<div class="row">
        <?php
        if(isset($_POST['loc'])){
					 $sd=$p->loc();
					 $a=mysql_fetch_assoc($sd);
				 }
				 ?>
        	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
            &nbsp;<input type="text" name="ht" placeholder="Họ Tên SV" value="<?php if(isset($_POST['loc'])){
				echo $a['tensinhvien'];
			}
			else{
			}?>" size="18" />
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
            <input type="text" name="mssv" placeholder="Mã Số SV"  value="<?php if(isset($_POST['loc'])){
				echo $a['masosinhvien'];
			}
			else{
			}?>"  size="18" />
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
            <input type="submit" name="loc" value="Lọc"/>
            </div>
        </div>
    </form>
    <p></p>
    	<table class="table table-bordered border">
        	<thead>
            	 <tr>
                 	<th>STT</th>
                    <th>Tên Sinh Viên</th>
                    <th>Mã Số Sinh Viên</th>
                    <th>Giới Tính</th>
                    <th>Lớp</th>
                    <th>Trạng Thái</th>
                    <th>Gmail</th>
                    <th><center>Xem Chi Tiết</center></th>
                    <th><center>Xóa</center></th> 
                 </tr>
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
                 	<td><?php if($n==1){
						echo $a++;
					}
					elseif($n>=2){
						echo (($n-1)*5)+$a++;
					}?></td>
                    <td><?php echo $c['tensinhvien']; ?></td>
                    <td><?php echo $c['masosinhvien']; ?></td>
                    <td><?php echo $c['gioitinh']; ?></td>
                    <td><?php echo $c['lopCN']; ?></td>
                    <td><?php if($c['trangthai']==1){
						echo "Đang Học";
					}
					elseif($c['trangthai']==2){
						echo "Đã Tốt Nghiệp";
					}
					else{
						echo "Ngưng Học";
					}?></td>
                    <td><p></p><?php if($c['ttguigmailctk']==0){
						?>
                        <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&mssv=<?php echo md5($c['masosinhvien']) ?>&&guigmail&&page=<?php echo $_REQUEST['page']; ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.4mrPBn6c-ETi-_4SLP0g4gHaFY&pid=Api&P=0&h=180"  height="15px" width="25px"/></a></center>
                        <?php
						
					}
					else{
						?>
                        <center><img src="https://tse4.explicit.bing.net/th?id=OIP.euPav0exATbYjnprLB76wQHaHa&pid=Api&P=0&h=180" height="25px" width="25px" /></center>
                        <?php
					}?></td>
                    <td><p></p><center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitiet&&mssv=<?php echo md5($c['masosinhvien']) ?>&&page=<?php echo $_REQUEST['page'];?>"><img src="https://tse2.mm.bing.net/th?id=OIP.opUsgvlOzl7K8bX64gXZ6QAAAA&pid=Api&P=0&h=180" height="15px" width="25px" /></a></center></td>
                    <td><center><a href="xoasv.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=<?php echo $_REQUEST['page']?>&xoasv=<?php echo md5($c['user_id']) ?>&xoa"><img src="https://tse4.mm.bing.net/th?id=OIP.aCCEunINNFHeHJR7D_oaogAAAA&pid=Api&P=0&h=180" height="45px" width="40px" /></a></center></td>
                 </tr>
                 <?php
				 }
				 $a++;
				 ?>
            </thead>
        </table>
 <p></p>
 <center>      
<?php
if(isset($_POST['loc'])){
}
else{
$p->Page();
}
?>
</center>
<p></p>
<?php
				 
}
elseif(isset($_REQUEST['guigmail'])){
    // var_dump("hahahaa");
    // exit;
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$kn=$p->ketnoi($ketnoi);
if($kn){
 $mssv=$_REQUEST['mssv'];
 $sql2="select * from user u join sinhvien sv on u.user_id=sv.user_id where u.user_code='$mssv'";
 $qr2=mysql_query($sql2);
 $s=mysql_fetch_assoc($qr2);
 $e=$s['email'];
include "class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "thuonghoaicute103@gmail.com";
$mail->Password = "apss kjci mxka pjby";
$mail->SetFrom("thuonghoaicute103@gmail.com");
$mail->AddAddress($e);
$mail->Subject = "Trung Tam Quan Tri He Thong CMS";
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
    <p></p>
    <center><h5>Quản Lý Giảng Viên</h5></center>
    <p align="right" class="them"><button><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&themgv">Thêm+</a></button></p>
    &nbsp;
    <p></p>&nbsp;&nbsp;
    <form action="#" method="post" enctype="multipart/form-data">
    	<div class="row">
        <?php
        if(isset($_POST['loc1'])){
					 $sd=$p->loc1();
					 $a=mysql_fetch_assoc($sd);
				 }
				 ?>
        	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
            <input type="text" name="htgv" placeholder="Họ Tên GV" value="<?php if(isset($_POST['loc'])){
				echo $a['tensinhvien'];
			}
			else{
			}?>" size="18" />
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
            <input type="text" name="mgv" placeholder="Mã GV"  value="<?php if(isset($_POST['loc'])){
				echo $a['masosinhvien'];
			}
			else{
			}?>"  size="18" />
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2">
            <input type="submit" name="loc1" value="Lọc"/>
            </div>
        </div>
    </form>
    <p></p>
    	<table class="table table-bordered border">
        	<thead>
            	 <tr>
                 	<th>STT</th>
                    <th>Họ Tên Giảng Viên</th>
                    <th>Mã Giảng Viên</th>
                    <th>Học Vị</th>
                    <th>Gmail</th>
                    <th><center>Xem Chi Tiết</center></th>
                    <th><center>Xóa</center></th> 
                 </tr>
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
                 	<td><?php if($n==1){
						echo $a++;
					}
					elseif($n>=2){
						echo (($n-1)*5)+$a++;
					}?></td>
                    <td><?php echo $c['hotengiangvien']; ?></td>
                    <td><?php echo $c['magiangvien']; ?></td>
                    <td><?php echo $c['hocvi']; ?></td>
                    <td><p></p><?php if($c['ttguigmailctk']==0){
						?>
                        <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&mgv=<?php echo md5($c['magiangvien']) ?>&&guigmail1&&page=<?php echo $_REQUEST['page']; ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.4mrPBn6c-ETi-_4SLP0g4gHaFY&pid=Api&P=0&h=180"  height="15px" width="25px"/></a></center>
                        <?php
						
					}
					else{
						?>
                        <p></p><center><img src="https://tse4.explicit.bing.net/th?id=OIP.euPav0exATbYjnprLB76wQHaHa&pid=Api&P=0&h=180" height="25px" width="25px" /></center>
                        <?php
					}?></td>
                    <td><p></p><center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitietgv&&mgv=<?php echo md5($c['magiangvien']) ?>&&page=<?php echo $_REQUEST['page'];?>"><img src="https://tse2.mm.bing.net/th?id=OIP.opUsgvlOzl7K8bX64gXZ6QAAAA&pid=Api&P=0&h=180" height="15px" width="25px" /></a></center></td>
                    <td><center><a href="xoagv.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=<?php echo $_REQUEST['page']?>&xoagvien=<?php echo md5($c['user_id']) ?>&xoa"><img src="https://tse4.mm.bing.net/th?id=OIP.aCCEunINNFHeHJR7D_oaogAAAA&pid=Api&P=0&h=180" height="45px" width="40px" /></a></center></td>
                 </tr>
                 <?php
				 }
				 $a++;
				 ?>
            </thead>
        </table>
 <p></p>
 <center>      
<?php
if(isset($_POST['loc1'])){
}
else{
$p->Pagegv();
}
?>
</center>
<p></p>
		
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
include "class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "thuonghoaicute103@gmail.com";
$mail->Password = "apss kjci mxka pjby";
$mail->SetFrom("thuonghoaicute103@gmail.com");
$mail->AddAddress($e);
$mail->Subject = "Trung Tam Quan Tri He Thong CMS";
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
    <form action="#" method="post" enctype="multipart/form-data">
	<center><strong><h4>Thông Tin Chi Tiết&nbsp;&nbsp;&nbsp;&nbsp;<a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&suattgv&&mgv=<?php echo $_REQUEST['mgv'] ?>&&page=<?php echo $_REQUEST['page']; ?>"><img src=
    "https://tse4.mm.bing.net/th?id=OIP.B7zOpV_oMJAcGd85aSujHQHaHa&pid=Api&P=0&h=180"
    height="20px" width="20px" /></a></h4></strong></center>
    <p></p>
    <strong><h5>Thông Tin Tài Khoản</h5></strong>
    <p></p>
    <div>
    <strong>Mã Tài Khoản</strong> : **********  &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Tên Tài Khoản</strong> : <input type="text" name="a" value="<?php echo $cot['tenuser']; ?>" />
    <p></p>
    <strong>Mật Khẩu</strong> : ********** &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Ảnh Hiện Tại</strong> : 
<?php
$anh=$cot['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <img src="<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />
	<?php
}
else{
	?>
	<img src="img/<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />

    <?php
}
?>
</div>
<p></p>
<strong>Thay Đổi Ảnh</strong>: <input type="file" name="f" /> <input type="hidden" name="f1" value="<?php echo $cot['anh'];?>" />
<p></p>
<br />
    <strong><h5>Thông Tin Giảng Viên</h5></strong>
    <p></p>
    <div class="row">
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Họ Tên Giảng Viên</strong> : <input type="text" name="b" value="<?php echo $cot['hotengiangvien']; ?>" />
    <p></p>
    <strong>Mã Giảng Viên</strong> : <input type="text" value="<?php echo $cot['magiangvien'] ?>" disabled="disabled" />
    <p></p>
    <strong>Giới Tính</strong> : </strong> : <?php
					if($cot['gioitinh']=='Nam'){
						$nam="checked";
					}
					elseif($cot['gioitinh']=='Nữ'){
						$nu="checked";
					}
	?>
      &nbsp;&nbsp;<input type="radio" name="c" value="Nam" <?php echo $nam ?>   /> Nam &nbsp;&nbsp;&nbsp;<input type="radio" name="c" value="Nữ" <?php echo $nu ?> required="required"  /> Nữ</strong>
    <p></p>
    <strong>Số Điện Thoại</strong> : <input type="text" name="d" value="<?php echo $cot['sdt'] ?>" />
    <p></p>
    <strong>Email</strong> : <input type="text" name="e" value="<?php echo $cot['email']; ?>" />
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Số CCCD</strong> : <input type="text" name="g" value="<?php echo $cot['cccd']; ?>" />
    <p></p>
    <strong>Địa Chỉ Liên Hệ</strong> : <input type="text" name="h" value="<?php echo $cot['diachi'] ?>" />
    <p></p>
    <strong>Học Vị</strong> : <strong><select name="i">
    <option disabled="disabled" class="btn-info"><?php echo $cot['hocvi']; ?></option>

    <option>Thạc Sĩ</option>
    <option>Tiến Sĩ</option>
    <option>Phó Giáo Sư</option>
    <option>Giáo Sư</option>
    </select></strong>
    <p></p>
    <strong>Quá Trình Công Tác</strong> : <strong><br/>
    <textarea name="k" size="30"><?php echo $cot['quatrinhcongtac'] ?></textarea></strong>
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Cơ Sở Giảng Dạy</strong> : <input type="text" name="l" value="<?php echo $cot['cosogiangday'] ?>" />
    <p></p>
    <strong>Khoa Giảng Dạy</strong> : <?php echo $cot['tenkhoa'] ?>
    <p></p>
    <strong>Chuyên Môn Ngành</strong> : <?php echo $cot['tenchuyennganh'] ?>
    <p></p>
    <strong>Chứng Chỉ</strong> : <input type="text" name="m" value="<?php echo $cot['chungchi'] ?>" />
    <p></p>
    <strong>Chứng Chỉ Khác</strong> : <br /><strong><textarea name="p"><?php echo $cot['chungchikhac'];?></textarea></strong>
    <p></p>
    <strong>Công Trình Khoa Học Tiêu Biểu</strong> : <br /><strong><textarea name="q"><?php echo $cot['congtrinhkhoahoctieubieu'];?></textarea></strong>
    </div>
    </div>
    <p></p>
    <center><input type="submit" name="ltd" value="Lưu Thay Đổi" /></center>
    </form>
    <p></p>
    <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitietgv&&mgv=<?php echo $_REQUEST['mgv'] ?>&&page=<?php echo $_REQUEST['page'];?>"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
        <?php
}
elseif(isset($_REQUEST['xemchitietgv'])){
	include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietGV());
	?>
	<center><strong><h4>Thông Tin Chi Tiết&nbsp;&nbsp;&nbsp;&nbsp;<a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&suattgv&&mgv=<?php echo $_REQUEST['mgv'] ?>&&page=<?php echo $_REQUEST['page']; ?>"><img src=
    "https://tse4.mm.bing.net/th?id=OIP.B7zOpV_oMJAcGd85aSujHQHaHa&pid=Api&P=0&h=180"
    height="20px" width="20px" /></a></h4></strong></center>
    <p></p>
    <strong><h5>Thông Tin Tài Khoản</h5></strong>
    <p></p>
    <div>
    <strong>Mã Tài Khoản</strong> : **********  &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Tên Tài Khoản</strong> : <?php echo $cot['tenuser']; ?>
    <p></p>
    <strong>Mật Khẩu</strong> : ********** &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Ảnh</strong> : 
<?php
$anh=$cot['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <img src="<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />
	<?php
}
else{
	?>
	<img src="img/<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />

    <?php
}
?>
</div>
<br />
    <strong><h5>Thông Tin Giảng Viên</h5></strong>
    <p></p>
    <div class="row">
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Họ Tên Giảng Viên</strong> : <?php echo $cot['hotengiangvien']; ?>
    <p></p>
    <strong>Mã Giảng Viên</strong> : <?php echo $cot['magiangvien'] ?>
    <p></p>
    <strong>Giới Tính</strong> : <?php echo $cot['gioitinh'] ?>
    <p></p>
    <strong>Số Điện Thoại</strong> : <?php echo $cot['sdt'] ?>
    <p></p>
    <strong>Email</strong> : <?php echo $cot['email']; ?>
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Số CCCD</strong> : <?php echo $cot['cccd']; ?>
    <p></p>
    <strong>Địa Chỉ Liên Hệ</strong> : <?php echo $cot['diachi'] ?>
    <p></p>
    <strong>Học Vị</strong> : <?php echo $cot['hocvi'] ?>
    <p></p>
    <strong>Quá Trình Công Tác</strong> : <?php echo $cot['quatrinhcongtac'] ?>
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Cơ Sở Giảng Dạy</strong> : <?php echo $cot['cosogiangday'] ?>
    <p></p>
    <strong>Khoa Giảng Dạy</strong> : <?php echo $cot['tenkhoa'] ?>
    <p></p>
    <strong>Chuyên Môn Ngành</strong> : <?php echo $cot['tenchuyennganh'] ?>
    <p></p>
    <strong>Chứng Chỉ</strong> : <?php echo $cot['chungchi'] ?>
    <p></p>
    <strong>Chứng Chỉ Khác</strong> : <?php echo $cot['chungchikhac'] ?>
    <p></p>
    <strong>Công Trình Khoa Học Tiêu Biểu</strong> : <?php echo $cot['congtrinhkhoahoctieubieu'] ?>
    <p></p>
    </div>
    </div>
    <p></p>
    <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=<?php echo $_REQUEST['page'];?>"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
<?php
}
elseif(isset($_REQUEST['xemchitiet'])){
	include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietSV());
	?>
    <center><strong><h4>Thông Tin Chi Tiết&nbsp;&nbsp;&nbsp;&nbsp;<a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&suatt&&mssv=<?php echo $_REQUEST['mssv'] ?>&&page=<?php echo $_REQUEST['page']; ?>"><img src=
    "https://tse4.mm.bing.net/th?id=OIP.B7zOpV_oMJAcGd85aSujHQHaHa&pid=Api&P=0&h=180"
    height="20px" width="20px" /></a></h4></strong></center>
    <p></p>
    <strong><h5>Thông Tin Tài Khoản</h5></strong>
    <p></p>
    <div>
    <strong>Mã Tài Khoản</strong> : **********  &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Tên Tài Khoản</strong> : <?php echo $cot['tenuser']; ?>
    <p></p>
    <strong>Mật Khẩu</strong> : ********** &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Ảnh</strong> : 
<?php
$anh=$cot['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <img src="<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />
	<?php
}
else{
	?>
	<img src="img/<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />

    <?php
}
?>
</div>
<br />
    <strong><h5>Thông Tin Sinh Viên</h5></strong>
    <p></p>
    <div class="row">
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Tên Sinh Viên</strong> : <?php echo $cot['tensinhvien']; ?>
    <p></p>
    <strong>Mã Số Sinh Viên</strong> : <?php echo $cot['masosinhvien'] ?>
    <p></p>
    <strong>Giới Tính</strong> : <?php echo $cot['gioitinh'] ?>
    <p></p>
    <strong>Ngày Sinh</strong> : <?php 
	   $currentDate = $cot['ngaysinh'];
       $convertedDate = date("d-m-Y", strtotime($currentDate));
	   echo $convertedDate;?>
    <p></p>
    <strong>Số Điện Thoại</strong> : <?php echo $cot['sdt'] ?>
    <p></p>
    <strong>Email</strong> : <?php echo $cot['email']; ?>
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Số CCCD</strong> : <?php echo $cot['cccd']; ?>
    <p></p>
    <strong>Ngày Cấp</strong> : <?php 
	   $currentDate = $cot['ngaycap'];
       $convertedDate = date("d-m-Y", strtotime($currentDate));
	   echo $convertedDate;?>
    <p></p>
    <strong>Nơi Cấp</strong> : <?php echo $cot['noicap'] ?>
    <p></p>
    <strong>Địa Chỉ Liên Hệ</strong> : <?php echo $cot['diachilienhe'] ?>
    <p></p>
    <strong>Hộ Khẩu Thường Trú</strong> : <?php echo $cot['hokhauthuongtru'] ?>
    <p></p>
    <strong>Khóa Học</strong> : <?php echo $cot['khoa'] ?>
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Lớp Học</strong> : <?php echo $cot['lopCN'] ?>
    <p></p>
    <strong>Khoa</strong> : <?php echo $cot['tenkhoa'] ?>
    <p></p>
    <strong>Chuyên Ngành</strong> : <?php echo $cot['tenchuyennganh'] ?>
    <p></p>
    <strong>Cơ Sở Học</strong> : <?php echo $cot['cosodaotao'] ?>
    <p></p>
    <strong>Trạng Thái</strong> : <?php if($cot['trangthai']==0){
		echo "Ngưng Học";
	}
	elseif($cot['trangthai']==1){
		echo "Đang Học";
	}
	elseif($cot['trangthai']==2){
		echo "Đã Tốt Nghiệp";
	}?>
    <p></p>
    </div>
    </div>
    <p></p>
    <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=<?php echo $_REQUEST['page'];?>"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
<?php
}
elseif(isset($_REQUEST['suatt'])){
    include_once("Controller/cTKADHT.php");
	$p=new cTKAD();
	$cot=mysql_fetch_assoc($p->XemChiTietSV());
	?>
    <form action="#" method="post" enctype="multipart/form-data">
    <center><strong><h4>Thông Tin Chi Tiết&nbsp;&nbsp;&nbsp;&nbsp;<a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&suatt&&mssv=<?php echo $_REQUEST['mssv'] ?>&&page=<?php echo $_REQUEST['page']; ?>"><img src=
    "https://tse4.mm.bing.net/th?id=OIP.B7zOpV_oMJAcGd85aSujHQHaHa&pid=Api&P=0&h=180"
    height="20px" width="20px" /></a></h4></strong></center>
    <p></p>
    <strong><h5>Thông Tin Tài Khoản</h5></strong>
    <p></p>
    <div>
    <strong>Mã Tài Khoản</strong> : **********  &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Tên Tài Khoản</strong> : <input type="text" name="a" value="<?php echo $cot['tenuser']; ?>" />
    <p></p>
    <strong>Mật Khẩu</strong> : ********** &nbsp;&nbsp; ( Mã Hóa MD5 )
    <p></p>
    <strong>Ảnh Hiện Tại</strong> : <input type="hidden" name="f1" value="<?php echo $cot['anh']?>" />
<?php
$anh=$cot['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <img src="<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />
	<?php
}
else{
	?>
	<img src="img/<?php echo $anh?>" height="75px" width="75px" class="img-thumbnail" />

    <?php
}
?>
<p></p><strong>Thay Đổi Ảnh</strong>:&nbsp;<input type="file" name="f" value="Thay Đổi Ảnh" />
</div>
<br />
    <strong><h5>Thông Tin Sinh Viên</h5></strong>
    <p></p>
    <div class="row">
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Tên Sinh Viên</strong> : <input type="text" name="b" value="<?php echo $cot['tensinhvien']; ?>" disabled="disabled" />
    <p></p>
    <strong>Mã Số Sinh Viên</strong> : <input type="text" name="c" value="<?php echo $cot['masosinhvien'] ?>" disabled="disabled" />
    <p></p>
    <strong>Giới Tính</strong> : <?php
					if($cot['gioitinh']=='Nam'){
						$nam="checked";
					}
					elseif($cot['gioitinh']=='Nữ'){
						$nu="checked";
					}
	?>
      &nbsp;&nbsp;<input type="radio" name="d" value="Nam" <?php echo $nam ?>   /> Nam &nbsp;&nbsp;&nbsp;<input type="radio" name="d" value="Nữ" <?php echo $nu ?> required="required"  /> Nữ</strong>
    <p></p>
    <strong>Ngày Sinh</strong> : <input type="date" name="e" value="<?php 
	   $currentDate = $cot['ngaysinh'];
       $convertedDate = date("Y-m-d", strtotime($currentDate));
	   echo $convertedDate;?>" required="required"/>
    <p></p>
    <strong>Số Điện Thoại</strong> : <input type="text" name="g" value="<?php echo $cot['sdt'] ?>" />
    <p></p>
    <strong>Email</strong> : <input type="text" name="h" value="<?php echo $cot['email']; ?>" />
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Số CCCD</strong> : <input type="text" name="i" value="<?php echo $cot['cccd']; ?>" />
    <p></p>
    <strong>Ngày Cấp</strong> : <input type="date" name="k" value="<?php 
	   $currentDate = $cot['ngaycap'];
       $convertedDate = date("Y-m-d", strtotime($currentDate));
	   echo $convertedDate;?>" required="required"/>
    <p></p>
    <strong>Nơi Cấp</strong> : <input type="text" name="l" value="<?php echo $cot['noicap'] ?>" />
    <p></p>
    <strong>Địa Chỉ Liên Hệ</strong> : <input type="text" name="m" value="<?php echo $cot['diachilienhe'] ?>" />
    <p></p>
    <strong>Hộ Khẩu Thường Trú</strong> :<p></p> <input type="text" name="n" value="<?php echo $cot['hokhauthuongtru'] ?>" />
    <p></p>
    <strong>Khóa Học</strong> : <?php echo $cot['khoa'] ?>
    </div>
    <div class="col-sm-3 col-md-3 col-md-4 col-lg-4 border">
    <strong>Lớp Học</strong> : <input type="text" name="p" value="<?php echo $cot['lopCN'] ?>" />
    <p></p>
    <strong>Khoa</strong> : <select name="q" onchange="window.location.href=this.value;">
    
    							<option value="#"><?php 
			if(isset($_REQUEST['khoa'])){
				$khoa=$_REQUEST['khoa'];
				if($khoa==1){
					echo "Công Nghệ Thông Tin";
				}
				elseif($khoa==2){
					echo "Quản Trị Kinh Doanh";
				}
				elseif($khoa==3){
					echo "Luật";
				}
				
			}
			else{
					echo $cot['tenkhoa'];
				}
				
		?></option>
								<option class="btn-info" value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=<?php 
								echo $cot['id_khoa']?>"><?php echo $cot['tenkhoa'] ?></option>
                            <?php if($cot['tenkhoa']!='Công Nghệ Thông Tin'){?>
                                <option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=1">Công Nghệ Thông Tin</option>   <?php }
								else {}
								if($cot['tenkhoa']!='Quản Trị Kinh Doanh'){?>
                                
                                <option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=2">Quản Trị Kinh Doanh</option> <?php }
								else {}
								if($cot['tenkhoa']!='Luật'){?>
								
                                <option value="quanlytaikhoan.php?suatt&&mssv=<?php echo $_REQUEST['mssv']; ?>&&khoa=3">Luật</option>
                                 <?php }
								else {}?>
                            </select>
    <p></p>
    <strong>Chuyên Ngành</strong> : 
    <select name="r">
    <option value="<?php echo $cot['id_chuyennganh'] ?>"> <?php echo $cot['tenchuyennganh'];?> </option>
    <option class="btn-info" disabled="disabled"><?php echo $cot['tenchuyennganh'] ?></option>
    <?php 
	if(isset($_REQUEST['khoa'])){
		$p=new cTKAD();
		$a=$p->chuyenganh();
		while($c=mysql_fetch_assoc($a)){
	?>
    <option value="<?php echo $c['id_chuyennganh']; ?>"><?php echo $c['tenchuyennganh']; ?></option>
    <?php
	}
	
}
	?>
    </select>
    <p></p>
    <strong>Cơ Sở Học</strong> : <?php echo $cot['cosodaotao'] ?>
    <p></p>
    <strong>Trạng Thái</strong> : <select name="s">
    <option value="<?php echo $cot['trangthai'] ?>" class="btn-info"><?php if($cot['trangthai']==0){
		echo "Ngưng Học";
	}
	elseif($cot['trangthai']==1){
		echo "Đang Học";
	}
	elseif($cot['trangthai']==2){
		echo "Đã Tốt Nghiệp";
	}
	if($cot['trangthai']!=0){?>
    <option value="0">Ngưng Học</option>
    <?php 
	} else{}
	if($cot['trangthai']!=1){
	?>
    <option value="1">Đang Học</option>
    <?php }
	else{
	}
	if($cot['trangthai']!=2){
	?>
    <option value="2">Đã Tốt Nghiệp</option>
    <?php } else{}?>
    </select>
    </div>
    </div>
    <p></p>
    <center>
    <input type="submit" name="luutt" value="Lưu Thay Đổi" />
    </center>
    <p></p>
    </form>
    <p></p>
        <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&xemchitiet&&mssv=<?php echo $_REQUEST['mssv']?>&&page=<?php echo $_REQUEST['page'];?>"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
    <?php
}
elseif(isset($_REQUEST['themgv'])){
	?>
	  <p></p>
    <center><h5>Cấp Tài Khoản Giảng Viên</h5></center>
	<form action="#" method="POST" enctype="multipart/form-data">
    <br />
    <center>
    	Tải File Excel để cấp tài khoản tại đây ! 
        <p></p>
        &nbsp;<input type="file" name="f" required="required"  />
        <p></p>
        &nbsp;<input type="submit" value="Tải lên" name="submit" />
        <p></p>
        <p>Đây là mẫu dữ liệu file nhập để cấp tài khoản. Để lấy 
        file mẫu vui lòng bấm tải xuống !</p>
        <a href="taixuong.php?fu=File_Cap_Tai_Khoan.xlsx"><img src=
        "https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" height="20px" width="20px" /></a>
        &nbsp;&nbsp;<a href="taixuong.php?fu=File_Cap_Tai_Khoan.xlsx">Mau_Cap_Tai_Khoan.xlsx</a>
        <p></p>
        <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&gv&&page=1"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
        <br />
        </center>
    </form>
<?php
if(isset($_REQUEST['themgv'])){
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
$sheet = $objPHPExcel->setActiveSheetIndex(1);

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
// Kiểm tra file nhập vào có đúng ko ?
$sheet = $objPHPExcel->setActiveSheetIndex(1);
$tdmtk= $sheet->getCellByColumnAndRow(1,1)->getValue();
$tdmgv= $sheet->getCellByColumnAndRow(7,1)->getValue();
if($tdmtk !="Mã Tài Khoản" || $tdmgv !="Mã Giảng Viên"){
	echo "<script>alert('Chọn không đúng file excel để cấp tài khoản !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
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
		/* Kiểm tra có mã tồn tại sẽ không được thêm vào nhe ! */
		echo "<center>Mã giảng viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
	}
	elseif(mysql_num_rows($qr1)==1){
		/* Kiểm tra có mã tồn tại sẽ không được thêm vào nhe ! */
		echo "<center>Mã giảng viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
	}
	elseif($mgv==null||$ma1==null){
		/* Kiểm tra nếu mã giảng viên null sẽ không được thêm vào ! */
	}
	else
	{
	 $sql="insert into user(user_code,tenuser,matkhau,vaitro,email,cccd,anh) values ('$ma1','$ttk',
	 '$mk1',1,'$email','$cccd','$anh')";
	 $qr=mysql_query($sql);
	 $sq2="insert into giangvien(user_id) select user_id from user where user_code='$ma1'";
     $qr2=mysql_query($sq2);
	 $sq3="update giangvien set hotengiangvien='$tengv', magiangvien='$mgv', gioitinh='$gioitinh',
	 sdt='$sdt', diachi='$diachi', hocvi= '$hocvi', quatrinhcongtac='$qtct', cosogiangday='$csgd', 
	 chungchi='$chungchi',chungchikhac='$chungchikhac', congtrinhkhoahoctieubieu='$congtrinh', id_chuyennganh='$id_cn'
	 where user_id=(select user_id from user where user_code='$ma1' )";
     $qr3=mysql_query($sq3);
	 echo header("refresh:0,url='quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&gv&&page=1'");
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
}
elseif(isset($_REQUEST['them'])){
	?>
    <p></p>
    <center><h5>Cấp Tài Khoản Sinh Viên</h5></center>
    <center>
	<form action="#" method="POST" enctype="multipart/form-data">
    <br />
    	Tải File Excel để cấp tài khoản tại đây ! 
        <p></p>
        &nbsp;<input type="file" name="f" required="required"  />
        <p></p>
        &nbsp;<input type="submit" value="Tải lên" name="submit" />
        <p></p>
        <p>Đây là mẫu dữ liệu file nhập để cấp tài khoản. Để lấy 
        file mẫu vui lòng bấm tải xuống !</p>
        <a href="taixuong.php?fu=File_Cap_Tai_Khoan.xlsx"><img src=
        "https://tse1.mm.bing.net/th?id=OIP.AxDKEs7Zk8uNUi031XqRjwHaG4&pid=Api&rs=1&c=1&qlt=95&w=116&h=107" height="20px" width="20px" /></a>
        &nbsp;&nbsp;<a href="taixuong.php?fu=File_Cap_Tai_Khoan.xlsx">Mau_Cap_Tai_Khoan.xlsx</a>
        <p></p>
        <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>&&sv&&page=1"><img src="https://tse1.mm.bing.net/th?id=OIP.xytvDRJGGtohdt-PzxanOAHaHa&pid=Api&P=0&h=180" 
        height="30px" width="30px" /></a></center>
        <p></p>
    </form>
     <br />
    </center>
<?php
if(isset($_REQUEST['them'])){
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
include "class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "phucable@gmail.com";
$mail->Password = "afbv blky ofzi vzsy";
$mail->SetFrom("quantrihethong@gmail.com");

// Kiểm tra file nhập vào có đúng ko ?
$tdmtk= $sheet->getCellByColumnAndRow(1,1)->getValue();
$tdmssv= $sheet->getCellByColumnAndRow(7,1)->getValue();
if($tdmtk!="Mã Tài Khoản" || $tdmssv!="Mã Số Sinh Viên"){
	echo "<script>alert('Chọn không đúng file excel để cấp tài khoản !')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
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
		/* Kiểm tra có mã tồn tại sẽ không được thêm vào nhe ! */
		
		echo "<center>Mã số sinh viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
		
	}
	elseif(mysql_num_rows($qr1)==1){
		/* Kiểm tra có mã tồn tại sẽ không được thêm vào nhe ! */
		echo "<center>Mã số sinh viên &nbsp;" .$ma."&nbsp;có trong hệ thống rồi !<br/></center>";
		?>
        Sinh Viên <?php
		$s=mysql_fetch_assoc($qr1);
		echo $s['tensinhvien']; ?> Có MSSV <?php echo $s['masosinhvien'] ?> Đã Có Trong Hệ Thống !
        <?php
	}
	elseif($mssv==null||$ma1==null){
		/* Kiểm tra nếu mã null sẽ không được thêm vào */
	}
	else
	{
     $sql="insert into user(user_code,tenuser,matkhau,vaitro,email,cccd,anh) values ('$ma1','$ttk',
	 '$mk1',0,'$email','$socccd','$anh')";
	 $qr=mysql_query($sql);
	 $sq2="insert into sinhvien(user_id) select user_id from user where user_code='$ma1'";
     $qr2=mysql_query($sq2);
	 $sq3="update sinhvien set tensinhvien='$tensv', masosinhvien='$mssv', gioitinh='$gioitinh', ngaysinh='$ngaysinh',
	 sdt='$sdt', ngaycap='$ngaycap', noicap='$noicap', diachilienhe='$diachi', hokhauthuongtru= '$hokhau', ngayvaotruong='$ngayvt', 
	 khoa='$khoa', lopCN='$lop', cosodaotao='$csdt', trangthai='$trangthai', id_chuyennganh='$id_cn'
	 where user_id=(select user_id from user where user_code='$ma1' )";
     $qr3=mysql_query($sq3);
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
}
elseif(isset($_REQUEST['taiexcel'])){
	?>
    <p></p>
    <center><h5>Tải Danh Sách Sinh Viên Theo Chuyên Ngành</h5></center>
    <p></p>
    <center>
    <form action="#" method="post" enctype="multipart/form-data">
    	Chọn chuyên ngành: &nbsp;<select name="a" onchange="window.location.href=this.value;">
        <option value="<?php echo $_REQUEST['ic'] ?>" class="btn-info"><?php
		if($_REQUEST['ic']){
			echo $_REQUEST['tic'];
		}
		else{
			echo "Chọn chuyên ngành";
		}
        ?></option>
        <?php
		include_once("Model/mKetNoiADHT.php");
		$p=new ketnoiAD();
		$p->ketnoi($ketnoi);
		$sql="select * from chuyennganh";
		$qr= mysql_query($sql);
		while($h=mysql_fetch_assoc($qr)){
			?>
            <option value="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm'] ?>&&taiexcel&&ic=<?php echo $h['id_chuyennganh'] ?>&&tic=<?php echo $h['tenchuyennganh'] ?>"><?php  
			echo $h['tenchuyennganh'];?></option>
            <?php
		}
		
		?>
        </select>
        <p></p>
        <input type="submit" name="tex" value="Tải" />
    </form>
    </center>
     <br />
    <?php
}
else{
?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
            <br />
           <h5> &nbsp;&nbsp;Giới thiệu chức năng "Quản Lý Người Dùng"</h5>
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
<br />
<!--Đây là phần footer-->
<p></p>
<center><a href="homeAD.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="https://tse4.mm.bing.net/th?id=OIP.GcRlpNTMNf06GOD3l3pILgHaHa&pid=Api&P=0&h=180"
height="30px" width="30px" /></a></center>
<p></p>
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
<?php ob_end_flush(); ?>