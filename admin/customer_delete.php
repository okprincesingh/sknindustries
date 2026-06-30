<?php
 $delid = $_REQUEST['id'];
// die();
include 'config/connection.php';
$del = "delete from customer where id=$delid";
if (mysqli_query($con, $del)) {
  header("Location: index");
} else {
    // Log the error for debugging purposes
    echo "<script>alert('Error deleting partner data');
    window.location.href='index';
    </script>";
}
?>