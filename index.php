<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location:home.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>   
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <title>
        Projekt ku skúške
    </title>
</head>
<body>
<header>
    <h1>
        Názov stránky
    </h1>
</header>
<div>
    <form action="home.php" method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Heslo">
        <input type="submit" name="login" value="Prihlásiť sa">
    </form>
    <a href="registration.php">Registrácia</a>
    <label id="returnsuccess">
    <?php

    if($_GET['reg']=="success"){
        echo "Registrácia bola úspešná. Na zadanú emailovú adresu Vám bol odoslaný potvrdzovací email.";
    }
    if($_GET['logout']=="success"){
        echo "Boli ste odhlásený!";
    }
    ?>
    </label>
    <label id="returnfailure">
    <?php
    if($_GET['login']=="wronguser"){
        echo "Email neexistuje.";
    }
    if($_GET['login']=="wrongpassword"){
        echo "Zadali ste zlé heslo.";
    }
    if($_GET['login']=="error" || $_GET['login']=="sessionerror") {
        echo "Neočakávaná chyba.";
    }
    if($_GET['login']=="notverified") {
        echo "Váš účet nie je aktivovaný.";
    }
    if($_GET['reg']=="mailerror"){
        echo "Nepodarilo sa odoslať email";
    }
    ?>
    </label>
</div>
<!--<footer>-->
<!--    <h2>-->
<!--        *footer here*-->
<!--    </h2>-->
<!--</footer>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</body>
</html>
