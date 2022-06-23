<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="index.php?com=newsletter&act=man"><span>Thêm email</span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=newsletter&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
 <div class="widget">
 	<input type="hidden" value="<?php if($_REQUEST['type']!='') echo $_REQUEST['type'];?>" name="type" class="tipS" />
 		<div class="formRow">
			<label>Tên</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['name']?>" name="name" title="Nhập tên" class="tipS" />
			</div>
			<div class="clear"></div>
		</div> 	
        <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['phone']?>" name="phone" title="Nhập điện thoại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div> 	
		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập email" class="tipS" />
			</div>
			<div class="clear"></div>
		</div> 	
         <div class="formRow">
            <label>Nội dung:</label>
            <div class="formRight">
                <textarea  rows="8" cols="" title="Nội dung" class="tipS" name="content" id="content"><?=@$item['content']?></textarea>
            </div>
            <div class="clear"></div>
        </div>  
       <div class="formRow">
			<div class="formRight">
               <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=newsletter&act=man" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
               
			</div>
			<div class="clear"></div>
		</div>        
 </div>
</form>
