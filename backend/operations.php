<?php

class operations {

    function getDownloads() {
        require_once dirname(__FILE__) . '/dbConfig.php';
        $dbconfig = new dbConfig();

        $sql = "SELECT * FROM " . $dbconfig->getDbname() . ".downloads";
        return $this->executeQuery($sql);
    }

    function executeQuery($sql) {
        require_once dirname(__FILE__) . '/dbConnection.php';
        $cm = new dbConnection();
        $conn = $cm->getConnection();

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        return $data;
    }

}
