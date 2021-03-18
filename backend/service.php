<?php

sendExpMail();
sendSupportMail30DaysLeft();
sendSupportMail7DaysLeft();
sendSupportMail1DayLeft();

//if (isset($_REQUEST["TOKEN"]) && $_REQUEST["TOKEN"] == 'd88LpJd9L3DXm2BX3a4wNXYxFYtGe8AHkePgwxtczcyenFXNrBrrtbaWJGELFAfw6CtQYBFxb9a8pbWAFf6mw63cUBqApfeKpJqEwgNMtB8czUnUkwKNUppPYVsHtkHd6kJE3SUp2NTQ2aUNcJSPYXx8NMUn9QmDaMq7kkQPZTMQB8LMdNnZX8XjYvRnKcXbzqqDc6gxvjpgtsxV38byCqNXPCAvS3Spsj6ur6fL7VBC8HjWkAQdZzpJZqDrbeCu') {
//    sendExpMail(); // trial expired
//    sendSupportMail(); // support expired soon
//}

function sendExpMail() {
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/backend/config/ConnectionManager.php';
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/OrderSystem/Crypter.php';
    $cm = new ConnectionManager();
    $conn = $cm->getConnection();
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/backend/config/dbConfig.php';
    $dbconfig = new dbConfig();
   $sql = "SELECT
cr.ID as x, cr.CONTACT_NAME as CONTACT_NAME, cr.COMPANY_EMAIL as COMPANY_EMAIL,cr.COMPANY_NAME as COMPANY_NAME,ck.LIC_TYPE as LIC_TYPE, ck.EXPIRATION_DATE as EXPIRATION_DATE
FROM 
customer_lic_keys as ck, customers as cr
WHERE
ck.LIC_TYPE=0
AND ck.CUSTOMER_ID=cr.ID
AND ck.EXPIRATION_DATE = date(current_date()) + interval 3 day";

    $result = $conn->query($sql);
    
    $row_cnt = $result->num_rows;
    if ($row_cnt === 0) {
        $result = false;
    }
    if ($result == true) {

        $trs = "";
        while ($row = $result->fetch_assoc()) {

            $name = $row['CONTACT_NAME'];
            $company_name = $row['COMPANY_NAME'];
            $company_email = $row['COMPANY_EMAIL'];
            $expiration = $row['EXPIRATION_DATE'];
            $trs .= "<tr>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_email . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $expiration . "</td>";
            $trs .= "</tr>";
        }

        $subject = "Trial License Will Expire Soon";
        $body = "
<html>
<head>
<title>Vothread</title>
<style>
</style>
</head>
<body>   
        <h3 style='color:red'>Expiring Trial License(s):</h3>
        <p>Below trial license(s) is going to expire '3' days later!</p><br>
<table border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse;width:980px;'>

    <thead>
        <tr>
        <th>Name</th>
        <th>Company Name</th>
        <th>Company Email</th>
        <th>Expiration Date</th>
        </tr>
    </thead>
    <tbody>
        $trs
    <tbody>    
</table>
<br><br>
</p><b>WLSDM Sales Team</b>
<br><a>http://community.wlsdm.com</a>
</body>
</html>
";

        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= "From: WLSDM CRM System<sales@volthread.com>\n";
        $header .= "Reply-To: sales@wlsdm.com\n";
        mail("sales@wlsdm.com,sales@volthread.com", $subject, $body, $header);

        $conn->close();

        return $state;
    }
}

function sendSupportMail30DaysLeft() {
    require_once dirname(__FILE__) .  '/../../../backend/config/ConnectionManager.php';
    require_once dirname(__FILE__) .  '/../../../OrderSystem/Crypter.php';
    $cm = new ConnectionManager();
    $conn = $cm->getConnection();
    require_once dirname(__FILE__) .  '/../../../backend/config/dbConfig.php';
    $dbconfig = new dbConfig();

    $sql = "SELECT
cr.ID as x, cr.CONTACT_NAME as CONTACT_NAME, cr.COMPANY_EMAIL as COMPANY_EMAIL,cr.COMPANY_NAME as COMPANY_NAME,ck.LIC_TYPE as LIC_TYPE, ck.SUPPORT_END_DATE as SUPPORT_END_DATE,ck.SUPPORT_START_DATE as SUPPORT_START_DATE
FROM 
customer_lic_keys as ck, customers as cr
WHERE
ck.CUSTOMER_ID=cr.ID AND
ck.SUPPORT_END_DATE=date(current_date()) + interval 30 day
AND
ck.LIC_TYPE IN (11,12,21,22,30)";

    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;
    if ($row_cnt === 0) {
        $result = false;
    }

    if ($result == true) {
        $trs = "";
        while ($row = $result->fetch_assoc()) {

            $name = $row['CONTACT_NAME'];
            $company_name = $row['COMPANY_NAME'];
            $company_email = $row['COMPANY_EMAIL'];
            $start = $row['SUPPORT_START_DATE'];
            $expiration = $row['SUPPORT_END_DATE'];
            $trs .= "<tr>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_email . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $start . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $expiration . "</td>";
            $trs .= "</tr>";
        }
        $crypter = new Crypter();

        $subject = "Customer Support Will Expire Soon";
        $body = "
<html>
<head>
<title>Vothread</title>
<style>
</style>
</head>
<body>   
        <h3 style='color:red'>Expiring Support(s):</h3>
        <p>Below customer(s) support is going to expire '30' days later!</p><br>
<table border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse;width:980px;'>

    <thead>
        <tr>
        <th>Name</th>
        <th>Company Name</th>
        <th>Company Email</th>
        <th>Support Start Date</th>
        <th>Support End Date</th>
        </tr>
    </thead>
    <tbody>
        $trs
    <tbody>    
</table>
<br><br>
</p><b>WLSDM Sales Team</b>
<br><a>http://community.wlsdm.com</a>
</body>
</html>
";
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= "From: WLSDM CRM System<sales@volthread.com>\n";
        $header .= "Reply-To: sales@volthread.com\n";
        mail("sales@wlsdm.com,sales@volthread.com", $subject, $body, $header);
        
        $conn->close();

        return $state;
    }
}

function sendSupportMail7DaysLeft() {
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/backend/config/ConnectionManager.php';
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/OrderSystem/Crypter.php';
    $cm = new ConnectionManager();
    $conn = $cm->getConnection();
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/backend/config/dbConfig.php';
    $dbconfig = new dbConfig();

    $sql = "SELECT
cr.ID as x, cr.CONTACT_NAME as CONTACT_NAME, cr.COMPANY_EMAIL as COMPANY_EMAIL,cr.COMPANY_NAME as COMPANY_NAME,ck.LIC_TYPE as LIC_TYPE, ck.SUPPORT_END_DATE as SUPPORT_END_DATE,ck.SUPPORT_START_DATE as SUPPORT_START_DATE
FROM 
customer_lic_keys as ck, customers as cr
WHERE
ck.CUSTOMER_ID=cr.ID AND
ck.SUPPORT_END_DATE=date(current_date()) + interval 7 day
AND
ck.LIC_TYPE IN (11,12,21,22,30)";

    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;
    if ($row_cnt === 0) {
        $result = false;
    }

    if ($result == true) {
        $trs = "";
        while ($row = $result->fetch_assoc()) {

            $name = $row['CONTACT_NAME'];
            $company_name = $row['COMPANY_NAME'];
            $company_email = $row['COMPANY_EMAIL'];
            $start = $row['SUPPORT_START_DATE'];
            $expiration = $row['SUPPORT_END_DATE'];
            $trs .= "<tr>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_email . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $start . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $expiration . "</td>";
            $trs .= "</tr>";
        }
        $crypter = new Crypter();

        $subject = "Customer Support Will Expire Soon";
        $body = "
<html>
<head>
<title>Vothread</title>
<style>
</style>
</head>
<body>   
        <h3 style='color:red'>Expiring Support(s):</h3>
        <p>Below customer(s) support is going to expire '7' days later!</p><br>
<table border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse;width:980px;'>

    <thead>
        <tr>
        <th>Name</th>
        <th>Company Name</th>
        <th>Company Email</th>
        <th>Support Start Date</th>
        <th>Support End Date</th>
        </tr>
    </thead>
    <tbody>
        $trs
    <tbody>    
</table>
<br><br>
</p><b>WLSDM Sales Team</b>
<br><a>http://community.wlsdm.com</a>
</body>
</html>
";
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= "From: WLSDM CRM System<sales@volthread.com>\n";
        $header .= "Reply-To: sales@volthread.com\n";
        mail("sales@wlsdm.com,sales@volthread.com", $subject, $body, $header);
        
        $conn->close();

        return $state;
    }
}

function sendSupportMail1DayLeft() {
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/backend/config/ConnectionManager.php';
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/OrderSystem/Crypter.php';
    $cm = new ConnectionManager();
    $conn = $cm->getConnection();
    require_once dirname(__FILE__) .  '/home/wlsdmcom/www/backend/config/dbConfig.php';
    $dbconfig = new dbConfig();

    $sql = "SELECT
cr.ID as x, cr.CONTACT_NAME as CONTACT_NAME, cr.COMPANY_EMAIL as COMPANY_EMAIL,cr.COMPANY_NAME as COMPANY_NAME,ck.LIC_TYPE as LIC_TYPE, ck.SUPPORT_END_DATE as SUPPORT_END_DATE,ck.SUPPORT_START_DATE as SUPPORT_START_DATE
FROM 
customer_lic_keys as ck, customers as cr
WHERE
ck.CUSTOMER_ID=cr.ID AND
ck.SUPPORT_END_DATE=date(current_date()) + interval 1 day
AND
ck.LIC_TYPE IN (11,12,21,22,30)";

    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;
    if ($row_cnt === 0) {
        $result = false;
    }

    if ($result == true) {
        $trs = "";
        while ($row = $result->fetch_assoc()) {

            $name = $row['CONTACT_NAME'];
            $company_name = $row['COMPANY_NAME'];
            $company_email = $row['COMPANY_EMAIL'];
            $start = $row['SUPPORT_START_DATE'];
            $expiration = $row['SUPPORT_END_DATE'];
            $trs .= "<tr>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_name . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $company_email . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $start . "</td>";
            $trs .= "<td style='border:solid #B2B2B2 1.0pt;width:130.1pt;padding:6.0pt 18.0pt 18.0pt 9.0pt;'>" . $expiration . "</td>";
            $trs .= "</tr>";
        }
        $crypter = new Crypter();

        $subject = "Customer Support Will Expire Soon";
        $body = "
<html>
<head>
<title>Vothread</title>
<style>
</style>
</head>
<body>   
        <h3 style='color:red'>Expiring Support(s):</h3>
        <p>Below customer(s) support is going to expire tomorrow!</p><br>
<table border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse;width:980px;'>

    <thead>
        <tr>
        <th>Name</th>
        <th>Company Name</th>
        <th>Company Email</th>
        <th>Support Start Date</th>
        <th>Support End Date</th>
        </tr>
    </thead>
    <tbody>
        $trs
    <tbody>    
</table>
<br><br>
</p><b>WLSDM Sales Team</b>
<br><a>http://community.wlsdm.com</a>
</body>
</html>
";
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= "From: WLSDM CRM System<sales@volthread.com>\n";
        $header .= "Reply-To: sales@volthread.com\n";
        mail("sales@wlsdm.com,sales@volthread.com", $subject, $body, $header);
        
        $conn->close();

        return $state;
    }
}