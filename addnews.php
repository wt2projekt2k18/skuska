<!--<!DOCTYPE HTML>
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
<body>-->
    


<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17-May-18
 * Time: 11:34 AM
 */
 //include 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css';
 

if(isset($_POST['content'])){
    $t=time();
    $datum=(date("d.m.Y",$t));
    $text="<div class='row'><div class='col s12 m5'><div class='card-panel blue-grey darken-3'><label><b>News added [".$datum."]:</b></label><br>".$_POST['content']."<br><br></div></div></div>";
    $text.=file_get_contents("news_body.html");
    $text = str_replace(["\r\n", "\r", "\n"], "<br/>", $text);
    file_put_contents("news_body.html",$text);
    header("Location:news.php?admin=true&append=success");
    exit();
}
else{
    header("Location:news.php?admin=true&append=fail");
    exit();
}
?>



    <!--<div class="row">
        <div class="col s12 m5">
            <div class="card-panel teal">
            <span class="white-text">I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
            </span>
            </div>
        </div>
    </div>-->

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="styleJS.js"></script>
</body>
</html>-->