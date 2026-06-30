<?php
ob_start();
include 'config/connection.php';
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    if (!headers_sent()) {
        header('location:login.php');
    } else {
        echo "<script>window.location.href='login.php';</script>";
    }
    exit;
}

if (isset($_POST['categories_insert'])) {

    $a1 = $_POST['cat_name'];
    $new_cat = str_replace(' ', '-', $a1);
    $e2 = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
    $f2 = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : null;
    $metakeyword = $_POST['metakeyword'];
    $metadescription = $_POST['metadescription'];
    $metatitle = $_POST['metatitle'];
    $canonical_url = $_POST['canonical_url'];
    $description = $_POST['description'];
    $timestamp = time();
    $date = date('Y-M-d', $timestamp); // MySQL date format
    $location = "product/";

    // Check the connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Create slug
    $slug = '/' . str_replace(' ', '-', strtolower($a1));


    // Use prepared statement to prevent SQL injection
    $ins = mysqli_prepare($con, "INSERT INTO pro_categories (cat_name, image, metakeyword, metadescription, metatitle, canonical_url, date, description, slug_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$ins) {
        echo "<script>alert('DB prepare failed for categories'); window.location.href='product-detail';</script>";
        exit;
    }
    mysqli_stmt_bind_param($ins, "sssssssss", $new_cat, $e2, $metakeyword, $metadescription, $metatitle, $canonical_url, $date, $description, $slug);

    // Check if the prepared statement is successful
    if (mysqli_stmt_execute($ins)) {

        $upload_success = true;
        if ($upload_success && !empty($e2) && !empty($f2)) {
            $targetPathBanner = $location . $e2;
            if (move_uploaded_file($f2, $targetPathBanner)) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var smsPopup = document.createElement('div');
                        smsPopup.innerText = 'Data inserted successfully';
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
                </script>"
                ;
            } else {
                echo "<script>alert('Error moving uploaded banner file'); window.location.href='product-detail';</script>";
                exit;
            }
        }
    } else {
        echo "<script>alert('Error executing the insert'); window.location.href='product-detail';</script>";
    }

    // Close the statement and connection
    mysqli_stmt_close($ins);
    mysqli_close($con);
}
?>

<?php
if (isset($_POST['product_insert'])) {
    $catid = $_POST['catid'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $new_cat = str_replace(' ', '-', $product_name); // Replace spaces with dashes
    $file_names = [];

    // Handle multiple file uploads
    if (!empty($_FILES["image1"]["name"][0])) {
        foreach ($_FILES["image1"]["name"] as $key => $file_name) {
            $uniqueID = uniqid();
            $file_names[] = $uniqueID . "_" . $file_name;
        }
    }

    $image1 = implode(",", $file_names);
     $metakeyword = $_POST['metakeyword'] ?? '';
     $metadescription = $_POST['metadescription'] ?? '';
     $metatitle = $_POST['metatitle'] ?? '';
     $canonical_url = $_POST['canonical_url'] ?? '';
    $timestamp = time();
    $date = date('Y-m-d', $timestamp); // Correct MySQL date format
    $description = $_POST['description'] ?? '';
    $location = "product/";

    // Check the database connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create slug from product name
    $slug = '/' . str_replace(' ', '-', strtolower($product_name));

    // Prepare the SQL statement to prevent SQL injection
    $ins = mysqli_prepare($con, "INSERT INTO product (catid, product_name, image1, metakeyword, metadescription, metatitle, canonical_url, date, description, slug_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$ins) {
        echo "<script>alert('DB prepare failed for product'); window.location.href='product-detail';</script>";
        exit;
    }
    mysqli_stmt_bind_param($ins, "isssssssss", $catid, $new_cat, $image1, $metakeyword, $metadescription, $metatitle, $canonical_url, $date, $description, $slug);

    // Execute the insert statement
    if (mysqli_stmt_execute($ins)) {
        // Move uploaded files to the specified location
        $upload_success = true;
        foreach ($_FILES["image1"]["tmp_name"] as $key => $tmp_name) {
            $targetPath = $location . $file_names[$key];
            // Validate file type and size before moving
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 2 * 1024 * 1024; // 2MB max size

            $fileType = mime_content_type($tmp_name);
            $fileSize = filesize($tmp_name);

            if (in_array($fileType, $allowedTypes) && $fileSize <= $maxSize) {
                if (!move_uploaded_file($tmp_name, $targetPath)) {
                    $upload_success = false;
                    break;
                }
            } else {
                $upload_success = false;
                break;
            }
        }

        // Success message for file upload and database insert
        if ($upload_success) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var smsPopup = document.createElement('div');
                    smsPopup.innerText = 'Data inserted successfully';
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
            // Error during file upload
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var smsPopup = document.createElement('div');
                    smsPopup.innerText = 'Error uploading files';
                    smsPopup.style.position = 'fixed';
                    smsPopup.style.bottom = '10px';
                    smsPopup.style.right = '10px';
                    smsPopup.style.backgroundColor = '#f44336';
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
        // Error inserting data into the database
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var smsPopup = document.createElement('div');
                smsPopup.innerText = 'Error inserting data';
                smsPopup.style.position = 'fixed';
                smsPopup.style.bottom = '10px';
                smsPopup.style.right = '10px';
                smsPopup.style.backgroundColor = '#f44336';
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

    // Close the prepared statement and database connection
    mysqli_stmt_close($ins);
    mysqli_close($con);
    include 'config/connection.php';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Product Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
      <h1>Product Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Details</li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <!-- product sections -->
        <div class="col-lg-12">
<div class="card">
  <div class="card-body">
    <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal" data-bs-target="#add_blog"
        style="background-color: #2a3695; color:white;">
        <img src="assets/img/add-user.png" alt="Profile" class="add-image"> Add Product
      </button></h5>
    <!-- ---modal start--- -->
    <div class="modal fade" id="add_blog" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Product Form </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body - Your form goes here -->
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
              <!-- Your form fields go here -->
              <div class="container-fluid">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Categories Name</label>
                    <select class="form-control" name="catid" id="catid">
                      <option>Select Category</option>
                      <?php
                      $res = mysqli_query($con, "SELECT catid, cat_name FROM pro_categories ORDER BY cat_name ASC");
                      if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                          $cat_name = str_replace('-', ' ', $row['cat_name']);
                          $selected = (isset($catid) && $row['catid'] == $catid) ? 'selected' : '';
                          echo "<option value='{$row['catid']}' $selected>{$cat_name}</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id=""
                      placeholder="Product Name">
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                    <input type="file" name="image1[]" class="form-control" id="" multiple>
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Meta Keywords</label>
                    <input type="text" name="metakeyword" class="form-control" id=""
                      placeholder="Keywords">
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Meta Description</label>
                    <input type="text" name="metadescription" class="form-control" id=""
                      placeholder="metadescription">
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Meta Title</label>
                    <input type="text" name="metatitle" class="form-control" id=""
                      placeholder="metatitle">
                  </div>
                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Canonical Url</label>
                    <input type="text" name="canonical_url" class="form-control" id=""
                      placeholder="canonical Url">
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                    <textarea name="description" class="tinymce-editor" id="description1"></textarea>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="product_insert" class="btn"
              style="background-color: #2a3695; color:white;">SUBMIT
              NOW</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          </div>
          <!-- ... More form fields ... -->
          </form>
        </div>
        <!-- Modal Footer -->
      </div>
    </div>
    <!-- Modal end -->
    <div class="table-responsive">
      <table class="table table-striped table-hover datatable">
        <thead>
          <tr>
            <th><b>Categories Name</b></th>
            <th>Product Name</th>
            <th>Image</th>
            <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          $sel = "SELECT * FROM product ORDER BY proid DESC";
          $r = mysqli_query($con, $sel);
          $id_sr = 1;
          if ($r) {
          while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
            $cat_id = $k['1'];
            $a1 = $k['product_name'];
            $new_cat = str_replace('-', ' ', $a1);
            $images = explode(",", $k['image1']);
            ?>
            <tr>
              <td>
                <?php
                // Assuming $con is your database connection
                $sel_cat_name = "SELECT cat_name FROM pro_categories WHERE catid = ?";
                $stmt = mysqli_prepare($con, $sel_cat_name);
                $cat_name = null;
                if ($stmt) {
                  mysqli_stmt_bind_param($stmt, 'i', $cat_id);
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_bind_result($stmt, $cat_name);
                  mysqli_stmt_fetch($stmt);
                  mysqli_stmt_close($stmt);
                }
                if (!empty($cat_name)) {
                  $cat_name_display = str_replace('-', ' ', $cat_name);
                  echo htmlspecialchars($cat_name_display);
                } else {
                  echo "Category not found";
                }
                $id = $k['proid'];
                ?>
              </td>

              <td><?php echo $new_cat; ?></td>
              <td>
                <?php foreach (array_slice($images, 0, 1) as $index => $image1): ?>
                  <img src="product/<?php echo $image1; ?>" alt="1">
                <?php endforeach; ?>
              </td>
              <td><?php echo $k['date']; ?></td>
              <td class="action-icons">
                <i class="bi bi-trash3" title="Delete Product" data-id='<?php echo $k['proid']; ?>'
                  id="click_productdelete"></i>
                <i class="bi bi-pencil-square" title="Edit Product" data-id='<?php echo $k['proid']; ?>'
                  id="click_productupdate"></i>
              </td>
            </tr>
          <?php }
          } else { ?>
          <tr><td colspan="5">Unable to load product records.</td></tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


  </div>
</div>

</div>
<!-- product section end -->
        <!-- category start -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal"
                  data-bs-target="#add_category" style="background-color: #2a3695; color:white;">
                  <img src="assets/img/add-user.png" alt="Profile" class="add-image"> Add Categories
                </button></h5>
              <!-- ---modal start--- -->
              <div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Categories Form </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal Body - Your form goes here -->
                    <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data">
                        <!-- Your form fields go here -->
                        <div class="container-fluid">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Categories</label>
                              <input type="text" name="cat_name" class="form-control" id=""
                                placeholder="Enter categories">
                            </div>
                            <div class="mb-3 col-md-6">
            <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                              <input type="file" name="image" class="form-control" id="">
                            </div>
<div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Meta keywords</label>
                              <input type="text" name="metakeyword" class="form-control" id=""
                                placeholder="Enter metakeyword">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Meta Description</label>
                              <input type="text" name="metadescription" class="form-control" id=""
                                placeholder="Enter description">
                            </div>
                             <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Meta Title</label>
                              <input type="text" name="metatitle" class="form-control" id=""
                                placeholder="Enter Title">
                            </div>
                              <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Canonical Url</label>
                              <input type="text" name="canonical_url" class="form-control" id=""
                                placeholder="Enter canonical url">
                            </div>
                            <div class="mb-3 col-md-12">
            <label for="exampleFormControlInput1" class="form-label">Description</label>
                             <textarea name="description" class="tinymce-editor" id="description"></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="categories_insert" class="btn"
                        style="background-color: #2a3695; color:white;">SUBMIT
                        NOW</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                    <!-- ... More form fields ... -->
                    </form>
                  </div>
                  <!-- Modal Footer -->
                </div>
              </div>
              <!-- Modal end -->

              <div class="table-responsive">
                <table class="table table-striped table-hover datatable">
                  <thead>
                    <tr>
                      <th><b>Categories Name</b></th>
                      <th>Image</th>
                      <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    $sel = "SELECT * FROM pro_categories ORDER BY catid DESC";
                    $r = mysqli_query($con, $sel);
                    $id_sr = 1;
                    if ($r) {
                    while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                      $cat_id = $k['1'];
                      $a1 = $k['cat_name'];
                      $new_cat = str_replace('-', ' ', $a1);
                      
                      ?>
                      <tr>
                        <td><?php echo $new_cat; ?></td>
                        <td><img src="product/<?php echo $k['image']; ?>" alt="1"></td>
                        <td><?php echo $k['date']; ?></td>
                        <td class="action-icons">
    <i class="bi bi-trash3" title="Delete Categories" data-id='<?php echo $k['catid']; ?>'
                      id="click_categoriesdelete"></i>
    <i class="bi bi-pencil-square" title="Edit Categories" data-id='<?php echo $k['catid']; ?>'
                      id="click_categoriesupdate"></i>
                        </td>
                      </tr>
                    <?php }
                    } else { ?>
                    <tr><td colspan="4">Unable to load categories.</td></tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- category end -->      
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
 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script>
    $(document).on("click", "#click_categoriesdelete", function () {
      var id = $(this).data("id");
      Swal.fire({
        title: "Are you sure item will be deleted ?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        customClass: {
          popup: 'small-popup',
          title: 'small-title',
          content: 'small-content',
          confirmButton: 'small-confirm-button',
          cancelButton: 'small-cancel-button'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "categories_delete?catid=" + id; // Redirect to blog_edit.php with the 'id' query string
        }
      });
    });
    $(document).on("click", "#click_categoriesupdate", function () {
      var id = $(this).data("id");
      Swal.fire({
        title: "Are you sure item will be Update ?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Update it!",
        customClass: {
          popup: 'small-popup',
          title: 'small-title',
          content: 'small-content',
          confirmButton: 'small-confirm-button',
          cancelButton: 'small-cancel-button'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "categories_edit?catid=" + id; // Redirect to blog_edit.php with the 'id' query string
        }
      });
    });
    $(document).on("click", "#click_productdelete", function () {
      var id = $(this).data("id");
      Swal.fire({
        title: "Are you sure item will be deleted ?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        customClass: {
          popup: 'small-popup',
          title: 'small-title',
          content: 'small-content',
          confirmButton: 'small-confirm-button',
          cancelButton: 'small-cancel-button'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "product_delete?proid=" + id; // Redirect to blog_edit.php with the 'id' query string
        }
      });
    });
    $(document).on("click", "#click_productupdate", function () {
      var id = $(this).data("id");
      Swal.fire({
        title: "Are you sure item will be Update ?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Update it!",
        customClass: {
          popup: 'small-popup',
          title: 'small-title',
          content: 'small-content',
          confirmButton: 'small-confirm-button',
          cancelButton: 'small-cancel-button'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "product_edit?proid=" + id; // Redirect to blog_edit.php with the 'id' query string
        }
      });
    });
  </script>
 
</body>

</html>
