<?php
session_start();
?><!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <title>
        Fast & FEIous
    </title>
</head>
<body>
<header>
    <h1>
        Newsfeed
    </h1>
</header>
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
</body>
</html>