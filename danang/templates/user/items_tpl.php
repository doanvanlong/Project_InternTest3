<script type="text/javascript">
	$(document).ready(function() {

		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=user&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
		});

    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Xác nhận xóa. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !");
      if (hoi==true) document.location = "index.php?com=user&act=delete&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});
</script>


<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=user&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý Thành viên</span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div id="div_fixed">
      
    	<input type="button" class="btn btn-info" value="Thêm" onclick="location.href='index.php?com=user&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
    
        <input type="button" class="btn btn-info" value="Xoá Chọn" id="xoahet" />
        <div class="timkiem">
          <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
          <button type="button" class="btn btn-info"  value="">Tìm kiếm</button>
        </div>
    </div>   

</div>

<div class="widget">

<div class="mytable">
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr class="tt_table">
        <td><div class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></div></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>           
        <td class="title_data_medium">Tên tài khoản </td>
		    <td class="title_data_medium">Nhóm thành viên </td>
		    <td class="title_data_medium none">Email</td>
        <td class="tb_data_small">Lock</td>
        <td class="tb_data_small">active</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>

    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>

       
        <td align="center">
            <input type="text" value="<?=$items[$i]['id']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 

        <td class="title_name_data">
            <a href="index.php?com=user&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['username']?></a>
        </td>
		      <td class="title_name_data">
           
      				<?php
      				$d->reset();
      				$sql="select ten from #_phanquyen where id='".$items[$i]["role"]."'";
      				$d->query($sql);
      				$rs=$d->fetch_array();
      				echo $rs["ten"];
      				?>
              </td>

              <td class="title_name_data none"><?=$items[$i]['email']?></td>

          <td align="center" class="">
                <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
       <td align="center" class="">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['active']?>" data-val3="active" class="diamondToggle <?=($items[$i]['active']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
      </td>
        <td class="actBtns">
            <a href="index.php?com=user&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="btn btn-info" original-title="Sửa sản phẩm"><i class="fa fa-pencil"></i> Sửa</a>

            <a href="index.php?com=user&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa dữ liệu. Việc xóa dữ liệu sẽ không khôi phục được, Bạn cần cân nhắc và chịu trách nhiệm cho thao tác này !')) return false;" title="" class="btn btn-danger" original-title="Xóa sản phẩm"><i class="fa fa-times"></i> Xóa</a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</div>
</form>  

<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>