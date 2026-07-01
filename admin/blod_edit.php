<?php
$edit2id = $_REQUEST['id'];
include 'config/connection.php';
$sel = "SELECT * FROM blog WHERE id ='$edit2id'";
$r = mysqli_query($con, $sel);
$k = mysqli_fetch_array($r);
?>
<?php
if (isset($_POST['blog_update'])) {
    $id = $_POST['id'] ?? ''; // Assuming 'id' is the primary key of your blog table
    $title = $_POST['title'] ?? '';
    $admin_name = $_POST['admin_name'] ?? '';
    $submittedDate = trim($_POST['date'] ?? '');
    $date = $submittedDate !== '' ? date('M. d, Y', strtotime($submittedDate)) : date('M. d, Y');
    $image_name = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $image_tmp_name = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
    $meta_title = $_POST['meta_title'] ?? '';
    $meta_description = $_POST['meta_description'] ?? '';
    $meta_keyword = $_POST['meta_keyword'] ?? '';
    $canonical_url = $_POST['canonical_url'] ?? '';
    $slug_url = trim($_POST['slug_url'] ?? '');
    $description = $_POST['description'] ?? '';
    $location = "../blog/images/";

    include 'config/connection.php';

    // Get old blog image
    $oldImage = "";

    $getOldImage = mysqli_query($con, "SELECT image FROM blog WHERE id='$id'");

    if ($getOldImage && mysqli_num_rows($getOldImage) > 0) {
    $oldRow = mysqli_fetch_assoc($getOldImage);
    $oldImage = $oldRow['image'];
    }

    function createSlug($string)
    {
        // Convert the string to lowercase
        $slug = strtolower($string);
        // Replace spaces with hyphens
        $slug = '/'.str_replace(' ', '-', $slug);
        // Remove special characters
        return $slug;
    }

    $slug = $slug_url !== '' ? $slug_url : createSlug($title);
    $slug = preg_replace('/\s+/', '-', trim($slug));

    // Use prepared statement to prevent SQL injection
    if (empty($_FILES['image']['name'])) {
        $update = mysqli_prepare($con, "UPDATE blog SET title=?, admin_name=?, date=?, meta_title=?, meta_description=?, meta_keyword=?, canonical_url=?, description=?, slug_url=? WHERE id=?");
        mysqli_stmt_bind_param($update, "sssssssssi", $title, $admin_name, $date, $meta_title, $meta_description, $meta_keyword, $canonical_url, $description, $slug, $id);
    } else {
        $update = mysqli_prepare($con, "UPDATE blog SET title=?, admin_name=?, date=?, image=?, meta_title=?, meta_description=?, meta_keyword=?, canonical_url=?, description=?, slug_url=? WHERE id=?");
        mysqli_stmt_bind_param($update, "ssssssssssi", $title, $admin_name, $date, $image_name, $meta_title, $meta_description, $meta_keyword, $canonical_url, $description, $slug, $id);
    }

    if ($update) {
        if (mysqli_stmt_execute($update)) {
            if (!empty($_FILES['image']['name'])) {
                $targetPath = $location . $image_name;
                if (move_uploaded_file($image_tmp_name, $targetPath)) {
                    // Delete old image after successful upload
                    if (!empty($oldImage)) {
                        $oldImagePath = "../blog/images/" . $oldImage;

                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                } else {
                    echo "<script>alert('Error moving uploaded file'); window.location.href='blog-detail'; </script>";
                    exit;
                }
            }

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
                            window.location.href = 'blog-detail';
                        }, 3000);
                    });
                  </script>";
        } else {
            // Error executing the update
            echo "<script>alert('Error executing the update'); window.location.href='blog-detail'; </script>";
            exit;
        }
    } else {
        // Error preparing the update statement
        echo "<script>alert('Error preparing the update statement'); window.location.href='blog-detail'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($update);
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog Edit Forms</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.webp" rel="icon">
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
      <h1>Form Edit Blog</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="blog-detail">Home</a></li>
          <li class="breadcrumb-item">Forms Edit</li>
          <li class="breadcrumb-item active">Blog</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">


        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Blog Form</h5>

              <!-- Vertical Form -->
              <form action="" method="post" enctype="multipart/form-data" class="row g-3">
               <input type="hidden" name="id" class="form-control" id="inputNanme4" value="<?php echo $k['0'] ?>">
               
                <div class="col-6">
                  <label for="inputNanme4" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" id="inputNanme4" value="<?php echo $k['title'] ?>">
                </div>
                <div class="col-6">
                  <label for="inputEmail4" class="form-label">Admin</label>
                  <input type="text" name="admin_name" class="form-control" id="inputEmail4" value="<?php echo $k['admin_name'] ?>">
                </div>
                <div class="col-6">
                  <label for="inputDate" class="form-label">Date</label>
                  <input type="date" name="date" class="form-control" id="inputDate" value="<?php echo !empty($k['date']) ? date('Y-m-d', strtotime($k['date'])) : ''; ?>">
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Upload Image</label>
                  <img src="../blog/images/<?php echo $k['image'] ?>" style="height: 50px; width: auto; padding: 5px;"
                    alt="Current Image">
                  <input type="file" name="image" class="form-control" id="inputPassword4"
                    value="<?php echo $k['image'] ?>">
                </div>
                                <div class="col-6">
                  <label for="inputEmail4" class="form-label">Meta Title</label>
                  <input type="text" name="meta_title" class="form-control" id="inputEmail4" value="<?php echo $k['meta_title'] ?>">
                </div>
                                <div class="col-6">
                  <label for="inputEmail4" class="form-label">Meta Description</label>
                  <input type="text" name="meta_description" class="form-control" id="inputEmail4" value="<?php echo $k['meta_description'] ?>">
                </div>
                                <div class="col-6">
                  <label for="inputEmail4" class="form-label">Meta keywords</label>
                  <input type="text" name="meta_keyword" class="form-control" id="inputEmail4" value="<?php echo $k['meta_keyword'] ?>">
                </div>
                <div class="col-6">
                  <label for="inputEmail4" class="form-label">Canonical url</label>
                  <input type="text" name="canonical_url" class="form-control" id="inputEmail4" value="<?php echo $k['canonical_url'] ?>">
                </div>
                <div class="col-6">
                  <label for="inputEmail4" class="form-label">Slug URL</label>
                  <input type="text" name="slug_url" class="form-control" id="inputEmail4" value="<?php echo $k['slug_url'] ?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Description</label>
                  <textarea type="text" class="tinymce-editor" name="description" id="ckediter" cols="10"
                    placeholder="type description"><?php echo $k['description'] ?></textarea>
                </div>
                <div class="text-center">
                  <button type="submit" name="blog_update" class="btn btn-submit">Submit Now</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <!-- End #main -->

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
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="assets/tinymce/tinymce.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
