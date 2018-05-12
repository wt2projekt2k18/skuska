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
        Názov stránky
    </h1>
</header>
<div>
<?php
//TODO HTML struktura
echo "<label id=verify>";
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
            echo "Verifikácia bola úspešná";
        } else {
            $conn->close();
            echo "Chyba pri verifikácií";
        }
    } else {
        $conn->close();
        echo "Užívateľ nebol nájdený";
    }

} else {
    echo "Neočakávaná chyba";
}
echo "</label>";
echo "<a href='index.php'><button>Úvodná stránka</button></a>";
?>
</div>
</body>
</html>
