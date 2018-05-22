<?php
/**
 * Created by PhpStorm.
 * User: xkristian
 * Date: 16.5.2018
 * Time: 17:59
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

$_SESSION['id'] = 69;

//-----------------------------------------------------------------------------------------
//          Some Querries
//-----------------------------------------------------------------------------------------

//$q = $link->query("SELECT * FROM routes WHERE user_id=\"" . $_SESSION['id'] . "\"");
$routes = $link->query("SELECT * FROM routes");
$admin = $link->query("SELECT `Admin` FROM `users` WHERE `ID`=\"" . $_SESSION['id'] . "\"");
//$run = $link->query("SELECT * FROM run WHERE `route_id`=\"" . $route_row[] . "\"");

$user_table = $link->query("SELECT * FROM `routes` WHERE `user_id`=\"" . $_SESSION['id'] . "\" OR `type`=2");

//-----------------------------------------------------------------------------------------
//          Table
//-----------------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://drvic10k.github.io/bootstrap-sortable/Contents/bootstrap-sortable.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://drvic10k.github.io/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>

        <style>
            #myInput {
                background-position: 10px 12px; /* Position the search icon */
                background-repeat: no-repeat; /* Do not repeat the icon image */
                width: 100%; /* Full-width */
                font-size: 16px; /* Increase font-size */
                padding: 12px 20px 12px 40px; /* Add some padding */
                border: 1px solid #ddd; /* Add a grey border */
                margin-bottom: 12px; /* Add some space below the input */
            }

            .switch {
                position: relative;
                display: inline-block;
                width: 40px;
                height: 23px;
            }

            .switch input {display:none;}

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 20px;
                width: 20px;
                left: 2px;
                bottom: 2px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked + .slider {
                background-color: #2196F3;
            }

            input:focus + .slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked + .slider:before {
                -webkit-transform: translateX(17px);
                -ms-transform: translateX(17px);
                transform: translateX(17px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 23px;
            }

            .slider.round:before {
                border-radius: 50%;
            }
        </style>
    </head>

    <body>

        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <table id="main" class="sortable">
            <thead>
            <th >From</th>
            <th >To</th>
            <th >Progress</th>
            <th >Type</th>
            <th >By</th>
            <th></th>
            </thead>
            <?php

            $adm = $admin->fetch_assoc();
            if($adm["Admin"])
            {
                $active = $link->query("SELECT `route_id` FROM `actives`");

                if ($routes->num_rows > 0)
                {
                    while($reoute_row = $routes->fetch_assoc())
                    {
                        $surname = $link->query("SELECT Surname FROM `users` WHERE `ID`=\"" . $reoute_row["user_id"] . "\"")->fetch_assoc();

                        echo "  <tr>
                                <td>" . $reoute_row["start"]. " </td>
                                <td> " . $reoute_row["end"]. "</td>
                                <td>" . $reoute_row["progress"] . "</td>
                                <td>" . Mod_enum::mod($reoute_row["type"])."</td>
                                <td>" . $surname["Surname"] . "</td>
                                <td>
                                    <label class=\"switch\">";

                        $ano = false;
                        mysqli_data_seek($active, 0);
                        while($ac = $active->fetch_assoc()) {
                            if ($ac["route_id"] === $reoute_row["id"]) {
                                $ano = true;
                                break;
                            }
                        }
                        if ($ano) {
                            echo "<input type=\"checkbox\" checked>";
                        } else {
                            echo "<input type=\"checkbox\" >";
                        }
                        echo "               
                                        <span class=\"slider round\"></span>
                                    </label>
                                </td>
                            </tr>";
                    }
                } else
                {
                    echo "<tr><td>0 routes</td></tr>";
                }

            }
            else {

            $active = $link->query("SELECT `route_id` FROM `actives` WHERE `user_id`=\"" . $_SESSION['id'] . "\"");

            if ($user_table->num_rows > 0)
            {
                while($reoute_row = $user_table->fetch_assoc())
                {
                    echo "  <tr>
                                <td>" . $reoute_row["start"]. " </td>
                                <td> " . $reoute_row["end"]. "</td>
                                <td>" . $reoute_row["progress"] . "</td>
                                <td>" . Mod_enum::mod($reoute_row["type"])."</td>
                                <td>
                                    <label class=\"switch\">";

                                    mysqli_data_seek($active, 0);
                                    $ac = $active->fetch_assoc();

                                    if($ac["route_id"] === $reoute_row["id"])
                                    {
                                        echo "<input type=\"checkbox\" checked>";
                                    }
                                    else
                                    {
                                        echo "<input type=\"checkbox\" >";
                                    }
                    echo "               
                                        <span class=\"slider round\"></span>
                                    </label>
                                </td>
                            </tr>";
                }
            } else
            {
                echo "<tr><td>0 routes</td></tr>";
            }

            }

            ?>
        </table>

        <script>
            function myFunction() {
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("main");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[4];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>

        </body>

</html>