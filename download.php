<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Luckypops ~</title>
        <?php include './non-page/addons.php'; ?>
    </head>
    <body>
        <?php include './non-page/site-logo.php'; ?>
        <div class="text-center page-heading">
            <h1>Download</h1>
        </div>
        <?php include './non-page/menu.php'; ?>
        <div class="container">

        </div>
    </body>
    <script>
        $('document').ready(function () {
            $('.menu-download').addClass('menu-selected');

            $.ajax({
                type: "POST",
                url: '/backend/call.php',
                data: {
                    OP_TYPE: 1
                },
                success: function (data) {
                    var list='';
                    for (var i = 0; i < data.length; i++) {
                        list += '<span style="color: #FFF;">' + data[i].APP_NAME + '   ' + data[i].URL + '   ' + data[i].INFO + '</span>';
                    }
                    $('.container').html(list);
                },
                error: function () {
                    alert("err");
                },
                dataType: 'json'
            });
        });
    </script>
</html>
