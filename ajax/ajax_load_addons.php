<?php

	include ("ajax_config.php");

	$url = addslashes($_REQUEST['url']);
	$width = addslashes($_REQUEST['width']);
	$height = addslashes($_REQUEST['height']);
	$widththumb = addslashes($_REQUEST['widththumb']);
	$heightthumb = addslashes($_REQUEST['heightthumb']);
	$type = addslashes($_REQUEST['type']);

	$url = trim(strip_tags($url));
	$width = trim(strip_tags($width));
	$height = trim(strip_tags($height));
	$widththumb = trim(strip_tags($widththumb));
	$heightthumb = trim(strip_tags($heightthumb));
	$type = trim(strip_tags($type));

	$url = mysqli_real_escape_string($d->db,$url);
	$width = mysqli_real_escape_string($d->db,$width);
	$height = mysqli_real_escape_string($d->db,$height);
	$widththumb = mysqli_real_escape_string($d->db,$widththumb);
	$heightthumb = mysqli_real_escape_string($d->db,$heightthumb);
	$type = mysqli_real_escape_string($d->db,$type);

?>

<?php if($type=='fanpage') { ?>
	<!-- Fanpage -->
	<div class="fb-page" 
	    data-href="<?=$company['fanpage']?>" 
	    data-tabs="timeline" 
	    data-width="<?=$width?>" 
	    data-height="<?=$height?>" 
	    data-small-header="true" 
	    data-adapt-container-width="true" 
	    data-hide-cover="false" data-show-facepile="true">
	    <div class="fb-xfbml-parse-ignore">
	    <blockquote cite="<?=$company['fanpage']?>">
	    <a href="<?=$company['fanpage']?>">Facebook</a>
	    </blockquote>
	    </div>
	</div>
<?php } ?>

<?php if($type=='messages') { ?>
	<!-- Chat Messenger 2 -->
	<div class="js-facebook-messenger-box onApp rotate bottom-right cfm rubberBand animated" data-anim="rubberBand">
		<svg id="fb-msng-icon" data-name="messenger icon" xmlns="//www.w3.org/2000/svg" viewBox="0 0 30.47 30.66"><path d="M29.56,14.34c-8.41,0-15.23,6.35-15.23,14.19A13.83,13.83,0,0,0,20,39.59V45l5.19-2.86a16.27,16.27,0,0,0,4.37.59c8.41,0,15.23-6.35,15.23-14.19S38,14.34,29.56,14.34Zm1.51,19.11-3.88-4.16-7.57,4.16,8.33-8.89,4,4.16,7.48-4.16Z" transform="translate(-14.32 -14.34)" style="fill:#fff"></path></svg>
		<svg id="close-icon" data-name="close icon" xmlns="//www.w3.org/2000/svg" viewBox="0 0 39.98 39.99"><path d="M48.88,11.14a3.87,3.87,0,0,0-5.44,0L30,24.58,16.58,11.14a3.84,3.84,0,1,0-5.44,5.44L24.58,30,11.14,43.45a3.87,3.87,0,0,0,0,5.44,3.84,3.84,0,0,0,5.44,0L30,35.45,43.45,48.88a3.84,3.84,0,0,0,5.44,0,3.87,3.87,0,0,0,0-5.44L35.45,30,48.88,16.58A3.87,3.87,0,0,0,48.88,11.14Z" transform="translate(-10.02 -10.02)" style="fill:#fff"></path></svg>
	</div>
	<div class="js-facebook-messenger-container">
		<div class="js-facebook-messenger-top-header">
			<span><?=$company["ten_$lang"]?></span>
		</div>
		<div class="fb-page" data-href="<?=$company['fanpage']?>" data-tabs="messages" data-small-header="true" data-height="300" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$company['fanpage']?>" class="fb-xfbml-parse-ignore"><a href="<?=$company['fanpage']?>">Facebook</a></blockquote></div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".js-facebook-messenger-box").on("click", function(){
				$(".js-facebook-messenger-box, .js-facebook-messenger-container").toggleClass("open"), $(".js-facebook-messenger-tooltip").length && $(".js-facebook-messenger-tooltip").toggle()
			}), $(".js-facebook-messenger-box").hasClass("cfm") && setTimeout(function(){
				$(".js-facebook-messenger-box").addClass("rubberBand animated")
			}, 3500), $(".js-facebook-messenger-tooltip").length && ($(".js-facebook-messenger-tooltip").hasClass("fixed") ? $(".js-facebook-messenger-tooltip").show() : $(".js-facebook-messenger-box").on("hover", function(){
				$(".js-facebook-messenger-tooltip").show()
			}), $(".js-facebook-messenger-close-tooltip").on("click", function(){
				$(".js-facebook-messenger-tooltip").addClass("closed")
			}))
			$(".search_open").click(function(){
				$(".search_box_hide").toggleClass('opening');
			});
		});
	</script>
<?php } ?>