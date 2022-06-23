<link href="css/jquery-ui-1.10.3/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
<script src="js/multiSelect/multiselect.js"></script>
<link href="css/multiSelect/multiselect.css" rel="stylesheet" type="text/css" />
<script>
	$(function() {		
		$("#color,#size").multiselect();	 	
	});

</script>
<script type="text/javascript">
	$(document).ready(function(e) {
		load_cat();
		load_loai();
        $('#id_danhmuc').change(function(e) {
            var q=$(this).val();
			$.ajax({
				type:"POST",
				url:"ajax/loaddm.php",
				data:{id:q,table:'product',act:'list'},
				success: function(data){
					$('.load_list').html(data);
					$("#id_list").chosen();
					loadloai('load_cat','id_cat');
					loadloai('load_loai','id_item');
					load_cat();
				}
			})
        });
    });
function load_cat(){
 $('#id_list').change(function(e) {
            var q=$(this).val();
			$.ajax({
				type:"POST",
				url:"ajax/loaddm.php",
				data:{id:q,table:'product',act:'cat'},
				success: function(data){
					$('.load_cat').html(data);
					$("#id_cat").chosen();
					loadloai('load_loai','id_item');
					load_loai();
				}
			})
     });
}

function load_loai(){
 $('#id_cat').change(function(e) {
            var q=$(this).val();
			$.ajax({
				type:"POST",
				url:"ajax/loaddm.php",
				data:{id:q,table:'product',act:'item'},
				success: function(data){
					$('.load_loai').html(data);
					$("#id_item").chosen();
				}
			})
     });
}

</script>
<?php
function get_main_danhmuc()
	{
		$sql="select * from table_product_danhmuc where type='".$_REQUEST['type']."' order by stt";
		
		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" data-placeholder="Chọn danh mục" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 1</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row["id"].'" '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

function get_main_list()
	{
		$sql="select * from table_product_list where id_danhmuc=".$_REQUEST['id_danhmuc']."  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" data-placeholder="Chọn danh mục" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 2</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
 			else 
				$selected="";
			$str.='<option value="'.$row["id"].'" '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_main_category()
	{
		$sql="select * from table_product_cat where id_list=".$_REQUEST['id_list']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" data-placeholder="Chọn danh mục" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 3</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row["id"].'" '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	
function get_main_item()
	{
		$sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" data-placeholder="Chọn danh mục" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 4</option>			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row_huyen["id"].'" '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
function get_mausac($id=0)
{
	global $d;
	if($id){
	$sql="select * from #_product_color_condition where id_product=$id";
	$d->query($sql);
	$color = $d->result_array();
	
	for($i=0;$i<count($color);$i++){
		$temp[$i]=$color[$i]['id_color'];	
		}
	}
	$d->reset();
	$sql="select * from #_product_color order by stt asc,id desc";
	$d->query($sql);
	$row = $d->result_array();
	
	$str='<select class="danhmuc" id="color" name="color[]" multiple="multiple">';
	for($i=0;$i<count($row);$i++)
	{
		if($temp){	
			if(in_array($row[$i]['id'],$temp)){ $check = 'selected="selected"';}else{$check='';}
		}
		$str.='<option value="'.$row[$i]["id"].'" '.$check.' />Màu '.$row[$i]["ten"].'</option>';			
	}
	$str .='</select>';
	return $str;
}
function get_kichco($id=0)
{
	global $d;
	if($id){
	$sql="select * from #_product_size_condition where id_product=$id";
	$d->query($sql);
	$color = $d->result_array();
	
	for($i=0;$i<count($color);$i++){
		$temp[$i]=$color[$i]['id_size'];	
		}
	}
	$d->reset();
	$sql="select * from #_product_size order by stt asc,id desc";
	$d->query($sql);
	$row = $d->result_array();
	
	$str='<select class="danhmuc" id="size" name="size[]" multiple="multiple">';
	for($i=0;$i<count($row);$i++)
	{
		if($temp){	
			if(in_array($row[$i]['id'],$temp)){ $check = 'selected="selected"';}else{$check='';}
		}
		$str.='<option value="'.$row[$i]["id"].'" '.$check.' />Size '.$row[$i]["ten"].'</option>';			
	}
	$str .='</select>';
	return $str;
}
function get_thuonghieu()
	{
		$sql="select * from table_product_danhmuc where type='thuonghieu' order by stt";
		
		$stmt=mysql_query($sql);
		$str='
			<select id="id_thuonghieu" name="id_thuonghieu" data-placeholder="Chọn thương hiệu" class="main_select select_danhmuc chzn-select">
			<option value="0">Chọn thương hiệu</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_thuonghieu"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	$d->reset();
	$sql_images="select * from #_hinhanh where id_hinhanh='".$item['id']."' and type='".$_GET['type']."' order by stt, id desc ";
	$d->query($sql_images);
	$ds_photo=$d->result_array();
?> 
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Sản phẩm</span></a></li>
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
   
<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save&p=<?=$_REQUEST['p']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div id="div_fixed">
		<button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Hoàn tất</button>
        <a href="index.php?com=product&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
	</div>

     <div class="widget mt-10">
         <div class="title">
         	<img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
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
			<div class="mycol-5 mycol-table-6 mycol-mobi-12">
				<div class="formRow <?= (!$config_s['danhmuc'])?'none':'' ?>">
					<label>Chọn danh mục 1</label>
					<div class="formRight">
					<?=get_main_danhmuc()?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow <?= (!$config_s['list'])?'none':'' ?> ">
					<label>Chọn danh mục cấp 2</label>
					<div class="formRight load_list">
					<?=get_main_list()?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow <?= (!$config_s['cat'])?'none':'' ?>">
					<label>Chọn danh mục cấp 3</label>
					<div class="formRight load_cat">
					<?=get_main_category()?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow none">
					<label>Chọn danh mục cấp 4</label>
					<div class="formRight load_loai">
					<?=get_main_item()?>
					</div>
					<div class="clear"></div>
				</div>
				 <div class="formRow none">
					<label>Chọn thương hiệu</label>
					<div class="formRight">
					<?=get_thuonghieu()?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow none">
					<label>Chọn màu sắc</label>
					<div class="formRight">
					<?=get_mausac(@$item['id']);?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow none">
					<label>Chọn size</label>
					<div class="formRight">
					<?=get_kichco(@$item['id']);?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow ">
					<label>Mã sản phẩm:</label>
					<div class="formRight">
						<input type="text" id="code_pro" name="masp" value="<?=@$item['masp']?>"  title="Nhập mã sản phẩm" class="tipS " />
					</div>
					<div class="clear"></div>
				</div>
				 <div class="formRow <?= (!$config_s['gia'])?'none':'' ?>">
					<label>Giá : </label>
					<div class="formRight">
						<input type="text" id="price" name="gia" value="<?=@$item['gia']?>"  title="Nhập giá sản phẩm" class="tipS conso " onkeypress="return OnlyNumber(event)" />
					</div>
					<div class="clear"></div>
				</div>
				 <div class="formRow <?= (!$config_s['giakm'])?'none':'' ?>">
					<label>Giá khuyến mãi: </label>
					<div class="formRight">
						<input type="text" id="price2" name="giakm" value="<?=@$item['giakm']?>"  title="Nhập giá khuyến mãi sản phẩm" class="tipS conso " onkeypress="return OnlyNumber(event)" />
					</div>
					<div class="clear"></div>
				</div> 
				<div class="formRow none">
		            <label>Thẻ tag:</label>
		            <div class="formRight">
		             <input type="text" id="tags" value="<?=@$item['tag']?>" name="tag" title="Nhập tag" class="tipS" />
		                <b>(Enter kết thúc mỗi thẻ tag)</b>
		            </div>
		            <div class="clear"></div>
		        </div>
		      
		        <div class="formRow ">
		          <label>Nổi bật : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

		        <div class="formRight">
		            <input type="checkbox" name="noibat" id="check1" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?> />
		            </div>
					<div class="clear"></div>
		          </div>
		        <div class="formRow <?= (!$config_s['moi'])?'none':'' ?>">
		          <label>Mới : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

		         <div class="formRight">
		            <input type="checkbox" name="spmoi" id="check2" <?=(!isset($item['spmoi']) || $item['spmoi']==1)?'checked="checked"':''?> />
		            </div>
					<div class="clear"></div>
		          </div>
		          <div class="formRow <?= (!$config_s['banchay'])?'none':'' ?>">
		          <label>Bán chạy : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

		         <div class="formRight">
		            <input type="checkbox" name="spbanchay" id="check3" <?=(isset($item['spbanchay']) && $item['spbanchay']==1)?'checked="checked"':''?> />
		            </div>
					<div class="clear"></div>
		         </div>
		         <div class="formRow <?= (!$config_s['khuyenmai'])?'none':'' ?>">
		          <label>Khuyến mãi : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

		         <div class="formRight">
		            <input type="checkbox" name="tieubieu" id="check4" <?=(!isset($item['tieubieu']) || $item['tieubieu']==1)?'checked="checked"':''?> />
		            </div>
					<div class="clear"></div>
		         </div> 
		          
		        <div class="formRow">
		          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
		          <div class="formRight">
		         
		            <input type="checkbox" name="hienthi" id="check5" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
		             <label>Số thứ tự: </label>
		              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:35px !important; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="Số thứ tự của danh mục, chỉ nhập số">
		          </div>
		          <div class="clear"></div>
		        </div>
			</div>
			<div class="mycol-7 mycol-table-6 mycol-mobi-12"> 
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
									<div class="removeInput" data-id="<?=$item["id"]?>" data-photo="<?=$item["photo"]?>" data-format="<?=_upload_sanpham?>" data-table="product" data-field="photo"><a class="icon-jfi-trash jFiler-item-trash-action"></a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow <?= (!$config_s['hinhthem'])?'none':'' ?>">
					<div class="myrow">
						<div class="mycol-12 mycol-table-12 mycol-mobi-12">
							<label><b>Hình ảnh kèm theo:</b> </label>
							<p></p>
						</div>
						<div class="mycol-12 mycol-table-12 mycol-mobi-12">
							<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="fa fa-paperclip"></i> Thêm ảnh kèm theo</a>
							<?php if($act=='edit'){?>
							<div class="mt-10 scrollX">
								<div style="display: inline-flex;">
							<?php if(count($ds_photo)!=0){?>       
								<?php for($i=0;$i<count($ds_photo);$i++){?>
								<div class="item_trich trich<?=$ds_photo[$i]['id']?>" id="<?=md5($ds_photo[$i]['id'])?>">
								<img class="img_trich" src="<?=_upload_hinhthem.$ds_photo[$i]['photo']?>" />
								<input data-val0="<?=$ds_photo[$i]['id']?>" data-val2="table_hinhanh" data-val3="stt"  type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
								<a style="cursor:pointer" class="remove_images" data-id="<?=$ds_photo[$i]['id']?>"><i class="fa fa-trash-o"></i></a>
								</div>
								<?php }?>
							<?php }?>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
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
        <div class="formRow <?= (!$config_s['chitiet'])?'none':'' ?>">
            <label>Chi tiết : <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung Quy cách"> </label>
            <div class="formRight"><textarea class="" name="chitiet<?=$key?>" id="chitiet<?=$key?>" rows="8" cols="60"><?=@$item['chitiet'.$key]?></textarea>
			</div>
            <div class="clear"></div>
        </div>
        <div class="formRow  <?= (!$config_s['them'])?'none':'' ?>">
            <label>Thêm : <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung Thêm"> </label>
            <div class="formRight"><textarea class="ck_editor" name="them<?=$key?>" id="them<?=$key?>" rows="8" cols="60"><?=@$item['them'.$key]?></textarea>
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
        <a href="index.php?com=product&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
    </div>
    <div class="clear"></div>
</div>
</form> 
 
<script type="text/javascript">
$(document).ready(function() {
	
		$('.remove_images').click(function(){
			var id=$(this).data("id");
			$.ajax({
				type: "POST",
				url: "ajax/xuly_admin_dn.php",
				data: {id:id, act: 'remove_image2'},
				success:function(data){
					$jdata = $.parseJSON(data);					
					$("#"+$jdata.md5).fadeOut(500);
					setTimeout(function(){
						$("#"+$jdata.md5).remove();
					}, 1000)
				}
			})
		})
	

    $('.update_stt').on('change',function(){
      var id=$(this).data("val0");
      var stt=$(this).val();
      $.ajax({
        type: "POST",
        url: "ajax/xuly_admin_dn.php",
        data: {id:id,stt:stt, act: 'change_stt'},
        success:function(data){
          
        }
      })
    });

    <?php foreach ($config['lang'] as $key => $value) { ?>
	    $('#ten<?=$key?>').change(function(){
	      var id = <?=isset($item)?$item['id']:0?>;
	      var ten = $(this).val();
	      var lang = '<?=($key != '')?$key:'vi'?>';
	      var table = 'product';
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
<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                    <input type="text" name="stthinh[]" class="stthinh mb-5p" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                    <input type="text" name="stthinh[]" class="stthinh mb-5p" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>
