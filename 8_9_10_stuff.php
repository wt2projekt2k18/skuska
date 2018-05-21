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
$_SESSION['id'] = 549;
//


// Queries
$admin = $link->query("SELECT `Admin` FROM `users` WHERE `ID`=\"".$_SESSION['id']."\"");
$users = $link->query("SELECT * FROM `users`");

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
		<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    </head>
	<style>
		table {width: 100%; border: 2px solid green;}
		tr,td {padding:5px;}
	</style>
    <body>
		<div id="tablecontent">
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
					   echo "<tr id=".$userrow[ID]." onclick=getUserRoutes(".$userrow[ID].")>
								<td>".$userrow["Name"]."</td>
								<td>".$userrow["Surname"]."</td>
							</tr>";
                    }
                } else {
                    echo "<tr><td>No users</td></tr>";
                }
            } else {
				$UserRoutes = $link->query("SELECT * 
											FROM `routes` 
											INNER JOIN `run` 
												ON `run.route_id`=`routes.id` 
											WHERE `routes.user_id`=\"".$_SESSION['id']."\" 
												OR `routes.type`=2");
				echo " 	<thead>
							<tr>
								<th>Length</th>
								<th>Day</th>
								<th>Start and finish</th>
								<th>GPS</th>
								<th>Rating</th>
								<th>Note</th>
								<th>Speed</th>
							</tr>
						</thead> ";
				if ($UserRoutes->num_rows > 0) {
					while($RouteRow = $UserRoutes->fetch_assoc()) {
						echo "	<tr>
									<td>".$RouteRow["Kilometers"]."km </td>
									<td>".$RouteRow["Day"]." </td>
									<td>".$RouteRow["start_time"]." to ".$RouteRow["end_time"]."</td>
									<td>".number_format("$RouteRow[GPS_start]",3)." / ".number_format("$RouteRow[GPS_end]",3)."</td>
									<td>".$RouteRow["Rating"]."</td>
									<td>".$RouteRow["Comment"]."</td>
									<td>TODO speed</td>
								</tr>";
					}
				} else {
					echo "<tr><td>0 routes</td></tr>";
				}
            }
            ?>
        </table>
		</div>
		<?php if(!$adm["Admin"]) { echo "<button id='export'>Export to PDF</button>"; } ?>
	<script type="text/javascript">
	function getUserRoutes(id){
		$.ajax({
			type: "POST",
			url: "8910_helpf.php",
			data:{user: id},
			context: this,
			success: function(data){
				$("#clicked").remove(); 
				$(data).insertAfter("#"+id).closest('tr');
			}
		});
	}
	
	$("#export").click(function() {
		var pdf = new jsPDF('p', 'pt', 'ledger');
		source = $('#tablecontent')[0];
		specialElementHandlers = {
			'#bypassme' : function(element, renderer) {
				return true
			}
		};
		margins = {
			top : 80,
			bottom : 60,
			left : 60,
			width : 522
		};
		pdf.fromHTML(source,
			margins.left,
			margins.top, {
				'width' : margins.width,
				'elementHandlers' : specialElementHandlers
			},

			function(dispose) {
				pdf.save('table.pdf');
			}, margins);
	});
    </script>
	
	</body>
</html>