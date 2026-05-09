<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Successfully !</h1></title>
<link rel="icon" type="image/png" href="https://tse2.explicit.bing.net/th?id=OIP.AcaQjWrR2eV624qu8m6nIgHaHa&pid=Api&P=0&h=180"/>
</head>

<body>
<?php
session_start();

ob_start();
		if(isset($_POST['dn']))
		{
			
			    $ma=$_POST['a'];
				$matkhau=md5($_POST['p']);
				$c=$_POST['cd'];
				$cap=$_POST['cap'];
				// Lấy dữ liệu kiểm tra từ controller

				
				include_once("Controller/cTKSV.php");

				$p=new cTKSV();
			    $ktsv=$p->KiemTraTKSV();
				$x=mysql_fetch_assoc($ktsv);
				// var_dump($x);
				// var_dump($_POST['a']);

				$ma1=$x['user_code'];
				$mk1=$x['matkhau'];
			    if(md5($ma)!=$ma1||$matkhau==$mk1){
						
						// echo md5($ma1);
						// echo "\n";
						// echo md5($_POST['a']);
					// exit;
					echo header("refresh:0,url='login-sv.php");
				}
				elseif(md5($ma)==$ma1||$matkhau!=$mk1){
	
					echo header("refresh:0,url='login-sv.php");
				}
				elseif(md5($ma)!=$ma1||$matkhau!=$mk1){
					echo header("refresh:0,url='login-sv.php");
				}
				if(md5($ma)!=$ma1||$matkhau==$mk1||$c==$cap){
					echo header("refresh:0,url='login-sv.php");
				}
				elseif(md5($ma)==$ma1||$matkhau!=$mk1||$c==$cap){
					echo header("refresh:0,url='login-sv.php");
				}
				elseif(md5($ma)!=$ma1||$matkhau!=$mk1||$c==$cap){
					echo header("refresh:0,url='login-sv.php");
				}
				else{
					echo header("refresh:0,url='homeSV.php?bm=".md5($ma)."");
					$_SESSION['mk']=$matkhau;
					$_SESSION['ma']=md5($ma);
				}
				
				// Có tồn tại tài khoản sinh viên điều hướng về trang homeSV
				if(mysql_num_rows($ktsv)==0){
					echo header("refresh:0,url='homeSV.php?bm=".md5($ma)."");
					
				}
				else{
					echo header("refresh:0,url='login-sv.php");
				}
				if($c!=$cap){
					echo "<script>alert('Nhập lại mã Captcha !')</script>";
					echo header("refresh:0,url='login-sv.php");
				}
				else{
					if($c==$cap){
						if(mysql_num_rows($ktsv)==0){
							echo header("refresh:0,url='login-sv.php");
						}
						else{
							echo header("refresh:0,url='homeSV.php?bm=".md5($ma)."");
							$_SESSION['mk']=$matkhau;
					     	$_SESSION['ma']= md5($ma);
						}
					}
				}
				
	
		}
		if(isset($_POST['dngv']))
		{
			$ma=$_POST['a'];
			$matkhau=md5($_POST['p']);
			$c=$_POST['cd'];
			$cap=$_POST['cap'];
			include_once("Controller/cTKGV.php");
			$p=new cTKGV();
			$ktgv=$p->KiemTraTKGV();
			$x=mysql_fetch_assoc($ktgv);
			$ma1=$x['user_code'];
			$mk1=$x['matkhau'];
			if(md5($ma)!=$ma1||$matkhau==$mk1){
					echo header("refresh:0,url='login-gv.php");
				}
				elseif(md5($ma)==$ma1||$matkhau!=$mk1){
					echo header("refresh:0,url='login-gv.php");
				}
				elseif(md5($ma)!=$ma1||$matkhau!=$mk1){
					echo header("refresh:0,url='login-gv.php");
				}
				if(md5($ma)!=$ma1||$matkhau==$mk1||$c==$cap){
					echo header("refresh:0,url='login-gv.php");
				}
				elseif(md5($ma)==$ma1||$matkhau!=$mk1||$c==$cap){
					echo header("refresh:0,url='login-gv.php");
				}
				elseif(md5($ma)!=$ma1||$matkhau!=$mk1||$c==$cap){
					echo header("refresh:0,url='login-gv.php");
				}
				else{
					echo header("refresh:0,url='homeGV.php?bm=".md5($ma)."");
					$_SESSION['mk']=$matkhau;
					$_SESSION['ma']= md5($ma);
				}
			// Có tồn tại tài khoản giảng viên điều hướng về trang homeGV
				if(mysql_num_rows($ktgv)==1){
					echo header("refresh:0,url='homeGV.php?bm=".md5($ma)."");
					$_SESSION['mk']=$matkhau;
					$_SESSION['ma']= md5($ma);
				}
				else{
					echo header("refresh:0,url='login-gv.php");
				}
				if($c!=$cap){
					echo "<script>alert('Nhập lại mã Captcha !')</script>";
					echo header("refresh:0,url='login-gv.php");
				}
				else{
					if($c==$cap){
						if(mysql_num_rows($ktgv)==0){
							echo header("refresh:0,url='login-gv.php");
						}
						else{
							echo header("refresh:0,url='homeGV.php?bm=".md5($ma)."");
							$_SESSION['mk']=$matkhau;
					     	$_SESSION['ma']= md5($ma);
						}
					}
				}
			
		}
		if(isset($_POST['dnad']))
		{
			$ma=$_POST['a'];
			$matkhau=md5($_POST['p']);
			include_once("Controller/cTKADHT.php");
			$p=new cTKAD();
			$ktad=$p->KiemTraTKAD();
			// Có tồn tại tài khoản quản trị hệ thống điều hướng về trang homeAD
				if(mysql_num_rows($ktad)==1){
					echo header("refresh:0,url='homeAD.php?bm=".md5($ma)."");
					$_SESSION['mk']=$matkhau;
					$_SESSION['ma']= md5($ma);
				}
				else{
					echo header("refresh:0,url='login-ad.php");
				}
			
		}
ob_end_flush();
?>
</body>
</html>