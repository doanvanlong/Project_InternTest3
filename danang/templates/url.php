<?php 
	$web = 'http://'.$config_url.'/';
	$com = '';
	$duoi = '';
	$type = $_GET['type'];
	$act = $_GET['act'];
	switch($type){
		case "san-pham":
			$com = 'san-pham';
			$duoi ='.html';
			break;
		case "tin-tuc":
			$com = 'tin-tuc';
			$duoi ='.html';
			break;
		case "du-an":
			$com = 'du-an';
			$duoi ='.html';
			break;
		case "dich-vu":
			$com = 'dich-vu';
			$duoi ='.html';
			break;
		case "tuyen-dung":
			$com = 'tuyen-dung';
			$duoi ='.html';
			break;
		case "hinh-anh":
			$com = 'hinh-anh';
			$duoi ='.html';
			break;
		case "chinh-sach":
			$com = 'chinh-sach';
			$duoi ='.html';
			break;
		case "ho-tro":
			$com = 'ho-tro';
			$duoi ='.html';
			break;
			
		default :
			$com = '';
	}
	switch($act){
		case "man_danhmuc":
		case "add_danhmuc":
		case "edit_danhmuc":
			$duoi ='';
			break;
		case "man_list":
		case "add_list":
		case "edit_list":
			$duoi ='/';
			break;
		case "man_cat":
		case "add_cat":
		case "edit_cat":
			$duoi ='.htm';
			break;
	}
 ?>
