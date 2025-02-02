<?php
$hostname = "localhost:3308";
$username = "root";
$password = "";
$dbname = "chat_app_db";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    echo "Database connection failed";
}
