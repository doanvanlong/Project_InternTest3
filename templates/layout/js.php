<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/all_js.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<!--Gio hang-->
<script src="js/lobibox.min.js" type="text/javascript"></script>
<script src="js/nprogress.js" type="text/javascript"></script>
<script type="text/javascript" src="js/giohang.js"></script>
<!---->
<script type="text/javascript" src="js/my_script.js"></script>
<script src="js/fancybox/jquery.fancybox.min.js"></script>
<?php if ($template == 'news_detail' || $template == 'duan_detail') { ?>
	<script type="text/javascript" src="js/sticky-kit.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			if ($(window).width() > 992) {
				$("#content_right").stick_in_parent({
					offset_top: 10
				});
			}
		});
	</script>
<?php } ?>
<?php if ($template == 'album_detail') { ?>
	<script src="js/mansonry/imagesloaded.pkgd.min.js" type="text/javascript"></script>
	<script src="js/mansonry/masonry.pkgd.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$().ready(function() {
			if ($('.gird_hinh').length) {
				$('.gird_hinh').imagesLoaded(function() {
					$('.gird_hinh').masonry({
						columnWidth: '.gallery-image-item',
						itemSelector: '.gallery-image-item'
					});
				});
			}
		});
	</script>
<?php } ?>
<?php /* ?><div id="fb-root"></div><?php */ ?>
<script type="text/javascript">
	var fired = false;
	window.addEventListener("scroll", function() {
		if ((document.documentElement.scrollTop != 0 && fired === false) || (document.body.scrollTop != 0 && fired === false)) {
			<?php /* ?>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/<?php if($lang=='en')echo 'en_EN';else echo 'vi_VN' ?>/sdk.js#xfbml=1&version=v2.4";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk')); <?php */ ?>


			$('#theoyeucauindex').css({
				'background-image': 'url(<?= _upload_hinhanh_l . $bg['photo'] ?>)',
				'background-size': '100% 100%'
			});

			fired = true;
		}
	}, true);
</script>

<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript">
	$().ready(function() {
		if ($(window).width() > 767) {
			new WOW().init();
		}
		$('#text_seo .xemthem button').click(function() {
			if ($('#text_seo').hasClass('active')) {
				$('#text_seo').removeClass('active');
				$(this).html('<?= _xemthem ?>');
			} else {
				$('#text_seo').addClass('active');
				$(this).html('<?= _rutgon ?>');
			}
		});
	});
</script>

<?php if ($template == 'product_detail') { ?>
	<link href="magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
	<script>
		$('#sl_hinhthem').slick({
			autoplay: false,
			arrows: true,
			dots: false,
			slidesToShow: 5,
			speed: 500,
			autoplaySpeed: 2000,
			nextArrow: '<div class="myarrow1 next" aria-hidden="true"><i class="fa fa-angle-right"></i></div>',
			prevArrow: '<div class="myarrow1 prev" aria-hidden="true"><i class="fa fa-angle-left"></i></div>',
		});
		$(document).ready(function(e) {
			$('.mini_img_product a').on('click', function() {
				if (!$(this).hasClass('border_mau')) {
					$(this).addClass('border_mau');
					$(this).siblings().removeClass('border_mau');
				}
			});
		});
	</script>
<?php } ?>
<!--Thêm alt cho hình ảnh-->
<script type="text/javascript">
	$(document).ready(function(e) {
		$('img').each(function(index, element) {
			if (!$(this).attr('alt') || $(this).attr('alt') == '') {
				$(this).attr('alt', '<?= $company['ten'] ?>');
			}
		});
	});
</script>


<?php if ($_GET['com'] == 'lien-he') { ?>
	<script>
		function sb_contact() {
			if (isEmpty($('#ten_contact').val(), "<?= _nhaphoten ?>")) {
				$('#ten_contact').focus();
				return false;
			}

			if (isEmpty($('#email_contact').val(), "<?= _nhapemail ?>")) {
				$('#email_contact').focus();
				return false;
			}
			if (isEmail($('#email_contact').val(), "<?= _emailkhonghople ?>")) {
				$('#email_contact').focus();
				return false;
			}
			if (isEmpty($('#dienthoai_contact').val(), "<?= _nhapsodienthoai ?>")) {
				$('#dienthoai_contact').focus();
				return false;
			}
			if (isPhone($('#dienthoai_contact').val(), "<?= _sodienthoaikhonghople ?>")) {
				$('#dienthoai_contact').focus();
				return false;
			}
			if (isEmpty($('#diachi_contact').val(), "<?= _nhapdiachi ?>")) {
				$('#diachi_contact').focus();
				return false;
			}
			if (isEmpty($('#noidung_contact').val(), "<?= _nhapnoidung ?>")) {
				$('#noidung_contact').focus();
				return false;
			}
			var response = grecaptcha.getResponse();

			if (response.length == 0){
				$(".error_captcha").text('Vui lòng xác nhận Captcha');
				return false;
			}else{
				$(".error_captcha").text('');
			}
			
			document.frm_contact.submit();
		}
	</script>
<?php } ?>


<?php
if ($_GET['com'] == '' || $_GET['com'] == 'index') {
?>
	
	<script>
		$(".slick_thucdon").slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			control: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 4000,
			responsive: [{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: true,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 360,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	</script>
	<script>
		$(".slick_album1").slick({
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: true,
			control: false,
			arrows: false,
			dots: false,
			autoplaySpeed: 4000,
			responsive: [{
				breakpoint: 360,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				},
			}, ],
		});
	</script>
	<script>
		$(".slick_album2").slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			autoplay: true,
			control: true,
			arrows: false,
			dots: false,
			autoplaySpeed: 4000,
			responsive: [{
					breakpoint: 1200,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 1,
						infinite: true,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 1,
						infinite: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 360,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
			],
		});
	</script>
	<script>
		$(".slick_vechungtoi").slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			control: false,
			arrows: false,
			dots: false,
			autoplaySpeed: 2000,
			responsive: [{
					breakpoint: 1200,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						infinite: true,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						infinite: true,
					},
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 426,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 360,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	</script>
<?php
}
?>
<script>
		function sb_datphong() {
			if (isEmpty($('#ten_datphong').val(), "<?= _nhaphoten ?>")) {
				$('#ten_datphong').focus();
				return false;
			}
			if (isEmpty($('#dienthoai_datphong').val(), "<?= _nhapsodienthoai ?>")) {
				$('#dienthoai_datphong').focus();
				return false;
			}
			if (isPhone($('#dienthoai_datphong').val(), "<?= _sodienthoaikhonghople ?>")) {
				$('#dienthoai_datphong').focus();
				return false;
			}
			if (isEmpty($('#soluong_nguoi').val(), "<?= _nhapsoluongnguoi ?>")) {
				$('#soluong_nguoi').focus();
				return false;
			}
			if ($('#soluong_nguoi').val() < 1) {
				alert("<?= _nhapsoluongnguoi ?>");
				$('#soluong_nguoi').focus();
				return false;
			}
			if (isEmpty($('#ngay_datphong').val(), "<?= _nhapngaydatphong ?>")) {
				$('#ngay_datphong').focus();
				return false;
			}
			if (isEmpty($('#tenphong_datphong').val(), "<?= _nhapsanpham ?>")) {
				$('#tenphong_datphong').focus();
				return false;
			}

			if (isEmpty($('#noidung_dangky').val(), "<?= _nhapnoidung ?>")) {
				$('#noidung_dangky').focus();
				return false;
			}
			var response = grecaptcha.getResponse();

			if (response.length == 0){
				$(".error_captcha").text('Vui lòng xác nhận Captcha');
				return false;
			}else{
				$(".error_captcha").text('');
			}
			
				document.frm_datphong.submit();
		}
	</script>