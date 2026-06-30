<?php 
include "./admin/config/connection.php";
// Check if the path info (slug) is present
if (isset($_SERVER['PATH_INFO'])) {
    $slug_url = $_SERVER['PATH_INFO'];

    // Sanitize the slug URL to prevent SQL injection
    $slug_url = mysqli_real_escape_string($con, $slug_url);

    // Get category details based on the slug URL
    $sql = "SELECT * FROM pro_categories WHERE slug_url = '$slug_url'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    // Extract category data
    $cat_name = $row['cat_name'];
    $new_category = str_replace('-', ' ', $cat_name);
    $cat_url = str_replace(' ', '-', $cat_name);
    $cat_id = $row['catid'];  // The correct variable name is $cat_id
    $image = $row['image'];
    $cat_url1 = $row['cat_url'];
    $description = $row['description'];
    $metakeyword = $row['metakeyword'];
    $metadescription = $row['metadescription'];
    $metatitle = $row['metatitle'];
    $canonical_url = $row['canonical_url'];
    $slug_url = $row['slug_url'];
    $proid = $row['proid'];   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . '/includes/recaptcha-config.php'; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 
    <!-- Title -->
    <?php if (!empty($metatitle)) { ?>
        <title><?php echo htmlspecialchars($metatitle); ?></title>
    <?php } ?>

    <!-- Meta keywords -->
    <?php if (!empty($metakeyword)) { ?>
        <meta name="keywords" content="<?php echo htmlspecialchars($metakeyword); ?>" />
    <?php } else { ?>
        <meta name="keywords" content="default, keywords" />  <!-- Default value if empty -->
    <?php } ?>

    <!-- Meta description -->
    <?php if (!empty($metadescription)) { ?>
        <meta name="description" content="<?php echo htmlspecialchars($metadescription); ?>" />
    <?php } else { ?>
        <meta name="description" content="Default description if no meta description is provided." />  <!-- Default description -->
    <?php } ?>

    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php if (!empty($canonical_url)) { ?>
    <link rel="canonical" href="https://www.sknindustries.com/<?php echo htmlspecialchars($canonical_url); ?>" />
    <?php } else { ?>
    <link rel="canonical" href="default, canonical" />
    <?php } ?>
</head>
<body>
    <?php include 'includes/header.php' ?>
    <div class="py-0">
        <div class="row g-0">
            <img src="assets/imgs/banners/banner-1.png" alt="Skn industries" width="100%">
        </div>
    </div>

    <div>
        <h1 class="title mb-2"><?php echo htmlspecialchars($cat_url1); ?></h1>
        <div class="t-border"></div>
    </div>
    <div class="container">
    <?php
    $fullText = trim($description);
    $plainText = trim(strip_tags($description));

    // Remove extra spaces
    $plainText = preg_replace('/\s+/', ' ', $plainText);

    $words = explode(" ", $plainText);
    $limit = 100;

    if(count($words) > $limit){
        $shortText = implode(" ", array_slice($words, 0, $limit));
        $isLong = true;
    } else {
        $shortText = $plainText;
        $isLong = false;
    }
    ?>

    <!-- Short 100-word Part -->
    <div id="short-description">
        <p><?php echo $shortText; ?><?php echo ($isLong ? "...":""); ?></p>
    </div>

    <!-- Full Description -->
    <div id="full-description" style="display:none;">
        <p><?php echo $fullText; ?></p>
    </div>

    <?php if($isLong) { ?>
        <button id="toggleDescBtn"
        style="
            padding:7px 20px;
            background:#0053cd;
            color:#fff;
            border:none;
            border-radius:50px;
            cursor:pointer;
            font-size:14px;
            font-weight:600;
            margin-top:10px;
            ">
            Read More
        </button>
    <?php } ?>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const btn = document.getElementById("toggleDescBtn");
    const fullDiv = document.getElementById("full-description");
    const shortDiv = document.getElementById("short-description");

    if(btn){
        btn.addEventListener("click", function(){

            if(fullDiv.style.display === "none"){
                fullDiv.style.display = "block";
                shortDiv.style.display = "none";
                btn.innerText = "Read Less";
            } else {
                fullDiv.style.display = "none";
                shortDiv.style.display = "block";
                btn.innerText = "Read More";
            }

        });
    }

});
</script>


    <div class="container py-4">
        <div class="row justify-content-center">
            <!-- Showing all related products for this category -->
         <?php
// Fetch products related to the category
$sql = "SELECT * FROM product WHERE catid = '$cat_id'";
$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {

        $proid         = $row['proid'];
        $product_name  = $row['product_name'];
        $new_product = str_replace('-', ' ', $product_name);
        $images        = explode(",", $row['image1']);
        ?>

        <div class="col-lg-3 box-shadow p-2 m-2">
            <h4 class="text-center"><?php echo htmlspecialchars($new_product); ?></h4>

            <?php if (!empty($images[0])) { ?>
                <img src="./product/images/<?php echo htmlspecialchars($images[0]); ?>"
                     alt="<?php echo htmlspecialchars($product_name); ?>" 
                     style="aspect-ratio:19/16;" width="100%">
            <?php } ?>

            <div class="d-flex justify-content-center py-2">
                <a href="product-details-<?php echo urlencode($product_name); ?>" style="text-decoration:none;">
                    <button class="frm-btn mx-2">Read More</button>
                </a>

                <button type="button" class="btn btn-secondary" 
                        data-toggle="modal" data-target="#modal<?php echo $proid; ?>">
                    Send Inquiry
                </button>
            </div>
        </div>

        <!-- ===================== MODAL ===================== -->
        <div class="modal fade" id="modal<?php echo $proid; ?>" tabindex="-1" role="dialog"
     aria-labelledby="modalTitle<?php echo $proid; ?>" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" 
             style="border-radius:10px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,0.2);">

            <!-- Header -->
            <div class="modal-header" style="background:#2A3695; color:#fff;">
                <h5 class="modal-title" id="modalTitle<?php echo $proid; ?>">Enquiry Form</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="background:white; color:#2A3695; border-radius:50%; width:32px; height:32px; border:1px solid white; font-size:22px;">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body" style="background:#f5f6f7;">

                <form action="sendEnquiry-mail.php" method="post"
                      style="border:1px dashed #2A3695; padding:18px; border-radius:8px; background:white;">

                    <!-- Product Image -->
                    <?php if (!empty($images[0])) { ?>
                        <div style="margin-bottom:12px; text-align:center;">
                            <img src="./product/images/<?php echo htmlspecialchars($images[0]); ?>" 
                                 alt="product" width="100%" 
                                 style="max-height:200px; object-fit:contain; border-radius:6px;">
                        </div>
                    <?php } ?>

                    <!-- Product Name -->
                    <div style="margin-bottom:12px;">
                        <label style="font-weight:600;">Product Name</label>
                        <input type="text" class="form-control" name="product"
                               readonly value="<?php echo htmlspecialchars($new_product); ?>" readonly>
                    </div>

                    <!-- Row 1 -->
                    <div style="display:flex; gap:20px;">
                        <div style="flex:1;">
                            <label style="font-weight:600;">Full Name</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="Enter Your Full Name" required>
                        </div>

                        <div style="flex:1;">
                            <label style="font-weight:600;">Email</label>
                            <input type="email" class="form-control" name="email"
                                   placeholder="Enter Your Email" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div style="margin-top:12px;">
                        <label style="font-weight:600;">Phone</label>
                        <input type="text" class="form-control" name="phone"
                               placeholder="Enter Your Phone" required>
                    </div>

                    <!-- Row 2 -->
                    <div style="display:flex; gap:20px; margin-top:12px;">
                        <div style="flex:1;">
                            <label style="font-weight:600;">Company</label>
                            <input type="text" class="form-control" name="company"
                                   placeholder="Company" required>
                        </div>

                        <div style="flex:1;">
                            <label style="font-weight:600;">State</label>
                            <input type="text" class="form-control" name="state"
                                   placeholder="State" required>
                        </div>
                    </div>

                    <!-- Message -->
                    <div style="margin-top:12px;">
                        <label style="font-weight:600;">Message</label>
                        <textarea class="form-control" rows="3" name="msg"
                                  placeholder="Type Here..."></textarea>
                    </div>
                    <div style="margin-top:12px;">
                        <div class="product-recaptcha" id="recaptcha-modal-<?php echo $proid; ?>" data-sitekey="<?php echo htmlspecialchars(RECAPTCHA_SITE_KEY, ENT_QUOTES); ?>"></div>
                    </div>

                    <!-- Buttons -->
                    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:18px;">
                        <button type="button" data-dismiss="modal"
                                style="padding:7px 18px; border-radius:5px; border:1px solid #2A3695;
                                       background:white; color:#2A3695;">
                            Close
                        </button>

                        <button type="submit" name="submit"
                                style="padding:7px 18px; border-radius:5px; background:#2A3695; color:#fff;">
                            Send
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

        <!-- ===================== END MODAL ===================== -->

<?php 
    }
} else {
    echo "<p>No products available in this category.</p>";
}
?>


        </div>
    </div>
    <?php include 'includes/footer.php' ?>
    <script>
        window.onProductRecaptchaLoad = function () {};
        $(document).on('shown.bs.modal', '.modal', function () {
            if (typeof grecaptcha === 'undefined') return;
            var target = this.querySelector('.product-recaptcha');
            if (!target) return;
            if (!target.dataset.widgetId) {
                target.dataset.widgetId = grecaptcha.render(target.id, { sitekey: target.dataset.sitekey });
            } else {
                grecaptcha.reset(parseInt(target.dataset.widgetId, 10));
            }
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onProductRecaptchaLoad&render=explicit" async defer></script>
    <script>
        $(document).ready(function () {
            $("#toggle").click(function () {
                $(".main").toggleClass("open");
            });

            $(".closebtn").click(function () {
                $(".main").removeClass("open");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            on: {
                autoplayTimeLeft(s, time, progress) {
                    progressCircle.style.setProperty("--progress", 1 - progress);
                    progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                },
            },
        });
    </script>
</body>
</html>
