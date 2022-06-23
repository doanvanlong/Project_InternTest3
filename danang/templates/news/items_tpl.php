<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		$("#chonhet").click(function(){
			var status=this.checked;
			$("input[name='chon']").each(function(){this.checked=status;})
		});
		
		$("#xoahet").click(function(){
			var listid="";
			$("input[name='chon']").each(function(){
				if (this.checked) listid = listid+","+this.value;
				})
			listid=listid.substr(1);	 //alert(listid);
			if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
			hoi= confirm("Xác nhận xóa dữ liệu. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !");
			if (hoi==true) document.location = "index.php?com=news&act=delete&type=<?=$_REQUEST['type']?>&listid=" + listid;
		});
	});
	
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}

	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();	
		if(a=='Tên...') a='';		
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&key="+a;	
		return true;
	}	
</script>

<?php
function get_main_danhmuc()
	{
		$sql="select * from table_news_danhmuc where type='".$_REQUEST['type']."' order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 1</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row["id"].'" '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

function get_main_list()
	{
		$sql="select * from table_news_list where id_danhmuc=".$_REQUEST['id_danhmuc']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 2</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row["id"].'" '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
		
function get_main_category()
	{
		$sql="select * from table_news_cat where id_list=".$_REQUEST['id_list']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange2()" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 3</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row["id"].'" '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
		
	
?>
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>"><span>Quản lý bài viết</span></a></li>
        	<?php if($_GET['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div> 

<?php include "templates/url.php"; ?>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div id="div_fixed">
    	<input type="button" class="btn btn-info" value="Thêm" onclick="location.href='index.php?com=news&act=add&type=<?=$_GET['type']?>'" />
        <input type="button" class="btn btn-info" value="Xoá Chọn" id="xoahet" />
        <div class="timkiem">
		    <input type="text" name="key" class="key" value="" placeholder="Nhập từ khóa tìm kiếm ">
		    <button type="button" class="btn btn-info" onclick="timkiem();" value="">Tìm kiếm</button>
	    </div>
    </div>
    <div class="form-group-category">
    	<div class="form-control <?=(!$config_s['danhmuc'])?'none':''?>"><?=get_main_danhmuc()?></div>
	    <div class="form-control <?=(!$config_s['list'])?'none':''?>"><?=get_main_list()?></div>
	    <div class="form-control <?=(!$config_s['cat'])?'none':''?>"><?=get_main_category()?></div>
    </div>  
</div>

<div class="widget mt-10">
 
  <div class="mytable">
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr class="tt_table">
        <td width="4%"><div class="titleIcon buttonCheckALl"><input type="checkbox" id="titleCheck" name="titleCheck" /></div></td>
        <td class="" width="5%"><a href="#" class="tipS">Thứ tự</a></td>   
        <td class="tb_data_small <?= (!$config_s['hinhanh'])?'none':'' ?>" width="5%">Hình ảnh</td>
        <td class="title_data_medium sortCol"><div>Tên bài viết<span></span></div></td>
        
        <td class="sortCol <?= (!$config_s['id_user'])?'none':'' ?>" width="8%" ><div>Tác giả <span></span></div></td>
        <td class="sortCol <?= (!$config_s['luotxem'])?'none':'' ?>" width="8%" ><div>Lượt xem <span></span></div></td>
        <td class="tb_data_small sortCol <?= (!$config_s['ngaytao'])?'none':'' ?>" width="10%" ><div>Ngày tạo<span></span></div></td>
         <td class="tb_data_small ">Nổi bật</td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td width="4%">
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>

       
        <td align="center">
            <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_GET['com']?>" data-val3="stt" onblur="stt(this)" type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" original-title="Nhập số thứ tự bài viết" rel="<?=$items[$i]['id']?>" />

        </td> 
        <td align="center" class="img_botron <?= (!$config_s['hinhanh'])?'none':'' ?>"><img src="<?=_upload_tintuc.$items[$i]['photo']?>"></td>
        <td class="title_name_data">
            <a href="index.php?com=news&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&hienthi=<?=$items[$i]['hienthi']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" class="tipS SC_bold"><?=$items[$i]['ten']?></a>
        </td>
		<td class="<?= (!$config_s['id_user'])?'none':'' ?>" align="center"><?=getUser($items[$i]['id_user'])?></td>
		<td class="<?= (!$config_s['luotxem'])?'none':'' ?>" align="center"><?=lamTronSo($items[$i]['luotxem'])?></td>
		<td class="<?= (!$config_s['ngaytao'])?'none':'' ?>" ><?=date('d-m-Y H:i:s',$items[$i]['ngaytao'])?></td>
        <td align="center" class="">
        <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
       
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
       	
        <td class="actBtns">
        	<a href="index.php?com=news&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&hienthi=<?=$items[$i]['hienthi']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" title="" class="btn btn-info" original-title="Sửa bài viết"><i class="fa fa-pencil"></i> Sửa</a>
        	
        	<a href="<?=$web.$com.'/'.$items[$i]['tenkhongdau'].$duoi ?>" target="_blank" class="btn btn-primary <?=(!$config_s['url'])?'none':''?>" original-title="Xem sản phẩm"><i class="fa fa-eye"></i> Xem</a> 
            <a href="index.php?com=news&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" onClick="if(!confirm('Xác nhận xóa dữ liệu. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !')) return false;" title="" class="btn btn-danger" original-title="Xóa bài viết"><i class="fa fa-times"></i> Xóa</a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</div>
</form>  
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
