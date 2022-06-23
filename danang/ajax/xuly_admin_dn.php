<?php
session_start();
@define('_source', '../sources/');
@define('_lib', '../lib/');
error_reporting(0);
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";
$d = new database($config['database']);
$act = $_REQUEST['act'];
switch ($act) {
    case 'remove_photo':
		remove_photo();
		break;
	case 'remove_image':
		remove_images();
		break;
	case 'remove_image1':
		remove_images1(); 
		break;
	case 'remove_image2':
		remove_images2(); 
		break;
	case 'remove_image_comment':
		remove_image_comment(); 
		break;
		
	case 'changeUrl':
		changeUrl();
		break;
	case 'change_stt':
		change_stt();
		break;
	case 'updateHD':
		updateHD();
		break;
	case 'checkName':
		checkName();
		break;
	case 'checkTenKhongDau':
		checkTenKhongDau();
		break;
}
?>
<?php
function change_stt(){
		global $d,$act;	
		$id=$_POST['id'];
		$data['stt']=$_POST['stt'];
		$d->reset();
		$d->setTable('hinhanh');
		$d->setWhere('id',$_POST['id']); 
		$d->update($data);
		die;
}

function remove_photo(){
	global $d,$act,$item;	
	$id=$_POST['id'];
	$table=$_POST['table'];
	$photo=$_POST['photo'];
	$format=$_POST['format'];
	$field=$_POST['field'];
	
		delete_file('../'.$format . $photo);
		$d->reset();
		$sql="update #_$table set $field='' where id='".$id."' ";
		if($d->query($sql)){
			echo json_encode(array("md5"=>md5($id)));
		}
	die;
	
}
function remove_images(){
		global $d,$act,$item;	
		$id=$_POST['id'];
		$d->reset();
		$sql_kt="select * from #_hinhanh where id='".$id."'";
		$d->query($sql_kt);
		if($d->num_rows()>0){
			$rs=$d->fetch_array();
			delete_file('../'._upload_product . $rs['photo']);
			
			$sql="delete from #_hinhanh where id='".$id."' ";
			if($d->query($sql)){
				echo json_encode(array("md5"=>md5($id)));
			}
		}
		
		
		die;
		
	}
function remove_images1(){
	global $d,$act,$item;	
	$id=$_POST['id'];
	$d->reset();
	$sql_kt="select * from #_hinhanh where id='".$id."'";
	$d->query($sql_kt);
	if($d->num_rows()>0){
		$rs=$d->fetch_array();
		delete_file('../'._upload_hinhanh . $rs['photo']);
		
		$sql="delete from #_hinhanh_hinhanh where id='".$id."' ";
		if($d->query($sql)){
			echo json_encode(array("md5"=>md5($id)));
		}
	}
	
	
	die;
	
}

function remove_images2(){
		global $d,$act,$item;	
		$id=$_POST['id'];
		$d->reset();
		$sql_kt="select * from #_hinhanh where id='".$id."'";
		$d->query($sql_kt);
		if($d->num_rows()>0){
			$rs=$d->fetch_array();
			delete_file('../'._upload_hinhthem . $rs['photo']);
			delete_file('../'._upload_hinhthem . $rs['thumb']);
			
			$sql="delete from #_hinhanh where id='".$id."' ";
			if($d->query($sql)){
				echo json_encode(array("md5"=>md5($id)));
			}
		}
		die;
	
}
function remove_image_comment(){
		global $d,$act,$item;	
		$id=$_POST['id'];
		$stt=$_POST['stt'];
		$d->reset();
		$sql_kt="select * from table_comment where id='".$id."'";
		$d->query($sql_kt);
		if($d->num_rows()>0){
			$rs=$d->fetch_array();
			delete_file('../'._upload_binhluan . $rs['photo'.$stt]);

			$d->reset();
			$sql="update table_comment set photo".$stt."='' where id='".$id."' ";
			$d->query($sql);
		}
		die;
	
}
function changeUrl(){
	global $act;
	$config_url = $_REQUEST['config_url'];
	$com = $_REQUEST['com'];
	$duoi = $_REQUEST['duoi'];
	echo changeTitle($_POST['ten']);
}

function updateHD(){
	global $act,$d;

	$d->reset();
	$sql_company = "select * from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();

	$data['domain_start']= ($_POST['domain_start'] != NULL)?strtotime($_POST['domain_start']):$company['domain_start'];
	$data['domain_end']= ($_POST['domain_end'] != NULL)?strtotime($_POST['domain_end']):$company['domain_end'];
	$data['hosting_start']= ($_POST['hosting_start'] != NULL)?strtotime($_POST['hosting_start']):$company['hosting_start'];
	$data['hosting_end']= ($_POST['hosting_end'] != NULL)?strtotime($_POST['hosting_end']):$company['hosting_end'];
	$data['link_huongdan']= ($_POST['link_huongdan'] != NULL)?addslashes($_POST['link_huongdan']):$company['link_huongdan'];

	$d->reset();
	$d->setTable('company');
	$d->setWhere('id',$company['id']);
	$d->update($data);

	$d->reset();
	$sql_company = "select * from #_company limit 0,1";
	$d->query($sql_company);
	$new_company= $d->fetch_array();

	?>
	<div class="mycol-6 mycol-mobi-12">
		<div class="infoHD_item">
	        <span class="infoHD_title mr-20">Tên miền:</span>
	        <span class="mr-20">Ngày bắt đầu: <span id="domain_start"><?=date('d-m-Y',$new_company['domain_start'])?></span> </span>
	        <span class="mr-20">Ngày kết thúc: <span id="domain_end"><?=date('d-m-Y',$new_company['domain_end'])?></span> </span>
	    </div>
	</div>
	<div class="mycol-6 mycol-mobi-12">
	    <div class="infoHD_item">
	        <span class="infoHD_title mr-20">Hosting:</span>
	        <span class="mr-20">Ngày bắt đầu: <span id="hosting_start"><?=date('d-m-Y',$new_company['hosting_start'])?></span> </span>
	        <span class="mr-20">Ngày kết thúc: <span id="hosting_end"><?=date('d-m-Y',$new_company['hosting_end'])?></span> </span>
	    </div>
	</div>

	<?php

}


function checkName(){
	global $d;	
	$id=$_POST['id'];
	$table=$_POST['table'];
	$ten=magic_quote(trim($_POST['ten']));
	$lang=($_POST['lang'] == 'vi')?'':$_POST['lang'];
	$d->reset();
	$sql="select id from #_".$table." where ten$lang = '".$ten."' ";
	$d->query($sql);
	$kq = $d->result_array();

	if(($id == 0 && count($kq) >= 1)||($id > 0 && count($kq) >= 1 && $kq[0]['id'] != $id))
	 echo 'Tên này đã tồn tại. Bạn nên nhập 1 tên khác cho bài viết!';
	
}

function checkTenKhongDau(){
	global $d;	
	$id=$_POST['id'];
	$table=$_POST['table'];
	$tenkhongdau=trim($_POST['tenkhongdau']);
	$array = array();
	
	if (checkRegexTenKhongDau($tenkhongdau)){
	    $d->reset();
		$sql="select id from #_".$table." where tenkhongdau = '".$tenkhongdau."' ";
		$d->query($sql);
		$kq = $d->result_array();

		if(($id == 0 && count($kq) >= 1)||($id > 0 && count($kq) >= 1 && $kq[0]['id'] != $id))
			$array["fail"] = "Url này đã tồn tại! Bạn phải thay đổi để website lấy đúng dữ liệu!";
		else
			$array["sucess"] = "ok";
	}else{
		$array["url_error"] = "Error! Bạn phải nhập tên không dấu, không có dấu cách và nối các từ bằng dấu '-'";
	}

	echo json_encode($array);
}