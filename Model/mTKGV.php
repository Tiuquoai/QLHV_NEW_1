<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
include_once("mKetNoiGV.php");

class mTKGV{
// Kiểm tra tài khoản Giảng Viên
function KTTKGV(){
	$p=new ketnoigv($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['dngv'])){
			$ma=md5($_POST['a']);
			$mk=md5($_POST['p']);
			$sql="select * from user where user_code='$ma' && matkhau='$mk' && vaitro='1'";
			$qr=mysql_query($sql);
			return $qr;
		}
		else{
			echo "<script>alert('Không có submit')</script>";
		}
	}
	else{
		return false;
	}
}
// Xuất Thông Tin Giảng Viên
function XuatInfo(){
	$p=new ketnoiGV($ketnoi);
	if($p->ketnoi($ketnoi)){
		    $user=$_REQUEST['bm'];
			$sql="select *from user u join giangvien gv on u.user_id = gv.user_id
			join chuyennganh cn on cn.id_chuyennganh=gv.id_chuyennganh join khoavien kv on kv.id_khoa=cn.id_khoa
			where user_code='$user'";
			$qr=mysql_query($sql);
			return $qr;
	}
}
// Cập Nhật Thông Tin Giảng Viên
function CapNhatInfoGV(){
	$p=new ketnoiGV($ketnoi);
	if($p->ketnoi($ketnoi)){
		    if(isset($_POST['capnhatgv'])){
			$user=$_REQUEST['bm'];
			$a=$_POST['dt'];
			$b=$_POST['email'];
			$c=$_POST['diachi'];
			$d=$_POST['trinhdo'];
			$e=$_POST['quatrinhcongtac'];
			$f=$_POST['chungchi'];
			$g=$_POST['chungchikhac'];
			$h=$_POST['congtrinhkhoahoc'];
			$sql="update user set email='$b' where user_code='$user'";
			$qr=mysql_query($sql);
			return $qr;
			}
	}
}
function CapNhatInfoGV1(){
	$p=new ketnoiGV($ketnoi);
	if($p->ketnoi($ketnoi)){
		    if(isset($_POST['capnhatgv'])){
			$user_id=$_POST['id'];
			$a=$_POST['dt'];
			$b=$_POST['email'];
			$c=$_POST['diachi'];
			$d=$_POST['trinhdo'];
			$e=$_POST['quatrinhcongtac'];
			$f=$_POST['chungchi'];
			$g=$_POST['chungchikhac'];
			$h=$_POST['congtrinhkhoahoc'];
			$gt=$_POST['gt'];
			$sql="update giangvien set diachi='$c', sdt='$a', hocvi='$d', quatrinhcongtac='$e', 	 
			chungchi='$f', chungchikhac='$g', congtrinhkhoahoctieubieu='$h', gioitinh='$gt'
			where user_id='$user_id'";
			$qr=mysql_query($sql);
			return $qr;
			}
	}
}
//Kiểm tra bm
function ktbm(){
	$p=new ketnoiGV($ketnoi);
	if($p->ketnoi($ketnoi)){
		$bm= $_REQUEST['bm'];
		$sql="select * from user where user_code='$bm'";
		$qr=mysql_query($sql);
		return $qr;
	}
}
//Xác minh tài khoản tồn tại
function Tim1(){
	$p=new ketnoiGV($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['kiemtra1'])){
			$ma=md5($_POST['ma']);
			$ht=$_POST['ht'];
			$cccd=$_POST['cccd'];
			$email=$_POST['email'];
			$sql="select * from user u join giangvien gv
			on u.user_id=gv.user_id where u.user_code='$ma' and gv.hotengiangvien='$ht' and u.cccd='$cccd' and u.email='$email'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
}
?>
</body>
</html>
