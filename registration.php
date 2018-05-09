<!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="registration.css">
    <script src="reg_script.js"></script>
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
    <form name="registration" method="get" onsubmit="return psccheck();">
        <label>Priezvisko
            <input type="text" name="surname" required>
        </label>
        <br>
        <label>Meno
            <input type="text" name="name" required>
        </label>
        <br>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <br>
        <label>Bydlisko
            <input type="text" name="city" required>
        </label>
        <br>
        <label>PSČ
            <input id="psc" type="number" name="psc" required>
        </label>
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

</div>
<!--<footer>-->
<!--    <h2>-->
<!--        *footer here*-->
<!--    </h2>-->
<!--</footer>-->

</body>
</html>
