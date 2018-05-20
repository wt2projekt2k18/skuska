<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>   
    <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>
        Fast & FEIous
    </title>
</head>
<body id="gradientIndex">
<div class="navbar-fixed">
    <nav id="navbarIndex" class="blue-grey darken-4">
        <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo center"><img id="logoFast" src="img/run-with-fei-logo-white-720.png" alt="logo"></a>
        </div>
    </nav>
</div>

<div>
<?php
//TODO HTML struktura
echo "<label id=verify align='center'>";
if ($_GET['ver']) {
    require "config.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = $_GET['mail'];
    $code = $_GET['ver'];
    $query = $conn->query("SELECT `Verification` FROM `users` WHERE Email='$user'");
    $result = $query->fetch_assoc();

    if (!empty($result)) {
        if ($result['Verification'] == $code) {
            $conn->query("UPDATE `users` SET `Verified`=1 WHERE Email='$user'");
            $conn->close();
            echo "Verification was successful.";
        } else {
            $conn->close();
            echo "Error during verification.";
        }
    } else {
        $conn->close();
        echo "User not found.";
    }

} else {
    echo "Unexpected error has occoured.";
}
echo "</label>";
echo "<a href='index.php'><button>Homepage</button></a>";
?>
</div>

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
</body>
</html>
