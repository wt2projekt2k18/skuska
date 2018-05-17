<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="reg_script.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>
        Fast & FEIous
    </title>
</head>
<body id="gradientIndex">
<div class="navbar-fixed">
    <nav id="navbarIndex" class="blue-grey darken-4">
        <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png" alt="logo"></a>
        </div>
    </nav>
</div>

<div id="loginForm" class="container">
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

<footer class="page-footer blue-grey darken-4">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="white-text">Subscribe to our newsletter!</h5>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix white-text">alternate_email</i>
                        <input id="emailNewsletter" type="text" name="emailNewsletter" class="white-text">
                        <label for="emailNewsletter">Email</label>
                    </div>
                    <button type="submit" name="buttonNewsletter" class="col s3 offset-s2 btn waves-effect waves-light blue-grey darken-3">
                        <a href="" class="white-text">Subscribe</a><i class="material-icons right white-text">thumb_up_alt</i>         
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright blue-grey darken-3">
        <div class="container">
        &copy; 2018 WEBTE2
        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="styleJS.js"></script>
</body>
</html>
