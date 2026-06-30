<?php
 $delid = $_REQUEST['proid'];
// die();
include 'config/connection.php';
$del = "delete from product where proid=$delid";
if (mysqli_query($con, $del)) {
  header("Location: product-detail");
} else {
    // Log the error for debugging purposes
    echo "<script>alert('Error deleting product data');
    window.location.href='product-detail';
    </script>";
  }
?>