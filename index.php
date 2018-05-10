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
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
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
        echo "Registrácia bola úspešná!";
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
    ?>
    </label>
</div>
<!--<footer>-->
<!--    <h2>-->
<!--        *footer here*-->
<!--    </h2>-->
<!--</footer>-->

</body>
</html>
