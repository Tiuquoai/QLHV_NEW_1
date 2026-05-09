<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
include_once("Model/mTKADHT.php");
class cTKAD{
	function KiemTraTKAD(){
		$p=new mTKAD();
		$kt=$p->KTTKAD();
		return $kt;
	}
	function CapNhatMatKhauKH(){
		$p=new mTKAD();
		$kt=$p->cnmk();
		return $kt;
	}
	// lấy danh sách tài khoản sinh viên
	function laydanhsach(){
		$p=new mTKAD();
		$lay=$p->laydanhsach();
		return $lay;
	}
	function Page(){
		$p=new mTKAD();
		$lay=$p->sotrangcanthiet();
		return $lay;
	}
	// Xem chi tiết Sinh Viên theo MSSV
    function XemChiTietSV(){
		$p=new mTKAD();
		$lay=$p->XemChiTietSV();
		return $lay;
	}
	// Xóa sinh viên
	function xoa(){
		$p=new mTKAD();
		$xoa=$p->xoa();
		return $xoa;
	}
	function xoa1(){
		$p=new mTKAD();
		$xoa=$p->xoa1();
		return $xoa;
	}
	// Xuất chuyên ngành
	function chuyenganh(){
		$p=new mTKAD();
		$x=$p->xuatchuyennganh();
		return $x;
	}
	// Sửa thông tin sinh viên
	function suattsv(){
		$p=new mTKAD();
		$sua=$p->suattsv();
		return $sua;
	}
	function suattsv1(){
		$p=new mTKAD();
		$sua1=$p->suattsv1();
		return $sua1;
	}
	// Kiểm tra bảo mật
	function ktbm(){
		$p=new mTKAD();
		$kt=$p->ktbm();
		return $kt;
	}
	// Lọc sinh viên
	function loc(){
		$p=new mTKAD();
		$kt=$p->loc();
		return $kt;
	}
	// lấy danh sách tài khoản giảng viên
	function laydanhsachgv(){
		$p=new mTKAD();
		$lay=$p->laydanhsachgv();
		return $lay;
	}
	function Pagegv(){
		$p=new mTKAD();
		$lay=$p->sotrangcanthietgv();
		return $lay;
	}
	// Lọc giảng viên
	function loc1(){
		$p=new mTKAD();
		$kt=$p->loc1();
		return $kt;
	}
	// Xem chi tiết Sinh Viên theo MSSV
    function XemChiTietGV(){
		$p=new mTKAD();
		$lay=$p->XemChiTietGV();
		return $lay;
	}
	// Sửa thông tin giảng viên
	function suattgv(){
		$p=new mTKAD();
		$sua=$p->suattgv();
		return $sua;
	}
	function suattgv1(){
		$p=new mTKAD();
		$sua1=$p->suattgv1();
		return $sua1;
	}
	// Xóa giảng viên
	function xoagv(){
		$p=new mTKAD();
		$xoa=$p->xoagv();
		return $xoa;
	}
	function xoagv1(){
		$p=new mTKAD();
		$xoa=$p->xoagv1();
		return $xoa;
	}
	// Lấy danh sách lớp học phần
	function dslhp(){
		$p=new mTKAD();
		$xoa=$p->dslhp();
		return $xoa;
	}
	// Lấy danh sách môn học phần
	function dsmhp(){
		$p=new mTKAD();
		$xoa=$p->dsmhp();
		return $xoa;
	}
	// Xem chi tiết học phần
	function xemct(){
		$p=new mTKAD();
		$xoa=$p->cthp();
		return $xoa;
	}
	// cập nhật học phần
	function cnhp1(){
		$p=new mTKAD();
		$xoa=$p->cnhp1();
		return $xoa;
	}
	function cnhp2(){
		$p=new mTKAD();
		$xoa=$p->cnhp2();
		return $xoa;
	}
	// Xóa học phần
	function xoahp(){
		$p=new mTKAD();
		$xoa=$p->xoahp();
		return $xoa;
	}
	function xoahp1(){
		$p=new mTKAD();
		$xoa=$p->xoahp1();
		return $xoa;
	}
}
?>
</body>
</html>