<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bài Tập Trắc Nghiệm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header */
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
        
        .page-header h2 {
            font-size: 24px;
            font-weight: 600;
        }
        
        .page-header p {
            opacity: 0.9;
            margin-top: 4px;
        }
        
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
        
        .btn-primary {
            background: #fff;
            color: #667eea;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #fff;
        }
        
        .btn-secondary {
            background: #6b7280;
            color: #fff;
        }
        
        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }
        
        /* Card */
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
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header h3 {
            font-size: 18px;
            color: #1a1a2e;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-header h3 i {
            color: #667eea;
        }
        
        .card-body {
            padding: 24px;
        }
        
        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        table th {
            padding: 14px 16px;
            text-align: left;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
        }
        
        table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }
        
        table tbody tr:hover {
            background: #f8fafc;
        }
        
        table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background: #ecfdf5;
            color: #059669;
        }
        
        .status-expired {
            background: #fef2f2;
            color: #dc2626;
        }
        
        .status-pending {
            background: #fffbeb;
            color: #d97706;
        }
        
        .action-btns {
            display: flex;
            gap: 8px;
        }
        
        .action-btns a {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .action-btns a:hover {
            transform: translateY(-2px);
        }
        
        .action-btns .btn-add {
            background: #ecfdf5;
            color: #059669;
        }
        
        .action-btns .btn-edit {
            background: #eff6ff;
            color: #2563eb;
        }
        
        .action-btns .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }
        
        .action-btns .btn-view {
            background: #f3f4f6;
            color: #6b7280;
        }
        
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
        
        .modal.show {
            display: flex;
        }
        
        .modal-content {
            background: #fff;
            border-radius: 20px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeInUp 0.3s ease;
        }
        
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
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 24px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .modal-header h3 {
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
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
        
        .modal-close:hover {
            background: rgba(255,255,255,0.3);
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 24px;
        }
        
        /* Form */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }
        
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
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        /* Question List */
        .question-list {
            margin-top: 20px;
        }
        
        .question-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
        }
        
        .question-item h4 {
            font-size: 15px;
            color: #1a1a2e;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .question-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }
        
        .answer-list {
            margin-left: 38px;
        }
        
        .answer-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: #fff;
            border-radius: 8px;
            margin-bottom: 6px;
            border: 1px solid #e5e7eb;
        }
        
        .answer-item.correct {
            background: #ecfdf5;
            border-color: #10b981;
        }
        
        .answer-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        
        .answer-item.correct .answer-icon {
            background: #10b981;
            color: #fff;
        }
        
        .answer-item:not(.correct) .answer-icon {
            background: #e5e7eb;
            color: #6b7280;
        }
        
        .difficulty-badge {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 50px;
            font-weight: 500;
        }
        
        .difficulty-easy {
            background: #ecfdf5;
            color: #059669;
        }
        
        .difficulty-medium {
            background: #fffbeb;
            color: #d97706;
        }
        
        .difficulty-hard {
            background: #fef2f2;
            color: #dc2626;
        }
        
        /* Alert */
        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-success {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #10b981;
        }
        
        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #ef4444;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-state i {
            font-size: 64px;
            color: #e5e7eb;
            margin-bottom: 16px;
        }
        
        .empty-state h4 {
            color: #6b7280;
            margin-bottom: 8px;
        }
        
        .empty-state p {
            color: #9ca3af;
        }
        
        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .stat-card .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }
        
        .stat-card .icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }
        
        .stat-card .icon.green {
            background: #ecfdf5;
            color: #059669;
        }
        
        .stat-card .icon.orange {
            background: #fff7ed;
            color: #ea580c;
        }
        
        .stat-card .icon.red {
            background: #fef2f2;
            color: #dc2626;
        }
        
        .stat-card h4 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a2e;
        }
        
        .stat-card p {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("Model/mTracNghiem.php");

$model = new TracNghiemModel();
$model->ketnoi();

// Lấy thông tin
$id_giangday = isset($_REQUEST['id_giangday']) ? $_REQUEST['id_giangday'] : 0;
$bm = isset($_REQUEST['bm']) ? $_REQUEST['bm'] : '';

// Xử lý thêm bài tập
if(isset($_POST['them_baitap'])) {
    $tieude = $_POST['tieude'];
    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
    $thoigianlambai = $_POST['thoigianlambai'];
    $soluongcauhoi = $_POST['soluongcauhoi'];
    $diemmotcau = $_POST['diemmotcau'];
    $batdaunop = $_POST['batdaunop'];
    $ketthucnop = $_POST['ketthucnop'];
    
    $ngaydang = date('Y-m-d H:i:s');
    $sql = "INSERT INTO baitap_tracnghiem (tieude, mota, thoigianlambai, soluongcauhoi, diemmotcau, batdaunop, ketthucnop, ngaydang, id_giangday) 
            VALUES ('$tieude', '$mota', '$thoigianlambai', '$soluongcauhoi', '$diemmotcau', '$batdaunop', '$ketthucnop', '$ngaydang', '$id_giangday')";
    
    if(mysql_query($sql)) {
        $success_msg = "Thêm bài tập thành công!";
    } else {
        $error_msg = "Thêm bài tập thất bại!";
    }
}

// Xử lý xóa bài tập
if(isset($_GET['xoabaitap'])) {
    $id_bttracnghiem = $_GET['xoabaitap'];
    
    // Xóa chi tiết trả lời
    $sql_chitiet = "DELETE ct FROM chitiet_tracnghiem ct 
                    JOIN nopbai_tracnghiem nb ON ct.id_nopbai = nb.id_nopbai 
                    WHERE nb.id_bttracnghiem = '$id_bttracnghiem'";
    mysql_query($sql_chitiet);
    
    // Xóa bài nộp
    mysql_query("DELETE FROM nopbai_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
    
    // Xóa đáp án và câu hỏi
    $sql_cauhoi = "SELECT id_cauhoi FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
    $qr_cauhoi = mysql_query($sql_cauhoi);
    while($ch = mysql_fetch_assoc($qr_cauhoi)) {
        mysql_query("DELETE FROM dapan_tracnghiem WHERE id_cauhoi = '".$ch['id_cauhoi']."'");
    }
    mysql_query("DELETE FROM cauhoi_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
    
    // Xóa bài tập
    mysql_query("DELETE FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'");
    
    $success_msg = "Xóa bài tập thành công!";
}

// Lấy danh sách bài tập
$sql_ds = "SELECT * FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday' ORDER BY ngaydang DESC";
$qr_ds = mysql_query($sql_ds);
?>

<div class="container">
    <!-- Header -->
    <div class="page-header">
        <div>
            <h2><i class="fas fa-list-check"></i> Quản Lý Bài Tập Trắc Nghiệm</h2>
            <p>Tạo và quản lý bài kiểm tra trắc nghiệm cho sinh viên</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addModal')">
            <i class="fas fa-plus"></i> Thêm Bài Tập Mới
        </button>
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
    <div class="stats-grid">
        <?php
        $sql_count = "SELECT 
                        COUNT(*) as total,
                        SUM(CASE WHEN ketthucnop >= NOW() THEN 1 ELSE 0 END) as active,
                        SUM(CASE WHEN ketthucnop < NOW() THEN 1 ELSE 0 END) as expired
                      FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday'";
        $qr_count = mysql_query($sql_count);
        $stats = mysql_fetch_assoc($qr_count);
        
        $sql_sv = "SELECT SUM(soluongcauhoi) as total_questions FROM baitap_tracnghiem WHERE id_giangday = '$id_giangday'";
        $qr_sv = mysql_query($sql_sv);
        $questions = mysql_fetch_assoc($qr_sv);
        ?>
        <div class="stat-card">
            <div class="icon blue"><i class="fas fa-file-alt"></i></div>
            <h4><?php echo $stats['total']; ?></h4>
            <p>Tổng Bài Tập</p>
        </div>
        <div class="stat-card">
            <div class="icon green"><i class="fas fa-check-circle"></i></div>
            <h4><?php echo $stats['active']; ?></h4>
            <p>Đang Hoạt Động</p>
        </div>
        <div class="stat-card">
            <div class="icon orange"><i class="fas fa-clock"></i></div>
            <h4><?php echo $stats['expired']; ?></h4>
            <p>Đã Hết Hạn</p>
        </div>
        <div class="stat-card">
            <div class="icon red"><i class="fas fa-question-circle"></i></div>
            <h4><?php echo $questions['total_questions']; ?></h4>
            <p>Tổng Câu Hỏi</p>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-table"></i> Danh Sách Bài Tập</h3>
        </div>
        <div class="card-body">
            <?php if(mysql_num_rows($qr_ds) > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu Đề</th>
                            <th>Thời Gian</th>
                            <th>Số Câu</th>
                            <th>Điểm/Câu</th>
                            <th>Hạn Nộp</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        while($row = mysql_fetch_assoc($qr_ds)):
                            $now = time();
                            $deadline = strtotime($row['ketthucnop']);
                            $isExpired = $now > $deadline;
                            
                            $start = strtotime($row['batdaunop']);
                            $isPending = $now < $start;
                        ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td>
                                <strong><?php echo $row['tieude']; ?></strong>
                                <?php if($row['mota']): ?>
                                <p style="font-size: 12px; color: #6b7280; margin-top: 4px;"><?php echo substr($row['mota'], 0, 50); ?>...</p>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['thoigianlambai']; ?> phút</td>
                            <td><?php echo $row['soluongcauhoi']; ?> câu</td>
                            <td><?php echo $row['diemmotcau']; ?> đ</td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['ketthucnop'])); ?></td>
                            <td>
                                <?php if($isExpired): ?>
                                <span class="status-badge status-expired"><i class="fas fa-clock"></i> Hết hạn</span>
                                <?php elseif($isPending): ?>
                                <span class="status-badge status-pending"><i class="fas fa-hourglass-half"></i> Chưa mở</span>
                                <?php else: ?>
                                <span class="status-badge status-active"><i class="fas fa-check-circle"></i> Đang mở</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="cthpgv.php?bm=<?php echo $bm; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&qtn=<?php echo $row['id_bttracnghiem']; ?>&&gd#qtn" title="Quản lý câu hỏi">
                                        <i class="fas fa-list-ol"></i>
                                    </a>
                                    <a href="cthpgv.php?bm=<?php echo $bm; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&dsbaitn=<?php echo $row['id_bttracnghiem']; ?>&&gd#qtn" title="Danh sách bài nộp">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <a href="?xoabaitap=<?php echo $row['id_bttracnghiem']; ?>&&bm=<?php echo $bm; ?>&&ig=<?php echo $_REQUEST['ig']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&id_giangday=<?php echo $id_giangday; ?>&&gd#qtn" 
                                       onclick="return confirm('Bạn có chắc muốn xóa bài tập này?')" title="Xóa" style="background: #fef2f2; color: #dc2626;">
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
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Chưa có bài tập nào</h4>
                <p>Nhấn "Thêm Bài Tập Mới" để tạo bài kiểm tra đầu tiên</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Thêm Bài Tập -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-plus-circle"></i> Thêm Bài Tập Trắc Nghiệm Mới</h3>
            <button class="modal-close" onclick="closeModal('addModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label>Tiêu Đề Bài Tập <span style="color: red;">*</span></label>
                    <input type="text" name="tieude" required placeholder="VD: Kiểm tra chương 1 - Cơ sở dữ liệu">
                </div>
                
                <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea name="mota" rows="3" placeholder="Mô tả nội dung bài kiểm tra (không bắt buộc)"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Thời Gian Làm Bài (phút) <span style="color: red;">*</span></label>
                        <input type="number" name="thoigianlambai" value="30" min="5" max="180" required>
                    </div>
                    <div class="form-group">
                        <label>Số Câu Hỏi <span style="color: red;">*</span></label>
                        <input type="number" name="soluongcauhoi" value="10" min="1" max="100" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Điểm Mỗi Câu <span style="color: red;">*</span></label>
                    <input type="number" name="diemmotcau" value="1" min="0.1" max="10" step="0.1" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Ngày Bắt Đầu <span style="color: red;">*</span></label>
                        <input type="datetime-local" name="batdaunop" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Ngày Kết Thúc <span style="color: red;">*</span></label>
                        <input type="datetime-local" name="ketthucnop" value="<?php echo date('Y-m-d\TH:i', strtotime('+7 days')); ?>" required>
                    </div>
                </div>
                
                <input type="hidden" name="id_giangday" value="<?php echo $id_giangday; ?>">
                
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Hủy</button>
                    <button type="submit" name="them_baitap" class="btn btn-success">
                        <i class="fas fa-save"></i> Lưu Bài Tập
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
    document.body.style.overflow = 'auto';
}

// Đóng modal khi click ra ngoài
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
