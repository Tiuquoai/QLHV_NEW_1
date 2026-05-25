<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Làm Bài Tập Trắc Nghiệm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; color: #333; }
        
        .exam-container { max-width: 900px; margin: 0 auto; padding: 20px; }
        
        /* Header */
        .exam-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 24px 30px;
            color: #fff;
            margin-bottom: 24px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        }
        
        .exam-header h1 { font-size: 24px; margin-bottom: 8px; }
        .exam-header p { opacity: 0.9; font-size: 14px; }
        
        /* Timer */
        .timer-box {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
        }
        
        .timer-box.warning { background: #ef4444; animation: pulse 1s infinite; }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Progress */
        .progress-info {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 16px;
            flex-wrap: wrap;
        }
        
        .progress-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        
        /* Question Card */
        .question-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 20px;
        }
        
        .question-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border-radius: 10px;
            font-weight: 700;
            margin-right: 12px;
        }
        
        .question-text {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a2e;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        
        /* Answer Options */
        .answer-option {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .answer-option:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }
        
        .answer-option.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }
        
        .answer-option .option-letter {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 8px;
            font-weight: 700;
            margin-right: 16px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        
        .answer-option.selected .option-letter {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        
        .answer-option .option-text {
            flex: 1;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .answer-option input[type="radio"] {
            display: none;
        }
        
        /* Navigation */
        .exam-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .nav-btn.prev { background: #f3f4f6; color: #374151; }
        .nav-btn.next { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; }
        .nav-btn.submit { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; }
        .nav-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        
        /* Result */
        .result-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 40px;
            text-align: center;
        }
        
        .result-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 60px;
        }
        
        .result-icon.excellent { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; }
        .result-icon.good { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: #fff; }
        .result-icon.average { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff; }
        .result-icon.poor { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: #fff; }
        
        .result-score {
            font-size: 72px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }
        
        .result-label { font-size: 18px; color: #6b7280; margin-bottom: 24px; }
        
        .result-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }
        
        .stat-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
        }
        
        .stat-item h4 { font-size: 32px; font-weight: 700; margin-bottom: 4px; }
        .stat-item p { font-size: 13px; color: #6b7280; }
        
        .stat-item.correct h4 { color: #10b981; }
        .stat-item.wrong h4 { color: #ef4444; }
        .stat-item.total h4 { color: #667eea; }
        
        /* Detail Results */
        .result-detail {
            text-align: left;
            margin-top: 32px;
        }
        
        .result-detail h3 {
            font-size: 18px;
            color: #1a1a2e;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .result-detail h3 i { color: #667eea; }
        
        .detail-item {
            padding: 16px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 12px;
            border-left: 4px solid;
        }
        
        .detail-item.correct { border-color: #10b981; background: #ecfdf5; }
        .detail-item.wrong { border-color: #ef4444; background: #fef2f2; }
        
        .detail-item h4 {
            font-size: 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-item.correct h4 { color: #059669; }
        .detail-item.wrong h4 { color: #dc2626; }
        
        .detail-item p { font-size: 13px; color: #6b7280; margin-bottom: 4px; }
        .detail-item p strong { color: #374151; }
        
        .detail-item .your-answer { color: #ef4444; }
        .detail-item .correct-answer { color: #10b981; }
        
        /* Alert */
        .alert {
            padding: 20px 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-warning { background: #fffbeb; color: #92400e; border: 2px solid #fcd34d; }
        .alert-info { background: #eff6ff; color: #1e40af; border: 2px solid #93c5fd; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .result-stats { grid-template-columns: 1fr; }
            .exam-header { position: relative; }
        }
    </style>
</head>
<body>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("Model/mTracNghiem.php");

$model = new TracNghiemModel();
$model->ketnoi();

$id_bttracnghiem = isset($_REQUEST['lambai']) ? $_REQUEST['lambai'] : 0;
$bm = isset($_REQUEST['bm']) ? $_REQUEST['bm'] : '';
$id_sinhvien = isset($_REQUEST['idsv']) ? $_REQUEST['idsv'] : 0;

// Lấy thông tin bài tập
$sql_bt = "SELECT * FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
$qr_bt = mysql_query($sql_bt);
$bai_tap = mysql_fetch_assoc($qr_bt);

// Kiểm tra đã nộp bài chưa
$sql_nop = "SELECT * FROM nopbai_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem' AND id_sinhvien = '$id_sinhvien'";
$qr_nop = mysql_query($sql_nop);
$da_nop = mysql_fetch_assoc($qr_nop);

// Xử lý nộp bài
if(isset($_POST['nop_bai'])) {
    $dap_an = $_POST['dap_an'];
    
    // Lấy đáp án đúng và tính điểm
    $sql_cauhoi = "SELECT * FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
    $qr_cauhoi = mysql_query($sql_cauhoi);
    
    $socaudung = 0;
    $tongcau = mysql_num_rows($qr_cauhoi);
    
    mysql_data_seek($qr_cauhoi, 0);
    while($cauhoi = mysql_fetch_assoc($qr_cauhoi)) {
        // Lấy đáp án đúng
        $sql_dung = "SELECT id_dapan FROM dapan_tracnghiem WHERE id_cauhoi = '".$cauhoi['id_cauhoi']."' AND ladapan_dung = 1";
        $qr_dung = mysql_query($sql_dung);
        $dong = mysql_fetch_assoc($qr_dung);
        
        $dapan_chon = isset($dap_an[$cauhoi['id_cauhoi']]) ? $dap_an[$cauhoi['id_cauhoi']] : 0;
        
        if($dapan_chon == $dong['id_dapan']) {
            $socaudung++;
        }
    }
    
    $diem = round($socaudung * $bai_tap['diemmotcau'], 2);
    $thoigian_nop = date('Y-m-d H:i:s');
    
    // Xóa bài cũ nếu có
    if($da_nop) {
        mysql_query("DELETE FROM chitiet_tracnghiem WHERE id_nopbai = '".$da_nop['id_nopbai']."'");
        mysql_query("DELETE FROM nopbai_tracnghiem WHERE id_nopbai = '".$da_nop['id_nopbai']."'");
    }
    
    // Thêm bài nộp mới
    $sql_them = "INSERT INTO nopbai_tracnghiem (id_bttracnghiem, id_sinhvien, diem, socautraloi_dung, thoigian_nop, trangthai) 
                 VALUES ('$id_bttracnghiem', '$id_sinhvien', '$diem', '$socaudung', '$thoigian_nop', 'daday')";
    mysql_query($sql_them);
    $id_nopbai = mysql_insert_id();
    
    // Lưu chi tiết
    mysql_data_seek($qr_cauhoi, 0);
    while($cauhoi = mysql_fetch_assoc($qr_cauhoi)) {
        $sql_dung = "SELECT id_dapan FROM dapan_tracnghiem WHERE id_cauhoi = '".$cauhoi['id_cauhoi']."' AND ladapan_dung = 1";
        $qr_dung = mysql_query($sql_dung);
        $dong = mysql_fetch_assoc($qr_dung);
        
        $dapan_chon = isset($dap_an[$cauhoi['id_cauhoi']]) ? $dap_an[$cauhoi['id_cauhoi']] : 0;
        $dung_sai = ($dapan_chon == $dong['id_dapan']) ? 1 : 0;
        
        mysql_query("INSERT INTO chitiet_tracnghiem (id_nopbai, id_cauhoi, id_dapan_chon, dung_sai) 
                     VALUES ('$id_nopbai', '".$cauhoi['id_cauhoi']."', '$dapan_chon', '$dung_sai')");
    }
    
    // Lấy lại kết quả để hiển thị
    $qr_nop = mysql_query($sql_nop);
    $da_nop = mysql_fetch_assoc($qr_nop);
    $show_result = true;
}

// Lấy danh sách câu hỏi
$sql_ds = "SELECT * FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem' ORDER BY id_cauhoi";
$qr_ds = mysql_query($sql_ds);
$tong_cau = mysql_num_rows($qr_ds);

// Kiểm tra thời gian
$now = time();
$deadline = strtotime($bai_tap['ketthucnop']);
$start = strtotime($bai_tap['batdaunop']);
$isExpired = $now > $deadline;
$isPending = $now < $start;
?>

<div class="exam-container">
    <?php if(isset($show_result) && $show_result): ?>
    <!-- KẾT QUẢ -->
    <?php 
    $diem = $da_nop['diem'];
    $socaudung = $da_nop['socautraloi_dung'];
    $tongcau = $tong_cau;
    
    // Xếp loại
    if($diem >= 9) { $result_class = 'excellent'; $result_text = 'Xuất sắc!'; }
    elseif($diem >= 7) { $result_class = 'good'; $result_text = 'Tốt lắm!'; }
    elseif($diem >= 5) { $result_class = 'average'; $result_text = 'Khá!'; }
    else { $result_class = 'poor'; $result_text = 'Cần cố gắng hơn!'; }
    ?>
    
    <div class="result-card">
        <div class="result-icon <?php echo $result_class; ?>">
            <?php if($result_class == 'excellent'): ?>
            <i class="fas fa-trophy"></i>
            <?php elseif($result_class == 'good'): ?>
            <i class="fas fa-star"></i>
            <?php elseif($result_class == 'average'): ?>
            <i class="fas fa-thumbs-up"></i>
            <?php else: ?>
            <i class="fas fa-book"></i>
            <?php endif; ?>
        </div>
        
        <div class="result-score"><?php echo $diem; ?></div>
        <div class="result-label"><?php echo $result_text; ?></div>
        
        <div class="result-stats">
            <div class="stat-item correct">
                <h4><?php echo $socaudung; ?></h4>
                <p>Câu đúng</p>
            </div>
            <div class="stat-item wrong">
                <h4><?php echo $tongcau - $socaudung; ?></h4>
                <p>Câu sai</p>
            </div>
            <div class="stat-item total">
                <h4><?php echo $tongcau; ?></h4>
                <p>Tổng câu</p>
            </div>
        </div>
        
        <div style="margin-top: 24px;">
            <a href="cths.php?bm=<?php echo $bm; ?>#bt" class="nav-btn submit">
                <i class="fas fa-home"></i> Quay Về Trang Chủ
            </a>
        </div>
        
        <!-- Chi tiết kết quả -->
        <div class="result-detail">
            <h3><i class="fas fa-list-check"></i> Chi Tiết Kết Quả</h3>
            <?php
            $sql_chitiet = "SELECT ct.*, ch.noidung as cauhoi, ch.dokho,
                            (SELECT noidung FROM dapan_tracnghiem WHERE id_cauhoi = ch.id_cauhoi AND ladapan_dung = 1) as dapan_dung
                            FROM chitiet_tracnghiem ct
                            JOIN cauhoi_tracnghiem ch ON ct.id_cauhoi = ch.id_cauhoi
                            WHERE ct.id_nopbai = '".$da_nop['id_nopbai']."'";
            $qr_chitiet = mysql_query($sql_chitiet);
            $stt = 1;
            while($ct = mysql_fetch_assoc($qr_chitiet)):
                $sql_da_chon = "SELECT noidung FROM dapan_tracnghiem WHERE id_dapan = '".$ct['id_dapan_chon']."'";
                $qr_da_chon = mysql_query($sql_da_chon);
                $da_chon = mysql_fetch_assoc($qr_da_chon);
            ?>
            <div class="detail-item <?php echo $ct['dung_sai'] ? 'correct' : 'wrong'; ?>">
                <h4>
                    <span style="background: <?php echo $ct['dung_sai'] ? '#10b981' : '#ef4444'; ?>; color: #fff; width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 14px;">
                        <?php echo $stt++; ?>
                    </span>
                    <?php echo $ct['cauhoi']; ?>
                </h4>
                <?php if($ct['dung_sai']): ?>
                <p><i class="fas fa-check-circle" style="color: #10b981;"></i> <strong>Đáp án đúng:</strong> <?php echo $ct['dapan_dung']; ?></p>
                <?php else: ?>
                <p><i class="fas fa-times-circle" style="color: #ef4444;"></i> <strong class="your-answer">Bạn chọn:</strong> <?php echo $da_chon ? $da_chon['noidung'] : 'Chưa trả lời'; ?></p>
                <p><i class="fas fa-check-circle" style="color: #10b981;"></i> <strong class="correct-answer">Đáp án đúng:</strong> <?php echo $ct['dapan_dung']; ?></p>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <?php elseif($isExpired): ?>
    <!-- HẾT HẠN -->
    <div class="result-card">
        <div class="result-icon poor">
            <i class="fas fa-clock"></i>
        </div>
        <h2 style="color: #dc2626; margin-bottom: 16px;">Đã Hết Hạn Nộp Bài</h2>
        <p style="color: #6b7280; margin-bottom: 24px;">Thời gian nộp bài đã kết thúc. Bạn không thể nộp bài được nữa.</p>
        <a href="cths.php?bm=<?php echo $bm; ?>#bt" class="nav-btn prev">
            <i class="fas fa-arrow-left"></i> Quay Về
        </a>
    </div>
    
    <?php elseif($isPending): ?>
    <!-- CHƯA MỞ -->
    <div class="result-card">
        <div class="result-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff;">
            <i class="fas fa-hourglass-half"></i>
        </div>
        <h2 style="color: #d97706; margin-bottom: 16px;">Bài Tập Chưa Mở</h2>
        <p style="color: #6b7280; margin-bottom: 16px;">Bài tập sẽ được mở vào: <strong><?php echo date('d/m/Y H:i', $start); ?></strong></p>
        <a href="cths.php?bm=<?php echo $bm; ?>#bt" class="nav-btn prev">
            <i class="fas fa-arrow-left"></i> Quay Về
        </a>
    </div>
    
    <?php elseif($tong_cau == 0): ?>
    <!-- CHƯA CÓ CÂU HỎI -->
    <div class="result-card">
        <div class="result-icon" style="background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: #fff;">
            <i class="fas fa-inbox"></i>
        </div>
        <h2 style="color: #6b7280; margin-bottom: 16px;">Bài Tập Đang Được Cập Nhật</h2>
        <p style="color: #6b7280; margin-bottom: 24px;">Giảng viên chưa thêm câu hỏi cho bài tập này.</p>
        <a href="cths.php?bm=<?php echo $bm; ?>#bt" class="nav-btn prev">
            <i class="fas fa-arrow-left"></i> Quay Về
        </a>
    </div>
    
    <?php elseif($da_nop): ?>
    <!-- ĐÃ NỘP - XEM LẠI -->
    <?php 
    $diem = $da_nop['diem'];
    $socaudung = $da_nop['socautraloi_dung'];
    $tongcau = $tong_cau;
    
    if($diem >= 9) { $result_class = 'excellent'; $result_text = 'Xuất sắc!'; }
    elseif($diem >= 7) { $result_class = 'good'; $result_text = 'Tốt lắm!'; }
    elseif($diem >= 5) { $result_class = 'average'; $result_text = 'Khá!'; }
    else { $result_class = 'poor'; $result_text = 'Cần cố gắng hơn!'; }
    ?>
    
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <span>Bạn đã nộp bài này rồi. Thời gian nộp: <?php echo date('d/m/Y H:i', strtotime($da_nop['thoigian_nop'])); ?></span>
    </div>
    
    <div class="result-card">
        <div class="result-icon <?php echo $result_class; ?>">
            <?php if($result_class == 'excellent'): ?>
            <i class="fas fa-trophy"></i>
            <?php elseif($result_class == 'good'): ?>
            <i class="fas fa-star"></i>
            <?php elseif($result_class == 'average'): ?>
            <i class="fas fa-thumbs-up"></i>
            <?php else: ?>
            <i class="fas fa-book"></i>
            <?php endif; ?>
        </div>
        
        <div class="result-score"><?php echo $diem; ?></div>
        <div class="result-label"><?php echo $result_text; ?></div>
        
        <div class="result-stats">
            <div class="stat-item correct">
                <h4><?php echo $socaudung; ?></h4>
                <p>Câu đúng</p>
            </div>
            <div class="stat-item wrong">
                <h4><?php echo $tongcau - $socaudung; ?></h4>
                <p>Câu sai</p>
            </div>
            <div class="stat-item total">
                <h4><?php echo $tongcau; ?></h4>
                <p>Tổng câu</p>
            </div>
        </div>
        
        <div style="margin-top: 24px;">
            <a href="cths.php?bm=<?php echo $bm; ?>#bt" class="nav-btn submit">
                <i class="fas fa-home"></i> Quay Về Trang Chủ
            </a>
        </div>
    </div>
    
    <?php else: ?>
    <!-- LÀM BÀI -->
    <form action="" method="POST" id="examForm">
        <div class="exam-header">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
                <div>
                    <h1><i class="fas fa-pencil-alt"></i> <?php echo $bai_tap['tieude']; ?></h1>
                    <p><?php echo $bai_tap['mota'] ? $bai_tap['mota'] : 'Làm bài ngay để đạt kết quả tốt nhất!'; ?></p>
                </div>
                <div class="timer-box" id="timerBox">
                    <i class="fas fa-clock"></i>
                    <span id="timer"><?php echo $bai_tap['thoigianlambai']; ?>:00</span>
                </div>
            </div>
            
            <div class="progress-info">
                <div class="progress-item">
                    <i class="fas fa-question-circle"></i>
                    <span><?php echo $tong_cau; ?> câu hỏi</span>
                </div>
                <div class="progress-item">
                    <i class="fas fa-star"></i>
                    <span>Điểm tối đa: <?php echo $tong_cau * $bai_tap['diemmotcau']; ?></span>
                </div>
                <div class="progress-item">
                    <i class="fas fa-bullseye"></i>
                    <span><?php echo $bai_tap['diemmotcau']; ?> điểm/câu</span>
                </div>
            </div>
        </div>
        
        <?php $stt = 1; while($cauhoi = mysql_fetch_assoc($qr_ds)): ?>
        <?php
            // Lấy đáp án
            $sql_da = "SELECT * FROM dapan_tracnghiem WHERE id_cauhoi = '".$cauhoi['id_cauhoi']."'";
            $qr_da = mysql_query($sql_da);
        ?>
        <div class="question-card" id="question-<?php echo $cauhoi['id_cauhoi']; ?>">
            <div class="question-text">
                <span class="question-number"><?php echo $stt++; ?></span>
                <?php echo $cauhoi['noidung']; ?>
            </div>
            
            <div class="answers-list">
                <?php 
                $labels = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                $idx = 0;
                while($dapan = mysql_fetch_assoc($qr_da)): 
                ?>
                <label class="answer-option" onclick="selectAnswer(this, <?php echo $cauhoi['id_cauhoi']; ?>, <?php echo $dapan['id_dapan']; ?>)">
                    <input type="radio" name="dap_an[<?php echo $cauhoi['id_cauhoi']; ?>]" value="<?php echo $dapan['id_dapan']; ?>" required>
                    <span class="option-letter"><?php echo $labels[$idx]; ?></span>
                    <span class="option-text"><?php echo $dapan['noidung']; ?></span>
                </label>
                <?php $idx++; endwhile; ?>
            </div>
        </div>
        <?php endwhile; ?>
        
        <div class="exam-nav">
            <a href="cths.php?bm=<?php echo $bm; ?>#bt" class="nav-btn prev">
                <i class="fas fa-arrow-left"></i> Quay Về
            </a>
            <button type="submit" name="nop_bai" class="nav-btn submit" onclick="return confirm('Bạn có chắc muốn nộp bài?');">
                <i class="fas fa-paper-plane"></i> Nộp Bài
            </button>
        </div>
    </form>
    <?php endif; ?>
</div>

<script>
// Timer
let timeLeft = <?php echo $bai_tap['thoigianlambai'] * 60; ?>;
const timerBox = document.getElementById('timerBox');

function updateTimer() {
    if(timeLeft <= 0) {
        document.getElementById('examForm').submit();
        return;
    }
    
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    document.getElementById('timer').textContent = 
        (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    
    if(timeLeft <= 300) {
        timerBox.classList.add('warning');
    }
    
    timeLeft--;
}

setInterval(updateTimer, 1000);

// Select answer
function selectAnswer(element, questionId, answerId) {
    // Remove selected from all options in this question
    const parent = element.parentElement;
    const options = parent.querySelectorAll('.answer-option');
    options.forEach(opt => opt.classList.remove('selected'));
    
    // Add selected to clicked option
    element.classList.add('selected');
    
    // Check radio
    const radio = element.querySelector('input[type="radio"]');
    radio.checked = true;
}
</script>

<?php $model->dongketnoi(); ?>
</body>
</html>
