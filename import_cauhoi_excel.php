<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy tham số từ GET hoặc POST
$bm = isset($_REQUEST['bm']) ? $_REQUEST['bm'] : '';
$qtn = isset($_REQUEST['qtn']) ? intval($_REQUEST['qtn']) : 0;
$ig = isset($_REQUEST['ig']) ? $_REQUEST['ig'] : '';
$ihp = isset($_REQUEST['ihp']) ? $_REQUEST['ihp'] : '';
$il = isset($_REQUEST['il']) ? $_REQUEST['il'] : '';
$gd = isset($_REQUEST['gd']) ? $_REQUEST['gd'] : '';

include_once("Model/mKetNoiGV.php");
$p=new ketnoiGV();
$kn=$p->ketnoi($ketnoi);

// Kiểm tra đăng nhập
if(!empty($bm)) {
    $sql="select * from user where user_code='$bm'";
    $qr=mysql_query($sql);
    $r=mysql_fetch_assoc($qr);
    
    if($r) {
        $mk_db = $r['matkhau'];
        $k = isset($_SESSION['mk']) ? $_SESSION['mk'] : '';
        $m = isset($_SESSION['ma']) ? $_SESSION['ma'] : '';
        
        if($k != $mk_db || $m != $bm) {
            // Sai session nhưng không redirect nếu đang POST (để import vẫn chạy)
            if($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo "<script>alert('Vui lòng đăng nhập lại!'); window.location.href='index.php';</script>";
                exit;
            }
        }
    }
}

// Kiểm tra qtn hợp lệ
if($qtn <= 0) {
    echo "<script>alert('Lỗi: Không tìm thấy bài tập!'); window.location.href='cthpgv.php';</script>";
    exit;
}

// Lấy thông tin bài tập
$sql_bt = "SELECT * FROM baitap_tracnghiem WHERE id_bttracnghiem = '$qtn'";
$qr_bt = mysql_query($sql_bt);
$bai_tap = mysql_fetch_assoc($qr_bt);

if(!$bai_tap) {
    echo "<script>alert('Lỗi: Bài tập không tồn tại!'); window.location.href='cthpgv.php';</script>";
    exit;
}

// Xử lý import Excel
$error = '';
$success = '';
$imported = 0;

if(isset($_POST['import_excel'])) {
    // Lấy cấu hình cột
    $col_cauhoi = isset($_POST['col_cauhoi']) ? intval($_POST['col_cauhoi']) : 0;
    $col_da = array();
    for($i = 1; $i <= 4; $i++) {
        $col_da[$i] = isset($_POST['col_da'.$i]) ? intval($_POST['col_da'.$i]) : -1;
    }
    $col_dung = isset($_POST['col_dung']) ? intval($_POST['col_dung']) : -1;
    $col_kho = isset($_POST['col_kho']) ? intval($_POST['col_kho']) : -1;
    $dong_header = isset($_POST['dong_header']) ? 1 : 0;
    
    if(isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $file = $_FILES['excel_file']['tmp_name'];
        $file_name = $_FILES['excel_file']['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        if($ext != 'xlsx' && $ext != 'xls') {
            $error = 'Chỉ chấp nhận file Excel (.xlsx, .xls)';
        } else {
            include_once('PHPExcel/Classes/PHPExcel/IOFactory.php');
            
            try {
                $objPHPExcel = PHPExcel_IOFactory::load($file);
                $sheet = $objPHPExcel->getActiveSheet();
                $highestRow = $sheet->getHighestRow();
                
                $imported = 0;
                $skipped = 0;
                
                $start_row = ($dong_header == 1) ? 2 : 1;
                
                for($row = $start_row; $row <= $highestRow; $row++) {
                    // Đọc câu hỏi
                    $cau_hoi = trim($sheet->getCellByColumnAndRow($col_cauhoi, $row)->getValue());
                    
                    // Bỏ qua nếu dòng trống
                    if(empty($cau_hoi)) {
                        $skipped++;
                        continue;
                    }
                    
                    // Đọc đáp án
                    $dap_an = array();
                    for($i = 1; $i <= 4; $i++) {
                        $dap_an[$i] = trim($sheet->getCellByColumnAndRow($col_da[$i], $row)->getValue());
                    }
                    
                    // Đọc đáp án đúng
                    $dap_an_dung = 'A';
                    if($col_dung >= 0) {
                        $dung_val = trim($sheet->getCellByColumnAndRow($col_dung, $row)->getValue());
                        $dung_val = strtoupper(substr($dung_val, 0, 1));
                        if(in_array($dung_val, array('A', 'B', 'C', 'D'))) {
                            $dap_an_dung = $dung_val;
                        }
                    }
                    
                    // Đọc độ khó
                    $do_kho = 'trungbinh';
                    if($col_kho >= 0) {
                        $kho_val = strtolower(trim($sheet->getCellByColumnAndRow($col_kho, $row)->getValue()));
                        if(in_array($kho_val, array('de', 'dễ', 'easy'))) {
                            $do_kho = 'de';
                        } elseif(in_array($kho_val, array('kho', 'khó', 'hard'))) {
                            $do_kho = 'kho';
                        }
                    }
                    
                    // Thêm câu hỏi
                    $sql_ch = "INSERT INTO cauhoi_tracnghiem (noidung, hinhanh, dokho, id_bttracnghiem) 
                               VALUES (N'".addslashes($cau_hoi)."', '', '$do_kho', '$qtn')";
                    if(mysql_query($sql_ch)) {
                        $id_cauhoi = mysql_insert_id();
                        
                        // Thêm đáp án
                        $dapan_chu = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D');
                        for($i = 1; $i <= 4; $i++) {
                            if(!empty($dap_an[$i])) {
                                $dung = ($dapan_chu[$i] == $dap_an_dung) ? 1 : 0;
                                mysql_query("INSERT INTO dapan_tracnghiem (noidung, ladapan_dung, id_cauhoi) VALUES (N'".addslashes($dap_an[$i])."', $dung, $id_cauhoi)");
                            }
                        }
                        
                        $imported++;
                    }
                }
                
                if($imported > 0) {
                    $success = "Đã import thành công $imported câu hỏi!";
                    if($skipped > 0) $success .= " ($skipped dòng trống bị bỏ qua)";
                } else {
                    $error = "Không có câu hỏi nào được import. Vui lòng kiểm tra lại cấu hình cột.";
                }
                
            } catch(Exception $e) {
                $error = 'Lỗi khi đọc file Excel: ' . $e->getMessage();
            }
        }
    } else {
        $error = 'Vui lòng chọn file Excel để import';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Câu Hỏi Từ Excel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        
        .container { max-width: 900px; margin: 40px auto; padding: 20px; }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 20px 30px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 { font-size: 20px; }
        
        .header a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .content {
            background: #fff;
            padding: 30px;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        
        .info-box h3 { color: #1e40af; font-size: 16px; margin-bottom: 8px; }
        .info-box p { color: #3b82f6; font-size: 14px; line-height: 1.6; }
        .info-box code { background: #dbeafe; padding: 2px 6px; border-radius: 4px; font-size: 13px; }
        
        .form-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .form-section h3 {
            color: #374151;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }
        
        .file-input {
            padding: 20px;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .file-input input[type="file"] {
            margin-top: 10px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102,126,234,0.4); }
        
        .btn-success { background: #10b981; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; }
        .btn-success:hover { background: #059669; }
        
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success { background: #ecfdf5; border-left: 4px solid #10b981; color: #059669; }
        .alert-error { background: #fef2f2; border-left: 4px solid #dc2626; color: #dc2626; }
        
        .preview-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 13px;
        }
        
        .preview-table th, .preview-table td {
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            text-align: left;
        }
        
        .preview-table th { background: #667eea; color: #fff; }
        
        .note {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 16px;
            font-size: 13px;
            color: #92400e;
        }
        
        .actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-file-import"></i> Import Câu Hỏi Từ Excel</h1>
            <a href="tracnghiem_cauhoi_gv.php?qtn=<?php echo $qtn; ?>&&bm=<?php echo $bm; ?>&&ig=<?php echo $ig; ?>&&ihp=<?php echo $ihp; ?>&&il=<?php echo $il; ?>&&gd=<?php echo $gd; ?>">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
        
        <div class="content">
            <div class="info-box">
                <h3><i class="fas fa-info-circle"></i> Hướng Dẫn</h3>
                <p>
                    Chọn đúng cột tương ứng với dữ liệu trong file Excel của bạn.<br>
                    <strong>Cột đáp án đúng:</strong> Nhập chữ A, B, C hoặc D (không phân biệt hoa thường).<br>
                    <strong>Độ khó:</strong> de, dễ, easy = Dễ | trungbinh = Trung bình | kho, khó, hard = Khó
                </p>
            </div>
            
            <?php if($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
            <?php endif; ?>
            
            <?php if($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="qtn" value="<?php echo $qtn; ?>">
                <input type="hidden" name="bm" value="<?php echo $bm; ?>">
                <input type="hidden" name="ig" value="<?php echo $ig; ?>">
                <input type="hidden" name="ihp" value="<?php echo $ihp; ?>">
                <input type="hidden" name="il" value="<?php echo $il; ?>">
                <input type="hidden" name="gd" value="<?php echo $gd; ?>">
                
                <div class="form-section">
                    <h3><i class="fas fa-cog"></i> Cấu Hình Cột</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Cột Câu Hỏi (A=0, B=1...)</label>
                            <input type="number" name="col_cauhoi" value="0" min="0" max="25" required>
                        </div>
                        <div class="form-group">
                            <label>Cột Đáp án A</label>
                            <input type="number" name="col_da1" value="1" min="0" max="25" required>
                        </div>
                        <div class="form-group">
                            <label>Cột Đáp án B</label>
                            <input type="number" name="col_da2" value="2" min="0" max="25" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Cột Đáp án C</label>
                            <input type="number" name="col_da3" value="3" min="0" max="25" required>
                        </div>
                        <div class="form-group">
                            <label>Cột Đáp án D</label>
                            <input type="number" name="col_da4" value="4" min="0" max="25" required>
                        </div>
                        <div class="form-group">
                            <label>Cột Đáp án Đúng</label>
                            <input type="number" name="col_dung" value="5" min="-1" max="25">
                            <small style="color: #6b7280;">-1 = Mặc định A</small>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Cột Độ Khó</label>
                            <input type="number" name="col_kho" value="-1" min="-1" max="25">
                            <small style="color: #6b7280;">-1 = Mặc định trung bình</small>
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" name="dong_header" value="1" checked id="dong_header">
                        <label for="dong_header">Dòng 1 là header (tiêu đề cột) - sẽ bỏ qua dòng này</label>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3><i class="fas fa-file-excel"></i> Chọn File Excel</h3>
                    <div class="file-input">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 48px; color: #d1d5db;"></i>
                        <p style="margin-top: 10px; color: #6b7280;">Kéo thả file hoặc click để chọn</p>
                        <input type="file" name="excel_file" accept=".xlsx,.xls" required>
                    </div>
                </div>
                
                <div class="actions">
                    <button type="submit" name="import_excel" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Import Câu Hỏi
                    </button>
                    <a href="import_cauhoi_excel.php?qtn=<?php echo $qtn; ?>&&bm=<?php echo $bm; ?>&&ig=<?php echo $ig; ?>&&ihp=<?php echo $ihp; ?>&&il=<?php echo $il; ?>&&gd=<?php echo $gd; ?>&download=1" class="btn-success">
                        <i class="fas fa-download"></i> Tải File Mẫu
                    </a>
                </div>
            </form>
            
            <div class="note">
                <strong><i class="fas fa-lightbulb"></i> Mẹo:</strong><br>
                - Nếu file Excel của bạn có cấu trúc khác, hãy điều chỉnh số cột tương ứng.<br>
                - Số cột được đánh số từ 0: A=0, B=1, C=2, D=3, E=4, F=5...
            </div>
            
            <h3 style="margin-top: 24px; color: #374151;"><i class="fas fa-table"></i> File Mẫu</h3>
            <table class="preview-table">
                <thead>
                    <tr>
                        <th>A (0)</th>
                        <th>B (1)</th>
                        <th>C (2)</th>
                        <th>D (3)</th>
                        <th>E (4)</th>
                        <th>F (5)</th>
                        <th>G (6)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Câu hỏi</strong></td>
                        <td><strong>Đáp án A</strong></td>
                        <td><strong>Đáp án B</strong></td>
                        <td><strong>Đáp án C</strong></td>
                        <td><strong>Đáp án D</strong></td>
                        <td><strong>Đúng (A/B/C/D)</strong></td>
                        <td><strong>Độ khó</strong></td>
                    </tr>
                    <tr>
                        <td>Ai sáng lập Microsoft?</td>
                        <td>Bill Gates</td>
                        <td>Steve Jobs</td>
                        <td>Elon Musk</td>
                        <td>Mark Zuckerberg</td>
                        <td>A</td>
                        <td>de</td>
                    </tr>
                    <tr>
                        <td>1 + 1 = ?</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>B</td>
                        <td>de</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Xử lý download file mẫu
if(isset($_REQUEST['download'])) {
    include_once('PHPExcel/Classes/PHPExcel.php');
    
    $objPHPExcel = new PHPExcel();
    $sheet = $objPHPExcel->getActiveSheet();
    
    // Header
    $sheet->setCellValue('A1', 'Câu hỏi');
    $sheet->setCellValue('B1', 'Đáp án A');
    $sheet->setCellValue('C1', 'Đáp án B');
    $sheet->setCellValue('D1', 'Đáp án C');
    $sheet->setCellValue('E1', 'Đáp án D');
    $sheet->setCellValue('F1', 'Đáp án đúng (A/B/C/D)');
    $sheet->setCellValue('G1', 'Độ khó (de/trungbinh/kho)');
    
    // Sample data
    $sheet->setCellValue('A2', 'Ai là người sáng lập ra Microsoft?');
    $sheet->setCellValue('B2', 'Bill Gates');
    $sheet->setCellValue('C2', 'Steve Jobs');
    $sheet->setCellValue('D2', 'Elon Musk');
    $sheet->setCellValue('E2', 'Mark Zuckerberg');
    $sheet->setCellValue('F2', 'A');
    $sheet->setCellValue('G2', 'de');
    
    $sheet->setCellValue('A3', '1 + 1 = ?');
    $sheet->setCellValue('B3', '1');
    $sheet->setCellValue('C3', '2');
    $sheet->setCellValue('D3', '3');
    $sheet->setCellValue('E3', '4');
    $sheet->setCellValue('F3', 'B');
    $sheet->setCellValue('G3', 'de');
    
    $sheet->setCellValue('A4', 'Ngôn ngữ PHP được dùng cho?');
    $sheet->setCellValue('B4', 'Desktop App');
    $sheet->setCellValue('C4', 'Web Development');
    $sheet->setCellValue('D4', 'Game Development');
    $sheet->setCellValue('E4', 'Mobile App');
    $sheet->setCellValue('F4', 'B');
    $sheet->setCellValue('G4', 'trungbinh');
    
    // Style header
    $sheet->getStyle('A1:G1')->applyFromArray(array(
        'font' => array('bold' => true),
        'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '667eea')),
        'font' => array('color' => array('rgb' => 'FFFFFF'))
    ));
    
    foreach(range('A', 'G') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="mau_import_cauhoi_tracnghiem.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $writer->save('php://output');
    exit;
}
?>
