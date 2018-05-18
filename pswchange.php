<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 16-May-18
 * Time: 2:11 PM
 */
if (isset($_POST['psw1']) && isset($_POST['usertochange'])) {
    require "config.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $noveheslo = $_POST['psw1'];
    $dbheslo = password_hash($noveheslo, PASSWORD_DEFAULT);

    $conn->query("UPDATE `users` SET `Verified`=1 WHERE Email='".$_POST['usertochange']."'");
    $conn->query("UPDATE `users` SET `Password`='$dbheslo' WHERE Email='".$_POST['usertochange']."'");
    $conn->close();
    header("Location:index.php?newpsw=success");
    exit();

} else {
    header("Location:index.php?newpsw=fail");
    exit();
}