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

<?php /* Thêm Bài Tập Lý Thuyết */ ?>
<?php
session_start();
if(isset($_POST['addbt'])){
    include_once("Model/mKetNoiGV.php");
    $p = new ketnoiGV();
    $kn = $p->ketnoi($ketnoigv);
    
    $td = $_POST['a'];
    $bd = $_POST['bd'];
    $kt = $_POST['kt'];
    $ig = $_REQUEST['ig'];
    $ihp = $_REQUEST['ihp'];
    $il = $_POST['il'];
    
    $f_start = strtotime($bd);
    $f_end = strtotime($kt);
    
    // Kiểm tra ngày hợp lệ
    if($f_start >= $f_end){
        echo "<script>alert('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc!')</script>";
    } else {
        // Kiểm tra file upload
        if(!isset($_FILES['f']) || $_FILES['f']['error'] === UPLOAD_ERR_NO_FILE){
            echo "<script>alert('Vui lòng chọn file để upload!')</script>";
        } else {
            $file_name = $_FILES['f']['name'];
            $file_tmp = $_FILES['f']['tmp_name'];
            $file_type = $_FILES['f']['type'];
            $file_size = $_FILES['f']['size'];
            $target_directory = 'file/';
            
            // Kiểm tra kích thước file
            if($file_size > 10*1024*1024){
                echo "<script>alert('Kích thước file không được quá 10MB!')</script>";
            } else {
                // Di chuyển file trước khi kiểm tra
                $target_file = $target_directory . basename($file_name);
                if(move_uploaded_file($file_tmp, $target_file)){
                    $allow_upload = true;
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    
                    // Kiểm tra nội dung file cho các định dạng
                    if($file_type == 'application/x-zip-compressed' || $file_ext == 'zip'){
                        // Kiểm tra file ZIP
                        $zip = new ZipArchive();
                        if($zip->open($target_file) === TRUE){
                            for($i = 0; $i < $zip->numFiles; $i++){
                                $fileContent = $zip->getFromIndex($i);
                                if($fileContent !== false && (strpos($fileContent, 'Exec(') !== false || strpos($fileContent, 'eval(') !== false || 
                                   strpos($fileContent, 'system(') !== false || strpos($fileContent, 'phpinfo(') !== false)){
                                    $allow_upload = false;
                                    break;
                                }
                            }
                            $zip->close();
                        }
                        if(!$allow_upload){
                            unlink($target_file);
                            echo "<script>alert('File ZIP chứa mã thực thi không được phép upload!')</script>";
                        }
                    } elseif($file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $file_ext == 'docx'){
                        // Kiểm tra file DOCX
                        $zip = new ZipArchive();
                        if($zip->open($target_file) === true){
                            $content = $zip->getFromName('word/document.xml');
                            $zip->close();
                            if($content !== false){
                                $content = strip_tags($content);
                                if(strpos($content, 'Exec(') !== false || strpos($content, 'eval(') !== false || 
                                   strpos($content, 'system(') !== false || strpos($content, 'phpinfo(') !== false){
                                    $allow_upload = false;
                                    unlink($target_file);
                                    echo "<script>alert('File DOCX chứa mã thực thi không được phép upload!')</script>";
                                }
                            }
                        }
                    }
                    
                    // Nếu file hợp lệ, lưu vào database
                    if($allow_upload && $kn){
                        $sql = "INSERT INTO baitaplythuyet(id_giangday, ngaydang, tieude, filebt, batdaunop, ketthucnop) 
                                SELECT id_giangday, NOW(), '$td', '$file_name', '$bd', '$kt' 
                                FROM giangday 
                                WHERE id_giangvien='$ig' 
                                AND id=(SELECT id FROM monlop WHERE md5(id_hocphan)='$ihp' AND id_lophocphan='$il')";
                        $qr = mysql_query($sql);
                        
                        if($qr){
                            echo "<script>alert('Thêm bài tập thành công!'); window.location.href='cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&gd#bt';</script>";
                            exit();
                        } else {
                            unlink($target_file);
                            echo "<script>alert('Lỗi khi lưu vào database!')</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Lỗi khi upload file!')</script>";
                }
            }
        }
    }
}
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
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
/* === BASE STYLES === */
body {
    font-family: 'Poppins', sans-serif;
    background: #f0f2f5;
    min-height: 100vh;
    margin: 0;
}
a {
    color: #333;
    transition: all 0.3s ease;
}
a:hover {
    color: #667eea;
    text-decoration: none;
}

/* === MODERN HEADER STYLES === */
.modern-header {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.main-header {
    background: #fff;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header-top-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 10px 0;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px;
}

.header-brand {
    display: flex;
    align-items: center;
    gap: 16px;
}

.brand-logo {
    width: 55px;
    height: 55px;
    object-fit: contain;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

.brand-text h1 {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.brand-text p {
    margin: 0;
    font-size: 12px;
    color: #6b7280;
}

.header-nav {
    display: flex;
    align-items: center;
    gap: 24px;
}

.nav-tabs-custom {
    display: flex;
    gap: 8px;
}

.nav-tab {
    padding: 14px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    color: #6b7280;
    background: #f3f4f6;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-tab:hover {
    background: #e5e7eb;
    color: #374151;
}

.nav-tab.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.nav-tab i {
    font-size: 16px;
}

.header-user {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 10px 16px;
    background: #f8fafc;
    border-radius: 50px;
}

.user-home-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 25px;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s ease;
}

.user-home-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    color: #fff;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar-header {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
}

.user-name {
    font-weight: 600;
    color: #374151;
    font-size: 14px;
}

.user-role {
    font-size: 12px;
    color: #6b7280;
}

/* Course Title Section */
.course-title-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 30px;
    margin: 20px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
}

.course-title {
    display: flex;
    align-items: center;
    gap: 16px;
}

.course-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.course-icon i {
    font-size: 28px;
    color: #fff;
}

.course-title h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #fff;
}

.course-title p {
    margin: 4px 0 0 0;
    font-size: 14px;
    color: rgba(255,255,255,0.8);
}

/* === FOOTER STYLES === */
.modern-footer {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    color: #fff;
    margin-top: 40px;
    position: relative;
    overflow: hidden;
}

.modern-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
}

.footer-main {
    padding: 60px 30px 40px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr;
    gap: 50px;
}

.footer-brand {
    display: flex;
    flex-direction: column;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
}

.footer-logo img {
    width: 60px;
    height: 60px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}

.footer-logo h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.footer-brand p {
    color: #9ca3af;
    line-height: 1.8;
    margin-bottom: 24px;
}

.footer-social {
    display: flex;
    gap: 12px;
}

.social-link {
    width: 42px;
    height: 42px;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: translateY(-3px);
    color: #fff;
}

.footer-section h4 {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 24px 0;
    color: #fff;
    position: relative;
    padding-bottom: 12px;
}

.footer-section h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #fff;
    padding-left: 8px;
}

.footer-links a i {
    font-size: 12px;
    color: #667eea;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 20px;
}

.contact-icon {
    width: 44px;
    height: 44px;
    background: rgba(102, 126, 234, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-icon i {
    color: #667eea;
    font-size: 18px;
}

.contact-text {
    flex: 1;
}

.contact-text strong {
    display: block;
    color: #fff;
    margin-bottom: 4px;
}

.contact-text span {
    color: #9ca3af;
    font-size: 14px;
}

.footer-bottom {
    background: rgba(0,0,0,0.2);
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-bottom p {
    margin: 0;
    color: #9ca3af;
    font-size: 14px;
}

.footer-bottom-links {
    display: flex;
    gap: 24px;
}

.footer-bottom-links a {
    color: #9ca3af;
    font-size: 14px;
}

.footer-bottom-links a:hover {
    color: #fff;
}

/* === RESPONSIVE === */
@media (max-width: 992px) {
    .header-content {
        flex-direction: column;
        gap: 16px;
        padding: 15px;
    }
    .nav-tabs-custom {
        flex-wrap: wrap;
        justify-content: center;
    }
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .footer-bottom {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .nav-tab span {
        display: none;
    }
    .nav-tab {
        padding: 12px 16px;
    }
    .header-user {
        flex-direction: column;
        gap: 10px;
    }
    .course-title-section {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }
}
</style>
</head>

<body>

<!-- ==================== MODERN HEADER ==================== -->
<div class="main-header">
    <!-- Top Bar -->
    <div class="header-top-bar">
        <div class="container-fluid">
            <div class="header-content" style="color: #fff; font-size: 13px;">
                <div style="display: flex; align-items: center; gap: 24px;">
                    <span><i class="fas fa-phone-alt"></i> 0143.234.563 - ext 808</span>
                    <span><i class="fas fa-envelope"></i> csm@gmail.com</span>
                </div>
                <div style="display: flex; align-items: center; gap: 16px;">
                    <span id="currentTime"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="container-fluid py-3">
        <div class="header-content">
            <!-- Brand -->
            <div class="header-brand">
                <img src="./img/jahja.jpg" alt="Logo" class="brand-logo" />
                <div class="brand-text">
                    <h1>Hệ Thống Quản Lý</h1>
                    <p>Trường Đại học Công nghiệp TPHCM</p>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="header-nav">
                <div class="nav-tabs-custom">
                    <?php 
                    $is_qtn = isset($_REQUEST['qtnmanage']);
                    $is_gd = isset($_REQUEST['gd']);
                    $is_ds = isset($_REQUEST['ds']);
                    $is_qld = isset($_REQUEST['qld']);
                    ?>
                    
                    <?php if($is_qtn){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd" class="nav-tab">
                        <i class="fas fa-graduation-cap"></i>
                        <span>HP Giảng Dạy</span>
                    </a>
                    <?php } elseif($is_gd){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd" class="nav-tab active">
                        <i class="fas fa-graduation-cap"></i>
                        <span>HP Giảng Dạy</span>
                    </a>
                    <?php } else { ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd" class="nav-tab">
                        <i class="fas fa-graduation-cap"></i>
                        <span>HP Giảng Dạy</span>
                    </a>
                    <?php } ?>
                    
                    <?php if($is_ds){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&ds" class="nav-tab active">
                        <i class="fas fa-users"></i>
                        <span>Danh Sách SV</span>
                    </a>
                    <?php } else { ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&ds" class="nav-tab">
                        <i class="fas fa-users"></i>
                        <span>Danh Sách SV</span>
                    </a>
                    <?php } ?>
                    
                    <?php if($is_qld){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&qld" class="nav-tab active">
                        <i class="fas fa-chart-line"></i>
                        <span>Quản Lý Điểm</span>
                    </a>
                    <?php } else { ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&qld" class="nav-tab">
                        <i class="fas fa-chart-line"></i>
                        <span>Quản Lý Điểm</span>
                    </a>
                    <?php } ?>
                    
                    <?php if($is_qtn){ ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd=1&&qtnmanage=1#qtn" class="nav-tab active">
                        <i class="fas fa-question-circle"></i>
                        <span>Bài Trắc Nghiệm</span>
                    </a>
                    <?php } else { ?>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd=1&&qtnmanage=1#qtn" class="nav-tab">
                        <i class="fas fa-question-circle"></i>
                        <span>Bài Trắc Nghiệm</span>
                    </a>
                    <?php } ?>
                </div>
            </div>

            <!-- User Info -->
            <div class="header-user">
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
                ?>
                <a href="homeGV.php?bm=<?php echo $_REQUEST['bm']; ?>" class="user-home-btn">
                    <i class="fas fa-home"></i>
                    <span>Trang Chủ</span>
                </a>
                <div class="user-info">
                    <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>">
                        <?php if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){ ?>
                            <img src="<?php echo $anh?>" alt="Avatar" class="user-avatar-header" />
                        <?php } else { ?>
                            <img src="img/<?php echo $anh?>" alt="Avatar" class="user-avatar-header" />
                        <?php } ?>
                    </a>
                    <div>
                        <a href="info1.php?bm=<?php echo $_REQUEST['bm'] ?>" class="user-name"><?php echo $t['hotengiangvien'] ?></a>
                        <div class="user-role">Giảng Viên</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== COURSE TITLE SECTION ==================== -->
<?php
$ihp=$_REQUEST['ihp'];
$sql="select * from hocphan where md5(id_hocphan)='$ihp' ";
$qr=mysql_query($sql);
$ttm=mysql_fetch_assoc($qr);
?>
<div class="container-fluid px-4">
    <div class="course-title-section">
        <div class="course-title">
            <div class="course-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h2><?php echo $ttm['tenhocphan']; ?></h2>
                <p><i class="fas fa-code"></i> <?php echo $ttm['mahocphan']; ?></p>
            </div>
        </div>
            <div>
                <a href="homeGV.php?bm=<?php echo $_REQUEST['bm'] ?>" class="btn btn-light btn-lg" style="border-radius: 50px; padding: 12px 30px;">
                    <i class="fas fa-arrow-left mr-2"></i> Quay Lại
                </a>
            </div>
    </div>
</div>

<div class="container-fluid px-4 pb-5">
<?php
if(isset($_REQUEST['qld'])){
	?>
    <!-- ==================== QUẢN LÝ ĐIỂM - MODERN UI ==================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <div style="background: #fff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); overflow: hidden; animation: fadeInUp 0.5s ease;">
        
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 24px 30px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-chart-line" style="font-size: 24px; color: #fff;"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: #fff;">Quản Lý Điểm</h3>
                    <p style="margin: 4px 0 0 0; font-size: 14px; color: rgba(255,255,255,0.8);">Nhập và quản lý điểm sinh viên</p>
                </div>
            </div>
            <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&bdtk" 
               style="display: inline-flex; align-items: center; gap: 10px; background: #fff; color: #667eea; padding: 12px 24px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                <i class="fas fa-chart-pie"></i>
                <span>Thống Kê</span>
            </a>
        </div>

        <!-- Upload Section -->
        <div style="padding: 24px;">
            <?php 
			$il=$_REQUEST['il'];
			$ihp=$_REQUEST['ihp'];
			$ig=$_REQUEST['ig'];
			$sql="select * from filediem where id_lophocphan='$il' and md5(id_hocphan)='$ihp' and id_giangvien='$ig'";
			$qr=mysql_query($sql);
			if(mysql_num_rows($qr)==1){
			?>
            <!-- Edit Score Section -->
            <div style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 2px solid #fcd34d; border-radius: 16px; padding: 24px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                    <div style="width: 48px; height: 48px; background: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-edit" style="font-size: 20px; color: #fff;"></i>
                    </div>
                    <div>
                        <h5 style="margin: 0; color: #92400e;">Cập Nhật Điểm</h5>
                        <p style="margin: 4px 0 0 0; font-size: 13px; color: #b45309;">Tải lên file điểm mới để cập nhật</p>
                    </div>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <div style="position: relative; display: flex; align-items: center;">
                                <i class="fas fa-file-excel" style="position: absolute; left: 16px; color: #10b981; font-size: 20px;"></i>
                                <input type="file" name="f" required style="width: 100%; padding: 14px 18px 14px 50px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; transition: all 0.3s ease;" />
                            </div>
                        </div>
                        <button type="submit" name="editd" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 14px 28px; border: none; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                            <i class="fas fa-upload"></i> Cập Nhật
                        </button>
                    </div>
                </form>
            </div>
            <?php
			}
			else{
			?>
            <!-- Upload Score Section -->
            <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 2px dashed #10b981; border-radius: 16px; padding: 24px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                    <div style="width: 48px; height: 48px; background: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-file-import" style="font-size: 20px; color: #fff;"></i>
                    </div>
                    <div>
                        <h5 style="margin: 0; color: #065f46;">Nhập Điểm Từ File</h5>
                        <p style="margin: 4px 0 0 0; font-size: 13px; color: #047857;">Hỗ trợ định dạng Excel (.xlsx, .xls)</p>
                    </div>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <div style="position: relative; display: flex; align-items: center;">
                                <i class="fas fa-file-excel" style="position: absolute; left: 16px; color: #10b981; font-size: 20px;"></i>
                                <input type="file" name="f" required style="width: 100%; padding: 14px 18px 14px 50px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; transition: all 0.3s ease;" />
                            </div>
                        </div>
                        <button type="submit" name="ld" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; padding: 14px 28px; border: none; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);">
                            <i class="fas fa-check"></i> Nhập Điểm
                        </button>
                    </div>
                </form>
                <div style="margin-top: 16px; padding: 12px 16px; background: rgba(255,255,255,0.7); border-radius: 8px;">
                    <p style="margin: 0; font-size: 12px; color: #6b7280;">
                        <i class="fas fa-info-circle" style="color: #667eea; margin-right: 6px;"></i>
                        Để Upload File Điểm, vui lòng tải File mẫu từ mục Danh Sách Sinh Viên trước khi nhập điểm.
                    </p>
                </div>
            </div>
            <?php } ?>

            <!-- Search Form -->
            <div style="background: #f8fafc; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                <form action="#" method="post" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="position: relative;">
                            <i class="fas fa-user" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                            <input type="text" name="a" placeholder="Họ tên SV..." style="padding: 12px 16px 12px 42px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; min-width: 200px; transition: all 0.3s ease;" />
                        </div>
                        <div style="position: relative;">
                            <i class="fas fa-id-badge" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                            <input type="text" name="b" placeholder="Mã số SV..." style="padding: 12px 16px 12px 42px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; min-width: 150px; transition: all 0.3s ease;" />
                        </div>
                    </div>
                    <button type="submit" name="as" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 12px 24px; border: none; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                        <i class="fas fa-search"></i> Tìm Kiếm
                    </button>
                </form>
            </div>

            <!-- Score Table -->
            <div style="background: #f8fafc; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <th style="padding: 16px 12px; text-align: center; font-weight: 600; color: #fff; font-size: 13px; border-bottom: none;">STT</th>
                            <th style="padding: 16px 12px; text-align: left; font-weight: 600; color: #fff; font-size: 13px; border-bottom: none;">MSSV</th>
                            <th style="padding: 16px 12px; text-align: left; font-weight: 600; color: #fff; font-size: 13px; border-bottom: none;">Họ Tên</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">TK1</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">TK2</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">TK3</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">GK</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">TH1</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">TH2</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">TH3</th>
                            <th style="padding: 16px 8px; text-align: center; font-weight: 600; color: #fff; font-size: 12px; border-bottom: none;">CK</th>
                            <th style="padding: 16px 12px; text-align: center; font-weight: 600; color: #fff; font-size: 13px; border-bottom: none;">ĐTB</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    // Calculate DTB
                    $tc=$r['soTC'];
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
                    
                    if($tk2==""&&$tk3==""){ $tk=$tk1; }
                    elseif($tk3==""){ $tk=($tk1+$tk2)/2; }
                    else{ $tk=($tk1+$tk2+$tk3)/3; }
                    
                    if($th2==""&&$th3==""){ $th=$th1; }
                    elseif($th3==""){ $th=($th1+$th2)/2; }
                    else{ $th=($th1+$th2+$th3)/3; }
                    
                    $dtb = '';
                    if($ck!=""){
                        $dtbCalc=((($tk*0.2+$gk*0.3+$ck*0.5)*$tclt+$th*$tcth)/$tc);
                        $dtb = round($dtbCalc,1);
                    }
                    
                    // Determine grade color
                    $dtbColor = '#6b7280';
                    $dtbBg = '#f3f4f6';
                    if($dtb != ''){
                        if($dtb >= 8.5) { $dtbColor = '#059669'; $dtbBg = '#ecfdf5'; }
                        elseif($dtb >= 7.0) { $dtbColor = '#2563eb'; $dtbBg = '#eff6ff'; }
                        elseif($dtb >= 5.0) { $dtbColor = '#d97706'; $dtbBg = '#fffbeb'; }
                        else { $dtbColor = '#dc2626'; $dtbBg = '#fef2f2'; }
                    }
				?>
                        <tr style="border-bottom: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.background='#eef2ff'" onmouseout="this.style.background='#fff'">
                            <td style="padding: 14px 12px; text-align: center;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; border-radius: 8px; font-weight: 600; font-size: 12px;">
                                    <?php echo $a++; ?>
                                </span>
                            </td>
                            <td style="padding: 14px 12px;">
                                <span style="background: #f3f4f6; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; color: #6b7280; font-family: monospace;">
                                    <?php echo $r['masosinhvien'] ?>
                                </span>
                            </td>
                            <td style="padding: 14px 12px;">
                                <span style="font-weight: 600; color: #1a1a2e;"><?php echo $r['tensinhvien'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 500; color: #374151;"><?php echo $r['TK1'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 500; color: #374151;"><?php echo $r['TK2'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 500; color: #374151;"><?php echo $r['TK3'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 600; color: #667eea;"><?php echo $r['GK'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 500; color: #374151;"><?php echo $r['TH1'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 500; color: #374151;"><?php echo $r['TH2'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 500; color: #374151;"><?php echo $r['TH3'] ?></span>
                            </td>
                            <td style="padding: 14px 8px; text-align: center;">
                                <span style="font-weight: 700; color: #ef4444;"><?php echo $r['CK'] ?></span>
                            </td>
                            <td style="padding: 14px 12px; text-align: center;">
                                <?php if($dtb != ''){ ?>
                                <span style="display: inline-block; background: <?php echo $dtbBg; ?>; color: <?php echo $dtbColor; ?>; padding: 6px 14px; border-radius: 8px; font-weight: 700; font-size: 14px;">
                                    <?php echo $dtb; ?>
                                </span>
                                <?php } else { ?>
                                <span style="color: #9ca3af; font-size: 13px;">Chưa có</span>
                                <?php } ?>
                            </td>
                        </tr>
                <?php
				}
				?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div style="margin-top: 20px; display: flex; justify-content: center;">
                <?php if(isset($_POST['as'])){
				}
				else{
				include_once("Controller/cPageU.php");
				}?>
            </div>
        </div>
    </div>

    <style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    input:focus {
        outline: none;
        border-color: #667eea !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    button:hover {
        transform: translateY(-2px);
    }
    </style>
    <?php
}
// ==================== BÀI TẬP TRẮC NGHIỆM ====================
elseif(isset($_REQUEST['gd']) && isset($_REQUEST['qtnmanage'])){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once("Model/mTracNghiem.php");
    $tracnghiem = new TracNghiemModel();
    $tracnghiem->ketnoi();
    
    // Lấy id_giangday
    $ihp = $_REQUEST['ihp'];
    $il = $_REQUEST['il'];
    $ig = $_REQUEST['ig'];
    $sql_gd = "SELECT gd.id_giangday, gd.id 
                FROM giangday gd 
                JOIN monlop ml ON gd.id = ml.id 
                WHERE gd.id_giangvien = '$ig' AND md5(ml.id_hocphan) = '$ihp' AND ml.id_lophocphan = '$il' 
                LIMIT 1";
    $qr_gd = mysql_query($sql_gd);
    $gd = mysql_fetch_assoc($qr_gd);
    $id_giangday = isset($gd['id_giangday']) ? $gd['id_giangday'] : 0;
    
    // Xử lý thêm bài tập - CHUYỂN SANG TRANG TẠO CÂU HỎI
    if(isset($_POST['them_baitap'])) {
        $tieude = addslashes($_POST['tieude']);
        $mota = isset($_POST['mota']) ? addslashes($_POST['mota']) : '';
        $thoigianlambai = intval($_POST['thoigianlambai']);
        $soluongcauhoi = intval($_POST['soluongcauhoi']);
        $diemmotcau = floatval($_POST['diemmotcau']);
        $batdaunop = $_POST['batdaunop'];
        $ketthucnop = $_POST['ketthucnop'];
        $ngaydang = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO baitap_tracnghiem (tieude, mota, thoigianlambai, soluongcauhoi, diemmotcau, batdaunop, ketthucnop, ngaydang, id_giangday) 
                VALUES ('$tieude', '$mota', '$thoigianlambai', '$soluongcauhoi', '$diemmotcau', '$batdaunop', '$ketthucnop', '$ngaydang', '$id_giangday')";
        mysql_query($sql);
        $new_id = mysql_insert_id();
        
        // Chuyển sang trang tạo câu hỏi ngay
        $bm = $_REQUEST['bm'];
        $ig = $_REQUEST['ig'];
        $ihp_param = $_REQUEST['ihp'];
        $il = $_REQUEST['il'];
        echo "<script>window.location.href='tracnghiem_cauhoi_gv.php?qtn=".$new_id."&bm=".$bm."&ig=".$ig."&ihp=".$ihp_param."&il=".$il."&gd=1&&qtnmanage=1';</script>";
        exit;
    }
    
    // Xử lý xóa bài tập
    if(isset($_GET['xoabaitap'])) {
        $id_bttracnghiem = $_GET['xoabaitap'];
        mysql_query("DELETE ct FROM chitiet_tracnghiem ct JOIN nopbai_tracnghiem nb ON ct.id_nopbai = nb.id_nopbai WHERE nb.id_bttracnghiem = '$id_bttracnghiem'");
        mysql_query("DELETE FROM nopbai_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
        $sql_cauhoi = "SELECT id_cauhoi FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
        $qr_cauhoi = mysql_query($sql_cauhoi);
        while($ch = mysql_fetch_assoc($qr_cauhoi)) {
            mysql_query("DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '".$ch['id_cauhoi']."'");
        }
        mysql_query("DELETE FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
        mysql_query("DELETE FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
        $success_msg = "Xóa bài tập thành công!";
    }
    
    // Lấy danh sách bài tập
    $sql_ds = "SELECT * FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday' ORDER BY ngaydang DESC";
    $qr_ds = mysql_query($sql_ds);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <div id="qtn"></div>
    
    <?php if(isset($success_msg)): ?>
    <div style="background: #ecfdf5; color: #059669; padding: 16px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
        <i class="fas fa-check-circle" style="font-size: 20px;"></i> <?php echo $success_msg; ?>
    </div>
    <?php endif; ?>

    <!-- Stats -->
    <?php
    $sql_count = "SELECT COUNT(*) as total FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday'";
    $qr_count = mysql_query($sql_count);
    $stats = mysql_fetch_assoc($qr_count);
    ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div style="background: #fff; border-radius: 16px; padding: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 56px; height: 56px; background: #eff6ff; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; color: #2563eb; font-size: 24px;">
                <i class="fas fa-file-alt"></i>
            </div>
            <h3 style="font-size: 32px; font-weight: 700; color: #1a1a2e;"><?php echo $stats['total']; ?></h3>
            <p style="color: #6b7280; font-size: 14px;">Tổng Bài Tập</p>
        </div>
        <div style="background: #fff; border-radius: 16px; padding: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 56px; height: 56px; background: #ecfdf5; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; color: #059669; font-size: 24px;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 style="font-size: 32px; font-weight: 700; color: #1a1a2e;">
                <?php 
                $sql_active = "SELECT COUNT(*) as cnt FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday' AND ketthucnop >= NOW()";
                $qr_active = mysql_query($sql_active);
                $active = mysql_fetch_assoc($qr_active);
                echo $active['cnt'];
                ?>
            </h3>
            <p style="color: #6b7280; font-size: 14px;">Đang Hoạt Động</p>
        </div>
    </div>

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; padding: 24px 30px; color: #fff; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 24px; font-weight: 600; margin: 0;"><i class="fas fa-question-circle"></i> Quản Lý Bài Tập Trắc Nghiệm</h2>
            <p style="margin: 4px 0 0 0; opacity: 0.9;">Tạo và quản lý bài kiểm tra trắc nghiệm cho sinh viên</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addModal')" style="background: #fff; color: #667eea; padding: 12px 24px; border-radius: 10px; font-weight: 600; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-plus"></i> Thêm Bài Tập Mới
        </button>
    </div>

    <!-- Table -->
    <div style="background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden;">
        <div style="padding: 16px 24px; background: #f8fafc; border-bottom: 1px solid #e5e7eb;">
            <h3 style="font-size: 18px; color: #1a1a2e; margin: 0; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-table" style="color: #667eea;"></i> Danh Sách Bài Tập
            </h3>
        </div>
        <div style="padding: 24px;">
            <?php if(mysql_num_rows($qr_ds) > 0): ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <th style="padding: 14px 16px; text-align: left; color: #fff; font-weight: 600; font-size: 14px;">STT</th>
                            <th style="padding: 14px 16px; text-align: left; color: #fff; font-weight: 600; font-size: 14px;">Tiêu Đề</th>
                            <th style="padding: 14px 16px; text-align: center; color: #fff; font-weight: 600; font-size: 14px;">Thời Gian Làm</th>
                            <th style="padding: 14px 16px; text-align: center; color: #fff; font-weight: 600; font-size: 14px;">Số Câu</th>
                            <th style="padding: 14px 16px; text-align: center; color: #fff; font-weight: 600; font-size: 14px;">Mở Bài</th>
                            <th style="padding: 14px 16px; text-align: center; color: #fff; font-weight: 600; font-size: 14px;">Đóng Bài</th>
                            <th style="padding: 14px 16px; text-align: center; color: #fff; font-weight: 600; font-size: 14px;">Trạng Thái</th>
                            <th style="padding: 14px 16px; text-align: center; color: #fff; font-weight: 600; font-size: 14px;">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        while($row = mysql_fetch_assoc($qr_ds)):
                            $ketthuc = $row['ketthucnop'];
                            $batdau = $row['batdaunop'];
                            $now = date('Y-m-d H:i:s');
                            $isExpired = $now > $ketthuc;
                            $isPending = $now < $batdau;
                        ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 14px 16px;"><?php echo $stt++; ?></td>
                            <td style="padding: 14px 16px;">
                                <strong><?php echo htmlspecialchars($row['tieude']); ?></strong>
                            </td>
                            <td style="padding: 14px 16px; text-align: center;"><?php echo $row['thoigianlambai']; ?> phút</td>
                            <td style="padding: 14px 16px; text-align: center;"><?php echo $row['soluongcauhoi']; ?> câu</td>
                            <td style="padding: 14px 16px; text-align: center; font-size: 13px;"><?php echo date('d/m/Y H:i', strtotime($batdau)); ?></td>
                            <td style="padding: 14px 16px; text-align: center; font-size: 13px;"><?php echo date('d/m/Y H:i', strtotime($ketthuc)); ?></td>
                            <td style="padding: 14px 16px; text-align: center;">
                                <?php if($isExpired): ?>
                                <span style="background: #fef2f2; color: #dc2626; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 600;"><i class="fas fa-clock"></i> Hết hạn</span>
                                <?php elseif($isPending): ?>
                                <span style="background: #fffbeb; color: #d97706; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 600;"><i class="fas fa-hourglass-half"></i> Chưa mở</span>
                                <?php else: ?>
                                <span style="background: #ecfdf5; color: #059669; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 600;"><i class="fas fa-check-circle"></i> Đang mở</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 16px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="tracnghiem_cauhoi_gv.php?qtn=<?php echo $row['id_bttracnghiem']; ?>&&bm=<?php echo $_REQUEST['bm']; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&gd=1" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: #ecfdf5; color: #059669; border-radius: 10px; text-decoration: none;" title="Quản lý câu hỏi">
                                        <i class="fas fa-list-ol"></i>
                                    </a>
                                    <a href="tracnghiem_danhsachnop_gv.php?dsbaitn=<?php echo $row['id_bttracnghiem']; ?>&&bm=<?php echo $_REQUEST['bm']; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&gd=1" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: #eff6ff; color: #2563eb; border-radius: 10px; text-decoration: none;" title="Danh sách bài nộp">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <a href="cthpgv.php?xoabaitap=<?php echo $row['id_bttracnghiem']; ?>&&bm=<?php echo $_REQUEST['bm']; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&gd=1&&qtnmanage=1#qtn" onclick="return confirm('Bạn có chắc muốn xóa bài tập này?')" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: #fef2f2; color: #dc2626; border-radius: 10px; text-decoration: none;" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div style="text-align: center; padding: 60px 20px;">
                <i class="fas fa-inbox" style="font-size: 64px; color: #e5e7eb; margin-bottom: 16px;"></i>
                <h4 style="color: #6b7280; margin-bottom: 8px;">Chưa có bài tập nào</h4>
                <p style="color: #9ca3af;">Nhấn "Thêm Bài Tập Mới" để tạo bài kiểm tra đầu tiên</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Thêm Bài Tập -->
    <div id="addModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; overflow: auto;">
        <div style="background: #fff; border-radius: 20px; width: 90%; max-width: 600px; margin: 50px auto; max-height: 85vh; overflow-y: auto;">
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px 24px; color: #fff; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0;">
                <h3 style="font-size: 18px; margin: 0;"><i class="fas fa-plus-circle"></i> Thêm Bài Tập Trắc Nghiệm</h3>
                <button onclick="closeModal()" style="background: rgba(255,255,255,0.2); border: none; color: #fff; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; font-size: 18px;"><i class="fas fa-times"></i></button>
            </div>
            <div style="padding: 24px;">
                <form action="" method="POST" id="formThemBaiTap">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Tiêu Đề <span style="color: red;">*</span></label>
                        <input type="text" name="tieude" required placeholder="VD: Kiểm tra chương 1" style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; box-sizing: border-box;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Mô Tả</label>
                        <textarea name="mota" rows="2" placeholder="Mô tả bài kiểm tra" style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; box-sizing: border-box;"></textarea>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <div style="float: left; width: 48%; margin-right: 4%;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Thời Gian Làm Bài (phút) <span style="color: red;">*</span></label>
                            <input type="number" name="thoigianlambai" id="thoigianlambai" value="30" min="5" max="180" required style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; box-sizing: border-box;" onchange="tinhThoiGianKetThuc()">
                        </div>
                        <div style="float: left; width: 48%;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Số Câu Hỏi <span style="color: red;">*</span></label>
                            <input type="number" name="soluongcauhoi" value="10" min="1" max="100" required style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; box-sizing: border-box;">
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div style="margin-bottom: 20px; clear: both;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Điểm Mỗi Câu <span style="color: red;">*</span></label>
                        <input type="number" name="diemmotcau" value="1" min="0.1" max="10" step="0.1" required style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; box-sizing: border-box;">
                    </div>
                    <div style="margin-bottom: 20px; clear: both;">
                        <div style="float: left; width: 48%; margin-right: 4%;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Thời Gian Bắt Đầu <span style="color: red;">*</span></label>
                            <input type="datetime-local" name="batdaunop" id="batdaunop" value="<?php echo date('Y-m-d\TH:i'); ?>" required style="width: 100%; padding: 12px 16px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 14px; box-sizing: border-box;" onchange="tinhThoiGianKetThuc()">
                        </div>
                        <div style="float: left; width: 48%;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Thời Gian Kết Thúc <span style="color: #6b7280;">(Tự động)</span></label>
                            <input type="text" id="ketthuc_hienthi" readonly style="width: 100%; padding: 12px 16px; border: 2px solid #10b981; border-radius: 10px; font-size: 14px; box-sizing: border-box; background: #ecfdf5; color: #059669; font-weight: 600;">
                            <input type="hidden" name="ketthucnop" id="ketthucnop">
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div style="background: #fffbeb; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #fcd34d;">
                        <p style="margin: 0; color: #92400e; font-size: 13px;">
                            <i class="fas fa-info-circle"></i> Thời gian kết thúc sẽ được tự động tính = Thời gian bắt đầu + Thời gian làm bài
                        </p>
                    </div>
                    <div style="display: flex; gap: 12px; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #e5e7eb; clear: both;">
                        <button type="button" onclick="closeModal()" style="padding: 12px 24px; background: #6b7280; color: #fff; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;">Hủy</button>
                        <button type="submit" name="them_baitap" style="padding: 12px 24px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;"><i class="fas fa-save"></i> Lưu Bài Tập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function openModal() { 
        document.getElementById('addModal').style.display = 'block'; 
        document.body.style.overflow = 'hidden';
        tinhThoiGianKetThuc();
    }
    function closeModal() { 
        document.getElementById('addModal').style.display = 'none'; 
        document.body.style.overflow = 'auto'; 
    }
    window.onclick = function(event) { 
        var modal = document.getElementById('addModal');
        if (event.target === modal) { 
            modal.style.display = 'none'; 
            document.body.style.overflow = 'auto'; 
        } 
    }
    function tinhThoiGianKetThuc() {
        var batdau = document.getElementById('batdaunop').value;
        var thoigian = parseInt(document.getElementById('thoigianlambai').value) || 30;
        
        if(batdau) {
            var startDate = new Date(batdau);
            startDate.setMinutes(startDate.getMinutes() + thoigian);
            
            var nam = startDate.getFullYear();
            var thang = String(startDate.getMonth() + 1).padStart(2, '0');
            var ngay = String(startDate.getDate()).padStart(2, '0');
            var gio = String(startDate.getHours()).padStart(2, '0');
            var phut = String(startDate.getMinutes()).padStart(2, '0');
            
            var ketthuc = nam + '-' + thang + '-' + ngay + 'T' + gio + ':' + phut;
            document.getElementById('ketthucnop').value = ketthuc;
            
            var ngay_f = ngay + '/' + thang + '/' + nam + ' ' + gio + ':' + phut;
            document.getElementById('ketthuc_hienthi').value = ngay_f;
        }
    }
    // Tính thời gian kết thúc khi load trang
    window.onload = tinhThoiGianKetThuc;
    </script>
<?php
    $tracnghiem->dongketnoi();
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
    date_default_timezone_set('Asia/Ho_Chi_Minh');
	?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- ==================== DANH SÁCH SINH VIÊN - MODERN UI ==================== -->
    <div style="background: #fff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); overflow: hidden; animation: fadeInUp 0.5s ease;">
        
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 24px 30px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-users" style="font-size: 24px; color: #fff;"></i>
            </div>
            <div>
                <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: #fff;">Danh Sách Sinh Viên</h3>
                <p style="margin: 4px 0 0 0; font-size: 14px; color: rgba(255,255,255,0.8);">Theo dõi hoạt động truy cập của sinh viên</p>
            </div>
            <div style="margin-left: auto; display: flex; align-items: center; gap: 8px;">
                <span style="background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 50px; color: #fff; font-size: 14px; font-weight: 500;">
                    <i class="fas fa-user-graduate"></i>
                    <?php
                    $il=$_REQUEST['il'];
                    $ihp=$_REQUEST['ihp'];
                    $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
                    join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
                    join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
                    join giangvien gv on d.id_giangvien=gv.id_giangvien
                    where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il'";
                    $qr=mysql_query($sql);
                    $count = mysql_num_rows($qr);
                    echo $count . ' sinh viên';
                    ?>
                </span>
            </div>
        </div>

        <!-- Student Table -->
        <div style="padding: 24px;">
            <div style="background: #f8fafc; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #374151; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                <i class="fas fa-hashtag" style="color: #667eea; margin-right: 8px;"></i> STT
                            </th>
                            <th style="padding: 16px 20px; text-align: left; font-weight: 600; color: #374151; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                <i class="fas fa-user" style="color: #667eea; margin-right: 8px;"></i> Sinh Viên
                            </th>
                            <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #374151; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                <i class="fas fa-id-card" style="color: #667eea; margin-right: 8px;"></i> Mã SV
                            </th>
                            <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #374151; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                <i class="fas fa-circle" style="color: #667eea; margin-right: 8px;"></i> Trạng Thái
                            </th>
                            <th style="padding: 16px 20px; text-align: center; font-weight: 600; color: #374151; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                <i class="fas fa-clock" style="color: #667eea; margin-right: 8px;"></i> Truy Cập Gần Nhất
                            </th>
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
where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il'";
$qr=mysql_query($sql);
$stt = 1;
while($ttm=mysql_fetch_assoc($qr)){
    $idsv=$ttm['id_sinhvien'];
    $id_lophocphan=$ttm['id_lophocphan'];
    
    $sql1="select * from thongketruycap where id_sinhvien='$idsv' and id_lophocphan='$id_lophocphan'";
    $qr2=mysql_query($sql1);
    $tc=mysql_fetch_assoc($qr2);
    
    if($tc && isset($tc['ngaytruycap'])){
        $tcTime = strtotime($tc['ngaytruycap']);
        $ts = time();
        $k = $ts - $tcTime;
        $g = $k % 60;
        $p = floor(($k % 3600) / 60);
        $h = floor(($k % 86400) / 3600);
        $n = floor($k / 86400);
        
        if($n == 0 && $h == 0 && $p < 5){
            $statusClass = 'online';
            $statusText = 'Đang trực tuyến';
            $timeText = 'Vừa truy cập';
            $bgColor = '#ecfdf5';
            $textColor = '#059669';
        } elseif($n == 0 && $h < 1){
            $statusClass = 'active';
            $statusText = 'Hoạt động';
            $timeText = $p . ' phút ' . $g . ' giây trước';
            $bgColor = '#eff6ff';
            $textColor = '#2563eb';
        } elseif($n == 0 && $h < 24){
            $statusClass = 'today';
            $statusText = 'Hôm nay';
            $timeText = $h . ' giờ ' . $p . ' phút trước';
            $bgColor = '#f0fdf4';
            $textColor = '#16a34a';
        } elseif($n > 0 && $n < 7){
            $statusClass = 'away';
            $statusText = $n . ' ngày trước';
            $timeText = $h . ' giờ trước';
            $bgColor = '#fffbeb';
            $textColor = '#d97706';
        } else {
            $statusClass = 'offline';
            $statusText = 'Lâu không truy cập';
            $timeText = $n . ' ngày ' . $h . ' giờ trước';
            $bgColor = '#f3f4f6';
            $textColor = '#6b7280';
        }
    } else {
        $statusClass = 'never';
        $statusText = 'Chưa truy cập';
        $timeText = 'Chưa có dữ liệu';
        $bgColor = '#fef2f2';
        $textColor = '#dc2626';
    }
    
    $anhSV = $ttm['anh'];
    $avatarUrl = '';
    if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/", $anhSV)){
        $avatarUrl = $anhSV;
    } else {
        $avatarUrl = 'img/' . $anhSV;
    }
?>
                        <tr style="border-bottom: 1px solid #e5e7eb; transition: all 0.3s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; border-radius: 8px; font-weight: 600; font-size: 14px;">
                                    <?php echo $stt++; ?>
                                </span>
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="position: relative;">
                                        <img src="<?php echo $avatarUrl; ?>" alt="<?php echo $ttm['tensinhvien']; ?>" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid #e5e7eb;" />
                                        <span style="position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; background: <?php echo $textColor; ?>; border-radius: 50%; border: 2px solid #fff;"></span>
                                    </div>
                                    <span style="font-weight: 600; color: #1a1a2e;"><?php echo $ttm['tensinhvien']; ?></span>
                                </div>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="background: #f3f4f6; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 500; color: #6b7280; font-family: monospace;">
                                    <?php echo $ttm['masosinhvien']; ?>
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 6px; background: <?php echo $bgColor; ?>; color: <?php echo $textColor; ?>; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 600;">
                                    <i class="fas fa-circle" style="font-size: 8px;"></i>
                                    <?php echo $statusText; ?>
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="color: #6b7280; font-size: 13px;">
                                    <i class="fas fa-clock" style="color: #667eea; margin-right: 4px;"></i>
                                    <?php echo $timeText; ?>
                                </span>
                            </td>
                        </tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    </style>
</div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
    </div>
    
    <!-- Nút Tải Excel - Modern Style -->
    <div style="text-align: center; padding: 20px 0;">
        <a href="abc.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&xf" 
           style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; padding: 14px 32px; border-radius: 50px; font-size: 15px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);">
            <i class="fas fa-file-excel" style="font-size: 18px;"></i>
            <span>Tải Xuống Danh Sách Điểm</span>
        </a>
    </div>
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
    
    <!-- ==================== BÀI TẬP LÝ THUYẾT - MODERN UI ==================== -->
    <div class="assignment-section">
        <div class="section-header">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="header-text">
                    <h3>Bài Tập Lý Thuyết</h3>
                    <p>Quản lý bài tập lý thuyết cho sinh viên</p>
                </div>
            </div>
            <?php if(!isset($_REQUEST['thembt'])){ ?>
            <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd&&thembt#bt" class="btn-add-assignment">
                <i class="fas fa-plus"></i>
                <span>Thêm Bài Tập</span>
            </a>
            <?php } ?>
        </div>

        <!-- Form Thêm Bài Tập -->
        <?php if(isset($_REQUEST['thembt'])){ ?>
        <div class="assignment-form-wrapper">
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <div>
                    <h5>Tạo Bài Tập Mới</h5>
                    <small>Điền thông tin bên dưới để tạo bài tập cho sinh viên</small>
                </div>
            </div>
            <form action="#" method="post" enctype="multipart/form-data" class="assignment-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tag"></i> Tiêu Đề Bài Tập
                        </label>
                        <input type="text" name="a" class="form-input" placeholder="Nhập tiêu đề bài tập..." required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-cloud-upload-alt"></i> File Đề Bài
                        </label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="f" id="fileInput" class="file-input" required />
                            <label for="fileInput" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <span class="file-text">Chọn file hoặc kéo thả vào đây</span>
                                <span class="file-hint">PDF, DOC, DOCX, ZIP (tối đa 10MB)</span>
                            </label>
                            <div class="selected-file" id="selectedFile"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-divider">
                    <span><i class="fas fa-calendar-alt"></i> Thời Gian Nộp</span>
                </div>
                
                <div class="date-range-wrapper">
                    <div class="date-input-group">
                        <label><i class="fas fa-play-circle"></i> Bắt Đầu</label>
                        <input type="datetime-local" name="bd" class="date-input" required />
                    </div>
                    <div class="date-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="date-input-group">
                        <label><i class="fas fa-stop-circle"></i> Kết Thúc</label>
                        <input type="datetime-local" name="kt" class="date-input" required />
                    </div>
                </div>
                
                <input type="hidden" name="il" value="<?php echo $c['id_lophocphan']; ?>" />
                
                <div class="form-actions">
                    <button type="submit" name="addbt" class="btn-submit">
                        <i class="fas fa-check"></i> Tạo Bài Tập
                    </button>
                    <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&gd#bt" class="btn-cancel">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
        <?php } ?>

        <!-- Danh Sách Bài Tập -->
        <div class="assignment-list">
            <?php
            $sql="select *from baitaplythuyet lt join giangday gd on lt.id_giangday=gd.id_giangday
            join monlop m on m.id=gd.id
            where gd.id_giangvien='$ig' and md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' ORDER BY lt.ngaydang DESC";
            $qr=mysql_query($sql);
            $stt = 1;
            $hasData = false;
            while($tl=mysql_fetch_assoc($qr)){
                $hasData = true;
                // Lấy thời gian hiện tại với timezone Việt Nam
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now = time();
                // Chuyển đổi thời gian deadline từ database sang timestamp
                $deadlineStr = $tl['ketthucnop'];
                $deadline = strtotime($deadlineStr);
                
                // So sánh chính xác
                $isExpired = $now > $deadline;
                $remaining = $deadline - $now;
                
                // Tính toán thời gian còn lại chi tiết
                $daysRemaining = floor($remaining / (60*60*24));
                $hoursRemaining = floor(($remaining % (60*60*24)) / (60*60));
                $minutesRemaining = floor(($remaining % (60*60)) / 60);
                
                // Xác định trạng thái deadline
                $deadlineStatus = 'active';
                $deadlineText = '';
                
                if($isExpired){
                    $deadlineStatus = 'expired';
                    $deadlineText = 'Đã hết hạn';
                } else {
                    if($daysRemaining > 0){
                        $deadlineText = 'Còn ' . $daysRemaining . ' ngày';
                    } elseif($hoursRemaining > 0){
                        $deadlineText = 'Còn ' . $hoursRemaining . ' giờ';
                    } elseif($minutesRemaining > 0){
                        $deadlineText = 'Còn ' . $minutesRemaining . ' phút';
                    } else {
                        $deadlineText = 'Sắp đến hạn!';
                    }
                }
                
                $fileExt = strtolower(pathinfo($tl['filebt'], PATHINFO_EXTENSION));
                $fileIcon = 'fa-file';
                if($fileExt == 'pdf') $fileIcon = 'fa-file-pdf';
                elseif($fileExt == 'doc' || $fileExt == 'docx') $fileIcon = 'fa-file-word';
                elseif($fileExt == 'zip' || $fileExt == 'rar') $fileIcon = 'fa-file-archive';
            ?>
            <div class="assignment-card <?php echo $deadlineStatus; ?>">
                <div class="assignment-card-left">
                    <div class="assignment-number"><?php echo $stt++; ?></div>
                </div>
                <div class="assignment-card-main">
                    <div class="assignment-info">
                        <div class="assignment-title">
                            <i class="fas <?php echo $fileIcon; ?> file-type-icon"></i>
                            <a href="taixuong.php?fu=<?php echo $tl['filebt'];?>" class="assignment-name">
                                <?php echo $tl['tieude']; ?>
                            </a>
                        </div>
                        <div class="assignment-meta">
                            <span class="meta-item">
                                <i class="fas fa-calendar-plus"></i>
                                <?php echo date('d/m/Y H:i', strtotime($tl['ngaydang'])); ?>
                            </span>
                        </div>
                    </div>
                    <div class="assignment-deadline">
                        <?php if($deadlineStatus == 'expired'){ ?>
                            <span class="deadline-badge expired">
                                <i class="fas fa-clock"></i>
                                <?php echo $deadlineText; ?>
                            </span>
                        <?php } else { ?>
                            <span class="deadline-badge active">
                                <i class="fas fa-clock"></i>
                                <?php echo $deadlineText; ?>
                            </span>
                        <?php } ?>
                        <div class="deadline-date">
                            <i class="fas fa-calendar"></i>
                            <?php echo date('d/m/Y H:i', $deadline); ?>
                        </div>
                    </div>
                    <div class="assignment-actions">
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btlt']; ?>&&suabt&&gd#bt" class="action-btn edit" title="Sửa">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btlt']; ?>&&filenop&&gd#bt" class="action-btn download" title="DS Nộp">
                            <i class="fas fa-users"></i>
                        </a>
                        <a href="cthpgv.php?bm=<?php echo $_REQUEST['bm'] ?>&&ig=<?php echo $_REQUEST['ig'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $tl['id_btlt']; ?>&&xoabt&&gd#bt" class="action-btn delete" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa bài tập này?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php if(!$hasData){ ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h4>Chưa có bài tập lý thuyết</h4>
                <p>Click nút "Thêm Bài Tập" để tạo bài tập mới cho sinh viên</p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
/* ==================== BÀI TẬP LÝ THUYẾT - STYLES ==================== */
.assignment-section {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
    animation: fadeInUp 0.5s ease;
}

/* Section Header */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
}
.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}
.header-icon {
    width: 56px;
    height: 56px;
    background: rgba(255,255,255,0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
.header-text h3 {
    margin: 0 0 4px 0;
    font-size: 20px;
    font-weight: 600;
}
.header-text p {
    margin: 0;
    font-size: 14px;
    opacity: 0.8;
}
.btn-add-assignment {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    color: #667eea;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
.btn-add-assignment:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    color: #667eea;
    text-decoration: none;
}

/* Form Wrapper */
.assignment-form-wrapper {
    padding: 30px;
    background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
    border-bottom: 1px solid #eef2f7;
}
.form-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
}
.form-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
}
.form-header h5 {
    margin: 0 0 4px 0;
    font-size: 18px;
    color: #1a1a2e;
}
.form-header small {
    color: #6b7280;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}
.form-group {
    display: flex;
    flex-direction: column;
}
.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 10px;
}
.form-label i {
    color: #667eea;
}
.form-input {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fff;
}
.form-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

/* File Upload */
.file-upload-wrapper {
    position: relative;
}
.file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}
.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 30px 20px;
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    background: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}
.file-upload-label:hover {
    border-color: #667eea;
    background: #f8fafc;
}
.upload-icon {
    font-size: 36px;
    color: #667eea;
    margin-bottom: 12px;
}
.file-text {
    font-size: 15px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 6px;
}
.file-hint {
    font-size: 12px;
    color: #9ca3af;
}
.selected-file {
    margin-top: 10px;
    padding: 10px 14px;
    background: #ecfdf5;
    border-radius: 8px;
    font-size: 14px;
    color: #059669;
    display: none;
}
.selected-file.show {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Form Divider */
.form-divider {
    display: flex;
    align-items: center;
    gap: 16px;
    margin: 24px 0;
}
.form-divider::before,
.form-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
}
.form-divider span {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #6b7280;
    white-space: nowrap;
}
.form-divider i {
    color: #667eea;
}

/* Date Range */
.date-range-wrapper {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}
.date-input-group {
    flex: 1;
}
.date-input-group label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    margin-bottom: 8px;
}
.date-input-group label i {
    color: #667eea;
}
.date-input {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fff;
}
.date-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}
.date-arrow {
    color: #9ca3af;
    font-size: 18px;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 16px;
    padding-top: 10px;
}
.btn-submit {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 14px 32px;
    border: none;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}
.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
}
.btn-cancel {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f3f4f6;
    color: #6b7280;
    padding: 14px 28px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-cancel:hover {
    background: #e5e7eb;
    color: #374151;
    text-decoration: none;
}

/* Assignment List */
.assignment-list {
    padding: 24px;
}
.assignment-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    margin-bottom: 12px;
    transition: all 0.3s ease;
}
.assignment-card:hover {
    border-color: #667eea;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.1);
    transform: translateX(5px);
}
.assignment-card.expired {
    background: #f9fafb;
    border-color: #e5e7eb;
}
.assignment-card.expired:hover {
    border-color: #9ca3af;
    box-shadow: none;
}
.assignment-card-left {
    flex-shrink: 0;
}
.assignment-number {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
}
.assignment-card-main {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 30px;
}
.assignment-info {
    flex: 1;
}
.assignment-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 6px;
}
.file-type-icon {
    font-size: 24px;
    color: #ef4444;
}
.assignment-name {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a2e;
    text-decoration: none;
    transition: color 0.3s ease;
}
.assignment-name:hover {
    color: #667eea;
}
.assignment-meta {
    display: flex;
    align-items: center;
    gap: 16px;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #9ca3af;
}
.meta-item i {
    color: #667eea;
}
.assignment-deadline {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 0 20px;
    border-left: 1px solid #e5e7eb;
}
.deadline-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
}
.deadline-badge.active {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: #fff;
}
.deadline-badge.expired {
    background: #f3f4f6;
    color: #6b7280;
}
.deadline-date {
    font-size: 12px;
    color: #9ca3af;
}
.deadline-date i {
    margin-right: 4px;
}
.assignment-actions {
    display: flex;
    gap: 10px;
}
.action-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.action-btn.edit {
    background: #eff6ff;
    color: #3b82f6;
}
.action-btn.edit:hover {
    background: #3b82f6;
    color: #fff;
    transform: scale(1.1);
}
.action-btn.download {
    background: #ecfdf5;
    color: #10b981;
}
.action-btn.download:hover {
    background: #10b981;
    color: #fff;
    transform: scale(1.1);
}
.action-btn.delete {
    background: #fef2f2;
    color: #ef4444;
}
.action-btn.delete:hover {
    background: #ef4444;
    color: #fff;
    transform: scale(1.1);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}
.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.empty-icon i {
    font-size: 32px;
    color: #9ca3af;
}
.empty-state h4 {
    font-size: 18px;
    color: #374151;
    margin-bottom: 8px;
}
.empty-state p {
    font-size: 14px;
    color: #9ca3af;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 992px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .assignment-card-main {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    .assignment-deadline {
        border-left: none;
        padding: 0;
        flex-direction: row;
        width: 100%;
        justify-content: space-between;
    }
}
@media (max-width: 768px) {
    .section-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    .header-left {
        flex-direction: column;
    }
    .assignment-card {
        flex-direction: column;
        text-align: center;
    }
    .assignment-card-left {
        order: -1;
    }
    .form-actions {
        flex-direction: column;
    }
    .date-range-wrapper {
        flex-direction: column;
    }
    .date-arrow {
        transform: rotate(90deg);
    }
}
</style>

<script>
// File upload display
document.getElementById('fileInput')?.addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || '';
    const fileExt = fileName.split('.').pop().toLowerCase();
    let icon = 'fa-file';
    if(fileExt === 'pdf') icon = 'fa-file-pdf';
    else if(fileExt === 'doc' || fileExt === 'docx') icon = 'fa-file-word';
    else if(fileExt === 'zip' || fileExt === 'rar') icon = 'fa-file-archive';
    
    const selectedFile = document.getElementById('selectedFile');
    if(fileName) {
        selectedFile.innerHTML = `<i class="fas ${icon}"></i> <strong>${fileName}</strong>`;
        selectedFile.classList.add('show');
    } else {
        selectedFile.classList.remove('show');
    }
});
</script>

<style>
/* === Modern Global Styles === */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

/* === Animations === */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* === Card Modern Styles === */
.card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    animation: fadeIn 0.5s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
}
.card-header {
    padding: 16px 24px;
}

/* === Button Styles === */
.btn-modern, .btn-shadow {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}
.btn-modern:hover, .btn-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    color: white;
}
.btn-success.btn-shadow {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
}
.btn-success.btn-shadow:hover {
    box-shadow: 0 8px 25px rgba(17, 153, 142, 0.5);
}
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
    transform: translateY(-2px);
}
.btn-action {
    transition: all 0.3s ease;
    border-radius: 8px;
}
.btn-action:hover {
    transform: scale(1.15);
}

/* === Gradient Headers === */
.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}
.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
}
.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
}
.bg-gradient-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
}

/* === Table Modern === */
.table {
    border-radius: 12px;
    overflow: hidden;
}
.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}
.table tbody tr {
    transition: all 0.2s ease;
}
.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.08) !important;
    transform: scale(1.01);
}

/* === Document Item === */
.document-item {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transition: all 0.3s ease;
    border-radius: 10px;
}
.document-item:hover {
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    transform: translateX(8px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* === Badge Styles === */
.badge-pill {
    padding: 6px 14px;
    font-weight: 500;
}

/* === Form Styles === */
.form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
.form-control-lg {
    border-radius: 12px;
}
.form-add-wrapper {
    border: 2px dashed #dee2e6;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
.custom-file-label {
    border-radius: 10px;
}

/* === Links === */
a {
    color: #667eea;
    transition: color 0.3s ease;
}
a:hover {
    color: #764ba2;
    text-decoration: none;
}
/* === CSS Phần Thực Hành - Modern Style === */
.practice-section {
    padding: 20px 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 16px;
    margin-bottom: 20px;
    animation: fadeIn 0.5s ease;
}
.practice-header {
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.practice-header i {
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.practice-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.practice-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
}
.practice-card-header {
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    color: #fff;
    padding: 15px 20px;
    font-size: 18px;
    font-weight: bold;
}
.practice-card-body {
    padding: 20px;
}
.practice-info {
    background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
    border-left: 4px solid;
    border-image: linear-gradient(to bottom, #f5576c, #f093fb) 1;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
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
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 12px 15px;
    margin-bottom: 10px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}
.practice-doc-item:hover {
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    transform: translateX(8px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.practice-doc-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #333;
    text-decoration: none;
}
.practice-doc-link:hover {
    color: #f5576c;
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
    border-radius: 8px;
    transition: all 0.3s ease;
}
.practice-doc-actions a:hover {
    transform: scale(1.15);
}
.practice-add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    color: #fff;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(245, 87, 108, 0.4);
}
.practice-add-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(245, 87, 108, 0.5);
    color: #fff;
}
.practice-form-card {
    background: #fff;
    border-radius: 16px;
    padding: 25px;
    margin-top: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border: 2px dashed;
    border-image: linear-gradient(to right, #f5576c, #f093fb) 1;
    animation: slideDown 0.4s ease-out;
}
.practice-form-title {
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
}
.practice-empty {
    text-align: center;
    padding: 30px;
    color: #999;
}
.practice-empty i {
    font-size: 48px;
    margin-bottom: 15px;
    opacity: 0.5;
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

<!-- ==================== MODERN FOOTER ==================== -->
<div class="modern-footer">
    <div class="footer-main">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="./img/jahja.jpg" alt="Logo" />
                    <h3>QLHV System</h3>
                </div>
                <p>Hệ thống Quản lý Học vụ - Trường Đại học Công nghiệp TPHCM. Quản lý hiệu quả, minh bạch và chuyên nghiệp.</p>
                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h4>Liên Kết Nhanh</h4>
                <ul class="footer-links">
                    <li><a href="homeGV.php?bm=<?php echo $_REQUEST['bm']; ?>"><i class="fas fa-chevron-right"></i> Trang Chủ</a></li>
                    <li><a href="info1.php?bm=<?php echo $_REQUEST['bm']; ?>"><i class="fas fa-chevron-right"></i> Thông Tin Cá Nhân</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Hướng Dẫn Sử Dụng</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Chính Sách Bảo Mật</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-section">
                <h4>Liên Hệ</h4>
                <div class="footer-contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Địa Chỉ</strong>
                        <span>123 Đường ABC, Quận XYZ, TP.HCM</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Điện Thoại</strong>
                        <span>0143.234.563 - ext 808</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <strong>Email</strong>
                        <span>csm@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <p>&copy; 2026 QLHV System - Trường Đại học Công nghiệp TPHCM. All rights reserved.</p>
        <div class="footer-bottom-links">
            <a href="#">Điều Khoản</a>
            <a href="#">Bảo Mật</a>
            <a href="#">Hỗ Trợ</a>
        </div>
    </div>
</div>

</div>

<script>
// Update current time
function updateTime() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    document.getElementById('currentTime').textContent = now.toLocaleDateString('vi-VN', options);
}
updateTime();
setInterval(updateTime, 1000);
</script>

</body>
</html>