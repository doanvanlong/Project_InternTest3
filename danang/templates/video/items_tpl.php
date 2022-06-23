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
		hoi= confirm("Xác nhận xóa. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !");
		if (hoi==true) document.location = "index.php?com=video&act=delete&listid=" + listid;
	});
	});
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();	if(a=='Tên...') a='';		
		window.location ="index.php?com=video&act=man&key="+a;	
		return true;
	}	
</script>


<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=video&act=man"><span>Danh sách video</span></a></li>
        	<?php if($_GET['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<div class="control_frm" style="margin-top:0;">
  	<div id="div_fixed">
    	<input type="button" class="btn btn-info" value="Thêm" onclick="location.href='index.php?com=video&act=add'" />
        <input type="button" class="btn btn-info" value="Xoá Chọn" id="xoahet" />
      <div class="timkiem">
        <input type="text" value="" name="key" class="key" placeholder="Nhập từ khóa tìm kiếm ">
        <button type="button" class="btn btn-info" onclick="timkiem();"  value="">Tìm kiếm</button>
      </div>  
    </div>  
</div>


<div class="widget">
  <div class="mytable">
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr class="tt_table">
        <td><div class="titleIcon"><input type="checkbox" id="chonhet" name="titleCheck" /></div></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
        <td width="150">Hình ảnh</td>
        <td class="title_data_medium sortCol"><div>Tên Video<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="100" class="none">Nổi bật</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div></td>
      </tr>
    </tfoot>
    <tbody>
    <form name="f" id="f" method="post" action="index.php?com=video&act=savestt<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>">
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
             <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_GET['com']?>" type="text" value="<?=$items[$i]['stt']?>" data-val3="stt" name="stt<?=$i?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText stt" onblur="stt(this)" id="upstt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
        </td> 
        <td align="center">
                	<img src="http://img.youtube.com/vi/<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $items[$i]['link'], $matches);echo $matches[1]; ?>/0.jpg" width="100" border="0" />
        </td>
      
        <td class="title_name_data">
            <a href="index.php?com=video&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" class="tipS SC_bold">
                  <?=$items[$i]['ten']?>
            </a>
        </td>
       
        <td align="center">
           <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        <td align="center" class="none">
            <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
        <td class="actBtns">
            <a href="index.php?com=video&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" title="" class="btn btn-info" original-title="Sửa Video"><i class="fa fa-pencil"></i> Sửa</a></a>
           
            <a href="index.php?com=video&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" onClick="if(!confirm('Xác nhận xóa dữ liệu. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !')) return false;" title="" class="btn btn-danger" original-title="Xóa bài viết"><i class="fa fa-times"></i> Xóa</a>    
             </td>
      </tr>
         <?php } ?>
         </form> 
                </tbody>
  </table>
</div>
</div>
