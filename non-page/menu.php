<div>
    <div class="position-absolute menu-div">
        <span class="menu-item menu-java">Java</span>
        <span class="menu-item menu-front">Front-End</span>
        <span class="menu-item menu-notes">Notes</span>
        <span class="menu-item menu-download">Download</span>
        <span class="menu-item menu-about">About</span>
    </div>
</div>

<script>
    $('document').ready(function () {
        $('.menu-div .menu-item').on('click', function () {
            if($(this).hasClass('menu-java')) window.location.href = "java";
            else if($(this).hasClass('menu-front')) window.location.href = "frontend";
            else if($(this).hasClass('menu-notes')) window.location.href = "notes";
            else if($(this).hasClass('menu-download')) window.location.href = "download";
            else if($(this).hasClass('menu-about')) window.location.href = "about";
        });
    })
</script>