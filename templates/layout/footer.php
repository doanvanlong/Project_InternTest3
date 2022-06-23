<?php
$d->reset();
$sql = "select ten$lang as ten, noidung$lang as noidung from #_about where type='text-footer' limit 0,1";
$d->query($sql);
$text_footer = $d->fetch_array();

$d->reset();
$sql = "select ten$lang as ten,link,id,photo from #_slider where hienthi=1 and type='social' order by stt,id desc";
$d->query($sql);
$social = $d->result_array();
$d->reset();
$sql = "select photo from #_background where type = 'banner-footer'";
$d->query($sql);
$background = $d->fetch_array();
?>
<div id="w_footer" style="background-image:url('<?= _upload_hinhanh_l . $background['photo'] ?>')">
    <div id="footer">
        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-12 col-md-6 col-12">
                    <div class="tt_footer tt_company">
                        <?= $text_footer['ten'] ?>
                    </div>
                    <div class="content pt-3 mota_footer"><?= $text_footer['noidung'] ?></div>

                    <div id="social_footer2">
                        <span>Liên kết với chúng tôi: &nbsp;</span>
                        <?php foreach ($social as $k => $v) { ?>
                            <a target="_blank" href="<?= $v['link'] ?>" title="<?= $v['ten'] ?>"><img src="<?= _upload_hinhanh_l . $v['photo'] ?>" alt="<?= $v['ten'] ?>"></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 col-md-6 col-12">
                    <div class="tt_footer">
                        FANPAGE
                        <span class="chan_footer"></span>
                        <div class="nd_fb">
                            <?php  //echo getAddonsOnline("fanpage","fanpage","fanpage",420,200);
                            ?>
                            <div class="fb-page" data-href="<?= $company['fanpage'] ?>" data-tabs="timeline" data-height="200" data-width="420" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
                        </div>
                    </div>
                    <ul class="list_vertical">
                        <?php foreach ($chinhsach as $k => $v) { ?>
                            <li><a href="chinh-sach/<?= $v['tenkhongdau'] ?>.html"><?= $v['ten'] ?></a></li>
                        <?php } ?>

                    </ul>

                </div>
                <div class="col-lg-4 col-sm-12 col-md-12 col-12">
                    <div class="tt_footer">
                        <?= _ketnoivoichungtoi ?>
                        <span class="chan_footer"></span>
                        <div class="">
                            <div class="x_map-index"><?= $company['link_googlemap'] ?></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="div_footer_bottom">
            <div class="container">
                <div class="footer_bottom">
                    <div class="text-copy">Copyright © <?=$current_year?> <span><?= $company['copyright'] ?></span>. All rights reserved. Web Design by DaNangWeb.vn</div>
                    <div class="text_thongke">
                        <span>Đang online : <span class="hightlight_text"><?=$online?></span> </span>
                        <span>Trong tháng : <span class="hightlight_text"><?=$trongthang?></span></span>
                        <span>Tổng truy cập : <span class="hightlight_text"><?=$tongtruycap?></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---END #footer-->

</div>
<div id="back-to-top" style="display: none;"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>