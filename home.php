<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>
        Projekt ku skúške
    </title>

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
                $_SESSION['email'] = $result['Email'];
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
            echo "<br>Prihlásený ako admin<br>";
            echo "<form action='csvimport.php' method='post' enctype='multipart/form-data'>" .
                "<label>Zvoľ csv súbor:" .
                "<label style='background-color:gray; cursor:pointer; text-decoration:underline;' for='upload'>Klikni sem</label>" .
                "<input type='hidden' name='MAX_FILE_SIZE' value='100000' />" .
                "<input id='upload' style='display:none;' type='file' name='upload' value='csv'/></label>" .
                "<input type='submit' name='submit' value='Nahrať užívateľov'>" .
                "</form>";
            if ($_GET['csverror']) {
                echo "<label style='color:red' id=csv_err_msg>";
                switch ($_GET['csverror']) {
                    case "maxsize":
                        echo "Súbor je príliš veľký.";
                        break;
                    case "partial":
                        echo "Nebol nahraný celý súbor.";
                        break;
                    case "nofile":
                        echo "Nebol zvolený súbor.";
                        break;
                    case "notmpdir":
                        echo "Chyba v tmp priečinku.";
                        break;
                    case "cantwrite":
                        echo "Chyba pri zápise.";
                        break;
                    case "wrongextension":
                        echo "Chyba pri zistení typu súboru.";
                        break;
                    case "extensionerror":
                        echo "Nahrali ste iný súbor ako .csv";
                        break;
                    default:
                        echo "Iná chyba pri spracovaní súboru";
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
<!--<footer>-->
<!--    <h2>-->
<!--        *footer here*-->
<!--    </h2>-->
<!--</footer>-->

</body>
</html>
