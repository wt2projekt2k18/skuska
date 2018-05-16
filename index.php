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
        Fast & FEIous
    </title>
</head>
<body>
<div class="navbar-fixed">
    <nav id="navbarIndex" class="white">
        <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-black-720.png" alt="logo"></a>
        </div>
    </nav>
</div>
</nav>




<div class="container">
    <div id="loginForm" class="row">
    <form class="col s12" action="home.php" method="post">   
        <div class="row">
            <div class="input-field col s12">
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" type="password" class="validate">
                <label for="password">Password</label>
            </div>
        </div>
        <div>
            <input type="submit" name="login" value="Login">
        </div>
    </form>
    </div>

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
