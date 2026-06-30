<?php
 $delid = $_REQUEST['id'];
// die();
include 'config/connection.php';

// Delete image from folder if replaced
$getImage = "SELECT image FROM blog WHERE id = $delid";
$imageResult = mysqli_query($con, $getImage);

if ($imageResult && mysqli_num_rows($imageResult) > 0) {
    $row = mysqli_fetch_assoc($imageResult);

    if (!empty($row['image'])) {
        $imagePath = "../blog/images/" . $row['image'];

        // Delete image from folder if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

// delete data from database
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