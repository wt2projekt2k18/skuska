<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17-May-18
 * Time: 1:00 PM
 */

require "./PHPMailer-5.2.4/class.phpmailer.php";
require "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

ob_start();
include "news.php";
$output = ob_get_contents();
ob_end_clean();
//echo $output;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;//587
$mail->IsHTML(true);
$mail->CharSet = "UTF-8";
$mail->Username = "webte2tim18@gmail.com";
$mail->Password = "webteadmin";
$mail->SetFrom("webte2tim18@gmail.com");
$mail->Subject = "Fast & FEIous Newsletter";

$sql = "SELECT `Mail`,`unsubscribe` FROM `newsletter` WHERE 1";
$result = $conn->query($sql);
$conn->close();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mail->AddAddress($row["Mail"]);
        $mail->Body = $output . "<br> <a href='https://www.webte2tim18.sk/Projekt_ku_skuske/unsubscribe.php?key=" . $row['unsubscribe'] . "'>Cancel subscription</a>";
        if (!$mail->Send()) {
            //echo "Mailer error" . $mail->ErrorInfo;
            header("Location:news.php?admin=true&letter=notsent");
            exit();
        }
        $mail->ClearAllRecipients( );
    }

} else {
    header("Location:news.php?admin=true&letter=dberror");
    exit();
}

header("Location:news.php?admin=true&letter=sent");
exit();
