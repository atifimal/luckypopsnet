$(window).on('load', function () {
    $('.preloader-top-1').css('animation', 'preloader-top 0.7s 1 normal forwards');
    $('.preloader-top-2').css('animation', 'preloader-top 1s 1 normal forwards');
    $('.preloader-bottom-1').css('animation', 'preloader-bottom 0.7s 1 normal forwards');
    $('.preloader-bottom-2').css('animation', 'preloader-bottom 1s 1 normal forwards');
    setTimeout(function () {
        $('.preloader-main').css('display', 'none');
    }, 1200);

});

$('document').ready(function () {
    $('.menu-div .menu-item, .site-logo').on('click', function () {
        if ($(this).hasClass('menu-java'))
            cls = "java";
        else if ($(this).hasClass('menu-front'))
            cls = "frontend";
        else if ($(this).hasClass('menu-notes'))
            cls = "notes";
        else if ($(this).hasClass('menu-download'))
            cls = "download";
        else if ($(this).hasClass('menu-about'))
            cls = "about";
        else if ($(this).hasClass('site-logo'))
            cls = "/";
        $('.preloader-main').css('display', 'block');
        $('.preloader-top-1').css('animation', 'preloader-top 1s 1 reverse forwards');
        $('.preloader-top-2').css('animation', 'preloader-top 0.7s 1 reverse forwards');
        $('.preloader-bottom-1').css('animation', 'preloader-bottom 1s 1 reverse forwards');
        $('.preloader-bottom-2').css('animation', 'preloader-bottom 0.7s 1 reverse forwards');
        setTimeout(function () {
            window.location.href = cls;
        }, 1200);
    });

})