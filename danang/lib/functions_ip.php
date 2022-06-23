<?php
function sendMailAdmin($ip, $username, $id_user){
	global $d, $config, $ip_host, $mail_host, $pass_mail, $config_url;
	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$d->reset();
	$sql="select * from table_user_log where id_user='".$id_user."' order by id desc limit 0,1";
	$d->query($sql);
	if($d->num_rows()>0){
		$rs=$d->fetch_array();
		 
		if($rs["ip"]!=$ip){
			$d->reset();
			$sql_company = "select *,ten$lang as ten,diachi$lang as diachi from #_company limit 0,1";
			$d->query($sql_company);
			$company= $d->fetch_array();
			
			
			$d->reset();
			$sql_company = "select noidung from #_about where type='mail' limit 0,1";
			$d->query($sql_company);
			$mail_content= $d->fetch_array();
			$urlLock="http://".$config_url."/lock.php?user=".base64_encode($username);
			$body=$mail_content["noidung"];
			$body=str_replace("%username%",$username, $body);
			$body=str_replace("%time%",gmdate('D, d m Y H:i:s T', (time()+25200)), $body);
			$body=str_replace("%ip%",$ip, $body);
			$body=str_replace("%urlLock%",$urlLock, $body);
			
			include_once "phpmailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;
			$mail->Port   = $config['mail_port']; 
			/*$mail->SMTPSecure   = 'ssl';  
			$mail->Port   = 465;*/ 

			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host,$company['ten']);

			//Thiết lập thông tin người nhận và email người nhận
			//$mail->AddAddress($company['email'], $company['ten']);
			$mail->AddAddress($company['email'], $company['ten']);
			
			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($mail_host, $company['ten']);


			//Thiết lập tiêu đề email
			$mail->Subject    = "Thư liên hệ [".$company["website"]."] Đăng nhập thành công từ IP mới ";
			//$mail->Subject    = "[DaNangWeb] Đăng nhập thành công từ IP mới ".$ip." - ".gmdate('D, d m Y H:i:s T', time());
			
			$mail->IsHTML(true);
			
			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";

			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

			//Thiết lập nội dung chính của email
			$mail->MsgHTML($body);
			
			$mail->Send();
		}
	}
}
function getRealIPAddress()
{
	$do_check = 0;
	$addrs = array();
	if( $do_check )
	{
		foreach( array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_f )
		{
			$x_f = trim($x_f);
			if( preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f) )
			{
				$addrs[] = $x_f;
			}
		}
		$addrs[] = $_SERVER['HTTP_CLIENT_IP'];
		$addrs[] = $_SERVER['HTTP_PROXY_USER'];
	}
	$addrs[] = $_SERVER['REMOTE_ADDR'];
	foreach( $addrs as $v )
	{
		if( $v )
		{
			preg_match("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $v, $match);
			$ip = $match[1].'.'.$match[2].'.'.$match[3].'.'.$match[4];

			if( $ip && $ip != '...' )
			{
				break;
			}
		}
	}
	return $ip;
}


function resetthoigiankhoa($ip){
	global $d,$config;
	$d->reset();
	$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";
	$d->query($sql);
		if($d->num_rows()==1){
			$row_limitlogin = $d->result_array();
        $id_login = $row_limitlogin[0]['id'];
        $sql="update #_user_limit set login_attempts = 0,locked_time = 0 where id = '$id_login'";
		$d->query($sql);
   	}
}

function kiemtraIP($ip){
	global $d,$config;
	$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit WHERE login_ip =  '$ip'  ORDER BY id DESC LIMIT 1 ";
	$d->query($sql);
	if($d->num_rows() == 1){
	  	$row = $d->result_array();
	  	$id_login = $row[0]['id'];
	    $time_now = time();
	    if($row[0]['locked_time']>0){
		    $locked_time = $row[0]['locked_time'];
		    $delay_time = $config['login']['delay'];
		    $interval = $time_now  - $locked_time;
		    if($interval <= $delay_time*60){
		    	$time_remain = $delay_time*60 - $interval;
		        $msg = "Xin lỗi..!Vui lòng thử lại sau ". round($time_remain/60)." phút..!";
		        die('{"mess":"'.$msg.'"}');
	        }else{
	        	$sql="update #_user_limit set login_attempts = 0,attempt_time = '$time_now' ,locked_time = 0 where id = '$id_login'";
						$d->query($sql);
	        }
        }
	}
}


function kiemtravakhoaIP($ip){
  	global $d,$config;
  $d->reset();
  $sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";
  $d->query($sql);
  if($d->num_rows()==1){//Trường hơp đã tồn tại trong database
    $row = $d->result_array();
    $id_login = $row[0]['id'];
    $attempt =$row[0]['login_attempts'];//Số lần thực hiện
    $noofattmpt = $config['login']['attempt'];//Số lần giới hạn
    if($attempt<$noofattmpt){//Trường hợp còn trong giới hạn
        $attempt = $attempt +1;
        $sql="update #_user_limit set login_attempts = '$attempt' where id = '$id_login'";
        $d->query($sql);
        $no_ofattmpt =  $noofattmpt+1;
        $remain_attempt = $no_ofattmpt - $attempt;
        $msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';
    }else{//Trường hợp vượt quá giới hạn
        if($row[0]['locked_time']==0){
            $attempt = $attempt +1;
            $timenow = time();
            $sql="update #_user_limit set login_attempts = '$attempt' ,locked_time = '$timenow' where id = '$id_login'";
            $d->query($sql);
        }else{
            $attempt = $attempt +1;
            $sql="update #_user_limit set login_attempts = '$attempt' where id = '$id_login'";
            $d->query($sql);
       }
      $delay_time = $config['login']['delay'];
      $msg = "Bạn đã hết lần thử. Vui lòng thử lại sau ".$delay_time." phút!";
    }
  }else{
      $timenow = time();
      $d->reset();
      $sql="insert into #_user_limit (login_ip,login_attempts,attempt_time,locked_time) values('$ip',1,'$timenow',0)";
      $d->query($sql);
      $remain_attempt = $config['login']['attempt'];
      $msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';
  }
  die('{"mess":"'.$msg.'"}');
}