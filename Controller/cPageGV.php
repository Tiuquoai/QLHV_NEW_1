<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>
<body>
<?php
// Previous page
$prevDisabled = $tranghientai <= 1 ? 'disabled' : '';
$prevPage = max(1, $tranghientai - 1);

// Next page  
$nextDisabled = $tranghientai >= $tongsotrang ? 'disabled' : '';
$nextPage = min($tongsotrang, $tranghientai + 1);

// First page
$firstDisabled = $tranghientai <= 1 ? 'disabled' : '';

// Last page
$lastDisabled = $tranghientai >= $tongsotrang ? 'disabled' : '';

$baseUrl = "quanlytaikhoan.php?bm=".$_REQUEST['bm']."&&gv&&page=";
?>

<div class="pagination-wrapper">
    <!-- First & Previous -->
    <a href="<?php echo $baseUrl . '1'; ?>" class="pagination-btn nav <?php echo $firstDisabled; ?>" title="Trang đầu">
        <i class="fas fa-angle-double-left"></i>
    </a>
    <a href="<?php echo $baseUrl . $prevPage; ?>" class="pagination-btn nav <?php echo $prevDisabled; ?>" title="Trang trước">
        <i class="fas fa-angle-left"></i>
    </a>

    <?php
    // Show page numbers with ellipsis
    $start = max(1, $tranghientai - 2);
    $end = min($tongsotrang, $tranghientai + 2);
    
    // Always show first page
    if ($start > 1) {
        echo '<a href="' . $baseUrl . '1" class="pagination-btn">1</a>';
        if ($start > 2) {
            echo '<span class="pagination-ellipsis">...</span>';
        }
    }
    
    // Show pages around current
    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $tranghientai) ? 'active' : '';
        echo '<a href="' . $baseUrl . $i . '" class="pagination-btn ' . $active . '">' . $i . '</a>';
    }
    
    // Always show last page
    if ($end < $tongsotrang) {
        if ($end < $tongsotrang - 1) {
            echo '<span class="pagination-ellipsis">...</span>';
        }
        echo '<a href="' . $baseUrl . $tongsotrang . '" class="pagination-btn">' . $tongsotrang . '</a>';
    }
    ?>

    <!-- Next & Last -->
    <a href="<?php echo $baseUrl . $nextPage; ?>" class="pagination-btn nav <?php echo $nextDisabled; ?>" title="Trang sau">
        <i class="fas fa-angle-right"></i>
    </a>
    <a href="<?php echo $baseUrl . $tongsotrang; ?>" class="pagination-btn nav <?php echo $lastDisabled; ?>" title="Trang cuối">
        <i class="fas fa-angle-double-right"></i>
    </a>

    <!-- Page Info -->
    <span class="pagination-info">
        <i class="fas fa-file-alt"></i>
        Trang <?php echo $tranghientai; ?> / <?php echo $tongsotrang; ?>
    </span>
</div>

</body>
</html>
