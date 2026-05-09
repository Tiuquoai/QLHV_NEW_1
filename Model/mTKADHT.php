<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
include_once("mKetNoiADHT.php");

class mTKAD{
// Kiểm tra tài khoản admin
function KTTKAD(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['dnad'])){
			$ma=md5($_POST['a']);
			$mk=md5($_POST['p']);
			$sql="select * from user where user_code='$ma' && matkhau='$mk' && vaitro='2'";
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
// Thay đổi mật khẩu sinh viên/ giảng viên
function cnmk(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['td'])){
			$p=md5($_POST['p']);
			$email=$_REQUEST['e'];
			$sql="update user set matkhau='$p' where email='$email'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
	
}

// Lấy danh sách tài khoản là sinh viên
function laydanhsach(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['sv'])){
			$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:5;
			$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
			$start_from = ($tranghientai-1) * $bangghimoitrang;
			$sql="select * from user u join sinhvien sv on u.user_id=sv.user_id where u.vaitro='0' limit $start_from,$bangghimoitrang";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function sotrangcanthiet(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
			$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:5;
			$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
			$sql ="select count(user_code) from user u join sinhvien sv on u.user_id=sv.user_id where u.vaitro='0'";
			$qr=mysql_query($sql); 
    		$cot = mysql_fetch_row($qr);  
    		$tongbangghi = $cot[0];  
   		    $tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
			include_once("Controller/cPage.php");
			return $tongsotrang;
		}

	}
// Xem chi tiết Sinh Viên theo MSSV
function XemChiTietSV(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['mssv'])){
			$mssv=$_REQUEST['mssv'];
			$sql="select * from user u join sinhvien sv on u.user_id=sv.user_id
			join chuyennganh cn on cn.id_chuyennganh=sv.id_chuyennganh join khoavien kv
			on kv.id_khoa=cn.id_khoa where u.vaitro='0' and user_code='$mssv' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Xóa Sinh Viên
function xoa(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['xoa'])){
			$id=$_REQUEST['xoasv'];
			$sql="delete from sinhvien where md5(user_id)='$id' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function xoa1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['xoa'])){
			$id=$_REQUEST['xoasv'];
			$sql="delete from user where md5(user_id)='$id' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function xuatchuyennganh(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['khoa'])){
			$id=$_REQUEST['khoa'];
			$sql="select * from khoavien kv join chuyennganh cn on kv.id_khoa=cn.id_khoa
			where kv.id_khoa='$id'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Sửa thông tin sinh viên
function suattsv(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['luutt'])){
			$tentk=$_POST['a'];
			$anh=$_FILES['f']['name'];
			if($anh==null){
				$anh=$_POST['f1'];
			}
			$tensv=$_POST['b'];
			$ms=$_POST['c'];
			$gt=$_POST['d'];
			$ngaysinh=$_POST['e'];
			$sdt=$_POST['g'];
			$email=$_POST['h'];
			$cccd=$_POST['i'];
			$ngaycap=$_POST['k'];
			$noicap=$_POST['l'];
			$diachi=$_POST['m'];
			$hokhau=$_POST['n'];
			$lop=$_POST['p'];
			$khoa=$_POST['q'];
			$cn=$_POST['r'];
			$trangthai=$_POST['s'];
			$mssv=$_REQUEST['mssv'];
			$sql="update user set tenuser='$tentk', email='$email', cccd='$cccd', anh='$anh' where user_code='$mssv'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function suattsv1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['luutt'])){
			$tentk=$_POST['a'];
			$anh=$_POST['f'];
			if($anh==null){
				$anh=$_POST['f1'];
			}
			$tensv=$_POST['b'];
			$ms=$_POST['c'];
			$gt=$_POST['d'];
			$ns=$_POST['e'];
			$conNS = date("Y-m-d", strtotime($ns));
			$ngaysinh=$conNS;
			$sdt=$_POST['g'];
			$email=$_POST['h'];
			$cccd=$_POST['i'];
			$nc=$_POST['k'];
			$conNC = date("Y-m-d", strtotime($nc));
			$ngaycap=$conNC;
			$noicap=$_POST['l'];
			$diachi=$_POST['m'];
			$hokhau=$_POST['n'];
			$lop=$_POST['p'];
			$cn=$_POST['r'];
			$trangthai=$_POST['s'];
			$mssv=$_REQUEST['mssv'];
			$sql="update sinhvien set gioitinh='$gt', ngaysinh='$ngaysinh', sdt='$sdt', ngaycap='$ngaycap', noicap='$noicap',
			diachilienhe='$diachi', hokhauthuongtru='$hokhau', lopCN='$lop', id_chuyennganh='$cn', trangthai='$trangthai'  where 
			md5(masosinhvien)='$mssv'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Kiểm tra bảo mật
function ktbm(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['bm'])){
			$bm=$_REQUEST['bm'];
			$sql="select * from user where user_code='$bm'  ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Lọc sinh viên
function loc(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['loc'])){
			$ht=$_POST['ht'];
			$mssv=$_POST['mssv'];
			$sql="select * from sinhvien where tensinhvien='$ht' and masosinhvien='$mssv' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}

// Lấy danh sách tài khoản là giảng viên
function laydanhsachgv(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['gv'])){
			$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:5;
			$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
			$start_from = ($tranghientai-1) * $bangghimoitrang;
			$sql="select * from user u join giangvien gv on u.user_id=gv.user_id where u.vaitro='1' limit $start_from,$bangghimoitrang";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function sotrangcanthietgv(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
			$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:5;
			$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
			$sql ="select count(user_code) from user u join giangvien gv on u.user_id=gv.user_id where u.vaitro='1'";
			$qr=mysql_query($sql); 
    		$cot = mysql_fetch_row($qr);  
    		$tongbangghi = $cot[0];  
   		    $tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
			include_once("Controller/cPageGV.php");
			return $tongsotrang;
		}

	}
// Lọc sinh viên
function loc1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['loc1'])){
			$ht=$_POST['htgv'];
			$mgv=$_POST['mgv'];
			$sql="select * from giangvien where hotengiangvien='$ht' and magiangvien='$mgv' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Xem chi tiết giảng viên theo mã giảng viên
function XemChiTietGV(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['mgv'])){
			$mgv=$_REQUEST['mgv'];
			$sql="select * from user u join giangvien gv on u.user_id=gv.user_id
			join chuyennganh cn on cn.id_chuyennganh=gv.id_chuyennganh join khoavien kv
			on kv.id_khoa=cn.id_khoa where u.vaitro='1' and user_code='$mgv' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}

// Sửa thông tin giảng viên
function suattgv(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['ltd'])){
			$ma=$_REQUEST['mgv'];
			$tenuser=$_POST['a'];
			$anh=$_FILES['f']['name'];
			if($anh==null){
				$anh=$_POST['f1'];
			}
			$hoten=$_POST['b'];
			$gt=$_POST['c'];
			$sdt=$_POST['d'];
			$email=$_POST['e'];
			$cccd=$_POST['g'];
			$diachi=$_POST['h'];
			$hocvi=$_POST['i'];
			$qtct=$_POST['k'];
			$cs=$_POST['l'];
			$chungchi=$_POST['m'];
			$chungchikhac=$_POST['p'];
			$ctkh=$_POST['q'];
			$sql="update user set tenuser='$tenuser', email='$email', cccd='$cccd', anh='$anh' where user_code='$ma'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function suattgv1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['ltd'])){
			$ma=$_REQUEST['mgv'];
			$tenuser=$_POST['a'];
			$anh=$_FILES['f'];
			$hoten=$_POST['b'];
			$gt=$_POST['c'];
			$sdt=$_POST['d'];
			$email=$_POST['e'];
			$cccd=$_POST['g'];
			$diachi=$_POST['h'];
			$hocvi=$_POST['i'];
			$qtct=$_POST['k'];
			$cs=$_POST['l'];
			$chungchi=$_POST['m'];
			$chungchikhac=$_POST['p'];
			$ctkh=$_POST['q'];
			$sql="update giangvien set hotengiangvien='$hoten', gioitinh='$gt', sdt='$sdt', diachi='$diachi'
			, hocvi='$hocvi', quatrinhcongtac='$qtct', cosogiangday='$cs', chungchi='$chungchi', chungchikhac='$chungchikhac',
			congtrinhkhoahoctieubieu='$ctkh' where md5(magiangvien)='$ma'";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Xóa Giảng Viên
function xoagv(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['xoagvien'])){
			$id=$_REQUEST['xoagvien'];
			$sql="delete from giangvien where md5(user_id)='$id' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
function xoagv1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_REQUEST['xoagvien'])){
			$id=$_REQUEST['xoagvien'];
			$sql="delete from user where md5(user_id)='$id' ";
			$qr=mysql_query($sql);
			return $qr;
		}
	}
}
// Lấy ra danh sách lớp học phần
function dslhp(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		$sql="select * from hocphan hp join monlop m on hp.id_hocphan=m.id_hocphan
		join lophocphan l on m.id_lophocphan=l.id_lophocphan";
		$qr=mysql_query($sql);
		return $qr;
	}
}
// Lấy ra danh sách môn học phần
function dsmhp(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		$sql="select * from hocphan";
		$qr=mysql_query($sql);
		return $qr;
	}
}
// Xem chi tiết học phần
function cthp(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		$ma=$_REQUEST['xem'];
		$sql="select * from hocphan hp join ct_hocphan ct on hp.id_hocphan=ct.id_hocphan
		join khoavien kv on kv.id_khoa=hp.id_khoa
		where md5(hp.mahocphan)='$ma'";
		$qr=mysql_query($sql);
		return $qr;
	}
}
// Cập nhật học phần
function cnhp1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['s1'])){
			$thp=$_POST['a'];
			$mhp=$_POST['b'];
			$khoacq=$_POST['g'];
			$ma=$_REQUEST['xem'];
				$sql="update hocphan set tenhocphan='$thp', id_khoa='$khoacq' where md5(mahocphan)='$ma'";
				$qr=mysql_query($sql);
				return $qr;
		}
	}
}
function cnhp2(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		if(isset($_POST['s1'])){
	$ihp=$_REQUEST['ihp'];
			$l=$_POST['m'];
			$stc=$_POST['c'];
			$tclt=$_POST['d'];
			$tcth=$_POST['e'];
	$sql="update ct_hocphan set loaihp='$l', soTC='$stc', TCLT='$tclt', TCTH='$tcth'
	where md5(id_hocphan)='$ihp' ";
				$qr=mysql_query($sql);
				return $qr;
	}
	}
}
// Xóa học phần theo mã học phần
function xoahp(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		$id= $_REQUEST['xoaihp'];
		$sql="delete from hocphan where md5(id_hocphan)='$id' ";
		$qr=mysql_query($sql);
		return $qr;
	}
}
function xoahp1(){
	$p=new ketnoiad($ketnoi);
	if($p->ketnoi($ketnoi)){
		$id= $_REQUEST['xoaihp'];
		$sql="delete from ct_hocphan where md5(id_hocphan)='$id' ";
		$qr=mysql_query($sql);
		return $qr;
	}
}

}
?>
</body>
</html>