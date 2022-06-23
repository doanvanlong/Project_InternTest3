
<?php	
	function get_main_danhmuc()
	{
		$sql_huyen="select * from table_product_danhmuc where type='".$_REQUEST['type']."' order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" data-placeholder="Chọn danh mục" class="main_select select_danhmuc chzn-select">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row_huyen["id"].'" '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_list<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

<div id="div_fixed">
  <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Hoàn tất</button>
  <a href="index.php?com=product&act=man_list<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
</div>

   <div class="widget mt-10">
     <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
          <h6>Nhập dữ liệu</h6>
      </div>
       <ul class="tabs">
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>
       </ul>
<div class="clear"></div>
       <div id="info" class="tab_content">
          
		
         
    <div class="myrow">
      <div class="mycol-6 mycol-table-6 mycol-mobi-12">
        <div class="formRow <?= (!$config_s['danhmuc'])?'none':'' ?>">
          <label>Chọn danh mục 1</label>
          <div class="formRight">
          <?=get_main_danhmuc()?>
          </div>
          <div class="clear"></div>
        </div>
      <div class="formRow <?= (!$config_s['hinhanh'])?'none':'' ?>">
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
            <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="<?=_upload_sanpham.$item['photo']?>" onerror="src='images/noimage.png'" alt="Alt Photo"/><div class="none">Hình hiện tại</div>
              <?php
              $file_size = filesize($_SERVER['DOCUMENT_ROOT']."/"._upload_sanpham_l.$item['photo']); // Get file size in bytes
              $file_size = $file_size / 1000; // Get file size in KB
              ?>
              <div class="detailImages">
                <div class="size">
                  <i class="icon-jfi-file-image jfi-file-ext-png"></i> <span><?=round($file_size,2)."Kb";?></span>
                </div>
                <div class="btn">
                  <div class="removeInput" data-id="<?=$item["id"]?>" data-photo="<?=$item["photo"]?>" data-format="<?=_upload_sanpham?>" data-table="product_list" data-field="photo"><a class="icon-jfi-trash jFiler-item-trash-action"></a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      </div>
    </div>

    <div class="formRow">
      <label>Nổi bật  : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

      <div class="formRight">
        <input type="checkbox" name="noibat" id="check1" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?> />
        </div>
		  <div class="clear"></div>
    </div>
          
    <div class="formRow">
      <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
      <div class="formRight">
        <input type="checkbox" name="hienthi" id="check2" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
        <label>Số thứ tự: </label>
        <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:35px !important; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="Số thứ tự của danh mục, chỉ nhập số">
      </div>
      <div class="clear"></div>
    </div>



       </div>
       <!-- End info -->
        <?php foreach ($config['lang'] as $key => $value) {
        ?>

       <div id="content_lang_<?=$key?>" class="tab_content">        
            <div class="formRow <?= (!$config_s['ten'])?'none':'' ?>">
            <label>Tên bài viết</label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?>" title="Nhập tên bài viết" id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
                <p class="msgname<?=$key?>" style="color:#FF8000"></p>
            </div>
            <div class="clear"></div>
        </div>  

         <div class="formRow <?= (!$config_s['mota'])?'none':'' ?>">
            <label>Mô tả:</label>
            <div class="formRight">
                <textarea  rows="8" cols="" title="Viết giới thiệu" class="tipS" name="mota<?=$key?>" id="mota<?=$key?>" placeholder="Bạn bắt buộc phải nhập phần mô tả này để SEO tốt hơn"><?=@$item['mota'.$key]?></textarea>
                <input readonly="readonly" type="text" style="width:45px; margin-top:10px; text-align:center;" name="des_char2<?=$key?>" id="des_char2<?=$key?>" value="300" /> <b>ký tự (Tốt nhất là 250 - 300 ký tự)</b><b style="color:#b80000"> - Chú ý : Bạn phải nhập phần Mô tả để có kết quả SEO tốt nhất trên Google </b>
            </div>
            <div class="clear"></div>
        </div>  
        <div class="formRow <?= (!$config_s['noidung'])?'none':'' ?>">
            <label>Nội dung: </label>
            <div class="formRight"><textarea class="ck_editor" name="noidung<?=$key?>" id="noidung<?=$key?>" rows="8" cols="60"><?=@$item['noidung'.$key]?></textarea>
            </div>
            <div class="clear"></div>
        </div> 

        
       </div><!-- End content <?=$key?> -->
      
     <?php } ?>
 

    </div>
<?php include "templates/seo.php";?> 
<div class="w_submit">
  <div class="formRight">
    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
      <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
      <button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Hoàn tất</button>
       <a href="index.php?com=product&act=man_list<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
  </div>
  <div class="clear"></div>
</div>
</form>   
<script type="text/javascript">
$(document).ready(function() {
  <?php foreach ($config['lang'] as $key => $value) { ?>
      $('#ten<?=$key?>').change(function(){
        var id = <?=isset($item)?$item['id']:0?>;
        var ten = $(this).val();
        var lang = '<?=($key != '')?$key:'vi'?>';
        var table = 'product_list';
        $.ajax({
          type: "POST",
          url: "ajax/xuly_admin_dn.php",
          data: {id:id,ten:ten,lang:lang,table:table, act: 'checkName'},
          success:function(data){
            $('.msgname<?=$key?>').html(data); 
          }
        })
      });
    <?php }?>
 });
</script>