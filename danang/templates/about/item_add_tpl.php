<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});
</script> 
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=about&act=capnhat&type=<?=$_REQUEST['type']?>"><span>Nội dung</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Cập nhật</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=about&act=save&type=<?=$_REQUEST['type']?>" method="post" enctype="multipart/form-data">

	<div id="div_fixed">
	  <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
	  <?php if($config_s['url']){ ?><a href="<?=$config_s['link_url']?>" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i>&nbsp;Xem</a><?php } ?>
	</div>

	<div class="widget mt-10">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>
        
        <ul class="tabs">
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>
       </ul>        
        <!-- End info -->
      <?php foreach ($config['lang'] as $key => $value) { ?>
       <div id="content_lang_<?=$key?>" class="tab_content ">
			<div class="myrow">

				<div class="<?php if ($key=="") { if($config_s['hinhanh']) { echo "mycol-6 mycol-table-6"; }else{ echo "mycol-12 mycol-table-8"; } }else{echo "mycol-12 mycol-table-8";}?> mycol-mobi-12" >
					<div class="formRow <?= (!$config_s['ten'])?'none':'' ?>">
						<label>Tiêu đề</label>
						<div class="formRight">
							<input type="text" class="" name="ten<?=$key?>" title="Nhập tên sản phẩm" id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
						</div>
						<div class="clear"></div>
					</div>  

					<div class="formRow  <?= (!$config_s['mota'])?'none':'' ?>">
						<label>Mô tả ngắn:</label>
						<div class="formRight">
							<textarea  rows="8" cols="" title="Viết mô tả ngắn bài viết" class="tipS <?php if($config_s['hinhanh']) echo "big_textarea"; ?>" name="mota<?=$key?>" id="mota<?=$key?>"><?=@$item['mota'.$key]?></textarea>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<?php if($key==""){?>
				<div class="mycol-6 mycol-table-6 mycol-mobi-12">
					<div class="formRow <?= (!$config_s['hinhanh'])?'none':'' ?>">
						<div class="photoUpload-zone">
							<label><b>Hình ảnh đại diện: </b></label>
							<div class="photoUpload-dimension"><?=$config_s['size_anh']?>  <?=_format_duoihinh_l?></div>
							<label class="photoUpload-file" id="photo-zone" for="file-zone" style="border: none; background:none;padding: 0px; display: inherit;">
								<input type="file" name="file" id="file-zone">
								<!--<i class="fa fa-cloud-upload"></i>
								<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
								<p class="photoUpload-or">hoặc</p>-->
								<div class="photoUpload-choose btn btn-info">+ Tải ảnh đại diện lên</div>
							</label>
							<div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="<?=_upload_hinhanh.$item['photo']?>" onerror="src='images/noimage.png'" alt="Alt Photo"/><div class="none">Hình hiện tại</div>
								<?php

								$file_size = filesize($_SERVER['DOCUMENT_ROOT']."/"._upload_hinhanh_l.$item['photo']); // Get file size in bytes
								$file_size = $file_size/1000; // Get file size in KB
								?>
								<div class="detailImages">

									<div class="size">
										<i class="icon-jfi-file-image jfi-file-ext-png"></i> <span><?=round($file_size,2)."Kb";?></span>
									</div>

									<div class="btn">
										<div class="removeInput" data-id="<?=$item["id"]?>" data-photo="<?=$item["photo"]?>" data-format="<?=_upload_hinhanh?>" data-table="about" data-field="photo">
											<a class="icon-jfi-trash jFiler-item-trash-action"></a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<?php }?>
			</div>
              
            <div class="formRow  <?= (!$config_s['noidung'])?'none':'' ?>">
				<label>Nội dung chính: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
				<div class="formRight"><textarea class="ck_editor" name="noidung<?=$key?>" id="noidung<?=$key?>" rows="8" cols="60"><?=@$item['noidung'.$key]?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<?php if($key==""){?>

			<div class="formRow <?=(!$config_s['link'])?'none':''?>">
				<label>Link liên kết</label>
				<div class="formRight">
					<input type="text" value="<?=@$item['link']?>" name="link" title="Link liên kết" class="tipS" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
			  <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
			  <div class="formRight">
				<input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
				<label for="check1">Hiển thị</label>           
			  </div>
			  <div class="clear"></div>
			</div>

			<?php }?>
       </div><!-- End content <?=$key?> -->      
     <?php } ?>		
	</div>
    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" /> 
    <?php if($config_s['seo']){include "templates/seo.php";}  ?>  
    <div class="w_submit">
        <div class="formRight">
            <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            <input type="hidden" name="type" id="type" value="<?=@$item['type']?>" />
            <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
        </div>
        <div class="clear"></div>
    </div>
</form>