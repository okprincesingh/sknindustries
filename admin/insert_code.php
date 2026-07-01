<?php
if (isset($_POST['blog_insert'])) {
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
    $location = __DIR__ . "/../blog/images/";
    $safeImageName = !empty($image_name) ? time() . '_' . basename($image_name) : '';

    include 'config/connection.php';
    function createSlug($string)
    {
        
        $slug = strtolower($string);
     
        $slug = '/'.str_replace(' ', '-', $slug);
        $slug = str_replace('?',' ',$slug);
      
       
        return $slug;
    }

    $slug = $slug_url !== '' ? $slug_url : createSlug($title);
    $slug = preg_replace('/\s+/', '-', trim($slug));
    
    $ins = mysqli_prepare($con, "INSERT INTO blog (title, admin_name, date, image, meta_title, meta_description, meta_keyword, canonical_url, description, slug_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($ins) {
        mysqli_stmt_bind_param($ins, "ssssssssss", $title, $admin_name, $date, $safeImageName, $meta_title, $meta_description, $meta_keyword, $canonical_url, $description, $slug);

        if (mysqli_stmt_execute($ins)) {
            if (!empty($image_name) && !empty($image_tmp_name)) {
                if (($_FILES['image']['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
                    echo '<script>alert("Upload error code: ' . (int) $_FILES['image']['error'] . '"); window.location.href="blog-detail";</script>';
                    exit;
                }

                if (!is_dir($location) && !mkdir($location, 0755, true)) {
                    echo '<script>alert("Blog image folder does not exist or cannot be created"); window.location.href="blog-detail";</script>';
                    exit;
                }

                if (!is_writable($location)) {
                    echo '<script>alert("Blog image folder is not writable"); window.location.href="blog-detail";</script>';
                    exit;
                }

                $targetPath = $location . $safeImageName;
                if (move_uploaded_file($image_tmp_name, $targetPath)) {
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
                            window.location.href = 'blog-detail';
                        }, 1000);
                    });
                  </script>";
                } else {
                    echo '<script>alert("Error moving uploaded file"); window.location.href="blog-detail";</script>';
                    exit;
                }
            } else {
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
                        window.location.href = 'blog-detail';
                    }, 1000);
                });
              </script>";
            }
        } else {
            echo '<script>alert("Error executing the insert"); window.location.href="blog-detail";</script>';
            exit;
        }
    } else {
        echo '<script>alert("Error preparing the insert statement"); window.location.href="blog-detail";</script>';
        exit;
    }

    mysqli_stmt_close($ins);
    mysqli_close($con);
}
?>
