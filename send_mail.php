<?php
require "./PHPMailer-5.2.4/class.phpmailer.php";
echo $_POST['mail'];
echo $_POST['lastname'];
echo $_POST['verification'];
print_r($_POST);

$mail= new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug=1;
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';
$mail->Host="smtp.gmail.com";
$mail->Port=465;//587
$mail->IsHTML(true);
$mail->CharSet= "UTF-8";
$mail->Username="webte2tim18@gmail.com";
$mail->Password="webteadmin";
$mail->SetFrom("webte2tim18@gmail.com");
$mail->Subject="Potvrdenie registrácie";
$mail->Body="Ahoj,".$_POST['lastname']."<br><br> bla bla bla... klikni na <a href=http://147.175.98.149/Projekt_20ku_20skuske/verify.php?ver=".$_POST['verification']."&mail=".$_POST['mail'].">link</a> aby si dokončil svoju registráciu.";
$mail->AddAddress($_POST['mail']);
if(!$mail->Send()){
//echo "Mailer error".$mail->ErrorInfo;
header("Location:registration.php?reg=mailerror");
exit();
}
else{
  header("Location:index.php?reg=success");
  exit();
    //echo "success";
}