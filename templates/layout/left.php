<?php
    $d->reset();
    $sql="select id,ten$lang as ten,id,tenkhongdau from #_product_danhmuc where hienthi=1 and type='san-pham' order by stt,id desc"; 
    $d->query($sql);
    $danhmuc_sp_left=$d->result_array();

    $d->reset(); 
    $sql="select ten$lang as ten,mota$lang as mota,tenkhongdau,id,photo from #_news where hienthi=1 and type='tin-tuc' and ngaytao<=".time()." order by ngaytao desc limit 0,5";
    $d->query($sql);
    $tinmoi=$d->result_array();

?>
<div class="div_left">
    <div class="tieude_left"><span><?=_danhmucsanpham?></span></div>
    <div class="ar_left">
        <?php 

            for($i = 0;$i<count($danhmuc_sp_left); $i++){ 

            $d->reset();
            $sql="select ten$lang as ten,id,tenkhongdau from #_product_list where hienthi=1  and noibat=1  and type='san-pham' and id_danhmuc=".$danhmuc_sp_left[$i]['id']." order by stt,id desc"; 
            $d->query($sql);
            $sp_list_left=$d->result_array();

        ?>

            <div class="item_left item_sp_left item_sp_left_<?=$danhmuc_sp_left[$i]['id']?>" >
                <div class="h3"><a href="san-pham/<?=$danhmuc_sp_left[$i]['tenkhongdau']?>">
                    <?=$danhmuc_sp_left[$i]['ten']?> 
                </a>  <?php if(count($sp_list_left)){ ?><i class="fa fa-plus" data-id="<?=$danhmuc_sp_left[$i]['id']?>"></i><?php } ?></div>
                <?php if(count($sp_list_left)){ ?>
                <ul>
                   <?php foreach($sp_list_left as $val){ ?>
                        <li><a href="san-pham/<?=$val['tenkhongdau']?>/" class="sp_list_left"><?=$val['ten']?></a></li>
                    <?php } ?> 
                </ul>
                <?php } ?>
            </div>
 
        <?php }?>
    </div>
</div> 
<div class="div_left">
    <div class="tieude_left"><span><?=_tintuc?></span></div>
    <div class="ar_left">
        <?php for($i = 0;$i<count($tinmoi); $i++){ ?>
            <div class="item_left border-bottom">
                <a href="tin-tuc/<?=$tinmoi[$i]['tenkhongdau']?>.html" class="a_cover"></a>
                <div class="item_img phong_to hover_sang">
                    <img src="thumb/200x125x1x90/<?=_upload_tintuc_l.$tinmoi[$i]['photo']?>"  onerror="this.src='http://<?=$config_url?>/thumb/200x125x1x90/images/default-img.jpg';"  />
                </div>
                <div class="item_content">
                    <div class="h3"><?=$tinmoi[$i]['ten']?></div>
                </div>
                <div class="clear"></div>
            </div>
        <?php }?>
    </div>
</div> 

<div class="div_left">
    <div class="tieude_left mb-25"><span>Fanpage</span></div>
    <div class="fb_left">
         <div class="fb-page" data-href="<?=$company['fanpage']?>" data-tabs="timeline"  data-height="420"  data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
     </div>
</div>
