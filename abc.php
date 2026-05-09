<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<?php
if(isset($_REQUEST['xf'])){
include('PHPExcel/Classes/PHPExcel.php');
include('PHPExcel/Classes/PHPExcel/IOFactory.php');
$objPHPExcel= new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'STT')
->setCellValue('B1', 'MSSV')
->setCellValue('C1', 'Họ Và Tên')
->setCellValue('D1', 'Lớp')
->setCellValue('E1', 'TK1')
->setCellValue('F1', 'TK2')
->setCellValue('G1', 'TK3')
->setCellValue('H1', 'GK')
->setCellValue('I1', 'TH1')
->setCellValue('J1', 'TH2')
->setCellValue('K1', 'TH3')
->setCellValue('L1', 'CK');

include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$p->ketnoi($ketnoi);
$il=$_REQUEST['il'];
$ihp=$_REQUEST['ihp'];
$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
join giangvien gv on d.id_giangvien=gv.id_giangvien
where md5(m.id_hocphan)='$ihp'
and m.id_lophocphan='$il'";
$qr=mysql_query($sql);

$sql1="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
join giangvien gv on d.id_giangvien=gv.id_giangvien join lophocphan l on l.id_lophocphan=m.id_lophocphan
where md5(m.id_hocphan)='$ihp'
and m.id_lophocphan='$il'";
$qr1=mysql_query($sql1);

 $key = 2;
 $a=1;
 while($ft = mysql_fetch_assoc($qr)) {

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$key, $a++)
            ->setCellValue('B'.$key, $ft['masosinhvien'])
            ->setCellValue('C'.$key, $ft['tensinhvien'])
            ->setCellValue('D'.$key, $ft['lopCN']);
            $key ++;
 }
 $a++;

$d = mysql_fetch_assoc($qr1);

  $objPHPExcel->getActiveSheet()->setTitle("Danh Sách Sinh Viên");
  $objWriter =  PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DSSV.'.$d['tenhocphan'].'.'.$d['tenlophocphan'].'.xlsx');
    header('Cache-Control: max-age=0');

    ob_end_clean();
    $objWriter->save('php://output');
    exit;

}

?>
</body>
</html>
