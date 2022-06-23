<?php
$d->reset();
$sql = "select id,ten$lang as ten,tenkhongdau,link,photo from #_video where hienthi=1 order by id asc ";
$d->query($sql);
$videos = $d->result_array();
$sql="select ten$lang as ten,mota$lang as mota,noidung$lang as noidung,photo from #_about where type='text-mo-ta-video'"; 
$d->query($sql);
$text_video=$d->fetch_array();
?>
<div id="video" class="w_dichvu">
    <div class="container">
        <div class=" slick_video_index">
            <?php
            foreach ($videos as $v) {
            ?>
                <div class=" box_video_index ">
                    <div class="video_index_img phong_to">
                        <a data-fancybox="video" href="https://www.youtube.com/embed/<?= getYoutubeIdFromUrl($v['link']) ?>" rel="video" title="<?= $v['ten'] ?>"><img src="thumb/750x480x1x90/<?= _upload_khac_l . $v['photo'] ?>" alt="<?= $v['ten'] ?>"><span class="play"></span></a>
                    </div>
                    <div class="video_index_content">
                        <div class="video_index_content_title"><?php echo strip_tags($text_video['ten'])?></div>
                        <p class="video_index_content_mota">
                        <?php echo strip_tags($text_video['noidung'])?>
                        </p>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>