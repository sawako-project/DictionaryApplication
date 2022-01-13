$(function(){

    //scroll event
    $(window).on("scroll", function(){

        var scrollY = $(window).scrollTop();
        
        if(scrollY == 0){
          $("body").removeClass("scrolled");
        }else{
          $("body").addClass("scrolled");
        }

    });

    //smooth scroll
    $('a[href^="#"]').on("click", function(){/** "#preloader"*/

        let speed = 500;
        let href= $(this).attr("href");
        let target = $(href == "#" || href == "" ? 'html' : href);
        let position = target.offset().top;

        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });

    //
    $('#datetimepicker1').datetimepicker();

});

$(function(){

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});

// glowAnimeにglowというクラス名を付ける定義
function GlowAnimeControl() {

    $('.glowAnime').each(function () {

        var elemPos = $(this).offset().top - 50;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll >= elemPos - windowHeight) {
          $(this).addClass("glow");

        } else {
          $(this).removeClass("glow");
        }
    });
}

// 画面をスクロールをしたら動かしたい場合の記述
$(window).on('scroll',function () {
    GlowAnimeControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {

    //spanタグを追加する
    var element = $(".glowAnime");
    element.each(function () {

        var text = $(this).text();
        var textbox = "";
        text.split('').forEach(function (t, i) {

            if (t !== " ") {

                if (i < 10) {
                  textbox += '<span style="animation-delay:.' + i + 's;">' + t + '</span>';
                } else {
                var n = i / 10;
                  textbox += '<span style="animation-delay:' + n + 's;">' + t + '</span>';
                }
                } else {
                textbox += t;
            }
        });

        $(this).html(textbox);
    });

    GlowAnimeControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述