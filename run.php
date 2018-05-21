<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09-May-18
 * Time: 12:11 PM
 */


if ($_POST['nyomjadneki']) {
    require "config.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `run`( `route_id`, `Day`, `start_time`, `end_time`, `Kilometers`, `GPS start`, `GPS end`, `Rating`, `Comment`) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $_POST['route'],$_POST['day'], $_POST['start'], $_POST['end'], $_POST['km'], $_POST['gpsstart'], $_POST['gpsend'], $_POST['rating'], $_POST['comment']);
    $stmt->execute();
    if (strlen($stmt->error) > 0) {
        echo $stmt->error;
        header("Location:home.php?run=dberror");
        exit();
    }
    $conn->query($sql);
    $conn->close();
    header("Location:home.php?run=success");
    exit();

} else {
    header("Location:home.php?run=fail");
    exit();
}
