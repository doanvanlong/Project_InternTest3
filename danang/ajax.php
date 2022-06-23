<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_ip.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$login_name = 'DEVEL';
	$d = new database($config['database']);

	$do = (isset($_REQUEST['do'])) ? addslashes($_REQUEST['do']) : "";
    $do = trim(strip_tags($do));
    $do = htmlspecialchars($do);
    $do = mysqli_real_escape_string($d->db,$do);

    $act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
    $act = trim(strip_tags($act));
    $act = htmlspecialchars($act);
    $act = mysqli_real_escape_string($d->db,$act);


	if($do=='admin'){
		if($act=='login'){

			$username = (isset($_POST['email'])) ? addslashes($_POST['email']) : "";
		    $username = trim(strip_tags($username));
		    $username = htmlspecialchars($username);
		    $username = mysqli_real_escape_string($d->db,$username);

			$password = (isset($_POST['pass'])) ? addslashes($_POST['pass']) : "";
		    $password = trim(strip_tags($password));
		    $password = htmlspecialchars($password);
		    $password = mysqli_real_escape_string($d->db,$password);

			$ip = getRealIPAddress();
			kiemtraIP($ip); 

			$sql = "select * from #_user where username='".$username."'";
			$d->query($sql);
			if($d->num_rows() == 1){
				$row = $d->fetch_array();
				if($row['password'] == encrypt_password($config['secret'],$password,$config['salt'])){
					if($row["hienthi"]==1){

					resetthoigiankhoa($ip);
					//sendMailAdmin($ip, $username, $row["id"]);  
					$timenow = time();
					$id_user = $row['id'];
					$user_agent = $_SERVER['HTTP_USER_AGENT'];
					$sql="insert into #_user_log (id_user,ip,timelog,user_agent) values ('$id_user','$ip','$timenow','$user_agent')";
					$d->query($sql);
					$cookiehash = md5(sha1($row['password'].$row['username']));
					$token = md5(time());
					$sql = "update #_user SET login_session= '$cookiehash', lastlogin = '$timenow', user_token = '$token'  WHERE id ='$id_user'";
					$d->query($sql);
					$_SESSION['login_session'] = $cookiehash;
					$_SESSION['login_token'] = $token;

					$_SESSION[$login_name] = true;
					$_SESSION['login']['role'] = $row['role'];
					$_SESSION['login']['nhom'] = $row['role'];
					$_SESSION['login']['com'] = $row['com'];
					$_SESSION['isLoggedIn'] = true;
					$_SESSION['login']['username'] = $username;
					$_SESSION['login']['name'] = $row['ten'];
					$_SESSION['login']['id'] = $row['id'];
					$_SESSION['login']['secretkey'] = session_id().time();
					$_SESSION['ck'] = $config_url; 
					$sql_secret = "UPDATE table_user SET secretkey = '".$_SESSION['login']['secretkey']."'  WHERE id = ".$row['id']."";
					$result_secret = $d->query($sql_secret);
					
					echo '{"page":"index.php"}';

					}else{

						echo '{"mess":"Tài khoản đã bị khóa!"}';

					}
				}else {
					kiemtravakhoaIP($ip);
				}
			}else
			echo '{"mess":"Tên đăng nhập không tồn tại!"}'; 
		
			
		}				
	}	

	//Cap nhat so thu tu
	if($do=='number'){
		if($act=='update'){
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);;
			$num=(int)$_POST['num'];
			$sql="update #_$table set stt='$num' where id='$id' ";
			$d->query($sql);
		}
	}
	
	//Cap nhat trang thai
	if($do=='status'){
		if($act=='update'){						
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);
			$field=addslashes($_POST['field']);
			$d->reset();						
			$sql="update #_$table set $field =  where id='$id' ";
						
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_cart));
			echo json_encode($cart);
		}
	}
	
	//Cap nhat gio hang
	if($do=='cart'){
		if($act=='update'){						
			$id=(int)$_POST['id'];
			$sl=(int)$_POST['sl'];			
			
			$d->reset();						
			$d->query("update #_chitietdonhang set soluong='".$sl."' where id='".$id."'");
			
			$d->reset();
			$sql="select * from #_chitietdonhang where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();			
			$thanhtien=$result['gia']*$result['soluong'];
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($result['madonhang']));
			
			$d->reset();						
			$d->query("update #_donhang set tonggia='".get_tong_tien($result['madonhang'])."' where madonhang='".$result['madonhang']."'");
			
			echo json_encode($cart);
		}
	}
	
	//Xoa gio hang
	if($do=='cart'){
		if($act=='delete'){						
			$id=(int)$_POST['id'];
			$id_order=(int)$_POST['id_order'];			
			$d->reset();			
			$d->query("delete from #_chitietdonhang where id='".$id."'");
			
			$d->reset();
			$sql="select * from #_chitietdonhang where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();
			
			$d->reset();						
			$d->query("update #_donhang set tonggia='".get_tong_tien($id_order)."' where id='".$id_order."'");
									
			$cart=array('tongtien'=>get_tong_tien($id_order));
			echo json_encode($cart);
			
		}
	}
	
	//Xoa tag san pham
	if($do=='products'){
		if($act=='tags'){						
			$uni_tag = $_POST['uni_tag'];
			$id=(int)$_POST['id'];			
			$d->reset();			
			$d->query("delete from #_tag where item_id='".$id."' and  	unique_key_tag='$uni_tag'");
		}
	}
?>