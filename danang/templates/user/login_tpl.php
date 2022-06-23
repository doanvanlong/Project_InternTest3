<?php 

if(isset($_SESSION[$login_name]) && $_SESSION[$login_name]==true && $act=="login"){
        redirect("index.php");
    }
 ?>
 <!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Xem Website</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

        <div class="w_login">
        <div class="w_login_bg">
            <div class="form-login">
                <div class="wform p-30">
                    <form id="validate" class="form" method="post" onsubmit="summ();return false;">
                       <h1>Đăng nhập</h1>
                       <p class="txt_dambao">Hãy đảm bảo rằng bạn đang truy cập URL chính xác</p>
                       <div class="txt_center">
                           <a href="http://<?=$config_url?>/danang" class="button_dambao"><?=$config_url?>/<span>danang</span></a>
                       </div>
                        <div class="form-login-content">
                            <fieldset id="inputs">
                                <input type="text" name="username" autocomplete="off" required="required" id="username" placeholder="Nhập username" />
                                <div class="form-gr">
                                    <input type="password" id="password" name="password" required="required"  placeholder="******" />
                                    <i class="fa fa-eye-slash" id="showPass"></i>
                                </div>
                                
                            </fieldset>
                             <fieldset id="actions">      
                                <input type="submit" value="Đăng nhập" class="dredB logMeIn" />
                                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                                <div id="loginError">
                                </div>
                            </fieldset>
                        <div class="txt_bottom">
                            <a href="javascript:void(0)" id="forgetPass" >Quên mật khẩu?</a>
                            <a href="http://<?=$config_url?>" title="" target="_blank"><span>Xem Website </span><i class="fa fa-share"></i></a>
                        </div>
                            
                        </div>
                    </form>
                </div>
            </div>    
                
            <div class="info_login" >
                <div class="info_login_bg_color">
                    <div class="info_login_txt">
                         <div class="login_txt_title">LIÊN HỆ VỚI CÔNG TY ĐÀ NẴNG WEB</div> 

                        <div class="login_txt_item">
                            <div class="login_txt_tt">VP Miền Trung</div>
                            <p>121 Đặng Huy Trứ, Phường Hòa Minh, Quận Liên Chiểu, Thành phố Đà Nẵng, Việt Nam</p>
                        </div>
                        <div class="login_txt_item">
                            <div class="login_txt_tt">VP Miền Nam</div>
                            <p>Tầng 3, số 21 Nguyễn Hiến Lê, Quận Tân Bình, TP.HCM</p> 
                        </div>
                        <div class="login_txt_item">
                            <div class="login_txt_tt">VP Miền Bắc</div>
                            <p>Tầng 2, tòa nhà CT2A, Cổ Nhuế 1, Bắc Từ Liêm, Hà Nội</p> 
                        </div> 
                        <div class="login_txt_item">
                            <div class="login_txt_tt">Contact</div>
                            <p>Điện thoại: 0905 43 02 43  – Fax : 02363.430243</p> 
                            <p>Email: info@danangweb.vn</p> 
                        </div> 
                    </div>
                 </div>
            </div>
        </div>
        <?php 

            $ar_logo = array(
                array('https://danangweb.com.vn/','dnw_website','danangweb'), 
                array('https://danangseo.vn/','dnw_seo','danangweb seo'), 
                array('https://dananggoogle.com/','dnw_google','danangweb google'), 
                array('https://danangfacebook.com/','dnw_facebook','danangweb facebook'), 
                array('https://dananghost.com/','dnw_hosting','danangweb hosting'), 
                array('https://danangapp.com/','dnw_app','danangweb app'), 
                array('https://danangdesign.com/','dnw_design','danangweb design'), 
                array('https://danangemail.com/','dnw_email','danangweb email'), 
            );

         ?>
        <div id="slider_logo">
            <?php foreach ($ar_logo as $logo) {?>
                <div class="logo_item">
                    <a href="<?=$logo[0]?>" target="_blank">
                        <img src="images/logoweb/<?=$logo[1]?>.png" alt="<?=$logo[2]?>">
                    </a>
                </div>
            <?php } ?>
        </div>
        </div>


<script>

function summ(){
	var email = jQuery('#username').val();
		var pass = jQuery('#password').val();
		if (email && pass)
		{
			$('.ajaxloader').css('display', 'block');
			jQuery.ajax({
				type: 'POST',
				url: baseurl + 'ajax.php?do=admin&act=login',
				data: {'pass':pass, 'email':email},
				success: function(data) {
					var myObject = eval('(' + data + ')');
					$('.ajaxloader').css('display', 'none');
					
					if (myObject['page'])
					{
						window.location=myObject['page'];
						//location.reload();
					}
					else if (myObject['mess'])
					{
						jQuery('#loginError').css('display', 'block');
						jQuery('#loginError').html(myObject['mess']);
					}
				}
			});
		}
		else {
			return true;
		}
		return false;
}
$(document).ready(function(e) {
    $('#showPass').on('click',function(){
        if($(this).hasClass('fa-eye-slash')){
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('#password').attr('type','text');
        }else{
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('#password').attr('type','password');
        }
    });

    $('#forgetPass').click(function(){
        var html = '<div>';
        html +=' <p class="txt-forget-pass">Xin vui lòng gởi mail về địa chỉ <br /><strong> <i class="fa fa-envelope"></i> info@danangweb.vn</strong><br /> hoặc  gọi <i class="fa fa-phone"></i> <strong>0905 43 02 43</strong> <br /> để lấy lại mật khẩu.</p> '
        html += '<div class="txt_bottom">\
                    <a href="http://<?=$config_url?>/danang" ><i class="fa fa-arrow-left"></i>  Quay lại</a>\
                    <a href="http://<?=$config_url?>" title="" target="_blank"><span>Xem Website </span><i class="fa fa-share"></i></a>\
                </div>';
        html += '</div>';
        $('.form-login-content').html(html);
    });
    
});

</script>
<link href="../css/slick.css" type="text/css" rel="stylesheet" />
<link href="../css/slick-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../js/slick.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

        $('#slider_logo').slick({
            slidesToShow: 5, 
            slidesToScroll: 1,
            autoplay:true,
            dots:false,
            arrows:true,
            nextArrow: '<div class="myarrow next" aria-hidden="true"></div>',
            prevArrow: '<div class="myarrow prev" aria-hidden="true"></div>',
            autoplaySpeed: 2500,
            responsive: [
            {
                  breakpoint: 1200,
                  settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                  }
                },
               
                {
                  breakpoint: 768,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 460,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                     dots:true,
                  }
                },
                {
                  breakpoint: 360,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                     dots:true,
                  }
                }
              ]
        });

});
</script>
<style>
html, body
{
    height: 100%;
}
.nobg{
    background: rgba(23,164,186,0.01) !important;
} 
body
{
    font: 12px Arial, 'Lucida Sans Unicode', 'Trebuchet MS', Helvetica;    
    margin: 0;
    background-color: #d9dee2;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebeef2), to(#d9dee2));
    background-image: -webkit-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -moz-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -ms-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -o-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: linear-gradient(top, #ebeef2, #d9dee2);    
}
.userNav ul li{
    float: unset !important;
    text-align: center;
    font-size: 15px;
}
 #forgetPass{
    
 }
 .txt_bottom{
    display: block;
    padding: 15px 0px 0px;
    font-size: 14px;
    line-height: 20px;
    text-align:center;
    display: flex;
    justify-content: space-between;
 }
.txt_bottom a{
    color: #999999;
 }
.txt-forget-pass{
     font-size: 14px;
    line-height: 25px;
    font-weight: 400;
    text-align:center;
    height: 158px;
 }
 .txt_center{
    text-align: center;
    display: block;
    font-size: 14px;
     line-height:20px;
     text-decoration: underline;
 }
/*--------------------*/
.topNav{display: none !important;}
 .w_login{
    width: 80%;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    
    
}
.w_login_bg{
    height: 500px;
    box-shadow: -2px 0px 9px #ccc;
    display: flex;
}
.p-30{
    padding: 30px;
}
.pt-15{
    padding-top: 15px;
}
.info_login{
    height: 100%;
    width: 55%; 
    background-image: url('images/dnw.png');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;
}
.info_login_bg_color{
    background: rgba(9,56,64,0.4);
    width: 100%;
    height: 100%; 
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.info_login_txt{
    position: relative;
    color: #fff;
    padding: 20px 0px;
}

.p-30{
    padding: 30px;
    position: relative;
}
.login_txt_title{
    text-transform: uppercase;
    font-weight: 700;
    margin-bottom: 40px;
    font-size: 18px;
    line-height: 24px;
    padding-left: 80px;
}
.login_txt_item{
    margin-bottom: 10px;
    padding-left: 80px;
}
.login_txt_tt{
   font-weight: 700; 
   font-size: 16px;
    line-height: 30px;
    position: relative;

}
.login_txt_tt::after{
    content: '';
    position: absolute;
    left: -20px;
    top:10px;
    width: 10px;
    height: 10px;
    border-radius: 100%;
    background: #fff;
          
}
.login_txt_tt::before{
    content: '';
    position: absolute;
    left: -80px;
    top:13px;
    width: 65px;
    height: 4px;
    background: #fff;
}
.login_txt_item p{
    font-size: 14px;
    line-height: 20px; 
    padding-top: 8px;
}
.logo_login{
    text-align: center;
    margin-bottom: 30px;
}
.logo_login img{
    max-height: 80px;
    max-width: 100%;
}
.form-login
{
    height: 100%;
    background-color: #fff;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));
    background-image: -webkit-linear-gradient(top, #fff, #eee);
    background-image: -moz-linear-gradient(top, #fff, #eee);
    background-image: -ms-linear-gradient(top, #fff, #eee);
    background-image: -o-linear-gradient(top, #fff, #eee);
    background-image: linear-gradient(top, #fff, #eee);  
    width: 45%;
    z-index: 0;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;  
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.wform{
    width: 400px;
}
 #validate{
 }
#login:before
{
    content: '';
    position: absolute;
    z-index: -1;
    border: 1px dashed #ccc;
    top: 5px;
    bottom: 5px;
    left: 5px;
    right: 5px;
    -moz-box-shadow: 0 0 0 1px #fff;
    -webkit-box-shadow: 0 0 0 1px #fff;
    box-shadow: 0 0 0 1px #fff;
}
 
/*--------------------*/
 
h1
{
    text-transform: uppercase;
    text-align: center;
    color: #333;
    margin-bottom: 10px;
    font: normal 26px/1 Verdana, Helvetica;
    position: relative;
    font-weight: 700;
    font-size: 20px;
}
.txt_dambao{
    text-align: center;
    padding: 10px 0px 20px;
    font-size: 14px;
    color: #999;
}

.button_dambao{
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 14px;
    display: inline-block;
    margin: 0 auto 20px;
    color: #00C777;
}
.button_dambao span{color: #222;}
/*--------------------*/
 
fieldset
{
    border: 0;
    padding: 0;
    margin: 0;
}
 
/*--------------------*/
 input#username{ }
#inputs input
{
    background: #f1f1f1 ;
    padding: 15px 15px 15px 30px !important;
    margin: 0 0 10px 0 !important;
    border: 1px solid #ccc !important;
    -moz-border-radius: 5px !important;
    -webkit-border-radius: 5px !important;
    border-radius: 5px !important;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff !important;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff !important;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff !important;
	box-sizing:border-box;
}
 
input#username
{
	background: #f1f1f1;
}
 
#password
{
    background-position: 5px -52px !important;
}
 
#inputs input:focus
{
    background-color: #fff !important;
    border-color: #e8c291;
    outline: none;
    -moz-box-shadow: 0 0 0 1px #e8c291 inset;
    -webkit-box-shadow: 0 0 0 1px #e8c291 inset;
    box-shadow: 0 0 0 1px #e8c291 inset;
}
 #loginError, #echoMessage {
    display: none;
    text-align: center;
    background: #000;
    color: #fff;
    border-radius: 2px;
    height: 30px;
    margin-top: 30px;
    line-height: 30px;
}
/*--------------------*/
#actions
{
    text-align:center;
}
 
input[type="submit"]
{       
    background-color: #17a2b8;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 5px;
    height: 48px;
    max-height: 48px;
    padding: 10px;
    width: 100%;
    cursor: pointer;
    font: bold 15px Arial, Helvetica;
    color: #fff;
}
 input[type="submit"]:hover,input[type="submit"]:focus{
    background-color: #138496;
    transition: all 0.3s ease-in-out;
}
#submit:hover,#submit:focus
{       
    background-color: #fddb6f;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ffb94b), to(#fddb6f));
    background-image: -webkit-linear-gradient(top, #ffb94b, #fddb6f);
    background-image: -moz-linear-gradient(top, #ffb94b, #fddb6f);
    background-image: -ms-linear-gradient(top, #ffb94b, #fddb6f);
    background-image: -o-linear-gradient(top, #ffb94b, #fddb6f);
    background-image: linear-gradient(top, #ffb94b, #fddb6f);
}   
 
#submit:active
{       
    outline: none;
    
     -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;        
}
 
#submit::-moz-focus-inner
{
  border: none;
}
 
#actions a
{
    color: #3151A2;    
    float: right;
    line-height: 35px;
    margin-left: 10px;
}
.list_logo{
    display: flex;justify-content: center;padding-top: 40px;
}
#slider_logo{
    padding: 30px;
}
.logo_item{
    padding: 10px 15px;
}
.logo_item img{
    width: 100%;
}
.myarrow.prev{left: -10px;}
.myarrow.next{right: -10px;}
.myarrow::after, .myarrow::before{width: 20px;background: #A5A6A6;}
.slick-dots li button:before{width: 8px;height: 8px;}
@media only screen and (max-width:600px) {
    .myarrow.next{right: 0 !important}
    .myarrow.prev{left: 0 !important}
}
</style>
<!-- Main content wrapper -->
