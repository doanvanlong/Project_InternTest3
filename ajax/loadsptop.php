<?php
	include ("ajax_config.php");	
	
    $order = addslashes($_REQUEST['order']);
    $order = trim(strip_tags($order));
    $order = htmlspecialchars($order);
    $order = mysqli_real_escape_string($d->db,$order);
	
	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,photo,id_danhmuc from #_news where hienthi=1 and id_danhmuc='".$order."' and type='duan' order by stt,id desc";
	$d->query($sql);
	$rs_project=$d->result_array();
	//dump($sql);
?>  
 <div class="chaysanpham">
	<?php for($j=0;$j<count($rs_project);$j++){ 
		$d->reset();
		$sql="select ten$lang as ten,id from #_news_danhmuc where hienthi=1 and type='duan' and id='".$rs_project[$j]['id_danhmuc']."' order by stt,id desc";
		$d->query($sql);
		$da1=$d->fetch_array();
	?>
        <div class="bx_sl">
            <div class="item_duan">
                <div class="duan_img">
                    <a href="du-an/<?=$rs_project[$j]['tenkhongdau']?>-<?=$rs_project[$j]['id']?>.html">
                        <img src="thumb/275x475x1x90/<?=_upload_tintuc_l.$rs_project[$j]['photo']?>" alt="<?=$rs_project[$j]['ten']?>" /></a>
                 </div>
                <div class="overlay-box">
                    <div class="line-box"></div>
                    <div class="over-content">
                        <div class="subtitle"><?=$da1['ten']?></div>
                        <h4><a href="du-an/<?=$rs_project[$j]['tenkhongdau']?>.html" title="<?=$rs_project[$j]['ten']?>"><?=$rs_project[$j]['ten']?></a></h4>
                        <div class="link-box"><a href="du-an/<?=$rs_project[$j]['tenkhongdau']?>.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
                    </div>
                    
                    
                </div>
            </div> 
        </div>
    <?php }?>
</div>
