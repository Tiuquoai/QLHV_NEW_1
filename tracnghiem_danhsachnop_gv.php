<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Bài Nộp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header h3 { font-size: 18px; color: #1a1a2e; display: flex; align-items: center; gap: 10px; }
        .card-header h3 i { color: #667eea; }
        .card-body { padding: 24px; }
        
        /* Stats */
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
            text-align: center;
        }
        
        .stat-card .icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
        }
        
        .stat-card .icon.blue { background: #eff6ff; color: #2563eb; }
        .stat-card .icon.green { background: #ecfdf5; color: #059669; }
        .stat-card .icon.orange { background: #fff7ed; color: #ea580c; }
        .stat-card .icon.purple { background: #f5f3ff; color: #7c3aed; }
        
        .stat-card h3 { font-size: 32px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
        .stat-card p { color: #6b7280; font-size: 14px; }
        
        /* Table */
        .table-wrapper { overflow-x: auto; }
        
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
        
        table tbody tr:hover { background: #f8fafc; }
        table tbody tr:last-child td { border-bottom: none; }
        
        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        .score-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
        }
        
        .score-badge.excellent { background: #ecfdf5; color: #059669; }
        .score-badge.good { background: #eff6ff; color: #2563eb; }
        .score-badge.average { background: #fffbeb; color: #d97706; }
        .score-badge.poor { background: #fef2f2; color: #dc2626; }
        .score-badge.not-submitted { background: #f3f4f6; color: #6b7280; }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-submitted { background: #ecfdf5; color: #059669; }
        .status-not-submitted { background: #fef2f2; color: #dc2626; }
        
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 64px; color: #e5e7eb; margin-bottom: 16px; }
        .empty-state h4 { color: #6b7280; margin-bottom: 8px; }
        .empty-state p { color: #9ca3af; }
        
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
            max-width: 800px;
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
        
        .modal-header h3 { font-size: 18px; }
        
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
        
        /* Detail */
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
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-item.correct h4 { color: #059669; }
        .detail-item.wrong h4 { color: #dc2626; }
        
        .detail-item p { font-size: 13px; color: #6b7280; margin-bottom: 4px; }
        .detail-item p strong { color: #374151; }
    </style>
</head>
<body>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("Model/mTracNghiem.php");

$model = new TracNghiemModel();
$model->ketnoi();

$id_bttracnghiem = isset($_REQUEST['dsbaitn']) ? $_REQUEST['dsbaitn'] : 0;
$bm = isset($_REQUEST['bm']) ? $_REQUEST['bm'] : '';
$ig = isset($_REQUEST['ig']) ? $_REQUEST['ig'] : '';
$ihp = isset($_REQUEST['ihp']) ? $_REQUEST['ihp'] : '';
$il = isset($_REQUEST['il']) ? $_REQUEST['il'] : '';

// Lấy thông tin bài tập
$sql_bt = "SELECT * FROM baitap_tracnghiem WHERE id_bttracnghiem = '$id_bttracnghiem'";
$qr_bt = mysql_query($sql_bt);
$bai_tap = mysql_fetch_assoc($qr_bt);

// Lấy danh sách sinh viên đã nộp
$sql_nop = "SELECT nb.*, sv.tensinhvien, sv.masosinhvien 
            FROM nopbai_tracnghiem nb 
            JOIN sinhvien sv ON nb.id_sinhvien = sv.id_sinhvien 
            WHERE nb.id_bttracnghiem = '$id_bttracnghiem' 
            ORDER BY nb.diem DESC";
$qr_nop = mysql_query($sql_nop);

// Thống kê
$sql_thongke = "SELECT 
                    COUNT(*) as tong_sv,
                    AVG(diem) as diem_tb,
                    MAX(diem) as diem_max,
                    MIN(diem) as diem_min
                FROM nopbai_tracnghiem 
                WHERE id_bttracnghiem = '$id_bttracnghiem' AND trangthai = 'daday'";
$qr_tk = mysql_query($sql_thongke);
$thongke = mysql_fetch_assoc($qr_tk);

$songuoinop = mysql_num_rows($qr_nop);
$tongsocau = $bai_tap['soluongcauhoi'];
$diemtoida = $tongsocau * $bai_tap['diemmotcau'];
?>

<div class="container">
    <!-- Header -->
    <div class="page-header">
        <div>
            <h2><i class="fas fa-users"></i> Danh Sách Bài Nộp</h2>
            <p><?php echo $bai_tap['tieude']; ?></p>
        </div>
        <a href="cthpgv.php?bm=<?php echo $bm; ?>&&ig=<?php echo $ig; ?>&&ihp=<?php echo $ihp; ?>&&il=<?php echo $il; ?>&&gd=1&&qtnmanage=1#qtn" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Quay Lại
        </a>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon blue"><i class="fas fa-users"></i></div>
            <h3><?php echo $songuoinop; ?></h3>
            <p>Đã Nộp / <?php echo $bai_tap['soluongcauhoi']; ?> SV</p>
        </div>
        <div class="stat-card">
            <div class="icon green"><i class="fas fa-chart-bar"></i></div>
            <h3><?php echo $thongke['diem_tb'] ? round($thongke['diem_tb'], 1) : '0'; ?></h3>
            <p>Điểm Trung Bình</p>
        </div>
        <div class="stat-card">
            <div class="icon orange"><i class="fas fa-trophy"></i></div>
            <h3><?php echo $thongke['diem_max'] ? $thongke['diem_max'] : '0'; ?></h3>
            <p>Điểm Cao Nhất</p>
        </div>
        <div class="stat-card">
            <div class="icon purple"><i class="fas fa-star"></i></div>
            <h3><?php echo $diemtoida; ?></h3>
            <p>Điểm Tối Đa</p>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Chi Tiết Bài Nộp</h3>
        </div>
        <div class="card-body">
            <?php if($songuoinop > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sinh Viên</th>
                            <th>MSSV</th>
                            <th>Điểm</th>
                            <th>Đúng</th>
                            <th>Thời Gian Nộp</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $stt = 1;
                        while($row = mysql_fetch_assoc($qr_nop)):
                            $diem = $row['diem'];
                            $score_class = 'poor';
                            if($diem >= 9) $score_class = 'excellent';
                            elseif($diem >= 7) $score_class = 'good';
                            elseif($diem >= 5) $score_class = 'average';
                        ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        <?php echo substr($row['tensinhvien'], 0, 1); ?>
                                    </div>
                                    <span style="font-weight: 600;"><?php echo $row['tensinhvien']; ?></span>
                                </div>
                            </td>
                            <td>
                                <span style="background: #f3f4f6; padding: 4px 10px; border-radius: 6px; font-family: monospace;">
                                    <?php echo $row['masosinhvien']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="score-badge <?php echo $score_class; ?>">
                                    <?php echo $diem; ?>
                                </span>
                            </td>
                            <td><?php echo $row['socautraloi_dung']; ?>/<?php echo $tongsocau; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['thoigian_nop'])); ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="showDetail(<?php echo $row['id_nopbai']; ?>)">
                                    <i class="fas fa-eye"></i> Xem
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Chưa có sinh viên nào nộp bài</h4>
                <p>Danh sách bài nộp đang trống</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Chi Tiết -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-list-check"></i> Chi Tiết Bài Làm</h3>
            <button class="modal-close" onclick="closeModal('detailModal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" id="modalContent">
            <!-- Nội dung sẽ được load bằng AJAX -->
        </div>
    </div>
</div>

<script>
function showDetail(id_nopbai) {
    document.getElementById('modalContent').innerHTML = '<p>Đang tải...</p>';
    document.getElementById('detailModal').classList.add('show');
    
    // AJAX để lấy chi tiết
    fetch('tracnghiem_ajax.php?id_nopbai=' + id_nopbai)
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalContent').innerHTML = data;
        })
        .catch(error => {
            document.getElementById('modalContent').innerHTML = '<p style="color: red;">Lỗi khi tải dữ liệu</p>';
        });
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('show');
    }
}
</script>

<?php $model->dongketnoi(); ?>
</body>
</html>
