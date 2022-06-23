<?php  if(!defined('_source')) die("Error");
	@$p =   trim(strip_tags(addslashes($_GET['p'])));	
	@$p =   htmlspecialchars($p);	
	@$p =   mysqli_real_escape_string($d->db,$p);
		
	$where = " hienthi=1 order by stt,id desc";	
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_video where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	$pageSize = 12;//Số item cho 1 trang
	$offset = 5;//Số trang hiển thị				
	if ($page == "")$page = 1;
	else $page = $p;
	$page--;
	$bg = $pageSize*$page;		
	
	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,link from #_video where $where limit $bg,$pageSize";		
	$d->query($sql);
	$videos = $d->result_array();	
	$url_link = getCurrentPageURL();

	#Chi tiết bài viết
	$sql = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_about where type='".$type."' limit 0,1";
	$d->query($sql);
	$text_video = $d->fetch_array();
	$seoNoiDung = $text_video['noidung'];
	$seoh2 = $text_video['h2'];
	#Thông tin seo web
	//$title_cat = 'Giới thiệu';		
	$title = $text_video['title']; 
	$keywords = $text_video['keywords'];
	$description = $text_video['description'];

	#Thông tin share facebook
	if($text_video['photo'] != ''){
		$images_facebook = "http://".$config_url.'/'._upload_hinhanh_l.$text_video['photo'];
	}else{
		$images_facebook='';
	}
	$title_facebook = $text_video['ten'];
	$description_facebook = trim(strip_tags($text_video['mota']));
	$url_facebook = getCurrentPageURL(); 

	

?>