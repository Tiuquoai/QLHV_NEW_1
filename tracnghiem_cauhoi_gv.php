<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Câu Hỏi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; color: #333; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 24px 30px;
            color: #fff;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }
        
        .page-header h2 { font-size: 24px; font-weight: 600; }
        .page-header p { opacity: 0.9; margin-top: 4px; }
        
        .btn {
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
        
        .btn-primary { background: #fff; color: #667eea; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .btn-success { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4); }
        .btn-danger { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: #fff; }
        .btn-secondary { background: #6b7280; color: #fff; }
        .btn-sm { padding: 8px 16px; font-size: 13px; }
        
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 24px;
        }
        
        .card-header {
            background: #f8fafc;
            padding: 16px 24px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .card-header h3 { font-size: 18px; color: #1a1a2e; display: flex; align-items: center; gap: 10px; }
        .card-header h3 i { color: #667eea; }
        .card-body { padding: 24px; }
        
        .question-card {
            background: #fff;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .question-card:hover {
            border-color: #667eea;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.15);
        }
        
        .question-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        
        .question-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .question-content { flex: 1; margin-left: 16px; }
        .question-content h4 { font-size: 16px; color: #1a1a2e; line-height: 1.5; margin-bottom: 12px; }
        
        .question-meta { display: flex; gap: 12px; flex-wrap: wrap; }
        
        .meta-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .meta-tag.difficulty-easy { background: #ecfdf5; color: #059669; }
        .meta-tag.difficulty-medium { background: #fffbeb; color: #d97706; }
        .meta-tag.difficulty-hard { background: #fef2f2; color: #dc2626; }
        
        .question-actions { display: flex; gap: 8px; }
        .question-actions a {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .question-actions a:hover { transform: translateY(-2px); }
        .question-actions .btn-edit { background: #eff6ff; color: #2563eb; }
        .question-actions .btn-delete { background: #fef2f2; color: #dc2626; }
        
        .answers-list {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }
        
        .answer-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .answer-item.correct { background: #ecfdf5; border-color: #10b981; }
        
        .answer-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            margin-right: 12px;
        }
        
        .answer-item.correct .answer-icon { background: #10b981; color: #fff; }
        .answer-item:not(.correct) .answer-icon { background: #e5e7eb; color: #6b7280; }
        
        .answer-text { flex: 1; font-size: 14px; }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.show { display: flex; }
        
        .modal-content {
            background: #fff;
            border-radius: 20px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeInUp 0.3s ease;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 24px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .modal-header h3 { font-size: 18px; display: flex; align-items: center; gap: 10px; }
        
        .modal-close {
            background: rgba(255,255,255,0.2);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .modal-close:hover { background: rgba(255,255,255,0.3); transform: rotate(90deg); }
        .modal-body { padding: 24px; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #374151; }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .answer-input-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        
        .answer-input-group input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #10b981;
        }
        
        .answer-input-group input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
        }
        
        .answer-input-group input[type="text"]:focus {
            border-color: #667eea;
            outline: none;
        }
        
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-success { background: #ecfdf5; color: #059669; border: 1px solid #10b981; }
        .alert-error { background: #fef2f2; color: #dc2626; border: 1px solid #ef4444; }
        
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 64px; color: #e5e7eb; margin-bottom: 16px; }
        .empty-state h4 { color: #6b7280; margin-bottom: 8px; }
        .empty-state p { color: #9ca3af; }
        
        /* Stats Bar */
        .stats-bar {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .stat-item {
            background: #fff;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .stat-item .icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .stat-item .icon.blue { background: #eff6ff; color: #2563eb; }
        .stat-item .icon.green { background: #ecfdf5; color: #059669; }
        
        .stat-item .info h4 { font-size: 24px; font-weight: 700; color: #1a1a2e; }
        .stat-item .info p { font-size: 13px; color: #6b7280; }
    </style>
</head>
<body>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("Model/mTracNghiem.php");

$model = new TracNghiemModel();
$model->ketnoi();

$id_bttracnghiem = isset($_REQUEST['qtn']) ? intval($_REQUEST['qtn']) : 0;
$bm = isset($_REQUEST['bm']) ? $_REQUEST['bm'] : '';
$ig = isset($_REQUEST['ig']) ? $_REQUEST['ig'] : '';
$ihp = isset($_REQUEST['ihp']) ? $_REQUEST['ihp'] : '';
$il = isset($_REQUEST['il']) ? $_REQUEST['il'] : '';

$sql_bt = "SELECT * FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
$qr_bt = mysql_query($sql_bt);
$bai_tap = mysql_fetch_assoc($qr_bt);

// Xử lý thêm câu hỏi
if(isset($_POST['them_cauhoi'])) {
    $noidung = addslashes($_POST['noidung']);
    $dokho = isset($_POST['dokho']) ? $_POST['dokho'] : 'trungbinh';
    
    $sql = "INSERT INTO cauhoi_tracnghiem (noidung, dokho, id_bttracnghiem) VALUES ('$noidung', '$dokho', '$id_bttracnghiem')";
    
    if(mysql_query($sql)) {
        $id_cauhoi = mysql_insert_id();
        
        // Thêm đáp án
        if(isset($_POST['dap_an']) && isset($_POST['dapan_dung'])) {
            $dapan_dung = intval($_POST['dapan_dung']);
            $index = 0;
            foreach($_POST['dap_an'] as $idx => $noidung_dapan) {
                $nd_dapan = trim($noidung_dapan);
                if(!empty($nd_dapan)) {
                    $nd_dapan = addslashes($nd_dapan);
                    $ladung = ($dapan_dung == $index) ? 1 : 0;
                    mysql_query("INSERT INTO dapan_tracnghiem (noidung, ladapan_dung, id_cauhoi) VALUES ('$nd_dapan', '$ladung', '$id_cauhoi')");
                }
                $index++;
            }
        }
        
        $success_msg = "Thêm câu hỏi thành công!";
    } else {
        $error_msg = "Thêm câu hỏi thất bại!";
    }
}

// Xử lý sửa câu hỏi
if(isset($_POST['sua_cauhoi'])) {
    $id_cauhoi = intval($_POST['id_cauhoi']);
    $noidung = addslashes($_POST['noidung']);
    $dokho = isset($_POST['dokho']) ? $_POST['dokho'] : 'trungbinh';
    
    mysql_query("UPDATE cauhoi_tracnghiem SET noidung = '$noidung', dokho = '$dokho' WHERE id_cauhoi = '$id_cauhoi'");
    
    // Xóa đáp án cũ
    mysql_query("DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi'");
    
    // Thêm lại đáp án
    if(isset($_POST['dap_an']) && isset($_POST['dapan_dung'])) {
        $dapan_dung = intval($_POST['dapan_dung']);
        $index = 0;
        foreach($_POST['dap_an'] as $idx => $noidung_dapan) {
            $nd_dapan = trim($noidung_dapan);
            if(!empty($nd_dapan)) {
                $nd_dapan = addslashes($nd_dapan);
                $ladung = ($dapan_dung == $index) ? 1 : 0;
                mysql_query("INSERT INTO dapan_tracnghiem (noidung, ladapan_dung, id_cauhoi) VALUES ('$nd_dapan', '$ladung', '$id_cauhoi')");
            }
            $index++;
        }
    }
    
    $success_msg = "Cập nhật câu hỏi thành công!";
}

// Xử lý xóa câu hỏi
if(isset($_GET['xoacauhoi'])) {
    $id_cauhoi = intval($_GET['xoacauhoi']);
    mysql_query("DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '$id_cauhoi'");
    mysql_query("DELETE FROM cauhoi_tracnghiem WHERE id_cauhoi = '$id_cauhoi'");
    $success_msg = "Xóa câu hỏi thành công!";
}

// Lấy câu hỏi cần sửa
$cauhoi_sua = null;
if(isset($_GET['suacauhoi'])) {
    $id_sua = intval($_GET['suacauhoi']);
    $sql_sua = "SELECT * FROM cauhoi_tracnghiem WHERE id_cauhoi = '$id_sua'";
    $qr_sua = mysql_query($sql_sua);
    $cauhoi_sua = mysql_fetch_assoc($qr_sua);
}

// Lấy danh sách câu hỏi
$sql_ds = "SELECT * FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem' ORDER BY id_cauhoi";
$qr_ds = mysql_query($sql_ds);
$tong_cauhoi = mysql_num_rows($qr_ds);
?>

<div class="container">
    <!-- Header -->
    <div class="page-header">
        <div>
            <h2><i class="fas fa-question-circle"></i> Quản Lý Câu Hỏi</h2>
            <p><?php echo htmlspecialchars($bai_tap['tieude']); ?></p>
        </div>
        <div style="display: flex; gap: 12px; align-items: center;">
            <span style="background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 50px;">
                <i class="fas fa-list-ol"></i> <?php echo $tong_cauhoi; ?> / <?php echo $bai_tap['soluongcauhoi']; ?> câu hỏi
            </span>
            <a href="cthpgv.php?bm=<?php echo $bm; ?>&&ig=<?php echo $ig; ?>&&ihp=<?php echo $ihp; ?>&&il=<?php echo $il; ?>&&gd=1&&qtnmanage=1#qtn" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Quay Lại
            </a>
            <button class="btn btn-success" onclick="openModal('addModal')">
                <i class="fas fa-plus"></i> Thêm Câu Hỏi
            </button>
        </div>
    </div>

    <!-- Alert -->
    <?php if(isset($success_msg)): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
    </div>
    <?php endif; ?>
    
    <?php if(isset($error_msg)): ?>
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
    </div>
    <?php endif; ?>

    <!-- Stats -->
    <div class="stats-bar">
        <div class="stat-item">
            <div class="icon blue"><i class="fas fa-question-circle"></i></div>
            <div class="info">
                <h4><?php echo $tong_cauhoi; ?></h4>
                <p>Câu Hỏi Đã Tạo</p>
            </div>
        </div>
        <div class="stat-item">
            <div class="icon green"><i class="fas fa-question"></i></div>
            <div class="info">
                <h4><?php echo max(0, $bai_tap['soluongcauhoi'] - $tong_cauhoi); ?></h4>
                <p>Câu Hỏi Còn Thiếu</p>
            </div>
        </div>
    </div>

    <!-- Questions List -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-list-ol"></i> Danh Sách Câu Hỏi</h3>
        </div>
        <div class="card-body">
            <?php if($tong_cauhoi > 0): ?>
                <?php $stt = 1; while($cauhoi = mysql_fetch_assoc($qr_ds)): ?>
                <?php
                    $sql_da = "SELECT * FROM dapan_tracnghiem WHERE id_cauhoi = '".$cauhoi['id_cauhoi']."'";
                    $qr_da = mysql_query($sql_da);
                ?>
                <div class="question-card">
                    <div class="question-header">
                        <div style="display: flex; align-items: flex-start;">
                            <div class="question-number"><?php echo $stt++; ?></div>
                            <div class="question-content">
                                <h4><?php echo htmlspecialchars($cauhoi['noidung']); ?></h4>
                                <div class="question-meta">
                                    <?php 
                                    $difficulty_class = 'difficulty-easy';
                                    $difficulty_text = 'Dễ';
                                    if($cauhoi['dokho'] == 'trungbinh') {
                                        $difficulty_class = 'difficulty-medium';
                                        $difficulty_text = 'Trung bình';
                                    } elseif($cauhoi['dokho'] == 'kho') {
                                        $difficulty_class = 'difficulty-hard';
                                        $difficulty_text = 'Khó';
                                    }
                                    ?>
                                    <span class="meta-tag <?php echo $difficulty_class; ?>">
                                        <i class="fas fa-signal"></i> <?php echo $difficulty_text; ?>
                                    </span>
                                    <span class="meta-tag" style="background: #f3f4f6; color: #6b7280;">
                                        <i class="fas fa-check"></i> <?php echo mysql_num_rows($qr_da); ?> đáp án
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="question-actions">
                            <a href="?suacauhoi=<?php echo $cauhoi['id_cauhoi']; ?>&&qtn=<?php echo $id_bttracnghiem; ?>&&bm=<?php echo $bm; ?>&&ig=<?php echo $ig; ?>&&ihp=<?php echo $ihp; ?>&&il=<?php echo $il; ?>&&gd=1&&qtnmanage=1#edit" class="btn-edit" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="?xoacauhoi=<?php echo $cauhoi['id_cauhoi']; ?>&&qtn=<?php echo $id_bttracnghiem; ?>&&bm=<?php echo $bm; ?>&&ig=<?php echo $ig; ?>&&ihp=<?php echo $ihp; ?>&&il=<?php echo $il; ?>&&gd=1&&qtnmanage=1#qtn" 
                               onclick="return confirm('Bạn có chắc muốn xóa câu hỏi này?')" class="btn-delete" title="Xóa">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="answers-list">
                        <?php 
                        $labels = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
                        $idx = 0;
                        mysql_data_seek($qr_da, 0);
                        while($dapan = mysql_fetch_assoc($qr_da)): 
                        ?>
                        <div class="answer-item <?php echo $dapan['ladapan_dung'] ? 'correct' : ''; ?>">
                            <div class="answer-icon">
                                <?php if($dapan['ladapan_dung']): ?>
                                <i class="fas fa-check"></i>
                                <?php else: ?>
                                <?php echo $labels[$idx]; ?>
                                <?php endif; ?>
                            </div>
                            <span class="answer-text"><?php echo htmlspecialchars($dapan['noidung']); ?></span>
                        </div>
                        <?php $idx++; endwhile; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-question-circle"></i>
                <h4>Chưa có câu hỏi nào</h4>
                <p>Nhấn "Thêm Câu Hỏi" để tạo câu hỏi đầu tiên</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Thêm/Sửa Câu Hỏi -->
<div id="addModal" class="modal <?php echo (isset($_GET['suacauhoi']) || isset($cauhoi_sua)) ? 'show' : ''; ?>">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-<?php echo $cauhoi_sua ? 'edit' : 'plus-circle'; ?>"></i> <?php echo $cauhoi_sua ? 'Sửa Câu Hỏi' : 'Thêm Câu Hỏi Mới'; ?></h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <?php 
            // Lấy đáp án nếu đang sửa
            $dap_an_sua = array();
            if($cauhoi_sua) {
                $sql_da_sua = "SELECT * FROM dapan_tracnghiem WHERE id_cauhoi = '".$cauhoi_sua['id_cauhoi']."'";
                $qr_da_sua = mysql_query($sql_da_sua);
                while($da = mysql_fetch_assoc($qr_da_sua)) {
                    $dap_an_sua[] = $da;
                }
            }
            ?>
            <form action="" method="POST" id="questionForm">
                <?php if($cauhoi_sua): ?>
                <input type="hidden" name="id_cauhoi" value="<?php echo $cauhoi_sua['id_cauhoi']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Nội Dung Câu Hỏi <span style="color: red;">*</span></label>
                    <textarea name="noidung" rows="4" required placeholder="Nhập nội dung câu hỏi..."><?php echo $cauhoi_sua ? htmlspecialchars($cauhoi_sua['noidung']) : ''; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Độ Khó</label>
                    <select name="dokho">
                        <option value="de" <?php echo ($cauhoi_sua && $cauhoi_sua['dokho'] == 'de') ? 'selected' : ''; ?>>Dễ</option>
                        <option value="trungbinh" <?php echo (!$cauhoi_sua || $cauhoi_sua['dokho'] == 'trungbinh') ? 'selected' : ''; ?>>Trung bình</option>
                        <option value="kho" <?php echo ($cauhoi_sua && $cauhoi_sua['dokho'] == 'kho') ? 'selected' : ''; ?>>Khó</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Đáp Án <span style="color: red;">*</span> <small style="color: #6b7280;">(Chọn đáp án đúng bằng cách click vào radio)</small></label>
                    <div id="answersContainer">
                        <?php 
                        if($cauhoi_sua && count($dap_an_sua) > 0) {
                            $index = 0;
                            foreach($dap_an_sua as $da) {
                                echo '<div class="answer-input-group">
                                    <input type="radio" name="dapan_dung" value="'.$index.'" '.($da['ladapan_dung'] ? 'checked' : '').' required>
                                    <input type="text" name="dap_an[]" placeholder="Đáp án '.chr(65+$index).'" value="'.htmlspecialchars($da['noidung']).'" required>
                                    <button type="button" onclick="removeAnswer(this)" style="background:#fef2f2;color:#dc2626;border:none;width:32px;height:32px;border-radius:8px;cursor:pointer;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>';
                                $index++;
                            }
                        } else {
                        ?>
                        <div class="answer-input-group">
                            <input type="radio" name="dapan_dung" value="0" checked required>
                            <input type="text" name="dap_an[]" placeholder="Đáp án A" required>
                        </div>
                        <div class="answer-input-group">
                            <input type="radio" name="dapan_dung" value="1">
                            <input type="text" name="dap_an[]" placeholder="Đáp án B" required>
                        </div>
                        <div class="answer-input-group">
                            <input type="radio" name="dapan_dung" value="2">
                            <input type="text" name="dap_an[]" placeholder="Đáp án C">
                        </div>
                        <div class="answer-input-group">
                            <input type="radio" name="dapan_dung" value="3">
                            <input type="text" name="dap_an[]" placeholder="Đáp án D">
                        </div>
                        <?php } ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="addAnswer()" style="margin-top: 8px;">
                        <i class="fas fa-plus"></i> Thêm Đáp Án
                    </button>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Hủy</button>
                    <button type="submit" name="<?php echo $cauhoi_sua ? 'sua_cauhoi' : 'them_cauhoi'; ?>" class="btn btn-success">
                        <i class="fas fa-save"></i> <?php echo $cauhoi_sua ? 'Cập Nhật' : 'Lưu Câu Hỏi'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let answerCount = <?php echo ($cauhoi_sua && is_array($dap_an_sua)) ? count($dap_an_sua) : 4; ?>;
const labels = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');

function openModal(id) {
    document.getElementById(id).classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
    document.body.style.overflow = 'auto';
    // Reload để clear form
    window.location.href = window.location.pathname + '?qtn=<?php echo $id_bttracnghiem; ?>&bm=<?php echo $bm; ?>&ig=<?php echo $ig; ?>&ihp=<?php echo $ihp; ?>&il=<?php echo $il; ?>&gd=1&&qtnmanage=1#qtn';
}

function addAnswer() {
    if(answerCount < 8) {
        const container = document.getElementById('answersContainer');
        const div = document.createElement('div');
        div.className = 'answer-input-group';
        div.innerHTML = '<input type="radio" name="dapan_dung" value="' + answerCount + '">' +
            '<input type="text" name="dap_an[]" placeholder="Đáp án ' + labels[answerCount] + '" required>' +
            '<button type="button" onclick="removeAnswer(this)" style="background:#fef2f2;color:#dc2626;border:none;width:32px;height:32px;border-radius:8px;cursor:pointer;">' +
            '<i class="fas fa-times"></i></button>';
        container.appendChild(div);
        answerCount++;
    }
}

function removeAnswer(btn) {
    if(answerCount > 2) {
        btn.parentElement.remove();
        answerCount--;
        // Renumber radio values
        const container = document.getElementById('answersContainer');
        const groups = container.querySelectorAll('.answer-input-group');
        groups.forEach((group, index) => {
            const radio = group.querySelector('input[type="radio"]');
            radio.value = index;
            const textInput = group.querySelector('input[type="text"]');
            textInput.placeholder = 'Đáp án ' + labels[index];
        });
    }
}

// Auto open modal if editing
<?php if(isset($_GET['suacauhoi'])): ?>
window.addEventListener('load', function() {
    openModal('addModal');
});
<?php endif; ?>

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
}
</script>

<?php $model->dongketnoi(); ?>
</body>
</html>
