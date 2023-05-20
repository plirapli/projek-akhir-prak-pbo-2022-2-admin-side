<?php

// session_start();
require 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user
		  WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connection, $query);
$isFound = mysqli_num_rows($result);

if ($isFound > 0) {
	// $_SESSION['username'] = $username;
	header("Location: ../view/home.php");
} else {
	header("Location: ../index.php?pesan=login_gagal");
}