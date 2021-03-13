<div>
    <img class="site-logo" id="logo-back" src="../assets/img/lucky-logo.png" style="opacity: 0;">
    <img class="site-logo" id="logo-mid" src="../assets/img/text.png" style="display: none;">
    <img class="site-logo" id="logo-front" src="../assets/img/lucky-logo-cubes.png">
</div>
<script>
    $('.site-logo').mouseenter(function () {
        $('#logo-front').css('animation', 'logo-animation 2s infinite');
        $('#logo-mid').css('display', 'block');
        $('#logo-back').css('animation', 'logo-animation-2 2s infinite');
    });
    $('.site-logo').mouseleave(function () {
        $('#logo-front').css('animation', 'none');
        $('#logo-mid').css('display', 'none');
        $('#logo-back').css('animation', 'none');
    });
</script>