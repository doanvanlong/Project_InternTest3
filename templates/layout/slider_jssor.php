<?php 
    $d->reset();
    $sql_slider = "select ten$lang as ten,link,photo,mota$lang as mota from #_slider where hienthi=1 and type='slider' order by stt,id desc";
    $d->query($sql_slider);
    $slider=$d->result_array();
?>
<div class="div_slider">
    <div id="slider" class="arrow_hover">
        <?php for($i=0;$i<count($slider);$i++){ ?>
             <a href="<?=($slider[$i]['link'] != '')?$slider[$i]['link']:'javascript:void(0)'?>" <?=($slider[$i]['link'] != '')?'target="_blank"':''?> >
                <div class="slider-img">
                    <?php if($deviceType == 'computer'){ ?>
                        <img src="thumb/1920x800x1x90/<?= _upload_hinhanh_l.$slider[$i]['photo'] ?>" alt="<?=$slider[$i]['ten']?>" />
                    <?php }else{ ?>
                        <img src="thumb/960x400x1x90/<?= _upload_hinhanh_l.$slider[$i]['photo'] ?>" alt="<?=$slider[$i]['ten']?>" />
                    <?php } ?>
                </div>
             </a>
        <?php } ?>
    </div> 
</div>


