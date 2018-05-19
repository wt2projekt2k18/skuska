<?php
include 'config.php';

if(isset($_POST['user']) && !empty($_POST['user'])) {
	$id = $_POST['user'];
    //echo "php is fine: $id";
	echo "<table><tr><td>$id</td></tr></table>";
	//$UserRoutes = $link->query("SELECT * FROM `routes` WHERE `user_id`=\"".$id."\" OR `type`=2");
}
?>