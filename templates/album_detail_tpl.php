<div class="item_news_detail">
    <div class="wtieudepage">
        <span class="tieude_page">
            <?= $title_cat ?>
        </span>
    </div>

    <?php if (trim($tintuc_detail['noidung']) != '') { ?>
    <?php } ?>

    <div class="row">
        <?php foreach ($hinhkhac as $k => $v) { ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="my-3">
                    <a data-fancybox="gallery" data-caption="<?= $v['ten'] ?>" href="<?= _upload_hinhthem_l . $v['photo'] ?>">
                        <img  width="100%" src="thumb/274x212x1x90/<?= _upload_hinhthem_l . $v['photo'] ?>" alt="<?= $title_cat ?>">
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="addthis_native_toolbox"></div>
</div>
<div class="mb-30"></div>