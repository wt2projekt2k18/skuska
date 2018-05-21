<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>
        Fast & FEIous
    </title>
</head>
<body id="gradientIndex">
<div class="navbar-fixed">
    <nav id="navbarIndex" class="blue-grey darken-4">
        <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png"
                                                               alt="logo"></a>
        </div>
    </nav>
</div>

<div id="loginForm" class="container">
    <div class="row">
        <form id="formular" name="registration" action="reg_save.php" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix white-text">person</i>
                    <input id="firstname" type="text" name="firstname" class="white-text" required>
                    <label for="firstname">First name</label>
                </div>
                <div class="input-field col s6">
                    <input id="surname" type="text" name="surname" class="white-text" required>
                    <label for="surname">Last name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix white-text">alternate_email</i>
                    <input id="email" type="email" name="email" class="white-text" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <label style="color:red" id="emaillabel"></label>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix white-text">vpn_key</i>
                    <input id="password" type="password" name="password" class="white-text" required>
                    <label for="password">Password</label>
                </div>
            </div>
            <label style="color:red" id="pswlabel"></label>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix white-text">location_city</i>
                    <input id="city" type="text" name="city" class="white-text" required>
                    <label for="city">City</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix white-text">local_post_office</i>
                    <input id="psc" type="number" name="psc" class="white-text" required>
                    <label for="psc">Postal code</label>
                </div>
            </div>
            <label style="color:red" id="psclabel"></label>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix white-text">home</i>
                    <input id="address" type="text" name="address" class="white-text" required>
                    <label for="address">Address</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <label>
                        <input id="check" type="checkbox" name="highschooler" onclick="highschoolcheck();">
                        <span>I am a high school student</span>
                    </label>
                </div>
            </div>
            <div id="optional" class="row">
                <div class="input-field col s6">
                    <input id="school" type="text" name="school" class="white-text">
                    <label for="school">High school name</label>
                </div>
                <div class="input-field col s6">
                    <input id="schooladdress" type="text" name="schooladdress" class="white-text">
                    <label for="schooladdress">High school address</label>
                </div>
            </div>
            <br id="break">
            <!--            <input type="submit" name="submit" value="Registrácia">-->
            <button id="regButton2" name="csapasdneki" value="Hello"
                    class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4">
                <span class="white-text">Sign up</span><i
                        class="material-icons right white-text">keyboard_arrow_right</i>
            </button>
        </form>
    </div>
    <?php
    if ($_GET['reg'] == "fail") {
        echo "Error during sign up.";
    }
    ?>
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
                        <button type="submit" name="buttonNewsletter"
                                class="col s3 offset-s2 btn waves-effect waves-light blue-grey darken-3">
                            <span class="white-text">Subscribe</span><i class="material-icons right white-text">thumb_up_alt</i>
                        </button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright blue-grey darken-3">
        <div class="container">
            &copy; 2018 WEBTE2
            <a class="grey-text text-lighten-4 right" href="about.html">About</a>
        </div>
    </div>
</footer>
<script src="reg_script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="styleJS.js"></script>
</body>
</html>
