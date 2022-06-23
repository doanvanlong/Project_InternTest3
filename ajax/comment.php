<?php 

	include ("ajax_config.php");
	
	$noidung = addslashes($_REQUEST['noidung_danhgia']);
	$noidung = trim(strip_tags($noidung));
	$noidung = htmlspecialchars($noidung);
	$noidung = mysqli_real_escape_string($d->db,$noidung);

	$id_product = addslashes($_REQUEST['idsanpham_danhgia']);
	$id_product = trim(strip_tags($id_product));
	$id_product = htmlspecialchars($id_product);
	$id_product = mysqli_real_escape_string($d->db,$id_product);

	$tensanpham = addslashes($_REQUEST['tensanpham_danhgia']);
	$tensanpham = trim(strip_tags($tensanpham));
	$tensanpham = htmlspecialchars($tensanpham);
	$tensanpham = mysqli_real_escape_string($d->db,$tensanpham);

	$star = addslashes($_REQUEST['sao_danhgia']);
	$star = trim(strip_tags($star));
	$star = htmlspecialchars($star);
	$star = mysqli_real_escape_string($d->db,$star);

	$ten = addslashes($_REQUEST['ten_danhgia']);
	$ten = trim(strip_tags($ten));
	$ten = htmlspecialchars($ten);
	$ten = mysqli_real_escape_string($d->db,$ten);

	$dienthoai = addslashes($_REQUEST['sodienthoai_danhgia']);
	$dienthoai = trim(strip_tags($dienthoai));
	$dienthoai = htmlspecialchars($dienthoai);
	$dienthoai = mysqli_real_escape_string($d->db,$dienthoai);

	$email = addslashes($_REQUEST['email_danhgia']);
	$email = trim(strip_tags($email));
	$email = htmlspecialchars($email);
	$email = mysqli_real_escape_string($d->db,$email);


	if($ten != '' && $dienthoai != ''){

		$data['ten'] = $ten;
		$data['dienthoai'] = $dienthoai;
		$data['email'] = $email;
		$data['noidung'] = $noidung;
		$data['id_product'] = $id_product;
		$data['star'] = $star;
		$data['hienthi'] = 0;
		$data['dadoc'] = 0;
		$data['stt'] = 1;
		$data['ngaytao'] = time();
		$data['type'] = 'san-pham';
		$data['chungnhan'] = 0;

		//check sđt trong đơn hàng
		$d->reset();
		$sql = "select id from table_donhang where dienthoai = '".$dienthoai."'";
		$d->query($sql);
		if($d->num_rows()){
			$check = $d->fetch_array();
			//check id_product trong chi tiết đơn hàng
			$d->reset();
			$$sql = "select id from table_chitietdonhang where id = '".$check['id']."' and id_sanpham = '".$id_product."'";
			$d->query($sql);
			if($d->num_rows()){ $data['chungnhan'] = 1; }
		}
		
		//hinhanh
		if (isset($_FILES['files_danhgia'])) {
			$dem=0;
			for($i=0;$i<count($_FILES['files_danhgia']['name']);$i++){
				if($i<3){
					if($_FILES['files_danhgia']['name'][$i]!=''){
						$file['name'] = $_FILES['files_danhgia']['name'][$i];
						$file['type'] = $_FILES['files_danhgia']['type'][$i];
						$file['tmp_name'] = $_FILES['files_danhgia']['tmp_name'][$i];
						$file['error'] = $_FILES['files_danhgia']['error'][$i];
						$file['size'] = $_FILES['files_danhgia']['size'][$i];
						
						if($file['size'] <= 4096000){
							$dem+=1;
							$file_name = images_name($_FILES['files_danhgia']['name'][$i]);
							$photo = upload_photos($file, _format_duoihinh, _upload_binhluan,$file_name);
							$data['photo'.$dem] = $photo;
						}
					}
				}
			}

		}
		$d->setTable('comment');
		$kq = $d->insert($data);
		if($kq){echo "<i class='fa fa-check check-success'></i><span>Cảm ơn bạn đã đánh giá sản phẩm <b>".$tensanpham."</b></span>";}

	}else{
		echo "<i class='fa fa-check check-danger'></i><span>Cần nhập thông tin Email và Số điện thoại không đủ!</span>";
	}
