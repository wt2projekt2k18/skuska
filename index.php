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
    <nav class="blue-grey darken-4">
        <div class="nav-wrapper">
            <a href="home.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png" alt="logo"></a>
    
            <ul class="right">
                <li><a class='waves-effect waves-light white-text' href='index_map/indexGmap_final.php'><i class='material-icons white-text'>map</i></a></li>
                <li><a class='waves-effect waves-light white-text' href='news.php'><i class='material-icons white-text'>fiber_new</i></a></li>
            </ul>
    
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

            <button id="loginButton" type="submit" name="login"
                    class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4">
                Sign in<i class="material-icons right white-text">keyboard_arrow_right</i>
            </button>
        </form>

    </div>
    <div class="row">

        <form action="registration.php" class="white-text" method="post">
            <button id="regButton" name="login" class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-3">
                Sign up<i class="material-icons right white-text">keyboard_arrow_up</i>
            </button>
        </form>
    </div>

    <div align="center"><label id="returnsuccess">
            <?php
            if ($_GET['unsubscribe'] == "success") {
                echo "You have been successfully unsubscribed from our newsletter.";
            }
            if ($_GET['newpsw'] == "success") {
                echo "New password has been set for you account. Now you can log in.";
            }
            if ($_GET['reg'] == "success") {
                echo "Registration was successful, confirmation email has been sent to you.";
            }
            if ($_GET['logout'] == "success") {
                echo "You have been signed out.";
            }
            ?>
        </label></div>
    <div align="center"><label id="returnfailure">
            <?php
            if ($_GET['login'] == "wronguser") {
                echo "Email doesn't exist.";
            }
            if ($_GET['login'] == "wrongpassword") {
                echo "Wrong password.";
            }
            if ($_GET['login'] == "error" || $_GET['login'] == "sessionerror") {
                echo "Please sign in again.";
            }
            if ($_GET['login'] == "notverified") {
                echo "Your account has't been verified.";
            }
            if ($_GET['reg'] == "mailerror") {
                echo "Could not send verification mail.Please contact administrators.";
            }
            if ($_GET['unsubscribe'] == "fail") {
                echo "Unsubscription failed. Please try again.";
            }
            if ($_GET['unsubscribe'] == "connerror") {
                echo "An error has occoured during modifying your data. Please contact an administrator.";
            }
            if ($_GET['newpsw'] == "fail") {
                echo "Could not set new password for your account. Please contact an administrator.";
            }
            if ($_GET['reg'] == "dberror") {
                echo "Could not save your data to database. Please contact an administrator.";
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
                    <p>I am your new running companion<p>
                    <p>Just sign up and you are good to go!<p>
                    <p><p>
                </h5>
            </div>
        </div>
    </div>
    <div class="parallax responsive-img"><img id="ultraboostImage" src="img/adidas-running-ultra-boost-wallpaper.jpg"
                                              alt="girls"></div>
</div>

<footer class="page-footer blue-grey darken-4">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="white-text">Subscribe to our newsletter!</h5>
                <div class="row">
                    <form action="subscribe.php" method="post">
                        <div class="input-field col s6">
                            <i class="material-icons prefix white-text">alternate_email</i>
                            <input id="emailNewsletter" type="email" name="emailNewsletter" class="white-text" required>
                            <label for="emailNewsletter">Email</label>
                        </div>
                        <!--                <button type="submit" name="buttonNewsletter" class="col s3 offset-s2 btn waves-effect waves-light blue-grey darken-3">-->
                        <!--                    <a href="" class="white-text">Subscribe</a><i class="material-icons right white-text">thumb_up_alt</i>         -->
                        <!--                </button>-->

                        <button type="submit" name="buttonNewsletter"
                                class="col s6 btn waves-effect waves-light blue-grey darken-3" align="center">
                            <span class="white-text">Subscribe</span><i class="material-icons right white-text">thumb_up_alt</i>
                        </button>
                    </form>
                    <div class="col s6" align="center">
                        <label>
                            <?php
                            if ($_GET['subscription'] == "success") {
                                echo "You have been successfully subscribed to our newsletter.<br> Thank you for your subscription.";
                            }
                            if ($_GET['subscription'] == "fail") {
                                echo "Subscription failed. Please try again.";
                            }
                            if ($_GET['subscription'] == "dberror") {
                                echo "An error has occoured during saving your data.<br> Please contact an administrator.";
                            }

                            ?>
                        </label>
                    </div>
                    

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
            <a class="grey-text text-lighten-4 right" href="about.html">About</a>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="styleJS.js"></script>
</body>
</html>
