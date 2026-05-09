<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php session_start(); 
// var_dump($_REQUEST);
// exit;
if(isset($_REQUEST['xuat'])){
    unset($_SESSION['mk']);
	unset($_SESSION['ma']);
	echo header("refresh:0,url='index.php'"); // xóa session login
}
?>
</body>
</html>