<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
include_once("mKetNoiSV.php");

class mTKSV{
// Kiểm tra tài khoản Sinh Viên
function KTTKSV(){
	// var_dump($_POST);
	// echo '\n';
	$p = new ketnoisv($ketnoi);
	if($p->ketnoi($ketnoi)){
		// echo 'con sadada';
		if(isset($_POST['dn'])){
			$ma=md5($_POST['a']);
			$mk=md5($_POST['p']);
			$sql="SELECT * FROM user WHERE user_code='$ma' && matkhau='$mk' && vaitro='0'";
			// echo $sql;
			// var_dump($ma);
			// var_dump($mk);
			$qr=mysql_query($sql) ;
			// var_dump($qr);
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
//Xác minh tài khoản tồn tại
function Tim(){
	$p=new ketnoiSV($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['kiemtra'])){
			$ma=md5($_POST['ma']);
			$ht=$_POST['ht'];
			$cccd=$_POST['cccd'];
			$email=$_POST['email'];
			$sql="select * from user u join sinhvien sv
			on u.user_id=sv.user_id where u.user_code='$ma' and sv.tensinhvien='$ht' and u.cccd='$cccd' and u.email='$email'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Xuất Thông Tin Sinh Viên
function XuatInfo(){
	$p=new ketnoiSV();
	if($p->ketnoi($ketnoi)){
		    $user=$_REQUEST['bm'];
			$sql="select *from user u join sinhvien sv on u.user_id = sv.user_id
			join chuyennganh cn on cn.id_chuyennganh=sv.id_chuyennganh join 
			khoavien kv on kv.id_khoa=cn.id_khoa
			where user_code='$user'";
			$qr=mysql_query($sql);
			return $qr;
	}
}
// Cập Nhật Thông Tin Sinh Viên
function CapNhatInfo(){
	$p=new ketnoiSV($ketnoi);
	if($p->ketnoi($ketnoi)){
		    if(isset($_POST['capnhat'])){
			$user=$_REQUEST['bm'];
			$gt=$_POST['c'];
			$ns=$_POST['d'];
			$conNS = date("Y-m-d", strtotime($ns));
			$ngaysinh=$conNS;
			$dt=$_POST['e'];
			$email=$_POST['f'];
			$cccd=$_POST['g'];
			$nc=$_POST['h'];
			$conNC1 = date_create($nc);
			$conNC= date_format($conNC1, 'Y-m-d');
			$ngaycap=$conNC;
			$noicap=$_POST['i'];
			$hktt=$_POST['k'];
			$sql="update user set email='$email', cccd='$cccd' 
			where user_code='$user'";
			$qr=mysql_query($sql);
			return $qr;
			}
	}
}
function CapNhatInfo1(){
	$p=new ketnoiSV($ketnoi);
	if($p->ketnoi($ketnoi)){
		    if(isset($_POST['capnhat'])){
			$user_id=$_POST['id'];
			$gt=$_POST['c'];
			$ns=$_POST['d'];
			$conNS = date("d-m-Y", strtotime($ns));
			$ngaysinh=$conNS;
			$dt=$_POST['e'];
			$email=$_POST['f'];
			$cccd=$_POST['g'];
			$nc=$_POST['h'];
			$conNC = date("d-m-Y", strtotime($nc));
			$ngaycap=$conNC;
			$noicap=$_POST['i'];
			$hktt=$_POST['k'];
			$sql="update sinhvien set gioitinh='$gt', ngaysinh='$ngaysinh', sdt='$dt', ngaycap='$ngaycap', noicap='$noicap', 	 
			hokhauthuongtru='$hktt'
			where user_id='$user_id'";
			$qr=mysql_query($sql);
			return $qr;
			}
	}
}
}
?>

</body>
</html>