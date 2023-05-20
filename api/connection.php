<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

$host = "localhost";
$username = "root";
$passwd = "";
$db_name = "yulje_medical_centre";

$connection = mysqli_connect($host, $username, $passwd, $db_name);

if (!$connection) {
  die("Connection Error: " . mysqli_connect_error());
}
