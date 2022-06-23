<?php

$d->reset();
$sql = "select ten$lang as ten,mota$lang as mota,photo from #_slider where type='ve-chung-toi' and hienthi=1 order by stt,id asc";
$d->query($sql);
$ar_vechungtoi = $d->result_array();
$d->reset();
$sql = "select photo from #_background where type = 've-chung-toi'";
$d->query($sql);
$background = $d->fetch_array();
?>
<div class="vechungtoi" style="background-image:url('<?= _upload_hinhanh_l . $background['photo'] ?>')">
	<div class="container">
		<div class="slick_vechungtoi">
			<?php foreach ($ar_vechungtoi as $value) { ?>
				<div class="text-center">
					<div class="">
						<img src="<?= _upload_hinhanh_l . $value['photo'] ?>" alt="<?= $value['ten'] ?>">
					</div>
					<div class="text-center pt-2">
						<div class="ten_vct"><?= $value['ten'] ?></div>
					</div>
					<div class="clearfix"></div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>