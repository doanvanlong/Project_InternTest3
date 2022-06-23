<?php  if(!defined('_source')) die("Error");

	@$id_danhmuc =   trim(strip_tags(addslashes($_GET['id_danhmuc'])));
	@$id_list =   trim(strip_tags(addslashes($_GET['id_list'])));
	@$id_cat =   trim(strip_tags(addslashes($_GET['id_cat'])));
	@$id =   trim(strip_tags(addslashes($_GET['id'])));	
	@$p =   trim(strip_tags(addslashes($_GET['p'])));	

	@$id_danhmuc =   htmlspecialchars(@$id_danhmuc);
	@$id_list =   htmlspecialchars(@$id_list);
	@$id_cat =   htmlspecialchars(@$id_cat);
	@$id =   htmlspecialchars(@$id);	
	@$p =   htmlspecialchars(@$p);	

	@$id_danhmuc =   mysqli_real_escape_string($d->db,@$id_danhmuc);
	@$id_list =   mysqli_real_escape_string($d->db,@$id_list);
	@$id_cat =   mysqli_real_escape_string($d->db,@$id_cat);
	@$id =   mysqli_real_escape_string($d->db,@$id);	
	@$p =   mysqli_real_escape_string($d->db,@$p);	
	
	if($id!='') 
	{
		//Cập nhật lượt xem
		$sql_lanxem = "UPDATE #_news SET luotxem=luotxem+1  WHERE tenkhongdau ='$id'";
		$d->query($sql_lanxem);
		
		#Chi tiết tin tức
		$sql = "select *,ten$lang as ten,id,mota$lang as mota,noidung$lang as noidung from #_news where tenkhongdau='".$id."' and  type= '$type' and ngaytao <=".time()."  limit 0,1";
		$d->query($sql);
		if($d->num_rows()==0){
			redirect('/index.html');
		}
		$tintuc_detail = $d->fetch_array();

		if($tintuc_detail['id_danhmuc'] > 0){
			//lấy thông tin danh mục cấp 1
			$d->reset();
			$sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where hienthi=1 and id=".$tintuc_detail['id_danhmuc']." limit 0,1";
			$d->query($sql);
			if($d->num_rows()){
				$danhmuc = $d->fetch_array();
				$breadcumbs[]=array($com.'/'.$danhmuc['tenkhongdau'],$danhmuc['ten']);
			}
		}
		//lấy thông tin danh mục cấp 2
		if($tintuc_detail['id_list'] > 0){
			$d->reset();
			$sql = "select id,ten$lang as ten,tenkhongdau from #_news_list where hienthi=1 and id=".$tintuc_detail['id_list']." limit 0,1";
			$d->query($sql);
			if($d->num_rows()){
				$n_list = $d->fetch_array();
				$breadcumbs[]=array($com.'/'.$n_list['tenkhongdau'].'/',$n_list['ten']);
			}
		}

		//lấy thông tin danh mục cấp 3
		if($tintuc_detail['id_cat'] > 0){
			$d->reset();
			$sql = "select id,ten$lang as ten,tenkhongdau from #_news_cat where hienthi=1 and id=".$tintuc_detail['id_cat']." limit 0,1";
			$d->query($sql);
			if($d->num_rows()){
				$n_cat = $d->fetch_array();
				$breadcumbs[]=array($com.'/'.$n_cat['tenkhongdau'].'/',$n_cat['ten']);
			}
		}

		$breadcumbs[]= array('',$tintuc_detail['ten']);
		
		#Thông tin seo web
		$title_cat = $tintuc_detail['ten'];		
		$title = $tintuc_detail['title'];
		$keywords = $tintuc_detail['keywords'];
		$description = $tintuc_detail['description'];
		
		#Thông tin share facebook
		if($tintuc_detail['photo']!=''){$images_facebook = "http://".$config_url.'/'._upload_tintuc_l.$tintuc_detail['photo'];}
		$title_facebook = $tintuc_detail['ten'];
		$description_facebook = trim(strip_tags($tintuc_detail['mota']));
		$url_facebook = getCurrentPageURL();
		
		#Các hình khác của dự án
		$sql_hinhkhac = "select id,ten,thumb,photo from #_hinhanh where type='".$type."' and hienthi=1 and id_hinhanh=".$tintuc_detail['id']." order by stt,id desc";
		$d->query($sql_hinhkhac);
		$hinhkhac = $d->result_array();
		
		#Các tin cũ hơn		
		$where = " type='".$type."' and hienthi=1 and id<>'".$tintuc_detail['id']."' and id_danhmuc='".$tintuc_detail['id_danhmuc']."' and id_list='".$tintuc_detail['id_list']."' and ngaytao <=".time()." order by  stt,id desc";		
	}
	#Danh mục tin tức
	elseif($id_danhmuc!='')
	{		
		$sql = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_news_danhmuc where hienthi=1 and tenkhongdau='$id_danhmuc' limit 0,1";
		$d->query($sql);
		if($d->num_rows()==0){
			redirect('/index.html');
		}
		$title_new = $d->fetch_array();
		$seoNoiDung = $title_new['noidung'];
		$seoh2 = $title_new['h2'];
		$breadcumbs[]=array($com.'/'.$title_new['tenkhongdau'],$title_new['ten']);
		
		#Thông tin seo web
		$title_cat = $title_new['ten'];		
		$title = $title_new['title'];
		$keywords = $title_new['keywords'];
		$description = $title_new['description'];

		#Thông tin share facebook
		if($title_new['photo']!=''){$images_facebook = "http://".$config_url.'/'._upload_tintuc_l.$title_new['photo'];}
		$title_facebook = $title_new['ten'];
		$description_facebook = trim(strip_tags($title_new['mota']));
		$url_facebook = getCurrentPageURL();
		
		#Điều kiện lấy danh mục
		$where = " type='".$type."' and id_danhmuc=".$title_new['id']." and hienthi=1 and ngaytao <=".time()."  order by  stt,id desc";	
		
	}
	elseif($id_list!='')
	{		
		$sql = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_news_list where hienthi=1 and tenkhongdau='$id_list' limit 0,1";
		$d->query($sql);
		if($d->num_rows()==0){
			redirect('/index.html');
		}
		$title_new = $d->fetch_array();
		$seoh2 = $title_new['h2'];
		$seoNoiDung = $title_new['noidung'];
		
		//lấy thông tin danh mục cha
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where hienthi=1 and id=".$title_new['id_danhmuc']." limit 0,1";
		$d->query($sql);
		if($d->num_rows()){
			$danhmuc = $d->fetch_array();
			$breadcumbs[]=array($com.'/'.$danhmuc['tenkhongdau'],$danhmuc['ten']);
		}

		$breadcumbs[]=array('',$title_new['ten']);
		
		#Thông tin seo web
		$title_cat = $title_new['ten'];		
		$title = $title_new['title'];
		$keywords = $title_new['keywords'];
		$description = $title_new['description'];

		#Thông tin share facebook
		if($title_new['photo']!=''){$images_facebook = "http://".$config_url.'/'._upload_tintuc_l.$title_new['photo'];}
		$title_facebook = $title_new['ten'];
		$description_facebook = trim(strip_tags($title_new['mota']));
		$url_facebook = getCurrentPageURL();
		
		#Điều kiện lấy danh mục
		$where = " type='".$type."' and id_list=".$title_new['id']." and hienthi=1 and ngaytao <=".time()."  order by  stt,id desc";	
		
	}
	elseif($id_cat!='')
	{		
		$sql = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_news_cat where hienthi=1 and tenkhongdau='".$id_cat."' limit 0,1";
		$d->query($sql);
		$title_new = $d->fetch_array();
		$seoh2 = $title_new['h2'];
		$seoNoiDung = $title_new['noidung'];
		if($title_new['id_danhmuc'] > 0){
			//lấy thông tin danh mục cấp 1
			$d->reset();
			$sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where hienthi=1 and id=".$title_new['id_danhmuc']." limit 0,1";
			$d->query($sql);
			if($d->num_rows()){
				$danhmuc = $d->fetch_array();
				$breadcumbs[]=array($com.'/'.$danhmuc['tenkhongdau'],$danhmuc['ten']);
			}
		}
		//lấy thông tin danh mục cấp 2
		if($title_new['id_list'] > 0){
			$d->reset();
			$sql = "select id,ten$lang as ten,tenkhongdau from #_news_list where hienthi=1 and id=".$title_new['id_list']." limit 0,1";
			$d->query($sql);
			if($d->num_rows()){
				$n_list = $d->fetch_array();
				$breadcumbs[]=array($com.'/'.$n_list['tenkhongdau'].'/',$n_list['ten']);
			}
		}
		
		#Thông tin seo web
		$title_cat = $title_new['ten'];		
		$title = $title_new['title'];
		$keywords = $title_new['keywords'];
		$description = $title_new['description'];

		#Thông tin share facebook
		if($title_new['photo']!=''){$images_facebook = "http://".$config_url.'/'._upload_tintuc_l.$title_new['photo'];}
		$title_facebook = $title_new['ten'];
		$description_facebook = trim(strip_tags($title_new['mota']));
		$url_facebook = getCurrentPageURL();
		
		#Điều kiện lấy danh mục
		$where = " type='".$type."' and id_cat=".$title_new['id']." and hienthi=1 and ngaytao <=".time()."  order by  stt,id desc";	
		
	}
	#Tất cả Tin tức có type là $type
	else{	
		$where = " type='".$type."' and hienthi=1 and ngaytao <=".time()."  order by  stt,id desc";	
		//seopage
		$sql = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_about where type='".$type."' ";
		$d->query($sql);
		$seopage = $d->fetch_array();
		$seoh2 = $seopage['h2'];
		$seoNoiDung = $seopage['noidung'];
		$title = $seopage['title']; 
		$keywords = $seopage['keywords'];
		$description = $seopage['description'];
		#Thông tin share facebook
		if($seopage['photo'] != ''){
			$images_facebook = "http://".$config_url.'/'._upload_hinhanh_l.$seopage['photo'];
		}
		$title_facebook = $seopage['ten'];
		$description_facebook = trim(strip_tags($seopage['mota']));
		$url_facebook = getCurrentPageURL();
	}
	
	#Lấy tin tức và phân trang
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_news where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $p;
	if($id>0)
	{
		$pageSize = $company['soluong_tink'];//Số tin khác cho 1 trang
	}
	else
	{
		$pageSize = $company['soluong_tin'];//Số tin cho 1 trang
	}
	$offset = 5;//Số trang hiển thị				
	if ($page == "")$page = 1;
	else $page = $p;
	$page--;
	$bg = $pageSize*$page;		
	
	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,mota$lang as mota,thumb,ngaytao,photo,id_danhmuc,diachi from #_news where $where limit $bg,$pageSize";		
	$d->query($sql);
	$tintuc = $d->result_array();	
	
	$url_link = getCurrentPageURL();
?>