
<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.frm.username, "Chưa nhập tên đăng nhập.")){
		document.frm.username.focus();
		return false;
	}
	<?php if($_GET['act']=='add'){?>
	if(isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu.")){
		document.frm.oldpassword.focus();
		return false;
	}
	
	if(document.frm.oldpassword.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.frm.oldpassword.focus();
		return false;
	}
	<?php } ?>
	if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
		alert('Email không hợp lệ.');
		document.frm.email.focus();
		return false;
	}
	if(document.frm.username.value==0){
		alert('Chưa chọn nhóm thành viên.');
		document.frm.email.focus();
		return false;
	}
}
</script>
<?php
	
	$d->reset();
	$sql="select ten, id from #_phanquyen";
	$d->query($sql);
	$_phanquyen=$d->result_array();
	
?>



<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=user&act=man"><span>Danh sách thành viên</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>



<form name="frm"  class="form"  method="post" action="index.php?com=user&act=save" enctype="multipart/form-data" class="nhaplieu" onSubmit="return js_submit();">
<div class="widget">
	<div class="formRow">
		<label>Tên đăng nhập :</label>
		<div class="formRight">
        	<input type="text" name="username" id="username" value="<?=$item['username']?>" class="input"   />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Email :</label>
		<div class="formRight">
        	<input type="text" name="email" id="email" value="<?=$item['email']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Mật khẩu :</label>
		<div class="formRight">
        	<input type="password" name="oldpassword" id="oldpassword" value="" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nhóm thành viên :</label>
		<div class="formRight">
        	<select name="role"  class="main_select select_danhmuc" >
				<option value="0">Chọn nhóm thành viên</option>
				<?php foreach($_phanquyen as $v){?>
				<option value="<?=$v["id"]?>" <?php if($item["role"]==$v["id"]) echo "selected";?> ><?=$v["ten"]?></option>
				<?php }?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Họ tên :</label>
		<div class="formRight">
        	<input type="text" name="ten" id="ten" value="<?=$item['ten']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Điện thoại :</label>
		<div class="formRight">
        	<input type="text" name="dienthoai" value="<?=$item['dienthoai']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Địa chỉ :</label>
		<div class="formRight">
        	<input type="text" name="diachi" id="diachi" value="<?=$item['diachi']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Số thứ tự :</label>
		<div class="formRight">
        	<input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px">
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow none">
		<label>Hiển thị :</label>
		<div class="formRight">
        	<input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div>
    <div class="formRow">
		<label>active :</label>
		<div class="formRight">
        	<input type="checkbox" name="active" <?=(!isset($item['active']) || $item['active']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div>   	
	
</div>
<div class="w_submit">
<label></label>
<div class="formRight">
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu"  class="btn btn-info" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=user&act=man'" class="btn btn-warning" />
</div>
<div class="clear"></div>
</div>
</form>
