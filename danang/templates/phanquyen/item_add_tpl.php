<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	   <li><a href="index.php?com=phanquyen&act=man"><span>Phân quyền</span></a></li>
               <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=phanquyen&act=save" method="post" enctype="multipart/form-data">
	<div id="div_fixed">
		<button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
		<a href="index.php?com=phanquyen&act=man<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning" original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
	</div>

	<div class="widget mt-10">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		
		<ul class="tabs">
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
       </ul>

       <!-- begin: info -->
       <div id="info" class="tab_content">
	        <div class="formRow">
				<label>Tên</label>
				<div class="formRight">
	                <input type="text" name="ten" title="Nhập ten" id="ten" class="tipS" value="<?=@$item['ten']?>" />
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
	        <div class="formRow">
	            <label>Số thứ tự: </label>
	            <div class="formRight">
	                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:35px !important; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
	            </div>
	            <div class="clear"></div>
	        </div>
       </div>
        <!-- end: info -->

		
	</div>
	<div class="w_submit">
		<div class="formRight">
            <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
        	<button type="button" class="btn btn-info" onclick="TreeFilterChanged2(); return false;"><i class="fa fa-check-circle"></i>&nbsp;Cập nhật</button>
        	
        	<a href="index.php?com=phanquyen&act=man<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="btn btn-warning"  original-title="Thoát"><i class="fa fa-warning"></i>&nbsp;Thoát</a>
		</div>
		<div class="clear"></div>
	</div>
</form>


<script type="text/javascript">
	$(document).ready(function(e) {
        $('.tr_pquyen label input[name="all"]').click(function(){
			if($(this).is(':checked')){
				$(this).parents('.tr_pquyen').find('input[type="checkbox"]').prop('checked', true);
				$(this).parents('.tr_pquyen').find('.checker span').addClass('checked');
			}
			else
			{
				$(this).parents('.tr_pquyen').find('input[type="checkbox"]').prop('checked', false);
				$(this).parents('.tr_pquyen').find('.checker span').removeClass('checked');
			}
		});
		
		$('button.add-permission').click(function(){
			var root = $(this).parents('.tr_pquyen');
			var com = root.find('input[name="man"]').data('com');
			var type = root.find('input[name="man"]').data('type');
			var act_cap = root.find('input[name="man"]').data('act_cap');
			var man = '';
			
			var add = '';
			var edit = '';
			var delete2 = '';

			if(root.find('input[name="man"]').prop('checked')){
				man = root.find('input[name="man"]').data('act');
			}
			if(root.find('input[name="add"]').prop('checked')){ 
				add = root.find('input[name="add"]').data('act');
			}
			if(root.find('input[name="edit"]').prop('checked')){
				edit = root.find('input[name="edit"]').data('act');
			}
			if(root.find('input[name="delete"]').prop('checked')){
				delete2 = root.find('input[name="delete"]').data('act');
			}
			$.ajax({
				url:'ajax_phanquyen.php',
				type:'post',
				dataType:'json',
				data:{id:'<?=$_GET['id']?>',com:com,type:type,man:man,add:add,edit:edit,delete2:delete2,act_cap:act_cap},
				success:function(kq){
					if(kq.thongbao==1)
					{
						alert('Xác nhận thành công');
					}
				}
			});
		});
    });
</script>
<div id="permission-draw"><div class="widget" style="margin-top: 20px;">
	  <div class="mytable">
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable phanquyen" id="checkAll">
		<tr>
        	<th class="tb_data_small" style="width:30px;">STT</th>
			<th class="title_name_data">Chức năng quản trị</th>
			<th class="tb_data_small">Xem</th>
			<th class="tb_data_small">Thêm</th> 
			<th class="tb_data_small">Sửa</th>
			<th class="tb_data_small">Xóa</th>
            <th class="tb_data_small">Tất cả</th>
			<th class="tb_data_small" style="width:110px;">Xác nhận</th>
		</tr>
        <?php $item_com=$pqmenu->showMenu(); 
        for($i = 0; $i < count($item_com); $i++) { ?>
        <?php
			if($item_com[$i]['act']!='man' and $item_com[$i]['act']!='capnhat'){
				$data_act_man = $item_com[$i]['act'];
				$data_act_add = str_replace("man","add",$item_com[$i]['act']);
				$data_act_edit = str_replace("man","edit",$item_com[$i]['act']);
				$data_act_delete = str_replace("man","delete",$item_com[$i]['act']);
				$act_cap = str_replace("man","man",$item_com[$i]['act']);
			}
			else if($item_com[$i]['act']=='capnhat' && $item_com[$i]['com']=='about'){
				$data_act_man = 'capnhat';
				$data_act_add = '';
				$data_act_edit = 'edit';
				$data_act_delete = '';
				$act_cap = '';
			}else if($item_com[$i]['act']=='capnhat' && ($item_com[$i]['com']=='background' || $item_com[$i]['com']=='anhnen'))
			{
				$data_act_man = 'capnhat';
				$data_act_add = '';
				$data_act_edit = 'edit';
				$data_act_delete = '';
				$act_cap = '';
			}
			else if($item_com[$i]['act']=='capnhat' && $item_com[$i]['com']=='company')
			{
				$data_act_man = 'capnhat';
				$data_act_add = '';
				$data_act_edit = 'edit';
				$data_act_delete = '';
				$act_cap = '';
			}
			else
			{
				$data_act_man = $item_com[$i]['act'];
				$data_act_add = str_replace("man","add",$item_com[$i]['act']);
				$data_act_edit = str_replace("man","edit",$item_com[$i]['act']);
				$data_act_delete = str_replace("man","delete",$item_com[$i]['act']);
				$act_cap = '';
			}
			$d->reset();
			$sql = "select act from #_com_quyen where id_quyen='".$_GET['id']."' and com='".$item_com[$i]['com']."' and act_cap='".$act_cap."' and type='".$item_com[$i]['type']."' limit 0,1";
			$d->query($sql);
			$check_quyen = $d->fetch_array();

		?>
        <tr class="tr_pquyen">
        	<td style="text-align:center;"><?=$i+1?></td>
            <td class="title_name_data"><b><?=$item_com[$i]['title']?></b> - <?=$item_com[$i]['ten']?></td>

            <td><label><input name="man" type="checkbox" data-act="<?=$data_act_man?>" data-com="<?=$item_com[$i]['com']?>" data-type="<?=$item_com[$i]['type']?>" data-act_cap="<?=$act_cap?>" <?php if(in_array($data_act_man, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>
			
            <td><label><input <?php if(empty($data_act_add)){echo 'style="display:none"';} ?> name="add" type="checkbox" data-act="<?=$data_act_add?>" <?php if(in_array($data_act_add, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>

            <td><label><input name="edit" <?php if(empty($data_act_edit)){echo 'style="display:none"';} ?> type="checkbox"  data-act="<?=$data_act_edit?>" <?php if(in_array($data_act_edit, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>

            <td><label><input name="delete" <?php if(empty($data_act_delete)){echo 'style="display:none"';} ?> type="checkbox"  data-act="<?=$data_act_delete?>"<?php if(in_array($data_act_delete, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>

            <td><label><input name="all" type="checkbox"></label></td>
            <td style="text-align:center;"><button class=" btn btn-info add-permission"><i class="glyphicon glyphicon-upload"></i>Xác nhận</button></td>
         </tr>  
        <?php } ?>  
	</table>
</div>
</div>
<style>
#table-per input[type=checkbox]{
	position: relative; 
	top: 3px;
	margin-right: 10px;
}
</style>
</div>
