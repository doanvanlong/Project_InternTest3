<?php 
	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id from #_news_danhmuc where hienthi=1 and type='hethong' order by stt,id desc";
	$d->query($sql);
	$hethong=$d->result_array();
?>

<div class="box_container">
	<div class="tieude_giua"><h2><?=$title_cat?></h2></div>
	<div class="b-layout">
    	<ul class="lst_branch">
        	<?php for($i=0;$i<count($hethong);$i++){
				$d->reset();
				$sql="select ten$lang as ten,tenkhongdau,id,toado,dienthoai,diachi from #_news_list where hienthi=1 and id_danhmuc='".$hethong[$i]['id']."' and type='hethong' order by stt,id desc";
				$d->query($sql);
				$hethong_list=$d->result_array();	
			?>
              <li><b><i class="fa fa-plus"></i> <?=$hethong[$i]['ten']?></b>   
              <?php if(count($hethong_list)>0){?>        
                                                                              							                 <ul>            
                                                                                                                                   <?php for($j=0;$j<count($hethong_list);$j++){
																																	   				 ?>                                                                                                			        			<li><a href="javascript:void(0)" onclick="moveToMaker(<?=$hethong_list[$j]['id']?>)"><?=$hethong_list[$j]['ten']?></a></li>   
                                                                                                                                   <?php }?>                                                                 
                 </ul>
                 <?php }?>
                </li> 
             <?php }?>                                                    
         </ul>
         <div class="map_bando">
         	<div id="map_canvas1"></div>
         </div>
         <div class="clear"></div>
    </div>
</div><!---END .box_container-->
<?php 
	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,toado,dienthoai,diachi from #_news_list where hienthi=1 and type='hethong' order by stt,id desc";
	$d->query($sql);
	$hethong_list=$d->result_array();
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=$company['keygoogle']?>"></script>
<script type="text/javascript">
  			var map;
		   var infowindow;
		   var marker= new Array();
		   var old_id= 0;
		   var infoWindowArray= new Array();
		   var infowindow_array= new Array();function initialize1(){
			   var defaultLatLng = new google.maps.LatLng(<?=$hethong_list[0]['toado']?>);
			   var myOptions= {
				   zoom: 16,
				   center: defaultLatLng,
				   scrollwheel : true,
				   mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById("map_canvas1"), myOptions);map.setCenter(defaultLatLng);			  
			  <?php for($j=0;$j<count($hethong_list);$j++){ ?>  
			   var arrLatLng = new google.maps.LatLng(<?=$hethong_list[$j]['toado']?>);
			   infoWindowArray[<?=$hethong_list[$j]['id']?>] = '<div class="map_description"><div class="map_title"><?=trim(strip_tags($hethong_list[$j]['ten']))?></div><div><?=_diachi?> : <?=trim(strip_tags($hethong_list[$j]['diachi']))?> - <?=_dienthoai?>: <?=trim(strip_tags($hethong_list[$j]['dienthoai']))?></div></div>';
			   loadMarker(arrLatLng, infoWindowArray[<?=$hethong_list[$j]['id']?>], <?=$hethong_list[$j]['id']?>);
			   <?php } ?>

			   moveToMaker(<?=$hethong_list[0]['id']?>);}
			   function loadMarker(myLocation, myInfoWindow, id){marker[id] = new google.maps.Marker({position: myLocation, map: map, visible:true});
			   var popup = myInfoWindow;infowindow_array[id] = new google.maps.InfoWindow({ content: popup});

			   google.maps.event.addListener(marker[id], 'click', function() {if (id == old_id) return;if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;});

			   google.maps.event.addListener(infowindow_array[id], 'closeclick', function() {old_id = 0;});

			  
			}
			   function moveToMaker(id){var location = marker[id].position;map.setCenter(location);if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;}
			 google.maps.event.addDomListener(window, 'load', initialize1);
</script> 
<style>
	#map_canvas1 img{max-width:none !important;}
	 ul.lst_branch{
        list-style: none;
        padding: 0px;
        color: #FFF;
		width:31%;
		float:left;
    }
	ul.lst_branch li b{font-size:14px;}
    ul.lst_branch li{
        z-index: 1;
        padding: 8px 10px;
        cursor: pointer;
		
        /* IE10+ */ 
        background-image: -ms-linear-gradient(left, #1E5799 0%, #1E649E 50%, #16558A 51%, #7db9e8 100%);
        /* Mozilla Firefox */ 
        background-image: -moz-linear-gradient(left, #1E5799 0%, #1E649E 50%, #16558A 51%, #7db9e8 100%);
        /* Opera */ 
        background-image: -o-linear-gradient(left, #1E5799 0%, #1E649E 50%, #16558A 51%, #7db9e8 100%);
        /* Webkit (Safari/Chrome 10) */ 
        background-image: -webkit-gradient(linear, left top, right top, color-stop(0, #1E5799), color-stop(50, #1E649E), color-stop(51, #16558A), color-stop(100, #7db9e8));
        /* Webkit (Chrome 11+) */ 
        background-image: -webkit-linear-gradient(left, #1E5799 0%, #1E649E 50%, #16558A 51%, #7db9e8 100%);
        /* W3C Markup */ 
        background-image: linear-gradient(to right, #1E5799 0%, #1E649E 50%, #16558A 51%, #7db9e8 100%);
    }
	ul.lst_branch li a{ font-family: myfont;font-size: 13px;color:#fff;}
    ul.lst_branch li ul{
        padding: 0px;
        display: none;
        z-index: 2;
		list-style:none;
    }

    ul.lst_branch li:first-child ul{
        display: block;
    }


    ul.lst_branch li ul li{
        transition: 0.5s ease;
        padding: 10px 0px;
    }

    ul.lst_branch li ul li:hover{
        color: #F00;
    }
</style>