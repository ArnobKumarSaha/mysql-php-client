<?php
$host = "10.2.0.183";
$user = "root";
$database = "mysql";
// $ca_cert = "/Users/arnobkumarsaha/go/src/github.com/ArnobKumarSaha/mysql-php-client/envoy/ca.crt";

# no tls db
// $port = 10007;
// $password = "NK)9(YIN4lj.YSzg"; 

# tls db
$port = 10002;
$password = "fWN1ibPIy5RvgNAp"; 



$connect = mysqli_init();
if (!$connect) {
    throw new Exception('mysqli_init failed');
}
$connect->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
$connect->ssl_set(null, null, null, null, null);

if (!$connect->real_connect($host, $user, $password, $database, $port, null, MYSQLI_CLIENT_SSL)) {
    throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
echo "ALL Good";

?>