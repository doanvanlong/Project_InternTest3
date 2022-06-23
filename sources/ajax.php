<?php  if(!defined('_source')) die("Error");
	if(isAjaxRequest()){
	switch($_GET['id']){
		case 'update-ship':
			shipping();
			break;
		case 'add-cart': 
			addCart();
			break;
		case 'update-cart':
			updateCart();
			break;
		case 'get-cart-num':
			echo get_total();
			break;	
		case 'delete-cart':
			deleteCart($_POST['id']);
			break;
		case 'clear-cart':
			unset($_SESSION['cart']);
			break;	
		
	}
	die;
	}
	die("<h2>ERROR</h2>");
	
function shipping(){
		$id =  addslashes($_POST['id']);
		$id =  trim(strip_tags($id));
		$id =  htmlspecialchars($id);
		$id =  mysqli_real_escape_string($d->db,$id);

		$price = get_order_total();
		global $d, $row,$config;
		if($$config['phi']==1){
		$sql = "select phivanchuyen from table_place_city where id=".$id."";
		}else{
		$sql = "select phivanchuyen from table_place_dist where id=".$id."";
		}
		$d->query($sql);
		$row = $d->fetch_array();
		
		echo json_encode(array("ship"=>myformat($row['phivanchuyen']),"price"=>myformat($price),"all"=>myformat($price+$row['phivanchuyen']),false));
		
	}		
		
function deleteCart($id){
	unset($_SESSION['cart'][$id]);
	echo json_encode(array("total"=>myformat(get_order_total()),"qty"=>get_total()));
	die;
}
function updateCart(){
	
	$color = $_POST['color'];
	$size  = $_POST['size'];
	$product = $_POST['product'];
	
	foreach($product as $k=>$v){
		
		$_SESSION['cart'][$k]['qty'] = $v;
		$_SESSION['cart'][$k]['color'] = $color[$k];
		$_SESSION['cart'][$k]['size'] = $size[$k];
	}
	$tmp = array();
	foreach($_SESSION['cart'] as $k=>$v){
		md5($pid.$color.$size);
		$code = md5($v['productid'].$v['color'].$v['size']);
		
		if(isset($tmp[$code])){
			$tmp[$code]['qty'] = $tmp[$code]['qty']+$v['qty'];
		}else{
			$tmp[$code] = $v;
		}
	}
	$_SESSION['cart'] = $tmp;
}

function addCart(){
	
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	
	$color = $_POST['color'];
	$size = $_POST['size'];
	/*if($color){
		$colors = getColorByProductId($id);
		if(count($colors)>0){
			$color = $colors[0]['id_color'];
		}
		
	}
	if($size){
		$sizes = getSizeByProductId($id);
		if(count($sizes)>0){
			$size = $sizes[0]['id_size'];
		}
		
	}*/
	
	addtocart($id,$qty,$color,$size);
	
	echo get_total();
	
}