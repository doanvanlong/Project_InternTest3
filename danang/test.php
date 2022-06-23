<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//echo date("d-m-Y H:i:s A U", time());
$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/upload/sanpham/image004-3179.jpg"); // Get file size in bytes
$file_size = $file_size / 1024; // Get file size in KB
echo round($file_size,2); // Echo file size

$imageLink="http://xn--websitemu-2b7d.vn/upload/sanpham/image004-3179.jpg";
var_dump(filesize($imageLink));
?>