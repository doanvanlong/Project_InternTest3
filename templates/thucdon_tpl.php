
<?php if ($seoh2 != '') { ?><h2 class="d-none"><?= $seoh2 ?></h2><?php } ?>
<div class="row">
    <?php for ($i = 0, $count_product = count($product); $i < $count_product; $i++) {    ?>
        <div class="col-lg-3 col-md-4 col-sm-12 col-12  mb-30">
            <div class="item item_sanpham">
                <div class="item_img phong_to">
                    <a data-fancybox="gallery" data-caption="<?= $product[$i]['ten'] ?>" href="<?= _upload_sanpham_l . $product[$i]['photo'] ?>">
                        <img src="<?= _upload_sanpham_l . $product[$i]['photo'] ?>" alt="">
                    </a>
                </div>
                <?php if ($product[$i]['spbanchay']) { ?>
                    <div class="spbanchay"><img src="<?= _upload_hinhanh_l . $iconBanChay['photo'] ?>" alt="icon" /></div>
                <?php } ?>
                <h3 class="item_name">
                    <a><?= $product[$i]['ten'] ?></a>
                </h3>

            </div>
            <!---END .item-->
        </div>
        <!---END .col-->
    <?php } ?>

   
</div>
<div class="addthis_native_toolbox"></div>
<!---END row-->
<div class="pagination"><?= pagesListLimitadmin($url_link, $totalRows, $pageSize, $offset) ?></div>
<div class="mb-30"></div>