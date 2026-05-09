<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
// Kết Nối CSDL
class ketnoiSV{
	function ketnoi($ketnoi){
		$ketnoi=mysql_connect('localhost','SinhVien','123456','qlhv');
		mysql_set_charset("utf8");
		if($ketnoi){
			return mysql_select_db('qlhv');
		}
		else{
			return false;
		}
		
	}
	function dongketnoi($ketnoi){
		mysql_close($ketnoi);
	}
}


?>
</body>
</html>