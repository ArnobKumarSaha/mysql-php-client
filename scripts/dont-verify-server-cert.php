<?php
// https://github.com/php/php-src/issues/8978 

$host = "10.2.0.183:10002";
$user = "root";
$database = "mysql";
$ca_cert = "/Users/arnobkumarsaha/go/src/github.com/ArnobKumarSaha/mysql-php-client/envoy/ca.crt";

# no tls db
// $port = 10007;
// $password = "NK)9(YIN4lj.YSzg"; 
$password = "fWN1ibPIy5RvgNAp"; 


$connect = mysqli_init();
if (!$connect) {
    throw new Exception('mysqli_init failed');
}



$flags = MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT;
// Didnt work with this paramet
// $connect->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);



mysqli_ssl_set($connect, null, null, $ca_cert, null, null);
// mysqli_real_connect($connect, $host, $user, $password, null, null, null, $flags);


if (!mysqli_real_connect($connect, $host, $user, $password, $database, null, null, $flags)) {
    throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
// }
echo "ALL Good";
$connect->close();

?>
