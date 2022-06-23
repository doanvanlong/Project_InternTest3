<?php
	include ("ajax_config.php");	
	
    $id = addslashes($_REQUEST['id']);
    $id = trim(strip_tags($id));
    $id = htmlspecialchars($id);
    $id = mysqli_real_escape_string($d->db,$id);
	
	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,photo,gia,giakm,type,id_danhmuc from #_product where id='".$id."'";
	$d->query($sql);
	$row_detail=$d->fetch_array();
?>  

<div id="yith-wacp-popup">
    <div class="yith-wacp-content">
    	<div class="yith-wacp-message"><span>Sản phẩm đã được cho vào giỏ!</span></div>
        <div class="col-md-3 col-sm-12 col-xs-12 pull-left product-thumb">
        	<a href="<?=$com?>/<?=$row_detail['tenkhongdau']?>.html" title="<?=$row_detail['ten']?>"><img  src="thumb/170x170x1x90/<?=_upload_sanpham_l.$row_detail['photo'];?>" alt="<?=$row_detail['ten']?>" /></a>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 pull-right info-box">
        	<div class="product-info">
                <h3 class="product-title"><a href="<?=$com?>/<?=$row_detail['tenkhongdau']?>.html" title="<?=$row_detail['ten']?>"><?=$row_detail['ten']?></a></h3>
                <div class="product-price"><?=number_format($row_detail['gia'],0, ',', '.').' <sup>đ</sup>';?></div>
            </div>
            <div class="cart-info">
                <div class="cart-totals">Tạm tính: <span class="cart-cost"><?= number_format(get_order_total(), 0, ',', '.').' <sup>đ</sup>'; ?></span></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="popup-actions">
            <a class="button go-cart" href="gio-hang.html">Xem giỏ hàng</a>
            <a class="button go-checkout" href="gio-hang.html">Thanh toán</a>
            <a class="button continue-shopping" href="#">Tiếp tục mua hàng</a> 
      </div>
      <div class="product-orther">
            <?php 
				$d->reset();
				$sql="select ten$lang as ten,tenkhongdau,id,photo,gia,giakm from #_product where type='".$row_detail['type']."' and id_danhmuc='".$row_detail['id_danhmuc']."'  and hienthi=1 and id<>'".$row_detail['id']."' order by stt,id desc limit 4";
				$d->query($sql);
				$product=$d->result_array();
			if(count($product)>0) { ?>
                <h3>Sản phẩm thường mua kèm</h3>
                <div class="wap_item sl_khac clearfix">
                <?php for($i=0,$count_product=count($product);$i<$count_product;$i++){ ?>
                    <div class="item">
                    <div class="sp_img"><a href="<?=$com?>/<?=$product[$i]['tenkhongdau']?>.html" title="<?=$product[$i]['ten']?>">
                    <img src="thumb/260x270x2x90/<?=_upload_sanpham_l.$product[$i]['photo']?>" alt="<?=$product[$i]['ten']?>" /></a></div>
                    <div class="sp_desc">
                       <div class="sp_gia" style="float:none;">
                            <?php if($product[$i]['giakm']!=0){?>
                                <div class="giakm"><?=number_format($product[$i]['giakm'],0, ',', '.').'VNĐ'; ?></div>
                                <div class="gia"> <?=number_format($product[$i]['gia'],0, ',', '.').'VNĐ'; ?></div>
                                 
                                 <div class="clear"></div>
                            <?php } else{?>
                                <div class="motgia">
                                   <?php if($product[$i]['gia']!=0){echo number_format($product[$i]['gia'],0, ',', '.').' VNĐ';}else{ echo '<a href="lien-he.html">'._lienhe.'</a>'; }?>
                                </div>
                            <?php }?>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div><!---END .item-->
                <?php } ?>
                <div class="clear"></div>
                </div><!---END .wap_item-->
            <?php } ?>
        </div>
    </div>
</div><!--.yith-wacp-popup-->