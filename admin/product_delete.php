<?php
 $delid = $_REQUEST['proid'];
// die();
include 'config/connection.php';

$getImage = "SELECT image1 FROM product WHERE proid = $delid";
$imageResult = mysqli_query($con, $getImage);

if ($imageResult && mysqli_num_rows($imageResult) > 0) {
    $row = mysqli_fetch_assoc($imageResult);

    if (!empty($row['image1'])) {
        $imagePath = "../product/images/" . $row['image1'];

        // Delete image from folder if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

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