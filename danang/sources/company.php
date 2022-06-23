<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "company/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;
	$sql = "select * from #_company limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
function save_gioithieu(){
	global $d,$config;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=company&act=capnhat");
	$data['tenbinhluan'] = $_POST['tenbinhluan'];	
	foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];	
			$data['dienthoai'.$key] = $_POST['dienthoai'.$key];
			$data['diachi'.$key] = $_POST['diachi'.$key];	
			$data['slogan'.$key] = $_POST['slogan'.$key];		
			$data['diachi2'.$key] = $_POST['diachi2'.$key];		
	}
	$data['toado'] =$_POST['toado'];
	$file_name = $_FILES['favicon']['name'];

	if($favicon = upload_image("favicon", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['favicon'] = $favicon;
			$data['faviconthumb'] = create_thumb($data['favicon'], 32, 32, _upload_hinhanh,$file_name,2);
			$d->setTable('company');			
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['favicon']);
				delete_file(_upload_hinhanh.$row['faviconthumb']);
			}
	}
	if($sitemap = upload_image("sitemap", "xml|XML","../","sitemap")){
			$data['sitemap'] = $sitemap;
	}
	$data['email2'] = $_POST['email2'];
	$data['hotline'] = $_POST['hotline'];
	$data['giolamviec'] = $_POST['giolamviec'];
	$data['ngaylamviec'] = $_POST['ngaylamviec'];
	$data['zalo'] = $_POST['zalo'];
	$data['copyright'] = $_POST['copyright'];
	$data['link'] = $_POST['link'];
	
	$data['email'] = $_POST['email'];
	$data['website'] = $_POST['website'];
	$data['fax'] = $_POST['fax'];	
	$data['keygoogle'] = $_POST['keygoogle'];	
	$data['yahoo'] = $_POST['yahoo'];
	$data['skype'] = $_POST['skype'];	
	$data['fanpage'] = $_POST['fanpage'];
	$data['facebook'] = $_POST['facebook'];	
	$data['tiwtter'] = $_POST['tiwtter'];
	$data['google'] = $_POST['google'];	
	$data['youtube'] = $_POST['youtube'];
	$data['webmaster'] = $_POST['webmaster'];
	$data['analytics'] = magic_quote($_POST['analytics']);
	$data['codethem'] = magic_quote($_POST['codethem']);
	$data['headerjs'] = magic_quote($_POST['headerjs']);
	$data['link_googlemap'] = magic_quote($_POST['link_googlemap']);
	
	$data['soluong_sp'] = $_POST['soluong_sp'];
	$data['soluong_spk'] = $_POST['soluong_spk'];
	$data['soluong_tin'] = $_POST['soluong_tin'];
	$data['soluong_tink'] = $_POST['soluong_tink'];	
	$data['lang_default'] = $_POST['lang_default'];
	
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);

	
	$d->reset();
	$d->setTable('company');
	if($d->update($data))
		redirect("index.php?com=company&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=company&act=capnhat");
}

?>