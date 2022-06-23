<?php  if(!defined('_source')) die("Error");
	
	#Chi tiết bài viết
	$sql = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_about where type='".$type."' limit 0,1";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	#Thông tin seo web
	//$title_cat = 'Giới thiệu';		
	$seoh2 = $tintuc_detail['h2']; 
	$title = $tintuc_detail['title']; 
	$keywords = $tintuc_detail['keywords'];
	$description = $tintuc_detail['description'];

	#Thông tin share facebook
	if($tintuc_detail['photo'] != ''){
		$images_facebook = "http://".$config_url.'/'._upload_hinhanh_l.$tintuc_detail['photo'];
	}else{
		$images_facebook='';
	}
	$title_facebook = $tintuc_detail['ten'];
	$description_facebook = trim(strip_tags($tintuc_detail['mota']));
	$url_facebook = getCurrentPageURL(); 
	
?>