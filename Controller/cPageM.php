<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lý Học Vụ</title>
</head>

<body>
<div class="mt">
<?php

if ($tranghientai>2){
	$trangdau=1;
    		echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.$trangdau.'">First</a></button> ';
}
if ($tranghientai > 2 && $tongsotrang > 2){
    		echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.($tranghientai-2).'"><<</a></button>  ';
}

if ($tranghientai > 1 && $tongsotrang > 1){
   			 echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.($tranghientai-1).'"><</a></button>  ';
}
 
for ($i = 1; $i <= $tongsotrang; $i++){
    if ($i == $tranghientai){
			 echo '<button class="b2"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.$i.'">'.'<cl>'.$i.'</cl>'."&nbsp;".'</a></button> ';
    }
    elseif($i>$tranghientai-3&&$i<$tranghientai+3){
       		 echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.$i.'">'.$i."&nbsp;".'</a></button> ';
    }
}
 
if ($tranghientai< $tongsotrang && $tongsotrang > 1){
   			 echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.($tranghientai+1).'">></a></button>  ';
}
if ($tranghientai< $tongsotrang && $tongsotrang > 2){
   			 echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.($tranghientai+2).'">>></a></button>  ';
}	
if ($tranghientai < $tongsotrang - 3){
			 $trangcuoi=$tongsotrang;
   			 echo '<button class="b1"><a href="homeSV.php?bm='.$_REQUEST['bm'].'&&is='.$t['id_sinhvien'].'&&'.'page='.$trangcuoi.'">Last</a></button> ';
}




?>
</div>
</body>
</html>