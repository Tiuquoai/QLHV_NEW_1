<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Successfully !</h1></title>
<link rel="icon" type="image/png" href="https://tse2.explicit.bing.net/th?id=OIP.AcaQjWrR2eV624qu8m6nIgHaHa&pid=Api&P=0&h=180"/>
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
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
    
    // Kiểm tra captcha trước
    if($c != $cap){
        echo "<script>alert('Mã Captcha không đúng!');</script>";
        echo header("refresh:0,url='login-sv.php'");
        exit;
    }
    
    include_once("Controller/cTKSV.php");
    $p=new cTKSV();
    $ktsv=$p->KiemTraTKSV();
    
    // Kiểm tra tài khoản có tồn tại không
    if(mysql_num_rows($ktsv) == 0){
        echo "<script>alert('Mã sinh viên không tồn tại!');</script>";
        echo header("refresh:0,url='login-sv.php'");
        exit;
    }
    
    $x=mysql_fetch_assoc($ktsv);
    $ma1=$x['user_code'];
    $mk1=$x['matkhau'];
    
    // Kiểm tra mã sinh viên và mật khẩu
    if(md5($ma) == $ma1 && $matkhau == $mk1){
        // Đăng nhập thành công
        $_SESSION['mk']=$matkhau;
        $_SESSION['ma']=md5($ma);
        echo header("refresh:0,url='homeSV.php?bm=".md5($ma)."'");
    } else {
        echo "<script>alert('Mã sinh viên hoặc mật khẩu không đúng!');</script>";
        echo header("refresh:0,url='login-sv.php'");
        exit;
    }
}
elseif(isset($_POST['dngv']))
{
    $ma=$_POST['a'];
    $matkhau=md5($_POST['p']);
    $c=$_POST['cd'];
    $cap=$_POST['cap'];
    
    // Kiểm tra captcha trước
    if($c != $cap){
        echo "<script>alert('Mã Captcha không đúng!');</script>";
        echo header("refresh:0,url='login-gv.php'");
        exit;
    }
    
    include_once("Controller/cTKGV.php");
    $p=new cTKGV();
    $ktgv=$p->KiemTraTKGV();
    
    // Kiểm tra tài khoản có tồn tại không
    if(mysql_num_rows($ktgv) == 0){
        echo "<script>alert('Mã giảng viên không tồn tại!');</script>";
        echo header("refresh:0,url='login-gv.php'");
        exit;
    }
    
    $x=mysql_fetch_assoc($ktgv);
    $ma1=$x['user_code'];
    $mk1=$x['matkhau'];
    
    // Kiểm tra mã giảng viên và mật khẩu
    if(md5($ma) == $ma1 && $matkhau == $mk1){
        // Đăng nhập thành công
        $_SESSION['mk']=$matkhau;
        $_SESSION['ma']=md5($ma);
        echo header("refresh:0,url='homeGV.php?bm=".md5($ma)."'");
    } else {
        echo "<script>alert('Mã giảng viên hoặc mật khẩu không đúng!');</script>";
        echo header("refresh:0,url='login-gv.php'");
        exit;
    }
}
elseif(isset($_POST['dnad']))
{
    $ma=$_POST['a'];
    $matkhau=md5($_POST['p']);
    include_once("Controller/cTKADHT.php");
    $p=new cTKAD();
    $ktad=$p->KiemTraTKAD();
    // Có tồn tại tài khoản quản trị hệ thống điều hướng về trang homeAD
        if(mysql_num_rows($ktad)==1){
            echo header("refresh:0,url='homeAD.php?bm=".md5($ma)."'");
            $_SESSION['mk']=$matkhau;
            $_SESSION['ma']= md5($ma);
        }
        else{
            echo header("refresh:0,url='login-ad.php'");
        }
}
ob_end_flush();
?>
</body>
</html>