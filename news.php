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
<body>

<div class="row">
    <div class="col s12 m5">
        <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        </div>
    </div>
</div>

<div>
    <?php
    $content = file_get_contents("news_body.html");
    echo $content;
    if (isset($_SESSION['admin']) && isset($_GET['admin'])) {
        if ($_SESSION['admin'] == 1 && $_GET['admin']=="true") {
            //TODO Zmenit velkost inputu podla potreby
            echo "<form name='aktuality' method='post' action='addnews.php'>
              <label> Add news:</label><br>
              <textarea rows='4' cols='50' name='content'></textarea><br>
              <input type='submit' name='submit' value='Add'>              
              </form>
              <a href='send_news.php'><button>Send newsletter</button></a> 
              ";
            //TODO 4 return messages
        }
    }
    ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="styleJS.js"></script>
</body>
</html>