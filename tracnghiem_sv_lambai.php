<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

if(!isset($_REQUEST['bm'])){
    echo header("refresh:0,url='index.php'");
    exit;
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
    exit;
}

$qtn = isset($_REQUEST['qtn']) ? intval($_REQUEST['qtn']) : 0;
$is = isset($_REQUEST['is']) ? $_REQUEST['is'] : '';
$bm = isset($_REQUEST['bm']) ? $_REQUEST['bm'] : '';
$ihp = isset($_REQUEST['ihp']) ? $_REQUEST['ihp'] : '';
$il = isset($_REQUEST['il']) ? $_REQUEST['il'] : '';
$xem = isset($_REQUEST['xem']) ? true : false;

// Lấy thông tin bài tập
$sql_bt = "SELECT * FROM baitap_tracnghiem WHERE id_bttracnghiem = '$qtn'";
$qr_bt = mysql_query($sql_bt);
$bai_tap = mysql_fetch_assoc($qr_bt);

// Kiểm tra thời gian
$now = date('Y-m-d H:i:s');
$batdau = $bai_tap['batdaunop'];
$ketthuc = $bai_tap['ketthucnop'];
$isExpired = $now > $ketthuc;
$isPending = $now < $batdau;

// Kiểm tra đã nộp chưa
$sql_nop = "SELECT * FROM nopbai_tracnghiem WHERE id_sinhvien = '$is' AND id_bttracnghiem = '$qtn'";
$qr_nop = mysql_query($sql_nop);
$da_nop = mysql_num_rows($qr_nop) > 0;
$baida = $da_nop ? mysql_fetch_assoc($qr_nop) : null;

// Xác định có đang làm bài hay không
$dang_lam_bai = !$da_nop && !$isExpired && !$isPending && !$xem;

// Tính thời gian còn lại
$thoigian_conlai = 0;
if($dang_lam_bai) {
    $time_ketthuc = strtotime($ketthuc);
    $time_now = time();
    $thoigian_conlai = max(0, $time_ketthuc - $time_now);
}

// XỬ LÝ NỘP BÀI - Chỉ khi POST có nop_bai và chưa nộp
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nop_bai']) && !$da_nop) {
    // Tạo bản ghi nộp bài
    $sql_insert_nop = "INSERT INTO nopbai_tracnghiem (id_bttracnghiem, id_sinhvien, diem, socautraloi_dung, thoigian_nop, trangthai) 
                        VALUES ('$qtn', '$is', 0, 0, NOW(), 'daday')";
    mysql_query($sql_insert_nop);
    $id_nopbai = mysql_insert_id();
    
    $socaudung = 0;
    $tongdiem = 0;
    
    // Lưu từng câu trả lời và chấm điểm
    foreach($_POST as $key => $value) {
        if(substr($key, 0, 4) == 'cau_') {
            $id_cauhoi = intval(substr($key, 4));
            $id_dapan = intval($value);
            
            // Kiểm tra đáp án đúng
            $sql_check = "SELECT * FROM dapan_tracnghiem WHERE id_dapan = '$id_dapan' AND ladapan_dung = 1";
            $qr_check = mysql_query($sql_check);
            $dung = mysql_num_rows($qr_check) > 0;
            
            if($dung) {
                $socaudung++;
                $tongdiem += $bai_tap['diemmotcau'];
            }
            
            $dung_sai = $dung ? 1 : 0;
            mysql_query("INSERT INTO chitiet_tracnghiem (id_nopbai, id_cauhoi, id_dapan_chon, dung_sai) 
                        VALUES ('$id_nopbai', '$id_cauhoi', '$id_dapan', '$dung_sai')");
        }
    }
    
    mysql_query("UPDATE nopbai_tracnghiem SET socautraloi_dung = '$socaudung', diem = '$tongdiem' WHERE id_nopbai = '$id_nopbai'");
    
    // Chuyển về trang kết quả
    header("Location: tracnghiem_sv_lambai.php?bm=$bm&is=$is&ihp=$ihp&il=$il&qtn=$qtn&xem=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Làm Bài Trắc Nghiệm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        
        .header-bar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 16px 24px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .header-bar h2 {
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .timer-box {
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 700;
        }
        
        .timer-box.warning { background: #dc2626; animation: pulse 1s infinite; }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .main-container {
            max-width: 900px;
            margin: 80px auto 20px;
            padding: 20px;
        }
        
        .quiz-info {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        
        .quiz-info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6b7280;
        }
        
        .quiz-info-item i { color: #667eea; }
        
        .question-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .question-header {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .question-number {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .question-text {
            flex: 1;
            font-size: 16px;
            line-height: 1.6;
            color: #1a1a2e;
        }
        
        .answer-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-left: 48px;
        }
        
        .answer-option {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .answer-option:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }
        
        .answer-option.selected {
            border-color: #667eea;
            background: #eef2ff;
        }
        
        .answer-option.correct {
            border-color: #10b981;
            background: #ecfdf5;
        }
        
        .answer-option.incorrect {
            border-color: #dc2626;
            background: #fef2f2;
        }
        
        .answer-option.disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }
        
        .answer-radio {
            width: 22px;
            height: 22px;
            margin-right: 14px;
            cursor: pointer;
            accent-color: #667eea;
        }
        
        .answer-label {
            flex: 1;
            cursor: pointer;
            font-size: 15px;
        }
        
        .answer-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
        }
        
        .answer-icon.correct { background: #10b981; color: #fff; }
        .answer-icon.incorrect { background: #dc2626; color: #fff; }
        
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 20px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102,126,234,0.4); }
        .btn-success { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(16,185,129,0.4); }
        .btn-secondary { background: #6b7280; color: #fff; }
        .btn-secondary:hover { transform: translateY(-2px); }
        
        .progress-bar {
            background: #fff;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .progress-info {
            font-size: 14px;
            color: #6b7280;
            white-space: nowrap;
        }
        
        .progress-track {
            flex: 1;
            height: 10px;
            background: #e5e7eb;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 5px;
            transition: width 0.3s ease;
        }
        
        .result-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .result-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }
        
        .result-icon.success { background: #ecfdf5; color: #10b981; }
        .result-icon.info { background: #eff6ff; color: #2563eb; }
        
        .result-score {
            font-size: 48px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }
        
        .result-label {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 24px;
        }
        
        .result-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }
        
        .stat-box {
            background: #f8fafc;
            padding: 16px;
            border-radius: 12px;
        }
        
        .stat-box h4 { font-size: 24px; color: #1a1a2e; margin-bottom: 4px; }
        .stat-box p { font-size: 13px; color: #6b7280; }
        
        .locked-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .locked-content {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
        }
        
        .locked-content i { font-size: 48px; color: #dc2626; margin-bottom: 16px; }
        .locked-content h3 { margin-bottom: 12px; color: #1a1a2e; }
        .locked-content p { color: #6b7280; margin-bottom: 20px; }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #6b7280;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>
<?php if($isPending): ?>
<div class="locked-overlay">
    <div class="locked-content">
        <i class="fas fa-hourglass-half"></i>
        <h3>Chưa Đến Giờ Làm Bài</h3>
        <p>Bài kiểm tra sẽ mở lúc: <strong><?php echo date('d/m/Y H:i', strtotime($batdau)); ?></strong></p>
        <a href="ctmonhoc.php?bm=<?php echo $bm; ?>&is=<?php echo $is; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&tn" class="btn-back">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
</div>
<?php elseif(($isExpired && !$da_nop)): ?>
<div class="locked-overlay">
    <div class="locked-content">
        <i class="fas fa-clock"></i>
        <h3>Đã Hết Giờ Làm Bài</h3>
        <p>Thời gian làm bài đã kết thúc lúc: <strong><?php echo date('d/m/Y H:i', strtotime($ketthuc)); ?></strong></p>
        <a href="ctmonhoc.php?bm=<?php echo $bm; ?>&is=<?php echo $is; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&tn" class="btn-back">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
</div>
<?php else: ?>

<div class="header-bar">
    <h2><i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($bai_tap['tieude']); ?></h2>
    <?php if($dang_lam_bai): ?>
    <div class="timer-box" id="timerBox">
        <i class="fas fa-clock"></i>
        <span id="timerDisplay"><?php echo gmdate('H:i:s', $thoigian_conlai); ?></span>
    </div>
    <?php endif; ?>
</div>

<div class="main-container">
    <?php if($da_nop || $xem): ?>
    <!-- HIEN THI KET QUA -->
    <?php
    $sql_ch = "SELECT * FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$qtn'";
    $qr_ch = mysql_query($sql_ch);
    $tong_cau = mysql_num_rows($qr_ch);
    $diem = $baida['diem'];
    $socaudung = $baida['socautraloi_dung'];
    ?>
    <div class="result-card">
        <div class="result-icon info">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 style="margin-bottom: 8px;">Kết Quả Bài Làm</h2>
        <div class="result-score"><?php echo $diem; ?> điểm</div>
        <div class="result-label">Điểm tối đa: <?php echo $bai_tap['soluongcauhoi'] * $bai_tap['diemmotcau']; ?> điểm</div>
        
        <div class="result-stats">
            <div class="stat-box">
                <h4><?php echo $socaudung; ?></h4>
                <p>Câu Đúng</p>
            </div>
            <div class="stat-box">
                <h4><?php echo $tong_cau - $socaudung; ?></h4>
                <p>Câu Sai</p>
            </div>
            <div class="stat-box">
                <h4><?php echo $tong_cau; ?></h4>
                <p>Tổng Câu</p>
            </div>
        </div>
        
        <a href="ctmonhoc.php?bm=<?php echo $bm; ?>&is=<?php echo $is; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&tnhistory" class="btn btn-primary" style="text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>
    <?php endif; ?>

    <?php
    // Lấy câu hỏi
    $sql_cauhoi = "SELECT * FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$qtn' ORDER BY RAND() LIMIT ".$bai_tap['soluongcauhoi'];
    $qr_cauhoi = mysql_query($sql_cauhoi);
    $cau_hoi = array();
    while($ch = mysql_fetch_assoc($qr_cauhoi)) {
        $sql_da = "SELECT * FROM dapan_tracnghiem WHERE id_cauhoi = '".$ch['id_cauhoi']."' ORDER BY RAND()";
        $qr_da = mysql_query($sql_da);
        $ch['dap_an'] = array();
        while($da = mysql_fetch_assoc($qr_da)) {
            $ch['dap_an'][] = $da;
        }
        $cau_hoi[] = $ch;
    }
    
    // Lấy đáp án đã chọn nếu đã nộp
    $dap_an_da_chon = array();
    if($da_nop) {
        $sql_ct = "SELECT * FROM chitiet_tracnghiem WHERE id_nopbai = '".$baida['id_nopbai']."'";
        $qr_ct = mysql_query($sql_ct);
        while($ct = mysql_fetch_assoc($qr_ct)) {
            $dap_an_da_chon[$ct['id_cauhoi']] = $ct['id_dapan_chon'];
        }
    }
    ?>
    
    <?php if($dang_lam_bai): ?>
    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-info">
            <span id="answeredCount">0</span> / <?php echo count($cau_hoi); ?> câu đã trả lời
        </div>
        <div class="progress-track">
            <div class="progress-fill" id="progressFill" style="width: 0%"></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Questions -->
    <form action="" method="POST" id="quizForm">
        <?php foreach($cau_hoi as $index => $cau): ?>
        <div class="question-card" id="question-<?php echo $index; ?>">
            <div class="question-header">
                <div class="question-number"><?php echo $index + 1; ?></div>
                <div class="question-text"><?php echo htmlspecialchars($cau['noidung']); ?></div>
            </div>
            
            <div class="answer-options">
                <?php 
                $labels = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
                $da_chon = isset($dap_an_da_chon[$cau['id_cauhoi']]) ? $dap_an_da_chon[$cau['id_cauhoi']] : null;
                
                foreach($cau['dap_an'] as $idx => $da): 
                    $is_selected = ($da_chon == $da['id_dapan']);
                    $is_correct = $da['ladapan_dung'];
                    
                    $class = 'answer-option';
                    $your_choice = '';
                    if($da_nop || $xem) {
                        if($is_correct) $class .= ' correct';
                        elseif($is_selected) $class .= ' incorrect';
                        if($is_selected) $your_choice = '<span style="background: #3b82f6; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 10px; margin-left: 8px;">Đáp án của bạn</span>';
                    } elseif($is_selected) {
                        $class .= ' selected';
                    }
                ?>
                <div class="<?php echo $class; ?>" onclick="<?php echo ($dang_lam_bai) ? "selectAnswer(".$cau['id_cauhoi'].", ".$da['id_dapan'].", ".$index.")" : ""; ?>">
                    <input type="radio" name="cau_<?php echo $cau['id_cauhoi']; ?>" 
                           value="<?php echo $da['id_dapan']; ?>" 
                           <?php echo $is_selected ? 'checked' : ''; ?>
                           <?php echo ($da_nop || $xem || !$dang_lam_bai) ? 'disabled' : ''; ?>
                           class="answer-radio">
                    <span class="answer-label"><?php echo $labels[$idx]; ?>. <?php echo htmlspecialchars($da['noidung']); ?><?php echo $your_choice; ?></span>
                    <?php if($da_nop || $xem): ?>
                    <div class="answer-icon <?php echo $is_correct ? 'correct' : 'incorrect'; ?>">
                        <i class="fas fa-<?php echo $is_correct ? 'check' : 'times'; ?>"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if($dang_lam_bai): ?>
        <div class="nav-buttons">
            <a href="ctmonhoc.php?bm=<?php echo $bm; ?>&is=<?php echo $is; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&tn" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <button type="submit" name="nop_bai" class="btn btn-success" onclick="return confirmSubmit()">
                <i class="fas fa-paper-plane"></i> Nộp Bài
            </button>
        </div>
        <?php elseif(!$da_nop && !$xem): ?>
        <div class="nav-buttons" style="justify-content: center;">
            <a href="ctmonhoc.php?bm=<?php echo $bm; ?>&is=<?php echo $is; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&tn" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
        <?php endif; ?>
    </form>
</div>

<?php endif; ?>

<script>
<?php if($dang_lam_bai): ?>
// Timer
var timeLeft = <?php echo $thoigian_conlai; ?>;
var timerBox = document.getElementById('timerBox');
var isSubmitted = false;

function autoSubmit() {
    if(isSubmitted) return;
    isSubmitted = true;
    
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'nop_bai';
    input.value = '1';
    document.getElementById('quizForm').appendChild(input);
    
    document.getElementById('quizForm').submit();
}

function updateTimer() {
    if(timeLeft <= 0) {
        autoSubmit();
        return;
    }
    
    var hours = Math.floor(timeLeft / 3600);
    var minutes = Math.floor((timeLeft % 3600) / 60);
    var seconds = timeLeft % 60;
    
    document.getElementById('timerDisplay').textContent = 
        (hours > 0 ? hours + ':' : '') + 
        String(minutes).padStart(2, '0') + ':' + 
        String(seconds).padStart(2, '0');
    
    if(timeLeft <= 60) {
        timerBox.classList.add('warning');
    }
    
    timeLeft--;
    setTimeout(updateTimer, 1000);
}

updateTimer();

// Progress tracking
var answeredCount = 0;
var totalQuestions = <?php echo count($cau_hoi); ?>;
var selectedAnswers = {};

function selectAnswer(questionId, answerId, index) {
    var radios = document.querySelectorAll('input[name="cau_' + questionId + '"]');
    radios.forEach(function(radio) {
        radio.checked = false;
        radio.closest('.answer-option').classList.remove('selected');
    });
    
    document.querySelector('input[name="cau_' + questionId + '"][value="' + answerId + '"]').checked = true;
    document.querySelector('input[name="cau_' + questionId + '"][value="' + answerId + '"]').closest('.answer-option').classList.add('selected');
    
    selectedAnswers[questionId] = answerId;
    updateProgress();
}

function updateProgress() {
    answeredCount = Object.keys(selectedAnswers).length;
    document.getElementById('answeredCount').textContent = answeredCount;
    var percent = (answeredCount / totalQuestions) * 100;
    document.getElementById('progressFill').style.width = percent + '%';
}

function confirmSubmit() {
    var unanswered = totalQuestions - answeredCount;
    if(unanswered > 0) {
        return confirm('Bạn còn ' + unanswered + ' câu chưa trả lời. Bạn có chắc muốn nộp bài?');
    }
    return confirm('Bạn có chắc muốn nộp bài?');
}

// Warn before leaving
window.addEventListener('beforeunload', function(e) {
    if(Object.keys(selectedAnswers).length > 0) {
        e.preventDefault();
        e.returnValue = '';
    }
});
<?php endif; ?>
</script>

</body>
</html>
