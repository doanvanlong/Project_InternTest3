<?php 
	$d->reset();
	$sql="select * from #_comment where id_product = '".$row_detail['id']."' and hienthi=1 order by id desc";
	$d->query($sql);
	$ar_comment = $d->result_array();

	$demStar = count($ar_comment);

 ?>
<div class="tt_danhgia"><?=$demStar?> đánh giá cho <?=$row_detail['ten']?></div> 
<div class="w_danhgia">
     <div class="box_ratting">
     	<?php if(count($ar_comment)){ ?>
     	<div class="rate_average"><span class="number"><?=getRattingProduct($row_detail['id'])?></span> <i class="fa fa-star"></i></div>
     	<div class="rate_text"><b>Đánh giá trung bình</b></div>
     	<?php }else{ ?>
     		<div class="rate_text">Chưa có đánh giá nào</div>
     	<?php } ?>
     </div>             
     <div class="box_star">
	     <div class="box1_star">
	     	<?php 
		     	for ($i=1; $i < 6; $i++) { 
		     		$d->reset();
					$sql="select count(id) as dem from #_comment where id_product = '".$row_detail['id']."' and star=".$i." and hienthi=1 order by stt,id desc";
					$d->query($sql);
					$kqStar = $d->fetch_array();
					$rateOfStar = 0;
					if($kqStar['dem']){
						$rateOfStar = (int)$kqStar['dem']/(int)$demStar*100;
						$rateOfStar = round($rateOfStar);
					}
	     	?>
	     		<div class="type_star">
	     			<div class="num_star"><?=$i?> <i class="fa fa-star"></i></div>
	     			<div class="rec_star"><span class="phantramdanhgia" style="width: <?=$rateOfStar?>%;"></span></div>
	     			<div class="result_star"><span class="phantramdanhgia"><b><?=$rateOfStar?></b>%</span> | <span class="dem"><?=(int)$kqStar['dem']?> Đánh giá</span></div>
	     		</div>
	     	<?php } ?>
	     </div>             
     </div>             
     <div class="box_button">
     	<a class="btn_rate" href="#mydanhgia" data-toggle="modal" data-target="#mydanhgia">Đánh giá ngay</a>
     </div>             
</div>
<?php 
$checkImg = 0;
foreach ($ar_comment as $k => $val) {
	if($val['photo1']) $checkImg +=1;
	if($val['photo2']) $checkImg +=1;
	if($val['photo3']) $checkImg +=1;
}
if($checkImg){ ?>
<div class="wdanhgiaImg">
	<div class="tieudedanhgiaImg">Hình ảnh từ khách hàng</div>
	<div class="box_danhgiaImg">
		<?php $dem=1; foreach ($ar_comment as $k => $val) {  ?>

			<?php if($val['photo1']!=''){ $dem += 1; ?>
				<div class="danhgiaImg">
					<a href="<?=_upload_binhluan_l.$val['photo1']?>" data-fancybox="danhgiaimg" data-caption="<?=$val['noidung']?>" >
						<img src="thumb/100x100x1x90/<?=_upload_binhluan_l.$val['photo1']?>" >
						<span>
							<?php 
								$demimg = 1;
								if($val['photo2']!=''){ $demimg += 1; }
								if($val['photo3']!=''){ $demimg += 1; }
								echo $demimg.' ảnh';
						 	?>
						 </span>
					</a>
				</div>
			<?php } ?>

			<?php if($val['photo2']!=''){  ?>
				<div class="danhgiaImg d-none">
					<a href="<?=_upload_binhluan_l.$val['photo2']?>" data-fancybox="danhgiaimg" data-caption="<?=$val['noidung']?>"><img src="thumb/100x100x1x90/<?=_upload_binhluan_l.$val['photo2']?>" ></a>
				</div>
			<?php } ?>

			<?php if($val['photo3']!=''){  ?>
				<div class="danhgiaImg d-none">
					<a href="<?=_upload_binhluan_l.$val['photo3']?>" data-fancybox="danhgiaimg" data-caption="<?=$val['noidung']?>"><img src="thumb/100x100x1x90/<?=_upload_binhluan_l.$val['photo3']?>" ></a>
				</div>
			<?php } ?>

		<?php } ?>
	</div>
</div>
<?php } ?>
<?php if(count($ar_comment)){ ?>
<div class="wdanhgiaItem">
	<?php foreach ($ar_comment as $k => $val) { ?>
	<div class="danhgiaItem">
		<div class="danhgiaItem_img"><img src="images/none.png"></div>
		<div class="danhgiaItem_content">
			<div class="danhgiaItem_name">
				<b><?=$val['ten']?></b>
				<?php if($val['chungnhan']){ ?><span class="danhgiaItem_chungnhan"><i class="fa fa-check"></i> Đã mua tại <?=$company['website']?></span> <?php } ?>
			</div>
			<div class="danhgiaItem_mid">
				<div class="danhgiaItem_txt">
					<span class="danhgiaItem_star">
					<?php 
						for ($i=1; $i <= 5; $i++) { 
                            if($i <= $val['star']){
                                echo '<i class="fa fa-star"></i>';
                            }else{
                                echo '<i class="fa fa-star-o"></i>';
                            }
                        }
					?>	
				</span>&nbsp;&nbsp;<?=$val['noidung']?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="danhgiaItem_listimg">
				<?php 
				for ($i=0;$i<3;$i++) { 
					$dem = $i+1;
					if($val['photo'.$dem]!=''){
				?>
					<a href="<?=_upload_binhluan_l.$val['photo'.$dem]?>" data-fancybox="danhgiaItem<?=$val['id']?>">
						<img src="thumb/50x50x1x90/<?=_upload_binhluan_l.$val['photo'.$dem]?>" >
					</a>
				<?php }} ?>
			</div>
			<div class="danhgiaItem_time">Ngày đánh giá: <?=date('d-m-Y H:i:s',$val['ngaytao'])?></div>
			<?php if($val['reply'] != ''){ ?>
			<div class="danhgiaItem_reply">
				<div class="reply_img"><img src="images/none.png"></div>
				<div class="reply_content">
					<div class="danhgiaItem_name"><b><?=$company['tenbinhluan']?></b> <span class="quantri">Quản trị viên</span></div>
					<div><?=$val['reply']?></div>
					<div class="danhgiaItem_time">Ngày trả lời: <?=date('d-m-Y H:i:s',$val['ngaysua'])?></div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
</div>
<?php } ?>

<div class="modal fade" id="mydanhgia" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body"> 
       	<button  class="dongmodal" data-dismiss="modal" aria-label="Close">
        	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
      	</button>
      	<div class="formdanhgia">
      	<form  class="frm_danhgia" id="frm_danhgia" method="post" enctype="multipart/form-data">
      		<div class="title_dg">Đánh giá <?=$row_detail['ten']?></div>

	        <textarea name="noidung_danhgia" id="noidung_danhgia" rows="5" class="form-control mb-0" placeholder="Mời bạn chia sẻ thêm một số cảm nhận..." ></textarea>

	        <div class="w_img_danhgia upload__box">
	        	<div class="upload_danhgia btn_insert_attach">Gửi ảnh thực tế</div>
	        	<div id="countContent">0 ký tự (Tối thiểu 10)</div>
	        </div>
	        <div class="list_attach">
        		<ul class="attach_view"></ul>
        		<div class="insert_attach btn_insert_attach"><i class="fa fa-plus"></i></div>
        	</div> 
	        
	        <div class="w_stars_select" >
	        	<label>Bạn cảm thấy thế nào về sản phẩm? (Chọn sao)</label> 
		        <div class="stars_select">
		          	<a href="#" class="star-1" data-star="1"><span>Rất tệ</span></a>
		          	<a href="#" class="star-2" data-star="2"><span>Không tệ</span></a>
		          	<a href="#" class="star-3" data-star="3"><span>Trung bình</span></a>
		          	<a href="#" class="star-4" data-star="4"><span>Tốt</span></a>
		          	<a href="#" class="star-5 active" data-star="5"><span>Tuyệt vời</span></a>
		        </div>
	        </div>

			<input type="hidden" id="idsanpham" name="idsanpham_danhgia" value="<?=$row_detail['id']?>"/>
			<input type="hidden" id="tensanpham" name="tensanpham_danhgia" value="<?=$row_detail['ten']?>"/>
			<input type="hidden" id="sao_danhgia" name="sao_danhgia" value="5"/>

			<div class="form-group-3">
				<input class="form-control" type="text" id="ten_danhgia" name="ten_danhgia" value="" placeholder="Họ tên(*)" />
				<input class="form-control" type="sodienthoai" id="sodienthoai_danhgia" name="sodienthoai_danhgia" value="" placeholder="Số điện thoại(*)" />
				<input class="form-control" type="email" id="email_danhgia" name="email_danhgia" value="" placeholder="Email" />
			</div>

			<div class="form-group text-center">
				<button class="btn_rate" name="submit_danhgia" id="submit_danhgia" type="submit">Gửi đánh giá</button>
			</div>

      	</form>
      </div>
    </div>
  </div>
</div>
</div> 
<div class="modal fade" id="danhgia_result" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-body">
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
	    		<div class="text_danhgia_result"></div>
		    </div>
		</div>
	</div>
</div>