<?php
session_start();
$_SESSION['re']=$_POST['re'];
$se=$_SESSION['re'];
$_SESSION['re']=strtotime("now");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Xác Minh OTP - Hệ Thống LMS</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.wrapper {
    width: 100%;
    max-width: 450px;
}

.card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    padding: 30px;
    text-align: center;
    color: white;
}

.card-header .logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 15px;
    border: 3px solid rgba(255,255,255,0.2);
}

.card-header h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 5px;
}

.card-header p {
    font-size: 14px;
    opacity: 0.8;
}

.card-body {
    padding: 40px;
}

.form-title {
    text-align: center;
    margin-bottom: 30px;
}

.form-title h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.form-title h3 i {
    color: #667eea;
}

.form-title p {
    color: #666;
    font-size: 14px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 500;
    color: #1a1a2e;
    margin-bottom: 8px;
    font-size: 14px;
}

.input-group {
    position: relative;
}

.input-group i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #667eea;
    font-size: 18px;
}

.input-group input {
    width: 100%;
    padding: 14px 14px 14px 45px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.input-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
}

.input-group input::placeholder {
    color: #aaa;
}

.btn {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.btn:active {
    transform: translateY(0);
}

.info-box {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border: 1px solid rgba(102, 126, 234, 0.3);
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 20px;
    text-align: center;
}

.info-box i {
    font-size: 30px;
    color: #667eea;
    margin-bottom: 10px;
}

.info-box p {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.info-box .timer {
    color: #667eea;
    font-weight: 600;
    font-size: 18px;
}

.back-link {
    text-align: center;
    margin-top: 25px;
}

.back-link a {
    color: #667eea;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.back-link a:hover {
    color: #764ba2;
    gap: 12px;
}

/* Footer */
.footer {
    text-align: center;
    padding: 20px;
    color: rgba(255,255,255,0.9);
    font-size: 13px;
}

.footer a {
    color: white;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 480px) {
    .card-body {
        padding: 25px;
    }
    
    .card-header {
        padding: 25px;
    }
    
    .card-header h2 {
        font-size: 20px;
    }
}
</style>
</head>

<body>

<?php
$p=$_POST['p'];
$OTP=$_POST['OTP'];
$numOTP=$_POST['numOTP'];
$tgn=$_POST['tgn'];
$hieuluc= $_SESSION['re']-$tgn;
if($OTP!=$numOTP){
    echo "<script>alert('Mã OTP không đúng!')</script>";
    echo header("refresh:0,url='resetpass.php'");
}
elseif($hieuluc>2*60){
    echo "<script>alert('Mã OTP hết hiệu lực!')</script>";
    echo header("refresh:0,url='resetpass.php'");
}
else{
    echo header("refresh:0,url='rpass.php?xm=".md5($se)."&&e=".$se."'");
}
?>

<div class="wrapper">
    <div class="card">
        <div class="card-header">
            <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo" class="logo">
            <h2>Hệ Thống LMS</h2>
            <p>Học Trực Tuyến</p>
        </div>
        
        <div class="card-body">
            <div class="form-title">
                <h3><i class="fas fa-shield-alt"></i>Xác Minh OTP</h3>
                <p>Nhập mã xác minh đã được gửi đến email của bạn</p>
            </div>
            
            <div class="info-box">
                <i class="fas fa-envelope-open-text"></i>
                <p>Mã OTP đã được gửi đến email của bạn.<br>Mã có hiệu lực trong <span class="timer">2 phút</span></p>
            </div>
            
            <form action="#" method="post">
                <div class="form-group">
                    <label>Nhập Mã OTP</label>
                    <div class="input-group">
                        <i class="fas fa-key"></i>
                        <input type="text" name="OTP" placeholder="Nhập mã OTP" required="required" maxlength="6" />
                    </div>
                </div>
                
                <input type="hidden" name="p" value="<?php echo $p; ?>" />
                <input type="hidden" name="numOTP" value="<?php echo $numOTP; ?>" />
                <input type="hidden" name="tgn" value="<?php echo $tgn; ?>" />
                
                <button type="submit" class="btn">
                    <i class="fas fa-check-circle"></i> Xác Nhận
                </button>
            </form>
            
            <div class="back-link">
                <a href="resetpass.php">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Gọi Điện: 0143.234.563 - ext 808 | Email: csm@gmail.com</p>
    </div>
</div>

</body>
</html>

<?php
/*
<center><table border='0.5px' width='100%'>

<tr style='background-color:#CFF;'>
<th>123</th>
<th>345</th>
</tr>
<td><center>123</center></td>
<td><center>345</center></td>
</tr>
</table></center>
*/
?>
