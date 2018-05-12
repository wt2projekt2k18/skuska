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

    $code="test";
    $message = "Your Activation Code is ".$code."";
    $to=$_POST['email'];
    $subject="Activation Code For WEBTE";
    $from = 'pulen.gabor@gmail.com';
    $body='Your Activation Code is '.$code.' Please Click On This link <a href="verification.php">Verify.php?id="testid"&code='.$code.'</a>to activate  your account.';
    $headers = "From:".$from;
    mail($to,$subject,$body,$headers);

    echo "An Activation Code Is Sent To You Check You Emails";

    //header("Location:index.php?reg=success");
    //exit();
} else {
    header("Location:registration.php?reg=fail");
    exit();
}
