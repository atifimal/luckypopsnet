<?php

class operations {

    function getDownloads() {
        require_once dirname(__FILE__) . '/dbConfig.php';
        $dbconfig = new dbConfig();

        $sql = "SELECT * FROM " . $dbconfig->getDbname() . ".downloads";
        return $this->executeQuery($sql, 'yes');
    }

    function addDownload($APP_NAME, $URL, $INFO) {
        require_once dirname(__FILE__) . '/dbConfig.php';
        $dbconfig = new dbConfig();

        $sql = "INSERT INTO " . $dbconfig->getDbname() . ".downloads (APP_NAME,URL,INFO) "
                . "VALUES ('" . $APP_NAME . "', '" . $URL . "', '" . $INFO . "')";
        return $this->executeQuery($sql, 'no');
    }

    function executeQuery($sql, $isreturn) {
        require_once dirname(__FILE__) . '/dbConnection.php';
        $cm = new dbConnection();
        $conn = $cm->getConnection();
        $data = [];
        
        $result = mysqli_query($conn, $sql);
        if ($isreturn === 'yes') {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            } else {
                echo "0 results";
            }
        }

        $conn->close();
        return $data;
    }

}
