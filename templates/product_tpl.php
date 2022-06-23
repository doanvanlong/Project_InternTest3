<?php if($seoh2 != ''){ ?><h2 class="d-none"><?=$seoh2?></h2><?php } ?>
<div class="row">
<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){	?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-30">
        <div class="item item_sanpham">
            <div class="item_img phong_to">
                <a href="<?=$com?>/<?=$product[$i]['tenkhongdau']?>.html" class="">
                  <img src="thumb/274x212x1x90/<?=_upload_sanpham_l.$product[$i]['photo']?>" alt="<?=$product[$i]['ten']?>" onerror="this.src='http://<?=$config_url?>/thumb/400x400x1x90/images/default-img.jpg';"   />
                </a>
            </div>
            <?php if($product[$i]['spbanchay']){ ?>
              <div class="spbanchay"><img src="<?=_upload_hinhanh_l.$iconBanChay['photo']?>" alt="icon" /></div>
            <?php } ?>
            <h3 class="item_name">
              <a href="<?=$com?>/<?=$product[$i]['tenkhongdau']?>.html"><?=$product[$i]['ten']?></a>
            </h3>
           
            <div class="item_gia">
              <span class="text-secondary ">Giá : </span>
              <?php
               	if($product[$i]['giakm']!=0){
                  echo '<span class="gia-ban">'.number_format($product[$i]['giakm'],0, ',', '.').'<sup>đ</sup></span> ';
               		echo '<span class="del-gia">'.number_format($product[$i]['gia'],0, ',', '.').'<sup>đ</sup></span>';
               		
               	}else{
               		if($product[$i]['gia']!=0){
               			echo '<span class="gia-ban">'.number_format($product[$i]['gia'],0, ',', '.').'<sup>đ</sup></span>';
               		}else{
               			echo '<span style="cursor:pointer" data-toggle="modal" data-target="#modalDatPhong"  class="gia-ban">'._lienhe.'</span>';
               		}
                }
              ?>
            </div>

        </div><!---END .item-->
    </div><!---END .col-->
<?php } ?>
</div><!---END row-->
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
<div class="mb-30"></div>
