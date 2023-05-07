<?php

$sname= "localhost";
$unmae= "root";
$password = "sunnykr1709";

$db_name = "user_database";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}