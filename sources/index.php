<?php if (!defined('_source')) die("Error");

$seoNoiDung = $seo_company['noidung'];

if (isset($_POST['submit_dangky'])) {

	$ten = addslashes($_POST['ten_dangky']);
	$dienthoai = addslashes($_POST['dienthoai_dangky']);
	$email = addslashes($_POST['email_dangky']);
	$diachi = addslashes($_POST['diachi_dangky']);
	$sanpham = addslashes($_POST['sanpham_dangky']);
	$soluong = addslashes($_POST['soluong_dangky']);
	$noidung = addslashes($_POST['noidung_dangky']);

	$ten = trim(strip_tags($ten));
	$dienthoai = trim(strip_tags($dienthoai));
	$email = trim(strip_tags($email));
	$diachi = trim(strip_tags($diachi));
	$sanpham = trim(strip_tags($sanpham));
	$soluong = trim(strip_tags($soluong));
	$noidung = trim(strip_tags($noidung));

	$ten = htmlspecialchars($ten);
	$dienthoai = htmlspecialchars($dienthoai);
	$email = htmlspecialchars($email);
	$diachi = htmlspecialchars($diachi);
	$sanpham = htmlspecialchars($sanpham);
	$soluong = htmlspecialchars($soluong);
	$noidung = htmlspecialchars($noidung);

	$ten = mysqli_real_escape_string($d->db, $ten);
	$dienthoai = mysqli_real_escape_string($d->db, $dienthoai);
	$email = mysqli_real_escape_string($d->db, $email);
	$diachi = mysqli_real_escape_string($d->db, $diachi);
	$sanpham = mysqli_real_escape_string($d->db, $sanpham);
	$soluong = mysqli_real_escape_string($d->db, $soluong);
	$noidung = mysqli_real_escape_string($d->db, $noidung);

	if ($ten == '') {
		transfer("Bạn chưa nhập tên", getCurrentPageURL());
	}
	if ($dienthoai == '') {
		transfer("Bạn chưa nhập số điện thoại", getCurrentPageURL());
	}
	if ($email == '') {
		transfer("Bạn chưa nhập email", getCurrentPageURL());
	}
	if ($diachi == '') {
		transfer("Bạn chưa nhập địa chỉ", getCurrentPageURL());
	}
	if ($sanpham == '') {
		transfer("Bạn chưa nhập sản phẩm", getCurrentPageURL());
	}
	if ($soluong == '') {
		transfer("Bạn chưa nhập số lượng", getCurrentPageURL());
	}
	if ($noidung == '') {
		transfer("Bạn chưa nhập nội dung", getCurrentPageURL());
	}

	//check số điện thoại chưa các đầu số nhà mạng việt nam
	if (!checkPhoneVietNam($dienthoai)) {
		transfer("Số điện thoại không hợp lệ", "index.html");
	}
	//check email chứa @gmail.com
	if (!checkEmail($email)) {
		transfer("Email không hợp lệ", "index.html");
	}

	//check nội dung chứa từ tiếng anh
	if (checkContentEnglish($noidung)) {
		transfer("Nội dung không hợp lệ", "index.html");
	}

	$data['ten'] = $ten;
	$data['dienthoai'] = $dienthoai;
	$data['email'] = $email;
	$data['diachi'] = $diachi;
	$data['sanpham'] = $sanpham;
	$data['donvi'] = $soluong;
	$data['noidung'] = $noidung;
	$data['type'] = 'dang-ky';
	$data['ngaytao'] = time();
	$d->reset();
	$d->setTable('contact');
	if ($d->insert($data)) {
		include_once "phpMailer/class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
		$mail->Host       = $ip_host;   // tên SMTP server
		$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
		$mail->Username   = $mail_host; // SMTP account username
		$mail->Password   = $pass_mail;
		$mail->Port   = $config['mail_port'];
		/*$mail->SMTPSecure   = 'ssl';
		$mail->Port   = 587;*/

		//Thiết lập thông tin người gửi và email người gửi
		$mail->SetFrom($mail_host, $company['ten']);

		//Thiết lập thông tin người nhận và email người nhận
		//$mail->AddAddress($company['email2'], $company['ten']);
		$mail->AddAddress($company['email2'], $company['ten']);
		$mail->AddAddress($email, $ten);


		//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($email, $ten);

		//Thiết lập file đính kèm nếu có
		/*if(!empty($_FILES['img_dangky']))
		{
			$mail->AddAttachment($_FILES['img_dangky']['tmp_name'], $_FILES['img_dangky']['name']);	
		}*/

		//Thiết lập tiêu đề email
		$mail->Subject    = "Thư đăng ký tư vấn ";
		$mail->IsHTML(true);

		//Thiết lập định dạng font chữ tiếng việt
		$mail->CharSet = "utf-8";
		$body = '<table>';
		$body .= '
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="2">Thư đăng ký tư vấn từ website <a href="' . $_SERVER["SERVER_NAME"] . '">' . $_SERVER["SERVER_NAME"] . '</a></th>
				</tr>
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th>Họ và tên :</th><td>' . $ten . '</td>
				</tr>
				
				
				<tr>
					<th>Điện thoại :</th><td>' . $dienthoai . '</td>
				</tr>
				<tr>
					<th>Email :</th><td>' . $email . '</td>
				</tr>
				<tr>
					<th>Địa chỉ :</th><td>' . $diachi . '</td>
				</tr>
				<tr>
					<th>Sản phẩm :</th><td>' . $sanpham . '</td>
				</tr>
				<tr>
					<th>Số lượng :</th><td>' . $soluong . '</td>
				</tr>
				<tr>
					<th>Nội dung :</th><td>' . $noidung . '</td>
				</tr>
				';
		$body .= '</table>';

		$mail->Body = $body;

		if ($mail->Send())
			transfer(_guithuthanhcong, "index.html");
		else
			transfer(_guithuthatbai, "index.html");
	}



	if (!empty($_POST['email_nhantin'])) {
		$email = addslashes($_POST['email_nhantin']);
		$email = trim(strip_tags($email));
		$email = htmlspecialchars($email);
		$email = mysqli_real_escape_string($d->db, $email);

		//check email chứa @gmail.com
		if (!checkEmail($email)) {
			transfer("Email không hợp lệ", "index.html");
		}

		$ar = explode('@', $email);
		$tenkhach = $ar[0];
		$data['ten'] = addslashes($tenkhach);
		$data['email'] = addslashes($email);
		$data['type'] = 'nhantin';
		$data['ngaytao'] = time();

		//kiểm tra email
		$d->reset();
		$sql = "select * from #_contact where email = '" . $email . "' and type='nhantin'";
		$d->query($sql);
		if ($d->num_rows() > 0) {
			transfer(_emaildadangky, getCurrentPageURL());
		}

		$d->reset();
		$d->setTable('contact');
		if ($d->insert($data)) {
			include_once "phpMailer/class.phpmailer.php";
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
			$mail->SetFrom($mail_host, $company['ten']);

			//Thiết lập thông tin người nhận và email người nhận
			$mail->AddAddress($company['email2'], $company['ten']);
			$mail->AddAddress($email, $tenkhach);

			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($email, $tenkhach);

			//Thiết lập file đính kèm nếu có
			/*if(!empty($_FILES['file']))
		{
			$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
		}*/

			//Thiết lập tiêu đề email
			$mail->Subject    = "Thư đăng ký thành viên";
			$mail->IsHTML(true);

			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";
			$body = '<table>';
			$body .= '
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">Thư đăng ký thành viên từ website <a href="' . $_SERVER["SERVER_NAME"] . '">' . $_SERVER["SERVER_NAME"] . '</a></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th>Tên :</th><td>' . $tenkhach . '</td>
			</tr>
			<tr>
				<th>Email :</th><td>' . $email . '</td>
			</tr>
			';
			$body .= '</table>';

			$mail->Body = $body;
			if ($mail->Send())
				transfer(_guithuthanhcong, getCurrentPageURL());
			else
				transfer(_guithuthatbai, getCurrentPageURL());
		} else {
			transfer(_guithuthatbai, getCurrentPageURL());
		}
	}
}

if(isset($_POST['submit_datphong'])){
	
$noidung = addslashes($_REQUEST['noidung_datphong']);
$noidung = trim(strip_tags($noidung));
$noidung = htmlspecialchars($noidung);
$noidung = mysqli_real_escape_string($d->db, $noidung);

$hoten = addslashes($_REQUEST['ten_datphong']);
$hoten = trim(strip_tags($hoten));
$hoten = htmlspecialchars($hoten);
$hoten = mysqli_real_escape_string($d->db, $hoten);

$dienthoai = addslashes($_REQUEST['dienthoai_datphong']);
$dienthoai = trim(strip_tags($dienthoai));
$dienthoai = htmlspecialchars($dienthoai);
$dienthoai = mysqli_real_escape_string($d->db, $dienthoai);

$songuoi = addslashes($_REQUEST['soluong_nguoi']);
$songuoi = trim(strip_tags($songuoi));
$songuoi = htmlspecialchars($songuoi);
$songuoi = mysqli_real_escape_string($d->db, $songuoi);

$ngaydat = addslashes($_REQUEST['ngay_datphong']);
$ngaydat = trim(strip_tags($ngaydat));
$ngaydat = htmlspecialchars($ngaydat);
$ngaydat = mysqli_real_escape_string($d->db, $ngaydat);
$ngaydat=date("d-m-Y H:i:s",strtotime($ngaydat));
$tenphong = addslashes($_REQUEST['tenphong_datphong']);
$tenphong = trim(strip_tags($tenphong));
$tenphong = htmlspecialchars($tenphong);
$tenphong = mysqli_real_escape_string($d->db, $tenphong);


if ($hoten == '') {
	transfer("Bạn chưa nhập tên", getCurrentPageURL());
}
if ($dienthoai == '') {
	transfer("Bạn chưa nhập số điện thoại", getCurrentPageURL());
}
if ($noidung == '') {
	transfer("Bạn chưa nhập nội dung", getCurrentPageURL());
}
if ($tenphong == '') {
	transfer("Bạn chưa nhập phòng", getCurrentPageURL());
}
if ($songuoi == '') {
	transfer("Bạn chưa nhập số người", getCurrentPageURL());
}
if ($ngaydat == '') {
	transfer("Bạn chưa nhập ngày đặt", getCurrentPageURL());
}

//check số điện thoại chưa các đầu số nhà mạng việt nam
if (!checkPhoneVietNam($dienthoai)) {
	transfer("Số điện thoại không hợp lệ", "index.html");
}

//check nội dung chứa từ tiếng anh
if (checkContentEnglish($noidung)) {
	transfer("Nội dung không hợp lệ", "index.html");
}

include_once  'recaptchalib.php';
//------- your secret key
$secret = $config['secretkey'];
//------- empty response
$response = null;
//------- check secret key
$reCaptcha = new ReCaptcha($secret);
//------- if submitted check response
if ($_POST["g-recaptcha-response"]) {
	$response = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);
}
if ($response != null && $response->success) {
	if ($hoten != '' && $dienthoai != '') {
		$data['ten'] = $hoten;
		$data['dienthoai'] = $dienthoai;
		$data['songuoi'] = $songuoi;
		$data['ngaytao'] = time();
		$data['noidung'] = $noidung;
		$ngay=strtotime(date($ngaydat));
		$data['ngaynhanphong'] = $ngay;
		$data['sanpham'] = $tenphong;
		$data['hienthi'] = 0;
		$data['type'] = 'dat-phong';
		$d->setTable('contact');
		$kq = $d->insert($data);
		if ($kq) {
			include_once "phpMailer/class.phpmailer.php";
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;
			$mail->Port   = $config['mail_port'];
			$mail->SMTPSecure   = 'tls';  
			$mail->Port   = 587;

			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host, $company['ten']);

			//Thiết lập thông tin người nhận và email người nhận
			//$mail->AddAddress($company['email2'], $company['ten']);
			$mail->AddAddress($company['email2'], $company['ten']);

			//Thiết lập tiêu đề email
			$mail->Subject    = "Thư đặt phòng";
			$mail->IsHTML(true);

			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";
			$body = '<table>';
			$body .= '
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">Thư đặt phòng website <a href="' . $_SERVER["SERVER_NAME"] . '">' . $_SERVER["SERVER_NAME"] . '</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ và tên :</th><td>' . $hoten . '</td>
					</tr>
					
					<tr>
						<th>Điện thoại :</th><td>' . $dienthoai . '</td>
					</tr>
					<tr>
						<th>Số người :</th><td>' . $songuoi . '</td>
					</tr>
					<tr>
						<th>Thời gian   :</th><td>' . $ngaydat . '</td>
					</tr>
					<tr>
						<th>Phòng :</th><td>' . $tenphong . '</td>
					</tr>
					<tr>
						<th>Nội dung :</th><td>' . $noidung . '</td>
					</tr>
					';
			$body .= '</table>';

			$mail->Body = $body;

			if ($mail->Send())
				transfer(_guithuthanhcong, "index.html");
			else
				transfer(_guithuthatbai, "index.html");
		}
	} else {
		transfer(_maxacnhankhongchinhxac, "index.html");
	}
}

}
