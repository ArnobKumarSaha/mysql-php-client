<?php
$host = "10.2.0.183:10002";
$user = "root";
$database = "mysql";
$ca_cert = "/Users/arnobkumarsaha/go/src/github.com/ArnobKumarSaha/mysql-php-client/envoy/ca.crt";

# no tls db
// $port = 10007;
// $password = "NK)9(YIN4lj.YSzg"; 
$password = "fWN1ibPIy5RvgNAp"; 
$row = 100;


$connect = mysqli_init();
if (!$connect) {
    throw new Exception('mysqli_init failed');
}

$flags = MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT;
mysqli_ssl_set($connect, null, null, $ca_cert, null, null);

if (!mysqli_real_connect($connect, $host, $user, $password, $database, null, null, $flags)) {
    throw new Exception('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

// Create table if not exists
$table_query = "CREATE TABLE IF NOT EXISTS random_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    random_text VARCHAR(255),
    random_number INT
)";
if (!$connect->query($table_query)) {
    throw new Exception('Table creation failed: ' . $connect->error);
}

// Insert 500 random rows
$insert_query = $connect->prepare("INSERT INTO random_data (random_text, random_number) VALUES (?, ?)");
if (!$insert_query) {
    throw new Exception('Insert statement preparation failed: ' . $connect->error);
}

for ($i = 0; $i < $row; $i++) {
    $random_text = "Text_" . bin2hex(random_bytes(4));
    $random_number = rand(1, 1000);
    $insert_query->bind_param("si", $random_text, $random_number);
    $insert_query->execute();
}
$insert_query->close();

// Retrieve the inserted data
$result = $connect->query("SELECT * FROM random_data LIMIT 10"); // Fetch first 10 rows for display

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " | Text: " . $row['random_text'] . " | Number: " . $row['random_number'] . "<br>";
    }
    $result->free();
} else {
    throw new Exception('Data retrieval failed: ' . $connect->error);
}

echo "ALL Good";

$drop_query = "DROP TABLE IF EXISTS random_data";
if (!$connect->query($drop_query)) {
    throw new Exception('Table drop failed: ' . $connect->error);
}
$connect->close();
?>
