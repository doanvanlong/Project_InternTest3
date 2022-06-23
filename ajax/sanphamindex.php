<?php
	include ("ajax_config.php");

	$order = isset($_REQUEST['order'])?(int)$_REQUEST['order']:false;
	$order = addslashes($order);
	$order = trim(strip_tags($order));
	$order = htmlspecialchars($order);
	$order = mysqli_real_escape_string($d->db,$order);

	$tranghientai = isset($_REQUEST['vitri'])?(int)$_REQUEST['vitri']:false;
	$tranghientai = addslashes($tranghientai);
	$tranghientai = trim(strip_tags($tranghientai));
	$tranghientai = htmlspecialchars($tranghientai);
	$tranghientai = mysqli_real_escape_string($d->db,$tranghientai);

	getSanPhamIndex($order,$tranghientai);

?>