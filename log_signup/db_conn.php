<?php

$sname= "localhost";
$username= "root";
$password = "";
$db_name = "barber";

$conn = mysqli_connect($sname, $username, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}