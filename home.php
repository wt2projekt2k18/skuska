<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/plain; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> <!--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

    <title>
        Fast & FEIous
    </title>
    <style>
        /*#map {
            height: 100%;
        }*/
        /*html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }*/
    </style>
</head>
<body id="gradientIndex">

<?php
    if(isset($_POST['start']) AND $_POST['start'] != null) {
        echo $_POST['start'];
        echo $_POST['end'];
    }
?>


<nav class="nav-extended blue-grey darken-4">
    <div class="nav-wrapper">
        <a href="home.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png" alt="logo"></a>

        <ul class="right">
            <li><a class='waves-effect waves-light white-text' href='index_map/indexGmap_final.php'><i class='material-icons white-text'>map</i></a></li>
            <li><a class='waves-effect waves-light white-text' href='news.php?admin=true'><i class='material-icons white-text'>fiber_new</i></a></li>
        </ul>

    </div>
    <div class="nav-content">
        <ul class="tabs tabs-transparent tabs-fixed-width">
            <li class="tab"><a class="active" href="#routeForm">Route</a></li>
            <li class="tab"><a href="#test2">Test2</a></li>
            <li class="tab"><a href="#test3">Test3</a></li>
            <li class="tab"><a href="#csvContainer">CSV</a></li>
        </ul>
    </div>  
</nav>    

<a id="sidenavButton" href="#" data-target="slide-out" class="sidenav-trigger teal btn waves-effect waves-light white-text"><i class="material-icons white-text">menu</i></a>


<ul id="slide-out" class="sidenav blue-grey darken-3">
    <li><div class="user-view">
        <div class="background">
        <img src="img/sw.jpg">
        </div>
        <a href="#"><i class="material-icons white-text large">person</i></a>
        <a href="#"><span class="white-text name">User</span></a>
        <a href="#"><span class="white-text info">info</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link</a></li>

    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">RandomLink</a></li>
    <form action="logout.php" method="post" class="container">
        <input type="submit" name="logout" value="logout" class="btn waves-effect waves-light ">    
    </form>
    
</ul>

<div id="test2" class="col s12 container tabWrapper">Test 2</div>
<div id="test3" class="col s12 container tabWrapper">Test 3</div>

<div id="csvContainer" class="col s12 container tabWrapper white-text">
<!--<div id="csvContainer" class="">-->
    <?php
    require "config.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION['email'])) {
        echo "" . $_SESSION['name'];
    } elseif (isset($_POST['login'])) {
        $login = $_POST['email'];
        $heslo = $_POST['password'];
        $sql = $conn->query("SELECT * FROM `users` WHERE Email='$login'");
        $result = $sql->fetch_assoc();
        $conn->close();
        if (!empty($result)) {
            if (password_verify($heslo, $result['Password'])) {
                if ($result["Verified"] == 1) {
                    $_SESSION['email'] = $result['Email'];
                    $_SESSION['id'] = $result['ID'];
                    $_SESSION['password'] = $result['Password'];
                    $_SESSION['name'] = $result['Name'];
                    $_SESSION['surname'] = $result['Surname'];
                    $_SESSION['city'] = $result['City'];
                    $_SESSION['address'] = $result['Address'];
                    $_SESSION['psc'] = $result['PSC'];
                    $_SESSION['school'] = $result['School'];
                    $_SESSION['schooladdress'] = $result['Schooladdress'];
                    $_SESSION['admin'] = $result['Admin'];
                    echo "Ahoj, " . $_SESSION['name'];
                    //TODO
                } else {
                    if ($result["Verified"] == 2) {
                        echo "<form id='setpsw' action='newpassword.php' method='post'>
                        <input type='hidden' name='usermail' value='".$result['Email']."'>
                        </form>";
                        echo "<script>document.getElementById('setpsw').submit();</script>";
                        exit();
                    }
                    header("Location:index.php?login=notverified");
                    exit();
                }
            } else {
                header("Location:index.php?login=wrongpassword");
                exit();
            }
        } else {
            header("Location:index.php?login=wronguser");
            exit();
        }
    } else {
        header("Location:index.php?login=error");
        exit();
    }

    if (isset($_SESSION['admin'])) {
        if ($_SESSION['admin'] == 1) {
            echo " signed in as admin<br>";
            echo "<form action='csvimport.php' method='post' enctype='multipart/form-data'>" .
                "<label>Please choose a csv file:" .
                "<label style='background-color:gray; cursor:pointer; text-decoration:underline;' for='upload'>Click here</label>" .
                "<input type='hidden' name='MAX_FILE_SIZE' value='100000' />" .
                "<input id='upload' style='display:none;' type='file' name='upload' value='csv'/></label>" .
                "<input type='submit' name='submit' value='Import users'>" .
                "</form>";
            if ($_GET['csverror']) {
                echo "<label style='color:red' id=csv_err_msg>";
                switch ($_GET['csverror']) {
                    case "maxsize":
                        echo "The file is too large.";
                        break;
                    case "partial":
                        echo "The file was only partially uploaded.";
                        break;
                    case "nofile":
                        echo "No file chosen.";
                        break;
                    case "notmpdir":
                        echo "Error in temporary directory.";
                        break;
                    case "cantwrite":
                        echo "Could not write to file.";
                        break;
                    case "wrongextension":
                        echo "File has unsupported extension.";
                        break;
                    case "extensionerror":
                        echo "Your file isn't a csv file.";
                        break;
                    default:
                        echo "An unexpected error ha occoured.";
                }
                if ($_GET['csvsuccess=true']) {
                    echo "<label style='color:green' id=csv_success_msg>";
                    echo "Users have been successfully imported from the csv file";
                }
                echo "</label>";
            }
        }
        //else echo " user";
    } else {
        header("Location:index.php?login=sessionerror");
        exit();
    }

    ?>
    <form action="logout.php" method="post" class="container">
        <input type="submit" name="logout" value="logout" class="btn waves-effect waves-light ">    
    </form>
</div>

<div id="routeForm" class="col s12 tabWrapper container ">
    <div class="row">
        <form action="#" id="formNewRoute" enctype="multipart/form-data" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input id="startSearch" type="text" name="start" class="white-text" placeholder="" required>
                    <<label>Start</label>
                </div>
                <div class="input-field col s6">
                    <input id="endSearch" type="text" name="end" class="white-text" placeholder="" required>
                    <label>End</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select name="type">                   
                        <option value="1">Private mode</option>
                        <?php
                        if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
                        {
                            echo '<option value="2">Public mode</option>';
                            echo '<option value="3">Štafetový mode</option>';
                        }
                        ?>       
                    </select>
                    <label>Select mode</label>
                </div>
                <div class="col s3" align="center">
                    <input type="button" id="submitNewRoute" value="New" class="btn">
                </div>
                <div class="col s3">
                    <a class="waves-effect waves-light btn modal-trigger" href="#allRoutes">All</a>
                </div>
                
            </div>
        </form>
    </div>
    
</div>

<div id="map" style="height: 720px"></div>

<div id="allRoutes" class="modal bottom-sheet">
    <div class="modal-content blue-grey darken-4 white-text">

    <?php
        if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
        {
            echo '<div class="row"><div class="input-field col s12"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names"></div></div>';
        }
    ?>

        <div id="routeTable"></div>
    </div>
    <div class="modal-footer">
      
    </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5J2wo0KFU2gxeSPhMAs1VA3MxALbXbKU&callback=initMap&libraries=places,geometry"></script>

<script>

    var currentPage = 1;

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

    function refreshTable(page) {
        $.ajax({
            url : "https://www.webte2tim18.sk/Projekt_ku_skuske/map/route_table.php",
            method: "GET",
            data : {
                page : page
            },
            success : function (data) {
                $('#routeTable').html(data);

                $('#routeTable .routeTablePage').on('click', function (e) {
                    e.preventDefault();
                    refreshTable($(this).data('page'));
                });

                currentPage = page;
                initMap({
                    page : page
                })
            }
        });
    }

    refreshTable(1);

    $('body').on('click', '#submitNewRoute', function (e) {

        e.preventDefault();

        var params = $('#formNewRoute').serialize();

        if (typeof startPlaceLocation !== "undefined" && typeof endPlaceLocation !== "undefined") {
            var startLat = startPlaceLocation.lat();
            var startLon = startPlaceLocation.lng();

            var endLat = endPlaceLocation.lat();
            var endLon = endPlaceLocation.lng();

            var distance = google.maps.geometry.spherical.computeDistanceBetween (startPlaceLocation, endPlaceLocation);

            params += "&start_lat=" + startLat;
            params += "&start_long=" + startLon;
            params += "&end_lat=" + endLat;
            params += "&end_long=" + endLon;
            params += "&length=" + distance;
        }

        $.ajax({
            method : "POST",
            url : "https://www.webte2tim18.sk/Projekt_ku_skuske/map/save_route.php",
            data : params,
            success: function (data) {
                console.log(data);
                refreshTable(1);
            },
            error : function (data) {
                console.log(data);
                data = JSON.parse(data.responseText);
                var message = '';


                for (var i = 0 ; i < data.errors.length ; i++) {
                    message += data.errors[i] + "\n";
                }
                alert(message);
            }
        });
    });

    $('body').on('click', '.switch-active-slider', function () {
        $.ajax({
            method : "POST",
            data : {
                id : $(this).data('id')
            },
            url: "https://www.webte2tim18.sk/Projekt_ku_skuske/map/change_route_status.php",
            success : function (data) {
                console.log(JSON.parse(data));

                initMap({
                    page : currentPage
                });
            },
            error : function (d) {
                d = JSON.parse(d.responseText);

                console.log(d);
            }
        });
    });
</script>

<footer class="page-footer blue-grey darken-4">
    <div class="footer-copyright blue-grey darken-3">
        <div class="container">
            &copy; 2018 WEBTE2
            <a class="grey-text text-lighten-4 right" href="about.html">About</a>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="styleJS.js"></script>
<script src="map/userMap.js" type="text/javascript"></script>
</body>
</html> 
