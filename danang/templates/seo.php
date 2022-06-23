<?php 
	include "templates/url.php";
	$seo_time = time() - 60*60*24*90;

   $pattern = '/^[a-zA-Z0-9-]+$/';
   
    
 ?>
<div class="widget" style="position:relative;">
    <div class="title" style="padding: 5px 14px 5px 0;">
		<img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
      	<b class="seo_info1" style="">Nội dung SEO</b>
        <div class="wbuttonseo">
            <a href="https://danangweb.com.vn/huong-dan-noi-dung-seo" class="btn btn-success nhapnhay button_huongdan" target="_blank">Xem hướng dẫn</a>
            <p class="btn btn-warning nhapnhay button_taoseo" onclick="return taoSEO()">Tạo SEO Tự Động</p>
        </div>
      	<b class="seo_info2">SEO Google được chuyên gia Đà Nẵng SEO update ngày: <?=date('d/m/Y',$seo_time)?></b>
      	<div class="clear"></div>
    </div>
   
    <?php if($_GET['com'] != 'about'){ ?> 
    <div class="formRow">
        <label>Tên bài viết</label>
        <div class="formRight" id="tenbaiviet">
            <?=isset($item['ten'])?$item['ten']:'Bạn chưa nhập tên bài viết!'?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="formRow">
        <label>Link url</label>
        <div class="formRight d-flex">
        	<div id="url_txt"><span id="url_start"></span><span id="url_middle"><?=(isset($item['tenkhongdau']))?$item['tenkhongdau']:'ten-bai-viet'?></span><span id="url_middle_input"><input type="text" value="<?=@$item['tenkhongdau']?>"  name ="link_url"   placeholder="dinh-dang-ten-khong-dau"  /></span><span id="url_end" ></span><span class="msgtenkhongdau"><?php if(!checkRegexTenKhongDau($item['tenkhongdau'])) { echo '<b class="txt_bad">Error! Bạn phải nhập tên không dấu, không có dấu cách và nối các từ bằng dấu '-'</b>'; } ?></span></div>
        	<div class="w-bt">
        		<span class="btn btn-info" id="fixUrl"  onclick="fixUrl()">Chỉnh sửa</span>
            	<span class="btn btn-info d-none" id="okUrl" onclick="okUrl()">Hoàn tất</span>
            	<?php if(isset($item)){ ?>
	            	<a href="<?=$web.$com.'/'.$item['tenkhongdau'].$duoi ?>" target="_blank" class="btn btn-primary" >Xem</a>
	            <?php } ?>
        	</div>
        </div>
        <div class="clear"></div>
    </div>
<?php } ?>
	<div class="formRow">
        <label>Title</label>
        <div class="formRight mr-5 d-flex justify-space-between align-item-center">
            <input type="text" value="<?=@$item['title']?>" id="title" name="title" placeholder="Nội dung thẻ meta Title dùng để SEO" class="tipS" style="padding-right: 100px;" /><input readonly="readonly" type="text" style="width:90px !important; text-align:center;" name="des_char_tt" id="des_char_tt" value="70" class="des_char_tt" /> 
        </div>
        <div class="clear"></div>
    </div>
    <div class="formRow <?= (!$config_s['h2'])?'none':'' ?>">
        <label>H2</label>
        <div class="formRight mr-5 d-flex justify-space-between align-item-center">
            <input type="text" value="<?=@$item['h2']?>" id="h2" name="h2" placeholder="SEO - Tên công ty" class="tipS" style="padding-right: 100px;" />
        </div>
        <div class="clear"></div>
    </div>
    <div class="formRow"> 
        <label>Từ khóa</label>
        <div class="formRight">
            <input type="text" value="<?=@$item['keywords']?>" name="keywords" placeholder="Từ khóa chính cho bài viết" class="tipS" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="formRow">
        <label>Description:</label>
		<div class="formRight">
			<input type="text" value="<?=@$item['description']?>" id="description" name="description" placeholder="Nội dung thẻ meta Description dùng để SEO" class="tipS danhgia_description" style="padding-right: 100px;margin-bottom: 10px;" /><input readonly="readonly" type="text" style="width:90px !important; text-align:center;" name="des_char" id="des_char" value="156" class="des_char_tt" /> 
            <div class="strength">
            	<span class="week"></span>
            	<span class="medium"></span>
            	<span class="good"></span>
            	<span class="bad"></span>
            </div>
            <p class="strength_txt"></p>
            <?php /* ?><textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS description_input danhgia_description" name="description" id="description"><?=@$item['description']?></textarea>
            <input readonly="readonly" type="text" style="width:45px !important; margin-top:10px; text-align:center;" name="des_char" id="des_char" value="156" /> <b>ký tự (Tốt nhất là khoảng 120 - 156 ký tự)</b><?php */ ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="formRow">
        <label>Demo trên Google:</label>
        <div class="formRight">
           
            <div class="clear"></div>
        	<?php include "templates/googleresult.php";  ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<script>
	$(document).ready(function(){
		$('.modal .modal-close').click(function () {
			$('.modal').removeClass('active');
		});
		$('.modal .modal-bg').click(function () {
			$('.modal').removeClass('active');
		});
        <?php if(isset($item)){ ?>  
            checkTenKhongDau('<?=$item["tenkhongdau"]?>');
        <?php } ?>
	});
	function viewModal(id){
		if(!$('#'+id).hasClass('active')){
			$('#'+id).addClass('active');
		}
	} <?php  ?>
</script>