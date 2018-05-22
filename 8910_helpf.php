<?php
include 'config.php';
$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");

class Mod_enum {
    private static $enum = array(1 => "private", 2 => "public", 3 => "relay");
    public function mod($id) {
        return self::$enum[$id];
    }
}

if(isset($_POST['user']) && !empty($_POST['user'])) {
	$id = $_POST['user'];
	$UserRoutes = $link->query("SELECT * FROM `routes` WHERE `user_id`=\"".$id."\" OR `type`=2");
	echo "	<tr id='clicked'><td>
			<table class='sortable'>
				<thead>
					<th>Start</th>
					<th>Finish</th>
					<th>Progress</th>
					<th>Type</th>
				</thead>
				<tbody>";
		if ($UserRoutes->num_rows > 0) {
			while($RouteRow = $UserRoutes->fetch_assoc()) {
				echo "	<tr>
							<td>".$RouteRow["start"]."</td>
							<td>".$RouteRow["end"]."</td>
							<td>".$RouteRow["progress"]."</td>
							<td>".Mod_enum::mod($RouteRow["type"])."</td>
						</tr>";
			}
		} else {
			echo "<tr><td>0 routes</td></tr>";
		}
		echo "</tbody></table></td></tr>";
}
?>