<?php
/**
 * Created by PhpStorm.
 * User: xkristian
 * Date: 16.5.2018
 * Time: 12:47
 */


//-----------------------------------------------------------------------------------------
//          Config
//-----------------------------------------------------------------------------------------

include '../config.php';

//-----------------------------------------------------------------------------------------
//          Enum
//-----------------------------------------------------------------------------------------

class Mod_enum {
    private static $enum = array(1 => "private", 2 => "public", 3 => "relay");

    public function mod($id) {
        return self::$enum[$id];
    }
}

//-----------------------------------------------------------------------------------------
//          DB connect
//-----------------------------------------------------------------------------------------

$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");

session_start();

//-----------------------------------------------------------------------------------------
//          Querries
//-----------------------------------------------------------------------------------------

//$q = $link->query("SELECT * FROM routes WHERE user_id=\"" . $_SESSION['id'] . "\"");
$routes = $link->query("SELECT * FROM routes");
$run = $link->query("SELECT * FROM run");

//-----------------------------------------------------------------------------------------
//          Table
//-----------------------------------------------------------------------------------------
/*
$i=0;
while($row = $q->fetch_row()){
    echo "myarray[".$i."]='".$row['data']."';";
    $i++;
}
*/
if ($routes->num_rows > 0)
{
    while($row = $routes->fetch_assoc())
    {
        echo "id: " . $row["id"]. " - user_id: " . $row["user_id"]. " - start: " . $row["start"]. " - end: " . $row["end"]. " - length: " . $row["length"]. " - progress: " . $row["progress"] . "%  - type: " . Mod_enum::mod($row["type"])."<br>";

        if ($run->num_rows > 0)
        {
            while($run_row = $run->fetch_assoc())
            {
                echo "-  id: " . $run_row["id"]. " - route_id: " . $run_row["route_id"]. " - start_time: " . $run_row["start_time"]. " - end_time: " . $run_row["end_time"]. " - progress_at_start: " . $run_row["progress_at_start"] . "%  - progress_at_end: " . $run_row["progress_at_end"] . "%" . "<br>";
            }
        } else
        {
            echo "0 routes";
        }
    }
} else
    {
        echo "0 routes";
    }

?>