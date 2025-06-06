<?php
$servername = "localhost"; // or your server's name
$username = "root";        // your database username
$password = "";            // your database password
$dbname = "parking_db";          // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<script>alert('Failed Connection')</script>";
}
?>
