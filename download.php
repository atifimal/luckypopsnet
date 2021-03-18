<?php
$parameter = '';
if (isset($_GET['add'])) {
    $parameter = 'add';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Luckypops ~</title>
        <?php include './non-page/addons.php'; ?>
    </head>
    <body>
        <?php include './non-page/preloader.php'; ?>
        <?php include './non-page/site-logo.php'; ?>
        <div class="text-center page-heading">
            <h1>Download</h1>
        </div>
        <?php include './non-page/menu.php'; ?>
        <div class="site-container">
            <div class="site-container-list">
                <table class="site-container-list-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="text" class="downloads-search-input"/>
                                <i class="fa fa-times downloads-search-input-times-icon"></i>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $('.menu-download').addClass('menu-selected');
            getDownloadsToContainer();

            if (<?php
        if ($parameter === 'add')
            echo 'true';
        else
            echo 'false';
        ?>) {
                addstr = '<input type="text" class="form-control add-download_appname" placeholder="APP_NAME"/>' +
                        '<input type="text" class="form-control add-download_url" placeholder="URL"/>' +
                        '<input type="text" class="form-control add-download_info" placeholder="INFO"/>' +
                        '<input type="button" class="btn btn-primary add-download_button" id="add-download_button" value="OK"/>';
                $('.site-container').html(addstr + $('.site-container').html());
            }
        });

        $(document).on('click', '.site-container-list-table tbody tr', function () {
            window.location.href = "/downloads/" + $(this).attr('data-url');
        });

        $(document).on('click', '.add-download_button', function () {
            addDownloadToDatabase();
            getDownloadsToContainer();
        });

        $('.downloads-search-input').keyup(function () {
            $('.site-container-list-table tbody tr').each(function () {
                var str = $(this).find('td:first-child').html().toLowerCase();
                var substr = $('.downloads-search-input').val().toLowerCase();
                if (str.includes(substr))
                    $(this).css('display', 'table-row');
                else
                    $(this).css('display', 'none');
            });
        });

        $(document).on('click', '.downloads-search-input-times-icon', function () {
            $('.downloads-search-input').val('');
            $('.site-container-list-table tbody tr').each(function () {
                $(this).css('display', 'table-row');
            });
        });

        function getDownloadsToContainer() {
            $.ajax({
                type: "POST",
                url: '/backend/call.php',
                data: {
                    OP_TYPE: 1
                },
                success: function (data) {
                    var list = '';
                    for (var i = 0; i < data.length; i++) {
                        list += '<tr data-url="' + data[i].URL + '"><td>' + data[i].APP_NAME + '</td><td>' + data[i].INFO + '</td></tr>';
                    }
                    $('.site-container-list-table tbody').html(list);
                },
                error: function () {
                    alert("err");
                },
                dataType: 'json'
            });
        }

        function addDownloadToDatabase() {
            $.ajax({
                type: "POST",
                url: '/backend/call.php',
                data: {
                    OP_TYPE: 2,
                    APP_NAME: $('.add-download_appname').val(),
                    URL: $('.add-download_url').val(),
                    INFO: $('.add-download_info').val()
                },
                success: function (data) {
                    var list = '';
                    for (var i = 0; i < data.length; i++) {
                        list += '<tr data-url="' + data[i].URL + '"><td>' + data[i].APP_NAME + '</td><td>' + data[i].INFO + '</td></tr>';
                    }
                    $('.site-container-list-table tbody').html(list);
                },
                error: function () {
                    alert("err");
                },
                dataType: 'json'
            });

        }
        ;
    </script>
</html>
