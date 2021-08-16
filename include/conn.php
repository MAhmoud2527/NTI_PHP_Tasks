<?php
session_start();
$server = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "posts";


$conn = mysqli_connect($server, $dbUser, $dbPass, $dbName);
// check Connection 
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
