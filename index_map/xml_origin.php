<?php
/**
 * Created by PhpStorm.
 * User: csgo
 * Date: 18.5.2018
 * Time: 19:59
 */


require("../config.php");

// Start XML file, create parent node
//$doc = domxml_new_doc("1.0");
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


// Opens a connection to a MySQL server
$connection=mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
    die('Not connected');
}
$connection->set_charset("utf8");

// Set the active MySQL database
//$db_selected = mysql_select_db(, $connection);
//if (!$db_selected) {
//    die ('Can\'t use db : ' . mysql_error());
//}

// Select all the rows in the markers table
//$query = "SELECT City,PSC,Address FROM users";
$query = "SELECT City,PSC,Address,Admin FROM users";
$result = $connection->query($query);
if (!$result) {
    die('Invalid query');
}

header("Content-type: text/xml; charset=utf-8");

// Iterate through the rows, adding XML nodes for each

while ($row = $result->fetch_assoc()){
    if($row['Admin']==0) {
        // Add to XML document node
        $node = $dom->createElement("marker");
        $newnode = $parnode->appendChild($node);
//    $newnode->setAttribute("id",$row['id']);
        $newnode->setAttribute("city", $row['City']);
        $newnode->setAttribute("address", $row['Address']); //
        $newnode->setAttribute("PSC", $row['PSC']);
//    $newnode->setAttribute("lng", $row['lng']);
//    $newnode->setAttribute("type", $row['type']);
    }
}

echo $dom->saveXML();

?>