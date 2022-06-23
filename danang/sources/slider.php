<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&curPage=".addslashes($_REQUEST['p']) : "";

switch($act){

	case "man_photo":
		get_photos();
		$template = "slider/photos";
		break;
	case "add_photo":		
		$template = "slider/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "slider/photo_add";
		break;
	case "save_photo":
		save_photo();
		break;
	case "savestt_photo":
		savestt_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;	

	//text  
	
	case "man_text":
		get_texts();
		$template = "slider/texts";
		break;
	case "add_text":		
		$template = "slider/text_edit";
		break;
	case "edit_text":
		get_text();
		$template = "slider/text_edit";
		break;
	case "save_text":
		save_text();
		break;
	case "delete_text":
		delete_text();
		break;	
	default:
		$template = "index";
}

function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_photos(){	
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by stt,id desc";	
	
	$sql="SELECT count(id) AS numrows FROM #_slider where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_slider where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=slider&act=man_photo".$urlcu;
}

function get_photo(){
	global $d, $item, $list_cat,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=slider&act=man_photo".$urlcu);
	$d->setTable('slider');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=slider&act=man_photo".$urlcu);
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d,$urlcu,$config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=slider&act=man_photo".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			$file_name = $_FILES['file']['name'];
			if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name)){
				$data['photo'] = $photo;
				$d->setTable('slider');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo']);
				}
			}
			
			$data['id_slider'] = $_REQUEST['id_slider'];
			$data['type'] = $_REQUEST['type'];
			$data['vitri'] = $_POST['vitri'];
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];	
			$data['thoigian'] = strtotime($_POST['thoigian']);	
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
			
			foreach ($config['lang'] as $key => $value) {
				$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
				$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			}

			$d->reset();
			$d->setTable('slider');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=slider&act=man_photo".$urlcu);
			redirect("index.php?com=slider&act=man_photo".$urlcu);
	}
	{ 			
			$file_name = $_FILES['file']['name'];
			if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name))
			{							
				$data['photo'] = $photo;
			}
			$data['id_slider'] = $_REQUEST['id_slider'];
			$data['type'] = $_REQUEST['type'];
			$data['vitri'] = $_POST['vitri'];
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];
			$data['thoigian'] = strtotime($_POST['thoigian']);		
			
			foreach ($config['lang'] as $key => $value) {
				$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
				$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			}
													
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;	
			$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;																	
			$d->setTable('slider');
			if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=slider&act=man_photo".$urlcu);
			redirect("index.php?com=slider&act=man_photo".$urlcu);
	}
}
//===========================================================
function delete_photo(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('slider');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=slider&act=man_photo".$urlcu);
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo']);
		if($d->delete())
			redirect("index.php?com=slider&act=man_photo".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=slider&act=man_photo".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_slider where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);
			}
			$sql = "delete from #_slider where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=slider&act=man_photo".$urlcu);} else transfer("Không nhận được dữ liệu", "index.php?com=slider&act=man_photo".$urlcu);
}
///text
function get_texts(){	
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by stt,id desc";	
	
	$sql="SELECT count(id) AS numrows FROM #_slider where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_slider where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=slider&act=man_text".$urlcu;
}

function get_text(){
	global $d, $item, $list_cat,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=slider&act=man_text".$urlcu);
	$d->setTable('slider');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=slider&act=man_text".$urlcu);
	$item = $d->fetch_array();	
}

function save_text(){ 
	global $d,$urlcu,$config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=slider&act=man_text".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			$file_tl_name = $_FILES['file_tl']['name'];
			if($file_tl = upload_image("file_tl", _format_duoitailieu, _upload_files,$file_tl_name)){
				$data['file_tl'] = $file_tl;
				$d->setTable('news');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_files.$row['file_tl']);
				}
			}
			$data['id_slider'] = $_REQUEST['id_slider'];
			$data['type'] = $_REQUEST['type'];
			$data['vitri'] = $_POST['vitri'];
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];	
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
			
			foreach ($config['lang'] as $key => $value) {
				$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
				$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			} 

			$d->reset();
			$d->setTable('slider');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=slider&act=man_text".$urlcu);
			redirect("index.php?com=slider&act=man_text".$urlcu);
			
	}else{ 
			$file_tl_name = $_FILES['file_tl']['name'];
			if($file_tl = upload_image("file_tl", _format_duoitailieu, _upload_files,$file_tl_name)){
				$data['file_tl'] = $file_tl;
			}

			$data['id_slider'] = $_REQUEST['id_slider'];
			$data['type'] = $_REQUEST['type'];
			$data['vitri'] = $_POST['vitri'];
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];	
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;	
			$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;	
			
			foreach ($config['lang'] as $key => $value) {
				$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
				$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			}
																			
			$d->setTable('slider');
			if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=slider&act=man_text".$urlcu);
			redirect("index.php?com=slider&act=man_text".$urlcu);
	}
}
//===========================================================
function delete_text(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('slider');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=slider&act=man_text".$urlcu);
		$row = $d->fetch_array();
		delete_file(_upload_files.$row['file_tl']);
		if($d->delete())
			redirect("index.php?com=slider&act=man_text".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=slider&act=man_text".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_slider where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_files.$row['file_tl']);
			}
			$sql = "delete from #_slider where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=slider&act=man_text".$urlcu);} else transfer("Không nhận được dữ liệu", "index.php?com=slider&act=man_text".$urlcu);
}
?>


