<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=comment&act=man&type=<?=$_GET['type']?>"><span>Liên hệ</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Nội dung</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">     
    function TreeFilterChanged2(){      
                $('#validate').submit();        
    }
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=comment&act=save&type=<?=$_GET['type']?><?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?>" method="post" enctype="multipart/form-data">
<div id="div_fixed">
    <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>

    <a href="index.php?com=comment&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
</div>  

     <div class="widget mt-10">
         <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Thông tin thư</h6> 
        </div>

       <div id="info" class="tab_content">
        <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
             
        <div class="formRow <?=(!$config_s['ten'])?'none':''?>">
            <label>Tên:</label>
            <div class="formRight">
                <label><?=@$item['ten']?></label>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow <?=(!$config_s['dienthoai'])?'none':''?>">
            <label>Số điện thoại:</label>
            <div class="formRight">
                <label><?=@$item['dienthoai']?></label>
            </div>
            <div class="clear"></div>
        </div>
       
        <div class="formRow <?=(!$config_s['email'])?'none':''?>">
            <label>Email:</label>
            <div class="formRight">
                <label><?=@$item['email']?></label>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow <?=(!$config_s['sanpham'])?'none':''?>">
            <label>Sản phẩm:</label>
            <div class="formRight">
                <?php $infoProduct = getProductInfo($item['id_product']); ?>
                <label><a href="http://<?=$config_url?>/san-pham/<?=$infoProduct['tenkhongdau']?>.html" target="_blank"><?=$infoProduct['ten']?></a></label>
            </div>
            <div class="clear"></div>
        </div> 
       
        <div class="myrow">
            <div class="mycol-6 mycol-table-6 mycol-mobi-12">
                <div class="formRow <?=(!$config_s['sanpham'])?'none':''?>">
                    <label>Đánh giá:</label>
                    <div class="formRight">

                        <?php for ($i=1; $i <= 5; $i++) { 
                            if($i <= $item['star']){
                                echo '<i class="fa fa-star"></i>';
                            }else{
                                echo '<i class="fa fa-star-o"></i>';
                            }
                         } ?>

                        <select id="star" name="star" class="main_select select_danhmuc chzn-select">
                          <option value="1" <?php if($item['star'] == 1) echo 'selected="selected"'; ?>>Rất tệ</option>     
                          <option value="2" <?php if($item['star'] == 2) echo 'selected="selected"'; ?>>Không tệ</option>     
                          <option value="3" <?php if($item['star'] == 3) echo 'selected="selected"'; ?>>Trung bình</option>     
                          <option value="4" <?php if($item['star'] == 4) echo 'selected="selected"'; ?>>Tốt</option>     
                          <option value="5" <?php if($item['star'] == 5) echo 'selected="selected"'; ?>>Tuyệt vời</option>     
                        </select>

                        
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        
        <div class="formRow <?=(!$config_s['noidung'])?'none':''?>">
            <label>Nội dung:</label>
            <div class="formRight">
                <label><?=$item['noidung']?></label>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Hình ảnh:</label>
            <div class="formRight">
                <?php for ($i=1; $i <=3 ; $i++) { 

                    if($item['photo'.$i] != ''){ 
                        $file_size = filesize($_SERVER['DOCUMENT_ROOT']."/"._upload_binhluan_l.$item['photo'.$i]); // Get file size in bytes
                        $file_size = $file_size/1000; // Get file size in KB
                    ?>
                    <div class="binhluan_img binhluan_img_<?=$i?>">
                        <img src="<?=_upload_binhluan.$item['photo'.$i]?>" onclick="return viewImg()" data-src="<?=_upload_binhluan.$item['photo'.$i]?>" />
                        <div class="binhluan_img_bottom">
                            <div class="binhluan_img_size"><i class="fa fa-image"></i> <span><?=round($file_size,2)."Kb";?></span></div>
                            <div class="binhluan_img_del" data-id="<?=$item['id']?>" data-stt="<?=$i?>"><i class="fa fa-trash"></i></div>
                        </div>
                    </div>
                        
                    <?php }} ?>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Ngày đánh giá:</label>
            <div class="formRight">
                <label><?=Date('d-m-Y H:i:s',$item['ngaytao'])?></label>
            </div>
            <div class="clear"></div>
        </div>
        
        
        <div class="formRow">
            <label>Trả lời:</label>
            <div class="formRight">
                <textarea  rows="8" cols="" title="Viết trả lời cho đánh giá" class="tipS" name="reply" id="reply"><?=@$item['reply']?></textarea>
            </div>
            <div class="clear"></div>
        </div> 

       

        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(isset($item['hienthi']) && $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>   

            <input type="checkbox" name="dadoc" id="check2" value="1" <?=(isset($item['dadoc']) && $item['dadoc']==1)?'checked="checked"':''?> />
            <label for="check2">Đã đọc</label> 

            <input type="checkbox" name="chungnhan" id="check3" value="1" <?=(isset($item['chungnhan']) && $item['chungnhan']==1)?'checked="checked"':''?> />
            <label for="check3">Xác nhận SĐT mua hàng</label>

          </div>
          <div class="clear"></div>
        </div>
       </div>
    </div>
    <div class="w_submit">
        <div class="formRight">
            <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
            <a href="index.php?com=comment&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
        </div>
        <div class="clear"></div>
    </div>

</form>   

<div class="modal" id="modal-img">
    <div class="modal-bg">
        <div class="modal-content">
            <div class="modal-close">&times;</div>
            <div class="modal-img">
                <img src="" alt="">
            </div>
        </div>
    </div>
</div> 

<style type="text/css">
    .binhluan_img{
        width: 150px;
        height: 150px;
        display: inline-block;
        margin: 5px;
        position: relative;
        cursor: pointer;
    }
    .binhluan_img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        
    }
    .binhluan_img_bottom{
        position: absolute;
        left: 0;
        bottom: 0;
        background: rgba(0,0,0,0.4);
        display: flex;
        justify-content: space-between;
        padding: 5px;
        width: 100%;
        color: #fff;
    }
    .binhluan_img_del{
        cursor: pointer;
    } 
    .modal-img img{
        background: #fff;
    }
    @media only screen and (max-width:426px) {
         .binhluan_img{
            width: calc(50% - 15px);
        }

    }
</style>
<script>
    $(document).ready(function(){
        $('.modal .modal-close').click(function () {
            $('.modal').removeClass('active');
        });
        $('.modal .modal-bg').click(function () {
            $('.modal').removeClass('active');
        });
        $('.binhluan_img img').on('click',function(){
            var src = $(this).data('src');
            $("#modal-img .modal-img img").attr("src",src);
            $('#modal-img').addClass('active');
        });

        $('.binhluan_img_del').click(function(){
            var id=$(this).data("id");
            var stt=$(this).data("stt");
            $.ajax({
                type: "POST",
                url: "ajax/xuly_admin_dn.php",
                data: {id:id,stt:stt, act: 'remove_image_comment'},
                success:function(data){
                    $(".binhluan_img_"+stt).remove();
                }
            })
        })
    });
        
   
</script>