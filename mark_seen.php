<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_POST['type'];
if ($type == "feedback") {
    $conn->query("UPDATE feedback SET is_seen = 1 WHERE is_seen = 0");
} elseif ($type == "booking") {
    $conn->query("UPDATE notifications SET is_seen = 1 WHERE is_seen = 0");
}

$conn->close();
?>
