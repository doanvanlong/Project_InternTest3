﻿var loading = false;
var url = "";
function loadtrang(vitri, order, namedm) {
  if (loading) return false;
  loading = true;
  url = "san-pham/" + namedm;
  if (vitri > 1) url += "&p=" + vitri;
  $.ajax({
    url: "ajax/sanphamindex.php",
    data: { order: order, vitri: vitri },
    type: "GET",
    async: true,
    success: function (res) {
      $("#show_product").html(res);
      var currentState = { html: res, title: $("#q_title").html() };
      document.title = currentState.title;
      $("meta[name='keywords']").attr("content", $("#q_keywords").html());
      $("meta[name='description']").attr("content", $("#q_description").html());
      if (history.pushState) history.pushState(currentState, "", url);
      loading = false;
      activeLi();
    },
  });
}
//Đoạn javascript sau giúp xử lý khi người dùng vào trang bằng url:
function activeLi() {
  var url = window.location.href;

  var ar = url.split("/");
  if (ar.length < 4) {
    $(".ul_tab li").removeClass("act");
    $(".ul_tab li:first-child").addClass("act");
  } else if (ar.length == 5) {
    //cấp 1,xét trường hợp phân trang có &
    $(".ul_tab li").removeClass("act");
    var index = ar[4].indexOf("&");
    if (index > 0) {
      ar[4] = ar[4].substring(index, 0);
    }
    $(".li-parent-" + ar[4]).addClass("act");
  }
}
// Cuối cùng là xử lý khi người dùng click vào nút BACK hoặc FORWARD, sử dụng sự kiện onpopstate:

window.onpopstate = function (e) {
  if (e.state) {
    // dùng state để gán lại cho div dcp và title của document
    $("#show_product").html(e.state.html);
    document.title = e.state.title;
    $("meta[name='keywords']").attr("content", $("#q_keywords").html());
    $("meta[name='description']").attr("content", $("#q_description").html());
  } else {
    $(".ul_tab li").first().click();
  }
  activeLi();
};
function sticky_menu(menu, sticky) {
  if (typeof sticky === "undefined" || !jQuery.isNumeric(sticky)) sticky = 0;
  if ($(window).scrollTop() >= sticky) {
    if ($("#just-for-height").length === 0) {
      menu.after(
        '<div id="just-for-height" style="height:' +
          menu.height() +
          'px"></div>'
      );
    }
    menu.addClass("sticky");
  } else {
    menu.removeClass("sticky");
    $("#just-for-height").remove();
  }
}
$(document).ready(function () {
  if ($(window).width() > 992) {
    var menu = $(".menu_main");
    var sticky = menu.offset().top + 1;
    sticky_menu(menu, sticky);
    $(window).on("scroll", function () {
      sticky_menu(menu, sticky);
    });
  }
  $(".item_sp_left i.fa-plus").click(function () {
    id = $(this).data("id");
    if ($(".item_sp_left_" + id).hasClass("active")) {
      $(".item_sp_left_" + id).removeClass("active");
    } else {
      $(".item_sp_left_" + id).addClass("active");
    }
  });

  $("#icon_search").click(function () {
    if ($("#search").hasClass("action")) {
      $("#search").removeClass("action");
    } else {
      $("#search").addClass("action");
    }
  });

  //menu mobi
  $(".action_menu").click(function () {
    if ($("#menu_mobi").hasClass("h-100")) {
      $(".shop_cart").show();
      $("#menufooter .action_menu").removeClass("active");
      $("#menu_mobi").removeClass("h-100");
    } else {
      $(".shop_cart").hide();
      $("#menufooter .action_menu").addClass("active");
      $("#menu_mobi").addClass("h-100");
    }
  });
  $("#menu_mobi .fa").click(function () {
    if ($(this).parent().hasClass("active2")) {
      $(this).parent().removeClass("active2");
    } else {
      $(this).parent().addClass("active2");
    }
  });

  $(".parent-cat").click(function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    } else {
      $(".parent-cat").removeClass("active");
      $(this).addClass("active");
    }
  });

  $(".ul_tab li").first().addClass("act");
  $(".click").click(function (e) {
    $(".ul_tab li").removeClass("act");
    $(this).addClass("act");
    var order = $(this).data("order");
    var namedm = $(this).data("namedm");
    vitri = 1;
    loadtrang(vitri, order, namedm);
  });
  $(document).on("click", ".bam", function () {
    vitri = $(this).attr("vitri");
    if (vitri != "noactive") {
      //alert(vitri);
      var order = $(".ul_tab li.act").data("order");
      var namedm = $(".ul_tab li.act").data("namedm");
      loadtrang(vitri, order, namedm);
    }
  });

  $("#slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots: true,
    arrows: true,
    fade: true,
    cssEase: "linear",
    nextArrow: '<div class="myarrow next" aria-hidden="true"></div>',
    prevArrow: '<div class="myarrow prev" aria-hidden="true"></div>',
    autoplaySpeed: 3500,
  });
  $("#slider-mobi").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots: true,
    arrows: true,
    fade: true,
    cssEase: "linear",
    nextArrow: '<div class="myarrow next" aria-hidden="true"></div>',
    prevArrow: '<div class="myarrow prev" aria-hidden="true"></div>',
    autoplaySpeed: 3500,
  });

  $(".sl_sanpham").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    nextArrow:
      '<div class="myarrow1 next" aria-hidden="true"><i class="fa fa-angle-right"></i></div>',
    prevArrow:
      '<div class="myarrow1 prev" aria-hidden="true"><i class="fa fa-angle-left"></i></div>',
    autoplaySpeed: 4000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 460,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 360,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $(".sl_news").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    arrows: true,
    nextArrow:
      '<div class="myarrow1 next" aria-hidden="true"><i class="fa fa-angle-right"></i></div>',
    prevArrow:
      '<div class="myarrow1 prev" aria-hidden="true"><i class="fa fa-angle-left"></i></div>',
    autoplaySpeed: 4000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $(".slider-main").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".slider-sub",
  });
  $(".slider-sub").slick({
    infinite: false,
    slidesToShow: 6,
    slidesToScroll: 1,
    asNavFor: ".slider-main",
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    arrows: true,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        },
      },
      {
        breakpoint: 460,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        },
      },
      {
        breakpoint: 360,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  });
  $(".sl_album").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dots: false,
    arrows: true,
    fade: true,
    cssEase: "linear",
    autoplaySpeed: 3500,
  });
  $(".slick_marquee").slick({
    speed: 10000,
    autoplay: true,
    autoplaySpeed: 0,
    centerMode: true,
    cssEase: "linear",
    slidesToShow: 1,
    slidesToScroll: 1,
    variableWidth: true,
    infinite: true,
    initialSlide: 1,
    arrows: false,
    buttons: false,
  });
 
  
  $(".sl_doitac").slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    control: false,
    arrows: false,
    dots: false,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 360,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $(".slick_video_index").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    dots: false,
    arrows: false
  });
  $(".sl_ykien").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    dots: true,
    arrows: false,
    autoplaySpeed: 4000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
        },
      },
      {
        breakpoint: 460,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
        },
      },
      {
        breakpoint: 360,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
        },
      },
    ],
  });
});
