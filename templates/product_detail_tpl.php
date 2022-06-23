<div class="box_container">
  <div class="div_info_product">
    <div class="zoom_slick">
      <?php if ($row_detail['spbanchay']) { ?>
        <div class="spbanchay"><img src="<?= _upload_hinhanh_l . $iconBanChay['photo'] ?>" alt="icon" /></div>
      <?php } ?>
      <a href="<?= _upload_sanpham_l . $row_detail['photo']; ?>" id="img_product" class="MagicZoom" data-options="expandZoomMode: off;">
        <img src="thumb/500x300x1x90/<?= _upload_sanpham_l . $row_detail['photo']; ?>">
      </a>
      <div class="mini_img_product arrow_hover" id="sl_hinhthem">
        <?php $count = count($hinhthem);
        if ($count > 0) { ?>
          <a class="border_mau" data-zoom-id="img_product" href="<?= _upload_sanpham_l . $row_detail['photo']; ?>" data-image="<?= _upload_sanpham_l . $row_detail['photo']; ?>">
            <img src="thumb/100x100x1x90/<?= _upload_sanpham_l . $row_detail['photo']; ?>" alt="<?= $row_detail['ten'] ?>">
          </a>
          <?php for ($j = 0, $count_hinhthem = count($hinhthem); $j < $count_hinhthem; $j++) { ?>
            <a data-zoom-id="img_product" href="<?= _upload_hinhthem_l . $hinhthem[$j]['photo']; ?>" data-image="<?= _upload_hinhthem_l . $hinhthem[$j]['photo']; ?>">
              <img src="thumb/100x100x1x90/<?= _upload_hinhthem_l . $hinhthem[$j]['photo']; ?>" alt="<?= $row_detail[$j]['ten'] ?>" />
            </a>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
    <ul class="info_product">
      <li class="my-flex-between no-border-bottom">
        <div class="tieude_detail"><?= $row_detail['ten'] ?></div>
      </li>
      <li class="my-flex-between"><span style="font-family:tieude">Đánh giá:</span>
        <span class="color_star">
          <?php
          $itemStar = getRattingProduct($row_detail['id']);
          for ($j = 1; $j <= 5; $j++) {
            if ($j <= $itemStar) {
              echo '<i class="fa fa-star"></i>';
            } elseif ($itemStar < $j  && $itemStar > $j - 1) {
              echo '<i class="fa fa-star-half-o"></i>';
            } else {
              echo '<i class="fa fa-star-o"></i>';
            }
          }
          echo ' <a href="javascript:void(0)" class="goDanhGia" > (' . demdanhGiaSP($row_detail['id']) . ' đánh giá )</a>';
          ?></span>
      </li>
      <li class="my-flex-between"><span style="font-family:tieude"><?= _luotxem ?>:</span> <span><?= lamTronSo($row_detail['luotxem']) ?></span></li>
      <li class="my-flex-between">
        <span style="font-family:tieude">Giá :</span>
        <span>
          <?php if ($row_detail['giakm'] != 0) { ?>
            <b class="gia-ban"><?php echo number_format($row_detail['giakm'], 0, ',', '.') . ' <sup>đ</sup>'; ?></b>
            <b class="del-gia"><?= number_format($row_detail['gia'], 0, ',', '.') . '<sup>đ</sup>'; ?></b> &nbsp;

          <?php } else { ?>
            <b class="gia-ban">
              <?php if ($row_detail['gia'] != 0) {
                echo number_format($row_detail['gia'], 0, ',', '.') . '<sup>đ</sup>';
              } else {
                echo _lienhe;
              } ?></b>
          <?php } ?>
        </span>
      </li>

      <?php if ($row_detail['mota'] != '') { ?>
        <li><?= nl2br($row_detail['mota']) ?></li>
      <?php } ?>

      <li class="no-border-bottom">
        <a href="javascript:void(0)" class="btn-mua-ngay" data-toggle="modal" data-target="#modalDatPhong">
          <span ><?= _datphongnay ?></span>
        </a>

      </li>
      <li class="no-border-bottom">
        <div class="addthis_native_toolbox"></div>
      </li>
    </ul>
  </div>
  <!--.wap_pro-->
  <div id="tabs">
    <ul class="nav nav-tabs">
      <li class="nav-item"><a class="nav-link active" href="#tab0" data-toggle="tab"><?= _thongtinsanpham ?></a></li>
      <li class="nav-item"><a class="nav-link nav_danhgia" href="#tab1" data-toggle="tab"><?= _danhgia ?></a></li>
    </ul>
    <div class="tab-content">
      <div class=" tab-pane fade show active" id="tab0">
        <div class="content"><?= $row_detail['noidung'] ?></div>
      </div>
      <div class="tab-pane fade" id="tab1">
        <?php /* ?><div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div><?php */ ?>
        <!---comment-->
        <?php include _template . "layout/comment.php"; ?>
        <!---end comment-->
      </div>
    </div>
    <!---END #content_tabs-->
  </div>
  <!---END #tabs-->
</div>
<!--.box_containerlienhe-->
<!---comment-->
<link href="css/comment.css" type="text/css" rel="stylesheet" />
<?php include _template . "layout/comment_js.php"; ?>
<!---end comment-->
<div class="mb-30"></div>
<?php if (count($product) > 0) { ?>
  <h2 class="wtieudepage mb-30"><span class="tieude_page "><?= _phongcungloai ?></span></h2>
  <div class="row">
    <?php for ($i = 0, $count_product = count($product); $i < $count_product; $i++) { ?>
      <div class="col-lg-3 col-md-4  col-sm-6 col-12 mb-30">
        <div class="item item_sanpham">
          <div class="item_img phong_to">
            <a href="<?= $com ?>/<?= $product[$i]['tenkhongdau'] ?>.html" class="">
              <img src="thumb/274x212x1x90/<?= _upload_sanpham_l . $product[$i]['photo'] ?>" alt="<?= $product[$i]['ten'] ?>" onerror="this.src='http://<?= $config_url ?>/thumb/400x400x1x90/images/default-img.jpg';" />
            </a>
          </div>
          <?php if ($product[$i]['spbanchay']) { ?>
            <div class="spbanchay"><img src="<?= _upload_hinhanh_l . $iconBanChay['photo'] ?>" alt="icon" /></div>
          <?php } ?>
          <h3 class="item_name"><a href="<?= $com ?>/<?= $product[$i]['tenkhongdau'] ?>.html"><?= $product[$i]['ten'] ?></a></h3>
          
          <div class="item_gia">
          <span class="text-secondary ">Giá : </span>
            <?php
            if ($product[$i]['giakm'] != 0) {
              echo '<span class="gia-ban">' . number_format($product[$i]['giakm'], 0, ',', '.') . '<sup>đ</sup></span> ';
              echo '<span class="del-gia">' . number_format($product[$i]['gia'], 0, ',', '.') . '<sup>đ</sup></span>';
            } else {
              if ($product[$i]['gia'] != 0) {
                echo '<span class="gia-ban">' . number_format($product[$i]['gia'], 0, ',', '.') . '<sup>đ</sup></span>';
              } else {
                echo '<span style="cursor:pointer" data-toggle="modal" data-target="#modalDatPhong" class="gia-ban">' . _lienhe . '</span>';
              }
            } ?>
          </div>
        
        </div>
        <!---END .item-->
      </div>
    <?php } ?>
  </div>
  <!---END .wap_item-->
  <div class="pagination"><?= pagesListLimitadmin($url_link, $totalRows, $pageSize, $offset) ?></div>
<?php } ?>
<div class="mb-30"></div>