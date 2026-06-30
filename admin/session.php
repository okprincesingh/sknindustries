<?php

session_start();
ini_set('log_errors', 'Off');
header("Expires: 0");

if(isset($_GET['logout'])){
    
    session_destroy();
   header("location:index");
   exit;
}
?>
