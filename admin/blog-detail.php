<?php
include 'config/connection.php';
if (!isset($_SESSION['ADMIN_LOGIN'])) {
  header('location:login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.webp" rel="icon">
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
      <h1>Blog Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="blog-detail">Home</a></li>
          <li class="breadcrumb-item">Details</li>
          <li class="breadcrumb-item active">Blog</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal"
                  data-bs-target="#add_blog" style="background-color: #2a3695; color:white;">
                  <img src="assets/img/add-user.png" alt="Profile" class="add-image"> Add Blog
                </button></h5>
              <!-- ---modal start--- -->
              <div class="modal fade" id="add_blog" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Blog Form </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body - Your form goes here -->
                    <div class="modal-body">
                      <form action="insert_code.php" method="post" enctype="multipart/form-data">
                        <!-- Your form fields go here -->
                        <div class="container-fluid">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Title</label>
                              <input type="text" name="title" class="form-control" id="" placeholder="Enter Title">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Admin</label>
                              <input type="text" name="admin_name" class="form-control" id="" placeholder="Enter Admin">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Date</label>
                              <input type="date" name="date" class="form-control" id="">
                            </div>
                            <div class="mb-3 col-md-12">
                              <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                              <input type="file" name="image" class="form-control" id="">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Meta Title</label>
                              <input type="text" name="meta_title" class="form-control" id="" placeholder="Enter Title">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Meta Description</label>
                              <input type="text" name="meta_description" class="form-control" id="" placeholder="Enter description">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Meta keywords</label>
                              <input type="text" name="meta_keyword" class="form-control" id="" placeholder="Enter keywords">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Canonical Url</label>
                              <input type="text" name="canonical_url" class="form-control" id="" placeholder="Enter Canonical">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label">Slug URL</label>
                              <input type="text" name="slug_url" class="form-control" id="" placeholder="Enter Slug URL (e.g. /my-blog-title)">
                            </div>
                            <div class="mb-3 col-md-12">
                              <label for="exampleFormControlInput1" class="form-label">Description</label>
                           <textarea type="text" class="tinymce-editor" name="description" id="ckediter" placeholder="type description"></textarea>
                            </div>
                          </div>
                        </div>
                    </div>
 <div class="modal-footer">
                   <button type="submit" name="blog_insert" class="btn" style="background-color: #2a3695; color:white;">SUBMIT
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
                      <th><b>Title</b></th>
                      <th>Admin</th>
                      <th>Image</th>
                      <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    $sel = "SELECT * FROM blog ORDER BY id DESC";
                    $r = mysqli_query($con, $sel);
                    $id_sr = 1;
                    if ($r) {
                      while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                        $cat_id = $k['1'];
                    ?>
                    <tr>
                      <td><?php echo $k['title']; ?></td>
                      <td><?php echo $k['admin_name']; ?></td>
                      <td><img src="../blog/images/<?php echo $k['image']; ?>" alt="1"></td>
                      <td><?php echo $k['date']; ?></td>
                      <td class="action-icons">
                        <i class="bi bi-trash3" title="Delete Blog" data-id='<?php echo $k['id']; ?>' id="click_delete"></i>
                        <i class="bi bi-pencil-square" title="Edit Blog" data-id='<?php echo $k['id']; ?>' id="click_update"></i>
                      </td>
                    </tr>
                    <?php
                      }
                    } else { ?>
                    <tr>
                      <td colspan="5">Unable to load blog records.</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>


            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'includes/footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
  $(document).on("click", "#click_delete", function(){
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
        window.location.href = "blog_delete?id=" + id; // Redirect to blog_edit.php with the 'id' query string
      }
    });
  });
  $(document).on("click", "#click_update", function(){
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
        window.location.href = "blod_edit?id=" + id; // Redirect to blog_edit.php with the 'id' query string
      }
    });
  });
</script>

</body>

</html>




