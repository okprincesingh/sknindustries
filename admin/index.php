<?php
ob_start();
session_start();

if (isset($_POST['slider_insert'])) {
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $ins = mysqli_prepare($con, "INSERT INTO slider (image, date) VALUES (?, ?)");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($ins, "ss", $e1, $date);

    if (mysqli_stmt_execute($ins)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";
        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($ins);
    mysqli_close($con);
}
if (isset($_POST['slider_update'])) {
    $slider_id = $_POST['id'];
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $upd = mysqli_prepare($con, "UPDATE slider SET image = ?, date = ? WHERE id = ?");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($upd, "ssi", $e1, $date, $slider_id);

    if (mysqli_stmt_execute($upd)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var smsPopup = document.createElement('div');
                smsPopup.innerText = 'Data Updated successfully';
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";

        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($upd);
    mysqli_close($con);
}
if (isset($_POST['slider1_insert'])) {
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $ins = mysqli_prepare($con, "INSERT INTO slider1 (image, date) VALUES (?, ?)");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($ins, "ss", $e1, $date);

    if (mysqli_stmt_execute($ins)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";
        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($ins);
    mysqli_close($con);
}
if (isset($_POST['partner_insert'])) {
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $ins = mysqli_prepare($con, "INSERT INTO partner (image, date) VALUES (?, ?)");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($ins, "ss", $e1, $date);

    if (mysqli_stmt_execute($ins)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";
        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($ins);
    mysqli_close($con);
}
if (isset($_POST['partner_update'])) {
    $slider_id = $_POST['id'];
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $upd = mysqli_prepare($con, "UPDATE partner SET image = ?, date = ? WHERE id = ?");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($upd, "ssi", $e1, $date, $slider_id);

    if (mysqli_stmt_execute($upd)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var smsPopup = document.createElement('div');
                smsPopup.innerText = 'Data Updated successfully';
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";

        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($upd);
    mysqli_close($con);
}
if (isset($_POST['slider1_update'])) {
    $slider_id = $_POST['id'];
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $upd = mysqli_prepare($con, "UPDATE slider1 SET image = ?, date = ? WHERE id = ?");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($upd, "ssi", $e1, $date, $slider_id);

    if (mysqli_stmt_execute($upd)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var smsPopup = document.createElement('div');
                smsPopup.innerText = 'Data Updated successfully';
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";

        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($upd);
    mysqli_close($con);
}
if (isset($_POST['customer_insert'])) {
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $ins = mysqli_prepare($con, "INSERT INTO customer (image, date) VALUES (?, ?)");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($ins, "ss", $e1, $date);

    if (mysqli_stmt_execute($ins)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";
        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($ins);
    mysqli_close($con);
}
if (isset($_POST['customer_update'])) {
    $slider_id = $_POST['id'];
    $e1 = $_FILES['image']['name'];
    $f1 = $_FILES['image']['tmp_name'];
    $timestamp = time(); // Get current Unix timestamp
    $date = date('d-M-Y', $timestamp);
    $location = "home/";

    include 'config/connection.php';

    // Use prepared statement to prevent SQL injection
    $upd = mysqli_prepare($con, "UPDATE customer SET image = ?, date = ? WHERE id = ?");

    // Bind parameters to the statement
    mysqli_stmt_bind_param($upd, "ssi", $e1, $date, $slider_id);

    if (mysqli_stmt_execute($upd)) {
        // Move uploaded files
        $targetPath = $location . $e1;
        if (move_uploaded_file($f1, $targetPath)) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var smsPopup = document.createElement('div');
                smsPopup.innerText = 'Data Updated successfully';
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
                    window.location.href = 'index';
                }, 1000);
            });
            </script>";

        } else {
            echo "<script>alert('Error moving uploaded file'); window.location.href='index'; </script>";
            exit;
        }
    } else {
        echo "<script>alert('Error executing SQL query'); window.location.href='index'; </script>";
        exit;
    }

    // Close the statement and connection
    mysqli_stmt_close($upd);
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home Details</title>
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
            <h1>Home Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- slider start -->
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal"
                                    data-bs-target="#add_slider" style="background-color: #2a3695; color:white;">
                                    <img src="assets/img/add-user.png" alt="Profile" class="add-image"> Add Slider
                                </button></h5>
                            <!-- ---modal start--- -->
                            <div class="modal fade" id="add_slider" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Slider Form </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Body - Your form goes here -->
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <!-- Your form fields go here -->
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Upload Image</label>
                                                            <input type="file" name="image" class="form-control" id=""
                                                                multiple>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="slider_insert" class="btn"
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

                            <div class="table-responsive">
                                <table class="table table-striped table-hover datatable">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Start Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sel = "SELECT * FROM slider ORDER BY id DESC";
                                        $r = mysqli_query($con, $sel);
                                        $id_sr = 1;
                                        while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                                            $cat_id = $k['1'];

                                            ?>
                                            <tr>
                                                <td>

                                                    <img src="home/<?php echo $k['image']; ?>" alt="1">

                                                </td>
                                                <td><?php echo $k['date']; ?></td>
                                                <td class="action-icons">
                                                    <i class="bi bi-trash3" title="Delete slider"
                                                        data-id='<?php echo $k['id']; ?>' id="click_sliderdelete"></i>
                                                    <i class="bi bi-pencil-square" title="Edit Slider"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#slidermodal_update<?php echo $k['id'] ?>"></i>
                                                </td>
                                                <!-- ---modal start--- -->
                                                <div class="modal fade" id="slidermodal_update<?php echo $k['id'] ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Slider Update
                                                                    Form </h5>
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
                                                                            <div class="mb-3 col-md-12">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label">Upload
                                                                                    Image</label><img
                                                                                    src="home/<?php echo $k['image'] ?>"
                                                                                    style="height: 30px; width: auto; padding: 5px;"
                                                                                    alt="Current Image">
                                                                                <input type="file" name="image"
                                                                                    class="form-control" id=""
                                                                                    alue="<?php echo $k['image'] ?>">
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="slider_update" class="btn"
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
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- slider end -->
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal"
                                    data-bs-target="#add_slider1" style="background-color: #2a3695; color:#fff;">
                                    <img src="assets/img/add-user.png" alt="Profile" class="add-image">Add Right Image
                                    Banner
                                </button></h5>
                            <!-- ---modal start--- -->
                            <div class="modal fade" id="add_slider1" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> Right Image Banner Form
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Modal Body - Your form goes here -->
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <!-- Your form fields go here -->
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Upload Image</label>
                                                            <input type="file" name="image" class="form-control" id=""
                                                                multiple>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="slider1_insert" class="btn"
                                                style="background-color: #2a3695; color:#fff;">SUBMIT
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

                            <div class="table-responsive">
                                <table class="table table-striped table-hover datatable">
                                    <thead>
                                        <tr>

                                            <th>Image</th>
                                            <th>Start Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $sel = "SELECT * FROM slider1 ORDER BY id DESC";
                                        $r = mysqli_query($con, $sel);
                                        $id_sr = 1;
                                        while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                                            $cat_id = $k['1'];

                                            ?>
                                            <tr>
                                                <td>

                                                    <img src="home/<?php echo $k['image']; ?>" alt="1">

                                                </td>
                                                <td><?php echo $k['date']; ?></td>
                                                <td class="action-icons">
                                                    <i class="bi bi-trash3" title="Delete slider"
                                                        data-id='<?php echo $k['id']; ?>' id="click_slider1delete"></i>
                                                    <i class="bi bi-pencil-square" title="Edit Slider"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#slider1modal_update<?php echo $k['id'] ?>"></i>
                                                </td>
                                                <!-- ---modal start--- -->
                                                <div class="modal fade" id="slider1modal_update<?php echo $k['id'] ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"> Right Image
                                                                    Update
                                                                    Form </h5>
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
                                                                            <div class="mb-3 col-md-12">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label">Upload
                                                                                    Image</label><img
                                                                                    src="home/<?php echo $k['image'] ?>"
                                                                                    style="height: 30px; width: auto; padding: 5px;"
                                                                                    alt="Current Image">
                                                                                <input type="file" name="image"
                                                                                    class="form-control" id=""
                                                                                    alue="<?php echo $k['image'] ?>">
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="slider1_update" class="btn"
                                                                    style="background-color: #2a3695; color:#fff;">SUBMIT
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
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Mobile slider end -->
                <div class="col-lg-6">
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal"
                data-bs-target="#add_partner" style="background-color: #2a3695; color:#fff;">
                <img src="assets/img/add-user.png" alt="Profile" class="add-image">Add Partners Logo
            </button></h5>
        <!-- ---modal start--- -->
        <div class="modal fade" id="add_partner" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Partners Logo Form
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!-- Modal Body - Your form goes here -->
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Your form fields go here -->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleFormControlInput1"
                                            class="form-label">Upload Image</label>
                                        <input type="file" name="image" class="form-control" id=""
                                            multiple>
                                    </div>

                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="partner_insert" class="btn"
                            style="background-color: #2a3695; color:#fff;">SUBMIT
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

        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>

                        <th>Image</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sel = "SELECT * FROM partner ORDER BY id DESC";
                    $r = mysqli_query($con, $sel);
                    $id_sr = 1;
                    while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                        $cat_id = $k['1'];

                        ?>
                        <tr>
                            <td>

                                <img src="home/<?php echo $k['image']; ?>" alt="1">

                            </td>
                            <td><?php echo $k['date']; ?></td>
                            <td class="action-icons">
                                <i class="bi bi-trash3" title="Delete partners"
                                    data-id='<?php echo $k['id']; ?>' id="click_partnerdelete"></i>
                                <i class="bi bi-pencil-square" title="Edit Partner"
                                    data-bs-toggle="modal"
                                    data-bs-target="#partnermodal_update<?php echo $k['id'] ?>"></i>
                            </td>
                            <!-- ---modal start--- -->
                            <div class="modal fade" id="partnermodal_update<?php echo $k['id'] ?>"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Partners Logo Update Form </h5>
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
                                                        <div class="mb-3 col-md-12">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Upload
                                                                Image</label><img
                                                                src="home/<?php echo $k['image'] ?>"
                                                                style="height: 30px; width: auto; padding: 5px;"
                                                                alt="Current Image">
                                                            <input type="file" name="image"
                                                                class="form-control" id=""
                                                                alue="<?php echo $k['image'] ?>">
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="partner_update" class="btn"
                                                style="background-color: #2a3695; color:#fff;">SUBMIT
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!--partner section end -->
<div class="col-lg-6">
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><button class="btn  table-button" data-bs-toggle="modal"
                data-bs-target="#add_customer" style="background-color: #2a3695; color:#fff;">
        <img src="assets/img/add-user.png" alt="Profile" class="add-image">Add Customers
            </button>
            </h5>
        <!-- ---modal start--- -->
        <div class="modal fade" id="add_customer" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Customers Form
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!-- Modal Body - Your form goes here -->
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Your form fields go here -->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="exampleFormControlInput1"
                                            class="form-label">Upload Image</label>
                                        <input type="file" name="image" class="form-control" id=""
                                            multiple>
                                    </div>

                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="customer_insert" class="btn"
                            style="background-color: #2a3695; color:#fff;">SUBMIT
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

        <div class="table-responsive">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>

                        <th>Image</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sel = "SELECT * FROM customer ORDER BY id DESC";
                    $r = mysqli_query($con, $sel);
                    $id_sr = 1;
                    while ($k = mysqli_fetch_array($r, MYSQLI_BOTH)) {
                        $cat_id = $k['1'];

                        ?>
                        <tr>
                            <td>

                                <img src="home/<?php echo $k['image']; ?>" alt="1">

                            </td>
                            <td><?php echo $k['date']; ?></td>
                            <td class="action-icons">
                                <i class="bi bi-trash3" title="Delete Customer"
                                    data-id='<?php echo $k['id']; ?>' id="click_customerdelete"></i>
                                <i class="bi bi-pencil-square" title="Edit Customer"
                                    data-bs-toggle="modal"
                                    data-bs-target="#customermodal_update<?php echo $k['id'] ?>"></i>
                            </td>
                            <!-- ---modal start--- -->
                            <div class="modal fade" id="customermodal_update<?php echo $k['id'] ?>"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customers Update Form</h5>
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
                                                        <div class="mb-3 col-md-12">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Upload
                                                                Image</label><img
                                                                src="home/<?php echo $k['image'] ?>"
                                                                style="height: 30px; width: auto; padding: 5px;"
                                                                alt="Current Image">
                                                            <input type="file" name="image"
                                                                class="form-control" id=""
                                                                alue="<?php echo $k['image'] ?>">
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="customer_update" class="btn"
                                                style="background-color: #2a3695; color:#fff;">SUBMIT
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!--customer section end -->
            </div>
        </section>
    </main>
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
        $(document).on("click", "#click_sliderdelete", function () {
            var id = $(this).data("id");
            Swal.fire({
                title: "Are you sure item will be deleted ?",
                showCancelButton: true,
                confirmButtonColor: "#16263d !important",
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
                    window.location.href = "slider_delete?id=" + id; // Redirect to blog_edit.php with the 'id' query string
                }
            });
        });
        $(document).on("click", "#click_slider1delete", function () {
            var id = $(this).data("id");
            Swal.fire({
                title: "Are you sure item will be deleted ?",
                showCancelButton: true,
                confirmButtonColor: "#16263d !important",
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
                    window.location.href = "slider_delete1?id=" + id; // Redirect to blog_edit.php with the 'id' query string
                }
            });
        });
        $(document).on("click", "#click_partnerdelete", function () {
            var id = $(this).data("id");
            Swal.fire({
                title: "Are you sure item will be deleted ?",
                showCancelButton: true,
                confirmButtonColor: "#16263d !important",
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
                    window.location.href = "partner_delete?id=" + id; // Redirect to blog_edit.php with the 'id' query string
                }
            });
        });
        $(document).on("click", "#click_customerdelete", function () {
            var id = $(this).data("id");
            Swal.fire({
                title: "Are you sure item will be deleted ?",
                showCancelButton: true,
                confirmButtonColor: "#16263d !important",
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
                    window.location.href = "customer_delete?id=" + id; // Redirect to blog_edit.php with the 'id' query string
                }
            });
        });
    </script>
</body>

</html>