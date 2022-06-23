<?php 


$d->reset();
$sql="select ten$lang as ten,mota$lang as mota,noidung$lang as noidung,photo from #_about where type='text-gioi-thieu'"; 
$d->query($sql);
$text_gt=$d->fetch_array();

?> 
<div id="gioi-thieu2" class="w_dichvu" >
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-md-12 col-sm-12 col-lg-12 ">
				<h2 class="gt_tieude"><span><?=$text_gt['ten']?></span></h2>
				<div class="gt_companyname"><?=$text_gt['mota']?></div>
				<div class="gt_mota py-3"><?=$text_gt['noidung']?></div>
				<div class="text-left"><a href="gioi-thieu.html" class="mybtn btn-do btn-goithieu"><?=_xemthem?></a></div>
			</div>
			
		</div>			
	</div> 
</div>
