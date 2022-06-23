<?php
  $d->reset();
  $sql_banner = "select photo$lang as photo from #_background where type='logo_dnw' limit 0,1";
  $d->query($sql_banner);
  $row_logo = $d->fetch_array();
?>
<div class="logo" style="padding:20px 5px"> <a href="index.php"  style="display: block;"> <img src="<?=_upload_hinhanh.$row_logo['photo']?>" style="width:94%; margin: 0 auto;" alt="logo" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav"> 
<li class="cat_fa" id="menu12"><a class=" active" title="" href="index.php"><span><i class="fa fa-tachometer" style="font-size: 15px;"></i> Dashboard</span></a></li>
<?php if($_SESSION["login"]["username"]=="danangweb"){?>
<li class="cat_fa <?php if(in_array($_GET['type'], array('mail')) || in_array($_GET['act'], array('userLog'))) echo ' activemenu' ?>" id="menu_ml"><a href="" title="" class="exp"><span><i class="fa fa-tachometer"></i> Mail login</span><strong></strong></a>
 <ul class="sub">
    <li><a href="index.php?com=about&act=capnhat&type=mail">Giới thiệu</a></li>
	<li><a href="index.php?com=user&act=userLog">User khóa</a></li>
</ul>
</li>
<?php }?>
<li class="cat_fa <?php if(in_array($_GET['type'], array('logo','logo-footer','favicon'))) echo ' activemenu' ?>" id="menu_LS"><a href="" title="" class="exp"><span><i class="fa fa-image"></i>Logo</span><strong></strong></a>
 <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Logo','Logo header','background','capnhat','logo'); ?>
    <?php //$pqmenu->phanquyen_menu('Logo','Logo footer','background','capnhat','logo-footer'); ?>
    <?php $pqmenu->phanquyen_menu('Logo','Favicon website','background','capnhat','favicon'); ?>
    <?php //$pqmenu->phanquyen_menu('Logo','Icon Best Sale','background','capnhat','icon-best-sale'); ?>
</ul>
</li>
<li class="cat_fa <?php if(in_array($_GET['type'], array('slider','index','text-gioi-thieu','text-mo-ta-thuc-don','banner-footer','banner-thuc-don','he-thong-phong','text-mo-ta-video','ve-chung-toi','text-footer','social'))) echo ' activemenu' ?>" id="menu_TC"><a href="" title="" class="exp"><span><i class="fa fa-th-large" style="font-size: 15px;"></i> Trang chủ</span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Trang chủ','Slider','slider','man_photo','slider'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Đoạn giới thiệu ngắn','about','capnhat','text-gioi-thieu'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Banner hệ thống phòng','background','capnhat','he-thong-phong'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Text mô tả thực đơn','about','capnhat','text-mo-ta-thuc-don'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Banner thực đơn','background','capnhat','banner-thuc-don'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Về chúng tôi','slider','man_photo','ve-chung-toi'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Banner về chúng tôi','background','capnhat','ve-chung-toi'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Text mô tả video','about','capnhat','text-mo-ta-video'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Text footer','about','capnhat','text-footer'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Mạng xã hội','slider','man_photo','social'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Banner footer','background','capnhat','banner-footer'); ?>
    <?php $pqmenu->phanquyen_menu('Trang chủ','Khai báo SEO Trang chủ','about','capnhat','index'); ?>
  </ul>
</li>
<li class="cat_fa <?php if(in_array($_GET['type'], array('gioi-thieu'))) echo ' activemenu' ?>" id="menu_GT"><a href="" title="" class="exp"><span><i class="fa fa-indent"></i> Giới thiệu</span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Giới thiệu','Giới thiệu','about','capnhat','gioi-thieu'); ?>
  </ul>
</li>
<li class="cat_fa <?php if($_GET['com'] == 'order' || in_array($_GET['type'], array('san-pham','hinh-thuc-thanh-toan','giohang'))) echo ' activemenu' ?>" id="menu_SP"><a href="" title="" class="exp"><span><i class="fa fa-shopping-bag"></i> Sản phẩm</span><strong></strong></a>
 <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Sản phẩm','Danh mục cấp 1','product','man_danhmuc','san-pham'); ?>
    <?php $pqmenu->phanquyen_menu('Sản phẩm','Sản phẩm','product','man','san-pham'); ?>
    <?php $pqmenu->phanquyen_menu('Sản phẩm','Đánh giá sản phẩm','comment','man','san-pham'); ?>
    <?php //$pqmenu->phanquyen_menu('Sản phẩm','Size','product','man_size','san-pham'); ?>
    <?php //$pqmenu->phanquyen_menu('Sản phẩm','Color','product','man_color','san-pham'); ?>
	  <?php $pqmenu->phanquyen_menu('Sản phẩm','Khai báo SEO Google','about','capnhat','san-pham'); ?>
  </ul>
</li>
<li class="cat_fa <?php if(in_array($_GET['type'], array('thuc-don'))) echo ' activemenu' ?>" id="menu_TD"><a href="" title="" class="exp"><span><i class="fa fa-bars" aria-hidden="true"></i> Thực đơn</span><strong></strong></a>
 <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Thực đơn','Danh mục cấp 1','product','man_danhmuc','thuc-don'); ?>
    <?php $pqmenu->phanquyen_menu('Thực đơn','Thực đơn','product','man','thuc-don'); ?>
	  <?php $pqmenu->phanquyen_menu('Thực đơn','Khai báo SEO Google','about','capnhat','thuc-don'); ?>
  </ul>
</li>


<li class="cat_fa <?php if(in_array($_GET['type'], array('hinh-anh'))) echo ' activemenu' ?>" id="menu_HA"><a href="" title="" class="exp"><span><i class="fa fa-photo"></i> Album ảnh</span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Hình ảnh','Album','news','man','hinh-anh'); ?>
	  <?php $pqmenu->phanquyen_menu('Hình ảnh','Khai báo SEO Google','about','capnhat','hinh-anh'); ?>
  </ul>
</li>

<li class="cat_fa <?php if($_GET['com'] == 'video' || in_array($_GET['type'], array('video'))) echo ' activemenu' ?>" id="menu_V"><a href="" title="" class="exp"><span><i class="fa fa-youtube-play"></i> Video</span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Video','Video','video','man',''); ?>
  	<?php $pqmenu->phanquyen_menu('Video','Khai báo SEO Google','about','capnhat','video'); ?>
  </ul>
</li>
<li class="cat_fa <?php if($_GET['com']!='contact' && in_array($_GET['type'], array('lien-he'))) echo ' activemenu' ?>" id="menu_LH"><a href="" title="" class="exp"><span><i class="fa fa-envelope-o"></i> Liên hệ</span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Liên hệ','Thông tin liên hệ','about','capnhat','lien-he'); ?>
  </ul>
</li>

<li class="cat_fa <?= ($_GET['com']=='contact' || $_GET['com']=='newsletter')?'activemenu':'' ?>" id="menu_DK"><a href="" title="" class="exp"><span><i class="fa fa-user-plus"></i> Đăng ký </span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Đăng ký','Đặt phòng','contact','man','dat-phong'); ?>
    <?php $pqmenu->phanquyen_menu('Đăng ký','Liên hệ','contact','man','lien-he'); ?>
    <?php $pqmenu->phanquyen_menu('Đăng ký','Yêu cầu gọi lại','contact','man','goi-dien'); ?>
    <?php $pqmenu->phanquyen_menu('Đăng ký','Gửi tin nhắn','contact','man','gui-tin'); ?>
    <?php //$pqmenu->phanquyen_menu('Đăng ký','Đăng ký nhận tin','newsletter','man','nhantin'); ?>
  </ul>
</li>
<li class="cat_fa <?php if ($_GET['com']=='company' || $_GET['com']=='user' || $_GET['com']=='phanquyen' || $_GET['com']=='deletecache')  echo ' activemenu' ?>" id="menu_S"><a href="" title="" class="exp"><span><i class="fa fa-cogs"></i> Thông tin công ty</span><strong></strong></a>
  <ul class="sub">
    <?php $pqmenu->phanquyen_menu('Thông tin công ty','Thông tin công ty','company','capnhat',''); ?>
    <?php $pqmenu->phanquyen_menu('Thông tin công ty','Thông tin tài Khoản','user','admin_edit',''); ?>
    <?php $pqmenu->phanquyen_menu('Thông tin công ty','Xóa bộ nhớ tạm','deletecache','',''); ?>
  </ul>
</li>
</ul>




