<?php
	include ("ajax_config.php");

	$id = addslashes($_REQUEST['id']);
    $id = trim(strip_tags($id));
	$id = htmlspecialchars($id);
    $id = mysqli_real_escape_string($d->db,$id);

	$d->reset();
	$sql="select id,chitiet$lang as chitiet from #_product where hienthi=1 and type='san-pham' and id_danhmuc='".$id."' order by stt,id desc";
	$d->query($sql);

	if($d->num_rows()){
		$loaisanpham_yeucau = $d->result_array();
		echo '<select name="loaisanpham_yeucau" class="form-control" id="loaisanpham_yeucau">';
		foreach ($loaisanpham_yeucau as $key => $val) {
			echo '<option value="'.$val['chitiet'].'">'.$val['chitiet'].'</option>';
		}
		echo '</select>';
	}else{
		echo '<select name="loaisanpham_yeucau" class="form-control" id="loaisanpham_yeucau">';
		echo '<option value=""></option>';
		echo '</select>';
	}

?>