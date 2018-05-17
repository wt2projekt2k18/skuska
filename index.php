<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location:home.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>   
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
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
    <div class="row">
    <form class="col s12" action="home.php" method="post">   
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix white-text">alternate_email</i>
                <input id="email" type="email" name="email" class="white-text">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix white-text">vpn_key</i>
                <input id="password" type="password" name="password" class="white-text">
                <label for="password">Password</label>
            </div>
        </div>
        
        <button id="loginButton" type="submit" name="login" class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4">
            Sign in<i class="material-icons right white-text">keyboard_arrow_right</i>      
        </button>
    </form>
    
    </div>
    <div class="row">
  
        <form action="registration.php" class="white-text">
            <button id="regButton" type="submit" name="login" class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4">
                Sign up</a><i class="material-icons right white-text">keyboard_arrow_right</i>     
            </button>
        </form>

        <!--<a href="registration.php" class="white-text">
            <button id="regButton" type="submit" name="login" class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4">
                Sign up</a><i class="material-icons right white-text">keyboard_arrow_right</i>     
            </button>
        </a>-->
        
        
    </div>

    

    <div align="center"><label id="returnsuccess">
    <?php
    
    if($_GET['reg']=="success"){
        echo "Registrácia bola úspešná. Na zadanú emailovú adresu Vám bol odoslaný potvrdzovací email.";
    }
    if($_GET['logout']=="success"){
        echo "Boli ste odhlásený!";
    }
    ?>
    </label></div>
    <div align="center"><label id="returnfailure">
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
    </label></div>
</div>

<div id="ultraboostParallax" class="parallax-container valign-wrapper">
    <div id="ultraboostText" class="section no-pad-bot">
        <div class="container">
            <h3 class="header center">Welcome to Fast and FEIous</h3>
        <div class="row center">
            <!--<h3 class="header col s12 light">About Fast and FEIous</h3>-->
            <h5 class="header col s12 light">
                TODO Lorem ipsum, dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, necessitatibus!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus illum tempora earum odit voluptate fugiat?
      
            </h5>
        </div>
        </div>
    </div>
    <div class="parallax responsive-img"><img id="ultraboostImage" src="img/adidas-running-ultra-boost-wallpaper.jpg" alt="girls"></div>
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
        
        <!--<div class="col l4 offset-l2 s12">
            <h5 class="white-text">Links</h5>
            <ul>
            <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
        </div>-->
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
