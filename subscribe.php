<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 18-May-18
 * Time: 9:47 AM
 */

if (isset($_POST['buttonNewsletter'])) {
    require "config.php";
    require "stringgenerator.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $hash = randomstring(10);
    $sql = "INSERT INTO `newsletter`( `Mail`, `unsubscribe`) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['emailNewsletter'], $hash);
    $stmt->execute();
    if (strlen($stmt->error) > 0) {
        //echo $stmt->error;
        $conn->close();
        header("Location:index.php?subscription=dberror");
        exit();
    }
    $conn->query($sql);
    $conn->close();
    header("Location:index.php?subscription=success");
    exit();

} else {
    header("Location:index.php?subscription=fail");
    exit();
}