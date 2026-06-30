<?php 

include "./admin/config/connection.php";
$proid = 0;
$catid = 0;
$product_name = '';
$image = '';
$images222 = [];
$date = '';
$product_url = '';
$description = '';
$metakeyword = '';
$metadescription = '';
$metatitle = 'Product Details | SKN Industries';
$canonical_url = '';
$slug_url = '';

if (isset($_SERVER['PATH_INFO'])) {
    $pathInfo = rawurldecode($_SERVER['PATH_INFO']);
    $normalizedPath = "/" . trim($pathInfo, "/");
    $lowercasePath = strtolower($normalizedPath);

    if ($normalizedPath !== $lowercasePath) {
        $queryString = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== ''
            ? '?' . $_SERVER['QUERY_STRING']
            : '';
        header("Location: /product-details-" . ltrim($lowercasePath, '/') . $queryString, true, 301);
        exit;
    }

    $slugLike = "/" . trim($pathInfo, "/");

    // Match only saved slug_url (with and without leading slash)
    $stmt = mysqli_prepare($con, "SELECT * FROM product WHERE slug_url = ? OR slug_url = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "ss", $pathInfo, $slugLike);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        $proid = (int)$row['proid'];
        $catid = (int)$row['catid'];
        $product_name = $row['product_name'] ?? '';
        $image = $row['image'] ?? '';
        $images222 = !empty($row['image1']) ? explode(",", $row['image1']) : [];
        $date = $row['date'] ?? '';
        $product_url = $row['product_url'] ?? ($row['product_name'] ?? '');
        $description = $row['description'] ?? '';
        $metakeyword = $row['metakeyword'] ?? '';
        $metadescription = $row['metadescription'] ?? '';
        $metatitle = !empty($row['metatitle']) ? $row['metatitle'] : ($product_url . ' | SKN Industries');
        $canonical_url = $row['canonical_url'] ?? '';
        $slug_url = $row['slug_url'] ?? '';
    }
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

  <?php if (!empty($canonical_url)) { ?>
    <link rel="canonical" href="https://www.sknindustries.com/<?php echo htmlspecialchars($canonical_url); ?>" />
    <?php } else { ?>
    <link rel="canonical" href="default, canonical" />
    <?php } ?>
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- bootsratp css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .product-description {
            color: #172033;
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 1.65;
            margin: 0;
            padding: 0;
        }

        .product-description h1,
        .product-description h2,
        .product-description h3,
        .product-description h4,
        .product-description h5,
        .product-description h6 {
            color: #1d2636;
            font-weight: 600;
            line-height: 1.25;
            margin: 22px 0 10px;
        }

        .product-description h1 {
            font-size: 30px;
        }

        .product-description h2 {
            font-size: 26px;
        }

        .product-description h3 {
            font-size: 22px;
        }

        .product-description p {
            margin: 0 0 14px;
        }

        .product-description ul,
        .product-description ol {
            margin: 0 0 16px 22px;
            padding: 0;
        }

        .product-description li {
            margin: 0 0 8px;
            padding-left: 4px;
        }

        .product-description table {
            width: 100% !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            margin: 18px 0 22px !important;
            table-layout: fixed;
        }

        .product-description td,
        .product-description th {
            border: 1px solid #d9dee8;
            padding: 10px 12px !important;
            vertical-align: top;
            word-break: break-word;
        }

        .product-description th,
        .product-description tr:first-child td {
            background: #f4f6f9;
            font-weight: 600;
        }

        .product-description a {
            color: #0053cd;
        }

        @media screen and (max-width: 768px) {
            .product-description {
                font-size: 14px;
                line-height: 1.6;
            }

            .product-description h1 {
                font-size: 24px;
            }

            .product-description h2 {
                font-size: 22px;
            }

            .product-description h3 {
                font-size: 20px;
            }

            .product-description table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
</style>
  <link rel="icon" type="image/x-icon" href="assets/imgs/logos/fav.png">
</head>

<body>
    <?php include 'includes/header.php' ?>

    <div>
        <div>
        <?php echo "<h1 class='title mb-2'>" . (!empty($product_url) ? htmlspecialchars($product_url) : "Product Not Found") . "</h1>" ?>
          
            <div class="t-border"></div>
        </div>
        <div class="container py-4 ">
            <div class="row g-2">
           <?php
if (!empty($images222)) {
    foreach (array_slice($images222, 0, 15) as $index => $image1) {
        $image1 = trim($image1);
        if ($image1 === '') {
            continue;
        }
?>
    <div class="col-12 col-sm-6 col-md-4" style="padding:6px;">
        <img src="./admin/product/<?php echo htmlspecialchars($image1); ?>" 
             alt="SKN Industries"
             style="aspect-ratio:19/16; width:100%; object-fit:cover; border-radius:6px;">
    </div>
<?php
    }
} else {
    echo "<p class='text-center py-3'>No product images available.</p>";
}
?>

        </div>

<div class="container">
            <?php
$fullText = $description;
$plainText = trim(preg_replace('/\s+/', ' ', strip_tags($description)));
$words = preg_split('/\s+/', $plainText, -1, PREG_SPLIT_NO_EMPTY);
$limit = 100;

if(count($words) > $limit){
    $shortText = implode(" ", array_slice($words, 0, $limit));
    $isLong = true;
} else {
    $shortText = $plainText;
    $isLong = false;
}
?>

<div class="product-description">

    <?php if($isLong) { ?>
        <div id="short-description" style="margin-bottom:8px;">
            <?php echo htmlspecialchars(trim($shortText)); ?>...
        </div>
    <?php } ?>

    <div id="full-description" style="<?php echo $isLong ? 'display:none;' : ''; ?> margin-bottom:8px;">
        <?php echo trim($fullText); ?>
    </div>

    <?php if($isLong) { ?>
        <button id="toggleDescBtn" 
            style="padding:7px 18px; 
                   background:#0053cd; 
                   color:#fff; 
                   border:none; 
                   border-radius:50px;
                   cursor:pointer;
                   font-size:14px;
                   font-weight:600;
                   transition:0.3s;
                   display:inline-block;">
            Read More
        </button>
    <?php } ?>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    var btn = document.getElementById("toggleDescBtn");
    var fullDiv = document.getElementById("full-description");
    var shortDiv = document.getElementById("short-description");

    if(btn){
        btn.onclick = function(){
            if(fullDiv.style.display === "none"){
                fullDiv.style.display = "block";
                shortDiv.style.display = "none";
                btn.innerHTML = "Read Less";
            } else {
                fullDiv.style.display = "none";
                shortDiv.style.display = "block";
                btn.innerHTML = "Read More";
            }
        }
    }
});
</script>
            <div class="py-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">
                    Send Inquiry
                </button>

             
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:10px; overflow:hidden; box-shadow:0px 0px 10px rgba(0,0,0,0.2);">
            
            <!-- Header -->
            <div class="modal-header" style="background:#2A3695; color:#fff; padding:10px 15px;">
                <h5 class="modal-title" style="font-weight:600;">Enquiry Form</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="background:white; color:#2A3695; border-radius:50%; width:32px; height:32px; 
                               text-align:center; border:1px solid white; font-size:22px; line-height:18px;
                               display:flex; justify-content:center; align-items:center; cursor:pointer;" 
                        
                        onmouseover="this.style.background='#fff'; this.style.color='#2A3695';"
                        onmouseout="this.style.background='white'; this.style.color='#2A3695';">
                    ×
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body" style="background:#f5f6f7; padding:18px 20px;">
                
                <form style="border:1px dashed #2A3695; padding:18px 20px; border-radius:8px; background:white;"
                    action="sendEnquiry-mail.php" method="post">
                        <?php
if (!empty($images222)) {
    foreach (array_slice($images222, 0, 1) as $index => $image1) {
        $image1 = trim($image1);
        if ($image1 === '') {
            continue;
        }
?>
    <div class="col-12 col-sm-6 col-md-4" style="padding:6px;">
        <img src="./admin/product/<?php echo htmlspecialchars($image1); ?>" 
             alt="SKN Industries"
             style="aspect-ratio:19/16; width:100%; object-fit:cover; border-radius:6px;">
    </div>
<?php
    }
}
?>

                        <div style="margin-bottom:12px !important;">
                        <label style="font-weight:600;">Product Name</label>
                        <input type="text" class="form-control" placeholder="Enter Your product"
                            name="product" required value="<?php echo "$product_url" ?>" readonly="">
                    </div>
                    <!-- Row 1 -->
                    <div style="display:flex; gap:20px;">
                        <div style="flex:1;">
                            <label style="font-weight:600;">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter Your Full Name" 
                                name="name" required>
                        </div>

                        <div style="flex:1;">
                            <label style="font-weight:600;">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Your Email"
                                name="email" required>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div style="margin-top:12px;">
                        <label style="font-weight:600;">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter Your Phone"
                            name="phone" required>
                    </div>

                    <!-- Row 3 -->
                    <div style="display:flex; gap:20px; margin-top:12px;">
                        <div style="flex:1;">
                            <label style="font-weight:600;">Company</label>
                            <input type="text" class="form-control" placeholder="Company"
                                name="company" required>
                        </div>

                        <div style="flex:1;">
                            <label style="font-weight:600;">State</label>
                            <input type="text" class="form-control" placeholder="State" name="state" required>
                        </div>
                    </div>

                    <!-- Message -->
                    <div style="margin-top:12px;">
                        <label style="font-weight:600;">Message</label>
                        <textarea class="form-control" rows="3" placeholder="Type Here..." name="msg"></textarea>
                    </div>
                    <div style="margin-top:12px;">
                        <div class="product-recaptcha" id="recaptcha-corrugatedBox" data-sitekey="<?php echo htmlspecialchars(RECAPTCHA_SITE_KEY, ENT_QUOTES); ?>"></div>
                    </div>

                    <!-- Footer Buttons -->
                    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:18px;">
                        
                        <button type="button" data-dismiss="modal"
                            style="padding:7px 18px; border-radius:5px; border:1px solid #2A3695; background:white; color:#2A3695;
                                   font-weight:500; transition:0.3s; cursor:pointer;"
                            onmouseover="this.style.background='#2A3695'; this.style.color='white';"
                            onmouseout="this.style.background='white'; this.style.color='#2A3695';">
                            Close
                        </button>

                        <button type="submit" name="submit"
                            style="padding:7px 18px; border-radius:5px; background:#2A3695; color:#fff; font-weight:500; cursor:pointer;">
                            Send
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        window.onProductRecaptchaLoad = function () {};
        $(document).on('shown.bs.modal', '#exampleModalCenter', function () {
            if (typeof grecaptcha === 'undefined') return;
            var el = document.getElementById('recaptcha-corrugatedBox');
            if (!el) return;
            if (!el.dataset.widgetId) {
                el.dataset.widgetId = grecaptcha.render(el.id, { sitekey: el.dataset.sitekey });
            } else {
                grecaptcha.reset(parseInt(el.dataset.widgetId, 10));
            }
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onProductRecaptchaLoad&render=explicit" async defer></script>

    <script>
        $(document).ready(function () {
            $("#toggle").click(function () {
                $(".main").toggleClass("open");
            });
        });

        $(document).ready(function () {
            $(".closebtn").click(function () {
                $(".main").removeClass("open");
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
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

    <script>
        var swiper = new Swiper(".mySwiper1", {
            spaceBetween: 20,
            centeredSlides: true,
            autoplay: {
                delay: 1000,
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
            breakpoints: {
                640: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 7,
                },
            },
        });
    </script>

    <script>
        var swiper = new Swiper(".mySwiper2", {
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
        });
    </script>

    <script>
        var swiper = new Swiper(".mySwiper3", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper4", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
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
            breakpoints: {
                640: {
                    slidesPerView: 7,
                },
                768: {
                    slidesPerView: 8,
                },
                1024: {
                    slidesPerView: 9,
                },
            },
        });
    </script>
</body>

</html>
