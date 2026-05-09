<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
include_once("Model/mTKGV.php");
class cTKGV{
	function KiemTraTKGV(){
		$p=new mTKGV();
		$kt=$p->KTTKGV();
		return $kt;
	}
	// Xuất thông tin giảng viên
	function XuatInfo(){
		$p=new mTKGV();
		$kt=$p->XuatInfo();
		return $kt;
	}
	// Chỉnh sửa thông tin giảng viên
	function CapNhatInfoGV(){
		$p=new mTKGV();
		$kt=$p->CapNhatInfoGV();
		return $kt;
	}
	function CapNhatInfoGV1(){
		$p=new mTKGV();
		$kt=$p->CapNhatInfoGV1();
		return $kt;
	}
	// Kiểm tra bảo mật
	function ktbm(){
		$p=new mTKGV();
		$kt=$p->ktbm();
		return $kt;
	}
	// Xác minh tài khoản giảng viên
	function Tim1(){
		$p=new mTKGV();
		$kt=$p->Tim1();
		return $kt;
	}
}
?>
</body>
</html>