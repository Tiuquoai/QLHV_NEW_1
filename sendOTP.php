<?php
session_start();
$_SESSION['email']=$_POST['email'];
$pe=$_SESSION['email'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.zoom.min.js"></script>

<script src="https://unpkg.com/js-image-zoom@0.4.1/js-image-zoom.js" type="application/javascript"></script>
<title>Trung Tam He thong CRM</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<style>
.full-width-div {
    position: relative;
    width: 100%;
    left: 0;
}
</style>
</head>
<body>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Gọi Điện: 0143.234.563 - ext 808 &nbsp; &nbsp; Email: csm@gmail.com</p> 
</div>
<p></p>
</div>
<div>
<center><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></center>
        
        </div>
     </div>
<br/>

<center>
    	<div class="row">
                 	<div class="col-xs-3 col-sm-3 col-md-3 col-ld-3">
                    	
                    </div>  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-ld-6">
                    <br />
                    	<center><h3>NHẬP MÃ XÁC NHẬN OTP</h3></center>
                        <br />
                       
                        
                         <?php 
						 // Kiểm tra tài khoản có tồn tại trong việc xác minh không, nếu có sẽ gửi OTP đến nhập mã OTP, nếu không có sẽ thoát
							if(isset($_POST['kiemtra'])){
								include_once("Controller/cTKSV.php");
								$p=new cTKSV();
								$cot=$p->XacMinh();
								// Có tài khoản sinh viên không
								if(mysql_num_rows($cot)!=1){
									echo header("refresh:0,url='resetpass.php'");
								}
								else{
// Function to generate OTP
function generateNumericOTP($n) {
      
    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";
  
    // Iterate for n-times and pick a single character
    // from generator and append it to $result
      
    // Login for generating a random character from generator
    //     ---generate a random number
    //     ---take modulus of same with length of generator (say i)
    //     ---append the character at place (i) from generator to result
  
    $result = "";
  
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
  
    // Return result
    return $result;
}
  
// Main program
$n = 6;
session_start();
$_SESSION['OTP']=generateNumericOTP($n);
$OTP=$_SESSION['OTP'];
$_SESSION['OTP']=strtotime("now");
							
include "class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
    );
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "thuonghoaicute103@gmail.com";
$mail->Password = "apss kjci mxka pjby";
$mail->SetFrom("thuonghoaicute103@gmail.com");
$mail->AddAddress($pe);
$mail->Subject = "Trung Tam Quan Tri He Thong CMS";
$mail->Body = "<p style='color:#000;'>Mã OTP xác nhận của bạn là:&nbsp;<tb style='color:orange'>".$OTP."</tb> </p>";
 if(!$mail->Send()){
   
}
else{
}

// Authentication key
$authKey = "YOUR_AUTH_KEY";

// Also add muliple mobile numbers, separated by comma
$phoneNumber = $_POST['phoneno'];

// route4 sender id should be 6 characters long.
$senderId = "YOUR_SENDER_ID";

// Your message to send
$message = "Mã OTP của bạn là :".$OTP."";


									?>
                        
                        <p></p>
                        
                        <form action="repass.php" method="post">
                    	<center><input type="text" name="OTP" placeholder="Nhập mã OTP tại đây ..." /></ps>&nbsp; <br /></center>
                        
                        
                       <?php 
					   ?>
                      
                       <center><ps></ps><input type="hidden" name="re" value="<?php echo $pe; ?>" /></ps></center><p></p>
                        <center><input type="submit" name="su" value="Xác nhận" required="required"/></center><br/>
                        <center><i>Hiệu lực mã OTP trong vòng 2 phút !</i><p></p></center>
                        <center><ps></ps><input type="hidden" name="numOTP" value="<?php echo $OTP; ?>" /></ps>&nbsp; <br /></center>
                        <center><ps></ps><input type="hidden" name="tgn" value="<?php echo $_SESSION['OTP']; ?>" /></ps>&nbsp; <br /></center>
                          <center><ps></ps><input type="hidden" name="re" value="<?php echo $pe; ?>" /></ps>&nbsp; <br /></center>
                        <br />
                    </form>
                    
                    <?php
								}
								
							}
							elseif(isset($_POST['kiemtra1'])){
								include_once("Controller/cTKGV.php");
								$p=new cTKGV();
								$cot1=$p->Tim1();
								// Có tài khoản giảng viên không
								if(mysql_num_rows($cot1)!=1){
									echo header("refresh:0,url='forgetpass.php'");
								}
								else{
// Function to generate OTP
function generateNumericOTP($n) {
      
    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";
  
    // Iterate for n-times and pick a single character
    // from generator and append it to $result
      
    // Login for generating a random character from generator
    //     ---generate a random number
    //     ---take modulus of same with length of generator (say i)
    //     ---append the character at place (i) from generator to result
  
    $result = "";
  
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
  
    // Return result
    return $result;
}
  
// Main program
$n = 6;
session_start();
$_SESSION['OTP']=generateNumericOTP($n);
$OTP=$_SESSION['OTP'];
$_SESSION['OTP']=strtotime("now");
							
include "class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "phucable@gmail.com";
$mail->Password = "afbv blky ofzi vzsy";
$mail->SetFrom("quantrihethong@gmail.com");
$mail->AddAddress($pe);
$mail->Subject = "Trung Tam Quan Tri He Thong CMS";
$mail->Body = "<p style='color:#03F;'>Mã OTP xác nhận của bạn là:&nbsp;<tb style='color:orange'>".$OTP."</tb> </p>";
 if(!$mail->Send()){
   
}
else{
}

// Authentication key
$authKey = "YOUR_AUTH_KEY";

// Also add muliple mobile numbers, separated by comma
$phoneNumber = $_POST['phoneno'];

// route4 sender id should be 6 characters long.
$senderId = "YOUR_SENDER_ID";

// Your message to send
$message = "Mã OTP của bạn là :".$OTP."";


									?>
                        
                        <p></p>
                        
                        <form action="repass.php" method="post">
                    	<center><input type="text" name="OTP" placeholder="Nhập mã OTP tại đây ..." /></ps>&nbsp; <br /></center>
                        
                        
                       <?php 
					   ?>
                      
                       <center><ps></ps><input type="hidden" name="re" value="<?php echo $pe; ?>" /></ps></center><p></p>
                        <center><input type="submit" name="su" value="Xác nhận" required="required"/></center><br/>
                        <center><i>Hiệu lực mã OTP trong vòng 2 phút !</i><p></p></center>
                        <center><ps></ps><input type="hidden" name="numOTP" value="<?php echo $OTP; ?>" /></ps>&nbsp; <br /></center>
                        <center><ps></ps><input type="hidden" name="tgn" value="<?php echo $_SESSION['OTP']; ?>" /></ps>&nbsp; <br /></center>
                          <center><ps></ps><input type="hidden" name="re" value="<?php echo $pe; ?>" /></ps>&nbsp; <br /></center>
                        <br />
                    </form>
                    
                    <?php
								}
								
							}
							
								?>
                    </div>  
                    
                    <div class="col-xs-3 col-sm-3 col-md-3 col-ld-3">
                    	
                    </div>  
</div>
<!--Đây là phần footer-->
<br />
<!--Đây là phần footer-->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="col-xs-4 col-sm-4 col-md-44 col-lg-4">
        <br />
       <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" height="75px" width="100px" />
        <p></p>
        <p>Chào Mừng Các Bạn Đến Với Hệ Thống ...</p>
        <br />
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p></p>
        <h5>Liên Kết</h5>
        <p></p>
        - Link Liên Kết 1<p></p>
        - Link Liên Kết 2<p></p>
        - ...
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p></p>
        <h5>Liên Hệ</h5>
        <p></p>
        Trung Tâm Quản Trị Hệ Thống - Trường ...
        <p></p>
        <img src="https://tse4.mm.bing.net/th?id=OIP.VMPvKsUQ9Q91rlEDRqsj8AHaHa&pid=Api&P=0&h=180" height="30px" width="30px" /> &nbsp; Phone :&nbsp;0143.234.563<p></p>
         <img src="https://tse3.mm.bing.net/th?id=OIP.Ye2A24tF7KlssZxi_cffWwHaGD&pid=Api&P=0&h=180" height="30px" width="30px" /> &nbsp; Email :&nbsp;abc@gmail.com
        
        </div>
     </div>
</div>
</center>
</body>
</html>
</body>
</html>