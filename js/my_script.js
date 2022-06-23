jQuery.fn.mousehold = function(timeout, f) {
	if (timeout && typeof timeout == 'function') {
		f = timeout;
		timeout = 100;
	}
	if (f && typeof f == 'function') {
		var timer = 0;
		var fireStep = 0;
		return this.each(function() {
			jQuery(this).mousedown(function() {
				fireStep = 1;
				var ctr = 0;
				var t = this;
				timer = setInterval(function() {
					ctr++;
					f.call(t, ctr);
					fireStep = 2;
				}, timeout);
			})

			clearMousehold = function() {
				clearInterval(timer);
				if (fireStep == 1) f.call(this, 1);
				fireStep = 0;
			}
			
			jQuery(this).mouseout(clearMousehold);
			jQuery(this).mouseup(clearMousehold);
		})
	}
}
function controlProductQty(){
	
	
	$("button.add-cart").unbind("click");
	$("button.add-cart").click(function(){
		p = $(this).parents(".product-qty");
		//doAddCart($(this).data("name"),$(this).data("id"),p.find("input").val());
		return false;	
	})
	
	$(".product-qty .controls button").unbind("mousehold");
	$(".product-qty .controls button").mousehold(function(){
		a = $(this);
		c = $(this).parent().find("input");
		v = parseInt(c.val());
		
		if(a.hasClass("is-up")){
			v++;
		}else{
		v--;
		}
		if(v <1 ){
			v=1; 
		}
		
		c.val(v);
		
	})
}
<!--Nut Back to top-->
$(document).ready(function() {
	controlProductQty();
   setTimeout(function(){
	   $("#pre-loade1r").fadeOut(1000);
   },400);
	

   $(window).scroll(function() {
		if($(window).scrollTop() != 0) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
   });
   
   $('#back-to-top').click(function() {
		$('html, body').animate({scrollTop:0},500);
   });
   
   smoothScrolling();
   function smoothScrolling() { 
	  try {$.browserSelector();
		// Adds window smooth scroll on chrome.
		if ($("html").hasClass("chrome")) {
		  $.smoothScroll();
		}
	  }catch (err) {}	
	}
	
   $('#baophu, .close-popup').live('click',function(){
		$('#baophu, .login-popup').fadeOut(300, function(){
			$('#baophu').remove();
			$('.login-popup').remove();
		});			
	});
});
<!--Nut Back to top-->

<!--Kiểm tra liên hệ-->
function isEmpty(str,text){
		if(str != "") return false;
		if(typeof(text) != 'undefined')	alert(text);		
		return true;
}
function isPhone(str,text){
	var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
	if (vnf_regex.test(str)) 
    {
        return false;
    }
    if(typeof(text)!='undefined') alert(text);
	return true;
}
function isEmail(str, text){
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str))
	  {
	    return (false)
	  }
	    alert(text)
	    return (true)
}
function isSpace(str,text){
	for(var i=0; i < str.length; i++)
	{
		if((str.charAt(i)) == " ")
		{
			if(typeof(text)!='undefined') alert(text);
			return true;
			
		}
	}
	return false;
}
function isCharacters(str,text){ 
	if(str=='') return false;
	var searchReg = /^[a-zA-Z0-9-]+$/;
	if(searchReg.test(str)) {
		return false;
	}
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isRepassword(str,str2,text){
	if(str2=='') return false;
	if(str==str2) return false;
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isCharacterlimit(str,text,intmin,intmax){
	if(str=='') return false;
	intmin = parseInt(intmin);
	intmax = parseInt(intmax);
	
	if(str.length>=intmin && str.length<=intmax)
	{
		return false;
	}
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function add_popup(str){
	$('body').append('<div class="login-popup"><div class="close-popup"></div><div class="popup_thongbao"><p class="tieude_tb">Thông báo</p><p class="popup_kq">'+str+'</p></div></div>');
	$('.thongbao').html('');
	$('.login-popup').fadeIn(300);
	$('.login-popup').width($('.popup_thongbao').width()+'px')
	var chieurong = $('.login-popup').width() /2;
	$('.login-popup').css({width:$('.popup_thongbao').width()+'px','margin-left':-chieurong,top:-100+'px'});
	$('.login-popup').animate({top:100+'px'},500);
	$('body').append('<div id="baophu"></div>');
	$('#baophu').fadeIn(300);
	return false;
}
<!--Kiểm tra liên hệ-->	
