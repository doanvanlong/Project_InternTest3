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
            <div class="form-login">
                <div class="p-30">
                    <form id="validate" class="form" method="post" onsubmit="summ();return false;">
                       <div class="logo_login"><img src="images/logo_danangweb.png" alt="danangweb" ></div>
                        <div class="form-login-content">
                            <fieldset id="inputs">
                                <input type="text" name="username" autocomplete="off" required="required" id="username" placeholder="Nhập username" />
                                <input type="password" id="password" name="password" required="required" id="pass" placeholder="******" />
                            </fieldset>
                             <fieldset id="actions">      
                                <input type="submit" value="Đăng nhập" class="dredB logMeIn" />
                                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                                <div id="loginError">
                                </div>
                            </fieldset>

                            <a href="javascript:void(0)" id="forgetPass">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>    
                
            <div class="info_login" >
                <div class="info_login_bg_color">
                    <div class="info_login_txt">
                         <div class="login_txt_title">LIÊN HỆ VỚI CÔNG TY ĐÀ NẴNG WEB</div> 

                        <div class="login_txt_item">
                            <div class="login_txt_tt">
                                Văn Phòng Đà Nẵng
                            </div>
                            <p>Hotline: (+84) 905 43 02 43</p>
                            <p>Địa chỉ: 121 Đặng Huy Trứ, Phường Hòa Minh, Quận Liên Chiểu, TP. Đà Nẵng</p>
                        </div>
                        <div class="login_txt_item">
                            <div class="login_txt_tt">
                                Văn Phòng TP Hồ Chí Minh
                            </div>
                            <p>Hotline: (+84) 818 9999 43</p>
                            <p>Địa chỉ: Tầng 3, Tòa Nhà SBI, Công Viên Phần Mềm Quang Trung, Phường Tân Chánh</p> 
                        </div> 
                    </div>
                 </div>
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
    $('#forgetPass').click(function(){
        var html = '<div>';
        html +=' <p class="txt-forget-pass">Xin vui lòng gởi mail về địa chỉ <br /><strong> <i class="fa fa-envelope"></i> info@danangweb.vn</strong><br /> hoặc  gọi <i class="fa fa-phone"></i> <strong>0905 43 02 43</strong> <br /> để lấy lại mật khẩu.</p> '
        html += '<a href="http://<?=$config_url?>/danang" class="txt_center pt-15"><i class="fa fa-arrow-left"></i>  Quay lại</a>';
        html += '</div>';
        $('.form-login-content').html(html);
    });
    
});

</script>
<style>
html, body
{
    height: 100%;
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
    display: block;
    padding: 15px 0px 0px;
    font-size: 14px;
    line-height: 20px;
    text-decoration: underline;
    text-align:center;
 }
 .txt-forget-pass{
     font-size: 18px;
    line-height: 30px;
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
 .w_login{
    display: flex;
    width: 70%;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
     height: 500px;
}
.p-30{
    padding: 30px;
}
.pt-15{
    padding-top: 15px;
}
.info_login{
    height: 100%;
    width: 42%; 
    background-image: url('images/dnw.png');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;
}
.info_login_bg_color{
    background: rgba(59,72,77,0.7);
    width: 100%;
    height: 100%; 
    display: flex;
    justify-content: center;
    align-items: center;
}
.info_login_txt{
    position: relative;
    color: #fff;
    padding: 30px 30px 30px 80px;
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
}
.login_txt_item{
    margin-bottom: 40px;
    
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
    width: 58%;
    z-index: 0;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;  
    display: flex;
    justify-content: center;
    align-items: center;
    
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
    text-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0px 2px 0 rgba(0, 0, 0, .5);
    text-transform: uppercase;
    text-align: center;
    color: #666;
    margin: 0 0 30px 0;
    letter-spacing: 4px;
    font: normal 26px/1 Verdana, Helvetica;
    position: relative;
}
 
h1:after, h1:before
{
    background-color: #777;
    content: "";
    height: 1px;
    position: absolute;
    top: 15px;
    width: 120px;   
}
 
h1:after
{ 
    background-image: -webkit-gradient(linear, left top, right top, from(#777), to(#fff));
    background-image: -webkit-linear-gradient(left, #777, #fff);
    background-image: -moz-linear-gradient(left, #777, #fff);
    background-image: -ms-linear-gradient(left, #777, #fff);
    background-image: -o-linear-gradient(left, #777, #fff);
    background-image: linear-gradient(left, #777, #fff);      
    right: 0;
}
 
h1:before
{
    background-image: -webkit-gradient(linear, right top, left top, from(#777), to(#fff));
    background-image: -webkit-linear-gradient(right, #777, #fff);
    background-image: -moz-linear-gradient(right, #777, #fff);
    background-image: -ms-linear-gradient(right, #777, #fff);
    background-image: -o-linear-gradient(right, #777, #fff);
    background-image: linear-gradient(right, #777, #fff);
    left: 0;
}
 
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
    background: #f1f1f1 url(images/login-sprite.png) no-repeat;
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
	background: #f1f1f1 url(images/login-sprite.png) no-repeat 5px -2px !important;
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
    margin: 10px 0 0 0;
    text-align:center;
}
 
input[type="submit"]
{       
    background-color: #3c4a4f;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#3c4a4f), to(#3c4a4f));
    background-image: -webkit-linear-gradient(top, #3c4a4f, #3c4a4f);
    background-image: -moz-linear-gradient(top, #3c4a4f, #3c4a4f);
    background-image: -ms-linear-gradient(top, #3c4a4f, #3c4a4f);
    background-image: -o-linear-gradient(top, #3c4a4f, #3c4a4f);
    background-image: linear-gradient(top, #3c4a4f, #3c4a4f);
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
     -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
     -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
     box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
    border-width: 1px;
    border-style: solid;
    border-color: #fff #fff #fff #fff;
    float: unset;
    height: 35px !important;
    padding: 0;
    width: 120px;
    cursor: pointer;
    font: bold 15px Arial, Helvetica;
    color: #fff;
	box-sizing:content-box;
}
 input[type="submit"]:hover,input[type="submit"]:focus{
    background-color: #17a2b8;
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
</style>
<!-- Main content wrapper -->
