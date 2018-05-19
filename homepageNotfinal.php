<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="sk">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="map/userMap.js" type="text/javascript"></script>
    <title>
        Fast & FEIous
    </title>
    <!--<script src="prototype.js" type="text/javascript"></script>-->
    
</head>
<body>
<header>
    <h1>
        Homepage
    </h1>
</header>
<div>
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
        echo "Ahoj, " . $_SESSION['name'];
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
            echo "<br>Signed in as administraton<br>";
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
        //else echo "<br>Obyčajný užívateľ";
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
<div id="map" style="height: 400px; width: 600px;"></div>
<div id="steps-panel">
    <p>Total Distance: <span id="dlzka-trasy"></span></p>
</div>


<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5J2wo0KFU2gxeSPhMAs1VA3MxALbXbKU&callback=initMap"></script>
</body>
</html>
