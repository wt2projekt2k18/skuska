
<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17-May-18
 * Time: 11:34 AM
 */

if(isset($_POST['content'])){
    $t=time();
    $datum=(date("d.m.Y",$t));
    $text="<div class='row'><div class='col s8 offset-s2'><div class='card teal hoverable'><div class=' card-content white-text'><p>".$_POST['content']."<br></p></div><div class='card-action white-text center-align'>News added on ".$datum."</div></div></div></div>";
    $text.=file_get_contents("news_body.html");
    $text = str_replace(["\r\n", "\r", "\n"], "<br/>", $text);
    file_put_contents("news_body.html",$text);
    header("Location:news.php?admin=true");
    exit();
}
else{
    header("Location:news.php?admin=true&append=fail");
    exit();
}

