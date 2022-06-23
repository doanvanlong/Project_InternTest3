<div id="menufooter">
	<ul>
		<li>
			<a href="">
				<i class="fa fa-home"></i>
				<span><?=_trangchu?></span>
			</a>
		</li>
		
		<li>
			<a href="tel:<?=$company['dienthoai']?>" class="text-do blink_me">
				<i class="fa fa-phone"></i>
				<span><?=_goidien?></span>
			</a>
		</li>
		<li>
			<a href="https://zalo.me/<?=$company['zalo']?>">
				<i><img src="images/icon-zalo-black.png"></i>
				<span>Zalo</span>
			</a>
		</li>
		<li>
			<a href="<?=$company['fanpage']?>"  class="js-facebook-messenger-box">
				<i><img src="images/messengerblack.png"></i>
				<span>Facebook</span>
			</a>
		</li>
		<li>
			<a href="javascript:void(0)" class="action_menu">
				<i class="fa fa-bars"></i>
				<span>Menu</span>
			</a>
		</li>
	</ul>
</div>
<div class="box-add">
	<div class="box-add-item box-message">
		<a href="#modal_message" data-toggle="modal"><i class="fa fa-envelope"></i></a>
		<div class="box-note"><?=_guitinnhan?></div>
	</div>
	<div class="box-add-item box-call">
		<a href="#modal_call" data-toggle="modal"><i class="fa fa-phone"></i></a>
		<div class="box-note"><?=_goichochungtoi?></div>
	</div>
	<div class="box-add-item box-facebook">
		<a href="<?=$company['fanpage']?>" target="_blank"><svg id="fb-msng-icon" data-name="messenger icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.47 30.66"><path d="M29.56,14.34c-8.41,0-15.23,6.35-15.23,14.19A13.83,13.83,0,0,0,20,39.59V45l5.19-2.86a16.27,16.27,0,0,0,4.37.59c8.41,0,15.23-6.35,15.23-14.19S38,14.34,29.56,14.34Zm1.51,19.11-3.88-4.16-7.57,4.16,8.33-8.89,4,4.16,7.48-4.16Z" transform="translate(-14.32 -14.34)" style="fill:#fff"></path></svg></a>
		<div class="box-note"><?=_chatqua?> facebook</div>
	</div>
	<div class="box-add-item box-zalo">
		<a href="https://zalo.me/<?=$company['zalo']?>" target="_blank"><img src="images/zalo.png"></a>
		<div class="box-note"><?=_chatqua?> zalo</div>
	</div>
	<div class="box-add-item box-map">
		<a href="#modal_map" data-toggle="modal" target="_blank"><i class="fa fa-map-marker"></i></a>
		<div class="box-note"><?=_vanphong?> </div>
	</div>
	
</div>



<div class="modal fade" id="modal_message" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		    	<div id="message_val">
		    		<div class="h6"><?=_delaithongtin?> - <b><?=_nhangiauudai?></b></div>
			    	<form action="" method="post" name="frm_message" id="frm_message">
			    		
		    			<input type="text" name="dienthoai_message" id="dienthoai_message" placeholder="<?=_sodienthoaicuaban?>"  class="form-control" />
		    			<textarea name="noidung_message" id="noidung_message" placeholder="<?=_delailoinhanchochungtoi?>"  class="form-control" ></textarea>
		    			<input type="button" name="submit_message" value="<?=_gui?> <?=$company['ten']?>" class="btn btn-success form-control" onclick="return sb_message()" />

			    	</form>
		    	</div>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_call" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      	<div class="h6"><?=_goicho?> <?=$company['ten']?> <?=_denhantuvantotnhat?></div>
			    <div id="call_val">
			    	<form action="index.php" method="post" name="frm_call" id="frm_call">
			    		
			    		<div class="form-group">
			    			<input type="text" name="dienthoai_call" id="dienthoai_call" placeholder="<?=_sodienthoaicuaban?>" class="form-control" />
			    			<input type="button" name="submit_call" id="submit_call" value="<?=_yeucaugoilai?>" class="btn btn-success form-control" onclick="return sb_call()" />
			    		</div>

			    	</form>
			    	<div class="phan_cach"><span><?=_hoac?></span></div>
					<div class="">
						<p><b><?=_goicho?> <?=$company['ten']?> <?=_denhantuvantotnhat?></b></p>
						<p><b><?=$company['dienthoai']?></b></p>
					</div>
			    </div>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_map" role="dialog" >
    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		      	<div class="h6"><?=_vanphong?> - <?=$company['ten']?></div>
		      	<p><i class="fa fa-map-marker"></i> &nbsp; <?=$company['diachi'.$lang]?></p>
	    		<div class="x_map" >
				    <?=$company['link_googlemap']?>
				</div>
		    </div>
		</div>
	</div>
</div>
<a href="#modal_result" data-toggle="modal"  class="hidden" id="button_show_result"></a>
<div class="modal fade" id="modal_result" role="dialog" >
    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
	    		<div class="comment_result" >
				    
				</div>
				<div class="auto-close">
					<?=_thongbaosetudongtatsau?> <b id="second_end">5</b> <?=_giay?> ...
				</div>
		    </div>
		</div>
	</div>
</div>
<script>
	function sb_call() {
		if(isEmpty($('#dienthoai_call').val(),"<?=_nhapsodienthoai?>")){
			$('#dienthoai_call').focus();
			return false;
		}
		if(isPhone($('#dienthoai_call').val(),"<?=_sodienthoaikhonghople?>")){
			$('#dienthoai_call').focus();
			return false;
		}
		$.ajax({
			url:'ajax/box_contact.php',
			data:{
				act:'goi-dien',
				dienthoai:$('#dienthoai_call').val(),
			},
			type:'POST',
			async:true,
			success: function(res){		
				dongModal();	

				$('.comment_result').html(res);
				
				$('#button_show_result').click();

				$("#dienthoai_call").val("");

				countdown();
			}
		});
	}
</script>
<script>
	function sb_message() {
		if(isEmpty($('#dienthoai_message').val(),"<?=_nhapsodienthoai?>")){
			$('#dienthoai_message').focus();
			return false;
		}
		if(isPhone($('#dienthoai_message').val(),"<?=_sodienthoaikhonghople?>")){
			$('#dienthoai_message').focus();
			return false;
		}
		if(isEmpty($('#noidung_message').val(),"<?=_nhapnoidung?>")){
			$('#noidung_message').focus();
			return false;
		}
		$.ajax({
			url:'ajax/box_contact.php',
			data:{
				act:'gui-tin',
				dienthoai:$('#dienthoai_message').val(),
				noidung:$('#noidung_message').val(),
			},
			type:'POST',
			async:true,
			success: function(res){		
				
				dongModal();
				
				$('.comment_result').html(res);
				
				$('#button_show_result').click();

				$("#dienthoai_message").val('');

				$("#noidung_message").val('');

				countdown();
				
			}
		});
	}

var setTime = 5;

function countdown(){
	const interval = setInterval(function(){
		
		if(setTime==0){

			dongModal();

			clearInterval(interval);

			setTime = 5;

			$('#second_end').html('5');

		}else{
			setTime = setTime-1;

			return  $('#second_end').html(setTime);
		}
	},1000);
}
function dongModal(){
	$('.close').click();
}
</script>

