<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

switch($act){
	case "login":
		if(!empty($_POST)) login();
		$template = "user/login";
		break;
	case "admin_edit":
		edit();
		$template = "user/admin_add";
		break;
	case "logout":
		logout();
		break;	
	case "userLog":
		get_userLogs();
		$template = "user/items";
		break;
	case "man":
		get_items();
		$template = "user/items";
		break;
	case "add":
		$template = "user/item_add";
		break;
	case "edit":
		get_item();
		$template = "user/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	default:
		$template = "index";
}

//////////////////
function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	/* if($_SESSION['login']['role']!='3'){
		transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	
	if($_REQUEST['keyword']!='')
	{
		$where.=" and email like '%".$_REQUEST['keyword']."%'";
	}
	$where.=" and com!='admin' order by username";

	$sql="SELECT count(id) AS numrows FROM #_user where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_user where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=user&act=man".$urlcu;
}
function get_userLogs(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	/* if($_SESSION['login']['role']!='3'){
		transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	
	if($_REQUEST['keyword']!='')
	{
		$where.=" and email like '%".$_REQUEST['keyword']."%'";
	}
	$where.=" and username!='danangweb' order by username";

	$sql="SELECT count(id) AS numrows FROM #_user where id<>0 and hienthi=0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_user where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=user&act=man".$urlcu;
}

function get_item(){
	global $d, $item;
	
	/* if($_SESSION['login']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	
	$sql = "select * from #_user where id='".$id."' and com!='admin'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=user&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	if($_SESSION['login']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} 
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){ // cap nhat
		$id =  themdau($_POST['id']);

		// kiem tra ten trung
		$sql = "select * from #_user where id!='".$id."' and username='".$_POST['username']."'";
		$d->query($sql);
		if($d->num_rows() > 0) transfer("Tên đăng nhập này đã có.<br>Xin chọn tên khác.","index.php?com=user&act=edit&id=".$id);
		$data['username'] = $_POST['username'];


		if($_POST['oldpassword']!=""){
			$data['password'] = encrypt_password($config['secret'],$_POST['oldpassword'],$config['salt']);
		}

		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['ngaysinh'] = $_POST['ngaysinh'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['country'] = $_POST['country'];
		$data['city'] = $_POST['city'];
		$data['quyen'] = $_POST['quyen'];
		$data['nhom'] = (int)$_POST['group'];
		$data['role'] = (int)$_POST['role'];
		$data['active'] = isset($_POST['active']) ? 1 : 0;
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		//$d->setWhere('role', 1);
		if($d->update($data))
			redirect( "index.php?com=user&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man");
	
	}else{ // them moi
	
		// kiem tra ten trung
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_POST['username']);
		$d->select();
		if($d->num_rows()>0) transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=add");
		
		if($_POST['oldpassword']=="") transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add");
		
		$data['username'] = $_POST['username'];
		$data['password'] = encrypt_password($config['secret'],$_POST['oldpassword'],$config['salt']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['ngaysinh'] = $_POST['ngaysinh'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['country'] = $_POST['country'];
		$data['city'] = $_POST['city'];
		$data['nhom'] = (int)$_POST['group'];
		$data['role'] = (int)$_POST['role'];
		$data['active'] = isset($_POST['active']) ? 1 : 0;
		$data['quyen'] = $_POST['quyen'];
		
		//$data['role'] = 1;
		$data['com'] = "user";
		
		$d->setTable('user');
		if($d->insert($data)){

			redirect("index.php?com=user&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man");
	}
}

function delete_item(){
	global $d;
	if($_SESSION['login']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	}
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		// kiem tra
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role'] ==3) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
		}
		
		// xoa item
		$sql = "delete from #_user where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=user&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=man");
	}
	elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	
			$d->reset();
			$d->setTable('user');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role'] ==3) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
		}
		$sql = "delete from #_user where id='".$id."'";	
		$d->query($sql);	
		} 
		redirect("index.php?com=user&act=man".$urlcu);
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
}

///////////////////////
function edit(){
	global $d, $item, $login_name,$config;
	
	if(!empty($_POST)){
		
		$sql = "select * from #_user where username!='".$_SESSION['login']['username']."' and username='".$_POST['username']."'";
		$d->query($sql);
		if($d->num_rows() > 0) transfer("Tên đăng nhập này đã có","index.php?com=user&act=admin_edit");
		
		$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
		$d->query($sql);
		if($d->num_rows() == 1){
			$row = $d->fetch_array();
		if($_POST['new_pass']!=''){
			
			if($row['password'] != encrypt_password($config['secret'],$_POST['oldpassword'],$config['salt'])) transfer("Mật khẩu không chính xác","index.php?com=user&act=edit");
			}
		}
		$data['username'] = $_POST['username'];
		if($_POST['new_pass']!="")
			$data['password'] = encrypt_password($config['secret'],$_POST['new_pass'],$config['salt']);
		$data['ten'] = $_POST['ten'];
		$data['email'] = $_POST['email'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_SESSION['login']['username']);
		if($d->update($data)){
			session_unset();
			redirect("index.php");
		}
	}
	
	$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
	$d->query($sql);
	
	if($d->num_rows() == 1){
		$item = $d->fetch_array();
	}
}
function logout(){
	global $login_name,$d;
	$_SESSION[$login_name] = false;
	$sql_secret = "UPDATE table_user SET secretkey = ''  WHERE id = ".$_SESSION['login']['id']."";
	$result_secret = $d->query($sql_secret);
	$_SESSION['login'] = null;
	session_unset();
	transfer("Đăng xuất thành công", "index.php?com=user&act=login");
}

?>