<?php 

	$d->reset();
	$sql="select id,ten$lang as ten,mota$lang as mota,photo from #_about where type='text-form-dang-ky'";
	$d->query($sql);
	$bg = $d->fetch_array();


	$d->reset();
	$sql="select id,ten$lang as ten from #_product where hienthi=1 and type='san-pham' order by stt,id desc";
	$d->query($sql);
	$sanpham_dangky = $d->result_array();


?>


<div class="w_dichvu bg_container" id="theoyeucauindex" >
<div class="container wow fadeInUp" data-wow-duration="1s">
	<div class="tieude_gc"><span><?=$bg['ten']?></span></div>
	<div class="content text-center  mb-30"><?=$bg['mota']?></div>
<form action="" method="post" name="frm_dangky" id="frm_dangky" >
	<div class="row"> 
		<div class="col-12 col-md-4">
			<div class="form-group">
				<input class="form-control" type="text" id="ten_dangky" name="ten_dangky" value="" placeholder="<?=_hovaten?>*" />
			</div>
		</div>
		
		<div class="col-12 col-md-4">
			<div class="form-group">
				<input class="form-control" type="text" id="dienthoai_dangky" name="dienthoai_dangky" value="" placeholder="<?=_dienthoai?>*" />
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<input class="form-control" type="text" id="email_dangky" name="email_dangky" value="" placeholder="Email*" />
			</div>
		</div>
		
		<div class="col-12 col-md-4">
			<div class="form-group">
				<input class="form-control" type="diachi" id="diachi_dangky" name="diachi_dangky" value="" placeholder="Địa chỉ*" />
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<select name="sanpham_dangky" class="form-control" id="sanpham_dangky">
					<option value="">Chọn sản phẩm</option>
					<?php foreach($sanpham_dangky as $val){ ?>
					<option value="<?=$val['ten']?>" data-id="<?=$val['id']?>"><?=$val['ten']?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
		<div class="col-12 col-md-4">
			<div class="form-group">
				<input class="form-control" type="number" id="soluong_dangky" name="soluong_dangky" value="" placeholder="Số lượng *" min="1" />
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<textarea name="noidung_dangky" id="noidung_dangky" rows="3" class="form-control" placeholder="<?=_noidung?>*" ></textarea>
			</div>
		</div>
		<div class="col-12">
			<div class="form-group text-center">
				<input class="mybtn btn-do" type="submit" name="submit_dangky" value="Gửi yêu cầu" onclick="return sb_dangky()" />
			</div>
		</div>
	</div>
</form>
</div>
</div>