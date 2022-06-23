<?php if($seoh2 != ''){ ?><h2 class="d-none"><?=$seoh2?></h2><?php } ?>
<div class="row">
<?php foreach($tintuc as $v){ ?>
<div class="col-lg-4 col-sm-6 col-12 mb-30">
    <div class="item item_news" >
        <a href="<?=$com?>/<?=$v['tenkhongdau']?>.html"  class="a_cover"></a>
        <div class="item_img hover_sang phong_to">
            <img src="thumb/800x500x1x90/<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>" onerror="this.src='http://<?=$config_url?>/thumb/800x500x1x90/images/default-img.jpg';"   /> 
        </div>
        <h3 class="item_name px-0 text-center fonttieude"><?=$v['ten']?></h3>
    </div>
</div>
<?php }?>
</div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
<div class="mb-30"></div>