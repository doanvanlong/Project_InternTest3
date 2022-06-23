<?php
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
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
	
	
	$id = $_REQUEST['id'];
	$mdh = $_REQUEST['mdh'];	
	

	$d->reset();
	$sql_phivanchuyen="select phivanchuyen from #_place_dist where id='$id' order by stt,id desc";
	$d->query($sql_phivanchuyen);
	$phivanchuyen=$d->fetch_array();
	
	$return['phiship']=number_format($phivanchuyen['phivanchuyen'],0, ',', '.').'&nbsp;vnđ';
	$return['phiship2']=$phivanchuyen['phivanchuyen'];
	
	$d->reset();
	$sql="select tonggia from table_donhang where madonhang='".$mdh."'";
	$d->query($sql);
	$tonggia1=$d->fetch_array();
	$tt=$tonggia1['tonggia'];

	$tong=$tonggia1['tonggia']+$phivanchuyen['phiship'];
	
	$return['tonggia']=number_format($tong,0, ',', '.').' vnđ';
	$return['tonggia2']=$tong;
	
	echo json_encode($return);
?>  

