<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "medDb";

// $config['table_name'] = "fruit";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    // die("<script>alert('Connection Failed.')</script>");
}

?>