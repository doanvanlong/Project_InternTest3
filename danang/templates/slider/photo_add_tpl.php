<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh</span></a></li>
              <li class="current"><a href="#" onclick="return false;">Thêm hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=slider&act=save_photo&id_slider=<?=$_REQUEST['id_slider']?>&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
<div id="div_fixed">
  <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Hoàn tất</button>
  <a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
</div>
<div class="widget mt-10">
  <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
      <h6>Thêm Hình Ảnh</h6>
  </div>
  <ul class="tabs">
     <?php foreach ($config['lang'] as $key => $value) { ?>
     <li>
         <a href="#content_lang_<?=$key?>"><?=$value?></a>
     </li>
     <?php } ?>
  </ul>
 	<div class="clear"></div>
   <!-- End info -->
	<?php foreach ($config['lang'] as $key => $value) { ?>
    <div id="content_lang_<?=$key?>" class="tab_content">
        <div class="myrow">
          <div class="<?php if ($key=="") { if($config_s['hinhanh']) { echo "mycol-6 mycol-table-6"; }else{ echo "mycol-12 mycol-table-8"; } }else{echo "mycol-12 mycol-table-8";}?> mycol-mobi-12" >
                <div class="formRow <?=(!$config_s['ten'])?'none':''?>">   
                  <label><?php if($_GET['type']=='y-kien-khach-hang'){
                      echo 'Tên khách hàng';}else{ echo 'Tên hình ảnh'; }?> :</label>
                  <div class="formRight">
                      <input type="text" name="ten<?=$key?>" title="Nhập tên hình ảnh " id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
                  </div>
                  <div class="clear"></div>
                </div>

                <div class="formRow <?=(!$config_s['mota'])?'none':''?>">   
                    <label>Mô tả :</label>
                    <div class="formRight">
                        <textarea rows="8" type="text" name="mota<?=$key?>" title="Nhập tên hình ảnh" id="mota<?=$key?>" class="tipS <?php if($config_s['hinhanh']) echo "big_textarea"; ?>" value="" /><?=@$item['mota'.$key]?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                 <?php if($key == ""){ ?>
                  <div class="formRow <?=(!$config_s['link'])?'none':''?>">
                      <label>Link liên kết:</label>
                      <div class="formRight">
                          <input type="text" id="code_pro" name="link" value="<?=@$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
                      </div>
                      <div class="clear"></div>
                  </div>
                    

                  <div class="formRow <?=(!$config_s['thoigian'])?'none':''?>">   
                    <label> Thời gian</label>
                    <div class="formRight">
                        <input type="date" name="thoigian" title="Nhập thời gian" id="thoigian" class="tipS validate[required]" value="<?=Date('Y-m-d',$item['thoigian'])?>" />
                    </div>
                    <div class="clear"></div>
                  </div>    
                  <?php if($_REQUEST['type']=='letruot') { ?> 
                  <div class="formRow">           
                      <label>Vị trí: </label>      
                      <div class="formRight">          
                          <select id="vitri" name="vitri" class="main_select">
                            <option value="left" <?php if($item['vitri']=='left') echo 'selected="selected"' ?>>Bên trái</option>     
                            <option value="right" <?php if($item['vitri']=='right') echo 'selected="selected"' ?>>Bên phải</option> 
                          </select>
                      <br />
                      </div>
                      <div class="clear"></div>
                  </div>
                  <?php } ?>
                  <div class="formRow">
                    <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
                    <div class="formRight">           
                      <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                      <label for="check1">Hiển thị</label>           
                    </div>
                    <div class="clear"></div>
                  </div>
                  
                  <div class="formRow">
                      <label>Số thứ tự: </label>
                      <div class="formRight">
                          <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:35px !important; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
                      </div>
                      <div class="clear"></div>
                  </div>
                <?php } ?>
          </div>
          <?php if($key==""){?>
              <div class="mycol-6 mycol-table-6 mycol-mobi-12">
                <div class="formRow <?= (!$config_s['hinhanh'])?'none':'' ?>">
                  <div class="photoUpload-zone">
                    <label><b>Hình ảnh đại diện:</b></label>
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
                          <div class="removeInput" data-id="<?=$item["id"]?>" data-photo="<?=$item["photo"]?>" data-format="<?=_upload_hinhanh?>" data-table="slider" data-field="photo">
                            <a class="icon-jfi-trash jFiler-item-trash-action"></a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
            <?php } ?>

        </div><!--end row-->



    </div><!-- End content <?=$key?> -->
  <?php } ?>	


		
	</div>
   <div class="w_submit">
      <div class="formRight">
        <input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
        <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
        <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Hoàn tất</button>
        
        <a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>

      </div>
      <div class="clear"></div>
    </div>
</form>   
