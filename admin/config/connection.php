<?php
error_reporting(0);
session_start();
$con = mysqli_connect("localhost", "root", "", "skn");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>