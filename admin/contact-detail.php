<?php
include 'config/connection.php';
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    header('location:login.php');
    exit;
}

if (isset($_POST['contact_update1'])) {
    $idr = $_POST['id'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    $phone3 = $_POST['phone3'];
    $phone4 = $_POST['phone4'];
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $googlemap = $_POST['googlemap'];
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Check if there is an existing record for the given id
    $check_existing = mysqli_query($con, "SELECT * FROM contact_details WHERE id = '$idr'");
    $existing_record = mysqli_fetch_assoc($check_existing);
    if ($existing_record) {
        // Update the existing record
        $update_query = "UPDATE contact_details SET address1 = '$address1', address2 = '$address2', phone1 = '$phone1', phone2 = '$phone2', phone3 = '$phone3', phone4 = '$phone4', email1 = '$email1', email2 = '$email2', googlemap = '$googlemap' WHERE id = '$idr'";
        $result = mysqli_query($con, $update_query);
    }
    else
    {
        // Insert a new record if no existing record found
        $insert_query = "INSERT INTO contact_details (id, address1, address2, phone1, phone2, phone3, phone4, email1, email2, googlemap) VALUES ('$idr', '$address1', '$address2', '$phone1', '$phone2', '$phone3', '$phone4', '$email1', '$email2', '$googlemap')";
        $result = mysqli_query($con, $insert_query);
    }
    if ($result) {
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
                    window.location.href = 'contact-detail';
                }, 1000);
            });
            </script>";
    } else {
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
                window.location.href = 'contact-detail';
            }, 1000);
        });
        </script>";
    }
    mysqli_close($con);
    include 'config/connection.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Contact Details</title>
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
            <h1>Contact Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="blog-detail">Home</a></li>
                    <li class="breadcrumb-item">Details</li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">           
 <!-- contact start -->
 <div class="col-lg-12">
<div class="card">
    <div class="card-body">
        <h5 class="card-title">
        Contact Details
        </h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Phone1</th>
                        <th>Email1</th>
                        <th>Address1</th>
                        <th>Phone2</th>
                        <th>Email2</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sel = "SELECT * FROM contact_details ORDER BY id DESC";
                    $r = mysqli_query($con, $sel);
                    $id_sr = 1;
                    if ($r) {
                    while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                        $cat_id = $k['1'];

                        ?>
                        <tr>
                            <td><?php echo $k['phone1']; ?></td>
                            <td><?php echo $k['email1']; ?></td>
                            <td><?php echo $k['address1']; ?></td>
                            <td><?php echo $k['phone2']; ?></td>
                            <td><?php echo $k['email2']; ?></td>
                           
                            <td class="action-icons">
                                <i class="bi bi-pencil-square" title="Edit Contact"
                                    data-bs-toggle="modal"
                                    data-bs-target="#contactmodal_update<?php echo $k['id'] ?>"></i>
                            </td>
                            <!-- ---modal start--- -->
                            <div class="modal fade" id="contactmodal_update<?php echo $k['id'] ?>"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Form
                                            </h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Body - Your form goes here -->
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <!-- Your form fields go here -->
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <input type="hidden" name="id"
                                                            class="form-control" id=""
                                                            value="<?php echo $k['0'] ?>">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Address1</label>
                                                            <input type="text" name="address1"
                                                                class="form-control" id=""
                                                                placeholder="address"
                                                                value="<?php echo $k['address1'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Address2</label>
                                                            <input type="text" name="address2"
                                                                class="form-control" id=""
                                                                placeholder="address"
                                                                value="<?php echo $k['address2'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Phone1</label>
                                                            <input type="text" name="phone1"
                                                                class="form-control" id=""
                                                                placeholder="phone number"
                                                                value="<?php echo $k['phone1'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Phone2</label>
                                                            <input type="text" name="phone2"
                                                                class="form-control" id=""
                                                                placeholder="phone number"
                                                                value="<?php echo $k['phone2'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Phone3</label>
                                                            <input type="text" name="phone3"
                                                                class="form-control" id=""
                                                                placeholder="phone number"
                                                                value="<?php echo $k['phone3'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Phone4</label>
                                                            <input type="text" name="phone4"
                                                                class="form-control" id=""
                                                                placeholder="phone number"
                                                                value="<?php echo $k['phone4'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Email1</label>
                                                            <input type="text" name="email1"
                                                                class="form-control" id=""
                                                                placeholder="Email"
                                                                value="<?php echo $k['email1'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Email2</label>
                                                            <input type="text" name="email2"
                                                                class="form-control" id=""
                                                                placeholder="Email"
                                                                value="<?php echo $k['email2'] ?>">
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Googlemap</label>
                                                            <input type="text" name="googlemap"
                                                                class="form-control" id=""
                                                                value="<?php echo $k['googlemap'] ?>"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="contact_update1" class="btn"
                                                style="background-color: #2a3695; color:white;">SUBMIT
                                                NOW</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <!-- ... More form fields ... -->
                                        </form>
                                    </div>
                                    <!-- Modal Footer -->
                                </div>
                            </div>
                            <!-- Modal end -->
                        </tr>
                    <?php }
                    } else { ?>
                    <tr><td colspan="6">Unable to load contact records.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- contact end -->
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
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script>
    </script>
</body>
</html>
