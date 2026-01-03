<?php
$host = "localhost";
$username = "root";
$pass = "";
$db = "Campus_Smart_cafee"; // must match phpMyAdmin exactly

$conn = new mysqli($host, $username, $pass, $db);

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}
?>
