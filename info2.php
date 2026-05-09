<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thông Tin Admin</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
textarea{
	height:200px;
	width: 1000px;
}
a{
	color: #000;
}
a:hover{
	color: #000;
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
</style>
</head>

<body>
<div class="container mw-100 border">

<div class="row header"  id="codinh">
<!--Đây là phần banner-->
<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Gọi Điện: 0143.234.563 - ext 808 &nbsp; &nbsp; Email: csm@gmail.com</p> 
</div>
<p></p>
</div>
<div>
<br />
<?php
session_start();
if(!isset($_REQUEST['user'])){
	echo header("refresh:0,url='index.php'");
}
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
$ma=$_REQUEST['user'];
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
$bm=$_REQUEST['user'];
$sql="select * from admin a join user u on a.user_id=u.user_id where u.user_code='$bm'";
$qr=mysql_query($sql);
$x=mysql_fetch_assoc($qr);
$a= $x['user_code'];
$b= $_REQUEST['user'];
if(!isset($_REQUEST['user'])){
	echo header("refresh:0,url='index.php");
}
if($b != $a){
	echo header("refresh:0,url='index.php");
}

$anh=$x['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <center><img src="<?php echo $anh?>" height="150px" width="150px" class="rounded-circle" /></center>
	<?php
}
else{
	?>
	<center><img src="img/<?php echo $anh?>" height="150px" width="150px" class="rounded-circle" /></center>
    <?php
}
?>
<p></p>
    <center><?php echo "<p>".$x['hotenadmin']."</p>" ?></center>
    <p align="right"><a href="info2.php?user=<?php echo $_REQUEST['user'] ?>&&dmk">Đổi mật khẩu ?</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="dxuat.php?xuat">Đăng Xuất</a></p>
    <br />
    <?php
	if(isset($_POST['s'])){
		$a=$_POST['a'];
		$id=$x['user_id'];
		$sql="update admin set loigioithieu='$a' where user_id='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='info2.php?user=".$_REQUEST['user']."'");
	}
	?>
        <div class="row">
          <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
          </div>
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 border">
          <?php
			if(isset($_REQUEST['lgt'])){
		?>
        <form action="#" method="post">
        <p></p>
        <center><textarea name="a" placeholder="Nhập Lời Giới Thiệu ..."></textarea></center>
        <p></p>
        <center><input type="submit" name="s" value="Lưu" /></center>
        </form>
        <p></p>
        <?php
	}
	elseif(isset($_REQUEST['dmk'])){
		 ?>
         <form action="#" method="post">
         	<div class="row">
            	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <center><h5>Đổi Mật Khẩu</h5></center>
                <p></p>
                <center>
                <?php
				if(isset($_POST['d'])){
					$ma=$_REQUEST['user'];
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
						echo "<script>alert(' Đổi mật khẩu hoàn tất !')</script>";
					}
				}
				?>
                <form action="#" method="post" enctype="multipart/form-data">
                <p></p>
                Mật Khẩu Cũ: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="xm" required="required"/>
                <p></p>
                Mật Khẩu Mới:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="a" required="required" />
                <p></p>
                Nhập Lại Mật Khẩu:&nbsp;<input type="password" name="b"  required="required"/>
                <p></p>
                <input type="submit" name="d" value="OK" />
                </form>
                </center>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                </div>
            </div>
         </form>
         
         <?php
	 }
	else{
		?>
        	 <?php if(isset($_REQUEST['user'])){
		?>
        	<strong>Lời giới thiệu</strong>&nbsp;&nbsp;<a href="info2.php?user=<?php echo $_REQUEST['user']; ?>&&lgt"><img src=
            "https://tse2.mm.bing.net/th?id=OIP.ZWndpu_3Ka00XdinCiH1tAHaHa&pid=Api&P=0&h=180"
            height="50px" width="50px"  /></a>
            <p></p>
        <?php
			if($x['loigioithieu']==null){
				echo "Người này lười ghê ! Không ghi gì cả ...";
			}
			else{
				echo $x['loigioithieu'];
			}
			?>
            <p></p>
           </div>
           <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
           </div>
             <?php
	}
	}
	?>
        </div>
        </div>
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
</body>
</html>