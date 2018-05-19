<?php
session_start();
?><!DOCTYPE HTML>
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
                <li><a class='waves-effect waves-light white-text' href='news.php?admin=true'><i class='material-icons white-text'>fiber_new</i></a></li>
            </ul>
    
        </div>
    </nav>
</div>

<div id="newsContainer" class="container">
    <?php
    
    if (isset($_SESSION['admin']) && isset($_GET['admin'])) {
        if ($_SESSION['admin'] == 1 && $_GET['admin']=="true") {
            //TODO Zmenit velkost inputu podla potreby
            echo "<div class='row'><form name='aktuality' method='post' action='addnews.php' class='col s8 offset-s2'><div class='row'>
                <div class='input-field col s12'>
                    <textarea id='textarea1' name='content' class='materialize-textarea white-text'></textarea>
                    <label for='textarea1'>News textarea</label>
                </div>
                <button id='csapasdnekiButton' name='submit' value='Add news' class='col s6 offset-s3 btn waves-effect waves-light blue-grey darken-3'>
                    <span class='white-text'>Add news</span><i class='material-icons right white-text'>fiber_new</i>
                </button>
              <!--<input type='submit' name='submit' value='Add news'>-->
              </div></form></div>

              <!--<a href='send_news.php'><button>Send newsletter<i class='material-icons right white-text'>send</i></button></a>-->

            <div class='row'><form action='send_news.php' class='white-text'>
                <button id='csapasdButton' class='col s4 offset-s4 btn waves-effect waves-light blue-grey darken-4'>
                    Send newsletter<i class='material-icons right white-text'>send</i>
                </button>
            </form></div>
              ";
            //TODO 4 return messages
        }
    }
    $content = file_get_contents("news_body.html");
    echo $content;

    ?>
</div>

<footer class="page-footer blue-grey darken-4">
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