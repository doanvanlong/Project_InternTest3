<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
          <li><a href="javascript:void(0)"><span>Hình ảnh</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Sửa hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=background&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
<div id="div_fixed">
  <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
</div>
	<div class="widget mt-10">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa hình ảnh</h6>
		</div>		
    <?php if($_REQUEST['type']!='banner') $config['lang'] = array(''=>'Thông tin chung'); ?>
      <ul class="tabs">
      	<?php foreach ($config['lang'] as $key => $value) { ?>
         		<li><a href="#content_lang_<?=$key?>"><?=$value?></a></li>
         <?php } ?>
      </ul>

		<?php foreach ($config['lang'] as $key => $value) {?>

        <div id="content_lang_<?=$key?>" class="tab_content">	

          <div class="myrow">
            <div class="mycol-6 mycol-table-6 mycol-mobi-12">
                <div class="formRow">
                    <label>Hình ảnh đại diện:</label>
                    <div class="formRight">
                      <div class="photoUpload-zone">
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
                              <div class="removeInput" data-id="<?=$item["id"]?>" data-photo="<?=$item["photo"]?>" data-format="<?=_upload_hinhanh?>" data-table="background" data-field="photo"><a class="icon-jfi-trash jFiler-item-trash-action"></a></div>
                            </div>

                          </div>

                        </div><!--photoUpload-detail-->

                    </div><!--photoUpload-zone-->
                    <div class="clear"></div>
                  </div>
                  
            </div>
          </div>
          </div>

            </div><!-- End content <?=$key?> -->
            <?php } ?>
        
        <div class="formRow <?=(!$config_s['type'])?'none':''?>">
            <label>Type: </label>
            <div class="formRight">
                <input type="text" id="type" name="link" value="<?=@$item['type']?>"  title="Nhập type cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow <?=(!$config_s['link'])?'none':''?>">
            <label>Link liên kết: </label>
            <div class="formRight">
              <div class="myrow">
                <div class="mycol-4 mycol-table-6 mycol-mobi-12">
                  <input type="text" id="price" name="link" value="<?=@$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS " />
                </div>
              </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
              <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
              <div class="formRight">           
                <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                <label for="check1">Hiển thị</label>           
              </div>
              <div class="clear"></div>
        </div>
	</div>
   <div class="w_submit">
        <div class="formRight">
        <input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
            <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
        </div>
        <div class="clear"></div>
    </div>  
</form>   

<script type="text/javascript">
    $(document).ready(function(e) {
        <?php foreach ($config['lang'] as $key => $value) {?>
            photoZone("#photo-zone<?=$key?>","#file-zone<?=$key?>","#photoUpload-preview<?=$key?> img");
        <?php } ?>
    });
</script>
