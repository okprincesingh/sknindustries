<?php

$edit2id = $_REQUEST['catid'];
include 'config/connection.php';
$sel = "SELECT * FROM pro_categories WHERE catid ='$edit2id'";
$r = mysqli_query($con, $sel);
$k = mysqli_fetch_array($r);
$a1 = $k['cat_name'];
$new_cat = str_replace('-', ' ', $a1);
$images = explode(",", $k['image1']);

?>
<?php

if (isset($_POST['categories_update'])) {
    $catid = $_POST['catid'] ?? ''; 
    $a1 = $_POST['cat_name'] ?? '';
    $new_cat = str_replace(' ', '-', $a1); // Replace spaces with dashes
    $e2 = $_FILES['image']['name'] ?? null;
    $f2 = $_FILES['image']['tmp_name'] ?? null;
    $metakeyword = $_POST['metakeyword'] ?? ''; // Corrected key
    $metadescription = $_POST['metadescription'] ?? ''; // Corrected key
    $metatitle = $_POST['metatitle'] ?? ''; // Corrected key
    $canonical_url = $_POST['canonical_url'] ?? ''; // Corrected key
    $description = $_POST['description'] ?? '';
    $timestamp = time();
    $a5 = date('Y-m-d', $timestamp); // Correct MySQL date format

    $location = "../product/images/";

    // Include database connection
    include 'config/connection.inc.php';

    // Check the connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to create slug
    function createSlug($string) {
        $slug = strtolower($string);
        return '/' . str_replace(' ', '-', $slug); // Add leading slash
    }

    $slug = createSlug($a1);

    // Escape inputs to prevent SQL injection
    $cat_name_safe = mysqli_real_escape_string($con, $new_cat);
    $description_safe = trim($_POST['description']);
    $slug_safe = mysqli_real_escape_string($con, $slug);
    $metakeyword_safe = mysqli_real_escape_string($con, $metakeyword);
    $metadescription_safe = mysqli_real_escape_string($con, $metadescription);
    $metatitle_safe = mysqli_real_escape_string($con, $metatitle);

    // Prepare the SQL statement
    if (empty($e2)) {
        // No image uploaded, update without the image field
        $upd = mysqli_prepare($con, "UPDATE pro_categories SET cat_name = ?, metakeyword = ?, metadescription = ?, metatitle = ?, canonical_url = ?, date = ?, slug_url = ?, description = ? WHERE catid = ?");
        mysqli_stmt_bind_param($upd, "ssssssssi", $cat_name_safe, $metakeyword_safe, $metadescription_safe, $metatitle_safe, $canonical_url, $a5, $slug_safe, $description_safe, $catid);
    } else {
        // Image uploaded, include image field in the update query
        $image_name_safe = mysqli_real_escape_string($con, $e2); // Escape image name
        $upd = mysqli_prepare($con, "UPDATE pro_categories SET cat_name = ?, image = ?, metakeyword = ?, metadescription = ?, metatitle = ?, canonical_url = ?, date = ?, description = ?, slug_url = ? WHERE catid = ?");
        mysqli_stmt_bind_param($upd, "ssssssssi", $cat_name_safe, $image_name_safe, $metakeyword_safe, $metadescription_safe, $metatitle_safe, $canonical_url, $a5, $description_safe, $slug_safe, $catid);
    }

    // Execute the update statement
    if (mysqli_stmt_execute($upd)) {
        // If image is uploaded, move the file to the desired location
        if (!empty($e2) && !empty($f2)) {
            // Validate file type and size (for example, only allow images)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 2 * 1024 * 1024; // Max size 2MB

            $fileType = mime_content_type($f2);
            $fileSize = filesize($f2);

            if (in_array($fileType, $allowedTypes) && $fileSize <= $maxSize) {
                // Ensure the image is moved to the correct folder
                $targetPathBanner = $location . basename($e2); // Use basename() to avoid path traversal issues
                if (move_uploaded_file($f2, $targetPathBanner)) {
                    // Success message for file upload
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var smsPopup = document.createElement('div');
                            smsPopup.innerText = 'Data updated successfully';
                            smsPopup.style.position = 'fixed';
                            smsPopup.style.bottom = '10px';
                            smsPopup.style.right = '10px';
                            smsPopup.style.backgroundColor = '#4caf50';
                            smsPopup.style.color = '#fff';
                            smsPopup.style.padding = '10px';
                            smsPopup.style.borderRadius = '5px';
                            smsPopup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.1)';
                            document.body.appendChild(smsPopup);
                            setTimeout(function() {
                                smsPopup.remove();
                                window.location.href = 'product-detail';
                            }, 1000);
                        });
                    </script>";
                } else {
                    // Error moving uploaded file
                    echo "<script>alert('Error moving uploaded banner file'); window.location.href='product-detail';</script>";
                    exit;
                }
            } else {
                // Invalid file type or size
                echo "<script>alert('Invalid file type or file size exceeded'); window.location.href='product-detail';</script>";
                exit;
            }
        } else {
            // Success message when no image was uploaded but data is updated
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var smsPopup = document.createElement('div');
                    smsPopup.innerText = 'Data updated successfully';
                    smsPopup.style.position = 'fixed';
                    smsPopup.style.bottom = '10px';
                    smsPopup.style.right = '10px';
                    smsPopup.style.backgroundColor = '#4caf50';
                    smsPopup.style.color = '#fff';
                    smsPopup.style.padding = '10px';
                    smsPopup.style.borderRadius = '5px';
                    smsPopup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.1)';
                    document.body.appendChild(smsPopup);
                    setTimeout(function() {
                        smsPopup.remove();
                        window.location.href = 'product-detail';
                    }, 1000);
                });
            </script>";
        }
    } else {
        // Error updating data
        echo "<script>alert('Error updating data'); window.location.href='product-detail';</script>";
    }

    // Close prepared statement and connection
    mysqli_stmt_close($upd);
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Categories Edit Forms</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
 <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

  <!-- Header -->
  <?php include 'includes/header.php'; ?>
  <!-- /Header -->
  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- /Sidebar -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Edit Categories</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Forms Edit</li>
          <li class="breadcrumb-item active">Categories</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">


        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories Form</h5>

              <!-- Vertical Form -->
         <form action="" method="post" enctype="multipart/form-data" class="row g-3">
    <input type="hidden" name="catid" class="form-control" id="inputCatId" value="<?php echo $k['0']; ?>">
    
    <div class="col-6">
        <label for="inputCatName" class="form-label">Categories</label>
        <input type="text" name="cat_name" class="form-control" id="inputCatName" value="<?php echo $new_cat; ?>">
    </div>

    <div class="col-6">
        <label for="inputImage" class="form-label">Uploads Image</label>
        <img src="product/<?php echo $k['image']; ?>" style="height: 50px; width: auto; padding: 5px;" alt="Current Image">
        <input type="file" name="image" class="form-control" id="inputImage" value="<?php echo $k['image']; ?>">
    </div>
    
    <div class="col-6">
        <label for="inputMetaKeywords" class="form-label">Meta keywords</label>
        <input type="text" name="metakeyword" class="form-control" id="inputMetaKeywords" value="<?php echo $k['metakeyword']; ?>">
    </div>

    <div class="col-6">
        <label for="inputMetaDescription" class="form-label">Meta Description</label>
        <input type="text" name="metadescription" class="form-control" id="inputMetaDescription" value="<?php echo $k['metadescription']; ?>">
    </div>

    <div class="col-6">
        <label for="inputMetaTitle" class="form-label">Meta Title</label>
        <input type="text" name="metatitle" class="form-control" id="inputMetaTitle" value="<?php echo $k['metatitle']; ?>">
    </div>
    <div class="col-6">
        <label for="inputMetaTitle" class="form-label">Canonical Url</label>
        <input type="text" name="canonical_url" class="form-control" id="inputMetaTitle" value="<?php echo $k['canonical_url']; ?>">
    </div>


    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="tinymce-editor" id="description"><?php echo $k['description']; ?></textarea>
    </div>

    <div class="text-center">
        <button type="submit" name="categories_update" class="btn btn-submit">Submit Now</button>
    </div>
</form>

              
              <!-- Vertical Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <?php include 'includes/footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="assets/tinymce/tinymce.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>