<?php
$host = "10.2.0.183";
$user = "root";
$database = "mysql";
$ca_cert = "/Users/arnobkumarsaha/go/src/github.com/ArnobKumarSaha/mysql-php-client/envoy/ca.crt";

# no tls db
// $port = 10007;
// $password = "NK)9(YIN4lj.YSzg"; 

# tls db
$port = 10002;
$password = "fWN1ibPIy5RvgNAp"; 


// TRY 1: without ssl
$mysqli = new mysqli($host, $user, $password, $database, $port);
$stmt = $mysqli->prepare("SELECT 1");
if ($mysqli->errno == 2006) {
    echo "MySQL server has gone away";
}



// TRY 2: 

// $connect = new mysqli();

// // Set SSL options
// $connect->ssl_set(null, null, $ca_cert, null, null);
// // Disable certificate verification
// $connect->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);

// // Connect with SSL
// if (!$connect->real_connect($host, $user, $password, $database, $port, null, MYSQLI_CLIENT_SSL)) {
//     die('Connect Error (' . $connect->connect_errno . ') ' . $connect->connect_error);
// }

echo "ALL Good";
$connect->close();

?>
