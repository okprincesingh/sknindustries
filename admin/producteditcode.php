<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a0 = $_POST['proid'];
    $a1 = $_POST['catid'];
    $a3 = $_POST['product_name'];
    $new_cat = str_replace(' ', '-', $a3);
    $file_names = [];

    if (!empty($_FILES["image1"]["name"][0])) {
        foreach ($_FILES["image1"]["name"] as $key => $file_name) {
            $uniqueID = uniqid();
            $file_names[] = $uniqueID . "_" . $file_name;
        }
    }

    $image1 = implode(",", $file_names);
    $metakeyword = $_POST['metakeyword'];
    $metadescription = $_POST['metadescription'];
    $metatitle = $_POST['metatitle'];
    $canonical_url = $_POST['canonical_url'];
    $timestamp = time();
    $a5 = date('Y-M-d', $timestamp);
    $description = $_POST['description'];

    function createSlug($estring)
    {
        $slug = strtolower($estring);
        $slug = '/' . str_replace(' ', '-', $slug);
        return $slug;
    }

    $slug = createSlug($a3);

    include 'config/connection.php';

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // ==============================
    // Get old product images
    // ==============================
    $oldImages = "";
    $getOldImages = mysqli_query($con, "SELECT image1 FROM product WHERE proid='$a0'");

    if ($getOldImages && mysqli_num_rows($getOldImages) > 0) {
        $oldRow = mysqli_fetch_assoc($getOldImages);
        $oldImages = $oldRow['image1'];
    }

    if (empty($_FILES['image1']['name'][0])) {
        $update = mysqli_prepare($con, "UPDATE product SET catid=?, product_name=?, metakeyword=?, metadescription=?, metatitle=?, canonical_url=?, date=?, description=?, slug_url=? WHERE proid=?");
        mysqli_stmt_bind_param($update, "issssssssi", $a1, $new_cat, $metakeyword, $metadescription, $metatitle, $canonical_url, $a5, $description, $slug, $a0);
    } else {
        $update = mysqli_prepare($con, "UPDATE product SET catid=?, product_name=?, image1=?, metakeyword=?, metadescription=?, metatitle=?, canonical_url=?, date=?, description=?, slug_url=? WHERE proid=?");
        mysqli_stmt_bind_param($update, "isssssssssi", $a1, $new_cat, $image1, $metakeyword, $metadescription, $metatitle, $canonical_url, $a5, $description, $slug, $a0);
    }

    if (mysqli_stmt_execute($update)) {

        // Move uploaded files
        $uploadErrors = [];

        foreach ($_FILES["image1"]["tmp_name"] as $key => $tmp_name) {

            $uploadPath = "../product/images/" . $file_names[$key];

            if (!empty($file_names[$key]) && !move_uploaded_file($tmp_name, $uploadPath)) {
                $uploadErrors[] = "Error moving uploaded file '{$file_names[$key]}'";
            }
        }

        if (empty($uploadErrors)) {

            // ==========================================
            // Delete old images after successful upload
            // ==========================================
            if (!empty($_FILES['image1']['name'][0]) && !empty($oldImages)) {

                $oldImageArray = explode(",", $oldImages);

                foreach ($oldImageArray as $oldImage) {

                    $oldImage = trim($oldImage);

                    $oldImagePath = "../product/images/" . $oldImage;

                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
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
                    window.location.href = 'product-detail';
                }, 1000);
            });
            </script>";

        } else {

            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var smsPopup = document.createElement('div');
                smsPopup.innerText = 'Data updated successfully, but there were some errors with file uploads: " . implode(", ", $uploadErrors) . "';
                smsPopup.style.position = 'fixed';
                smsPopup.style.bottom = '10px';
                smsPopup.style.right = '10px';
                smsPopup.style.backgroundColor = '#ff9800';
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

        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var smsPopup = document.createElement('div');
            smsPopup.innerText = 'Data not updated';
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

    mysqli_stmt_close($update);
    mysqli_close($con);

} else {

    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var smsPopup = document.createElement('div');
        smsPopup.innerText = 'Data not updated';
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

error_log("Error: " . mysqli_error($con));
?>