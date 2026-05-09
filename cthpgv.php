<?php
session_start();

// phpinfo();
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
// Sửa Điểm
if(isset($_POST['editd'])){
	if(isset($_FILES['f'])) {
		class DocxConversion {
    private $filename;

    function __construct($filePath) {
	$file = $_FILES['f']['tmp_name'];
    $path = "file/".$_FILES['f']['name'];


	move_uploaded_file($file,$path);
        $this->filename = "file/".$_FILES['f']['name'];
    }
    function xlsx_to_text() {
        $xml_filename = "xl/sharedStrings.xml"; // content file name
        $zip_handle = new ZipArchive;
        $output_text = "";

        if (true === $zip_handle->open($this->filename)) {
            if (($xml_index = $zip_handle->locateName($xml_filename)) !== false) {
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                $xml_handle = new DOMDocument;
                $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text = strip_tags($xml_handle->saveXML());
            } else {
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
            if ($file_ext == "xlsx") {
                return $this->xlsx_to_text();
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
		echo "<script> alert('File chứa mã thực thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["f"]["size"];
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 10*1024*1024) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',
                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',
                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
				'xls1' => 'application/excel',
				'xls2' => 'application/x-excel',
				'xls3' => 'application/x-msexcel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'docx' => 'application/msword',
                'xlsx' => 'application/vnd.ms-excel',
                'pptx' => 'application/vnd.ms-powerpoint',
                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    // 2. Kiểm tra tên tập tin được phép
	/* if($_FILES['f']['type'] != $mimes['xlsx']||$_FILES['f']['type'] != $mimes['xlsx1']||$_FILES['f']['type'] != $mimes['xlsx2']||$_FILES['f']['type'] != $mimes['xlsx3']){
		echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}  */
    // 3. Kiểm tra xem tệp tin đã tồn tại hay chưa
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
        // 5. Tạo tên tệp tin mới để tránh ghi đè
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;

        // 6. Di chuyển tệp tin từ thư mục tạm lên thư mục đích
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
//Nhúng file PHPExcel
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
//Đường dẫn file
$file = 'file/'.$f;
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);


//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: A là 0, B là 1, C là 2,D là 3
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
$highestRow = $sheet->getHighestRow(); 

// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
$highestColumn = $sheet->getHighestColumn();

// Khai báo mảng $rowData chứa dữ liệu

//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi($ketnoi);
if($kn){
$cm= strtoupper(trim($sheet->getCellByColumnAndRow(0,1)->getValue()));
$gik= strtoupper(trim($sheet->getCellByColumnAndRow(6,1)->getValue()));
$cuk= strtoupper(trim($sheet->getCellByColumnAndRow(10,1)->getValue()));

if($cm!="MSSV"|| $gik!="GK" || $cuk!="CK"){
    
	echo "<script>alert('Lỗi: File Excel Không Đúng Định Dạng!\\n\\nĐộc được:\\nCột A: [$cm] | Cột G: [$gik] | Cột K: [$cuk]\\n\\nCần phải là:\\nCột A: MSSV | Cột G: GK | Cột K: CK\\n\\nLưu ý: Cột B, C nên có dữ liệu (không để trống)!')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
    $m= $sheet->getCellByColumnAndRow(0,$row)->getValue();
	$sql="select * from sinhvien where masosinhvien='$m'";
	$qr=mysql_query($sql);
	$d=mysql_fetch_assoc($qr);
	$id=$d['id_sinhvien'];
	$tk1= $sheet->getCellByColumnAndRow(3,$row)->getValue();
	$tk2= $sheet->getCellByColumnAndRow(4,$row)->getValue();
	$tk3= $sheet->getCellByColumnAndRow(5,$row)->getValue();
	$gk= $sheet->getCellByColumnAndRow(6,$row)->getValue();
	$th1= $sheet->getCellByColumnAndRow(7,$row)->getValue();
	$th2= $sheet->getCellByColumnAndRow(8,$row)->getValue();
	$th3= $sheet->getCellByColumnAndRow(9,$row)->getValue();
	$ck= $sheet->getCellByColumnAndRow(10,$row)->getValue();
	$ihp=$_REQUEST['ihp'];
	$sql="select * from hocphan where md5(id_hocphan)='$ihp'";
	$qr=mysql_query($sql);
	$i=mysql_fetch_assoc($qr);
	$ih=$i['id_hocphan'];
	$ig=$_REQUEST['ig'];
	$il=$_REQUEST['il'];
	$f=$_FILES['f']['name'];
	//Kiểm tra ràng buộc về điểm
	if(($tk1>10||$tk1<0)||($tk2>10||$tk2<0)||($tk3>10||$tk3<0)||($gk>10||$gk<0)||($th1>10||$th1<0)||($th2>10||$th2<0)||
	($th3>10||$th3<0)||($ck>10||$ck<0)){
		echo "<script>alert('File nhập điểm lên hệ thống ở dòng dữ liệu điểm thứ ".$row." chưa chính xác !')</script>";
	}
	else{
	$ktid="select * from diem where id_sinhvien='$id'";
	$qr=mysql_query($ktid);
	$i=mysql_fetch_assoc($qr);
	$is=$i['id_sinhvien'];
	$ip=$i['id_hocphan'];
	if($is==$id){
     $sql="update diem set TK1='$tk1' ,TK2='$tk2', TK3='$tk3' , GK='$gk' , TH1='$th1',
	 TH2='$th2' , TH3='$th3', CK='$ck', id_sinhvien='$id', id_hocphan='$ih' , id_lophocphan='$il'
	 where id_sinhvien='$id' and md5(id_hocphan)='$ihp' and id_lophocphan='$il' ";
	 $qr=mysql_query($sql);
	}
	else{
		$sql="insert into diem(TK1,TK2,TK3,GK,TH1,TH2,TH3,CK,id_sinhvien,id_hocphan,id_lophocphan) values('$tk1','$tk2','$tk3','$gk',
	 	'$th1','$th2','$th3','$ck','$id','$ih','$il')";
	    $qr=mysql_query($sql);
	  
		
	}
	}
	
}
$si="select * from filediem where md5(id_hocphan)='$ihp' and id_lophocphan='$il' and id_giangvien='$ig'";
	 $qi=mysql_query($si);
	 if(mysql_num_rows($qi)==1){
$sq3="update filediem set filediem='$f' where md5(id_hocphan)='$ihp' and id_lophocphan='$il' and id_giangvien='$ig'";
$qr3=mysql_query($sq3);
	 }
	 else{
$sq2="insert into filediem(filediem,ngaydang,id_lophocphan,id_hocphan,id_giangvien) values ('$f',now(),'$il','$ih','$ig')";
$qr2=mysql_query($sq2);
	 }
	}
} 
     
	}
	}
}
	}

	
	
}
?>


<?php
// Lên Điểm

if(isset($_POST['ld'])){
	if(isset($_FILES['f'])) {
		class DocxConversion {
    private $filename;

    function __construct($filePath) {
	$file = $_FILES['f']['tmp_name'];
    $path = "file/".$_FILES['f']['name'];
	move_uploaded_file($file,$path);
        $this->filename = "file/".$_FILES['f']['name'];
    }
    function xlsx_to_text() {
        $xml_filename = "xl/sharedStrings.xml"; // content file name
        $zip_handle = new ZipArchive;
        $output_text = "";

        if (true === $zip_handle->open($this->filename)) {
            if (($xml_index = $zip_handle->locateName($xml_filename)) !== false) {
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                $xml_handle = new DOMDocument;
                $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text = strip_tags($xml_handle->saveXML());
            } else {
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
            if ($file_ext == "xlsx") {
                return $this->xlsx_to_text();
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
		echo "<script> alert('File chứa mã thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
    $target_directory = "file/";
    $file_name = $_FILES["f"]["name"];
    $target_file = $target_directory . basename($file_name);
    $upload_ok = 1;
    $file_size = $_FILES["f"]["size"];
    // 1. Kiểm tra kích thước tệp tin
    if ($file_size > 10*1024*1024) { // Giới hạn kích thước tệp tin (ví dụ: 5 MB)
        echo "<script>alert('Kích Thước Tệp Tin Quá Lớn')</script>";
    }
	$mimes = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',
                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',
                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
				'xls1' => 'application/excel',
				'xls2' => 'application/x-excel',
				'xls3' => 'application/x-msexcel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'docx' => 'application/msword',
                'xlsx' => 'application/vnd.ms-excel',
                'pptx' => 'application/vnd.ms-powerpoint',
                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
    // 2. Kiểm tra tên tập tin được phép
	/* if($_FILES['f']['type'] != $mimes['xlsx']||$_FILES['f']['type'] != $mimes['xlsx1']||$_FILES['f']['type'] != $mimes['xlsx2']||$_FILES['f']['type'] != $mimes['xlsx3']){
		echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}  */
    // 3. Kiểm tra xem tệp tin đã tồn tại hay chưa
    if (file_exists($_FILES['f']==$file_name)) {
       echo "<script>alert('Tệp Tin Đã Tồn Tại')</script>";
    }
    else {
        // 5. Tạo tên tệp tin mới để tránh ghi đè
		$file_name= $_FILES['f']['name'];
        $target_file = $target_directory . $file_name;

        // 6. Di chuyển tệp tin từ thư mục tạm lên thư mục đích
	if($_FILES['f']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $_FILES['f']['type'] != $mimes['xls'] && $_FILES['f']['type'] != $mimes['xlsx'] ){
		 echo "<script>alert('Tệp Tin Không Được Chấp Nhận')</script>";
	}
	else{
ini_set('display_errors','off');
//Nhúng file PHPExcel
require_once 'PHPExcel/Classes/PHPExcel.php';
$f=$_FILES['f']['name'];
//Đường dẫn file
$file = 'file/'.$f;
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);


//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: A là 0, B là 1, C là 2,D là 3
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
$highestRow = $sheet->getHighestRow(); 

// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
$highestColumn = $sheet->getHighestColumn();

// Khai báo mảng $rowData chứa dữ liệu

//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
include_once("Model/mKetNoiADHT.php");
$p= new ketnoiAD();
$kn= $p->ketnoi($ketnoi);
var_dump($kn);exit;
if($kn){
$cm= trim($sheet->getCellByColumnAndRow(0,1)->getValue());
$tk1h= trim($sheet->getCellByColumnAndRow(3,1)->getValue());
$tk2h= trim($sheet->getCellByColumnAndRow(4,1)->getValue());
$tk3h= trim($sheet->getCellByColumnAndRow(5,1)->getValue());
$gik= trim($sheet->getCellByColumnAndRow(6,1)->getValue());
$th1h= trim($sheet->getCellByColumnAndRow(7,1)->getValue());
$th2h= trim($sheet->getCellByColumnAndRow(8,1)->getValue());
$th3h= trim($sheet->getCellByColumnAndRow(9,1)->getValue());
$cuk= trim($sheet->getCellByColumnAndRow(10,1)->getValue());




if($cm!="MSSV"|| $gik!="GK" || $cuk!="CK"){
  
	echo "<script>alert('Lỗi: File Excel Tải Lên Để Cập Nhật Điểm Không Đúng!\\n\\nĐộc được:\\nCột A: [$cm]\\nCột G: [$gik]\\nCột K: [$cuk]\\n\\nCần phải là:\\nCột A: MSSV\\nCột D: TK1\\nCột E: TK2\\nCột F: TK3\\nCột G: GK\\nCột H: TH1\\nCột I: TH2\\nCột J: TH3\\nCột K: CK')</script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
    $m= $sheet->getCellByColumnAndRow(0,$row)->getValue();
	$sql="select * from sinhvien where masosinhvien='$m'";
	$qr=mysql_query($sql);
	$d=mysql_fetch_assoc($qr);
	$id=$d['id_sinhvien'];
	$tk1= $sheet->getCellByColumnAndRow(3,$row)->getValue();
	$tk2= $sheet->getCellByColumnAndRow(4,$row)->getValue();
	$tk3= $sheet->getCellByColumnAndRow(5,$row)->getValue();
	$gk= $sheet->getCellByColumnAndRow(6,$row)->getValue();
	$th1= $sheet->getCellByColumnAndRow(7,$row)->getValue();
	$th2= $sheet->getCellByColumnAndRow(8,$row)->getValue();
	$th3= $sheet->getCellByColumnAndRow(9,$row)->getValue();
	$ck= $sheet->getCellByColumnAndRow(10,$row)->getValue();
	$ihp=$_REQUEST['ihp'];
	$sql="select * from hocphan where md5(id_hocphan)='$ihp'";
	$qr=mysql_query($sql);
	$i=mysql_fetch_assoc($qr);
	$ih=$i['id_hocphan'];
	$ig=$_REQUEST['ig'];
	$il=$_REQUEST['il'];
	$f=$_FILES['f']['name'];



	//Kiểm tra ràng buộc về điểm
	if(($tk1>10||$tk1<0)||($tk2>10||$tk2<0)||($tk3>10||$tk3<0)||($gk>10||$gk<0)||($th1>10||$th1<0)||($th2>10||$th2<0)||
	($th3>10||$th3<0)||($ck>10||$ck<0)){
		echo "<script>alert('File nhập điểm lên hệ thống ở dòng dữ liệu điểm thứ ".$row." chưa chính xác !')</script>";
	}
	else{
	// Kiểm tra có điểm chưa
     $s="select * from diem where md5(id_hocphan)='$ihp' and id_lophocphan='$il' and id_sinhvien='$id'";
	 $q=mysql_query($s);
	 if(mysql_num_rows($q)==1){
	 }
	 else{
     $sql="insert into diem(TK1,TK2,TK3,GK,TH1,TH2,TH3,CK,id_sinhvien,id_hocphan,id_lophocphan) values('$tk1','$tk2','$tk3','$gk',
	 '$th1','$th2','$th3','$ck','$id','$ih','$il')";
	 $qr=mysql_query($sql);
	 }
	}
	
}
$si="select * from filediem where md5(id_hocphan)='$ihp' and id_lophocphan='$il' and id_giangvien='$ig'";
	 $qi=mysql_query($si);
	 if(mysql_num_rows($qi)==1){
	 }
	 else{
$sq2="insert into filediem(filediem,ngaydang,id_lophocphan,id_hocphan,id_giangvien) values ('$f',now(),'$il','$ih','$ig')";
$qr2=mysql_query($sq2);
	 }
	}
} 

        } 
            
        
	}
	}
	}
	
}
?>
   
   <?php
if(isset($_REQUEST['ctmh'])){
	$ig=$_REQUEST['ig'];
	$il=$_REQUEST['il'];
	$ihp=$_REQUEST['ihp'];
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	$kt="select * from thongketruycap where mahocphan='$ihp' and id_lophocphan='$il' and id_giangvien='$ig'";
	$k=mysql_query($kt);
	if(mysql_num_rows($k)==1){
	$sql="update thongketruycap set ngaytruycap=now() where mahocphan='$ihp' and id_lophocphan='$il' and id_giangvien='$ig'";
	$qr=mysql_query($sql);
	}
	else{
	$sql="insert into thongketruycap(ngaytruycap, mahocphan, id_lophocphan, id_giangvien)
	values(now(), '$ihp', '$il', '$ig')";
	$qr=mysql_query($sql);
	}
}
}
?>
<?php
/* Sửa tài liệu tham khảo */
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_POST['s'])){
	 //file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định Dạng File Không Được Chấp Nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
	$zipFilePath = 'file/'.$_FILES['f']['name'];
    
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System(')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
            } else {
                // File an toàn, lưu vào database
                $id=$_REQUEST['id'];
                $a=$_POST['a'];
                $b=$_POST['b'];
                $f=$_FILES['f']['name'];
                $tl=$f;
                if($tl==null){
                    $tl=$b;
                }
                $target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
                $sql="update tltk set tieude='$a', filetailieu='$tl' where id_tltk='$id'";
                $qr=mysql_query($sql);
                echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    // if(!$filename || !file_exists($filename)){
    //     echo "File không tồn tại.";
    //     return;
    // }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System(')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script>alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($tl==null){
		 $tl=$b;
	 }
	  $target_directory = 'file/';
     $target_file = $target_directory.basename($f);
     move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	 $sql="update tltk set tieude='$a', filetailieu='$tl' where id_tltk='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
        $this->filename = $_FILES['f']['tmp_name'];
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
if(strpos($content,'Exec(')!=false||strpos($content,'System(')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script>alert('File .pptx chứa mã thực thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($tl==null){
		 $tl=$b;
	 }
	  $target_directory = 'file/';
     $target_file = $target_directory.basename($f);
     move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	 $sql="update tltk set tieude='$a', filetailieu='$tl' where id_tltk='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
	}
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System(')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
        echo "<script>alert('File .txt / .php chứa mã thực thi không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($tl==null){
		 $tl=$b;
	 }
	  $target_directory = 'file/';
     $target_file = $target_directory.basename($f);
     move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	 $sql="update tltk set tieude='$a', filetailieu='$tl' where id_tltk='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	 /*
	 $id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($tl==null){
		 $tl=$b;
	 }
	 $target_directory = 'file/';
     $target_file = $target_directory.basename($f);
     move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	 $sql="update tltk set tieude='$a', filetailieu='$tl' where id_tltk='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
	 */
 }
}
?>
<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_REQUEST['xoatl'])){
	 $id=$_REQUEST['id'];
	 $sql="delete from tltk where id_tltk='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
 }
}
?>
<?php /* Sửa Bài Tập */ ?>
<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_POST['sb'])){
	 $bd=$_POST['bd'];
	 $f=strtotime($bd);
	 $kt=$_POST['kt'];
	 $w=strtotime($kt);
	 //file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];

if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
 if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
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
                if (stripos($fileContent, 'exec(') !== false|| stripos($fileContent, 'system(')||stripos($fileContent, 'eval(')) {
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
               $id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($f==null){
		 $tl=$b;
	 }
	 $sql="update baitaplythuyet set tieude='$a', filebt='$tl', batdaunop='$bd', ketthucnop='$kt' where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd'");
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

    // if(!$filename || !file_exists($filename)){
    //     echo "File không tồn tại.";
    //     return;
    // }

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
		$id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($f==null){
		 $tl=$b;
	 }
	 $sql="update baitaplythuyet set tieude='$a', filebt='$tl', batdaunop='$bd', ketthucnop='$kt' where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd'");
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
		echo "<script>alert('File .pptx chứa mã thực thi không thể upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($f==null){
		 $tl=$b;
	 }
	 $sql="update baitaplythuyet set tieude='$a', filebt='$tl', batdaunop='$bd', ketthucnop='$kt' where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd'");
	}
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (stripos($fileContent, 'exec(') !== false|| stripos($fileContent, 'system(')||stripos($fileContent, 'eval(') !== false) {
		unlink($filePath);
        echo "<script>alert('File .txt / .php chứa mã thực thi không thể upload  !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($f==null){
		 $tl=$b;
	 }
	 $sql="update baitaplythuyet set tieude='$a', filebt='$tl', batdaunop='$bd', ketthucnop='$kt' where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd'");
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	 /*
	 if($filename = $_FILES['f']['tmp_name']!=null){
	 $filename = $_FILES['f']['tmp_name'];
	 $filetype = $_FILES['f']['type'];
	 $size= $_FILES['f']['size'];
  $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
       /* echo "<script> alert('Không thể mở tệp .zip !')</script>"; */
	   /*
    }
	if($size > 10*1024*1024){
	echo "<script>alert('Quá Lớn!')</script>";
}
elseif($filetype!="application/vnd.openxmlformats-officedocument.wordprocessingml.document"&&$filetype!="application/msword"&&
$filetype!="application/pdf"&&$filetype!="application/zip"){
	echo "<script>alert('Tập Tin Định Dạng Không Chấp Nhận')</script>";
}
  else{
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script>alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$bd=$_POST['bd'];
	 $f=strtotime($bd);
	 $kt=$_POST['kt'];
	 $w=strtotime($kt);
	 if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
	 else{
	 $id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 $target_directory = 'file/';
     $target_file = $target_directory.basename($f);
     move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	 $sql="update baitaplythuyet set tieude='$a', filebt='$tl', batdaunop='$bd', ketthucnop='$kt' where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd'");
	}
	 }
  }
	 }
	 else{
	 $bd=$_POST['bd'];
	 $f=strtotime($bd);
	 $kt=$_POST['kt'];
	 $w=strtotime($kt);
	 if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
	 else{
	 $id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $b=$_POST['b'];
	 $f=$_FILES['f']['name'];
	 $tl=$f;
	 if($tl==null){
		 $tl=$b;
	 }
	 $target_directory = 'file/';
     $target_file = $target_directory.basename($f);
     move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	 $sql="update baitaplythuyet set tieude='$a', filebt='$tl', batdaunop='$bd', ketthucnop='$kt' where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il'].
	 "&&gd#bt'");
	 }
	 }
	 */
 }
 }
?>
<?php /* Sửa BT Thực Hành */?>

<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_POST['sbth'])){
	 $id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $bd=$_POST['bd'];
	 $f=strtotime($bd);
	 $kt=$_POST['kt'];
	 $w=strtotime($kt);
	 $tl=$f;
	 if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
	 else{
	 $sql="update baitapthuchanh set tieude='$a', batdaunop='$bd', ketthucnop='$kt' where id_btth='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#btth'");
	 }
 }
}
?>

<?php /* Sửa Bài Kiểm Tra Thực Hành */?>

<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_POST['sbktth'])){
	 $id=$_REQUEST['id'];
	 $a=$_POST['a'];
	 $bd=$_POST['bd'];
	 $f=strtotime($bd);
	 $kt=$_POST['kt'];
	 $w=strtotime($kt);
	 $tl=$f;
	 if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
	 else{
	 $sql="update baitapthuchanh set tieude='$a', batdaunop='$bd', ketthucnop='$kt' where id_btth='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#btthkt'");
	 }
 }
}
?>

<?php /* Xóa Bài Tập */ ?>
<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_REQUEST['xoabt'])){
	 $id=$_REQUEST['id'];
	 $sql="delete from baitaplythuyet where id_btlt='$id'";
	 $qr=mysql_query($sql);
	 $sql1="delete from filenopbtlt where id_btlt='$id'";
	 $qr1=mysql_query($sql1);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt'");
 }
}
?>

<?php /* Xóa BT Thực Hành */ ?>

<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_REQUEST['xoanth'])){
	 $id=$_REQUEST['id'];
	 $sql="delete from baitapthuchanh where id_btth='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#btth'");
 }
}
?>

<?php /* Xóa BT Kiểm Tra Thực Hành */ ?>

<?php
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);
if($kn){
 if(isset($_REQUEST['xoanktth'])){
	 $id=$_REQUEST['id'];
	 $sql="delete from baitapthuchanh where id_btth='$id'";
	 $qr=mysql_query($sql);
	 echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#btthkt'");
 }
}
?>

<?php
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
?>
<?php /*Up file t*/ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['t'])){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script> alert('Kích thước file không được quá 10MB !')</script>";
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
                    echo "<script>alert('File .zip chứa mã thực thi không thể upload !')</script>";
                } else {
					
                    
                }
            } else {
                $td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
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
	// Upload file trước khi kiểm tra
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];
	$upload_path = 'file/'.$_FILES['f']['name'];
	move_uploaded_file($filename, $upload_path);

    // if(!$filename || !file_exists($filename)){
    //     echo "File không tồn tại.";
    //     return;
    // }

    $zip = new ZipArchive();
    if ($zip->open($upload_path) === true) {
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
		 unlink($upload_path);
	}
	else{
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
	}
}
elseif($t=='application/msword'){
	// Upload file trước khi kiểm tra
	$filename = $_FILES['f']['tmp_name'];
	$upload_path = 'file/'.$_FILES['f']['name'];
	move_uploaded_file($filename, $upload_path);
	
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
}
elseif($t=='application/pdf'){
	// Upload file trước khi kiểm tra
	$filename = $_FILES['f']['tmp_name'];
	$upload_path = 'file/'.$_FILES['f']['name'];
	move_uploaded_file($filename, $upload_path);
	
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
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
		 echo "<script>alert('File .pptx chứa mã thực thi không thể upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
	}
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt / .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	/*
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$size=$_FILES['size'];
if($size > 10*1024*1024){
	echo "Quá Lớn!";
}
else{
	$target_directory = 'file/';
    $target_file = $target_directory.basename($f);
    move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
				if($kn){
					
					$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
					
				
				}
				
}
*/
}
/* } */

?>

<?php /* Thêm Slide Bài Giảng */ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['ad'])){
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
elseif($t=='application/x-zip-compressed'){
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
                $td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='Slide' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#smh'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    // if(!$filename || !file_exists($filename)){
    //     echo "File không tồn tại.";
    //     return;
    // }

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
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='Slide' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#smh'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
        $this->filename = $_FILES['f']['tmp_name'];
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
		 echo "<script>alert('File .pptx chứa mã thực thi không thể upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='Slide' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#smh'");
	}
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$filePath = $_FILES['f']['tmp_name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt / .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='Slide' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#smh'");
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
    }
} else {
    echo "Không thể đọc file.";
}
}
	/*
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$size=$_FILES['size'];
if($size > 10*1024*1024){
	echo "Quá Lớn!";
}
else{
	$target_directory = 'file/';
    $target_file = $target_directory.basename($f);
    move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
				if($kn){
					
					$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='Slide' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#smh'");
					
				
				}
}
*/
}
/* } */

?>

<?php /* Thêm Tài Liệu Tham Khảo */ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['t'])){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
elseif($t=='application/x-zip-compressed'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);

    if (file_exists($b)) {
        $zip = new ZipArchive;

        if ($zip->open($b) === TRUE) {
            $keywordFound = false;

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                if (unlink($b)) {
                   echo "<script>alert('File .zip chứa mã thực thi không thể upload !')</script>";
                }
            } else {
                $td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select
				id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
				$qr=mysql_query($sql);
				$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
				$qr1=mysql_query($sql1);
				echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $t=='application/pdf' || $t=='application/msword'){
	$filename = $_FILES['f']['tmp_name'];

    if(!$filename || !file_exists($filename)){
        // echo "<script>alert('File không tồn tại !')</script>";
    } else {
        $td=$_POST['a'];
        $f=$_FILES['f']['name'];
        $ig=$_REQUEST['ig'];
        $ihp=$_REQUEST['ihp'];
        $il=$_POST['il'];
        $target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
        $sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
        $qr=mysql_query($sql);
        $sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
        $qr1=mysql_query($sql1);
        echo "<script>window.location.href='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'</script>";
    }
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$filePath = $_FILES['f']['tmp_name'];

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt / .php chứa mã thực thi không thể upload !')</script>";
    } else {
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
				id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
				$qr=mysql_query($sql);
				$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
				$qr1=mysql_query($sql1);
				echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
    }
} else {
    echo "Không thể đọc file.";
}
}
else{
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and id=(select 
				id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
				$qr=mysql_query($sql);
				$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='GT' where ngaydang=now() ";
				$qr1=mysql_query($sql1);
				echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tltk'");
}
}

?>

<?php /* Thêm Tài Liệu Thực Hành */ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['tlth'])){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
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
               	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='BTTH' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tlth'");
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

    // if(!$filename || !file_exists($filename)){
    //     echo "File không tồn tại.";
    //     return;
    // }

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
			$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='BTTH' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tlth'");
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
		echo "<script>alert('File .pptx chứa mã thực thi không thể upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
			$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='BTTH' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tlth'");
	}
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
       echo "<script>alert('File .txt / .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='BTTH' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tlth'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	/*
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$size=$_FILES['size'];
if($size > 10*1024*1024){
	echo "Quá Lớn!";
}
else{
	$target_directory = 'file/';
    $target_file = $target_directory.basename($f);
    move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
				if($kn){
					
					$sql="insert into tltk(id_giangday, ngaydang) select id_giangday, now() from giangday where id=(select 
					id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update tltk set tieude='$td', filetailieu='$f', loaitailieu='BTTH' where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#tlth'");
					
				
				}
}
*/
}
/* } */

?>

<?php /* Thêm Bài Tập */ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['tbt'])){
    $bd=$_POST['bd'];
	$f=strtotime($bd);
	$kt=$_POST['kt'];
	$w=strtotime($kt);
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
if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
}
elseif($t=='application/x-zip-compressed'){
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
                    echo "<script> alert('File .zip chứa mã thực thi không thể upload !')</script>";
                } else {
					
                    
                }
            } else {
                $td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
					
					$sql="insert into baitaplythuyet(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and 
					id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update baitaplythuyet set tieude='$td', filebt='$f', batdaunop='$bd', ketthucnop='$kt'  where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    // if(!$filename || !file_exists($filename)){
    //     echo "File không tồn tại.";
    //     return;
    // }

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
		echo "<script> alert('File .docx chứa mã thực thi không thể upload !')</script>";
	}
	else{
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into baitaplythuyet(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and 
	id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
	$qr=mysql_query($sql);
	$sql1="update baitaplythuyet set tieude='$td', filebt='$f', batdaunop='$bd', ketthucnop='$kt'  where ngaydang=now() ";
	$qr1=mysql_query($sql1);
	echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
        $this->filename = $_FILES['f']['tmp_name'];
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
		echo "<script> alert('File .pptx chứa mã thực thi không thể upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
	$sql="insert into baitaplythuyet(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and 
	id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
	$qr=mysql_query($sql);
	$sql1="update baitaplythuyet set tieude='$td', filebt='$f', batdaunop='$bd', ketthucnop='$kt'  where ngaydang=now() ";
	$qr1=mysql_query($sql1);
	echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt'");
	}
}
elseif($t=='application/octet-stream'||$t=='text/plain'){
	$filePath = $_FILES['f']['tmp_name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
       echo "<script> alert('File .txt / .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
	$target_directory = 'file/';
                $target_file = $target_directory.basename($f);
                move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
					
					$sql="insert into baitaplythuyet(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and 
					id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update baitaplythuyet set tieude='$td', filebt='$f', batdaunop='$bd', ketthucnop='$kt'  where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
/*
	$size=$_FILES['f']['size'];
	$type=$_FILES['f']['type'];
if($size > 10*1024*1024){
	echo "<script>alert('Quá Lớn!')</script>";
}
elseif($type!="application/vnd.openxmlformats-officedocument.wordprocessingml.document"&&$type!="application/msword"&&
$type!="application/pdf"&&$type!="application/zip"){
	echo "<script>alert('Tập Tin Định Dạng Không Chấp Nhận')</script>";
}
elseif($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
else{
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
		$target_directory = 'file/';
		$f=$_FILES['f']['name'];
    $target_file = $target_directory.basename($f);
    move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
				if($kn){
	$td=$_POST['a'];
	$f=$_FILES['f']['name'];
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
					
					$sql="insert into baitaplythuyet(id_giangday, ngaydang) select id_giangday, now() from giangday where id_giangvien='$ig' and 
					id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
					$qr=mysql_query($sql);
					$sql1="update baitaplythuyet set tieude='$td', filebt='$f', batdaunop='$bd', ketthucnop='$kt'  where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt'");
	}
				}
}
/* } */

?>

<?php /* Thêm Nộp Bài Tập Thực Hành */ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['nbtth'])){
	$td=$_POST['a'];
	$bd=$_POST['bd'];
	$f=strtotime($bd);
	$kt=$_POST['kt'];
	$w=strtotime($kt);
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
else{
	$target_directory = 'file/';
    $target_file = $target_directory.basename($f);
    move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
				if($kn){
					
					$sql="insert into baitapthuchanh(id_giangday, ngaydang) select id_giangday, now() from giangday where 
					id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or 
					id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update baitapthuchanh set tieude='$td', batdaunop='$bd', ketthucnop='$kt'  where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".
					$_REQUEST['il']."&&gd#btth'");
					
				
				}
}
}


/* } nbktth */

?>

<?php /* Thêm Nộp Bài Kiểm Tra Thực Hành */ ?>
<?php
session_start();
include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoigv);
if(isset($_POST['nbktth'])){
	$td=$_POST['a'];
	$bd=$_POST['bd'];
	$f=strtotime($bd);
	$kt=$_POST['kt'];
	$w=strtotime($kt);
	$ig=$_REQUEST['ig'];
	$ihp=$_REQUEST['ihp'];
	$il=$_POST['il'];
if($f>=$w){
		 echo "<script>alert('Chọn lại ngày giờ cho phù hợp')</script>";
	 }
else{
	$target_directory = 'file/';
    $target_file = $target_directory.basename($f);
    move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
				if($kn){
					
					$sql="insert into baitapthuchanh(id_giangday, ngaydang) select id_giangday, now() from giangday where 
					id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il') and (id_giangvienTH1='$ig' or 
					id_giangvienTH2='$ig')";
					$qr=mysql_query($sql);
					$sql1="update baitapthuchanh set tieude='$td', batdaunop='$bd', ketthucnop='$kt', loaibai='KTTH'  where ngaydang=now() ";
					$qr1=mysql_query($sql1);
					echo header("refresh:0,url='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".
					$_REQUEST['il']."&&gd#btthkt'");
					
				
				}
}
}


/* } nbktth */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Học Phần Giảng Dạy</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}
a{
    color:#333;
}
a:hover{
    color:#667eea;
}
.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
.top-bar-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.btn-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    color: white;
}
.card-modern {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}
.tab-active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
.tab-inactive {
    background: #f0f0f0;
    color: #555;
}
.footer-modern {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    color: white;
    padding: 40px 0;
}
.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
}
</style>
</head>

<body>
<div class="container mw-100 border">

<div class="row header"  id="codinh">
<!--Đây là phần banner-->
<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12 top-bar-gradient" style="height:30px; margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Gọi Điện: 0143.234.563 - ext 808 &nbsp; &nbsp; Email: csm@gmail.com</p> 
</div>
<p></p>
</div>
<div>
<p></p>
<div class="row">
<div class="col-xs-3 col-md-3 col-lg-3 col-md-3">
<a href="homeGV.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></a>
</div>
<div class="col-xs-6 col-md-6 col-lg-6 col-md-6">
</div>
<div class="col-xs-1 col-md-1 col-lg-1 col-md-1">
<a href="homeGV.php?bm=<?php echo $_REQUEST['bm']; ?>"><center><img src="https://tse4.mm.bing.net/th?id=OIP.NSlKGZ5lB61nmNw99CGwlwHaHa&pid=Api&P=0&h=180" height="50px" width="50px"  /></a><br /><p></p><a href="homeGV.php?bm=<?php echo $_REQUEST['bm']; ?>">Nhà Của Tôi</a></center>
</div>
<div class="col-xs-2 col-md-2 col-lg-2 col-md-2">
<?php
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$kn=$p->ketnoi($ketnoi);
if($kn){
	$bm=$_REQUEST['bm'];
	$sql="select *from user u join giangvien g on u.user_id=g.user_id where user_code='$bm' ";
	$asv=mysql_query($sql);
	$t=mysql_fetch_assoc($asv);
}
$anh=$t['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <center><a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="<?php echo $anh?>" height="50px" width="50px" class="rounded-circle" /></a></center>
	<?php
}
else{
	?>
	<center><a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="img/<?php echo $anh?>" height="50px" width="50px" class="rounded-circle" /></a></center>
    <?php
}
?>
<p></p>
<center><ac><a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>"><?php echo $t['hotengiangvien'] ?></a></ac></center>
</div>
</div>
</div>
<p></p>
<?php
$ihp=$_REQUEST['ihp'];
$sql="select * from hocphan where md5(id_hocphan)='$ihp' ";
$qr=mysql_query($sql);
$ttm=mysql_fetch_assoc($qr);
?>
<h5 style="color:#F63; font-size:25px;"><?php echo $ttm['tenhocphan']; ?></h5>
<br /><br />
<div class="row">
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-4">
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-6">
     <div class="row">
     <?php if(isset($_REQUEST['gd'])){ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 tab-active" style="padding:2px; height:60px; border-radius: 10px">
     <p></p>
         <center><strong><a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il']?>&&gd"><n  style="color:white;">HP Giảng Dạy</n></a></strong></center>
    </div>
     <?php } else{ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il']?>&&gd">HP Giảng Dạy</a></strong></center>
    </div>
    <?php } ?>
    &nbsp;
    <?php if(isset($_REQUEST['ds'])){ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 tab-active" style="padding:2px; height:60px; border-radius: 10px">
     <p></p>
         <center><strong><a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il']?>&&ds"><n  style="color:white;">Danh Sách SV</n></a></strong></center>
    </div>
     <?php } else{ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il']?>&&ds">Danh Sách SV</a></strong></center>
    </div>
    <?php } ?>
    &nbsp;
   
     <?php if(isset($_REQUEST['qld'])){ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 tab-active" style="padding:2px; height:60px; border-radius: 10px">
     <p></p>
         <center><strong><a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il']?>&&qld"><n  style="color:white;">Quản Lý Điểm</n></a></strong></center>
    </div>
     <?php } else{ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il']?>&&qld">Quản Lý Điểm</a></strong></center>
    </div>
    <?php } ?>
    &nbsp;
    <?php
	/*
	?>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
    <p></p>
        <center><strong>Thông Báo</strong></center>
    </div>
	<?php
	*/ ?>
     </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-2">
    </div>
</div>
<br />
<?php
if(isset($_REQUEST['qld'])){
	?>
    <div class="row">
    	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 border">
        	<p></p>
            <?php 
			$il=$_REQUEST['il'];
			$ihp=$_REQUEST['ihp'];
			$ig=$_REQUEST['ig'];
			$sql="select * from filediem where id_lophocphan='$il' and md5(id_hocphan)='$ihp' and id_giangvien='$ig'";
			$qr=mysql_query($sql);
			if(mysql_num_rows($qr)==1){
			?>
            <p></p>
            <center><h5>Phần Sửa Điểm</h5></center>
            <p></p>
            <form action="#" method="post" enctype="multipart/form-data">
            <center>Upload File Điểm:&nbsp;<input type="file" name="f" required="required" /></center>
            <p></p>
            <center><input type="submit" value="OK" name="editd" /></center> 
            </form>
            <?php
			}
			else{
			?>
            <center><h5>Phần Nhập Điểm</h5></center>
            <p></p>
            <form action="#" method="post" enctype="multipart/form-data">
            <center>Upload File Điểm:&nbsp;<input type="file" name="f" required="required"  /></center>
            <p></p>
            <center><input type="submit" name="ld" value="OK" /></center>
            </form>
            <p></p>
            <p></p>
            <center><i>( Để Upload File Điểm Quý Thầy Cô Vui Lòng Upload Lại File Đã Tải Bên Mục Danh Sách Sinh Viên . Xin Cảm Ơn ! )</i></center>           <?php } ?>
            <hr/>
            <center><h5>Danh Sách Sinh Viên Đã Lên Điểm&nbsp;&nbsp;&nbsp;<a href=
            "cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&bdtk"><img src=
            "https://tse4.mm.bing.net/th?id=OIP.A8SgPPVJMf9aQvqD-NHX-gHaHa&pid=Api&P=0&h=180" height="40px" width="40px" /></a></h5></center>
            <br />
            <form action="#" method="post" enctype="multipart/form-data">
            	&nbsp;Họ Tên SV: &nbsp;<input type="text" name="a" />&nbsp;Mã Số SV: &nbsp; <input type="text" name="b" />&nbsp;
                <input type="submit" name="as" value="OK" />
            </form>
            <br />
            <table class="table table-bordered col-xs-12 col-sm-12 col-md-12 col-lg-12">
            	<thead>
                <tr>
                	<th>STT</th>
                    <th>MSSV</th>
                    <th>Tên Sinh Viên</th>
                    <th>TK1</th>
                    <th>TK2</th>
                    <th>TK3</th>
                     <th>GK</th>
                      <th>TH1</th>
                       <th>TH2</th>
                        <th>TH3</th>
                         <th>CK</th>
                          <th><center>ĐTB</center></th>
                </tr>
                <?php
				if(isset($_POST['as'])){
						$ht=$_POST['a'];
						$ma=$_POST['b'];
						$l="select *from diem d join sinhvien s on s.id_sinhvien=d.id_sinhvien
						join ct_hocphan c on c.id_hocphan=d.id_hocphan
						where s.masosinhvien='$ma' and s.tensinhvien='$ht' and d.id_lophocphan='$il' and md5(d.id_hocphan)='$ihp'";
					    $q=mysql_query($l);
				}
				else{
				$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:10;
				$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
				$pl="select count(d.id_sinhvien) from diem d join sinhvien s on d.id_sinhvien=s.id_sinhvien
				join ct_hocphan c on c.id_hocphan=d.id_hocphan where md5(d.id_hocphan)='$ihp' 
				and d.id_lophocphan='$il'";
				$qr=mysql_query($pl); 
    			$cot = mysql_fetch_row($qr);  
   			    $tongbangghi = $cot[0];  
   				$tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
				
				$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:10;
				$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
   			    $start_from = ($tranghientai-1) * $bangghimoitrang;
				$ihp=$_REQUEST['ihp'];
				$il=$_REQUEST['il'];
				$l="select * from diem d join sinhvien s on d.id_sinhvien=s.id_sinhvien
				join ct_hocphan c on c.id_hocphan=d.id_hocphan where md5(d.id_hocphan)='$ihp' 
				and d.id_lophocphan='$il' limit $start_from,$bangghimoitrang";
				$q=mysql_query($l);
				}
				$a=1;
				while($r=mysql_fetch_assoc($q)){
				?>
                <tr>
                	<td><?php echo $a++; ?></td>
                    <td><?php echo $r['masosinhvien'] ?></td>
                    <td><?php echo $r['tensinhvien'] ?></td>
                    <td><?php echo $r['TK1'] ?></td>
                    <td><?php echo $r['TK2'] ?></td>
                    <td><?php echo $r['TK3'] ?></td>
                    <td><?php echo $r['GK'] ?></td>
                    <td><?php echo $r['TH1'] ?></td>
                    <td><?php echo $r['TH2'] ?></td>
                    <td><?php echo $r['TH3'] ?></td>
                    <td><?php echo $r['CK'] ?></td>
                    <td><?php $tc=$r['soTC'];
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
								  echo "<center><strong>".round($dtb,1)."</strong></center>";
							  }?></td>
                </tr>
                <?php
				}
				$a++;
				?>
                </thead>
            </table>
             <p></p>
            <center><?php if(isset($_POST['as'])){
				}
				else{
				include_once("Controller/cPageU.php");
				}?></center>
            <br />
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
    </div>
    <?php
}
elseif(isset($_REQUEST['bdtk'])){
	?>
    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	<div class="col-xs-0 col-sm-0 col-md-0 col-lg-2">
   		</div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 border">
        <p></p>
        <center><h5>Thống Kê Điểm Sinh Viên</h5></center>
         <p></p>
        <select onChange="window.location=this.value">
        	<option><?php if(isset($_REQUEST['tron'])){
				echo "Biểu Đồ Tròn";
			}
			elseif(isset($_REQUEST['cot'])){
				echo "Biểu Đồ Cột";
			}
			elseif(isset($_REQUEST['duong'])){
				echo "Biểu Đồ Đường";
			}
			else{
				echo "Chọn Biểu Đồ";
			}?></option>
            <?php if(isset($_REQUEST['tron'])){
			}
			else{
			?>
            <option value="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo 
			$_REQUEST['il'] ?>&&bdtk&&tron">Biểu Đồ Tròn</option>
            <?php
			}
			?>
            <?php if(isset($_REQUEST['cot'])){
			}
			else{
			?>
            <option value="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo 
			$_REQUEST['il'] ?>&&bdtk&&cot">Biểu Đồ Cột</option>
            <?php
			}
			?>
            <?php if(isset($_REQUEST['duong'])){
			}
			else{
			?>
            <option value="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo 
			$_REQUEST['il'] ?>&&bdtk&&duong">Biểu Đồ Đường</option>
            <?php } ?>
        </select>
        <p></p>
        
    <?php
	// Up dữ liệu điểm TB
	            $ihp=$_REQUEST['ihp'];
				$il=$_REQUEST['il'];
				$l="select * from diem d join sinhvien s on d.id_sinhvien=s.id_sinhvien
				join ct_hocphan c on c.id_hocphan=d.id_hocphan where md5(d.id_hocphan)='$ihp' 
				and d.id_lophocphan='$il'";
				$q=mysql_query($l);
	             while ($r=mysql_fetch_assoc($q)){?>
                    <?php $r['TK1'] ?>
                    <?php $r['TK2'] ?>
                    <?php $r['TK3'] ?>
                    <?php $r['GK'] ?>
                    <?php $r['TH1'] ?>
                    <?php $r['TH2'] ?>
                    <?php $r['TH3'] ?>
                    <?php $r['CK'] ?>
                    <?php $tc=$r['soTC'];
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
								  $idsv=$r['id_sinhvien'];
								  $ip=$r['id_hocphan'];
								  $il=$r['id_lophocphan'];
								  $dtb=((($tk*0.2+$gk*0.3+$ck*0.5)*$tclt+$th*$tcth)/$tc);
								  if($dtb){
								
									  $dtb=round($dtb,1);
									  $sql1="update diem set diemtb='$dtb' where id_sinhvien='$idsv' 
									  and id_hocphan='$ip' and id_lophocphan='$il'";
									  $qr1=mysql_query($sql1);
								
									  
								  }
							  }
				 }
    // Lấy dữ liệu số lượng sinh viên theo điểm trung bình trên tổng số sinh viên trong lớp
	// Lấy số lượng điểm sinh viên trong lớp
	$sql="select count(id_sinhvien) as slsv from diem where id_hocphan='$ip' and id_lophocphan='$il'";
	$qr=mysql_query($sql);
	$s=mysql_fetch_assoc($qr);
	$slsv=$s['slsv']."<br>";
	// Lấy điểm slsv dtb từ 9 đến 10
	$sql1 = "select count(id_sinhvien) as slsv1 from diem where diemtb<=10 and diemtb>=9 and id_hocphan='$ip' and id_lophocphan='$il'";
	$qr1=mysql_query($sql1);
	$s=mysql_fetch_assoc($qr1);
	$d1=$s['slsv1'];
	// Lấy điểm slsv dtb từ 8.5 đến 8.9
	$sql1 = "select count(id_sinhvien) as slsv1 from diem where diemtb<=8.9 and diemtb>=8.5 and id_hocphan='$ip' and id_lophocphan='$il'";
	$qr1=mysql_query($sql1);
	$s=mysql_fetch_assoc($qr1);
	$d2=$s['slsv1'];
	// Lấy điểm slsv dtb từ 7 đến 8.4
	$sql1 = "select count(id_sinhvien) as slsv2 from diem where diemtb<=8.4 and diemtb>=7 and id_hocphan='$ip' and id_lophocphan='$il'";
	$qr1=mysql_query($sql1);
	$s=mysql_fetch_assoc($qr1);
	$d3=$s['slsv2'];
	// Lấy điểm slsv dtb từ 5 đến 6.9
	$sql1 = "select count(id_sinhvien) as slsv3 from diem where diemtb<=6.9 and diemtb>=5 and id_hocphan='$ip' and id_lophocphan='$il'";
	$qr1=mysql_query($sql1);
	$s=mysql_fetch_assoc($qr1);
	$d4=$s['slsv3'];
	// Lấy điểm slsv dtb < 5
	$sql1 = "select count(id_sinhvien) as slsv4 from diem where diemtb<=5 and id_hocphan='$ip' and id_lophocphan='$il'";
	$qr1=mysql_query($sql1);
	$s=mysql_fetch_assoc($qr1);
	$d5=$s['slsv4'];
	
	?>
<?php
if ($d1 == "0" && $d2 == "0" && $d3 == "0" && $d4 == "0" && $d5 == "0") {
?>
    <p></p>
    <center>Chưa có dữ liệu điểm để hiển thị!</center>
<?php
} else {
?>
    <?php if(isset($_REQUEST['tron'])){?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Thang Điểm', 'Số Lượng SV'],
          ['< 5',    <?php echo $d5; ?>],
          ['5 - 6.9',      <?php echo $d4; ?>],
          ['7 - 8.4',  <?php echo $d3; ?>],
          ['8.5 - 8.9', <?php echo $d2; ?>],
          ['9 - 10', <?php echo $d1; ?>]
        ]);
        var options = {
           title: '',
		   pieHole: 0.3
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <center><p id="piechart" style="width: 900px; height: 500px;"></p></center>
    <p></p>
    <center><strong>Biểu Đồ Điểm TB</strong> - Môn <?php 
		  $ihp=$_REQUEST['ihp'];
		  $sql="select * from hocphan hp join monlop m on m.id_hocphan=hp.id_hocphan
		  join lophocphan l on l.id_lophocphan=m.id_lophocphan where md5(hp.id_hocphan)='$ihp'";
		  $qr=mysql_query($sql);
		  $x=mysql_fetch_assoc($qr);
		  echo $x['tenhocphan']." ".$x['tenlophocphan']; ?></center>
    <?php }
	elseif(isset($_REQUEST['cot'])){ ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "SV Đạt ( SL ):", { role: "style" } ],
        ["< 5",  <?php echo $d5; ?> , "#b87333"],
        ["5 - 6.9",  <?php echo $d4; ?> , "color: pink"],
        ["7 -8.4",  <?php echo $d3; ?> , "color: yellow"],
        ["8.5 - 8.9",  <?php echo $d2; ?> , "color: orange"],
		["9 - 10",  <?php echo $d1; ?> , "color:green"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
    <center>
        <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
    </center>
    <p></p>
    <br />
    <br />
    <br />
    <br />
    <center>
        <strong>Biểu Đồ Điểm TB</strong> - Môn <?php
                                                $ihp = $_REQUEST['ihp'];
                                                // Please note that using mysql_* functions is not recommended as they are deprecated. Consider using PDO or mysqli instead.
                                                $sql = "SELECT * FROM hocphan hp JOIN monlop m ON m.id_hocphan = hp.id_hocphan
                                                        JOIN lophocphan l ON l.id_lophocphan = m.id_lophocphan 
                                                        WHERE MD5(hp.id_hocphan) = '$ihp'";
                                                $qr = mysql_query($sql);
                                                $x = mysql_fetch_assoc($qr);
                                                echo $x['tenhocphan'] . " " . $x['tenlophocphan'];
                                                ?>
    </center>

    <?php }
	elseif(isset($_REQUEST['duong'])){?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Thang Điểm', 'Số Lượng Sinh Viên Đạt'],
          ['< 5',  <?php echo $d5; ?>],
          ['5 - 6.9',  <?php echo $d4; ?>],
          ['7 - 8.4',  <?php echo $d3; ?>],
          ['8.5 - 8.9', <?php echo $d2; ?>],
		  ['9 - 10',  <?php echo $d1; ?>]
        ]);

        var options = {
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <center> <div id="curve_chart" style="width: 900px; height: 450px"></div></center>
    <p></p>
    <br />
    <br />
    <br />
    <br />
    <center>
        <strong>Biểu Đồ Điểm TB</strong> - Môn <?php
                                                $ihp = $_REQUEST['ihp'];
                                                // Please note that using mysql_* functions is not recommended as they are deprecated. Consider using PDO or mysqli instead.
                                                $sql = "SELECT * FROM hocphan hp JOIN monlop m ON m.id_hocphan = hp.id_hocphan
                                                        JOIN lophocphan l ON l.id_lophocphan = m.id_lophocphan 
                                                        WHERE MD5(hp.id_hocphan) = '$ihp'";
                                                $qr = mysql_query($sql);
                                                $x = mysql_fetch_assoc($qr);
                                                echo $x['tenhocphan'] . " " . $x['tenlophocphan'];
                                                ?>
    </center>
    <?php
	}
	?>
    <?php
}
?>
    <p></p>
    <p></p>
    <br />
    <br />
    <strong>Bảng Thống Kê Chi Tiết:</strong>
    <p></p>
    <table class="table-bordered col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	<thead>
        	<tr>
            	<th>Điểm TB</th>
                <th>Điểm < 5</th>
                <th>Điểm Từ 5 Đến 6.9</th>
                <th>Điểm Từ 7 Đến 8.4</th>
                <th>Điểm Từ 8.5 Đến 8.9</th>
                <th>Điểm Từ 9 Đến 10</th>
            </tr>
            <tr>
            	<th>Số Lượng SV Đạt:</th>
                <td><center><?php echo $d5; ?></center></td>
                <td><center><?php echo $d4; ?></center></td>
                <td><center><?php echo $d3; ?></center></td>
                <td><center><?php echo $d2; ?></center></td>
                <td><center><?php echo $d1; ?></center></td>
            </tr>
            <tr>
            	<td colspan="3"><strong>SL Sinh Viên:</strong> <?php echo $slsv ?></td>
                <td colspan="3"><strong>Điểm TB Học Phần:</strong>  &nbsp;<?php
				$sql="select avg(diemtb) as tb from diem where id_hocphan='$ip' and id_lophocphan='$il'";
				$qr=mysql_query($sql);
				$f=mysql_fetch_assoc($qr);
				echo $r=round($f['tb'],1);?></td>
            </tr>
            <tr>
            	<td colspan="6"><strong>Kết Luận:</strong>&nbsp;<?php
				if($r>=8.5){
					echo "Lớp Học Ngưỡng Giỏi ";
				}
				elseif($r>=7){
					echo "Lớp Học Ngưỡng Khá ";
				}
				elseif($r>=5){
					echo "Lớp Học Ngưỡng Trung Bình ";
				}
				else{
					echo "Lớp Học Ngưỡng Yếu ";
				}
                ?></td>
            </tr>
        </thead>
    </table>
    <p></p>
    	</div>
   		<div class="col-xs-0 col-sm-0 col-md-0 col-lg-2">
         </div>
    
    </div>
    <?php
}
elseif(isset($_REQUEST['ds'])){
	?>
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
        	<table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Họ Và Tên</th>
                        <th><center>Lần Truy Cập Gần Nhất</center></th>
                    </tr>
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
<?php
$a=1;
while($ttm=mysql_fetch_assoc($qr)){
	?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $ttm['tensinhvien'] ?></td>
                        <td><?php
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
						?><center>Truy cập <strong><?php echo $n."&nbsp;ngày&nbsp;".$h."&nbsp;giờ&nbsp;".$p."&nbsp;phút&nbsp;".$g; ?> giây</strong>&nbsp;trước</center></td>
                    </tr>
                    <?php } ?>
                </thead>
            </table>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
    </div>
    <center>
    <a href="abc.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&
    il=<?php echo $_REQUEST['il'] ?>&&xf"><button>Tải Excel</button></a></center>
    <?php
}
else{
?>
 <?php
  if(isset($_REQUEST['suatl'])){
	  ?>
      <center>
      <div class="border">
      <p></p>
      	<h5>Sửa Tài Liệu Tham Khảo</h5>
        <form action="#" method="post" enctype="multipart/form-data">
      <p></p>
      <?php 
	  include_once("Model/mKetNoiGV.php");
	  $p=new ketnoiGV();
	  $kn=$p->ketnoi($ketnoi);
	  if($kn){
	  $id=$_REQUEST['id']; 
	  $sql="select * from tltk where id_tltk='$id'";
	  $qr=mysql_query($sql);
	  $v=mysql_fetch_assoc($qr);?>      
      Tiêu Đề: <input type="text" name="a" value="<?php echo $v['tieude'] ?>" />&nbsp;<input type="file" name="f" />
      <input type="hidden" name="b" value="<?php echo $v['filetailieu'] ?>" />
      <p></p>
      <input type="submit" value="Sửa" name="s" />
       <p></p>
       </form>
      </div>
      </center>
      <?php
	  }
  }
  elseif(isset($_REQUEST['suabtth'])){
	    ?>
      <center>
      <div class="border">
      <p></p>
      	<h5>Sửa Tài Liệu Thực Hành</h5>
        <form action="#" method="post" enctype="multipart/form-data">
      <p></p>
      <?php 
	  include_once("Model/mKetNoiGV.php");
	  $p=new ketnoiGV();
	  $kn=$p->ketnoi($ketnoi);
	  if($kn){
	  $id=$_REQUEST['id']; 
	  $sql="select * from tltk where id_tltk='$id'";
	  $qr=mysql_query($sql);
	  $v=mysql_fetch_assoc($qr);?>      
      Tiêu Đề: <input type="text" name="a" value="<?php echo $v['tieude'] ?>" />&nbsp;<input type="file" name="f" />
      <input type="hidden" name="b" value="<?php echo $v['filetailieu'] ?>" />
      <p></p>
      <input type="submit" value="Sửa" name="s" />
       <p></p>
       </form>
      </div>
      </center>
      <?php
	  }
	  
  }
  elseif(isset($_REQUEST['filenop'])){
		  ?>
          <div class="row">
          	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <p></p>
            <table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Tên Sinh Viên</th>
                        <th>MSSV</th>
                        <th>Tiêu Đề</th>
                        <th>File Nộp</th>
                        <th>Ngày Nộp</th>
                    </tr>
                    <?php
					 $id=$_REQUEST['id'];
	  $sql="select * from filenopbtlt f join sinhvien s on f.id_sinhvien=s.id_sinhvien
	  where f.id_btlt='$id'";
	  $qr=mysql_query($sql);
	  ?>
      <center><h5>Danh Sách File Sinh Viên Nộp</h5></center>
      <?php
	  $a=1;
	  while($f=mysql_fetch_assoc($qr)){
					?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $f['tensinhvien']?></td>
                        <td><?php echo $f['masosinhvien']?></td>
                        <td><?php echo $f['tieude']?></td>
                        <td><a href="taixuong.php?fu=<?php echo $f['filenop'];?>"><?php echo $f['filenop']?></a></td>
                        <td><?php $cD = $f['ngaynop'];
$nn = date("H:i:s d-m-Y", strtotime($cD)); echo $nn;?></td>
                    </tr>
                    <?php
	  }
	  $a++;
	  ?>
                </thead>
            </table>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
          </div>
          
     <div class="row">
     <p></p>
     <p></p>
     </div>
      <?php
  }
  /* File Bài Tập Thực Hành Sinh Viên Nộp */
  elseif(isset($_REQUEST['filenopth'])){
		  ?>
          <div class="row">
          	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <p></p>
            <table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Tên Sinh Viên</th>
                        <th>MSSV</th>
                        <th>Tiêu Đề</th>
                        <th>File Nộp</th>
                        <th>Ngày Nộp</th>
                    </tr>
                    <?php
					$id=$_REQUEST['id'];
	  $sql="select * from filenopbtth f join sinhvien s on f.id_sinhvien=s.id_sinhvien
	  where f.id_btth='$id'";
	  $qr=mysql_query($sql);
	  ?>
      <center><h5>Danh Sách File Sinh Viên Nộp</h5></center>
      <?php
	  $a=1;
	  while($f=mysql_fetch_assoc($qr)){
		  ?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $f['tensinhvien']?></td>
                        <td><?php echo $f['masosinhvien']?></td>
                        <td><?php echo $f['tieude']?></td>
                        <td><a href="taixuong.php?fu=<?php echo $f['filenop'];?>"><?php echo $f['filenop']?></a></td>
                        <td><?php $cD = $f['ngaynop'];
$nn = date("H:i:s d-m-Y", strtotime($cD)); echo $nn;?></td>
                    </tr>
                    <?php
	  }
	  $a++;
	  ?>
                </thead>
            </table>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
          </div>
          
     <div class="row">
     <p></p>
     <p></p>
     </div>
      <?php
  }
  /* File Bài Kiểm Tra Thực Hành Sinh Viên Nộp */
  elseif(isset($_REQUEST['filenopktth'])){
		  ?>
          <div class="row">
          	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <p></p>
            <table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Tên Sinh Viên</th>
                        <th>MSSV</th>
                        <th>Tiêu Đề</th>
                        <th>File Nộp</th>
                        <th>Ngày Nộp</th>
                    </tr>
                    <?php
					$id=$_REQUEST['id'];
	  $sql="select * from filenopbtth f join sinhvien s on f.id_sinhvien=s.id_sinhvien
	  where f.id_btth='$id'";
	  $qr=mysql_query($sql);
	  ?>
      <center><h5>Danh Sách File Sinh Viên Nộp</h5></center>
      <?php
	  $a=1;
	  while($f=mysql_fetch_assoc($qr)){
					?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $f['tensinhvien']?></td>
                        <td><?php echo $f['masosinhvien']?></td>
                        <td><?php echo $f['tieude']?></td>
                        <td><a href="taixuong.php?fu=<?php echo $f['filenop'];?>"><?php echo $f['filenop']?></a></td>
                        <td><?php $cD = $f['ngaynop'];
$nn = date("H:i:s d-m-Y", strtotime($cD)); echo $nn;?></td>
                    </tr>
                        <?php
	  }
	  $a++;
	  ?>
                </thead>
            </table>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            </div>
          </div>
      
     <div class="row">
     <p></p>
     <p></p>
     </div>
      <?php
  }
  
  elseif(isset($_REQUEST['suabt'])){
	  ?>
      <center>
      <div class="border">
      <p></p>
      	<h5>Sửa Bài Tập</h5>
        <form action="#" method="post" enctype="multipart/form-data">
      <p></p>
      <?php 
	  include_once("Model/mKetNoiGV.php");
	  $p=new ketnoiGV();
	  $kn=$p->ketnoi($ketnoi);
	  if($kn){
	  $id=$_REQUEST['id']; 
	  $sql="select * from baitaplythuyet where id_btlt='$id'";
	  $qr=mysql_query($sql);
	  $v=mysql_fetch_assoc($qr);?>      
      Tiêu Đề: <input type="text" name="a" value="<?php echo $v['tieude'] ?>" />&nbsp;<input type="file" name="f" />
      <p></p>
      Hạn Nộp: <input type="datetime-local" name="bd" value="<?php echo $v['batdaunop'] ?>" />&nbsp;-&nbsp; <input type="datetime-local" name="kt"
       value="<?php echo $v['ketthucnop'] ?>" />
      <input type="hidden" name="b" value="<?php echo $v['filebt'] ?>" />
      <p></p>
      <input type="submit" value="Sửa" name="sb" />
       <p></p>
       </form>
      </div>
      </center>
      <?php
	  }
  }
  elseif(isset($_REQUEST['suanth'])){
	  ?>
      <center>
      <div class="border">
      <p></p>
      	<h5>Sửa Bài Tập Thực Hành</h5>
        <form action="#" method="post" enctype="multipart/form-data">
      <p></p>
      <?php 
	  include_once("Model/mKetNoiGV.php");
	  $p=new ketnoiGV();
	  $kn=$p->ketnoi($ketnoi);
	  if($kn){
	  $id=$_REQUEST['id']; 
	  $sql="select * from baitapthuchanh where id_btth='$id'";
	  $qr=mysql_query($sql);
	  $v=mysql_fetch_assoc($qr);?>      
      Tiêu Đề: <input type="text" name="a" value="<?php echo $v['tieude'] ?>" size="30" />&nbsp;
      <p></p>
      Hạn Nộp: <input type="datetime-local" name="bd" value="<?php echo $v['batdaunop'] ?>" />&nbsp;-&nbsp; <input type="datetime-local" name="kt"
       value="<?php echo $v['ketthucnop'] ?>" />
      <p></p>
      <input type="submit" value="Sửa" name="sbth" />
       <p></p>
       </form>
      </div>
      </center>
      <?php
	  }
	  
  }
  elseif(isset($_REQUEST['suanktth'])){
	  ?>
      <center>
      <div class="border">
      <p></p>
      	<h5>Sửa Bài Kiểm Tra Thực Hành</h5>
        <form action="#" method="post" enctype="multipart/form-data">
      <p></p>
      <?php 
	  include_once("Model/mKetNoiGV.php");
	  $p=new ketnoiGV();
	  $kn=$p->ketnoi($ketnoi);
	  if($kn){
	  $id=$_REQUEST['id']; 
	  $sql="select * from baitapthuchanh where id_btth='$id'";
	  $qr=mysql_query($sql);
	  $v=mysql_fetch_assoc($qr);?>      
      Tiêu Đề: <input type="text" name="a" value="<?php echo $v['tieude'] ?>" size="30" />&nbsp;
      <p></p>
      Hạn Nộp: <input type="datetime-local" name="bd" value="<?php echo $v['batdaunop'] ?>" />&nbsp;-&nbsp; <input type="datetime-local" name="kt"
       value="<?php echo $v['ketthucnop'] ?>" />
      <p></p>
      <input type="submit" value="Sửa" name="sbktth" />
       <p></p>
       </form>
      </div>
      </center>
      <?php
	  }
  }
  ?>
  
<?php
	$ihp=$_REQUEST['ihp'];
	$il=$_REQUEST['il'];
	$ig=$_REQUEST['ig'];
	$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
	join monlop m on m.id_hocphan=hp.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join giangday g on m.id=g.id join giangvien gv on gv.id_giangvien=g.id_giangvien
	where md5(m.id_hocphan)='$ihp' and g.id_giangvien='$ig' and m.id_lophocphan='$il'";
	$tm=mysql_query($sql);
	$c=mysql_fetch_assoc($tm);
	?>
<?php 
$ig=$_REQUEST['ig'];
$ihp=$_REQUEST['ihp'];
$il=$_REQUEST['il'];
$sql="select * from giangday where id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
$qr=mysql_query($sql);
$e=mysql_fetch_assoc($qr);
$n=$e['id_giangvien'];
if($n==$ig && !isset($_REQUEST['filenopktth']) && !isset($_REQUEST['filenopth'])){
?>
<div class="content-wrapper" style="padding: 20px 30px;">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 style="margin:0;"><i class="fas fa-book"></i> Thông Tin Môn Học</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-2"><strong><i class="fas fa-graduation-cap text-primary"></i> Học Phần:</strong> <?php echo $c['tenhocphan']; ?></p>
                    <p class="mb-2"><strong><i class="fas fa-code text-primary"></i> Mã Học Phần:</strong> <?php echo $c['mahocphan']; ?></p>
                    <p class="mb-2"><strong><i class="fas fa-users text-primary"></i> Lớp Học Phần:</strong> <?php echo $c['tenlophocphan']; ?></p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong><i class="fas fa-calendar-alt text-primary"></i> Ngày Giảng Dạy:</strong> Thứ <?php echo $c['thuhocLT']; ?></p>
                    <p class="mb-2"><strong><i class="fas fa-clock text-primary"></i> Tiết Học:</strong> <?php echo $c['tietbatdauLT'] ?> - <?php echo $c['tietketthucLT'] ?></p>
                    <p class="mb-2"><strong><i class="fas fa-map-marker-alt text-primary"></i> Phòng Học:</strong> <?php echo $c['phonghocLT'] ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h5 style="margin:0;"><i class="fas fa-file-alt"></i> Tài Liệu Tham Khảo</h5>
                    <?php if(!isset($_REQUEST['them'])){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&them#tltk" class="btn btn-sm btn-dark">
                        <i class="fas fa-plus"></i> Thêm
                    </a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <?php if(isset($_REQUEST['them'])){ ?>
                    <form action="cthpgv.php?bm=<?php echo $_REQUEST['bm']; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&gd" method="post" enctype="multipart/form-data" class="mb-3 p-3 border rounded bg-light">
                        <h6><i class="fas fa-upload"></i> Thêm Tài Liệu Mới</h6>
                        <div class="form-group">
                            <label>Tiêu Đề:</label>
                            <input type="text" name="a" class="form-control" placeholder="Nhập Tiêu Đề" required />
                        </div>
                        <div class="form-group">
                            <label>File Tài Liệu:</label>
                            <input type="file" name="f" class="form-control" required />
                        </div>
                        <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                        <button type="submit" name="t" class="btn btn-primary"><i class="fas fa-check"></i> Upload</button>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#tltk" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
                    </form>
                    <?php } ?>
                    <?php
                    $ig=$_REQUEST['ig'];
                    $ihp=$_REQUEST['ihp'];
                    $il=$c['id_lophocphan'];
                    $sql="select *from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
                    join monlop m on m.id=gd.id
                    where gd.id_giangvien='$ig' and md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and loaitailieu='GT' ";
                    $qr=mysql_query($sql);
                    $hasGT = false;
                    while($tl=mysql_fetch_assoc($qr)){
                        $hasGT = true;
                        $filePath = "file/".$tl['filetailieu'];
                    ?>
                    <div class="document-item mb-2 p-2 border rounded bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <?php if(file_exists($filePath)){ ?>
                                <a href="taixuong.php?fu=<?php echo $tl['filetailieu'];?>" class="text-decoration-none">
                                    <i class="fas fa-file-pdf text-danger"></i> <?php echo $tl['tieude']; ?>
                                </a>
                                <?php } else { ?>
                                <span class="text-muted"><i class="fas fa-file text-secondary"></i> <?php echo $tl['tieude']; ?></span>
                                <?php } ?>
                            </div>
                            <div>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_tltk']; ?>&&suatl&&gd#tltk" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_tltk']; ?>&&xoatl&&gd#tltk" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } 
                    if(!$hasGT){
                        echo '<p class="text-muted text-center"><i class="fas fa-info-circle"></i> Chưa có tài liệu tham khảo</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 style="margin:0;"><i class="fas fa-chalkboard-teacher"></i> Slide Bài Giảng</h5>
                    <?php if(!isset($_REQUEST['themslide'])){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&themslide#smh" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Thêm
                    </a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <?php if(isset($_REQUEST['themslide'])){ ?>
                    <form action="#" method="post" enctype="multipart/form-data" class="mb-3 p-3 border rounded bg-light">
                        <h6><i class="fas fa-upload"></i> Thêm Slide Mới</h6>
                        <div class="form-group">
                            <label>Tiêu Đề:</label>
                            <input type="text" name="a" class="form-control" placeholder="Nhập Tiêu Đề" required />
                        </div>
                        <div class="form-group">
                            <label>File Slide:</label>
                            <input type="file" name="f" class="form-control" required />
                        </div>
                        <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                        <button type="submit" name="ad" class="btn btn-primary"><i class="fas fa-check"></i> Upload</button>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#smh" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
                    </form>
                    <?php } ?>
                    <?php
                    $sql="select *from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
                    join monlop m on m.id=gd.id
                    where gd.id_giangvien='$ig' and md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and loaitailieu='Slide' ";
                    $qr=mysql_query($sql);
                    $hasSlide = false;
                    while($tl=mysql_fetch_assoc($qr)){
                        $hasSlide = true;
                    ?>
                    <div class="document-item mb-2 p-2 border rounded bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="taixuong.php?fu=<?php echo $tl['filetailieu'];?>" class="text-decoration-none">
                                    <i class="fas fa-file-powerpoint text-warning"></i> <?php echo $tl['tieude']; ?>
                                </a>
                            </div>
                            <div>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_tltk']; ?>&&suatl&&gd#smh" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_tltk']; ?>&&xoatl&&gd#smh" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } 
                    if(!$hasSlide){
                        echo '<p class="text-muted text-center"><i class="fas fa-info-circle"></i> Chưa có slide bài giảng</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 style="margin:0;"><i class="fas fa-pencil-alt"></i> Bài Tập Lý Thuyết</h5>
            <?php if(!isset($_REQUEST['thembt'])){ ?>
            <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&thembt#bt" class="btn btn-sm btn-light">
                <i class="fas fa-plus"></i> Thêm
            </a>
            <?php } ?>
        </div>
        <div class="card-body">
            <?php if(isset($_REQUEST['thembt'])){ ?>
            <form action="#" method="post" enctype="multipart/form-data" class="mb-3 p-3 border rounded bg-light">
                <h6><i class="fas fa-upload"></i> Thêm Bài Tập Mới</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tiêu Đề:</label>
                            <input type="text" name="a" class="form-control" placeholder="Nhập Tiêu Đề" required />
                        </div>
                        <div class="form-group">
                            <label>File Bài Tập:</label>
                            <input type="file" name="f" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hạn Nộp:</label>
                            <div class="row">
                                <div class="col-6">
                                    <label class="small">Bắt đầu:</label>
                                    <input type="datetime-local" name="bd" class="form-control" required />
                                </div>
                                <div class="col-6">
                                    <label class="small">Kết thúc:</label>
                                    <input type="datetime-local" name="kt" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                <button type="submit" name="addbt" class="btn btn-primary"><i class="fas fa-check"></i> Thêm Bài Tập</button>
                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#bt" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
            </form>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th width="50">STT</th>
                            <th>Tiêu Đề</th>
                            <th width="150">Hạn Nộp</th>
                            <th width="120">Ngày Tạo</th>
                            <th width="150">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql="select *from baitaplythuyet lt join giangday gd on lt.id_giangday=gd.id_giangday
                    join monlop m on m.id=gd.id
                    where gd.id_giangvien='$ig' and md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' ";
                    $qr=mysql_query($sql);
                    $stt = 1;
                    while($tl=mysql_fetch_assoc($qr)){
                    ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td>
                                <a href="taixuong.php?fu=<?php echo $tl['filebt'];?>">
                                    <i class="fas fa-file-alt text-primary"></i> <?php echo $tl['tieude']; ?>
                                </a>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($tl['ketthucnop'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($tl['ngaydang'])); ?></td>
                            <td>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btlt']; ?>&&suabt&&gd#bt" class="btn btn-sm btn-outline-primary" title="Sửa"><i class="fas fa-edit"></i></a>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btlt']; ?>&&xoabt&&gd#bt" class="btn btn-sm btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fas fa-trash"></i></a>
                                <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btlt']; ?>&&filenop&&gd#bt" class="btn btn-sm btn-outline-info" title="File nộp"><i class="fas fa-download"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.document-item {
    background: #f8f9fa;
    transition: all 0.3s;
}
.document-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}
.card {
    border-radius: 10px;
    overflow: hidden;
}
.card-header {
    padding: 12px 20px;
}
/* CSS Phần Thực Hành */
.practice-section {
    padding: 20px 30px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 20px;
}
.practice-header {
    color: #F63;
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.practice-header i {
    color: #F63;
}
.practice-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: hidden;
}
.practice-card-header {
    background: #F63;
    color: #fff;
    padding: 15px 20px;
    font-size: 18px;
    font-weight: bold;
}
.practice-card-body {
    padding: 20px;
}
.practice-info {
    background: #fff3e0;
    border-left: 4px solid #F63;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.practice-info-item {
    font-size: 16px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.practice-info-label {
    font-weight: bold;
    color: #333;
}
.practice-doc-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.practice-doc-item {
    background: #f8f9fa;
    padding: 12px 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s;
    border: 1px solid #e9ecef;
}
.practice-doc-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}
.practice-doc-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #333;
    text-decoration: none;
}
.practice-doc-link:hover {
    color: #F63;
}
.practice-doc-actions {
    display: flex;
    gap: 8px;
}
.practice-doc-actions a {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    transition: all 0.3s;
}
.practice-doc-actions a:hover {
    transform: scale(1.1);
}
.practice-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #F63;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s;
}
.practice-add-btn:hover {
    background: #e55a00;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(255,102,51,0.3);
}
.practice-form-card {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    margin-top: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: 2px dashed #F63;
}
.practice-form-title {
    color: #F63;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
}
.practice-empty {
    text-align: center;
    padding: 20px;
    color: #999;
    font-style: italic;
}
</style>
<?php
  }
  ?>
  
<br />

<?php 
$ig=$_REQUEST['ig'];
$ihp=$_REQUEST['ihp'];
$il=$_REQUEST['il'];
$sql="select * from giangday where id=(select id from monlop where md5(id_hocphan)='$ihp' and id_lophocphan='$il')";
$qr=mysql_query($sql);
$e=mysql_fetch_assoc($qr);
$n=$e['id_giangvienTH1'];
$m=$e['id_giangvienTH2'];

$il=$_REQUEST['il'];
$ig=$_REQUEST['ig'];
	$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
	join monlop m on m.id_hocphan=hp.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join giangday g on m.id=g.id join giangvien gv on gv.id_giangvien=g.id_giangvien
	where md5(m.id_hocphan)='$ihp' and (g.id_giangvienTH1='$ig' or g.id_giangvienTH2='$ig') and m.id_lophocphan='$il'";
	$tm=mysql_query($sql);
	$c=mysql_fetch_assoc($tm);
if(isset($_REQUEST['filenopktth']) || isset($_REQUEST['filenopth'])){
    // Không hiển thị practice-section - chỉ hiển thị bảng file nộp (đã có ở elseif phía trên)
}
elseif($n==$ig||$m==$ig){
?>
<div class="practice-section">
    <div class="practice-header">
        <i class="fas fa-laptop-code"></i> Phần Thực Hành
    </div>

    <div class="practice-card">
        <div class="practice-card-header">
            <i class="fas fa-info-circle"></i> Thông Tin Môn Học
        </div>
        <div class="practice-card-body">
            <div class="practice-info">
                <div class="practice-info-item">
                    <i class="fas fa-calendar-alt" style="color:#F63"></i>
                    <span class="practice-info-label">Ngày Dạy TH:</span> Thứ <?php echo $c['thuhocTH']; ?>
                </div>
                <div class="practice-info-item">
                    <i class="fas fa-clock" style="color:#F63"></i>
                    <span class="practice-info-label">Tiết Dạy:</span> <?php echo $c['tietbatdauTH'] ?> - <?php echo $c['tietketthucTH'] ?>
                </div>
                <div class="practice-info-item">
                    <i class="fas fa-map-marker-alt" style="color:#F63"></i>
                    <span class="practice-info-label">Phòng Dạy TH:</span> <?php echo $c['phonghocTH'] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="practice-card" id="tlth">
        <div class="practice-card-header">
            <i class="fas fa-file-alt"></i> Tài Liệu Thực Hành
        </div>
        <div class="practice-card-body">
            <ul class="practice-doc-list">
            <?php
  $ig=$_REQUEST['ig'];
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $sql="select *from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id
   where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and loaitailieu='BTTH' and ( gd.id_giangvienTH1='$ig' or gd.id_giangvienTH2='$ig' ) ";
  $qr=mysql_query($sql);
  $hasBTTH = false;
  while($tl=mysql_fetch_assoc($qr)){
      $hasBTTH = true;
  ?>
                <li class="practice-doc-item">
                    <a href="taixuong.php?fu=<?php echo $tl['filetailieu'];?>" class="practice-doc-link">
                        <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="25px" width="25px" />
                        <span><?php echo $tl['tieude']; ?></span>
                    </a>
                    <div class="practice-doc-actions">
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_tltk']; ?>&&suabtth&&gd" title="Sửa"><img src="https://tse1.mm.bing.net/th?id=OIP.fuaJLF-qmrT5gP7eXrRm2wHaHa&pid=Api&rs=1&c=1&qlt=95&w=121&h=121" height="20px" width="20px"/></a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_tltk']; ?>&&xoatl&&gd" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"><img src="https://tse4.mm.bing.net/th?id=OIP.MeHH1uPILocqcbznizYrggHaHa&pid=Api&P=0&h=180" height="20px" width="20px"/></a>
                    </div>
                </li>
            <?php } ?>
            </ul>
            <?php if(!$hasBTTH){ echo '<div class="practice-empty">Chưa có tài liệu thực hành</div>'; } ?>
            
            <?php if(isset($_REQUEST['themtlth'])){ ?>
            <div class="practice-form-card">
                <div class="practice-form-title"><i class="fas fa-plus-circle"></i> Thêm Tài Liệu Thực Hành</div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><strong>Tiêu Đề:</strong></label>
                        <input type="text" name="a" class="form-control" placeholder="Nhập Tiêu Đề" required="required" />
                    </div>
                    <div class="form-group">
                        <label><strong>File Tài Liệu:</strong></label>
                        <input type="file" name="f" class="form-control" required="required"/>
                    </div>
                    <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                    <button type="submit" name="tlth" class="btn btn-primary"><i class="fas fa-check"></i> Upload</button>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#tlth" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
                </form>
            </div>
            <?php } else { ?>
            <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&themtlth#tlth" class="practice-add-btn">
                <i class="fas fa-plus"></i> Thêm Tài Liệu
            </a>
            <?php } ?>
        </div>
    </div>

    <div class="practice-card" id="btth">
        <div class="practice-card-header">
            <i class="fas fa-tasks"></i> Quản Lý Bài Tập TH Hàng Tuần
        </div>
        <div class="practice-card-body">
            <ul class="practice-doc-list">
            <?php
  $ig=$_REQUEST['ig'];
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $sql="select *from baitapthuchanh th join giangday gd on th.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id
   where md5(m.id_hocphan)='$ihp' and th.loaibai='' and m.id_lophocphan='$il' and (gd.id_giangvienTH1='$ig' or gd.id_giangvienTH2='$ig' ) ";
  $qr=mysql_query($sql);
  $hasBTTH2 = false;
  while($tl=mysql_fetch_assoc($qr)){
      $hasBTTH2 = true;
  ?>
                <li class="practice-doc-item">
                    <div class="practice-doc-link">
                        <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="25px" width="25px" />
                        <span><?php echo $tl['tieude']; ?></span>
                    </div>
                    <div class="practice-doc-actions">
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btth']; ?>&&suanth&&gd" title="Sửa"><img src="https://tse1.mm.bing.net/th?id=OIP.fuaJLF-qmrT5gP7eXrRm2wHaHa&pid=Api&rs=1&c=1&qlt=95&w=121&h=121" height="20px" width="20px"/></a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btth']; ?>&&xoanth&&gd" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"><img src="https://tse4.mm.bing.net/th?id=OIP.MeHH1uPILocqcbznizYrggHaHa&pid=Api&P=0&h=180" height="20px" width="20px"/></a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btth']; ?>&&filenopth&&gd" title="File Nộp"><img src="https://tse3.mm.bing.net/th?id=OIP.8I-uiHN41PSx54BrCJka7gHaHa&pid=Api&P=0&h=180" height="20px" width="20px"/></a>
                    </div>
                </li>
            <?php } ?>
            </ul>
            <?php if(!$hasBTTH2){ echo '<div class="practice-empty">Chưa có bài tập thực hành hàng tuần</div>'; } ?>
            
            <?php if(isset($_REQUEST['thembtht'])){ ?>
            <div class="practice-form-card">
                <div class="practice-form-title"><i class="fas fa-plus-circle"></i> Thêm Bài Tập Thực Hành Hàng Tuần</div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><strong>Tiêu Đề:</strong></label>
                        <input type="text" name="a" class="form-control" placeholder="Nhập Tiêu Đề" required="required" />
                    </div>
                    <div class="form-group">
                        <label><strong>Hạn Nộp:</strong></label>
                        <div class="d-flex gap-2">
                            <input type="datetime-local" name="bd" class="form-control" required="required"/>
                            <span class="align-self-center">-</span>
                            <input type="datetime-local" name="kt" class="form-control" required="required"/>
                        </div>
                    </div>
                    <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                    <button type="submit" name="nbtth" class="btn btn-primary"><i class="fas fa-check"></i> Thêm</button>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#btth" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
                </form>
            </div>
            <?php } else { ?>
            <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&thembtht#btth" class="practice-add-btn">
                <i class="fas fa-plus"></i> Thêm Bài Tập
            </a>
            <?php } ?>
        </div>
    </div>

    <div class="practice-card" id="btthkt">
        <div class="practice-card-header">
            <i class="fas fa-clipboard-check"></i> Bài Tập TH Kiểm Tra
        </div>
        <div class="practice-card-body">
            <ul class="practice-doc-list">
            <?php
  $ig=$_REQUEST['ig'];
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $sql="select *from baitapthuchanh th join giangday gd on th.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id
   where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and loaibai='KTTH' and (gd.id_giangvienTH1='$ig' or gd.id_giangvienTH2='$ig' ) ";
  $qr=mysql_query($sql);
  $hasKTTH = false;
  while($tl=mysql_fetch_assoc($qr)){
      $hasKTTH = true;
  ?>
                <li class="practice-doc-item">
                    <div class="practice-doc-link">
                        <img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="25px" width="25px" />
                        <span><?php echo $tl['tieude']; ?></span>
                    </div>
                    <div class="practice-doc-actions">
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btth']; ?>&&suanktth&&gd" title="Sửa"><img src="https://tse1.mm.bing.net/th?id=OIP.fuaJLF-qmrT5gP7eXrRm2wHaHa&pid=Api&rs=1&c=1&qlt=95&w=121&h=121" height="20px" width="20px"/></a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btth']; ?>&&xoanktth&&gd" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')"><img src="https://tse4.mm.bing.net/th?id=OIP.MeHH1uPILocqcbznizYrggHaHa&pid=Api&P=0&h=180" height="20px" width="20px"/></a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btth']; ?>&&filenopktth&&gd" title="File Nộp"><img src="https://tse3.mm.bing.net/th?id=OIP.8I-uiHN41PSx54BrCJka7gHaHa&pid=Api&P=0&h=180" height="20px" width="20px"/></a>
                    </div>
                </li>
            <?php } ?>
            </ul>
            <?php if(!$hasKTTH){ echo '<div class="practice-empty">Chưa có bài tập kiểm tra thực hành</div>'; } ?>
            
            <?php if(isset($_REQUEST['thembnktth'])){ ?>
            <div class="practice-form-card">
                <div class="practice-form-title"><i class="fas fa-plus-circle"></i> Thêm Bài Kiểm Tra Thực Hành</div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><strong>Tiêu Đề:</strong></label>
                        <input type="text" name="a" class="form-control" placeholder="Nhập Tiêu Đề" required="required" />
                    </div>
                    <div class="form-group">
                        <label><strong>Hạn Nộp:</strong></label>
                        <div class="d-flex gap-2">
                            <input type="datetime-local" name="bd" class="form-control" required="required"/>
                            <span class="align-self-center">-</span>
                            <input type="datetime-local" name="kt" class="form-control" required="required"/>
                        </div>
                    </div>
                    <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                    <button type="submit" name="nbktth" class="btn btn-primary"><i class="fas fa-check"></i> Thêm</button>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#btthkt" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
                </form>
            </div>
            <?php } else { ?>
            <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&thembnktth#btthkt" class="practice-add-btn">
                <i class="fas fa-plus"></i> Thêm Bài Kiểm Tra
            </a>
            <?php } ?>
        </div>
    </div>
</div>

<?php } }
?>

<br />
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
</div>

</div>
</body>
</html>