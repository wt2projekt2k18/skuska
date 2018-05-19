<?php

include '../config.php';

$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");

session_start();

if($_SESSION['id'] == null)
{
    header("HTTP/1.0 404 Not Found");
    echo "WAT";
}

$i = 0;

$condition  = "is_deleted IS FALSE";
$page       = !empty($_GET['page']) ? $_GET['page'] : 1;

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
{

}
else
{
    $condition = sprintf("user_id = %s OR type IN (2, 3)", $_SESSION['id'] );
}

$q = $link->query(sprintf("SELECT * FROM routes LEFT JOIN users ON users.id = routes.user_id WHERE %s LIMIT %s OFFSET %s", $condition, $per_page, ($page - 1 ) * $per_page ));

$routes = [];
$columns = [];


while ($field_info = mysqli_fetch_field($q))
{
    $columns[] = $field_info->name;
}

while($row = $q->fetch_row())
{
    $parsed_row = [];

    foreach ($columns as $key => $c)
    {
        $parsed_row[$c] = $row[$key];
    }

    $q2 = $link->query(sprintf("SELECT * FROM actives WHERE user_id = \"%d\" AND route_id = \"%d\"", $_SESSION['id'], $parsed_row['id']));

    if (!empty($q2->fetch_row()))
    {
        $parsed_row['is_active'] = true;
    }

    $routes[] = $parsed_row;
}
header("Content-Type: text/xml; charset=UTF-8");
echo json_encode($routes);