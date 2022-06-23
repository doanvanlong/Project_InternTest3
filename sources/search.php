<?php  if(!defined('_source')) die("Error");
	
	if(isset($_GET['keyword'])){

		$where ='';
		$title_add ='';

		$id_danhmuc =  isset($_GET['id_danhmuc']) ?$_GET['id_danhmuc']:0;
		$id_danhmuc =  addslashes($id_danhmuc);
		$id_danhmuc =  trim(strip_tags($id_danhmuc));
		$id_danhmuc =  htmlspecialchars($id_danhmuc);
		$id_danhmuc =  mysqli_real_escape_string($d->db,$id_danhmuc);
		
		if($id_danhmuc){
			$where .= " id_danhmuc = '".$id_danhmuc."' and ";

			$d->reset();
			$sql = "SELECT ten$lang as ten FROM #_product_danhmuc where id='".$id_danhmuc."'";
			$d->query($sql);	
			$s_danhmuc = $d->fetch_array();
			$title_add .=_trongdanhmuc.' "'.$s_danhmuc['ten'].'"';
		}

		$tukhoa =  addslashes($_GET['keyword']);
		$tukhoa = trim(strip_tags($tukhoa)); 
		$tukhoa = htmlspecialchars($tukhoa); 
		$tukhoa = mysqli_real_escape_string($d->db,$tukhoa);

		$where .= " (ten$lang LIKE '%$tukhoa%') and hienthi=1 and type='".$type."' order by stt,id desc";
		
		#Lấy sản phẩm và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_GET['p'];
		$pageSize = $company['soluong_sp'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1; 
		else $page = $_GET['p'];
		$page--;
		$bg = $pageSize*$page;		
		
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,photo,gia,giakm from #_product where $where limit $bg,$pageSize";		
		$d->query($sql);
		$product = $d->result_array();	
		$url_link = getCurrentPageURL();
		$com='san-pham';

		$breadcumbs[]= array('',$totalRows.' '._ketquatimkiem.' keyword = "'.$tukhoa.'" '.$title_add);
	}	
?>