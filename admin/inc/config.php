<?php

	$host = "localhost";
	$user ="root";
	$pass = "";
	$db = "db_perpustakaan";
	$connect = mysqli_connect($host, $user, $pass) or die("fail to connect database");
	$select_db = mysqli_select_db($connect, $db) or die("database $db not found");
?>