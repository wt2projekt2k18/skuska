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

    /* Rounded sliders */
    .slider.round {
        border-radius: 23px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<table id="main" class="sortable" style="width: 100%;">
    <thead>
    <th>From</th>
    <th>To</th>
    <th>Progress</th>
    <th>Type</th>
    <th>By</th>
    <th>Actions</th>
    </thead>
    <tbody>
    <?php
    if (!empty($routes))
    {
        foreach ($routes as $route)
        {

            echo "<tr>";

            echo "<td>" . $route['start'] . "</td>";
            echo "<td>" . $route['end'] . "</td>";
            echo "<td>" . $route['progress'] . "</td>";
            echo "<td>" . $route['type'] . "</td>";
            echo "<td>" . $route['Name'] . " " . $route['Surname'] ."</td>";
            echo "<td><label class=\"switch\">";

            $active = $link->query(sprintf("SELECT `route_id` FROM `actives` WHERE route_id = %d AND user_id = %d;",  $route['id'], $_SESSION['id']));

            mysqli_data_seek($active, 0);

            $ac = $active->fetch_assoc();

            if($ac["route_id"] === $route["id"])
            {
                echo "<input type=\"checkbox\" checked>";
            }
            else
            {
                echo "<input type=\"checkbox\" >";
            }

            echo "<span class=\"slider switch-active-slider round\" data-id=\"" . $route['id'] . "\"></span></label></td>";

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