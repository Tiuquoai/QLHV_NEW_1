<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("Model/mTracNghiem.php");

$model = new TracNghiemModel();
$model->ketnoi();

$id_nopbai = isset($_GET['id_nopbai']) ? $_GET['id_nopbai'] : 0;

// Lấy thông tin bài nộp
$sql = "SELECT nb.*, sv.tensinhvien, sv.masosinhvien 
        FROM nopbai_tracnghiem nb 
        JOIN sinhvien sv ON nb.id_sinhvien = sv.id_sinhvien 
        WHERE nb.id_nopbai = '$id_nopbai'";
$qr = mysql_query($sql);
$nopbai = mysql_fetch_assoc($qr);

// Lấy chi tiết
$sql_ct = "SELECT ct.*, ch.noidung as cauhoi, 
           (SELECT noidung FROM dapan_tracnghiem WHERE id_cauhoi = ch.id_cauhoi AND ladapan_dung = 1) as dapan_dung
           FROM chitiet_tracnghiem ct
           JOIN cauhoi_tracnghiem ch ON ct.id_cauhoi = ch.id_cauhoi
           WHERE ct.id_nopbai = '$id_nopbai'
           ORDER BY ct.id";
$qr_ct = mysql_query($sql_ct);
?>

<div style="margin-bottom: 20px; padding: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; color: #fff;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <strong><?php echo $nopbai['tensinhvien']; ?></strong>
            <span style="margin-left: 12px; background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 50px; font-size: 12px;">
                <?php echo $nopbai['masosinhvien']; ?>
            </span>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 28px; font-weight: 700;"><?php echo $nopbai['diem']; ?></div>
            <div style="font-size: 12px; opacity: 0.9;"><?php echo $nopbai['socautraloi_dung']; ?> câu đúng</div>
        </div>
    </div>
</div>

<?php
$stt = 1;
while($ct = mysql_fetch_assoc($qr_ct)):
    // Lấy đáp án đã chọn
    $sql_da = "SELECT noidung FROM dapan_tracnghiem WHERE id_dapan = '".$ct['id_dapan_chon']."'";
    $qr_da = mysql_query($sql_da);
    $da_chon = mysql_fetch_assoc($qr_da);
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
    <p><i class="fas fa-times-circle" style="color: #ef4444;"></i> <strong>Bạn chọn:</strong> <?php echo $da_chon ? $da_chon['noidung'] : 'Chưa trả lời'; ?></p>
    <p><i class="fas fa-check-circle" style="color: #10b981;"></i> <strong>Đáp án đúng:</strong> <?php echo $ct['dapan_dung']; ?></p>
    <?php endif; ?>
</div>
<?php
endwhile;
$model->dongketnoi();
?>
