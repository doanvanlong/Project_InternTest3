<?php 

$d->reset();
$sql="select ten$lang as ten,id,tenkhongdau from #_product_danhmuc where hienthi=1  and noibat=1  and type='san-pham' order by stt,id desc"; 
$d->query($sql);
$sp_danhmuc=$d->result_array();

$d->reset();
$sql="select ten$lang as ten,id,tenkhongdau from #_product_danhmuc where hienthi=1  and noibat=1  and type='thuc-don' order by stt,id desc"; 
$d->query($sql);
$n_danhmuc=$d->result_array();

 ?>

<ul class="main_nav">
    <li> <a class="ac <?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href=""><?=_trangchu?></a></li>
     <li><a class="ac <?php if($_REQUEST['com'] == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu.html"><?=_gioithieu?></a></li>

    <li><a class="ac <?php if($_REQUEST['com'] == 'san-pham') echo 'active'; ?>" href="san-pham.html"><?=_hethongphong?></a>
        <?php if(count($sp_danhmuc)){ ?>
            <ul class="">
                <?php for ($i=0,$count=count($sp_danhmuc); $i<$count;$i++) {

                    $d->reset();
                    $sql="select ten$lang as ten,id,tenkhongdau from #_product_list where hienthi=1  and noibat=1  and type='san-pham' and id_danhmuc='".$sp_danhmuc[$i]['id']."' order by stt,id desc"; 
                    $d->query($sql);
                    $sp_list=$d->result_array();
                 ?>
                <li><a href="san-pham/<?=$sp_danhmuc[$i]['tenkhongdau']?>"><?=$sp_danhmuc[$i]['ten']?></a>
                    <?php if(count($sp_list)){ ?>
                        <ul>
                            <?php foreach($sp_list as $list){ ?>
                            <li><a href="san-pham/<?=$list['tenkhongdau']?>/"><?=$list['ten']?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </li>
    <li><a class="ac <?php if($_REQUEST['com'] == 'thuc-don') echo 'active'; ?>" href="thuc-don.html"><?=_thucdon?> </a>
        <?php if(count($n_danhmuc)){ ?>
            <ul class="">
                <?php for ($i=0,$count=count($n_danhmuc); $i<$count;$i++) {?>
                <li><a href="thuc-don/<?=$n_danhmuc[$i]['tenkhongdau']?>"><?=$n_danhmuc[$i]['ten']?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </li>
    <li><a class="ac <?php if($_REQUEST['com'] == 'hinh-anh') echo 'active'; ?>" href="hinh-anh.html"><?=_album?></a></li>
    <li><a class="ac <?php if($_REQUEST['com'] == 'video') echo 'active'; ?>" href="video.html">Video</a></li>

    <li>
        <a class="ac <?php if($_REQUEST['com'] == 'lien-he') echo 'active'; ?>" href="lien-he.html"><?=_lienhe?></a>
    </li>
    <li class="search_icon">
        <a href="javascript:avoid(0)" class="search_icon_desktop"></a>
    </li>
    
</ul> 

<div id="search_desktop" >
    <input type="text" autocomplete="none" placeholder="Nhập từ khoá tìm kiếm" name="keyword" id="keyword" onKeyPress="doEnter(event,'keyword');">
    <i class="fa fa-search" onclick="onSearch(event,'keyword');" aria-hidden="true"></i>
</div>
<script>
    $('.search_icon_desktop').click(function(){
        $(this).toggleClass('open');
        $('#search_desktop').toggleClass('active')
    })
   
</script>


