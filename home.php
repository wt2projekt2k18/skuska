<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> <!--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"-->
    <!--<script src="prototype.js" type="text/javascript"></script>-->
    <!--<script src="map/userMap.js" type="text/javascript"></script>-->
    <title>
        Fast & FEIous
    </title>
    <style>
        #map {
            height: 100%;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body id="gradientIndex">
<div class=" "> <!--navbar-fixed-->
    <nav id="navbarIndex" class="nav-extended blue-grey darken-4">
        <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png" alt="logo"></a>

            <ul class="right">
                <li><a class='waves-effect waves-light white-text' href='where_you_from.php'><i class='material-icons white-text'>map</i></a></li>
                <li><a class='waves-effect waves-light white-text' href='news.php?admin=true'><i class='material-icons white-text'>fiber_new</i></a></li>
            </ul>

            <div class="nav-content">
                <ul class="tabs tabs-transparent">
                    <li class="tab disabled"><a href="#test1">Disabled</a></li>
                    <li class="tab disabled"><a href="#test2">Disabled</a></li>
                    <li class="tab disabled"><a href="#test3">Disabled</a></li>
                    <li class="tab"><a href="#csvContainer" class="active">CSV import</a></li>
                </ul>
            </div>

        </div>
    </nav>
    
</div>
<div id="test1" class="col s12 container">Test 1</div>
<div id="test2" class="col s12 container">Test 2</div>
<div id="test3" class="col s12 container">Test 3</div>
<!--<div id="test4" class="col s12 container">CSV import</div>-->


<!--<form action="#">
        <div class="file-field input-field">
            <div class="btn">
            <span>File</span>
            <input type="file">
            </div>
            <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
            </div>
        </div>
    </form>-->


<div id="csvContainer" class="container center-align white-text">
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
            echo " signed in as admin";
            echo "<form action='csvimport.php' method='post' enctype='multipart/form-data'><div class='row'>" .
                "<div class='file-field input-field'><div class='btn' for='upload'><span>File</span><input id='upload' type='file' name='upload' value='csv'></div>" .
                "<div class='file-path-wrapper'><input class='file-path validate' type='text'></div>" .
                "<input type='hidden' name='MAX_FILE_SIZE' value='100000' />" .
                "<input id='upload' style='display:none;' type='file' name='upload' value='csv'/>" .

                /*"<label style='background-color:gray; cursor:pointer; text-decoration:underline;' for='upload'>Click here</label>" .*/
                /*"<input type='hidden' name='MAX_FILE_SIZE' value='100000' />" .*/
                /*"<input id='upload' style='display:none;' type='file' name='upload' value='csv'/></label>" .*/
                
                "</div>" .
                "</div>" .
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

</div>
<form action="logout.php" method="post">
    <input type="submit" name="logout" value="logout">
</form>

<!-- GOOGLE MAP -->
<!--<div id="map" style="height: 400px; width: 600px;"></div>-->
<!--<div id="map" class="container" style="height: 500px"></div>-->
<!--<div id="steps-panel">
    <p>Total Distance: <span id="dlzka-trasy"></span></p>
</div>-->

<!--<div class="row">-->
    <!--<div class="col  grey">
        <ul class="collapsible expandable">
            <li>
                <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
        </ul>
    </div>-->
    <!--<div id="map" class="col s9" style="height: 500px"></div>-->    
<!--</div>-->

<!--<script src="where_you_from_JS.js" type="text/javascript"></script>-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5J2wo0KFU2gxeSPhMAs1VA3MxALbXbKU&callback=initMap"></script>

<footer class="page-footer blue-grey darken-4">
    <div class="footer-copyright blue-grey darken-3">
        <div class="container">
            &copy; 2018 WEBTE2
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<script src="styleJS.js"></script>
</body>
</html>
