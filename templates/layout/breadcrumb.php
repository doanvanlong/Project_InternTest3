<div class="breadcrumb"> 
	<div class="container">
		<?php for($i= 0 ; $i < count($breadcumbs)-1; $i++){ ?>
		<a href="<?= $breadcumbs[$i][0] ?>" title="<?= $breadcumbs[$i][1] ?>"><?= $breadcumbs[$i][1] ?> <i class="fa fa-angle-right"></i></a>
		<?php } ?>
		<span><?= $breadcumbs[count($breadcumbs)-1][1] ?></span>
	</div >
</div>
