<?php 
function ___wejns_wp_whitespace_fix($input) {
	$allowed = false;
	$found = false;
	foreach (headers_list() as $header) {
		if (preg_match("/^content-type:\\s+(text\\/|application\\/((xhtml|atom|rss)\\+xml|xml))/i", $header)) {
			$allowed = true;
		}
		if (preg_match("/^content-type:\\s+/i", $header)) {
			$found = true;
		}
	}
	if ($allowed || !$found) {
		return preg_replace("/\\A\\s*/m", "", $input);
	} else {
		return $input;
	}
}
ob_start("___wejns_wp_whitespace_fix");

	error_reporting(0);
	session_start();
	$session=session_id();

	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './danang/lib/');
	
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";	
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."file_requick.php";
		
	$d = new database($config['database']);
	
header("Content-Type: application/xml; charset=utf-8"); 
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 
 
function urlElement($url, $pri) {
echo '<url>'; 
echo '<loc>'.$url.'</loc>'; 
echo '<changefreq>weekly</changefreq>'; 
echo '<priority>'.$pri.'</priority>';
echo '</url>';
} 
 
urlElement('http://'.$config_url.'','1.0'); 
urlElement('http://'.$config_url.'/gioi-thieu.html','1.0'); 
urlElement('http://'.$config_url.'/san-pham.html','1.0');  
urlElement('http://'.$config_url.'/thuc-don.html','1.0');
urlElement('http://'.$config_url.'/album.html','1.0'); 
urlElement('http://'.$config_url.'/video.html','0.8'); 
urlElement('http://'.$config_url.'/lien-he.html','0.8'); 

///////////san-pham//////////////////////
$d->reset();
$sql = "select id,ten$lang as ten,tenkhongdau from #_product_danhmuc where hienthi=1 and type='san-pham' order by stt asc";
$d->query($sql);
$product_danhmuc = $d->result_array();

foreach($product_danhmuc as $v){
	urlElement('http://'.$config_url.'/san-pham/'.$v['tenkhongdau'],'0.8');
}

///////////san-pham//////////////////////
$d->reset();
$sql = "select id,ten$lang as ten,tenkhongdau from #_product_list where hienthi=1 and type='san-pham' order by stt asc";
$d->query($sql);
$product_list = $d->result_array();

foreach($product_list as $v){
	
	urlElement('http://'.$config_url.'/san-pham/'.$v['tenkhongdau'].'/','0.8');
}

///////////san-pham//////////////////////
$d->reset();
$sql = "select id,ten$lang as ten,tenkhongdau from #_product where hienthi=1 and type='san-pham' order by stt asc";
$d->query($sql);
$product = $d->result_array();

foreach($product as $v){
	urlElement('http://'.$config_url.'/san-pham/'.$v['tenkhongdau'].'.html','0.8');
}

///////////thuc-don//////////////////////
	$d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau from #_product where hienthi=1 and type='thuc-don' order by stt asc, id desc";
    $d->query($sql);
    $thucdon = $d->result_array(); 

foreach($thucdon as $v){
	urlElement('http://'.$config_url.'/thuc-don/'.$v['tenkhongdau'].'.html','0.8');
}


echo '</urlset>'; 
?>