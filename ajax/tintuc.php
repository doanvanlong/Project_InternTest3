
<?php
include ("ajax_config.php");

$vitridau = addslashes($_REQUEST['vitri']);
$vitridau = trim(strip_tags($vitridau));
$vitridau = htmlspecialchars($vitridau);
$vitridau = mysqli_real_escape_string($d->db,$vitridau);
//echo 'Vào='.$vitridau;
//dem tong dong 


$sql="select ten$lang as ten,tenkhongdau,id,photo,mota$lang as mota,ngaytao from table_news where hienthi=1 and type='tintuc' and noibat=1 order by stt,id desc";

$d->query($sql);
//echo 'abc';exit();
$tongdong=$d->num_rows();
//echo 'tongdong='.$tongdong;
//Số dòng hiện
$sodonghien=4;

$tongsotrang=ceil($tongdong/$sodonghien);//Định số trang
	
//query
$sql="select ten$lang as ten,tenkhongdau,id,photo,mota$lang as mota,ngaytao from #_news where hienthi=1 and type='tintuc' and noibat=1 order by stt,id desc";

$sql.=' limit '.$vitridau.','.$sodonghien.'';
$d->query($sql);
$m_news = $d->result_array();	

/*===============================Xuat file=======================================*/
for($i=0;$i<count($m_news);$i++){?>
    <div class="box_tintuc wow fadeIn" data-wow-delay="0.<?=($i+1)?>s">
        <div class="img_tt"><a href="tin-tuc/<?=$m_news[$i]['tenkhongdau']?>.html" title="<?=$m_news[$i]['ten']?>"><img src="thumb/270x170x1x90/<?=_upload_tintuc_l.$m_news[$i]['photo']?>" alt="<?=$m_news[$i]['ten']?>"/></a></div>
        <h3 class="name_tt"><a href="tin-tuc/<?=$m_news[$i]['tenkhongdau']?>.html" title="<?=$m_news[$i]['ten']?>"><?=$m_news[$i]['ten']?></a></h3>
         <div class="clear"></div>
        <div class="desc_tt"><?=catchuoi($m_news[$i]['mota'],150)?></div>
        <a class="viewmore" href="tin-tuc/<?=$m_news[$i]['tenkhongdau']?>.html" title="<?=$m_news[$i]['ten']?>">Xem thêm</a>
    </div>
<?php
}

echo '<div class="clear"></div>';	
echo '<div class="pagination"><ul class="pages">';
	
if($tongsotrang>1){

	$tranghientai=($vitridau/$sodonghien)+1;
	$vitritam=$vitridau-$sodonghien;
	if($tranghientai>1){
	echo '<li><a class="bam" vitri="0">&laquo;</a></li>';
	
	echo '<li><a class="bam" vitri="'.$vitritam.'">&#8249;</a></li>';
	}


$begin=$tranghientai-2;
$end=$tranghientai+2;
if($begin<1){$begin=1;}
if($end > $tongsotrang){$end=$tongsotrang;}

//echo $end;
for($i=$begin;$i<=$end;$i++){
	$vitritam=($i-1)*$sodonghien;
	if($tranghientai==$i){
	echo '<li><a class="bam" vitri="noactive" id="active_z">'.$i.'</a></li>';
	}else{
	echo '<li><a class="bam" vitri="'.$vitritam.'">'.$i.'</a></li>';
		
	}
	
}
if($tranghientai<$tongsotrang){
	$vitritam=$vitridau+$sodonghien;
	$vitricuoi=($tongsotrang-1)*$sodonghien;
	echo '<li><a class="bam" vitri="'.$vitritam.'">&#8250;</a></li>';
	echo '<li><a class="bam" vitri="'.$vitricuoi.'">&raquo;</a></li>';
	}

}

echo '</ul></div>';
?>