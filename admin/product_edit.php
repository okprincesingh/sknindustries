<?php

$edit2id = $_REQUEST['proid'];
include 'config/connection.php';
$sel = "SELECT * FROM product WHERE proid ='$edit2id'";
$r = mysqli_query($con, $sel);
$k = mysqli_fetch_array($r);
$a1 = $k['product_name'];
$new_product = str_replace('-', ' ', $a1);
$images = explode(",", $k['image1']);
$data = $k['cat_name'];
$categories_1 = $k['catid'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Product Edit Forms</title>
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
            <h1>Form Edit Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Forms Edit</li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Form</h5>
                            <!-- Vertical Form -->
                            <form action="producteditcode.php" method="post" enctype="multipart/form-data" class="row g-3">
                                <input type="hidden" name="proid" class="form-control" id="inputNanme4"
                                    value="<?php echo $k['0'] ?>">
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">Categories Name</label>
                                    <select class="form-control" name="catid" readonly>
                                        <option>Select Category</option>
                                        <?php
                                        $selll = "SELECT catid, cat_name FROM pro_categories";
                                        $res = mysqli_query($con, $selll);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $data = $row['cat_name'];
                                            $new_cat = str_replace('-', ' ', $data);
                                            $id = $row['catid'];
                                            if ($id == $categories_1) {
                                                echo "<option selected value=\"$id\">$new_cat</option>";
                                            } else {
                                                echo "<option value=\"$id\">$new_cat</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="inputNanme4"
                                        value="<?php echo $new_product; ?>">
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Upload Image</label>
                                    <input type="file" name="image1[]" class="form-control" id="inputNanme4" multiple>
                                </div>
                                   <div class="col-6">
                                    <label for="inputNanme4" class="form-label">Meta Keyword</label>
                                    <input type="text" name="metakeyword" class="form-control" id="inputNanme4"
                                        value="<?php echo $k['metakeyword'] ?>">
                                </div>
                                   <div class="col-6">
                                    <label for="inputNanme4" class="form-label">Meta Description</label>
                                    <input type="text" name="metadescription" class="form-control" id="inputNanme4"
                                        value="<?php echo $k['metadescription'] ?>">
                                </div>
                                   <div class="col-6">
                                    <label for="inputNanme4" class="form-label">Meta Title</label>
                                    <input type="text" name="metatitle" class="form-control" id="inputNanme4"
                                        value="<?php echo $k['metatitle'] ?>">
                                </div>
                                    <div class="col-6">
                                    <label for="inputNanme4" class="form-label">Canonical Url</label>
                                    <input type="text" name="canonical_url" class="form-control" id="inputNanme4"
                                        value="<?php echo $k['canonical_url'] ?>">
                                </div>
                                
                 <div class="col-12">
    <label for="inputEmail4" class="form-label">Description</label>
    <textarea name="description" class="tinymce-editor" id="description"><?php echo $k['description'] ?></textarea>
                </div>
    <div class="text-center">
<button type="submit" name="product_update" class="btn btn-submit">Submit Now</button></div>
                            </form><!-- Vertical Form -->
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