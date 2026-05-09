<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
include_once("Model/mTKSV.php");
class cTKSV{
	// Kiểm tra tài khoản
	function KiemTraTKSV(){
		$p=new mTKSV();
		$kt=$p->KTTKSV();
		return $kt;
	}
	// Xác minh sự tồn tại tài khoản
	function XacMinh(){
		$p=new mTKSV();
		$kt=$p->Tim();
		return $kt;
	}
	// Xuất thông tin sinh viên
	function XuatInfo(){
		$p=new mTKSV();
		$kt=$p->XuatInfo();
		return $kt;
	}
	// Chỉnh sửa thông tin sinh viên
	function CapNhatInfo(){
		$p=new mTKSV();
		$kt=$p->CapNhatInfo();
		return $kt;
	}
	function CapNhatInfo1(){
		$p=new mTKSV();
		$kt=$p->CapNhatInfo1();
		return $kt;
	}
	
}
?>
</body>
</html>