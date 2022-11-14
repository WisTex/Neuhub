<?php

// WisTex KIMS™ uses a separate database than Hubzilla or Streams
// Modules and widgets that access this database need to include this file.

// INSTALL INSTRUCTIONS
// 1. Update the variables below with your connection information.
// 2. Rename this file to: connection.php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$connopen = true;
// connection is closed (if this is true) in footer-html.php 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $connopen = false;
} 

// https://www.w3schools.com/php/php_mysql_select.asp
// echo $connopen;

try {
     $myServer = $servername;
     $myUser   = $username;
     $myPass   = $password;
     $myDB	 = $dbname;
     $dbh = new PDO("mysql:host=$myServer;dbname=$myDB", $myUser, $myPass);
     $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     # $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
     # $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch(PDOException $e) {
     echo $e->getMessage();
     # file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}

?>