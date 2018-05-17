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
    $text="<div><label><b>News added [".$datum."]:</b></label><br>".$_POST['content']."<br><br></div>";
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