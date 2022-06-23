<?php
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

	$cmd=$_POST['cmd'];
	$getlist=$_POST['listid'];
	$shipping_fee=(int)$_POST['shipping_fee'];
	global $config;
	if($cmd=='set_filter'){
		$listid = explode(",",$getlist);
	}else if($cmd=='set_all'){
		$d->reset();
		if($config['phi']==1){
			$sql = "select id from table_place_city";
		}
		elseif($config['phi']==2){$sql = "select id from table_place_dist";}
		$d->query($sql);
		$items = $d->result_array();
		$listid =array();
		foreach ($items as $key => $value) {
			$listid[$key]=$value['id'];
		}
	}

	for ($i=0 ; $i<count($listid) ; $i++){
		$d->reset();
		if($config['phi']==1){
			$sql = "update table_place_city SET phivanchuyen='".$shipping_fee."' where id='".$listid[$i]."'";
		}elseif($config['phi']==2){
			$sql = "update table_place_dist SET phivanchuyen='".$shipping_fee."' where id='".$listid[$i]."'";
		}
		$d->query($sql);
	}
	echo 1;
?>