<?phpclass dbConnection {    function getConnection() {        require_once dirname(__FILE__) . '/dbConfig.php';        $dbconfig = new dbConfig();        $servername = $dbconfig->getServername();        $username = $dbconfig->getUsername();        $password = $dbconfig->getPassword();        $dbname = $dbconfig->getDbname();        $conn = new mysqli($servername, $username, $password, $dbname);        return $conn;    }}