<script type="text/javascript">
	
	function colorStar(star){
		$('.stars_select a').css('color','#ddd');
		for (var i = 1; i <= 5; i++) {
			if(i<=star){
				$('.stars_select a.star-'+i).css('color','#F5A623');
			}
		}
	}

	$(document).ready(function() {
		$("#noidung_danhgia").keydown(function(event) {
			var dem = $(this).val();
			dem = parseInt(dem.length);
			$("#countContent").html(dem+" ký tự (Tối thiểu 10)");
		});
		$('.goDanhGia').on('click',function(){
			$('html, body').animate({scrollTop: $("#tabs").offset().top - 80});
			$(".nav_danhgia").click();

		});

		colorStar(5);

		$('.stars_select a').mouseenter(function(){

			var star = $(this).data('star');
			colorStar(star);

		}).mouseleave(function(){ 

			let star = $('.stars_select a.active').data('star');
			colorStar(star);

		});

		$('.stars_select a').on('click',function(){

			if(!$(this).hasClass('active')){

				$(this).siblings().removeClass('active');
				$(this).addClass('active');
				let star = $(this).data('star');
				$('#sao_danhgia').val(star);
				colorStar(star);

			}

			return false;
		});

	});
	function checkCountImg(){
		var count = $('.attach_view li').length;
		if(count < 3){
			$(".insert_attach").show();
		}else{
			$(".insert_attach").hide();
		}
	}
	function readURL(input,idImg) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        if(input.files[0].size > 4096000) {
		        alert("Hình ảnh quá lớn. Chỉ những ảnh <= 4 KB được phép tải lên");
		        $('#li_files_'+idImg).remove();
		        $(".insert_attach").show();
		        return false;
		    }else{
		    	reader.onload = function(e) {
		            $('#li_files_'+idImg+' img').attr('src',e.target.result);
		            $('#li_files_'+idImg).removeClass('d-none');
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
	    }
	}
	function ImgUpload1(){
		if($('.attach_view li').length <3 ){


			var imgWrap = $('.attach_view');

			var idImg = Math.round(Date.now());

			var html = '';

			html += '<li id="li_files_'+idImg+'" class="d-none">';
				html += '<div class="img-wrap">';
					html += '<span class="img-wrap-close" data-id="'+idImg+'"></span>';
					html += '<div class="img-wrap-box">';
						html += '<img src="" class="thumb" data-id="" />';
					html += '</div>';
				html += '</div>';
				html += '<div class="'+idImg+'">';
					html += '<input type="file" name="files_danhgia[]" id="files_danhgia_'+idImg+'" accept="image/jpeg, image/png, image/gif, image/x-png" />';
				html += '</div>';
			html += '</li>';

			imgWrap.append(html);


			$('#files_danhgia_'+idImg).click();

			$('#files_danhgia_'+idImg).on('change',function(){

				readURL(this,idImg);

			});

		}else{

			alert("Chỉ cho phép tải lên 3 ảnh");

		}
	}
	$(document).ready(function(){ 

			$('.btn_insert_attach').on('click' , function(){
				checkCountImg();
				ImgUpload1();
				checkCountImg();
			});

			$('.img-wrap-close').live('click',function(){
				var itemRemove = $(this).data('id');
				$('#li_files_'+itemRemove).remove();
				checkCountImg();
			});

            $('.frm_danhgia').on('submit', function(e){
                e.preventDefault();
                if(isEmpty($('#noidung_danhgia').val(),"<?=_nhapnoidung?>")){
					$('#noidung_danhgia').focus();
					return false;
				}
				var dem = $('#noidung_danhgia').val();
				dem = parseInt(dem.length);
				if(dem<10){
					alert("Nhập nội dung hơn 10 ký tự");
					$('#noidung_danhgia').focus();
					return false;
				}

			  	if(isEmpty($('#ten_danhgia').val(),"<?=_nhaphoten?>")){
					$('#ten_danhgia').focus();
					return false;
				}

				if(isEmpty($('#sodienthoai_danhgia').val(),"<?=_nhapsodienthoai?>")){
					$('#sodienthoai_danhgia').focus();
					return false;
				}

				if(isPhone($('#sodienthoai_danhgia').val(),"<?=_sodienthoaikhonghople?>")){
					$('#sodienthoai_danhgia').focus();
					return false;
				}

                $.ajax({
                    url : "ajax/comment.php",
                    type : "post",
                    data : new FormData(this),
                    contentType:false,
                    processData:false,
                    success: function(data){
                       	 $("#mydanhgia").modal('hide');
                       	$("#danhgia_result").modal('show');
                       	countdownDG();
                        $(".text_danhgia_result").html(data);
                        $("#noidung_danhgia").val("");
                        $(".attach_view").html("");
                        $(".insert_attach").hide();
                        $("#ten_danhgia").val("");
                        $("#sodienthoai_danhgia").val("");
                        $("#email_danhgia").val("");
                        $("#sao_danhgia").val("5");
                        $('.stars_select a.star-5').click();
                    }
                });

            });
        });

	var setTimeDG = 3;
	function countdownDG(){
		const intervalDG = setInterval(function(){
			
			if(setTimeDG==0){

				dongModal();

				clearInterval(intervalDG);

				setTimeDG = 3;

				<?php /* ?>$('#second_danhgia_end').html('3');<?php */ ?>

			}else{
				setTimeDG = setTimeDG-1;

				<?php /* ?>return  $('#second_danhgia_end').html(setTimeDG);<?php */ ?>
			}
		},1000);
	}
</script>