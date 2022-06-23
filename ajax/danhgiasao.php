<?php 

	include ("ajax_config.php");

	$giatri = addslashes($_REQUEST['giatri']);
	$giatri = trim(strip_tags($giatri));
	$giatri = htmlspecialchars($giatri);
	$giatri = mysqli_real_escape_string($d->db,$giatri);

	$url = addslashes($_REQUEST['url']);
	$url = trim(strip_tags($url));
	$url = htmlspecialchars($url);
	$url = mysqli_real_escape_string($d->db,$url);

	
	$data['giatri'] = intval($giatri);
	$data['link'] = $url;
	$data['code'] = $session;
	$data['time'] = time();
	
	$d->reset();
	$sql = "select time from #_danhgiasao where link='".$data['link']."' and code='".$session."' order by time desc limit 0,1";		
	$d->query($sql);
	$kiemtra = $d->fetch_array();	
		
	if(time() < $kiemtra['time']+86400)
	{
		echo 2;exit;
	}
	
	$d->setTable('danhgiasao');
	
	if($d->insert($data)){
		echo 1;
	}else{
		echo 0;
	}
	
?>
