<script language="javascript"> 
    function doEnter2(evt){
    var key;
    if(evt.keyCode == 13 || evt.which == 13){
        onSearch2(evt);
    }
    }
    function onSearch2(evt) {
            var keyword2 = document.getElementById("keyword2").value;
            if(keyword2=='' || keyword2=='<?=_nhaptukhoatimkiem?>...')
            {
                alert('<?=_chuanhaptukhoa?>');
            }
            else{
                location.href = "tim-kiem.html&keyword="+keyword2;
                loadPage(document.location);
            }
        }
</script>
<!--Tim kiem-->


<nav id="menu_mobi" class="menu_overlay">
    <div class="text-center caption_menu">Menu</div>
    <div id="search_mobi">
        <input type="text" name="keyword2" id="keyword2" onKeyPress="doEnter2(event,'keyword2');" placeholder="<?=_nhaptukhoatimkiem?>..." />
        <i class="fa fa-search" aria-hidden="true" onclick="onSearch2(event,'keyword2');"></i>
    </div><!---END #search-->
    <ul>
        <li class="no-border">
            <a class="ac <?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href=""><?=_trangchu?></a>
        </li>
        <li><a class="ac <?php if($_REQUEST['com'] == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu.html"><?=_gioithieu?></a></li>
        <li><a class="ac <?php if($_REQUEST['com'] == 'san-pham') echo 'active'; ?>" href="san-pham.html"><?=_hethongphong?></a>
        <?php if(count($sp_danhmuc)){ ?>
            <i class="fa fa-angle-right"></i>
            <ul>
                <?php for ($i=0,$count=count($sp_danhmuc); $i<$count;$i++) { 
                    $d->reset();
                    $sql="select ten$lang as ten,id,tenkhongdau from #_product_list where hienthi=1  and noibat=1  and type='san-pham' and id_danhmuc=".$sp_danhmuc[$i]['id']." order by stt,id desc"; 
                    $d->query($sql);
                    $sp_list=$d->result_array();
                    ?>
                    <li><a href="san-pham/<?=$sp_danhmuc[$i]['tenkhongdau']?>"><?=$sp_danhmuc[$i]['ten']?></a>
                        <?php if(count($sp_list)){ ?>
                            <i class="fa fa-angle-right"></i>
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
        <li><a class="ac <?php if($_REQUEST['com'] == 'thuc-don') echo 'active'; ?>" href="thuc-don.html"><?=_thucdon?></a></li>
        <li><a class="ac <?php if($_REQUEST['com'] == 'hinh-anh') echo 'active'; ?>" href="hinh-anh.html"><?=_album?></a></li>
        <li><a class="ac <?php if($_REQUEST['com'] == 'video') echo 'active'; ?>" href="video.html">Video</a></li>
        <li class="last"><a class="ac <?php if($_REQUEST['com'] == 'lien-he') echo 'active'; ?>" href="lien-he.html"><?=_lienhe?></a></li>
    </ul>
</nav>