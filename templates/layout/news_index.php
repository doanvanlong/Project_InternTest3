<?php 

$d->reset();
$sql="select ten$lang as ten,mota$lang as mota, tenkhongdau, photo,ngaytao from #_news where hienthi=1 and type='tin-tuc' and ngaytao <=".time()." and noibat=1  order by stt,id desc limit 0,8";
$d->query($sql);
$bangtin = $d->result_array();
 ?>
<div class="w_dichvu">
	<div class="container wow fadeInUp" data-wow-duration="1s">
		<h2 class="tieude_gc mb-40">
			<span><?=_tintuc?></span>
		</h2>
		<div class="sl_news mn-n15 arrow_hover">
			<?php for($i=0,$count = count($bangtin);$i<$count;$i++){ ?>
				<div class="pn-15">
					<div class="item item_news">
						<a href="tin-tuc/<?=$bangtin[$i]['tenkhongdau']?>.html" class="a_cover"></a>
						<div class="item_img hover_sang phong_to">
							<img src="thumb/800x500x1x90/<?=_upload_tintuc_l.$bangtin[$i]['photo']?>" alt="<?=$bangtin[$i]['ten']?>" onerror="this.src='http://<?=$config_url?>/thumb/800x500x1x90/images/default-img.jpg';"   />
						</div> 
						<div class="new_time">
				            <span class="day"><?=date('d',$bangtin[$i]['ngaytao'])?></span>
				            <span class="month"><?=date('M/Y',$bangtin[$i]['ngaytao'])?></span>
				        </div>
						<h3 class="item_name"><?=$bangtin[$i]['ten']?></h3>
						<div class="item_content">
				            <?=$bangtin[$i]['mota']?>
				        </div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
 </div> 
