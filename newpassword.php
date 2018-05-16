<!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script type="text/javascript" src='newscript.js'></script>
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
<?php
    if (isset($_POST['usermail'])) {
        echo "
          <label>Pri prvom prihlásení musíš zmeniť heslo<br></label>
          <form id='pswchange' action='pswchange.php' method='post' onsubmit='return passwordmatch()'>
          <label>Zadaj heslo:<input id='psw1' type='password' name='psw1' onkeyup='passwordmatch()'></label><br>
          <label>Zadaj heslo znovu:<input id='psw2' type='password' name='psw2' onkeyup='passwordmatch()'></label><br>
          <input type='hidden' name='usertochange' value=''>
          <label id='matchreturn'></label><br>
          <input type='submit' name='submit' value='Zmeniť'>";

        exit();
    } else echo "<label>You have nothing to do here!</label>";?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</body>
</html>