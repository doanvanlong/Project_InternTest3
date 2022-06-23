<?php 

	include ("ajax_config.php");
	
	$idvideo = addslashes($_REQUEST['id']);
	$idvideo = trim(strip_tags($idvideo));
	$idvideo = htmlspecialchars($idvideo);
	$idvideo = mysqli_real_escape_string($d->db,$idvideo);
	
	$d->reset();
	$sql_video = "select id,ten$lang as ten,link from #_video where id='".$idvideo."' and hienthi=1 order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();
	
?>

<iframe title="<?=$video[0]['ten']?>" width="100%" src="http://www.youtube.com/embed/<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[0]['link'], $matches);echo $matches[1];?>" frameborder="0" allowfullscreen></iframe>

