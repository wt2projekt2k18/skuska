<?php
require "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = $_POST['data'];
$query = $conn->query("SELECT `Email` FROM `users` WHERE Email='$data'");
$result = $query->fetch_assoc();
if (!empty($result)) {
    echo "Email already exists.";
}
$conn->close();