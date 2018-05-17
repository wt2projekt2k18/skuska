<?php
/**
 * Created by PhpStorm.
 * User: Gabi
 * Date: 17-May-18
 * Time: 5:48 PM
 */
if (isset($_GET['key'])) {
    require "config.php";
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $todelete = $_GET['key'];
    $query = $conn->query("DELETE FROM `newsletter` WHERE unsubscribe='$todelete'");
    if ($conn->error) {
        header("Location:index.php?unsubscribe=connerror");
        exit();
    } else {
        header("Location:index.php?unsubscribe=success");
        exit();
    }
    $conn->close();
} else {
    header("Location:index.php?unsubscribe=fail");
    exit();
}