<?php
// database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "discuss";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("not connected with db " . $conn->connect_error);
}

echo "database connected";

?>