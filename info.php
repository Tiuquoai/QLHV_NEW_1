<?php
	include_once("controller/cTKSV.php");
	$p=new cTKSV();
	if(isset($_POST['capnhat'])){
		     $email=$_POST['f'];
			 $sdt=$_POST['e'];
		     if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/",$email)){
					echo "<script>alert('Email không đúng định dạng')</script>";
				}
			 elseif(!preg_match("/[0-9]{10}/",$sdt)){
				 echo "<script>alert('Số Điện Thoại là 10 số')</script>";
			 }
			 else {
		$p->CapNhatInfo1();
		$p->CapNhatInfo();
		echo "<script>Cập Nhật Thành Công !</script>";
		echo header("refresh:0,url='info.php?bm=".$_REQUEST['bm']."");
			 }
	}
?>

<?php
session_start();
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
$ma=$_REQUEST['bm'];
$sql="select * from user where user_code='$ma'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
$ma=$r['user_code'];
$mk=$r['matkhau'];
$k=$_SESSION['mk'];
$m=$_SESSION['ma'];
if($k != $mk || $m != $ma){
	echo header("refresh:0,url='index.php'");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Thông Tin Sinh Viên</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
<style>
	a { color: #667eea; transition: all 0.3s ease; text-decoration: none; }
	a:hover { color: #764ba2; }
	
	.info-header-section {
		background: white;
		border-radius: 12px;
		padding: 30px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.08);
		margin: 20px 0 30px 0;
		text-align: center;
	}
	
	.info-avatar {
		width: 140px;
		height: 140px;
		border-radius: 12px;
		border: 4px solid #667eea;
		margin: 0 auto 20px auto;
		overflow: hidden;
		box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	
	.info-avatar img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
	
	.info-name {
		font-size: 28px;
		font-weight: 700;
		color: #333;
		margin: 15px 0;
	}
	
	.info-actions {
		display: flex;
		justify-content: center;
		gap: 20px;
		flex-wrap: wrap;
		margin-top: 20px;
		padding-top: 20px;
		border-top: 2px solid #e8e8f0;
	}
	
	.info-action-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 10px 18px;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border: none;
		border-radius: 6px;
		cursor: pointer;
		font-weight: 600;
		font-size: 14px;
		text-decoration: none;
		transition: all 0.3s ease;
	}
	
	.info-action-btn:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
	}
	
	.info-section {
		background: white;
		border-radius: 12px;
		padding: 30px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.08);
		margin-bottom: 30px;
	}
	
	.info-section h4 {
		color: #333;
		font-size: 20px;
		font-weight: 700;
		margin: 0 0 25px 0;
		padding-bottom: 15px;
		border-bottom: 3px solid #667eea;
	}
	
	.info-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
		gap: 20px;
	}
	
	.info-item {
		padding: 15px;
		background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%);
		border-radius: 8px;
		border-left: 4px solid #667eea;
		transition: all 0.3s ease;
	}
	
	.info-item:hover {
		transform: translateX(5px);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
	}
	
	.info-label {
		color: #999;
		font-size: 13px;
		font-weight: 500;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		margin-bottom: 6px;
		display: block;
	}
	
	.info-value {
		color: #333;
		font-size: 16px;
		font-weight: 600;
	}
	
	.edit-form-container {
		background: white;
		border-radius: 12px;
		padding: 30px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.08);
		margin-bottom: 30px;
	}
	
	.form-section {
		margin-bottom: 30px;
	}
	
	.form-section h4 {
		color: #333;
		font-size: 20px;
		font-weight: 700;
		margin: 0 0 20px 0;
		padding-bottom: 12px;
		border-bottom: 3px solid #667eea;
	}
	
	.form-row {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
		gap: 20px;
		margin-bottom: 15px;
	}
	
	.form-group {
		display: flex;
		flex-direction: column;
	}
	
	.form-group label {
		color: #555;
		font-weight: 600;
		margin-bottom: 8px;
		font-size: 14px;
	}
	
	.form-group input[type="text"],
	.form-group input[type="password"],
	.form-group input[type="date"],
	.form-group input[type="email"] {
		padding: 12px 14px;
		border: 2px solid #e0e0e0;
		border-radius: 6px;
		font-size: 14px;
		transition: all 0.3s ease;
		font-family: inherit;
	}
	
	.form-group input[type="text"]:focus,
	.form-group input[type="password"]:focus,
	.form-group input[type="date"]:focus,
	.form-group input[type="email"]:focus {
		outline: none;
		border-color: #667eea;
		box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
	}
	
	.form-group input:disabled {
		background: #f5f5f5;
		color: #999;
		cursor: not-allowed;
	}
	
	.form-radio-group {
		display: flex;
		gap: 20px;
		flex-wrap: wrap;
		margin: 10px 0;
	}
	
	.form-radio-group label {
		display: flex;
		align-items: center;
		gap: 8px;
		cursor: pointer;
		margin: 0;
	}
	
	.form-full-width {
		grid-column: 1 / -1;
	}
	
	.form-actions {
		display: flex;
		gap: 15px;
		justify-content: center;
		flex-wrap: wrap;
		margin-top: 25px;
		padding-top: 20px;
		border-top: 2px solid #e8e8f0;
	}
	
	.btn-save {
		padding: 12px 30px;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border: none;
		border-radius: 6px;
		cursor: pointer;
		font-weight: 600;
		font-size: 15px;
		transition: all 0.3s ease;
	}
	
	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
	}
	
	.password-form-container {
		max-width: 500px;
		margin: 40px auto;
		background: white;
		border-radius: 12px;
		padding: 40px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.08);
	}
	
	.password-form-container h5 {
		text-align: center;
		color: #333;
		font-size: 22px;
		font-weight: 700;
		margin-bottom: 25px;
	}
	
	.password-form-group {
		margin-bottom: 18px;
	}
	
	.password-form-group label {
		display: block;
		color: #555;
		font-weight: 600;
		margin-bottom: 8px;
		font-size: 14px;
	}
	
	.password-form-group input {
		width: 100%;
		padding: 12px 14px;
		border: 2px solid #e0e0e0;
		border-radius: 6px;
		font-size: 14px;
		transition: all 0.3s ease;
	}
	
	.password-form-group input:focus {
		outline: none;
		border-color: #667eea;
		box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
	}
	
	.password-form-actions {
		display: flex;
		gap: 12px;
		justify-content: center;
		margin-top: 25px;
	}
	
	.password-form-actions input {
		padding: 12px 25px;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border: none;
		border-radius: 6px;
		cursor: pointer;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	
	.password-form-actions input:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
	}
	
	.back-to-home {
		text-align: center;
		margin: 40px 0;
	}
	
	.back-to-home a {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 50px;
		height: 50px;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border-radius: 50%;
		color: white;
		font-size: 24px;
		transition: all 0.3s ease;
		text-decoration: none;
	}
	
	.back-to-home a:hover {
		transform: scale(1.1) translateY(-3px);
		box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
	}
	
	@media (max-width: 768px) {
		.info-header-section {
			padding: 20px;
		}
		
		.info-avatar {
			width: 120px;
			height: 120px;
		}
		
		.info-name {
			font-size: 24px;
		}
		
		.info-actions {
			gap: 10px;
		}
		
		.info-section {
			padding: 20px;
		}
		
		.info-grid {
			grid-template-columns: 1fr;
		}
		
		.form-row {
			grid-template-columns: 1fr;
		}
		
		.password-form-container {
			padding: 25px;
		}
	}
	
	/* FOOTER STYLING */
	footer.footer {
		background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%);
		border-top: 3px solid #667eea;
		padding: 60px 20px 30px 20px;
		margin-top: 80px;
	}
	
	.footer .container-custom {
		max-width: 1200px;
		margin: 0 auto;
	}
	
	.footer-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
		gap: 40px;
		margin-bottom: 40px;
	}
	
	.footer-section {
		padding: 20px;
		background: white;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.05);
		transition: all 0.3s ease;
	}
	
	.footer-section:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
	}
	
	.footer-logo {
		width: 100px;
		height: 100px;
		border-radius: 12px;
		overflow: hidden;
		margin-bottom: 15px;
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
		display: flex;
		align-items: center;
		justify-content: center;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	}
	
	.footer-logo img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
	
	.footer-section h5 {
		color: #667eea;
		font-size: 18px;
		font-weight: 700;
		margin-bottom: 15px;
		margin-top: 0;
	}
	
	.footer-section p {
		color: #666;
		font-size: 14px;
		line-height: 1.8;
		margin: 8px 0;
	}
	
	.footer-section ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}
	
	.footer-section li {
		margin: 12px 0;
	}
	
	.footer-section a {
		color: #667eea;
		text-decoration: none;
		font-weight: 500;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}
	
	.footer-section a:hover {
		color: #764ba2;
		transform: translateX(3px);
	}
	
	.footer-contact p {
		color: #555;
		font-size: 14px;
		line-height: 1.8;
	}
	
	.footer-bottom {
		text-align: center;
		padding-top: 25px;
		border-top: 2px solid rgba(102, 126, 234, 0.2);
		color: #999;
		font-size: 13px;
	}
	
	@media (max-width: 768px) {
		footer.footer {
			padding: 40px 15px 25px 15px;
			margin-top: 60px;
		}
		
		.footer-grid {
			gap: 25px;
		}
		
		.footer-section {
			padding: 15px;
		}
		
		.footer-logo {
			width: 80px;
			height: 80px;
		}
		
		.footer-section h5 {
			font-size: 16px;
		}
	}
	
	@media (max-width: 480px) {
		.info-avatar {
			width: 100px;
			height: 100px;
		}
		
		.info-name {
			font-size: 20px;
		}
		
		.info-action-btn {
			padding: 8px 12px;
			font-size: 12px;
		}
		
		.info-section h4 {
			font-size: 18px;
		}
		
		.info-value {
			font-size: 14px;
		}
		
		footer.footer {
			padding: 30px 10px 20px 10px;
			margin-top: 40px;
		}
		
		.footer-grid {
			gap: 15px;
		}
		
		.footer-section {
			padding: 12px;
		}
		
		.footer-logo {
			width: 70px;
			height: 70px;
		}
		
		.footer-section h5 {
			font-size: 14px;
		}
		
		.footer-section p {
			font-size: 12px;
		}
	}
</style>
</head>

<body>
<div class="header-top">
    <p>
        <span>📞 Gọi Điện: 0143.234.563 - ext 808</span>
        <span>📧 Email: csm@gmail.com</span>
    </p>
</div>

<div class="main-header">
    <div class="container-custom">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo" style="height: 65px; width: auto; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" />
            <h2 style="color: #667eea; margin: 0; font-size: 24px; font-weight: 700;">Thông Tin Sinh Viên</h2>
            <div style="width: 65px;"></div>
        </div>
    </div>
</div>

<div class="container-custom" style="padding: 20px 15px;">
    <?php 
    include_once("Controller/cTKSV.php");
    $p=new cTKSV();
    $xuat=$p->XuatInfo();
    $x=mysql_fetch_assoc($xuat);
    $a= $x['user_code'];
    $b= $_REQUEST['bm'];
    if(!isset($_REQUEST['bm'])){
        echo header("refresh:0,url='index.php");
    }
    if($b != $a){
        echo header("refresh:0,url='index.php");
    }

    $anh=$x['anh'];
    ?>
    
    <div class="info-header-section">
        <div class="info-avatar">
            <?php if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){ ?>
                <img src="<?php echo $anh?>" />
            <?php } else { ?>
                <img src="img/<?php echo $anh?>" />
            <?php } ?>
        </div>
        
        <div class="info-name"><?php echo $x['tensinhvien']; ?></div>
        <div style="color: #999; font-size: 14px; margin-bottom: 15px;"><?php echo $x['masosinhvien']; ?></div>
        
        <div class="info-actions">
            <a href="info.php?bm=<?php echo $_REQUEST['bm']; ?>&&chinhsua" class="info-action-btn">
                ✏️ Chỉnh Sửa
            </a>
            <a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>&&dmk" class="info-action-btn">
                🔐 Đổi Mật Khẩu
            </a>
            <a href="dxuat.php?xuat" class="info-action-btn">
                🚪 Đăng Xuất
            </a>
        </div>
    </div>
    <?php 
     if(isset($_GET['chinhsua'])){
         ?>
         <div class="edit-form-container">
             <form action="#" method="post" enctype="multipart/form-data">
             
             <div class="form-section">
                 <h4>📋 Thông Tin Chung</h4>
                 <div class="form-row">
                     <div class="form-group">
                         <label>👤 Tên Sinh Viên</label>
                         <input type="text" name="a" value="<?php echo $x['tensinhvien'];?>" disabled="disabled" />
                     </div>
                     <div class="form-group">
                         <label>🎓 Mã Số Sinh Viên</label>
                         <input type="text" name="b" value="<?php echo $x['masosinhvien']; ?>" disabled="disabled" />
                     </div>
                     <div class="form-group">
                         <label>⚧️ Giới Tính</label>
                         <div class="form-radio-group">
                             <?php
                                 if($x['gioitinh']==Nam){
                                     $nam="checked";
                                 }
                                 elseif($x['gioitinh']==Nữ){
                                     $nu="checked";
                                 }
                             ?>
                             <label><input type="radio" name="c" value="Nam" <?php echo $nam ?> /> Nam</label>
                             <label><input type="radio" name="c" value="Nữ" <?php echo $nu ?> required="required" /> Nữ</label>
                         </div>
                     </div>
                 </div>
                 
                 <div class="form-row">
                     <div class="form-group">
                         <label>🎂 Ngày Sinh</label>
                         <input type="date" name="d" value="<?php 
                        $currentDate = $x['ngaysinh'];
                        $convertedDate = date("Y-m-d", strtotime($currentDate));
                        echo $convertedDate;?>" required="required"/>
                     </div>
                     <div class="form-group">
                         <label>📱 Điện Thoại</label>
                         <input type="text" name="e" value="<?php echo $x['sdt'];?>" required="required" />
                     </div>
                     <div class="form-group">
                         <label>📧 Email</label>
                         <input type="text" name="f" value="<?php echo $x['email'];?>" required="required" />
                     </div>
                 </div>
                 
                 <div class="form-row">
                     <div class="form-group">
                         <label>🆔 Số CCCD</label>
                         <input type="text" name="g" value="<?php echo $x['cccd'];?>" required="required"/>
                     </div>
                     <div class="form-group">
                         <label>📅 Ngày Cấp</label>
                         <input type="date" name="h" value="<?php 
                        $cD = $x['ngaycap'];
                        $cV = date("Y-m-d", strtotime($cD));
                        echo $cV;?>" required="required" />
                     </div>
                     <div class="form-group">
                         <label>🏛️ Nơi Cấp</label>
                         <input type="text" name="i" value="<?php echo $x['noicap'];?>" required="required"  />
                     </div>
                 </div>
                 
                 <div class="form-row">
                     <div class="form-group form-full-width">
                         <label>📍 Địa Chỉ Liên Hệ</label>
                         <input type="text" name="j" value="<?php echo $x['diachilienhe'];?>" disabled="disabled" />
                     </div>
                 </div>
                 
                 <div class="form-row">
                     <div class="form-group form-full-width">
                         <label>🏠 Hộ Khẩu Thường Trú</label>
                         <input type="text" name="k" value="<?php echo $x['hokhauthuongtru'];?>" required="required" />
                     </div>
                 </div>
             </div>
             
             <div class="form-section">
                 <h4>🎓 Thông Tin Học Vấn</h4>
                 <div class="form-row">
                     <div class="form-group">
                         <label>📊 Trạng Thái</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><?php if($x['trangthai']==1){
                            echo "<strong>✅ Đang Học</strong>";
                        }
                        elseif($x['trangthai']==1){
                            echo "<strong>🎓 Đã Tốt Nghiệp</strong>";
                        }
                        else{
                            echo "<strong>⛔ Ngừng Học</strong>";
                        }?></div>
                     </div>
                     <div class="form-group">
                         <label>👥 Lớp</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong><?php echo $x['lopCN'];?></strong></div>
                     </div>
                     <div class="form-group">
                         <label>🎯 Bậc Đào Tạo</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong>Đại Học</strong></div>
                     </div>
                 </div>
                 
                 <div class="form-row">
                     <div class="form-group">
                         <label>🏫 Khoa</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong><?php echo $x['tenkhoa'];?></strong></div>
                     </div>
                     <div class="form-group">
                         <label>📚 Chuyên Ngành</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong><?php echo $x['tenchuyennganh'];?></strong></div>
                     </div>
                     <div class="form-group">
                         <label>📅 Ngày Vào Trường</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong><?php echo $x['ngayvaotruong'];?></strong></div>
                     </div>
                 </div>
                 
                 <div class="form-row">
                     <div class="form-group">
                         <label>🏢 Cơ Sở</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong><?php echo $x['cosodaotao'];?></strong></div>
                     </div>
                     <div class="form-group">
                         <label>🎓 Loại Hình Đào Tạo</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong>Chính Quy</strong></div>
                     </div>
                     <div class="form-group">
                         <label>📖 Khóa Học</label>
                         <div style="padding: 10px; background: #f5f7fa; border-radius: 6px;"><strong><?php echo $x['khoa'];?></strong></div>
                     </div>
                 </div>
             </div>
             
             <input type="hidden" name="id" value="<?php echo $x['user_id']; ?>" />
             <div class="form-actions">
                 <button type="submit" name="capnhat" class="btn-save">💾 Lưu Thay Đổi</button>
             </div>
             </form>
         </div>
         <?php
     }
	 elseif(isset($_REQUEST['dmk'])){
		 ?>
         <div class="password-form-container">
             <h5>🔐 Đổi Mật Khẩu</h5>
             
             <?php
                 if(isset($_POST['d'])){
                     $ma=$_REQUEST['bm'];
                     $mk=md5($_POST['a']);
                     $xm=$_POST['xm'];
                     $sql="select * from user where user_code='$ma'";
                     $qr=mysql_query($sql);
                     $e=mysql_fetch_assoc($qr);
                     $mkc=$e['matkhau'];
                     $a=$_POST['a'];
                     $b=$_POST['b'];
                     if(md5($xm)!=$mkc){
                         echo "<script>alert('Nhập mật khẩu cũ không đúng !')</script>";
                     }
                     elseif($b!=$a){
                         echo "<script>alert('Mật khẩu nhập lại không khớp !')</script>";
                     }
                     else{
                         $sql="update user set matkhau='$mk' where user_code='$ma'";
                         $qr=mysql_query($sql);
                         echo "<script>alert(' Đổi mật khẩu hoàn tất !')</script>";
                     }
                 }
             ?>
             
             <form action="#" method="post" enctype="multipart/form-data">
                 <div class="password-form-group">
                     <label>🔓 Mật Khẩu Cũ</label>
                     <input type="password" name="xm" required="required"/>
                 </div>
                 <div class="password-form-group">
                     <label>🔐 Mật Khẩu Mới</label>
                     <input type="password" name="a" required="required" />
                 </div>
                 <div class="password-form-group">
                     <label>✔️ Nhập Lại Mật Khẩu</label>
                     <input type="password" name="b"  required="required"/>
                 </div>
                 <div class="password-form-actions">
                     <input type="submit" name="d" value="Xác Nhận" />
                 </div>
             </form>
         </div>
         
         <?php
	 }
	 else{
	?>
    <div class="info-section">
        <h4>📋 Thông Tin Chung</h4>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">👤 Tên Sinh Viên</span>
                <span class="info-value"><?php echo $x['tensinhvien'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🎓 Mã Số Sinh Viên</span>
                <span class="info-value"><?php echo $x['masosinhvien']; ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">⚧️ Giới Tính</span>
                <span class="info-value"><?php echo $x['gioitinh'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🎂 Ngày Sinh</span>
                <span class="info-value"><?php $ngaysinh = date_create($x['ngaysinh']);
echo date_format($ngaysinh, 'd-m-Y');?></span>
            </div>
            <div class="info-item">
                <span class="info-label">📱 Điện Thoại</span>
                <span class="info-value"><?php echo $x['sdt'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">📧 Email</span>
                <span class="info-value"><?php echo $x['email'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🆔 Số CCCD</span>
                <span class="info-value"><?php echo $x['cccd'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">📅 Ngày Cấp</span>
                <span class="info-value"><?php $ngaycap = date_create($x['ngaycap']);
echo date_format($ngaycap, 'd-m-Y');?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🏛️ Nơi Cấp</span>
                <span class="info-value"><?php echo $x['noicap'];?></span>
            </div>
        </div>
        <div class="info-grid" style="margin-top: 20px;">
            <div class="info-item" style="grid-column: 1 / -1;">
                <span class="info-label">📍 Địa Chỉ Liên Hệ</span>
                <span class="info-value"><?php echo $x['diachilienhe'];?></span>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <span class="info-label">🏠 Hộ Khẩu Thường Trú</span>
                <span class="info-value"><?php echo $x['hokhauthuongtru'];?></span>
            </div>
        </div>
    </div>
    
    <div class="info-section">
        <h4>🎓 Thông Tin Học Vấn</h4>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">📊 Trạng Thái</span>
                <span class="info-value"><?php if($x['trangthai']==1){
                echo "✅ Đang Học";
            }
            elseif($x['trangthai']==1){
                echo "🎓 Đã Tốt Nghiệp";
            }
            else{
                echo "⛔ Ngừng Học";
            }?></span>
            </div>
            <div class="info-item">
                <span class="info-label">👥 Lớp</span>
                <span class="info-value"><?php echo $x['lopCN'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🎯 Bậc Đào Tạo</span>
                <span class="info-value">Đại Học</span>
            </div>
            <div class="info-item">
                <span class="info-label">🏫 Khoa</span>
                <span class="info-value"><?php echo $x['tenkhoa'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">📚 Chuyên Ngành</span>
                <span class="info-value"><?php echo $x['tenchuyennganh'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">📅 Ngày Vào Trường</span>
                <span class="info-value"><?php echo $x['ngayvaotruong'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🏢 Cơ Sở</span>
                <span class="info-value"><?php echo $x['cosodaotao'];?></span>
            </div>
            <div class="info-item">
                <span class="info-label">🎓 Loại Hình Đào Tạo</span>
                <span class="info-value">Chính Quy</span>
            </div>
            <div class="info-item">
                <span class="info-label">📖 Khóa Học</span>
                <span class="info-value"><?php echo $x['khoa'];?></span>
            </div>
        </div>
    </div>
    
    <div class="back-to-home">
        <a href="homeSV.php?bm=<?php echo $_REQUEST['bm'] ?>" title="Quay Lại Trang Chủ">←</a>
    </div>
    
    <?php
	 }
	?>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" alt="School Logo" class="footer-logo" />
                <p><strong>Chào Mừng Đến Với Hệ Thống Quản Lý Học Vụ</strong></p>
                <p>Nền tảng hiện đại để quản lý và theo dõi hoạt động học tập của bạn.</p>
            </div>
            
            <div class="footer-section">
                <h5>⚡ Tính Năng Chính</h5>
                <ul>
                    <li>Xem lịch học</li>
                    <li>Quản lý điểm số</li>
                    <li>Đơn xin phép</li>
                    <li>Thông báo học tập</li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h5>📞 Liên Hệ</h5>
                <div class="contact-info">
                    <img src="https://tse4.mm.bing.net/th?id=OIP.VMPvKsUQ9Q91rlEDRqsj8AHaHa&pid=Api&P=0&h=180" alt="Phone" />
                    <span>0143.234.563</span>
                </div>
                <div class="contact-info">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.Ye2A24tF7KlssZxi_cffWwHaGD&pid=Api&P=0&h=180" alt="Email" />
                    <span>csm@gmail.com</span>
                </div>
                <p style="margin-top: 15px; font-size: 12px;">Trung Tâm Quản Trị Hệ Thống - Trường Đại Học</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 Hệ Thống Quản Lý Học Vụ. Tất cả các quyền được bảo lưu.</p>
        </div>
    </footer>
</div>
</body>
</html>