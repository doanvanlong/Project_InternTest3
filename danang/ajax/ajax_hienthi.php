<?php 
session_start();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../lib/');
	
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);

	if(isset($_POST["id"])){
		
		$table1 = trim($_POST["bang"]);
		$table = str_replace('table_','',$table1);

		$data[$_POST["type"]] = $_POST["value"];
		$d->setTable($table);
		$d->setWhere('id', $_POST["id"]);
		if($d->update($data));
		
		
		//echo $sql = "update ".$_POST["bang"]." SET ".$_POST["type"]."=".$_POST["value"]." WHERE  id = ".$_POST["id"]."";

		
		//$data = mysqli_query($sql) or die("Not query sql");
	}
?>