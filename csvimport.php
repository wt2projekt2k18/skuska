<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 11-May-18
 * Time: 2:40 PM
 */
//header('Content-type: text/html; charset=UTF-8');
//echo "Info:<br>";
//echo "Meno:" . $_FILES['upload']['name'] . "<br>";
//echo "Extension:" . $_FILES['upload']['type'] . "<br>";
//echo "Error:" . $_FILES['upload']['error'] . "<br>";

switch ($_FILES['upload']['error']) {
    case 0:
        spracujdata();
        break;
    case 1:
    case 2:
        header("location:home.php?csverror=maxsize");
        exit();
        break;
    case 3:
        header("location:home.php?csverror=partial");
        exit();
        break;
    case 4:
        header("location:home.php?csverror=nofile");
        exit();
        break;
    case 6:
        header("location:home.php?csverror=notmpdir");
        exit();
        break;
    case 7:
        header("location:home.php?csverror=cantwrite");
        exit();
        break;
    case 8:
        header("location:home.php?csverror=wrongextension");
        exit();
        break;
    default:
        header("location:home.php?csverror=other");
        exit();
}
function spracujdata()
{
    $csv_mimetypes = array(
        'text/csv',
        'text/plain',
        'application/csv',
        'text/comma-separated-values',
        'application/excel',
        'application/vnd.ms-excel',
        'application/vnd.msexcel',
        'text/anytext',
        'application/octet-stream',
        'application/txt',
    );
    if (in_array($_FILES['upload']['type'], $csv_mimetypes)) {
        echo "csv OK<br>";
        //TODO Dalsie testy
        $subor = fopen($_FILES['upload']['tmp_name'], "r");
        fgetcsv($subor);//to skip first line

        // Create connection
        $servername = "localhost";
        $username = "root";
        $password = "Csinta2770";
        $dbname = "skuska";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($subor) {
            while (($buffer = fgets($subor, 4096)) !== false) {
                $splitted = explode(";", $buffer, PHP_INT_MAX);
                echo "<b>Priezvisko:</b> " . $splitted[1];
                echo "<b>Meno :</b>" . $splitted[2];
                echo "<b>Email :</b>" . $splitted[3];
                echo "<b>Skola</b>:" . $splitted[4];
                echo "<b>Skola (Adresa):</b>" . $splitted[5];
                echo "<b>Bydlisko (ulica):</b>" . $splitted[6];
                echo "<b>PSC:</b>" . $splitted[7];
                echo "<b>Bydlisko (obec):</b>" . $splitted[8];
                echo "<br>";
                $psw="DEfault2018WT";
                $newpsw=password_hash($psw,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users`( `Surname`, `Name`, `Email`,`Password`, `City`, `PSC`, `Address`, `School`, `Schooladdress`) VALUES (?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssisss", $splitted[1], $splitted[2], $splitted[3], $newpsw, $splitted[8], $splitted[7], $splitted[6], $splitted[4], $splitted[5]);
                $stmt->execute();
                $conn->query($sql);
                echo $conn->error."<br>";
            }
            if (!feof($subor)) {
                header("location:home.php?csverror=unexpected");
                exit();
            }
            fclose($subor);
            $conn->close();
            //header("location:home.php?csvsuccess=true");
            //exit();
        }
    } else {
        header("location:home.php?csverror=extensionerror");
        exit();
    }
}