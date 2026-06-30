<?php
 $delid = $_REQUEST['id'];
// die();
include 'config/connection.php';
$del = "delete from blog where id=$delid";
if (mysqli_query($con, $del)) {
  header("Location: blog-detail");
} else {
    // Log the error for debugging purposes
    echo "<script>alert('Error deleting categories data');
    window.location.href='blog-detail';
    </script>";
  }
?>