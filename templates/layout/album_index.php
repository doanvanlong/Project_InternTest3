<?php
$d->reset();
$sql = "select id,stt from #_news where type='hinh-anh'  and hienthi=1  order by stt,id desc limit 2";
$d->query($sql);
$danhmuc_album = $d->result_array();

#Các hình khác  album
$i=0;
foreach ($danhmuc_album as $dm) {
    $d->reset();
    $sql_hinhkhac = "select id,ten,thumb,photo,id_hinhanh from #_hinhanh where type='hinh-anh' and id_hinhanh=".$dm['id']." and hienthi=1  order by stt,id asc";
    $d->query($sql_hinhkhac);
    $hinhkhac[$i] = $d->result_array();
    $i++;
}

?>
<div id="album" class="w_dichvu">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="title_thucdon"><span>Album ảnh</span></div>
        </div>
        <div class="item_album1">
            <div class="slick_album1">
                <?php foreach ($hinhkhac[0] as $k => $v) { ?>
                    <div class="mx-1">
                        <a data-fancybox="gallery" data-caption="<?= $v['ten'] ?>" href="<?= _upload_hinhthem_l . $v['photo'] ?>">
                            <img src="thumb/590x380x1x90/<?= _upload_hinhthem_l . $v['photo'] ?>" alt="<?= $title_cat ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="addthis_native_toolbox"></div>
        </div>
        <div class="item_album2">
            <div class="slick_album2">
                <?php foreach ($hinhkhac[1] as $k => $v) { ?>
                    <div class="mx-1">
                        <a data-fancybox="gallery" data-caption="<?= $v['ten'] ?>" href="<?= _upload_hinhthem_l . $v['photo'] ?>">
                            <img src="thumb/232x176x1x90/<?= _upload_hinhthem_l . $v['photo'] ?>" alt="<?= $title_cat ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="addthis_native_toolbox"></div>
        </div>
        <div class="mb-30"></div>

    </div>
</div>