<?php
/**
 * Created by PhpStorm.
 * User: xkristian
 * Date: 18.5.2018
 * Time: 23:40
 */

require "../config.php";

$connection=mysqli_connect($servername, $username, $password, $dbname);
$connection->set_charset("utf8");

if ($_POST['typ'] === "school")
    $result = $connection->query("SELECT count(*) as total from users WHERE Schooladdress=\"" . $_POST['address'] . "\"");
else
    $result = $connection->query("SELECT count(*) as total from users WHERE 1");

$data=$result->fetch_assoc();

echo $data['total'];