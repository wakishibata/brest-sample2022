$(function() {

    //ローディング中のタッチイベント定義
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

    //ローディング非表示処理の定義
    function endLoading(){
        console.log('スクロール開始');
        return_scroll();
        console.log('全体を表示');
        $('.l-wrapper').css('visibility', 'visible');
        $('.p-loading__preloader').delay(500).animate({ 'opacity': '0'}, 300);
        $('.p-loading').delay(1000).animate({ 'height': '0px' }, 300, eliminate);
        //ローダーが消えたら実行
        function eliminate() {
            console.log('コンテンツ表示');
            $('.p-loading').remove();
        }
    }

    console.log('ロード開始');

    //全体を非表示
    $('.l-wrapper').css('visibility', 'hidden');
    console.log('全体を非表示');

    //画面のスクロール停止
    no_scroll();
    console.log('スクロール停止');

    //ロード中
    $('body').append('<div class="p-loading"><div class="p-loading__preloader"><div class="loading5Wrap"><div class="loading5_1"></div><div class="loading5_2"></div></div></div></div>');
    console.log('ローディング中');

    //全ての読み込みが完了したら実行
    $(window).on("load", function() {
        console.log('ロード完了');
        setTimeout(endLoading, 3000); //わざと3秒タイマーセットしている
    });

});
