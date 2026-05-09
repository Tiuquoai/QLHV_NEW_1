<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home AD Hệ Thống</title>
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
	@media(max-width:1000px){

		.table th, .table td {
    padding: 0.25rem !important;
		}
		html{
			    -webkit-text-size-adjust: 85%;
		}
		body{
			font-size:.1.12rem;
		}
		.container {
    max-width: 1000px;
}
body{
	font-size: 25px;
	font-weight: 300;
}
h5, p{
	font-size:30px;
}
		
}
@media (max-width: 300px){
.container {
    max-width: 500px;
    margin-left: -12px;
    font-size: 19px;
}
}
</style>
</head>
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


<body>
<div class="container mw-100 full-width-div border">

<div class="row row header"  id="codinh">
<!--Đây là phần banner-->

<div class="container mw-100 border">

<div class="row header"  id="codinh">
<!--Đây là phần banner-->
<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Trang Admin Hệ Thống</p> 
<br>
<br />
<br />
</div>
<p></p>
</div>
<br/>
<center><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></center>
<br />
<br />
<br />
<br />
<br />
<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src=
     "https://tse3.mm.bing.net/th?id=OIP.wFwP5BpcST1h0qds6Tz9fQHaHA&pid=Api&P=0&h=100&w=100"/></a><br /></center>
     <center><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>">Quản Lý Chung</a></center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse4.mm.bing.net/th?id=OIP.9IwgOXmpwMDGFmzb6LpUoQHaHa&pid=Api&P=0&h=100&w=100"/></a><br /></center>
     <center><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>">Quản Lý Tài Khoản User</a></center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.DMvXnqOWQX1W7jPT7S4z1QHaHa&pid=Api&P=0&h=100&w=100"/></a><br /></center>
     <center><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>">Quản Lý Học Phần</a></center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><a href="info2.php?user=<?php echo $_REQUEST['bm'] ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.s4tbDYPeiJIcNO7NUV69KwHaHa&pid=Api&P=0&h=100&w=100"/></a><br /></center>
     <center><a href="info2.php?user=<?php echo $_REQUEST['bm'] ?>">Thông Tin Admin</a></center>
    </div>
    <?php /* ?>
	<div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP.Q9vTiQlYO5jp9oFOdaKxIQAAAA&pid=Api&P=0&h=100&w=100"/><br /></center>
     <center>Quản Lý Điểm</center>
    </div>
</div>
<br/>
<br/>
<br/>
<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP.34udK5xHyu3Q1WdJ03LJBgHaHa&pid=Api&h=100&w=100"/><br /></center>
     <center>Quản Lý Biểu Mẫu Học Vụ</center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse4.mm.bing.net/th?id=OIP.9ocbe0BGVIzJRTGWa1UBmQHaHe&pid=Api&&h=100&w=100"/><br /></center>
     <center>Quản Lý Các Hoạt Động</center>
    </div>
     <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP._jJmyMhEJ-OzMR-QeGo2LQAAAA&pid=Api&h=100&w=100"/><br /></center>
     <center>Quản Lý Tin Tức</center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><a href="info2.php?user=<?php echo $_REQUEST['bm'] ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.s4tbDYPeiJIcNO7NUV69KwHaHa&pid=Api&P=0&h=100&w=100"/></a><br /></center>
     <center><a href="info2.php?user=<?php echo $_REQUEST['bm'] ?>">Thông Tin Admin</a></center>
    </div>
	<div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse4.mm.bing.net/th?id=OIP.BHU3P0qKU9f971doXYN2QwHaHa&pid=Api&h=100&w=100"/><br /></center>
     <center>Quản Lý Xử Lý Học Vụ</center>
    </div>
	<?php */?>
</div>
<br/>
<br/>
<br/>
<div class="row">
	 <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     
    </div>
	<div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     
    </div>
</div>

<br/>
<br />
<br />
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