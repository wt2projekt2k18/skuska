<?php
include '../config.php';

class Mod_enum
{
    private static $enum = array(1 => "private", 2 => "public", 3 => "relay");

    public function mod($id)
    {
        return self::$enum[$id];
    }
}

$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");

session_start();

$condition  = "is_deleted IS FALSE";
$page       = !empty($_GET['page']) ? $_GET['page'] : 1;

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
{

}
else
{
    $condition = sprintf("%s AND user_id = %s OR type IN (2, 3)", $condition, $_SESSION['id'] );
}
$routes = $link->query(sprintf("SELECT * FROM routes LEFT JOIN users ON users.id = routes.user_id WHERE %s LIMIT %s OFFSET %s", $condition, $per_page, ($page - 1 ) * $per_page ));
$total = $link->query(sprintf("SELECT COUNT(routes.id) as total FROM routes WHERE %s", $condition ));

?>


<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="https://drvic10k.github.io/bootstrap-sortable/Contents/bootstrap-sortable.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css"
      rel="stylesheet"/>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://drvic10k.github.io/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>

<style>
    

    th:hover {
        color: black;
    }
	
	th, .c {
        text-align: center;
    }

    /*.switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 23px;
    }

    .switch input {
        display: none;
    }

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

    // Rounded sliders
    .slider.round {
        border-radius: 23px;
    }

    .slider.round:before {
        border-radius: 50%;
    }*/
</style>

<table id="main" class="sortable" style="width: 100%; max-width: 100%;">
    <thead>
    <th>From</th>
    <th>To</th>
    <th>Progress</th>
    <th>Type</th>
	
    <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            echo "<th>By</th>";
    ?>
	
    <th>Actions</th>
    </thead>
    <tbody>
    <?php
    if (!empty($routes))
    {
        foreach ($routes as $route)
        {

            echo "<tr >"; // class='click'

            echo "<td>" . $route['start'] . "</td>";
            echo "<td>" . $route['end'] . "</td>";
            echo "<td class='c'>" . $route['progress'] . "</td>";					// class='c'
            echo "<td class='c'>" . Mod_enum::mod($route['type']) . "</td>";		// class='c'
			
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                echo "<td class='c'>" . $route['Name'] . " " . $route['Surname'] ."</td>";	// class='c'
			
            echo "<td class='c'><div class=\"switch\"><label >"; // col s12  <div class=\"container\">

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            {
                $active = $link->query(sprintf("SELECT `route_id` FROM `actives` WHERE route_id = %d;",  $route['id']));

            } else {
                $active = $link->query(sprintf("SELECT `route_id` FROM `actives` WHERE route_id = %d AND user_id = %d;",  $route['id'], $_SESSION['id']));
            }

            mysqli_data_seek($active, 0);

            $ac = $active->fetch_assoc();

            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                if ($ac["route_id"] === $route["id"]) {
                    echo "<input type=\"checkbox\" checked disabled>";
                } else {
                    echo "<input type=\"checkbox\" disabled>";
                }

                echo "<span class=\"lever\" data-id=\"" . $route['id'] . "\"></span></label></div></td>"; // </div>

            }else{
                if ($ac["route_id"] === $route["id"]) {
                    echo "<input type=\"checkbox\" id=\"" . $route['id'] . "\" checked >";
                } else {
                    echo "<input type=\"checkbox\" id=\"" . $route['id'] . "\">";
                }

                echo "<span class=\"lever switch-active-slider\" data-id=\"" . $route['id'] . "\"></span></label></div></td>"; // </div>

            }

            //echo "<span class=\"lever switch-active-slider\" data-id=\"" . $route['id'] . "\"></span></label></div></td>"; // </div>

            // TODO sem ide este jeden stlpec kde budu linky na edit a delete

            echo "</tr>";
        }
    }
    ?>
    </tbody>
    <tfoot>
    <?php
    $total = $total->fetch_row()[0];
    $total_pages = !empty($total) ? ceil($total / $per_page) : 1;

    echo "<tr>";
    echo "<td>";
    for ($i = 1 ; $i <= $total_pages ; $i ++)
    {
        echo '<a href="" class="routeTablePage ' . ($page == $i ? "active" : "") . '" data-page="' . $i . '">' .$i . '</a>';
    }
    echo "</td>";
    echo "</tr>";

    ?>

    </tfoot>
</table>