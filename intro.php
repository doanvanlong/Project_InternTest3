<?php
	error_reporting(0);
	session_start();
	$session=session_id();

	require_once 'MobileDetect/Mobile_Detect.php';
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './danang/lib/');
		
	include_once _lib."config.php";
	include_once _lib."AntiSQLInjection.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";	
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	include_once _source."counter.php";	
	$login_name = 'ANGEL789';
	

?>
<!doctype html>
<html lang="vi" itemscope itemtype="http://schema.org/LocalBusiness">
	<head prefix="og: http://ogp.me/ns#; dcterms: http://purl.org/dc/terms/#">
	<base href="http://<?=$config_url?>/"  />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="dns-prefetch" href="http://<?=$config_url?>/" />
	<link rel="preconnect" href="//www.google-analytics.com" crossorigin />
	<?php include _template."layout/seoweb.php";?>
	<?php include _template."layout/css.php";?>
	<?=$company['headerjs']?>
    <?=$company['analytics']?>
</head>
<body ondragstart="return false;" ondrop="return false;" >
<div class="wap">
<h1 style="position:absolute; top:-1000px;"><?php if($title!='')echo $title;else echo $company['title'];?></h1>
	<?php include _template."layout/header.php";?>
	<?php include _template."layout/slider_jssor.php";?>
   
    <?php if($_GET['com'] == 'index' || $_GET['com'] == ''){?>

		<?php include _template."layout/gioithieuindex.php";?>
		<?php include _template.$template."_tpl.php"; ?>
		<?php include _template."layout/album_index.php";?> 
		<?php include _template."layout/vechungtoi.php";?> 
		<?php include _template."layout/video_index.php";?> 

	<?php  }elseif($_GET['com'] == 'san-pham' || $_GET['com'] == 'hinh-anh' || !isset($_GET['id'])){ ?>
		
		<?php if(isset($_GET['id'])){ ?>
			<div class="div_breadcrumb">
				<?php include _template."layout/breadcrumb.php"; ?>
			</div>
		<?php }else{ include _template."layout/banner.php"; } ?>

        <div class="container">
			<?php include _template.$template."_tpl.php"; ?>
    	</div>

	<?php  }else{ ?>

		<div class="div_breadcrumb">
			<?php include _template."layout/breadcrumb.php"; ?>
		</div>

      	<div class="container">
      		<div id="content_left">
				<?php include _template.$template."_tpl.php"; ?>
			</div>
			<div id="content_right">
				<?php include _template."layout/left.php"; ?>
    		</div>
    		<div class="clear"></div>
      	</div>

    <?php } ?>

	<?php include _template."layout/gioithieuseo.php";?>
    <?php include _template."layout/footer.php";?>
	<?php include _template."layout/js.php";?>
	<?php include _template."layout/modal.php";?>
    <?php include _template."layout/menufooter.php";?>

</div>
<link href="font-awesome-4.6.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" crossorigin  />
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
<script>
	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > 5) {
				$('#header').addClass('fixed');
		} else {
				$('#header').removeClass('fixed');
		}
	});
</script>
<?=$company['codethem']?>

<?php /*?>
<script src="//instant.page/5.1.0" type="module" integrity="sha384-by67kQnR+pyfy8yWP4kPO12fHKRLHZPfEsiSXR8u2IKcTdxD805MGUXBzVPnkLHw"></script>
<?php */?>
</body>
</html> 
