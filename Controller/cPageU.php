<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
.pagination-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 20px 0;
}

.pagination-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 14px;
    border: none;
    border-radius: 10px;
    background: #f3f4f6;
    color: #6b7280;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.pagination-btn:hover {
    background: #e5e7eb;
    color: #374151;
    transform: translateY(-2px);
}

.pagination-btn.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    font-weight: 600;
}

.pagination-btn.active:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.pagination-btn.nav {
    background: #fff;
    border: 2px solid #e5e7eb;
}

.pagination-btn.nav:hover {
    border-color: #667eea;
    color: #667eea;
}

.pagination-btn.nav i {
    font-size: 12px;
}

.pagination-ellipsis {
    color: #9ca3af;
    font-size: 14px;
    padding: 0 8px;
}

.pagination-info {
    margin-left: 16px;
    font-size: 13px;
    color: #9ca3af;
}
</style>
</head>
<body>

<div class="pagination-wrapper">
    <?php
    
    $baseUrl = "cthpgv.php?bm=".$_REQUEST['bm']."&&ig=".$_REQUEST['ig']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&qld";
    
    // Nút First và Previous
    if ($tranghientai > 2){
        echo '<a href="'.$baseUrl.'&&page=1" class="pagination-btn nav" title="Trang đầu"><i class="fas fa-angle-double-left"></i></a>';
    }
    
    if ($tranghientai > 1){
        echo '<a href="'.$baseUrl.'&&page='.($tranghientai-1).'" class="pagination-btn nav" title="Trang trước"><i class="fas fa-chevron-left"></i></a>';
    }
    
    // Hiển thị số trang
    $start = max(1, $tranghientai - 2);
    $end = min($tongsotrang, $tranghientai + 2);
    
    // Thêm dấu ... nếu cần
    if ($start > 1) {
        echo '<a href="'.$baseUrl.'&&page=1" class="pagination-btn">1</a>';
        if ($start > 2) {
            echo '<span class="pagination-ellipsis">...</span>';
        }
    }
    
    for ($i = $start; $i <= $end; $i++){
        if ($i == $tranghientai){
            echo '<a href="'.$baseUrl.'&&page='.$i.'" class="pagination-btn active">'.$i.'</a>';
        }
        else{
            echo '<a href="'.$baseUrl.'&&page='.$i.'" class="pagination-btn">'.$i.'</a>';
        }
    }
    
    // Thêm dấu ... nếu cần
    if ($end < $tongsotrang) {
        if ($end < $tongsotrang - 1) {
            echo '<span class="pagination-ellipsis">...</span>';
        }
        echo '<a href="'.$baseUrl.'&&page='.$tongsotrang.'" class="pagination-btn">'.$tongsotrang.'</a>';
    }
    
    // Nút Next và Last
    if ($tranghientai < $tongsotrang){
        echo '<a href="'.$baseUrl.'&&page='.($tranghientai+1).'" class="pagination-btn nav" title="Trang sau"><i class="fas fa-chevron-right"></i></a>';
    }
    
    if ($tranghientai < $tongsotrang - 1){
        echo '<a href="'.$baseUrl.'&&page='.$tongsotrang.'" class="pagination-btn nav" title="Trang cuối"><i class="fas fa-angle-double-right"></i></a>';
    }
    
    // Thông tin phân trang
    echo '<span class="pagination-info">Trang '.$tranghientai.' / '.$tongsotrang.'</span>';
    ?>
</div>

</body>
</html>
