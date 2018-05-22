<!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link rel="shortcut icon" type="image/png" href="img/logofavicon.png"/>
    <link rel="shortcut icon" type="image/png" href="https://www.webte2tim18.sk/Projekt_ku_skuske/img/logofavicon.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script type="text/javascript" src='newscript.js'></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>
        Fast & FEIous
    </title>
</head>
<body id="gradientIndex">
<div class="navbar-fixed">
    <nav class="blue-grey darken-4">
        <div class="nav-wrapper">
            <a href="home.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png"
                                                              alt="logo"></a>

            <ul class="right">
                <li><a class='waves-effect waves-light white-text' href='index_map/indexGmap_final.php'><i
                                class='material-icons white-text'>map</i></a></li>
                <li><a class='waves-effect waves-light white-text' href='news.php'><i
                                class='material-icons white-text'>fiber_new</i></a></li>
            </ul>

        </div>
    </nav>
</div>

<!--<button id="loginButton" type="submit" name="login"
        class="col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4">
    Sign in<i class="material-icons right white-text">keyboard_arrow_right</i>
</button>-->

<div>
    <?php
    if (isset($_POST['usermail'])) {
        echo "
        <div id='loginForm' class='container'><div class='row'>
        <form id='pswchange' action='pswchange.php' method='post' onsubmit='return passwordmatch()' class='col s12'>
        <div class='row'><div class='input-field col s12'><i class='material-icons prefix white-text validate'>vpn_key</i><input id='psw1' type='password' name='psw1' class='grey-text' placeholder='Your new password' onkeyup='passwordmatch()'></div></div>
        <div class='row'><div class='input-field col s12'><i class='material-icons prefix white-text validate'>vpn_key</i><input id='psw2' type='password' name='psw2' class='grey-text' placeholder='Once more please' onkeyup='passwordmatch()'></div></div>
        <div class='row'><div class='col s12' align='center'><input type='hidden' name='usertochange' value='" . $_POST['usermail'] . "'></div></div>
        <div class='row'><div class='col s12' align='center'><label id='matchreturn'></label></div></div>


        <div class='row'><input type='submit' name='submit' value='Apply' class='col s4 offset-s4 btn waves-effect waves-light teal'></div></form></div></div>";

        exit();
    } else echo "<div id='labelNews' class='container col s12' align='center'><label>You have nothing to do here!</label></div>"; ?>
</div>

<footer class="page-footer blue-grey darken-4" style="position: fixed">
    <div class="footer-copyright blue-grey darken-3">
        <div class="container">
            &copy; 2018 WEBTE2
            <a class="grey-text text-lighten-4 right" href="../about.html">About</a>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="styleJS.js"></script>
</body>
</html>