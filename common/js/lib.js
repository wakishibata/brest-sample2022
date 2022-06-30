
//タッチイベント定義
function scroll_control(event) {
    event.preventDefault();
}
function no_scroll(){
    document.addEventListener("mousewheel", scroll_control, {passive: false});
    document.addEventListener("touchmove", scroll_control, {passive: false});
}
function return_scroll(){
    document.removeEventListener("mousewheel", scroll_control, {passive: false});
    document.removeEventListener('touchmove', scroll_control, {passive: false});
}

//グランドナビ
$(function() {
    $(".js-trigger").removeClass('is-active');
    $('.l-gnav').css('display', 'none');
    $(".js-slidein").removeClass('is-active');
    return_scroll();

    $(".js-trigger").click(function() {
        if ($(this).hasClass('is-active')) {
            $(this).removeClass('is-active');
            $('.l-gnav').fadeOut(300);
            $(".js-slidein").removeClass('is-active');
            return_scroll();
        } else {
            $(this).addClass('is-active');
            $('.l-gnav').fadeIn(100);
            $(".js-slidein").each(function(i) {
                setTimeout(function() {
                    $(".js-slidein").eq(i).addClass("is-active");
                }, 100 * i);
            });
            no_scroll();
        }
        return false;
    });

    $(".l-gnav__wrap").click(function() {
        $(".js-trigger").removeClass('is-active');
        $('.l-gnav').fadeOut(300);
        $(".js-slidein").removeClass('is-active');
        return_scroll();
        return false;
    });

});

//トグル表示
$(window).on('load orientationchange resize', function() {
  hsize = $(window).height();
  $(".js-fullscreen").css("height", hsize);
  $('.js-fullscreen').prepend('<div class="l-gnav__wrap"></div>');
});

//pagetop表示
$(function() {
    var pageTop = $('.js-pagetop');
    pageTop.fadeOut();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            pageTop.fadeIn();
        } else {
            pageTop.fadeOut();
        }
    });
    pageTop.click(function() {
        $('body, html').animate({ scrollTop: 0 }, 500, 'swing');
        return false;
    });
});

//トグル表示
$(function() {
    $(".js-toggle-body").fadeOut();
    $(".js-toggle").click(function() {
      $(this).children('.js-toggle-arr').toggleClass('is-active');
      $(this).next('.js-toggle-body').slideToggle();
      return false;
    });
});