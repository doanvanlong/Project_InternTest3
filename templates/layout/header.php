<?php
error_reporting(0);
$d->reset();
$sql = "select photo from #_background where type='logo' limit 0,1";
$d->query($sql);
$logo = $d->fetch_array();

$d->reset();
$sql = "select ten$lang as ten,link,id,photo from #_slider where hienthi=1 and type='social' order by stt,id desc";
$d->query($sql);
$social = $d->result_array();
?>
<div id="header">
	<!-- header desktop -->
	<div class="container header_contai ">
		<div class="header-left">
			<div class="logo_head">
				<a href="">
					<img src="<?= _upload_hinhanh_l . $logo['photo'] ?>" class="logo-desktop" alt="<?= $company['ten'] ?>" />
				</a>
			</div>
		</div>
		<div class="header-right">
			<div class="top_head">
				<div class="h-item float-left margin_left"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ : <span><?= $company['diachi'] ?></span></div>
				<div class="h-ngonngu float-right">
					<i class="fa fa-phone" aria-hidden="true"></i> <span style="font-size:13px">Hotline : <span class="hotline"><?= $company['hotline'] ?></span></span>
				</div>

				<div class="clear"></div>
			</div>
			<div class="menu_main">
				<div id="menu">
					<?php include _template . "layout/menu_top.php"; ?>
				</div>
				<!---END #menu-->
			</div>
		</div>
	</div>
	<!-- header mobile -->
	<div class="mobile_show">
		<div class="container">
			<div class="header_mobile d-flex justify-content-between align-items-center">
				<div class="action_menu icon_menu">
					<a href="javascript:avoid(0)" title="Menu">
						<span class="l1"></span>
						<span class="l2"></span>
						<span class="l3"></span>
					</a>
				</div>
				<div class="logo_mobile">
					<a href="">
						<img src="<?= _upload_hinhanh_l . $logo['photo'] ?>" alt="<?= $company['ten'] ?>" />
						<div class="name_company_mobile"><?= $company['ten'] ?></div>
					</a>
				</div>
				<div class="icon_datphong">
					<div class="icon" data-toggle="modal" data-target="#modalDatPhong" title="Liên hệ đặt phòng"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
				</div>

			</div>
		</div>
	</div>

</div>
<div><?php include _template . "layout/menu_mobi.php"; ?></div>
<!---END #menu_mobi-->

<!--Tim kiem-->
<script language="javascript">
	function doEnter(evt) {
		var key;
		if (evt.keyCode == 13 || evt.which == 13) {
			onSearch(evt);
		}
	}

	function onSearch(evt) {
		var keyword = document.getElementById("keyword").value;
		if (keyword == '' || keyword == '<?= _nhaptukhoatimkiem ?>...') {
			alert('<?= _chuanhaptukhoa ?>');
		} else {
			location.href = "tim-kiem.html&keyword=" + keyword;
			loadPage(document.location);
		}
	}
</script>
<!--Tim kiem-->