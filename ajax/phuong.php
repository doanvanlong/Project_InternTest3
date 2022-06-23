<?php
	include ("ajax_config.php");
	
	$id = addslashes($_REQUEST['id']);
    $id = trim(strip_tags($id));
	$id = htmlspecialchars($id);
    $id = mysqli_real_escape_string($d->db,$id);
	
	$d->reset();
	$sql_quan="select id,ten from #_place_ward where hienthi=1 and id_dist='$id' order by stt,id desc";
	$d->query($sql_quan);
	$quan=$d->result_array();

?>  
	<option value="">Phường/Xã</option>
<?php for($i = 0, $count_quan = count($quan); $i < $count_quan; $i++){ ?>
    <option value="<?=$quan[$i]['id']?>"><?=$quan[$i]['ten']?></option>
<?php } ?> 
