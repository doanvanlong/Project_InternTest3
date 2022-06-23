<div class="wrapper">
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'vi'
      }, 'google_translate_element');
      var removePopup = document.getElementById('goog-gt-tt');
      removePopup.parentNode.removeChild(removePopup);
    }
    $(document).ready(function() {
      var isMobile = window.matchMedia("only screen and (max-width: 960px)").matches;
      if (!isMobile) {
        $('.translate').html('<div id="google_translate_element"></div>');
      } else {
        $('.translate2').html('<div id="google_translate_element"></div>');
      }
    });
  </script>
  <div class="action_menu_mobi">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <div class="welcome"><a href="javascript:void(0)" title=""><img src="images/male-user.png" alt="" /></a><span>Xin chào, <?= $_SESSION['login']['name'] ?>!</span></div>
  <div class="userNav">
    <ul>

      <li><a href="http://<?= $config_url ?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Xem Website</span></a></li>
      <?php

      $d->reset();
      $sql = "select count(id) as num from table_comment where dadoc=0 and type='san-pham'";
      $d->query($sql);
      $row_danhgia = $d->fetch_array();


      $row_goidien = demContact('goi-dien');

      $row_guitin = demContact('gui-tin');

      $row_lienhe = demContact('lien-he');
      $row_datphong = demContact('dat-phong');

      $tong_count = $row_danhgia['num'] + $row_goidien + $row_guitin + $row_lienhe + $row_datphong;


      ?>

      <li class="ddnew"><a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Thông báo</span><span class="numberTop"><?= $tong_count ?></span></a>
        <ul class="userMessage">
          <li><a href="index.php?com=contact&act=man&type=dat-phong" title=""><span><i class="fa fa-envelope"></i>&nbsp;Đặt phòng</span><span class="numberTop"><?= $row_datphong ?></span></a></li>
          <li><a href="index.php?com=comment&act=man&type=san-pham" title=""><span><i class="fa fa-envelope"></i>&nbsp;Đánh giá</span><span class="numberTop"><?= $row_danhgia['num'] ?></span></a></li>
          <li><a href="index.php?com=contact&act=man&type=lien-he" title=""><span><i class="fa fa-envelope"></i>&nbsp;Liên hệ</span><span class="numberTop"><?= $row_lienhe ?></span></a></li>

          <li><a href="index.php?com=contact&act=man&type=goi-dien" title=""><span><i class="fa fa-envelope"></i>&nbsp;Yêu cầu gọi điện</span><span class="numberTop"><?= $row_goidien ?></span></a></li>
          <li><a href="index.php?com=contact&act=man&type=gui-tin" title=""><span><i class="fa fa-envelope"></i>&nbsp;Gửi tin nhắn</span><span class="numberTop"><?= $row_guitin ?></span></a></li>
        </ul>
      </li>
      <li class="dd"><a title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Thông tin admin</span></a>
        <ul class="userDropdown">

          <li><a href="index.php?com=user&act=admin_edit" title=""><span><i class="fa fa-user"></i>&nbsp;Thông tin tài khoản</span></a></li>
          <li><a href="index.php?com=user&act=admin_edit" title=""><span><i class="fa fa-key"></i>&nbsp;Đổi mật khẩu</span></a></li>
          <?php if ($_SESSION['login']['com'] == 'admin') { ?>
            <?php /* ?> <li><a href="index.php?com=user&act=man" title=""><span><i class="fa fa-users"></i>&nbsp;Quản lý thành viên</span></a></li><?php */ ?>
            <li class=""><a href="index.php?com=deletecache" title=""><span><i class="fa fa-trash"></i>&nbsp;Xóa bộ nhớ tạm</span></a></li>
          <?php } ?>
          <?php /* ?> 
                        <li><a href="index.php?com=about&act=capnhat&type=dangky" title=""><span>Đăng ký</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=dangnhap" title=""><span>Đăng nhập</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=quenmatkhau" title=""><span>Quên mật khẩu</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=thaydoithongtin" title=""><span>Thay đổi thông tin</span></a></li>
                        <?php */ ?>
        </ul>
      </li>


      <li class="ddsetting"><a title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Hỗ trợ</span></a>
        <div class="userSetting">
          <div class="userSettingContent">
            <div id="div_hotro_head">
              <div class="ul">
                <div class="li"><a href="https://danangweb.vn/gioi-thieu.html" title="Tổng quan về Đà nẵng Web" target="_blank"><span class="dot"></span> Tổng quan về Đà nẵng Web</a></div>
                <div class="li"><a href="https://danangweb.vn/giao-dien-quan-tri-website
" title="Giới thiệu giao diện quản trị" target="_blank"><span class="dot"></span> Giới thiệu giao diện quản trị</a></div>
                <div class="li"><a href="https://danangweb.vn/huong-dan-quan-tri-website
" title="Hướng dẫn" target="_blank"><span class="dot"></span> Hướng dẫn</a></div>
              </div>
            </div>
            <div id="div_hotro_body">
              <div class="hotro_item">
                <a href="https://danangweb.vn/ho-tro.html" target="_blank" title="Câu hỏi thường gặp"></a>
                <div class="hotro_img"><img src="images/hotro1.png"></div>
                <div class="hotro_txt"> Câu hỏi <br /> thường gặp</div>
              </div>
              <div class="hotro_item">
                <a href="https://danangweb.vn/ho-tro.html" target="_blank" title="Video hướng dẫn"></a>
                <div class="hotro_img"><img src="images/hotro2.png"></div>
                <div class="hotro_txt"> Video <br /> hướng dẫn</div>
              </div>
              <div class="hotro_item">
                <a href="https://danangweb.vn/ho-tro.html" target="_blank" title="Tài liệu hướng dẫn"></a>
                <div class="hotro_img"><img src="images/hotro3.png"></div>
                <div class="hotro_txt"> Tài liệu <br /> hướng dẫn</div>
              </div>
            </div>
            <div id="div_hotro_footer">
              <div class="hotro_footer"><a href="tel:0905 43 02 43" target="_blank"><img src="images/phone.png" height="25" /> <span>0905 43 02 43 (Miễn phí)</span></a></div>
              <div class="hotro_footer"><a href="https://danangweb.vn/lien-he.html" target="_blank" title="Gửi hỗ trợ"><img src="images/technical-support.png" height="25" /> <span>Gửi hỗ trợ</span></a></div>

            </div>
          </div>
        </div>
      </li>

      <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
      <li class="boxtranslate">
        <div class="translate"></div>
      </li>
      <?php /* ?><li class="none"><a href="../admin/sitemap.php" title="" target="_blank"><span>Cập nhật sitemap</span></a></li><?php */ ?>
      <?php /* ?><li><a href="javascript:void(0)"><span>Trợ giúp</span></a></li><?php */ ?>

    </ul>
  </div>
  <div class="clear"></div>
</div>