<?php
include 'config.php';

// Enum
class Mod_enum {
    private static $enum = array(1 => "private", 2 => "public", 3 => "relay");
    public function mod($id) {
        return self::$enum[$id];
    }
}

// DB connect
$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");
session_start();


//test session
$_SESSION['id'] = 404;
//


// Queries
//$q = $link->query("SELECT * FROM routes WHERE user_id=\"" . $_SESSION['id'] . "\"");
$routes = $link->query("SELECT * FROM `routes`");
$admin = $link->query("SELECT `Admin` FROM `users` WHERE `ID`=\"" . $_SESSION['id'] . "\"");
$users = $link->query("SELECT * FROM `users`");
$loggeduser = $link->query("SELECT * FROM `users` WHERE `ID`=\"" . $_SESSION['id'] . "\"");
//$run = $link->query("SELECT * FROM run WHERE `route_id`=\"" . $route_row[] . "\"");

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
    </head>
    <body>
        <table id="main" class="sortable">
            <?php
            $adm = $admin->fetch_assoc();
            if($adm["Admin"]) {
				echo " 	<thead>
							<th>Meno</th>
							<th>Priezvisko</th>
						</thead> ";
                if ($users->num_rows > 0) {
                    while($userrow = $users->fetch_assoc()) {
                       //echo "<tr onClick='location.href=\"?usertable=$userrow[ID]\"'>
					   echo "<tr onclick=getUserRoutes(".$userrow[ID].")>
								<td>".$userrow["Name"]."</td>
								<td>".$userrow["Surname"]."</td>
							</tr>";
                    }
                } else {
                    echo "<tr><td>No users</td></tr>";
                }
            } else {
				$UserRoutes = $link->query("SELECT * FROM `routes` WHERE `user_id`=\"" . $_SESSION['id'] . "\" OR `type`=2");
				echo " 	<thead>
							<th>Start</th>
							<th>Finish</th>
							<th>Progress</th>
							<th>Type</th>
						</thead> ";
				if ($UserRoutes->num_rows > 0) {
					while($RouteRow = $UserRoutes->fetch_assoc()) {
						echo "	<tr>
									<td>".$RouteRow["start"]." </td>
									<td>".$RouteRow["end"]."</td>
									<td>".$RouteRow["progress"]."</td>
									<td>".Mod_enum::mod($RouteRow["type"])."</td>
								</tr>";
					}
				} else {
					echo "<tr><td>0 routes</td></tr>";
				}
            }
            ?>
        </table>
		
	<script type="text/javascript">
	function getUserRoutes(id){
		$.ajax({
			type: "POST",
			url: "8_helpf.php",
			data:{user: id},
			context: this,
			success: function(data){
				console.log(this);
				//$(this).append(data);
			}
		});
	}
    </script>
	
	</body>
</html>