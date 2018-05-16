<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 15-May-18
 * Time: 22:12
 */

include '../config.php';

$link = mysqli_connect($servername, $username, $password, $dbname);

session_start();

if($_SESSION['id'] == null) {
    echo "WAT";
} else echo $_SESSION['id'];

$i=0;
$q = $link->query("SELECT * FROM routes WHERE user_id=\"" . $_SESSION['id'] . "\"");

while($row = $q->fetch_row()){
    echo "myarray[".$i."]='".$row['data']."';";
    $i++;
}