<?php
session_start();
// var_dump(isset($_REQUEST['nopbai']));
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

<?php
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
?>
<?php
if(isset($_REQUEST['ctmh'])){
	$is=$_REQUEST['is'];
	$il=$_REQUEST['il'];
	$ihp=$_REQUEST['ihp'];
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	$kt="select * from thongketruycap where mahocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='$is'";
	$k=mysql_query($kt);
	if(mysql_num_rows($k)==1){
	$sql="update thongketruycap set ngaytruycap=now() where mahocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='$is'";
	$qr=mysql_query($sql);
	}
	else{
	$sql="insert into thongketruycap(ngaytruycap, mahocphan, id_lophocphan, id_sinhvien)
	values(now(), '$ihp', '$il', '$is')";
	$qr=mysql_query($sql);
	}
}
}
?>
<?php
/* Sinh viên nộp bài */
if(isset($_POST['nop'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định dạng file không được chấp nhận')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
                $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		  echo "<script>alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
	$file = $_FILES['f']['tmp_name'];
    $path = "file/".$_FILES['f']['name'];
	move_uploaded_file($file,$path);
        $this->filename = "file/".$_FILES['f']['name'];
    }
        function pptx_to_text() {
        $zip_handle = new ZipArchive;
        $output_text = "";
        $slide_number = 1; // loop through slide files

        if (true === $zip_handle->open($this->filename)) {
            while (($xml_index = $zip_handle->locateName("ppt/slides/slide" . $slide_number . ".xml")) !== false) {
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                $xml_handle = new DOMDocument;
                $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text .= strip_tags($xml_handle->saveXML());
                $slide_number++;
            }

            if ($slide_number == 1) {
                $output_text .= "";
            }

            $zip_handle->close();
        } else {
            $output_text .= "";
        }

        return $output_text;
    }

    function convertToText() {
        if (isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];

        if ($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx") {
            if ($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }
	}
	$docObj = new DocxConversion($_FILES['f']['name']); // replace your document name with the correct extension doc or docx
$content = $docObj->convertToText();
if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		  echo "<script>alert('File .pptx chứa mã thực thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
		
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('Phát hiện file .txt/.php chứa mã thực thi không cho up')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	/*
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	if(isset($_POST['nop'])){
		$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];
	$size=$_FILES['f']['size'];
	$type=$_FILES['f']['type'];
if($size > 10*1024*1024){
	echo "<script>alert('Quá Lớn!')</script>";
}
elseif($type!="application/vnd.openxmlformats-officedocument.wordprocessingml.document"&&$filetype!="application/msword"&&
$filetype!="application/pdf"&&$filetype!="application/zip"){
	echo "<script>alert('Tập Tin Định Dạng Không Chấp Nhận')</script>";
}
else{
    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp tin zip')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
	}
		
	}
	}
	*/
}
}
?>

<?php
/* Sinh viên nộp bài tập thực hành*/
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	if(isset($_POST['nopth'])){
		//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không thể upload !')</script>";
                } else {
                    
                }
            } else {
                $a=$_POST['a'];
					$f=$_FILES['f']['name'];
					$is=$_REQUEST['is'];
					$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		 echo "<script>alert('File .docx chứa mã thực thi không thể upload !')</script>";
	}
	else{
					$a=$_POST['a'];
					$f=$_FILES['f']['name'];
					$is=$_REQUEST['is'];
					$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
		 echo "<script>alert('File .txt/ .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$a=$_POST['a'];
					$f=$_FILES['f']['name'];
					$is=$_REQUEST['is'];
					$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	}
	/*$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
		
	}
	*/
}
?>

<?php
/* Sinh viên nộp bài kiểm tra thực hành*/
if(isset($_POST['nopktth'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
               $a=$_POST['a'];
		$f=$_FILES['f']['name'];
		$is=$_REQUEST['is'];
		$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
		$f=$_FILES['f']['name'];
		$is=$_REQUEST['is'];
		$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt/.php có chứa mã thực thi web không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$a=$_POST['a'];
		$f=$_FILES['f']['name'];
		$is=$_REQUEST['is'];
		$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}

	/*
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	if(isset($_POST['nopktth'])){
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
		
	}
	*/
}
}
?>


<?php
/* Sinh viên sửa bài */
if(isset($_POST['suab'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định dạng file không được chấp nhận')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa từ khóa không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
                $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
	$file = $_FILES['f']['tmp_name'];
    $path = "file/".$_FILES['f']['name'];
	move_uploaded_file($file,$path);
        $this->filename = "file/".$_FILES['f']['name'];
    }
        function pptx_to_text() {
        $zip_handle = new ZipArchive;
        $output_text = "";
        $slide_number = 1; // loop through slide files

        if (true === $zip_handle->open($this->filename)) {
            while (($xml_index = $zip_handle->locateName("ppt/slides/slide" . $slide_number . ".xml")) !== false) {
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                $xml_handle = new DOMDocument;
                $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text .= strip_tags($xml_handle->saveXML());
                $slide_number++;
            }

            if ($slide_number == 1) {
                $output_text .= "";
            }

            $zip_handle->close();
        } else {
            $output_text .= "";
        }

        return $output_text;
    }

    function convertToText() {
        if (isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];

        if ($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx") {
            if ($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }
	}
	$docObj = new DocxConversion($_FILES['f']['name']); // replace your document name with the correct extension doc or docx
$content = $docObj->convertToText();
if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .pptx chứa mã thực thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt/.php chứa mã thực thi không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
/*
if(isset($_POST['suab'])){
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];
	$size=$_FILES['f']['size'];
if($size > 10*1024*1024){
	echo "<script>alert('Quá Lớn!')</script>";
}
elseif($filetype!="application/vnd.openxmlformats-officedocument.wordprocessingml.document"&&$filetype!="application/msword"&&
$filetype!="application/pdf"&&$filetype!="application/zip"){
	echo "<script>alert('Tập Tin Định Dạng Không Chấp Nhận')</script>";
}
else{

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
		
	}
	}
}
*/
}
}
?>

<?php
/* Sinh viên nộp bài lý thuyết lần đầu */
if(isset($_POST['nbt'])){
    include_once("Model/mKetNoiSV.php");
    $p=new ketnoiSV();
    $kn=$p->ketnoi($ketnoi);
    if($kn){
        $t=$_FILES['f']['type'];
        $s=$_FILES['f']['size'];
        if($s > 10*1024*1024){
            echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
        }
        if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        &&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
        $t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
            echo "<script>alert('Định dạng file không được chấp nhận')</script>";
        }
        else{
            $a=$_POST['a'];
            $f=$_FILES['f']['name'];
            $is=$_REQUEST['is'];
            $id=$_REQUEST['id'];
            $target_directory = 'file/';
            $target_file = $target_directory.basename($f);
            move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
            $sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
            $qr=mysql_query($sql);
            echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbai&ctmh#bt'");
        }
    }
}
?>

<?php
/* Sinh viên sửa bài thực hành */
if(isset($_POST['suabth'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                   echo "<script>alert('File .zip chứa mã thực thi không thể upload !')</script>";
                } else {
                    
                }
            } else {
                $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
       echo "<script>alert('File .txt/ .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
}
/*
if(isset($_POST['suabth'])){
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	    $target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btth'");
		
	}
	*/
}
?>

<?php
/* Sinh viên sửa bài kiểm tra thực hành */
if(isset($_POST['suabktth'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file vượt quá 20MB')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
               $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt/ .php chứa mã thực thi không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
}
/*
if(isset($_POST['suabktth'])){
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	    $target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&is=".$_REQUEST['is']."&ihp=".$_REQUEST['ihp']."&il=".$_REQUEST['il']."&id=".$_REQUEST['id']."&nopbaith&ctmh#btthkt'");
		
	}
*/
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Chi Tiết Môn Học</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/lms-modern.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
/* ============================================================
   CSS CHO ctmonhoc.php  –  chỉ thay thế nội dung thẻ <style>
   Màu sắc giữ nguyên: #667eea / #764ba2 / white / #333 / #666
   ============================================================ */

/* ---------- RESET & BASE ---------- */
*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
  font-size: 15px;
  line-height: 1.6;
  color: #444;
  background: #f0f2f8;
}

a {
  color: #667eea;
  text-decoration: none;
  transition: color .25s, opacity .25s;
}
a:hover { color: #764ba2; text-decoration: none; }

/* ---------- HEADER TOP ---------- */
.header-top {
  background: linear-gradient(90deg, #667eea, #764ba2);
  color: #fff;
  font-size: 13px;
  padding: 7px 20px;
  text-align: center;
  letter-spacing: .3px;
}
.header-top p { margin: 0; }
.header-top span { margin: 0 14px; }

/* ---------- MAIN HEADER ---------- */
.main-header {
  background: #fff;
  box-shadow: 0 2px 10px rgba(102,126,234,.13);
  padding: 10px 0;
  position: sticky;
  top: 0;
  z-index: 100;
}
.container-custom {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 20px;
}

/* ---------- COURSE HEADER ---------- */
.course-header-section {
  background: #fff;
  border-radius: 14px;
  padding: 28px 32px;
  box-shadow: 0 3px 14px rgba(102,126,234,.10);
  margin: 22px 0 26px;
  border-left: 5px solid #667eea;
}
.course-title {
  color: #667eea;
  font-size: 26px;
  font-weight: 800;
  margin: 0;
  letter-spacing: -.3px;
}

/* ---------- NAV TABS ---------- */
.nav-tabs-custom {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 28px;
  border-bottom: 2px solid #e2e4f0;
  padding-bottom: 14px;
}
.nav-tab-item {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 10px 22px;
  background: #fff;
  border: 2px solid #e2e4f0;
  border-radius: 50px;   /* pill shape */
  cursor: pointer;
  font-weight: 700;
  font-size: 13.5px;
  transition: all .25s;
  color: #666;
  letter-spacing: .2px;
}
.nav-tab-item:hover {
  border-color: #667eea;
  color: #667eea;
  transform: translateY(-2px);
  box-shadow: 0 5px 14px rgba(102,126,234,.18);
}
.nav-tab-item.active {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  border-color: transparent;
  box-shadow: 0 6px 18px rgba(102,126,234,.32);
}

/* ---------- CONTENT SECTION ---------- */
.content-section {
  background: #fff;
  border-radius: 14px;
  padding: 28px 32px;
  box-shadow: 0 3px 14px rgba(102,126,234,.08);
  margin-bottom: 28px;
}
.content-section h4 {
  color: #333;
  font-size: 20px;
  font-weight: 800;
  margin: 0 0 22px;
  padding-bottom: 12px;
  border-bottom: 3px solid #667eea;
  letter-spacing: -.2px;
}

/* ---------- GRADES TABLE ---------- */
.grades-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  margin: 16px 0;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0,0,0,.07);
}
.grades-table thead {
  background: linear-gradient(135deg, #667eea, #764ba2);
}
.grades-table th {
  color: #fff;
  padding: 13px 16px;
  text-align: left;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: .5px;
  border: none;
}
.grades-table td {
  padding: 12px 16px;
  border-bottom: 1px solid #eff0f8;
  color: #555;
  font-size: 14px;
  background: #fff;
  vertical-align: middle;
}
.grades-table tbody tr:last-child td { border-bottom: none; }
.grades-table tbody tr:hover td { background: #f5f7ff; }
.grades-table strong { color: #333; font-weight: 700; }

/* ---------- MATERIAL LIST ---------- */
.material-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.material-item {
  padding: 13px 16px;
  margin-bottom: 9px;
  background: #f5f7fe;
  border-left: 4px solid #667eea;
  border-radius: 9px;
  transition: all .25s;
  display: flex;
  align-items: center;
  gap: 13px;
  cursor: pointer;
}
.material-item:hover {
  transform: translateX(6px);
  box-shadow: 0 5px 16px rgba(102,126,234,.18);
  background: linear-gradient(135deg, #667eea, #764ba2);
}
.material-item:hover a { color: #fff; }
.material-item img { width: 22px; height: 22px; flex-shrink: 0; }
.material-item a {
  flex: 1;
  font-weight: 600;
  font-size: 14.5px;
  color: #555;
}

/* ---------- UPLOAD FORM ---------- */
.upload-form {
  background: #f7f8fe;
  padding: 22px 24px;
  border-radius: 12px;
  margin: 18px 0 32px;
  border: 1.5px solid #e2e4f0;
}
.upload-form h5 {
  color: #667eea;
  font-size: 16px;
  font-weight: 700;
  margin: 0 0 18px;
  padding-bottom: 10px;
  border-bottom: 2px solid #e2e4f0;
}
.form-group-custom { margin-bottom: 16px; }
.form-group-custom label {
  display: block;
  color: #555;
  font-weight: 700;
  margin-bottom: 7px;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: .4px;
}
.form-group-custom input[type="text"],
.form-group-custom input[type="file"],
.form-group-custom textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1.5px solid #dde0f0;
  border-radius: 8px;
  font-size: 14px;
  transition: border-color .25s, box-shadow .25s;
  font-family: inherit;
  background: #fff;
  color: #333;
}
.form-group-custom input[type="text"]:focus,
.form-group-custom textarea:focus {
  outline: none;
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102,126,234,.12);
}
.form-group-custom textarea { min-height: 100px; resize: vertical; }

.btn-submit {
  padding: 11px 28px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  font-weight: 700;
  font-size: 14px;
  letter-spacing: .3px;
  transition: all .25s;
  box-shadow: 0 4px 14px rgba(102,126,234,.30);
}
.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 7px 20px rgba(102,126,234,.42);
}

/* ---------- ASSIGNMENT CARD ---------- */
.assignment-card {
  background: #fff;
  border-radius: 11px;
  padding: 18px 22px;
  margin-bottom: 14px;
  border-left: 4px solid #667eea;
  box-shadow: 0 2px 10px rgba(0,0,0,.06);
  transition: all .25s;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.assignment-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 22px rgba(102,126,234,.17);
}
.assignment-info { flex: 1; }
.assignment-title { color: #333; font-weight: 700; font-size: 15.5px; margin-bottom: 5px; }
.assignment-status { display: inline-flex; align-items: center; gap: 5px; margin-top: 8px; }
.assignment-status img { width: 18px; height: 18px; }
.assignment-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  border-radius: 50px;
  font-weight: 700;
  font-size: 13.5px;
  transition: all .25s;
  white-space: nowrap;
  box-shadow: 0 4px 12px rgba(102,126,234,.28);
}
.assignment-link:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(102,126,234,.42);
  color: #fff;
}

/* ---------- SECTION TITLE ---------- */
.section-title {
  color: #667eea;
  font-size: 19px;
  font-weight: 800;
  margin: 36px 0 18px;
  padding-bottom: 10px;
  border-bottom: 3px solid #667eea;
  display: flex;
  align-items: center;
  gap: 9px;
  letter-spacing: -.2px;
}

/* ---------- FOOTER ---------- */
.footer {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: rgba(255,255,255,.88);
  padding: 42px 0 0;
  margin-top: 48px;
}
.footer-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 32px;
  padding-bottom: 32px;
}
.footer-section h5 {
  color: #fff;
  font-size: 15px;
  font-weight: 800;
  margin: 0 0 14px;
  text-transform: uppercase;
  letter-spacing: .5px;
  padding-bottom: 8px;
  border-bottom: 2px solid rgba(255,255,255,.25);
}
.footer-section p { font-size: 13.5px; line-height: 1.7; margin: 0 0 6px; }
.footer-section ul { list-style: none; padding: 0; margin: 0; }
.footer-section ul li { margin-bottom: 8px; }
.footer-section ul li a { color: rgba(255,255,255,.82); font-size: 13.5px; }
.footer-section ul li a:hover { color: #fff; }
.footer-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
.footer-logo img { height: 42px; border-radius: 8px; }
.footer-logo h5 { margin: 0; border: none; padding: 0; font-size: 16px; }
.footer-bottom {
  border-top: 1px solid rgba(255,255,255,.2);
  text-align: center;
  padding: 16px 20px;
  font-size: 12.5px;
  color: rgba(255,255,255,.65);
}

/* ---------- SLIDE / BÀI TẬP / TÀI LIỆU: raw <p> & <ul><li> bên trong content-section ---------- */

/* Mỗi dòng link tài liệu/bài tập được render bằng <p style="font-size:18px;"> */
.content-section > p[style*="font-size"],
.content-section p[style*="font-size:18px"],
.content-section p[style*="font-size: 18px"] {
  margin: 0 0 8px !important;
  font-size: 14.5px !important;   /* override inline style */
  line-height: 1 !important;
}

/* Bọc mỗi <p> chứa link tài liệu thành card-row */
.content-section p[style*="font-size"] a,
.content-section p[style*="font-size:18px"] a,
.content-section p[style*="font-size: 18px"] a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 11px 16px;
  background: #f5f7fe;
  border-left: 4px solid #667eea;
  border-radius: 9px;
  font-weight: 600;
  font-size: 14.5px !important;
  color: #555 !important;
  transition: all .25s;
  text-decoration: none;
  width: 100%;
}
.content-section p[style*="font-size"] a:hover,
.content-section p[style*="font-size:18px"] a:hover,
.content-section p[style*="font-size: 18px"] a:hover {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff !important;
  transform: translateX(5px);
  box-shadow: 0 5px 16px rgba(102,126,234,.20);
}
.content-section p[style*="font-size"] a img,
.content-section p[style*="font-size:18px"] a img,
.content-section p[style*="font-size: 18px"] a img {
  width: 20px !important;
  height: 20px !important;
  flex-shrink: 0;
  object-fit: contain;
}

/* Badge "Đã nộp" (span màu xanh lá) nằm kế link */
.content-section p[style*="font-size"] > span,
.content-section p[style*="font-size:18px"] > span,
.content-section p[style*="font-size: 18px"] > span {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin-left: 6px;
  padding: 3px 10px;
  background: #e6f9ee;
  color: #22a55b;
  border-radius: 20px;
  font-size: 12.5px;
  font-weight: 700;
  vertical-align: middle;
}

/* Tick icon (img ngay sau link, không nằm trong a) */
.content-section p[style*="font-size"] > img,
.content-section p[style*="font-size:18px"] > img {
  width: 18px !important;
  height: 18px !important;
  vertical-align: middle;
  margin-left: 6px;
}

/* Tiêu đề section (strong màu cam: Tài Liệu, Bài Tập, ...) */
.content-section > strong[style*="color:#F63"],
.content-section strong[style*="color: #F63"],
.content-section strong[style*="#F63"] {
  display: block;
  margin: 32px 0 14px !important;
  font-size: 17px !important;
  font-weight: 800 !important;
  color: #667eea !important;          /* đồng bộ màu theme, không dùng cam */
  padding-bottom: 10px;
  border-bottom: 3px solid #667eea;
  letter-spacing: -.2px;
}

/* h5 tiêu đề phụ (Tài Liệu Tham Khảo, Slide, Phần Thực Hành...) */
.content-section h5 {
  color: #667eea;
  font-size: 16px;
  font-weight: 800;
  margin: 28px 0 14px !important;
  padding-bottom: 9px;
  border-bottom: 2px solid #e2e4f0;
  letter-spacing: -.1px;
}

/* ul không có class (dùng trong slide/tài liệu) */
.content-section ul:not(.material-list) {
  list-style: none;
  padding: 0;
  margin: 0 0 16px;
}
.content-section ul:not(.material-list) li {
  margin-bottom: 8px;
}
.content-section ul:not(.material-list) li > a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 11px 16px;
  background: #f5f7fe;
  border-left: 4px solid #667eea;
  border-radius: 9px;
  font-weight: 600;
  font-size: 14.5px;
  color: #555;
  transition: all .25s;
}
.content-section ul:not(.material-list) li > a:hover {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: #fff;
  transform: translateX(5px);
  box-shadow: 0 5px 16px rgba(102,126,234,.20);
}

/* Loại bỏ <p></p> trống gây khoảng trắng thừa */
.content-section > p:empty { display: none; }

/* ---------- UTILITY: warning banner ---------- */
p[style*="background: #fff3cd"] {
  border-radius: 8px !important;
  font-size: 13.5px !important;
}

/* ---------- BOOTSTRAP TABLE OVERRIDE (grades context) ---------- */
.table.table-bordered { border-radius: 10px; overflow: hidden; }
.table.table-bordered th { background: linear-gradient(135deg,#667eea,#764ba2); color:#fff; border:none; }
.table.table-bordered td { vertical-align: middle; }

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
  .course-header-section, .content-section { padding: 18px 16px; }
  .course-title { font-size: 20px; }
  .nav-tabs-custom { gap: 7px; }
  .nav-tab-item { padding: 9px 14px; font-size: 12px; }
  .assignment-card { flex-direction: column; align-items: flex-start; }
  .assignment-link { width: 100%; justify-content: center; margin-top: 12px; }
  .grades-table th, .grades-table td { padding: 9px 10px; font-size: 13px; }
}
@media (max-width: 480px) {
  .course-header-section, .content-section { padding: 14px 12px; }
  .course-title { font-size: 17px; }
  .nav-tab-item { padding: 8px 11px; font-size: 11px; }
  .content-section h4 { font-size: 17px; }
  .grades-table th, .grades-table td { padding: 7px 8px; font-size: 11.5px; }
  .upload-form { padding: 16px; }
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
            <a href="homeSV.php?bm=<?php echo $_REQUEST['bm']; ?>">
                <img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" alt="Logo" style="height: 65px; width: auto; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" />
            </a>
            <h2 style="color: #667eea; margin: 0; font-size: 24px; font-weight: 700;">📚 Chi Tiết Môn Học</h2>
            <div style="width: 65px; display: flex; align-items: center; justify-content: flex-end;">
                <?php
                include_once("Model/mKetNoiADHT.php");
                $p=new ketnoiAD();
                $kn=$p->ketnoi($ketnoi);
                if($kn){
                    $bm=$_REQUEST['bm'];
                    $sql="select *from user u join sinhvien s on u.user_id=s.user_id where user_code='$bm' ";
                    $asv=mysql_query($sql);
                    $t=mysql_fetch_assoc($asv);
                }
                $anh=$t['anh'];
                if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
                    ?>
                    <a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>" style="display: inline-block; width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 3px solid #667eea; box-shadow: 0 2px 8px rgba(102,126,234,0.3);">
                        <img src="<?php echo $anh?>" style="width: 100%; height: 100%; object-fit: cover;" />
                    </a>
                    <?php
                }
                else{
                    ?>
                    <a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>" style="display: inline-block; width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border: 3px solid #667eea; box-shadow: 0 2px 8px rgba(102,126,234,0.3);">
                        <img src="img/<?php echo $anh?>" style="width: 100%; height: 100%; object-fit: cover;" />
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container-custom" style="padding: 20px 15px;">
    <div class="course-header-section">
        <h1 class="course-title">📖 <?php 
        $is=$_REQUEST['is'];
        $ihp=$_REQUEST['ihp'];
        $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan where md5(hp.id_hocphan)='$ihp'";
        $qr=mysql_query($sql);
        $ttm=mysql_fetch_assoc($qr);
        echo $ttm['tenhocphan']; 
        ?></h1>
    </div>
    
    <div class="nav-tabs-custom">
        <?php if(isset($_REQUEST['kh'])){ ?>
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>&kh" class="nav-tab-item active">📚 Khóa Học</a>
        <?php } else{ ?>
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>&kh" class="nav-tab-item">📚 Khóa Học</a>
        <?php } ?>
        
        <?php if(isset($_REQUEST['tv'])){ ?>
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>&tv" class="nav-tab-item active">👥 Thành Viên</a>
        <?php } else{ ?>
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>&tv" class="nav-tab-item">👥 Thành Viên</a>
        <?php } ?>
        
        <?php if(isset($_REQUEST['ds'])){ ?>
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>&ds" class="nav-tab-item active">📊 Điểm Số</a>
        <?php } else{ ?>
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>&ds" class="nav-tab-item">📊 Điểm Số</a>
        <?php } ?>

        <?php if(isset($_REQUEST['ai'])){ ?>
            <a href="chat-ai-sv.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>" class="nav-tab-item active">🤖 Chat AI</a>
        <?php } else{ ?>
            <a href="chat-ai-sv.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp']?>&il=<?php echo $_REQUEST['il'] ?>" class="nav-tab-item">🤖 Chat AI</a>
        <?php } ?>
    </div>

<?php
// ===== HIEN THI NOI DUNG CHINH =====
if(isset($_REQUEST['nopbai'])){
    // Form nop bai ly thuyet
    $id=$_REQUEST['id'];
    $sql="select * from baitaplythuyet where id_btlt='$id'";
    $qr=mysql_query($sql);
    $x=mysql_fetch_assoc($qr);
    ?>
    <div class="content-section">
        <h4>📝 Nop Bai Tap Ly Thuyet</h4>
        <?php
        $sql="select * from filenopbtlt where id_sinhvien='$is' and id_btlt='$id'";
        $qr=mysql_query($sql);
        $hasSubmission = mysql_num_rows($qr) > 0;
        if($hasSubmission){
            $s=mysql_fetch_assoc($qr);
        }
        if($hasSubmission){
            ?>
            <div class="upload-form">
                <h5 style="color: #667eea; margin-top: 0;">✏️ Sua Bai Tap Da Nop</h5>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group-custom">
                        <label>📝 Tieu De</label>
                        <input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" required="required" />
                    </div>
                    <div class="form-group-custom">
                        <label>📎 File Da Nop</label>
                        <div style="padding: 10px 12px; background: #f5f7fa; border-radius: 6px; display: flex; align-items: center; gap: 10px;">
                            <a href="taixuong.php?fu=<?php echo $s['filenop'];?>" style="display: flex; align-items: center; gap: 8px; color: #667eea; text-decoration: none; font-weight: 600; flex: 1;">
                                <img src="https://tse2.mm.bing.net/th?id=OIP.8Ck3Lp06jASLSybjpchJJgHaHa&pid=Api&P=0&h=180" style="height: 20px; width: auto;" />
                                <?php echo $s['filenop']; ?>
                            </a>
                        </div>
                    </div>
                    <?php 
                    $bd=strtotime($x['batdaunop']);
                    $kt=strtotime($x['ketthucnop']);
                    $ht=strtotime("now");
                    if($ht<$bd || $ht>$kt){
                        ?>
                        <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; margin: 15px 0; font-size: 14px;">
                            ⚠️ Het han nop bai. Khong the sua lai duoc.
                        </p>
                    <?php
                    }
                    else{
                    ?>
                    <div class="form-group-custom">
                        <label>📤 File Moi</label>
                        <input type="file" name="f" required="required" />
                    </div>
                    <button type="submit" name="suab" class="btn-submit">💾 Sua Bai</button>
                    <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Luu y: Ten file nop theo dinh dang MSSV_HoTen_TieuDe. Nop dung han!</p>
                <?php } ?>
                </form>
            </div>
        <?php
        }
        else{
        ?>
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #667eea; margin-top: 0;">📄 File Bai Tap</h5>
            <p style="margin: 10px 0;">
                <a href="taixuong.php?fu=<?php echo $x['filebt'];?>" style="display: inline-flex; align-items: center; gap: 8px; color: #667eea; text-decoration: none; font-weight: 600;">
                    <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" style="height: 20px; width: auto;" />
                    <?php echo $x['tieude']; ?>
                </a>
            </p>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                <strong>⏱️ Han Nop:</strong> <?php 
                $cD = $x['batdaunop'];
                $bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?> 
                <strong>den</strong> 
                <?php $cS = $x['ketthucnop'];
                $kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?>
            </p>
            <p style="font-size: 13px; font-style: italic; color: #999;">Ban vao file de tai xuong</p>
        </div>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">📤 Nop Bai Tap Lan Dau</h5>
            <?php 
            $bd=strtotime($x['batdaunop']);
            $kt=strtotime($x['ketthucnop']);
            $ht=strtotime("now");
            if($ht<$bd || $ht>$kt){
                $status = $ht < $bd ? "Chua den han nop" : "Het han nop";
                ?>
                <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; font-size: 14px;">
                    ⚠️ <?php echo $status; ?>. Khong the nop bai.
                </p>
            <?php
            } else {
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tieu De</label>
                    <input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                <div class="form-group-custom">
                    <label>📎 File Nop</label>
                    <input type="file" name="f" required="required" />
                </div>
                <button type="submit" name="nbt" class="btn-submit">📤 Nop Bai</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Luu y: Ten file nop theo dinh dang MSSV_HoTen_TieuDe. Nop dung han!</p>
            </form>
            <?php } ?>
            <?php } ?>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp'] ?>&il=<?php echo $_REQUEST['il'] ?>&kh" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px;">⬅ Quay Lai</a>
        </div>
        </div>
    </div>
    <?php
}
elseif(isset($_REQUEST['nopbaith'])){
    // Form nop bai thuc hanh
    $id=$_REQUEST['id'];
    $sql="select * from baitapthuchanh where id_btth='$id'";
    $qr=mysql_query($sql);
    $r=mysql_fetch_assoc($qr);
    ?>
    <div class="content-section">
        <h4>📝 Nop Bai Tap Thuc Hanh</h4>
        <?php
        $sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
        $qr=mysql_query($sql);
        $hasSubmission = mysql_num_rows($qr) > 0;
        if($hasSubmission){
            $s=mysql_fetch_assoc($qr);
        }
        if($hasSubmission){
            ?>
            <div class="upload-form">
                <h5 style="color: #667eea; margin-top: 0;">✏️ Sua Bai Tap Da Nop</h5>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group-custom">
                        <label>📝 Tieu De</label>
                        <input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" required="required" />
                    </div>
                    <div class="form-group-custom">
                        <label>📎 File Da Nop</label>
                        <input type="text" value="<?php echo $s['filenop'] ?>" disabled="disabled" style="background: #f0f0f0; cursor: not-allowed;" />
                    </div>
                    <?php 
                    $bd=strtotime($r['batdaunop']);
                    $kt=strtotime($r['ketthucnop']);
                    $ht=strtotime("now");
                    if($ht<$bd || $ht>$kt){
                        ?>
                        <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; margin: 15px 0; font-size: 14px;">
                            ⚠️ Het han nop bai. Khong the sua lai duoc.
                        </p>
                    <?php
                    }
                    else{
                    ?>
                    <div class="form-group-custom">
                        <label>📤 File Moi</label>
                        <input type="file" name="f" required="required" />
                    </div>
                    <button type="submit" name="suabth" class="btn-submit">💾 Sua Bai</button>
                <?php } ?>
                    <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Luu y: Ten file nop theo dinh dang MSSV_HoTen_TieuDe. Nop dung han!</p>
                </form>
            </div>
        <?php
        }
        else{
        ?>
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #667eea; margin-top: 0;">📄 <?php echo $r['tieude'] ?></h5>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                <strong>⏱️ Han Nop:</strong> <?php 
                $cD = $r['batdaunop'];
                $bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?> 
                <strong>den</strong> 
                <?php $cS = $r['ketthucnop'];
                $kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?>
            </p>
        </div>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">📤 Nop Bai Tap Thuc Hanh</h5>
            <?php 
            $bd=strtotime($r['batdaunop']);
            $kt=strtotime($r['ketthucnop']);
            $ht=strtotime("now");
            if($ht<$bd || $ht>$kt){
                $status = $ht < $bd ? "Chua den han nop" : "Het han nop";
                ?>
                <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; font-size: 14px;">
                    ⚠️ <?php echo $status; ?>. Khong the nop bai.
                </p>
            <?php
            }
            else{
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tieu De</label>
                    <input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                <div class="form-group-custom">
                    <label>📤 Chon File</label>
                    <input type="file" name="f" required="required" />
                </div>
                <button type="submit" name="nopth" class="btn-submit">✅ Nop Bai</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Luu y: Ten file nop theo dinh dang MSSV_HoTen_TieuDe. Nop dung han!</p>
            </form>
            <?php
            }
            }
            ?>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp'] ?>&il=<?php echo $_REQUEST['il'] ?>&kh" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px;">⬅ Quay Lai</a>
        </div>
    </div>
    <?php
}
elseif(isset($_REQUEST['nopbaiktth'])){
    // Form nop kiem tra thuc hanh
    $id=$_REQUEST['id'];
    $sql="select * from baitapthuchanh where id_btth='$id'";
    $qr=mysql_query($sql);
    $q=mysql_fetch_assoc($qr);
    ?>
    <div class="content-section">
        <h4>📝 Nop Kiem Tra Thuc Hanh</h4>
        <?php
        $sql="select * from filenopktth where id_sinhvien='$is' and id_btth='$id'";
        $qr=mysql_query($sql);
        $hasSubmission = mysql_num_rows($qr) > 0;
        if($hasSubmission){
            $s=mysql_fetch_assoc($qr);
        }
        if($hasSubmission){
            ?>
            <div class="upload-form">
                <h5 style="color: #667eea; margin-top: 0;">✏️ Sua Bai Da Nop</h5>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group-custom">
                        <label>📝 Tieu De</label>
                        <input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" required="required" />
                    </div>
                    <div class="form-group-custom">
                        <label>📎 File Da Nop</label>
                        <input type="text" value="<?php echo $s['filenop'] ?>" disabled="disabled" style="background: #f0f0f0; cursor: not-allowed;" />
                    </div>
                    <?php 
                    $bd=strtotime($q['batdaunop']);
                    $kt=strtotime($q['ketthucnop']);
                    $ht=strtotime("now");
                    if($ht<$bd || $ht>$kt){
                        ?>
                        <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; margin: 15px 0; font-size: 14px;">
                            ⚠️ Het han nop bai. Khong the sua lai duoc.
                        </p>
                    <?php
                    }
                    else{
                    ?>
                    <div class="form-group-custom">
                        <label>📤 File Moi</label>
                        <input type="file" name="f" required="required" />
                    </div>
                    <button type="submit" name="suabktth" class="btn-submit">💾 Sua Bai</button>
                <?php } ?>
                    <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Luu y: Ten file nop theo dinh dang MSSV_HoTen_TieuDe. Nop dung han!</p>
                </form>
            </div>
        <?php
        }
        else{
        ?>
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #667eea; margin-top: 0;">📄 <?php echo $q['tieude'] ?></h5>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                <strong>⏱️ Han Nop:</strong> <?php 
                $cD = $q['batdaunop'];
                $bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?> 
                <strong>den</strong> 
                <?php $cS = $q['ketthucnop'];
                $kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?>
            </p>
        </div>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">📤 Nop Kiem Tra Thuc Hanh</h5>
            <?php 
            $bd=strtotime($q['batdaunop']);
            $kt=strtotime($q['ketthucnop']);
            $ht=strtotime("now");
            if($ht<$bd || $ht>$kt){
                $status = $ht < $bd ? "Chua den han nop" : "Het han nop";
                ?>
                <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; font-size: 14px;">
                    ⚠️ <?php echo $status; ?>. Khong the nop bai.
                </p>
            <?php
            }
            else{
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tieu De</label>
                    <input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                <div class="form-group-custom">
                    <label>📤 Chon File</label>
                    <input type="file" name="f" required="required" />
                </div>
                <button type="submit" name="nopktth" class="btn-submit">✅ Nop Bai</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Luu y: Ten file nop theo dinh dang MSSV_HoTen_TieuDe. Nop dung han!</p>
            </form>
        <?php
        }
        }
        ?>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp'] ?>&il=<?php echo $_REQUEST['il'] ?>&kh" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px;">⬅ Quay Lai</a>
        </div>
    </div>
    <?php
}
elseif(isset($_REQUEST['ds'])){
    ?>
    <div class="content-section">
        <h4>📊 Diem So Cua Ban</h4>
        <?php
            $is=$_REQUEST['is'];
            $il=$_REQUEST['il'];
            $ihp=$_REQUEST['ihp'];
            $s="select * from diem d join ct_hocphan c
            on d.id_hocphan=c.id_hocphan where d.id_sinhvien='$is' and d.id_lophocphan='$il' and md5(d.id_hocphan)='$ihp'";
            $qr=mysql_query($s);
            $r=mysql_fetch_assoc($qr);
        ?>
        <table class="grades-table">
            <thead>
                <tr>
                    <th>Tieu De Diem</th>
                    <th>Trong So</th>
                    <th>Diem</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>📝 TK1</td>
                    <td>20%</td>
                    <td><strong><?php echo $r['TK1'] ?></strong></td>
                </tr>
                <tr>
                    <td>📝 TK2</td>
                    <td>20%</td>
                    <td><strong><?php echo $r['TK2'] ?></strong></td>
                </tr>
                <tr>
                    <td>📝 TK3</td>
                    <td>20%</td>
                    <td><strong><?php echo $r['TK3'] ?></strong></td>
                </tr>
                <tr>
                    <td>✏️ GK</td>
                    <td>30%</td>
                    <td><strong><?php echo $r['GK'] ?></strong></td>
                </tr>
                <tr>
                    <td>🧪 TH1</td>
                    <td>100%</td>
                    <td><strong><?php echo $r['TH1'] ?></strong></td>
                </tr>
                <tr>
                    <td>🧪 TH2</td>
                    <td>100%</td>
                    <td><strong><?php echo $r['TH2'] ?></strong></td>
                </tr>
                <tr>
                    <td>🧪 TH3</td>
                    <td>100%</td>
                    <td><strong><?php echo $r['TH3'] ?></strong></td>
                </tr>
                <tr>
                    <td>🎓 CK</td>
                    <td>50%</td>
                    <td><strong><?php echo $r['CK'] ?></strong></td>
                </tr>
                <tr style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); font-weight: 600;">
                    <td>📚 Tổng Số Tín Chỉ</td>
                    <td colspan="2"><strong><?php echo $r['soTC'] ?></strong></td>
                </tr>
                <tr style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%);">
                    <td>💡 Tín Chỉ Lý Thuyết</td>
                    <td colspan="2"><strong><?php echo $r['TCLT'] ?></strong> - Tín Chỉ Thực Hành: <strong><?php echo $r['TCTH'] ?></strong></td>
                </tr>
                <tr style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); font-weight: 600; color: #667eea; font-size: 15px;">
                    <td colspan="3">🎯 Điểm TB: <?php $tc=$r['soTC'];
                        $tclt=$r['TCLT'];
                        $tcth=$r['TCTH'];
                        $tk1=$r['TK1'];
                        $tk2=$r['TK2'];
                        $tk3=$r['TK3'];
                        $gk=$r['GK'];
							  $th1=$r['TH1'];
							  $th2=$r['TH2'];
							  $th3=$r['TH3'];
							  $ck=$r['CK'];
							  if($tk2==""&&$tk3==""){
								  $tk=$tk1;
							  }
							  elseif($tk3==""){
								  $tk=($tk1+$tk2)/2;
							  }
							  else{
								  $tk=($tk1+$tk2+$tk3)/3;
							  }
							  if($th2==""&&$th3==""){
								  $th=$th1;
							  }
							  elseif($th3==""){
								  $th=($th1+$th2)/2;
							  }
							  else{
								  $th=($th1+$th2+$th3)/3;
							  }
							  if($ck==""){
							  }
							  else{
								  $dtb=((($tk*0.2+$gk*0.3+$ck*0.5)*$tclt+$th*$tcth)/$tc);
								  echo "&nbsp;&nbsp;<i>".round($dtb,1)."</i>";
							  }?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm']; ?>&is=<?php echo $_REQUEST['is']; ?>&ihp=<?php echo $_REQUEST['ihp']; ?>&il=<?php echo $_REQUEST['il']; ?>&ds&kj#abc" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; font-weight: 600; border-radius: 6px; transition: 0.3s;">
            📝 Phản Hồi Điểm
        </a>
    </div>
    <?php
    if(isset($_REQUEST['kj'])){ 
    ?>
    <div class="content-section" id="abc">
        <h4>💬 Phản Hồi Về Điểm Số</h4>
        <form action="#" method="post" enctype="multipart/form-data" style="max-width: 600px;">
            <div class="form-group">
                <label>Tiêu Đề</label>
                <input type="text" name="a" required="required" />
            </div>
            <div class="form-group">
                <label>Nội Dung</label>
                <textarea name="b" required="required" style="min-height: 100px;"></textarea>
            </div>
            <div class="form-group">
                <label>Lý Do</label>
                <input type="text" name="c" required="required" />
            </div>
            <button type="submit" name="gui" class="btn-submit">🚀 Gửi Đi</button>
            <p style="font-style: italic; color: #999; margin-top: 15px;">Lưu ý: Phản Hồi Sẽ Được Gửi Về Email Giảng Viên. Xin Hãy Cân Nhắc Thật Kỹ Trước Khi Gửi!</p>
        </form>
    </div>
    <?php
    }
    ?>
    <?php
    if(isset($_POST['gui'])){
        $il=$_REQUEST['il'];
        $ihp=$_REQUEST['ihp'];
        $is=$_REQUEST['is'];
        $a=$_POST['a'];
        $b=$_POST['b'];
        $c=$_POST['c'];
        $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
            join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
            join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
            join giangvien gv on d.id_giangvien=gv.id_giangvien join user u on u.user_id=gv.user_id
            where md5(m.id_hocphan)='$ihp'
            and m.id_lophocphan='$il'";
        $qr=mysql_query($sql);
        $r=mysql_fetch_assoc($qr);
        $e= $r['email'];
        $sql1="select *from sinhvien s join user u on u.user_id=s.user_id where s.id_sinhvien='$is'";
        $qr1=mysql_query($sql1);
        $r1=mysql_fetch_assoc($qr1);
        $e1= $r1['email'];
        
        include "class.phpmailer.php";
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        // $mail->SMTPDebug = 1;
        // $mail->SMTPAuth = true;
        // $mail->SMTPSecure = 'ssl';
        // $mail->Host = "smtp.gmail.com";
        // $mail->Port = 465;
        // $mail->IsHTML(true);
        // $mail->Username = "phucable@gmail.com";
        // $mail->Password = "afbv blky ofzi vzsy";
        // $mail->SetFrom($e1);
        // $mail->AddAddress($e);
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
        $mail->AddAddress($e);
        $mail->Subject = "Phản Hồi Điểm Từ Sinh Viên";
        $mail->Body = "<p style='color:#000;'><strong>".$a."</strong> <br>
        <p></p>
        - Nội Dung: ".$b." <br/>
        - Lý Do: ".$c." <br/>
        - Xin Cảm Ơn Quý Thầy Cô Đã Xem !</p>";
        if($mail->Send()){
        }
        else{
        }
        echo "<script>alert('Gửi Đi Thành Công !')</script>";		
    }
    ?>
    <?php
}
elseif(isset($_REQUEST['tv'])){
    ?>
    <div class="content-section">
        <h4>👥 Danh Sách Thành Viên Lớp Học</h4>
        <table class="grades-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Họ Và Tên</th>
                    <th>Vai Trò</th>
                    <th style="width: 220px;">Lần Truy Cập Gần Nhất</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $il=$_REQUEST['il'];
                $ihp=$_REQUEST['ihp'];
                $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
                join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
                join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
                join giangvien gv on d.id_giangvien=gv.id_giangvien
                where md5(m.id_hocphan)='$ihp'
                and m.id_lophocphan='$il'";
                $qr=mysql_query($sql);
                $qr1=mysql_query($sql);
                ?>
                <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <td>👨‍🏫</td>
                    <td><?php 
                    $kv=mysql_fetch_assoc($qr1); echo $kv['hotengiangvien'] ?></td>
                    <td><span style="background: rgba(255,255,255,0.2); padding: 4px 8px; border-radius: 4px;">Giáo Viên</span></td>
                    <td>
                        <?php 
                        $idgv=$kv['id_giangvien'];
                        $il=$kv['id_lophocphan'];
                        $sql2="select * from thongketruycap where id_giangvien='$idgv' and id_lophocphan='$il'";
                        $qr2=mysql_query($sql2);
                        $te=mysql_fetch_assoc($qr2);
                        $tc=strtotime($te['ngaytruycap']);
                        $ts=strtotime("now");
                        $k= $ts-$tc;
                        $g= $k%60;
                        $p= floor(($k%3600)/60);
                        $h= floor(($k%86400)/3600);
                        $n= floor(($k%2592000)/86400);
                        ?>
                        <span>Trước <?php echo $n."&nbsp;ngày&nbsp;".$h."&nbsp;giờ&nbsp;".$p."&nbsp;phút"; ?></span>
                    </td>
                </tr>
                <?php
                $a=1;
                while($ttm=mysql_fetch_assoc($qr)){
                ?>
                <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $ttm['tensinhvien'] ?></td>
                    <td><span style="background: #f5f7fa; padding: 4px 8px; border-radius: 4px; color: #667eea;">Học Viên</span></td>
                    <td>
                        <?php
                        $idsv=$ttm['id_sinhvien'];
                        $il=$ttm['id_lophocphan'];
                        $sql1="select * from thongketruycap where id_sinhvien='$idsv' and id_lophocphan='$il'";
                        $qr1=mysql_query($sql1);
                        $tc=mysql_fetch_assoc($qr1);
                        $tc=strtotime($tc['ngaytruycap']);
                        $ts=strtotime("now");
                        $k= $ts-$tc;
                        $g= $k%60;
                        $p= floor(($k%3600)/60);
                        $h= floor(($k%86400)/3600);
                        $n= floor(($k%2592000)/86400);
                        ?>
                        <span>Trước <?php echo $n."&nbsp;ngày&nbsp;".$h."&nbsp;giờ&nbsp;".$p."&nbsp;phút"; ?></span>
                    </td>
                </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
<p></p>
<!-- - Nội Dung: ".$b." <br/>
- Lý Do: ".$c." <br/>
- Xin Cảm Ơn Quý Thầy Cô Đã Xem !</p>";
 if($mail->Send()){
	
   
}
else{
}
		 echo "<script>alert('Gửi Đi Thành Công !')<script>";		
		 }
		 ?> -->
         <p></p>
    </div>
    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
    </div>
  </div>
  <br />
    <?php
}
else{
?>
<?php 
if(isset($_REQUEST['nopbaith'])){
$id=$_REQUEST['id'];
$sql="select * from baitapthuchanh where id_btth='$id'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
	?>
<div class="content-section">
    <h4>📝 Nộp Bài Tập Thực Hành</h4>
    <?php
    $sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
    $qr=mysql_query($sql);
    $s=mysql_fetch_assoc($qr);
    if(mysql_num_rows($qr)==1){
    }
    else{
        ?>
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #667eea; margin-top: 0;">📄 <?php echo $r['tieude'] ?></h5>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                <strong>⏱️ Hạn Nộp:</strong> <?php 
                $cD = $r['batdaunop'];
                $bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?> 
                <strong>đến</strong> 
                <?php $cS = $r['ketthucnop'];
                $kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?>
            </p>
        </div>
        <?php } ?>
    
    <?php
    $sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
    $qr=mysql_query($sql);
    $s=mysql_fetch_assoc($qr);
    if(mysql_num_rows($qr)==1){
        ?>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">✏️ Sửa Bài Tập Đã Nộp</h5>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tiêu Đề</label>
                    <input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                
                <div class="form-group-custom">
                    <label>📎 File Đã Nộp</label>
                    <input type="text" name="f1" value="<?php echo $s['filenop']  ?>" disabled="disabled" style="background: #f0f0f0; cursor: not-allowed;" />
                </div>
                
                <?php 
                $bd=strtotime($r['batdaunop']);
                $kt=strtotime($r['ketthucnop']);
                $ht=strtotime("now");
                if($ht<$bd || $ht>$kt){
                    ?>
                    <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; margin: 15px 0; font-size: 14px;">
                        ⚠️ Hết hạn nộp bài. Không thể sửa lại được.
                    </p>
                    <?php
                }
                else{
                ?>
                <div class="form-group-custom">
                    <label>📤 File Mới</label>
                    <input type="file" name="f" required="required" />
                </div>
                <button type="submit" name="suabth" class="btn-submit">💾 Sửa Bài</button>
                <?php } ?>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Lưu ý: Tên file nộp theo định dạng MSSV_HoTen_TieuDe. Nộp đúng hạn!</p>
            </form>
        </div>
        <?php
    }
    else{
    ?>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">📤 Nộp Bài Tập Thực Hành</h5>
            <?php 
            $bd=strtotime($r['batdaunop']);
            $kt=strtotime($r['ketthucnop']);
            $ht=strtotime("now");
            if($ht<$bd || $ht>$kt){
                $status = $ht < $bd ? "Chưa đến hạn nộp" : "Hết hạn nộp";
                ?>
                <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; font-size: 14px;">
                    ⚠️ <?php echo $status; ?>. Không thể nộp bài.
                </p>
            <?php
            }
            else{
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tiêu Đề</label>
                    <input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                
                <div class="form-group-custom">
                    <label>📤 Chọn File</label>
                    <input type="file" name="f" required="required" />
                </div>
                
                <button type="submit" name="nopth" class="btn-submit">✅ Nộp Bài</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Lưu ý: Tên file nộp theo định dạng MSSV_HoTen_TieuDe. Nộp đúng hạn!</p>
            </form>
            <?php
            }
            ?>
    <?php
    }
    ?>
</div>

    
    <?php
}
elseif(isset($_REQUEST['nopbaiktth'])){
	$id=$_REQUEST['id'];
$sql="select * from baitapthuchanh where id_btth='$id'";
$qr=mysql_query($sql);
$q=mysql_fetch_assoc($qr);
	?>
<div class="content-section">
    <h4>📝 Nộp Kiểm Tra Thực Hành</h4>
    <?php
    $sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
    $qr=mysql_query($sql);
    $s=mysql_fetch_assoc($qr);
    if(mysql_num_rows($qr)==1){
    }
    else{
        ?>
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #667eea; margin-top: 0;">📄 <?php echo $q['tieude'] ?></h5>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                <strong>⏱️ Hạn Nộp:</strong> <?php 
                $cD = $q['batdaunop'];
                $bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?> 
                <strong>đến</strong> 
                <?php $cS = $q['ketthucnop'];
                $kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?>
            </p>
        </div>
        <?php
    }
    ?>
    
    <?php
    $sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
    $qr=mysql_query($sql);
    $s=mysql_fetch_assoc($qr);
    if(mysql_num_rows($qr)==1){
        ?>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">✏️ Sửa Bài Kiểm Tra Đã Nộp</h5>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tiêu Đề</label>
                    <input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                
                <div class="form-group-custom">
                    <label>📎 File Đã Nộp</label>
                    <input type="text" name="f1" value="<?php echo $s['filenop']  ?>" disabled="disabled" style="background: #f0f0f0; cursor: not-allowed;" />
                </div>
                
                <?php 
                $bd=strtotime($q['batdaunop']);
                $kt=strtotime($q['ketthucnop']);
                $ht=strtotime("now");
                if($ht<$bd || $ht>$kt){
                    ?>
                    <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; margin: 15px 0; font-size: 14px;">
                        ⚠️ Hết hạn nộp bài. Không thể sửa lại được.
                    </p>
                    <?php
                }
                else{
                ?>
                <div class="form-group-custom">
                    <label>📤 File Mới</label>
                    <input type="file" name="f" required="required" />
                </div>
                <button type="submit" name="suabktth" class="btn-submit">💾 Sửa Bài</button>
                <?php } ?>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Lưu ý: Tên file nộp theo định dạng MSSV_HoTen_TieuDe. Nộp đúng hạn!</p>
            </form>
        </div>
        <?php
    }
    else{
    ?>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">📤 Nộp Kiểm Tra Thực Hành</h5>
            <?php 
            $bd=strtotime($q['batdaunop']);
            $kt=strtotime($q['ketthucnop']);
            $ht=strtotime("now");
            if($ht<$bd || $ht>$kt){
                $status = $ht < $bd ? "Chưa đến hạn nộp" : "Hết hạn nộp";
                ?>
                <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; font-size: 14px;">
                    ⚠️ <?php echo $status; ?>. Không thể nộp bài.
                </p>
            <?php
            }
            else{
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tiêu Đề</label>
                    <input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                
                <div class="form-group-custom">
                    <label>📤 Chọn File</label>
                    <input type="file" name="f" required="required" />
                </div>
                
                <button type="submit" name="nopktth" class="btn-submit">✅ Nộp Bài</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Lưu ý: Tên file nộp theo định dạng MSSV_HoTen_TieuDe. Nộp đúng hạn!</p>
            </form>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
</div>

<?php
// Fix: định nghĩa $is nếu chưa có
if(!isset($is) && isset($_REQUEST['is'])){
    $is = $_REQUEST['is'];
}

// exit;
if(isset($_REQUEST['nopbai'])){
    // header('/');
    // var_dump('ddd');
$id=$_REQUEST['id'];
$sql="select * from baitaplythuyet where id_btlt='$id'";
$qr=mysql_query($sql);
$x=mysql_fetch_assoc($qr);
}
?>

<div class="content-section">
    <h4>📝 Nộp Bài Tập Lý Thuyết</h4>
    <?php
    $sql="select * from filenopbtlt where id_sinhvien='$is' and id_btlt='$id'";
    $qr=mysql_query($sql);
    $hasSubmission = mysql_num_rows($qr) > 0;
    if($hasSubmission){
        $s=mysql_fetch_assoc($qr);
    }
    if($hasSubmission){
        ?>
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">✏️ Sửa Bài Tập Đã Nộp</h5>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tiêu Đề</label>
                    <input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                
                <div class="form-group-custom">
                    <label>📎 File Đã Nộp</label>
                    <div style="padding: 10px 12px; background: #f5f7fa; border-radius: 6px; display: flex; align-items: center; gap: 10px;">
                        <a href="taixuong.php?fu=<?php echo $s['filenop'];?>" style="display: flex; align-items: center; gap: 8px; color: #667eea; text-decoration: none; font-weight: 600; flex: 1;">
                            <img src="https://tse2.mm.bing.net/th?id=OIP.8Ck3Lp06jASLSybjpchJJgHaHa&pid=Api&P=0&h=180" style="height: 20px; width: auto;" />
                            <?php echo $s['filenop']; ?>
                        </a>
                    </div>
                </div>
                
                <?php 
                $bd=strtotime($x['batdaunop']);
                $kt=strtotime($x['ketthucnop']);
                $ht=strtotime("now");
                if($ht<$bd || $ht>$kt){
                    ?>
                    <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; margin: 15px 0; font-size: 14px;">
                        ⚠️ Hết hạn nộp bài. Không thể sửa lại được.
                    </p>
                    <?php
                }
                else{
                ?>
                <div class="form-group-custom">
                    <label>📤 File Mới</label>
                    <input type="file" name="f" required="required" />
                </div>
                <button type="submit" name="suab" class="btn-submit">💾 Sửa Bài</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Lưu ý: Tên file nộp theo định dạng MSSV_HoTen_TieuDe. Nộp đúng hạn!</p>
                <?php } ?>
            </form>
        </div>
        <?php
    }
    else{
        ?>
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
            <h5 style="color: #667eea; margin-top: 0;">📄 File Bài Tập</h5>
            <p style="margin: 10px 0;">
                <a href="taixuong.php?fu=<?php echo $x['filebt'];?>" style="display: inline-flex; align-items: center; gap: 8px; color: #667eea; text-decoration: none; font-weight: 600;">
                    <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" style="height: 20px; width: auto;" />
                    <?php echo $x['tieude']; ?>
                </a>
            </p>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                <strong>⏱️ Hạn Nộp:</strong> <?php 
                $cD = $x['batdaunop'];
                $bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?> 
                <strong>đến</strong> 
                <?php $cS = $x['ketthucnop'];
                $kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?>
            </p>
            <p style="font-size: 13px; font-style: italic; color: #999;">Bấm vào file để tải xuống</p>
        </div>
    
        <div class="upload-form">
            <h5 style="color: #667eea; margin-top: 0;">📤 Nộp Bài Tập Lần Đầu</h5>
            <?php 
            $bd=strtotime($x['batdaunop']);
            $kt=strtotime($x['ketthucnop']);
            $ht=strtotime("now");
            if($ht<$bd || $ht>$kt){
                $status = $ht < $bd ? "Chưa đến hạn nộp" : "Hết hạn nộp";
                ?>
                <p style="padding: 12px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px; color: #856404; font-size: 14px;">
                    ⚠️ <?php echo $status; ?>. Không thể nộp bài.
                </p>
            <?php
            }
            else{
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group-custom">
                    <label>📝 Tiêu Đề</label>
                    <input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" required="required" />
                </div>
                
                <div class="form-group-custom">
                    <label>📤 Chọn File</label>
                    <input type="file" name="f" required="required" />
                </div>
                
                <button type="submit" name="nop" class="btn-submit">✅ Nộp Bài</button>
                <p style="font-size: 12px; font-style: italic; color: #999; margin-top: 10px;">Lưu ý: Tên file nộp theo định dạng MSSV_HoTen_TieuDe. Nộp đúng hạn!</p>
            </form>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
</div>
<?php
}
else{
	$ihp=$_REQUEST['ihp'];
	$il=$_REQUEST['il'];
	$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
	join monlop m on m.id_hocphan=hp.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join giangday g on m.id=g.id join giangvien gv on gv.id_giangvien=g.id_giangvien
	where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il'";
	$tm=mysql_query($sql);
	$c=mysql_fetch_assoc($tm);
	?>
<div class="content-section">
    <h4>📖 Phần Lý Thuyết</h4>
    
    <div style="background: linear-gradient(135deg, #f5f7fa 0%, #f9f9ff 100%); border-left: 4px solid #667eea; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h5 style="color: #667eea; margin-top: 0;">ℹ️ Thông Tin Môn Học</h5>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
            <div>
                <label style="color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">📚 Học Phần</label>
                <p style="color: #333; margin: 5px 0 0 0; font-size: 15px; font-weight: 500;"><?php echo $c['tenhocphan']; ?></p>
            </div>
            <div>
                <label style="color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">🔖 Mã Học Phần</label>
                <p style="color: #333; margin: 5px 0 0 0; font-size: 15px; font-weight: 500;"><?php echo $c['mahocphan']; ?></p>
            </div>
            <div>
                <label style="color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">👥 Lớp Học Phần</label>
                <p style="color: #333; margin: 5px 0 0 0; font-size: 15px; font-weight: 500;"><?php echo $c['tenlophocphan']; ?></p>
            </div>
            <div style="grid-column: 1 / -1;">
                <label style="color: #999; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">👨‍🏫 Giảng Viên Lý Thuyết</label>
                <p style="color: #333; margin: 5px 0 0 0; font-size: 15px; font-weight: 500;">
                    <?php $v= $c['id_giangvien'];
                    $sql="select * from giangvien where id_giangvien='$v'";
  $ttgv=mysql_query($sql);
  $gv=mysql_fetch_assoc($ttgv);
  echo $gv['hotengiangvien']; ?>
  </p>
  <p style="font-size:18px;">- Ngày Học LT: <?php echo "Thứ&nbsp;".$c['thuhocLT']; ?>&nbsp;&nbsp;| Tiết  Học: <?php echo $c['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $c['tietketthucLT'] ?>&nbsp;&nbsp;| Phòng Học LT: <?php echo $c['phonghocLT'] ?></p>
  
  <?php /* Code ở đây */ ?>
<p></p>


 <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig=$c['id_giangvien'];
  $sql="select * from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and gd.id_giangvien='$ig'
  and loaitailieu='GT' ";
  $qr=mysql_query($sql);
  ?>
  <h5 style="margin-top: 20px; color: #667eea; border-bottom: 3px solid #667eea; padding-bottom: 10px;">📚 Tài Liệu Tham Khảo</h5>
  <ul class="material-list">
  <?php
  while($a=mysql_fetch_assoc($qr)){
  ?>
    <li class="material-item">
        <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" alt="Document" />
        <a href="taixuong.php?fu=<?php echo $a['filetailieu'];?>"><?php echo $a['tieude']; ?></a>
    </li>
  <?php
  }
  ?>
  </ul>

  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig=$c['id_giangvien'];
  $sql="select * from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and gd.id_giangvien='$ig'
  and loaitailieu='Slide' ";
  $qr=mysql_query($sql);
  ?>
  <h5 style="margin-top: 30px; color: #667eea; border-bottom: 3px solid #667eea; padding-bottom: 10px;">🎬 Slide Môn Học</h5>
  <ul class="material-list">
  <?php
  while($a=mysql_fetch_assoc($qr)){
  ?>
    <li class="material-item">
        <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" alt="Document" />
        <a href="taixuong.php?fu=<?php echo $a['filetailieu'];?>"><?php echo $a['tieude'];
		?></a>
        </li>
    <?php
  }
?>
<p></p>


<p></p>

   <strong style="color:#F63;font-size: 25px; font-weight:400;" id="bt">Bài Tập</strong>
  <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig=$c['id_giangvien'];
  $sql="select * from baitaplythuyet lt join giangday gd on lt.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and gd.id_giangvien='$ig'";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp'] ?>&il=<?php echo $_REQUEST['il'] ?>&id=<?php echo $a['id_btlt'] ?>&nopbai&ctmh&kh#bt">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a>
        <?php 
        $i=$a['id_btlt'];
        $is=$_REQUEST['is'];
        $sql1="select * from baitaplythuyet lt join filenopbtlt f on lt.id_btlt=f.id_btlt
        where f.id_btlt='$i' and f.id_sinhvien='$is'";
        $qr1=mysql_query($sql1);
        if(mysql_num_rows($qr1)==1){
            ?>
            <span style="color: #4caf50; font-weight: 600;"> ✓ Đã nộp</span>
            <?php
        }
        ?>
    </li>
    <?php
  }
  ?>
  </ul>

  <?php
  if($ttm['loaihp']=='LT & TH'){
  ?>

  <h5 style="margin-top: 30px; color: #667eea; border-bottom: 3px solid #667eea; padding-bottom: 10px;">🧪 Phần Thực Hành</h5>
  <p style="font-size: 14px; color: #999; margin: 10px 0;">
    Giảng Viên Thực Hành: 
    <?php 
    $is=$_REQUEST['is'];
    $ihp=$_REQUEST['ihp'];
    $sql="select * from hoctap h join monlop m on h.id=m.id
    where h.id_sinhvien='$is' and md5(m.id_hocphan)='$ihp'";
    $qr=mysql_query($sql);
$e=mysql_fetch_assoc($qr);
$n=$e['id_giangvienTH'];
$sql1="select *from giangvien where id_giangvien='$n'";
$qr1=mysql_query($sql1);
$f=mysql_fetch_assoc($qr1);
echo $f['hotengiangvien']?> )</h5>
<p></p>
  <strong style="color:#F63;font-size: 25px; font-weight:400;">Chung</strong>
<p></p>
  <p style="font-size:20px;"><strong>* Thông Tin Môn Học:</strong>
  <br />
   <p style="font-size:18px;">Ngày Học TH: <?php echo "Thứ&nbsp;".$c['thuhocTH']; ?>&nbsp;&nbsp;| Tiết  Học: <?php echo $c['tietbatdauTH'] ?>&nbsp;-&nbsp;<?php echo $c['tietketthucTH'] ?>&nbsp;&nbsp;| Phòng Học TH: <?php echo $c['phonghocTH'] ?></p>
  <?php /* Code ở đây */ ?>
</details><p></p>
    <strong style="color:#F63;font-size: 25px; font-weight:400;">Tài Liệu Thực Hành</strong>
  <?php /* Code ở đây */ ?>
  <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig1=$c['id_giangvienTH1'];
  $ig2=$c['id_giangvienTH2'];
  $sql="select * from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and ( gd.id_giangvienTH1='$ig1' or 
  gd.id_giangvienTH2='$ig2') and loaitailieu='BTTH' ";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="taixuong.php?fu=<?php echo $a['filetailieu'];?>">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a></p>
    <?php
  }
?>
<p></p>


<p></p>

<p></p>

   <strong style="color:#F63;font-size: 25px; font-weight:400;" id="btth">Nộp Bài Tập Hàng Tuần</strong>
  <?php /* Code ở đây */ ?>
  <p></p>
    <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig1=$c['id_giangvienTH1'];
  $ig2=$c['id_giangvienTH2'];
  $sql="select * from baitapthuchanh th join giangday gd on th.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and th.loaibai='' and ( gd.id_giangvienTH1='$ig1' 
  or gd.id_giangvienTH2='$ig2')";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp'] ?>&il=<?php echo $_REQUEST['il'] ?>&id=<?php echo $a['id_btth'] ?>&nopbaith&ctmh&kh#btth">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="20px" width="20px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a>&nbsp;&nbsp;<?php 
		$i=$a['id_btth'];
		$is=$_REQUEST['is'];
		$sql1="select * from baitapthuchanh th join filenopbtth f on th.id_btth=f.id_btth
		where f.id_btth='$i' and f.id_sinhvien='$is'";
		$qr1=mysql_query($sql1);
		if(mysql_num_rows($qr1)==1){
			?>
            <img src="https://www.kindpng.com/picc/m/139-1398934_green-tick-tick-free-images-on-pixabay-clipart.png" height="20px" width="20px" />
            <?php
		}
		else{
		}
		
		
		 ?></p>
    <?php
  }
?>

<p></p>
    <strong style="color:#F63;font-size: 25px; font-weight:400;" id="btthkt">Bài Tập TH Kiểm Tra</strong>
  <?php /* Code ở đây */ } ?>
  <p></p>
    <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig1=$c['id_giangvienTH1'];
  $ig2=$c['id_giangvienTH2'];
  $sql="select * from baitapthuchanh th join giangday gd on th.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and th.loaibai='KTTH' and ( 
  gd.id_giangvienTH1='$ig1' or gd.id_giangvienTH2='$ig2')";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&is=<?php echo $_REQUEST['is'] ?>&ihp=<?php echo $_REQUEST['ihp'] ?>&il=<?php echo $_REQUEST['il'] ?>&id=<?php echo $a['id_btth'] ?>&nopbaiktth&ctmh&kh">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="20px" width="20px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a>&nbsp;&nbsp;<?php 
		$i=$a['id_btth'];
		$is=$_REQUEST['is'];
		$sql1="select * from baitapthuchanh th join filenopbtth f on th.id_btth=f.id_btth
		where f.id_btth='$i' and f.id_sinhvien='$is'";
		$qr1=mysql_query($sql1);
		if(mysql_num_rows($qr1)==1){
			?>
            <img src="https://www.kindpng.com/picc/m/139-1398934_green-tick-tick-free-images-on-pixabay-clipart.png" height="20px" width="20px" />
            <?php
		}
		else{
		}
		 ?>
    </li>
    <?php
  }
  ?>
  </ul>

  <?php
  }
  }
  ?>
</div>
</div>

<footer class="footer">
    <div class="container-custom">
        <div class="footer-grid">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" alt="Logo" />
                    <h5>Chào Mừng</h5>
                </div>
                <p>Chào Mừng Các Bạn Đến Với Hệ Thống Quản Lý Học Vụ. Nơi Đây Giúp Bạn Theo Dõi Quá Trình Học Tập Của Mình.</p>
            </div>
            <div class="footer-section">
                <h5>Liên Kết Nhanh</h5>
                <ul>
                    <li><a href="homeSV.php?bm=<?php echo $_REQUEST['bm'] ?>">📚 Trang Chủ</a></li>
                    <li><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>">👤 Thông Tin Cá Nhân</a></li>
                    <li><a href="dxuat.php?xuat">🚪 Đăng Xuất</a></li>
                </ul>
            </div>
            <div class="footer-section footer-contact">
                <h5>📞 Liên Hệ Chúng Tôi</h5>
                <p><strong>Trung Tâm Quản Trị Hệ Thống</strong></p>
                <p>📱 Điện Thoại: 0143.234.563</p>
                <p>📧 Email: csm@gmail.com</p>
                <p>📍 Địa Chỉ: Trường Đại Học</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Hệ Thống Quản Lý Học Vụ. Tất cả các quyền được bảo vệ.</p>
        </div>
    </div>
</footer>
</div>
</body>
</html>