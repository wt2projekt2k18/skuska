<?php

include '../config.php';

$link = mysqli_connect($servername, $username, $password, $dbname);
$link->set_charset("utf8");

session_start();

// TODO POST VALUES
//var_dump($_POST);

$errors = [];

if (empty($_POST['start']))
{
	$errors[] = "Error: Start is empty";
}

if (empty($_POST['end']))
{
	$errors[] = "Error: End is empty";
}

if (empty($_POST['type']))
{
	$errors[] = "Error: Type is empty";
}

if (empty($_POST['start_lat']))
{
	$errors[] = "Error: Start latitude is empty";
}

if (empty($_POST['start_long']))
{
	$errors[] = "Error: Start longitude is empty";
}

if (empty($_POST['end_lat']))
{
	$errors[] = "Error: End latitude is empty";
}

if (empty($_POST['end_long']))
{
	$errors[] = "Error: End longitude is empty";
}

if (empty($_POST['length']))
{
	$errors[] = "Error: Length longitude is empty";
}

if (!empty($errors))
{
	header("HTTP/1.0 422");

	echo json_encode([
		'errors' => $errors
	]);
}
else
{
	$query = sprintf("INSERT INTO routes (user_id, start, start_lat, start_long, end, end_lat, end_long, length, progress, type ) 
		VALUES (%d,\"%s\",%s,%s,\"%s\",%s,%s,%s, %d, %s);",
		$_SESSION['id'], $_POST['start'], $_POST['start_lat'], $_POST['start_long'],
		$_POST['end'], $_POST['end_lat'], $_POST['end_long'], $_POST['length'], 0,  $_POST['type']);

	var_dump($query);
	$q = $link->query($query);

	if (!$q)
	{
		printf("Errormessage: %s\n", $link->error);

		header("HTTP/1.0 422");

		echo json_encode([
			'errors' => [
				'something is wrong!'
			]
		]);
	}
}
