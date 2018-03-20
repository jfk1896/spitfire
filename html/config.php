<?php
session_start();
//echo session_id();

$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "spitfire"; // the name of the database that you are going to use for this project
$dbuser = "root"; // the username that you created, default is root
$dbpass = ""; // the password that you created, default is blank

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("MySQL Error: " . mysqli_error());
?>


