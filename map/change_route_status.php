<?php

include '../config.php';

$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");

session_start();

//var_dump($_POST[]);

$bu = $link->query(sprintf("SELECT * FROM actives WHERE user_id = %d", $_SESSION['id']));
$bum = $bu->fetch_assoc();

if ( !empty($bum) && !($bum['route_id'] == $_POST['id']))
{
    $doc = new DomDocument;
    $doc->validateOnParse = true;
    $doc->getElementById($_POST['id'])->removeAttribute("checked");
    echo "uz mas aktivnu trasu";

} else {

    if (!empty($_POST['id'])) {
        $q = $link->query(sprintf("SELECT * FROM actives WHERE user_id = %d AND route_id = %d", $_SESSION['id'], $_POST['id']));
//    $q = $link->query(sprintf("SELECT * FROM actives WHERE route_id = %d", $_POST['id']));

        if ($q->num_rows > 0) {
            $q = $link->query(sprintf("DELETE FROM actives WHERE user_id = %d AND route_id = %d", $_SESSION['id'], $_POST['id']));
//        $q = $link->query(sprintf("DELETE FROM actives WHERE route_id = %d", $_POST['id']));
        } else {
            $q = $link->query(sprintf("INSERT INTO actives (user_id, route_id ) VALUES (%d,%d)", $_SESSION['id'], $_POST['id']));
//        $q = $link->query(sprintf("INSERT INTO actives ( route_id ) VALUES (%d)", $_POST['id']));
        }

    }
}

