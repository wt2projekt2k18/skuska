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
function randomstring($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, $max)];
    }
    return $string;
}

if ($_POST['submit']) {
    $heslo = $_POST["password"];
    $newpassword = password_hash($heslo, PASSWORD_DEFAULT);
    $verification = randomstring(20);
    if (strlen($_POST['school']) > 0) {
        $sql = "INSERT INTO `users`( `Surname`, `Name`, `Email`,`Password`, `City`, `PSC`, `Address`, `School`, `Schooladdress`, `Verification`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssissss", $_POST['surname'], $_POST['name'], $_POST['email'], $newpassword, $_POST['city'], $_POST['psc'], $_POST['address'], $_POST['school'], $_POST['schooladdress'], $verification);

    } else {
        $sql = "INSERT INTO `users`( `Surname`, `Name`, `Email`,`Password`, `City`, `PSC`, `Address`, `Verification`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiss", $_POST['surname'], $_POST['name'], $_POST['email'], $newpassword, $_POST['city'], $_POST['psc'], $_POST['address'], $verification);
    }
    $stmt->execute();
    $conn->query($sql);
    $conn->close();

    echo "<form id='mailform' action='send_mail.php' method='post'>
                <input type='hidden' name='mail' value='" . $_POST['email'] . "'>
                <input type='hidden' name='verification' value='" . $verification . "'>
                <input type='hidden' name='lastname' value='" . $_POST['name'] . "'>
          </form>";
    echo "<script>document.getElementById('mailform').submit();</script>";
    //header("Location:send_mail.php?mail=".$_POST['email']);
    //exit();

} else {
    header("Location:registration.php?reg=fail");
    exit();
}
