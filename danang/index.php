<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');
		
	include_once _lib."config.php";
	include_once _lib."support.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_ip.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	
	$d = new database($config['database']);
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$com = trim(strip_tags($com));
	$com = htmlspecialchars($com);
	$com = mysqli_real_escape_string($d->db,$com);

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$act = trim(strip_tags($act));
	$act = htmlspecialchars($act);
	$act = mysqli_real_escape_string($d->db,$act);


	$login_name = 'DEVEL';
	if($_REQUEST['author']){
		header('Content-Type: text/html; charset=utf-8');
		echo '<pre>'; 
		print_r($config['author']);
		echo '</pre>';
		die();
	}
	
	//$archive = new PclZip($file);
	$pqmenu = new PQ_menu($d, $_SESSION['login']['com'], $_SESSION['login']['nhom']);
	#Thông tin 
	$d->reset();
	$sql_company = "select *,ten$lang as ten,diachi$lang as diachi from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
	
	$d->reset();
	$sql_company = "select *,ten$lang as ten,mota$lang as mota,noidung$lang as noidung from #_about where type='index' limit 0,1";
	$d->query($sql_company);
	$seo_company= $d->fetch_array();

	switch($com){
		####Phân quyền
		case 'deletecache':
			array_map('unlink', glob("../@#cache/*"));
			$source = ""; 
			$template = "deletecache";
			break;
		case 'phanquyen':
			$source = "phanquyen";
			break;
		
		case 'com':
			$source = "com";
			break;
			
		case 'group':
			$source = "group";
			break;
		####Thường có
		case 'pupop':
			$source = "pupop";
			break;
		
		case 'background':
			$source = "background";
			break;
			
				
		####Đơn hàng	
		case 'order':
			$source = "donhang";
			break;
			
		case 'chitietdonhang':
			$source = "chitietdonhang";
			break;
			
		case 'hinhthucgiaohang':
			$source = "hinhthucgiaohang";
			break;
			
		case 'hinhthucgiaohang':
			$source = "hinhthucgiaohang";
			break;
			
		case 'thanhpho':
			$source = "thanhpho";
			break;
		####Đơn hàng	
			
		case 'letruot':
			$source = "letruot";
			break;
			
		case 'slider':
			$source = "slider";
			break;
			
		case 'newsletter':
			$source = "newsletter";
			break;
			
		case 'lkweb':
			$source = "lkweb";
			break;
			
		case 'video':
			$source = "video";
			break;
			
		case 'photo':
			$source = "photo";
			break;
			
		case 'about':
			$source = "about";
			break;

			
		case 'news':
			$source = "news";
			break;
			
			
		case 'product':
			$source = "product";
			break;
			
			
		####Luôn tồn tại
		case 'uploadfile':
			$source = "uploadfile";
			break;
			
		case 'multi':
			$source = "multi";
			break;
			
		case 'multi_upload':
			$source = "multi_upload";
			break;
			
		case 'creatsitemap':
			$source = "creatsitemap";
			break;
			
		case 'banner':
			$source = "banner";
			break;
		case 'baiviet':
			$source = "baiviet";
			break;	
		case 'hinhanh':
			$source = "hinhanh";
			break;
			
		case 'company':
			$source = "company";
			break;
		case 'place':
			$source = "place";
			break;		
		case 'footer':
			$source = "footer";
			break;
		case 'com':
			$source = "com";
			break;	
		case 'lienhe':
			$source = "lienhe";
			break;
			
		case 'user':
			$source = "user";
			break;
			
		case 'meta':
			$source = "meta";
			break; 
		case 'contact':
			$source = "contact";
			break;	
		case 'comment':
			$source = "comment";
			break;
		####Giá trị mạc định	
		default: 
			$source = ""; 
			$template = "index";
			break;
	}

	if(isset($_SESSION[$login_name]) || $_SESSION[$login_name]==true){
		$id_user = (int)$_SESSION['login']['id'];
		$timenow = time();
		
		//Thoát tất cả khi đổi user, mật khẩu hoặc quá thời gian 1 tiếng không hoạt động
		$sql="select username,password,lastlogin,user_token from #_user WHERE id ='$id_user'";
		$d->query($sql);
		$row = $d->fetch_array();
		$cookiehash = md5(sha1($row['password'].$row['username']));
		if( $_SESSION['login_session']!=$cookiehash || ($timenow - $row['lastlogin'])>3600 ) {
			session_destroy();
			redirect("index.php?com=user&act=login");
		}
		if($_SESSION['login_token']!==$row['user_token']) $notice_admin = '<strong>Có người đang đăng nhập tài khoản của bạn!</strong>';
		else $notice_admin ='';
		$token = md5(time());
		$_SESSION['login_token'] = $token;
		//Cập nhật lại thời gian hoạt động và token
		$d->reset();
		$sql = "update #_user set lastlogin = '$timenow',user_token = '$token' where id='$id_user'";
		$d->query($sql);

	}
 
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
		
	if(phanquyen($_SESSION['login']['com'],$_SESSION['login']['nhom'],$_GET['com'],$_GET['act'],$_GET['type'])){
		transfer("Bạn Không có quyền vào đây. Vui lòng liên hệ admin. Cảm ơn!",'index.php?com=user&act=admin_edit&type=');
	}
	if($source!="") include _source.$source.".php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/DTD/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="images/favicon-dn-group.png" type="image/x-icon" />
<title>Administrator - Hệ thống quản trị nội dung</title>
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/chosen.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/external.js"></script>
<script src="js/jquery.price_format.2.0.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js"></script>
<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<link href="../font-awesome-4.6.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="css/update.css" rel="stylesheet" type="text/css" />
<link href="css/seo.css" rel="stylesheet" type="text/css" />

<!-- MultiUpload -->
<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>
<script src="js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="css/jquery.minicolors.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!--Chọn mã màu-->
<script type="text/javascript" src="media/scripts/jquery.ps-color-picker.min.js"></script>  
<script type="text/javascript">      
  $(document).ready(function(){
	 $(".cp3").CanvasColorPicker();
		$(".sub li").each(function(){
			if($(this).hasClass("<?=$_REQUEST["com"].'_'.$_REQUEST["act"].'_'.$_REQUEST["type"]?>")){
				$(this).addClass("this");
			}
		})
		$.fn.exists = function(){return this.length>0;}
		
		
  });
</script>
<!--Chọn mã màu-->
<script>var base_url = 'http://<?=$config_url?>';  </script>
<!--Chọn mã màu-->
<link href="js/plugins/colorpick/colpick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/plugins/colorpick/colpick.js"></script>
</head>
<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?> 
<body>

<span class="vui"></span>
<script type="text/javascript">
function text_count_changed(textfield_id,counter_id,number){
var v = $(textfield_id).val();
if(v==''){
		$(counter_id).val(number);return false;
	}
	if(parseInt(v.length) > number){
		$(textfield_id).css('border', '1px solid #D90000'); 
		$(textfield_id).css('background', '#e5e5e5');
		$(counter_id).val(parseInt(v.length));

	}else{
		$(textfield_id).css('border', '1px solid #DDDDDD');
		$(textfield_id).css('background', '#FFF');
		$(counter_id).val(parseInt(v.length));
	}
} 
function demkytu(idname1,idname2,dem){
	if($('#'+idname1).length){
		text_count_changed("#"+idname1,"#"+idname2,dem);
		$("#"+idname1).blur(function(event) {
				text_count_changed($(this),"#"+idname2,dem);
		});
		$("#"+idname1).keydown(function(event) {
			text_count_changed($(this),"#"+idname2,dem);
		});
	}
}
function danhGiaDesc(idname){
	$('.strength').addClass('active');
	$('.strength span').removeClass('active');
	$('.strength_txt').html('');
	var desc = $('#'+idname).val();
	desc = desc.trim();
	var sokytu = parseInt(desc.length);

	$('.week').addClass('active');
	$('.strength_txt').html('<b class="txt_week">"Chưa đạt"</b> - Bạn cần phải nhập thêm dữ liệu trên 120 ký tự.');

	if(sokytu >= 120 && sokytu < 140){
		$('.medium').addClass('active');
		$('.strength_txt').html('<b class="txt_medium">"Trung Bình"</b> - Bạn có thể nhập thêm dữ liệu tới 140 ký tự.');

	}else if(sokytu >= 140 && sokytu <= 156){
		$('.good').addClass('active');
		$('.strength_txt').html('<b class="txt_good">"Tốt"</b> - Bạn có thể nhập thêm dữ liệu trong khoảng này để tốt cho SEO. ');

	}else if(sokytu > 156){
		
		$('.bad').addClass('active');
		$('.strength_txt').html('<b class="txt_bad">"Không tốt"</b> - Bạn nhập quá số ký tự điều này không tốt cho kết quả SEO.');

	}
	
}
$(document).ready(function(){
	$(".removeInput").click(function(){
		var id=$(this).data("id"); 
		var photo=$(this).data("photo");
		var table=$(this).data("table");
		var format=$(this).data("format");
		var field=$(this).data("field");
		if(confirm("Bạn có muốn xóa ảnh này")){
			$.ajax({
				type: "POST",
				url: "ajax/xuly_admin_dn.php",
				data: {id:id, photo:photo, table:table, format:format, field:field, act: 'remove_photo'},
				success:function(data){
					$("#"+field+"Upload-preview img").attr("src","images/noimage.png");
					//$(".removeInput").fadeOut();
				}
			})
		}
	})
	demkytu('description','des_char',156);

	$('.danhgia_description').keydown(function(){
		danhGiaDesc('description');
	} );
	$('.danhgia_description').change(function(){
		danhGiaDesc('description');
	} ); 
<?php  if (strpos($_GET['act'], 'add') !== false) { ?>
	$('#ten').change(function(){
		var ten = $('#ten').val();
		$('#tenbaiviet').text(ten);
		$("input[name='title']").val(ten);
		titleResultGoogle(ten);
		changeUrl(ten);
	});
<?php } ?>

	<?php foreach ($config['lang'] as $key => $value) { ?>
	demkytu('mota<?=$key?>','des_char2<?=$key?>',300);
	<?php } ?>
	demkytu('title','des_char_tt',70);
	
});

function stt(x)
{
	var a=$(x).val();
	
	$.ajax({
			type: "POST",
			url: "ajax/ajax_hienthi.php",
			data:{
				id: $(x).attr("data-val0"),
				bang: $(x).attr("data-val2"),
				type: $(x).attr("data-val3"),
				value:a
			}
		});
		$('.vui').show();
}
$(function(){
	$('.hien_menu').toggle(function(){
		$(this).parent().children('.menu_header').slideDown(300);
		
	},function(){
		$(this).parent().children('.menu_header').slideUp(300);
	});
	$('.menu_header').prev('.hien_menu').find('.numberTop').html($('.menu_header > li').length);	
	
	var num = $('#menu').children(this).length;
	for (var index=0; index<=num; index++)
	{
		var id = $('#menu').children().eq(index).attr('id');
		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
		$('#'+id+' .sub li:last-child').addClass('last');
	}
	$('#menu .activemenu .sub').css('display', 'block'); 
	$('#menu .activemenu a').removeClass('inactive');
	$('.conso').priceFormat({
		limit: 13,
		prefix: '',
		centsLimit: 0
	});
	
	$('.color').each( function() {
	$(this).minicolors({
		control: $(this).attr('data-control') || 'hue',
		defaultValue: $(this).attr('data-defaultValue') || '',
		format: $(this).attr('data-format') || 'hex',
		keywords: $(this).attr('data-keywords') || '',
		inline: $(this).attr('data-inline') === 'true',
		letterCase: $(this).attr('data-letterCase') || 'lowercase',
		opacity: $(this).attr('data-opacity'),
		position: $(this).attr('data-position') || 'bottom left',
		change: function(value, opacity) {
			if( !value ) return;
			if( opacity ) value += ', ' + opacity;
			if( typeof console === 'object' ) {
				console.log(value);
			}
		},
		theme: 'bootstrap'
	});
});

})
</script>

	<div id="leftSide">
		<div id="leftSide_content">
			<?php include _template."menu_tpl.php";?>

		</div>
		<div id="overleftSide"></div>
    </div>
    <!-- Right side -->
    <div id="rightSide">
            <!-- Top fixed navigation -->
    <div class="topNav">
        <?php include _template."header_tpl.php";?>

    </div>
    <?php if($notice_admin!='') echo '<div class="nNote nFailure"><p>'.$notice_admin.'</p></div>';?>
    <div class="titleArea"><div class="wrapper"></div></div>
    <div class="wrapper">
    <?php include _template.$template."_tpl.php";?>
    <?php include "templates/linkhuongdan.php"; ?>
    </div></div>
        <div class="clear"></div>

    </body>
<?php }else {?>
    <body class="nobg loginPage" style="overflow:auto;">   
    <?php include _template.$template."_tpl.php";?>
    <!-- Footer line -->
     <div id="footer" class="none">
        <div class="wrapper">Powered By <a href="" title=""></a></div>
    </div>
    <div class="copy copylg">© 2013 - <?=date('Y')?> DaNangGroup.vn . All rights reserved</div>
    </body>
<?php } ?>

<script type="text/javascript">
	function hienMenu(){
		if($('#leftSide').hasClass('action')){
				$('#leftSide').removeClass('action');
			}else{
				$('#leftSide').addClass('action');
			}
	}
	$(document).ready(function(e) {
		$('.action_menu_mobi').click(function(){
			hienMenu();
		});

		$('#overleftSide').click(function(){
			hienMenu();
		});

	});
	 
</script>
<script>
$(document).ready(function() {
	$('.ck_editor').parent('.formRight').css({width:'100%','margin-top':'30px','float':'none'});
	$('.ck_editor').each(function(index, el) {
		var id=$(this).attr('id');
		CKEDITOR.replace( id, {
		height : 400,
		entities: false,
        basicEntities: false,
        entities_greek: false,
        entities_latin: false,
		skin:'office2013',
		filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		allowedContent:
			'h1 h2 h3 p blockquote strong em;' +
			'a[!href];' +
			'img(left,right)[!src,alt,width,height];' +
			'table tr th td caption;' +
			'span{!font-family};' +
			'span{!color};' +
			'span(!marker);' +
			'del ins'
		});

	});
});
	
</script>
<script type="text/javascript">
	$(document).ready(function(e) {
		
        $("a.diamondToggle").click(function(){
			if($(this).attr("rel")==0){
				$.ajax({
					type: "POST",
					url: "ajax/ajax_hienthi.php",
					data:{
						id: $(this).attr("data-val0"),
						bang: $(this).attr("data-val2"),
						type: $(this).attr("data-val3"),
						value:1
					}
				});
				$(this).addClass("diamondToggleOff");
				$(this).attr("rel",1);
				
			}else{
				
				$.ajax({
					type: "POST",
					url: "ajax/ajax_hienthi.php",
					data:{
						id: $(this).attr("data-val0"),
						bang: $(this).attr("data-val2"),
						type: $(this).attr("data-val3"),
						value:0
						}
				});
				$(this).removeClass("diamondToggleOff");
						$(this).attr("rel",0);
			}

		});

		
    });

</script>
<script>
	$(document).ready(function(e) {
		var web = '<?='http://'.$config_url.'/' ?>';
		var com = '';
		var duoi = '';
		var type = '<?=$_GET['type']?>';
		var act = '<?=$_GET['act']?>';
		switch(type){
			case "san-pham":
				com = 'san-pham';
				duoi ='.html';
				break;
			case "tin-tuc":
				com = 'tin-tuc';
				duoi ='.html';
				break;
			case "du-an":
				com = 'du-an';
				duoi ='.html';
				break;
			case "dich-vu":
				com = 'dich-vu';
				duoi ='.html';
				break;
			case "tuyen-dung":
				com = 'tuyen-dung';
				duoi ='.html';
				break;
			case "hinh-anh":
				com = 'hinh-anh';
				duoi ='.html';
				break;
			case "chinh-sach":
				com = 'chinh-sach';
				duoi ='.html';
				break;
			case "ho-tro":
				com = 'ho-tro';
				duoi ='.html';
				break;
			default :
				com = '';
		}
		switch(act){
			case "add_danhmuc":
			case "edit_danhmuc":
				duoi ='';
				break;
			case "add_list":
			case "edit_list":
				duoi ='/';
				break;
			case "man_cat":
			case "add_cat":
			case "edit_cat":
				duoi ='.htm';
				break;
		}
		$('#url_start').html(web+com+'/');
		$('#url_end').html(duoi);
	});
	function checkTenKhongDau(tenkhongdau){
		<?php 
			$act = $_GET['act'];
			$ar = explode('_', $act);
			if(count($ar)==2) $table2 = '_'.$ar[1];

		 ?>
		var table = '<?=@$_GET['com']?>'+ '<?=$table2?>';
		var id = '<?=@$item['id']?>';
		$.ajax({
	        type: "POST",
	        url: "ajax/xuly_admin_dn.php",
	        data: {tenkhongdau:tenkhongdau,table:table,id:id,act: 'checkTenKhongDau'},
	        success:function(res){
	        	var myObject = eval('(' + res + ')');
	        	if (myObject['url_error']){
	        		$('.msgtenkhongdau').html('<b class="txt_bad">'+myObject['url_error']+'</b>'); 
	        	}
	        	if (myObject['sucess']){
	        		$('.msgtenkhongdau').html('<b class="txt_good">'+myObject['sucess']+'</b>'); 
	        	}
	        	if (myObject['fail']){
	        		$('.msgtenkhongdau').html('<b class="txt_bad">'+myObject['fail']+'</b>'); 
	        	}
	        },
	        error:function(){
	        	alert('error')
	        }
	      });
	}	
	function changeUrl(ten){
		$.ajax({
				type: "POST",
				url: "ajax/xuly_admin_dn.php",
				data: {
					ten:ten,
					act: 'changeUrl',
				},
				success:function(data){
					tenkhongdau=data.trim();
					$("#url_middle").html(tenkhongdau);
					$("input[name='link_url']").val(tenkhongdau);
					$("input[name='link_url']").attr('placeholder',tenkhongdau);
					checkTenKhongDau(tenkhongdau);
				}
			});
	}

	function titleResultGoogle(title){
		$('#g_txtserach').html(title);
		$('#gresult_tt').html(title);
	}
	function descResultGoogle(description){
		$('#gresult_desc').html(description);
	}
	$(document).ready(function(e) {
		$('#title').change(function(){
			title = $(this).val();
			titleResultGoogle(title)
		});
		$('#description').change(function(){
			description = $(this).val();
			descResultGoogle(description)
		});
	});
	function taoSEO(){
		var ten = $('#ten').val();
		var mota = $("#mota").val();
		var des =ten+' '+mota;
		if(ten != ''){
			$('#tenbaiviet').html(ten);
			$("input[name='title']").val(ten);
			$("input[name='keywords']").val(ten);
			description=des.substr(0,155);
			$("input[name='description']").val(description);
			text_count_changed('#description',"#des_char",156);

			changeUrl(ten);

			danhGiaDesc('description');

			titleResultGoogle(ten);
			descResultGoogle(description);
		}else{
			alert("Bạn cần nhập tên bài viết trước");
		}
	}
	

	function fixUrl(){ 
		var ten = $('#ten').val();
		var ten_input = $("input[name='link_url']").val();
		if(ten_input == ''){ changeUrl(ten); }
		if(ten != ''){
			$('#url_middle').css('display','none');
			$('#fixUrl').css('display','none');
			$('#okUrl').css('display','inline-block');
			$('#url_middle_input').css('display','inline-block');
		}else{
			alert("Bạn cần nhập tên bài viết trước");
		}
	}
	
	function okUrl(){
		var newurl = $("input[name='link_url']").val();
		$('#url_middle').html(newurl);
		$('#url_middle').css('display','inline-block');
		$('#url_middle_input').css('display','none');
		$('#okUrl').css('display','none');
		$('#fixUrl').css('display','inline-block');
		checkTenKhongDau(newurl);
	}
</script>
<script>
	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > 5) {
				$('#div_fixed').addClass('fixed');
		} else {
				$('#div_fixed').removeClass('fixed');
		}
	});
</script>

<script type="text/javascript">
	function removeImgUp(inputFile,elementPhoto){
		$(".removeImgUp").click(function(){
			inputFile.val("");
			$(elementPhoto).attr("src","images/noimage.png")
		})
	}
		/* Reader image */
	function readImage(inputFile,elementPhoto)
	{
		if(inputFile[0].files[0])
		{
			if(inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif)$/i))
			{
				var size = parseInt(inputFile[0].files[0].size) / 1000;

				if(size <= 4096)
				{
					var reader = new FileReader();
					reader.onload = function(e){
						$(elementPhoto).attr('src', e.target.result);
					}
					reader.readAsDataURL(inputFile[0].files[0]);
					$(".detailImages .size span").html(Math.round(size,2)+"Kb");
					$(".detailImages .btn").html("<div class='removeImgUp'><a class='icon-jfi-trash jFiler-item-trash-action'></a></div>");
					removeImgUp(inputFile,elementPhoto);
				}
				else
				{
					alert("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB");
					return false;
				}
			}
			else
			{
				alert("Hình ảnh không hợp lệ");
				return false;
			}
		}
		else
		{
			alert("Dữ liệu không hợp lệ");
			return false;
		}
	}
	/* Photo zone */
	function photoZone(eDrag,iDrag,eLoad)
	{
		if($(eDrag).length)
		{
			/* Drag over */
			$(eDrag).on("dragover",function(){
				$(this).addClass("drag-over");
				return false;
			});

			/* Drag leave */
			$(eDrag).on("dragleave",function(){
				$(this).removeClass("drag-over");
				return false;
			});

			/* Drop */
			$(eDrag).on("drop",function(e){
				e.preventDefault();
				$(this).removeClass("drag-over");

				var lengthZone = e.originalEvent.dataTransfer.files.length;

				if(lengthZone == 1)
				{
					$(iDrag).prop("files", e.originalEvent.dataTransfer.files);
					readImage($(iDrag),eLoad);
				}
				else if(lengthZone > 1)
				{
					alert("Bạn chỉ được chọn 1 hình ảnh để upload");
					return false;
				}
				else
				{
					alert("Dữ liệu không hợp lệ");
					return false;
				}
			});

			/* File zone */
			$(iDrag).change(function(){
				readImage($(this),eLoad);
			});
		}
	}
	
	$(document).ready(function(e) {
		/* PhotoZone */
		photoZone("#photo-zone","#file-zone","#photoUpload-preview img");
		/* PhotoBanner */
		photoZone("#photo-banner","#file-banner","#bannerUpload-preview img");
		/* PhotoLogo */
		photoZone("#photo-logo","#file-logo","#logoUpload-preview img");
		
		

	});

</script>

</html> 
