<?php
 $delid = $_REQUEST['catid'];
// die();
include 'config/connection.php';
$del = "delete from pro_categories where catid=$delid";
if (mysqli_query($con, $del)) {
  header("Location: product-detail");
} 
else

{
    // Log the error for debugging purposes
    echo "<script>alert('Error deleting categories data');
    window.location.href='product-detail';
    </script>";
  }

?>