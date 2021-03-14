<?php session_start(); ?>
<?php

if (isset($_POST['OP_TYPE'])) {
    $typ = $_POST['OP_TYPE'];

    require_once dirname(__FILE__) . '/operations.php';
    $dcp = new operations();

    if ($typ * 1 === 1) {
        $result = $dcp->getDownloads();

        if ($result === FALSE) {
            echo '{"error":-9}';
        } else {
            echo json_encode($result);
        }
    }
}