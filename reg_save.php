<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09-May-18
 * Time: 12:11 PM
 */
require "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST['submit']) {
    $heslo = $_POST["password"];
    $newpassword = password_hash($heslo, PASSWORD_DEFAULT);
    if (strlen($_POST['school']) > 0) {
        $sql = "INSERT INTO `users`( `Surname`, `Name`, `Email`,`Password`, `City`, `PSC`, `Address`, `School`, `Schooladdress`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisss", $_POST['surname'], $_POST['name'], $_POST['email'], $newpassword, $_POST['city'], $_POST['psc'], $_POST['address'], $_POST['school'], $_POST['schooladdress']);

    } else {
        $sql = "INSERT INTO `users`( `Surname`, `Name`, `Email`,`Password`, `City`, `PSC`, `Address`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssis", $_POST['surname'], $_POST['name'], $_POST['email'], $newpassword, $_POST['city'], $_POST['psc'], $_POST['address']);
    }
    $stmt->execute();
    $conn->query($sql);
    $conn->close();
    header("Location:index.php?reg=success");
    exit();
} else {
    header("Location:registration.php?reg=fail");
    exit();
}
