<?php
require "./PHPMailer-5.2.4/class.phpmailer.php";

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

if (isset($_POST['verification'])) {
    $mail->Subject = "Fast & FEIous ";
    $mail->Body = "Hi," . $_POST['lastname'] . "<br><br>Welcome to Fast and FEIous! We are glad that you joined our community. You can finish your sign up process by clicking <a href=https://www.webte2tim18.sk/Projekt_ku_skuske/verify.php?ver=" . $_POST['verification'] . "&mail=" . $_POST['mail'] . ">here</a>. We hope that you will enjoy our service.<br><br>Best regards,<br><br>Team Fast and FEIous";
    $mail->AddAddress($_POST['mail']);
    if (!$mail->Send()) {
        //echo "Mailer error".$mail->ErrorInfo;
        header("Location:registration.php?reg=mailerror");
        exit();
    } else {
        header("Location:index.php?reg=success");
        exit();
    }
}
if (isset($_POST['csv'])) {
    $mail->Subject = "Fast & FEIous - Default passwords for users";
    $mail->Body = "Default passwords for users imported from csv file:<br><br>" . $_POST['csv'];
    $mail->AddAddress($_POST['mail']);
    if (!$mail->Send()) {
        //echo "Mailer error".$mail->ErrorInfo;
        header("location:home.php?csverror=mailerror");
        exit();
    } else {
        header("location:home.php?csvsuccess=true");
        exit();
    }
}
