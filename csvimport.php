<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 11-May-18
 * Time: 2:40 PM
 */

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

//credit:https://stackoverflow.com/questions/10653735/set-utf-8-encoding-for-fread-fwrite
function utf8_fopen_read($fileName)
{
    $fc = iconv('windows-1250', 'utf-8', file_get_contents($fileName));
    $handle = fopen("php://memory", "rw");
    fwrite($handle, $fc);
    fseek($handle, 0);
    return $handle;
}

function randomstring($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, $max)];
    }
    return $string;
}


function spracujdata()
{
    $mailstring = "<table> <tr><th>Priezvisko</th><th>Meno</th><th>Heslo</th></tr>";
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
        $subor = utf8_fopen_read($_FILES['upload']['tmp_name']);
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
                $konstanta = 2;
                $psw = randomstring(20);
                $newpsw = password_hash($psw, PASSWORD_DEFAULT);
                $mailstring .= "<tr><td>" . $splitted[1] . "</td><td>" . $splitted[2] . "</td><td>" . $psw . "</td></tr>";
                $sql = "INSERT INTO `users`( `Surname`, `Name`, `Email`,`Password`, `City`, `PSC`, `Address`, `School`, `Schooladdress`, `Verified`) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssisssi", $splitted[1], $splitted[2], $splitted[3], $newpsw, $splitted[8], $splitted[7], $splitted[6], $splitted[4], $splitted[5], $konstanta);
                $stmt->execute();
                echo $stmt->error . "<br>";
                if (strlen($stmt->error) > 0) {
                    fclose($subor);
                    $conn->close();
                    header("location:home.php?csverror=stmterror");
                    exit();
                }
                $conn->query($sql);
            }
            if (!feof($subor)) {
                header("location:home.php?csverror=unexpected");
                exit();
            }
            fclose($subor);
            $conn->close();
            $mailstring .= "</table>";
            echo "<form id='csvform' action='send_mail.php' method='post'>
                <input type='hidden' name='mail' value='webte2tim18@gmail.com'>
                <input type='hidden' name='csv' value='" . $mailstring . "'>
          </form>";
            echo "<script>document.getElementById('csvform').submit();</script>";

        }
    } else {
        header("location:home.php?csverror=extensionerror");
        exit();
    }
}