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
			if (hoi==true) document.location = "index.php?com=product&act=delete&type=<?=$_REQUEST['type']?>&listid=" + listid;
		});
	}); 
	
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=product&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=product&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}
	function select_onchange3()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		var d=document.getElementById("id_item");
		window.location ="index.php?com=product&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value+"&id_item="+d.value;	
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
		window.location ="index.php?com=product&act=man&type=<?=$_REQUEST['type']?>&key="+a;	
		return true;
	}	
</script>

<?php
function get_main_danhmuc()
	{
		$sql="select * from table_product_danhmuc where type='".$_REQUEST['type']."' order by stt";
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
		$sql="select * from table_product_list where id_danhmuc=".$_REQUEST['id_danhmuc']." order by stt";
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
		$sql="select * from table_product_cat where id_list=".$_REQUEST['id_list']." order by stt";
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
		
	function get_main_item()
	{
		$sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" onchange="select_onchange3()" class="main_select select_danhmuc chzn-select">
			<option value="0">Danh mục cấp 4</option>			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value="'.$row_huyen["id"].'" '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>
<div class="control_frm">
    <div class="bc"> 
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=product&act=man&type=<?=$_REQUEST['type']?>"><span>Quản lý <?=$title_main ?></span></a></li>
        	<?php if($_GET['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="frm" id="frm" method="post" action="index.php?com=product&act=savestt<?php if($_REQUEST['id_danhmuc']!='') echo'&id_danhmuc='.$_REQUEST['id_danhmuc'];?><?php if($_REQUEST['id_list']!='') echo'&id_list='.$_REQUEST['id_list'];?><?php if($_REQUEST['id_cat']!='') echo'&id_cat='.$_REQUEST['id_cat'];?><?php if($_REQUEST['id_item']!='') echo'&id_item='.$_REQUEST['id_item'];?><?php if($_REQUEST['id_thuonghieu']!='') echo'&id_thuonghieu='.$_REQUEST['id_thuonghieu'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>">
<div class="control_frm" style="margin-top:0;">
  	<div id="div_fixed">
    	<input type="button" class="btn btn-info" value="Thêm" onclick="location.href='index.php?com=product&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="btn btn-info" value="Xoá Chọn" id="xoahet" />
        <div class="timkiem">
		    <input type="text" value="" name="key" class="key"  placeholder="Nhập từ khóa tìm kiếm ">
		    <button type="button" class="btn btn-info" onclick="timkiem();" value="">Tìm kiếm</button>
	    </div>
    </div> 
    <div class="form-group-category">
	  	<div class="form-control <?=(!$config_s['danhmuc'])?'none':''?>"><?=get_main_danhmuc()?></div>
	    <div class="form-control <?=(!$config_s['list'])?'none':''?>"><?=get_main_list()?></div>
	    <div class="form-control <?=(!$config_s['cat'])?'none':''?>"><?=get_main_category()?></div>
	    <div class="form-control  none"><?=get_main_item()?></div>
  	</div> 
</div> 
<div class="widget">
  <?php include "templates/url.php"; ?>
  <div class="mytable">
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead> 
      <tr class="tt_table">
        <td width="4%"><div class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></div></td>
        <td class="" width="5%"><a href="#" class="tipS">Thứ tự</a></td>     
        <td class="tb_data_small <?= (!$config_s['hinhanh'])?'none':'' ?>" width="5%" >Hình ảnh</td>
        <td class="title_data_medium sortCol"><div>Tên sản phẩm<span></span></div></td>
        <td class="tb_data_small sortCol" width="7%" ><div>Lượt xem <span></span></div></td>
        <td class="tb_data_small sortCol <?= (!$config_s['ngaytao'])?'none':'' ?>" width="10%" ><div>Ngày tạo <span></span></div></td>
         <td class="tb_data_small ">Nổi bật</td>
         <td class="tb_data_small <?=(!$config_s['moi'])?'none':''?>">Mới</td>
         <td class="tb_data_small <?=(!$config_s['banchay'])?'none':''?>">Bán chạy</td>
         <td class="tb_data_small <?=(!$config_s['khuyenmai'])?'none':''?>">Khuyến mãi</td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tbody>
    	 <?php for($i=0, $count=count($items); $i<$count; $i++){?> 
          <tr>
          <td  width="4%">
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="chon" />
        </td>
         <td align="center">
            <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_GET['com']?>" type="text" value="<?=$items[$i]['stt']?>" name="stt<?=$i?>" data-val3="stt" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" onblur="stt(this)" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
        </td>
         <td align="center" class="img_botron <?= (!$config_s['hinhanh'])?'none':'' ?>"><img src="<?=_upload_sanpham.$items[$i]['photo']?>"></td>
        <td align="center">
            <a href="index.php?com=product&act=edit&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_thuonghieu=<?=$items[$i]['id_thuonghieu']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ten']?></a>
        </td>
        <td align="center" class=""><?=lamTronSo($items[$i]['luotxem'])?></td>
        <td class="<?= (!$config_s['ngaytao'])?'none':'' ?>" ><?=date('d-m-Y H:i:s',$items[$i]['ngaytao'])?></td>
        <td align="center" class="">
        <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
        
        <td align="center" class="<?=(!$config_s['moi'])?'none':''?>">
        <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['spmoi']?>" data-val3="spmoi" class="diamondToggle <?=($items[$i]['spmoi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>

        <td align="center" class="<?=(!$config_s['banchay'])?'none':''?>">
        <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['spbanchay']?>" data-val3="spbanchay" class="diamondToggle <?=($items[$i]['spbanchay']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
        
         <td align="center" class="<?=(!$config_s['khuyenmai'])?'none':''?>">
        <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['tieubieu']?>" data-val3="tieubieu" class="diamondToggle <?=($items[$i]['tieubieu']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
       
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
        
        <td class="actBtns">
        	<a href="index.php?com=product&act=edit&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_thuonghieu=<?=$items[$i]['id_thuonghieu']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>&id=<?=$items[$i]['id']?>" title="" class="btn btn-info" original-title="Sửa sản phẩm"><i class="fa fa-pencil"></i> Sửa</a>
        	
        	<a href="<?=$web.$com.'/'.$items[$i]['tenkhongdau'].$duoi ?>" target="_blank" class="btn btn-primary <?=(!$config_s['url'])?'none':''?>" original-title="Xem sản phẩm"><i class="fa fa-eye"></i> Xem</a> 
            <a href="index.php?com=product&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>" onClick="if(!confirm('Xác nhận xóa dữ liệu. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !')) return false;" title="" class="btn btn-danger" original-title="Xóa sản phẩm"><i class="fa fa-times"></i> Xóa</a>
        </td>
          </tr>
         <?php } ?>
    </tbody>
  </table>
  </div>
</div>
</form>
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>