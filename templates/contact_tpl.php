<div class="row">
	
	<div class="col-12 col-md-6 mb-30">
		<?php if($seoh2 != ''){ ?><h2 class="d-none"><?=$seoh2?></h2><?php } ?>
		<div class="content">
			<?=$company_contact['noidung'] ?>
		</div>
		<form action="lien-he.html" method="post" name="frm_contact" id="frm_contact" class="pt-2">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<input class="form-control" type="text" id="ten_contact" name="ten_contact" value="" placeholder="<?=_hovaten?>*" />
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<input class="form-control" type="email" id="email_contact" name="email_contact" value="" placeholder="Email*" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<input class="form-control" type="text" id="dienthoai_contact" name="dienthoai_contact" value="" placeholder="<?=_dienthoai?>*" />
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<input class="form-control" type="text" id="diachi_contact" name="diachi_contact" value="" placeholder="<?=_diachi?>*" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<textarea name="noidung_contact" id="noidung_contact" rows="3" class="form-control" placeholder="<?=_noidung?>*" ></textarea>
					</div>
				</div>
					
			</div>
			<div class="row">
				<div class="col-12 col-lg-8">
					<div class="form-group">
						<div class="g-recaptcha" data-sitekey="<?=$config['sitekey']?>"></div>
						<small class="text-danger error_captcha"></small>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="form-group">
						<input class="mybtn btn-do" type="submit" name="submit_contact" value="<?=_guilienhe?>" onclick="return sb_contact()" /> 
					</div>
				</div>
			</div>
			<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
		</form>
	</div>
	
	<div class="col-12 col-md-6  mb-30">
		<div class="x_map"><?=$company['link_googlemap']?></div>
	</div>
</div>


