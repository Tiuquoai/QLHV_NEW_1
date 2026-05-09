<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quan Ly Hoc Vu</title>
</head>

<body>
<?php
if(isset($_GET['fu'])){
    $ten = basename($_GET['fu']);
    $path = "file/" . $ten;
    
    if(!empty($ten) && file_exists($path)){
        $ext = strtolower(pathinfo($ten, PATHINFO_EXTENSION));
        $mimeTypes = array(
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt'  => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'zip'  => 'application/zip',
            'rar'  => 'application/x-rar-compressed',
            'txt'  => 'text/plain',
        );
        $contentType = isset($mimeTypes[$ext]) ? $mimeTypes[$ext] : 'application/octet-stream';
        
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=\"$ten\"");
        header("Content-Type: $contentType");
        header("Content-Length: " . filesize($path));
        header("Content-Transfer-Encoding: binary");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        
        ob_clean();
        flush();
        readfile($path);
        exit;
    }
    else{
        echo "Tap tin khong ton tai";
    }
}
?>
</body>
</html>