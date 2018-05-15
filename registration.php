<!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="registration.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="reg_script.js" async defer></script>
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
    <h2>Registrácia</h2>
    <form id="formular" name="registration" action="reg_save.php" method="post">
        <label>Priezvisko
            <input type="text" name="surname" required>
        </label>
        <br>
        <label>Meno
            <input type="text" name="name" required>
        </label>
        <br>
        <label>Email
            <input id="email" type="email" name="email" required>
        </label>
        <label style="color:red" id="emaillabel"></label>
        <br>
        <label>Heslo
            <input id="pw" type="password" name="password" required>
        </label>
        <label style="color:red" id="pswlabel"></label>
        <br>
        <label>Bydlisko
            <input type="text" name="city" required>
        </label>
        <br>
        <label>PSČ
            <input id="psc" type="number" name="psc" required>
        </label>
        <label style="color:red" id="psclabel"></label>
        <br>
        <label>Bydlisko (adresa)
            <input type="text" name="address" required>
        </label>
        <br>
        <label>
            <input id="check" type="checkbox" name="highschooler" onclick="highschoolcheck();"> Som stredoškolák
        </label>
        <br>
        <div id="optional">
            <label>Stredná škola
                <input type="text" name="school">
            </label>
            <br>
            <label>Stredná škola (adresa)
                <input type="text" name="schooladdress">
            </label>

        </div>
        <br id="break">
        <input type="submit" name="submit" value="Registrácia">
    </form>
    <?php
    if($_GET['reg']=="fail"){
        echo "Registrácia nebola úspešná";
    }
    ?>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</body>
</html>
