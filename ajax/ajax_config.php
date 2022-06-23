<?php
	session_start();
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../danang/lib/');
	
	if(!isset($_SESSION['lang']))
	{
		$_SESSION['lang']='';
	}
	$lang=$_SESSION['lang'];		
	require_once _source."lang$lang.php";	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";	
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."file_requick.php";
?>  
