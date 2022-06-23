<?php
include ("ajax_config.php");

$act = addslashes($_REQUEST['act']);
$act = trim(strip_tags($act));
$act = htmlspecialchars($act);
$act = mysqli_real_escape_string($d->db,$act);

switch($act){
	case "dist":
		load_dist();
		break;
	default:
		break;
}

function load_dist()
{
	global $d;
	$id_city = addslashes($_REQUEST['id_city']);
    $id_city = trim(strip_tags($id_city));
    $id_city = htmlspecialchars($id_city);
    $id_city = mysqli_real_escape_string($d->db,$id_city);
	$id_city = intval($id_city);	
	
	$sql="select id,ten from table_place_dist where id_city='".$id_city."' and hienthi=1 order by stt,id desc";		
	$stmt = mysql_query($sql);
	$str='<option value="">'._chonquanhuyen.'</option>';
	while ($row=@mysql_fetch_array($stmt)) 
	{
		$str.='<option value='.$row["id"].'>'.$row["ten"].'</option>';			
	}
	echo $str;
}
?>   
