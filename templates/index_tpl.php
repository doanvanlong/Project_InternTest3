<?php
$d->reset();
$sql = "select ten$lang as ten,mota$lang as mota,id,tenkhongdau,photo,noidung from #_product_danhmuc where hienthi=1 and type='san-pham' and noibat_tc=1 order by stt,id desc";
$d->query($sql);
$danhmuc_id = $d->result_array();
$d->reset();
$sql = "select photo from #_background where type = 'he-thong-phong'";
$d->query($sql);
$background = $d->fetch_array();
$d->reset();
$sql = "select photo from #_background where type = 'banner-thuc-don'";
$d->query($sql);
$background_td = $d->fetch_array();
$d->reset();
$sql = "select *,ten$lang as ten from table_product where hienthi=1  and type='thuc-don' and noibat=1 order by stt,id desc limit 0,15";
$d->query($sql);
$thuc_don = $d->result_array();
$d->reset();
$sql="select ten$lang as ten,mota$lang as mota,noidung$lang as noidung,photo from #_about where type='text-mo-ta-thuc-don'"; 
$d->query($sql);
$text_thucdon=$d->fetch_array();
?>
<!-- hệ thống phòng -->
<div id="hethongphong" class="w_dichvu pb-30 mt-5" style="background-image:url('<?= _upload_hinhanh_l . $background['photo'] ?>')">
  <div class="container">
    <div class="col-12 text-center">
      <h4 class="title_hethongphong">Hệ thống phòng karaoke tại Caesars</h4>
    </div>
    <?php for ($i = 0; $i < count($danhmuc_id); $i++) {
    ?>
      <div class="row py-4">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 <?php echo ($i % 2 == 0) ? 'order-0' : 'order-1' ?> ">
          <a href="san-pham/<?= $danhmuc_id[$i]['tenkhongdau'] ?>" class="box_img zoom_img padding-moblie" style="<?php echo ($i % 2 == 0) ? 'padding-right:20px' : 'padding-left:20px' ?>">
            <img src="thumb/655x375x1x90/<?= _upload_sanpham_l . $danhmuc_id[$i]['photo'] ?>" alt="">
          </a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 pt-3 <?php echo ($i % 2 == 0) ? 'pl-4' : 'pr-4' ?>">
          <h2 class="tieude_gc"><a href="san-pham/<?= $danhmuc_id[$i]['tenkhongdau'] ?>"><?= $danhmuc_id[$i]['ten'] ?></a></h2>
          <p class="mota_htphong"><?php echo strip_tags($danhmuc_id[$i]['noidung']) ?></p>
          <a class="xemthem_htphong" href="san-pham/<?= $danhmuc_id[$i]['tenkhongdau'] ?>">Xem thêm</a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<!-- thực đơn -->
<div id="thucdon" class="w_dichvu">
  <div class="container pb-5">
    <div class="row justify-content-center">
      <div class="title_thucdon"><span><?php echo strip_tags($text_thucdon['ten'])?></span></div>
    </div>
    <div class="slogan_thucdon"><?php echo strip_tags($text_thucdon['noidung'])?></div>
  </div>
  <div class="w_dichvu" id="box_items_thucdon" style="background-image:url('<?= _upload_hinhanh_l . $background_td['photo'] ?>')">
    <div class="container">
      <div class=" slick_thucdon">
        <?php
        foreach ($thuc_don as $td) {
        ?>
          <a data-fancybox="gallery" data-caption="<?= $td['ten'] ?>" href="<?= _upload_sanpham_l . $td['photo'] ?>" class="mx-3">
            <img src="<?=_upload_sanpham_l.$td['photo']?>" alt="">
          </a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>