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
	$login_name = 'ANGEL789';
	//dump($_REQUEST);
	$username=base64_decode($_REQUEST["user"]);
	
	$d->reset();
	$sql="Select * from #_user where username='".$username."'";
	$d->query($sql);
	if($d->num_rows()>0){
		$d->reset();
		$sql="update table_user set hienthi=0 where username='".$username."'";
		$d->query($sql);
		transfer("Đã khóa tài khoản thành công","http://".$config_url."/");
	}
