<?php
error_reporting(0);
session_start();

require_once __DIR__ . '/../../includes/env.php';

$dbHost = envValue('DB_HOST', 'localhost');
$dbUser = envValue('DB_USERNAME', 'root');
$dbPass = envValue('DB_PASSWORD', '');
$dbName = envValue('DB_DATABASE', 'skn');

$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
