<?php 
include "./admin/config/connection.php";
if(isset($_SERVER['PATH_INFO'])){
    $normalizedPath = '/' . trim(rawurldecode($_SERVER['PATH_INFO']), '/');
    $lowercasePath = strtolower($normalizedPath);

    if ($normalizedPath !== $lowercasePath) {
        $queryString = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== ''
            ? '?' . $_SERVER['QUERY_STRING']
            : '';
        header("Location: /blog-detail-" . ltrim($lowercasePath, '/') . $queryString, true, 301);
        exit;
    }

    $path_slug = ltrim($normalizedPath, '/');
    $slug_with_slash = '/' . $path_slug;

   $stmt = mysqli_prepare($con, "SELECT * FROM blog WHERE slug_url = ? OR slug_url = ? LIMIT 1");
   mysqli_stmt_bind_param($stmt, "ss", $path_slug, $slug_with_slash);
   mysqli_stmt_execute($stmt);
   $query = mysqli_stmt_get_result($stmt);
   $row = mysqli_fetch_array($query);
   $id = $row['id'];
   $image = $row['image'];
   $meta_keyword = $row['meta_keyword'];
   $meta_description = $row['meta_description'];
   $meta_title = $row['meta_title'];
   $canonical_url = $row['canonical_url'];
   $description = $row['description'];
   $admin_name = $row['admin_name'];
   $date = $row['date'];
   $title = htmlspecialchars($row['title']);
   $slug_url = $row['slug_url'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="icon" type="image/x-icon" href="assets/imgs/logos/fav.png">
    <!-- Title -->
    <?php if (!empty($meta_title)) { ?>
        <title><?php echo htmlspecialchars($meta_title); ?></title>
    <?php } ?>

    <!-- Meta keywords -->
    <?php if (!empty($meta_keyword)) { ?>
        <meta name="keywords" content="<?php echo htmlspecialchars($meta_keyword); ?>" />
    <?php } else { ?>
        <meta name="keywords" content="default, keywords" />  <!-- Default value if empty -->
    <?php } ?>

    <!-- Meta description -->
    <?php if (!empty($meta_description)) { ?>
        <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>" />
    <?php } else { ?>
        <meta name="description" content="Default description if no meta description is provided." />  <!-- Default description -->
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
    <?php if (!empty($canonical_url)) { ?>
    <link rel="canonical" href="https://www.sknindustries.com/<?php echo htmlspecialchars($canonical_url); ?>" />
    <?php } else { ?>
    <link rel="canonical" href="default, canonical" />
    <?php } ?>
</head>

<body>
    <?php include 'includes/header.php' ?>

<div class="img-bg">

<div class="container">
        <div>
            <h1 class="title mb-2 h3"><?php echo $title ?></h1>
            <p>By <?php echo htmlspecialchars($admin_name); ?> | <?php echo htmlspecialchars($date); ?></p>
            <div class="t-border"></div>
        </div>
        <div class="row">
           <div class="col-lg-6">
               <div  style="position:sticky; top:10px ">
    <img src="./admin/blog/<?php echo $image; ?>" alt="Skn industries" width="100%" >
</div>
           </div>
            <div class="col-lg-6">
                
        <p><?php echo $description ?></p>
            </div>
        </div>



    </div>
</div>
    <?php include 'includes/footer.php' ?>

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
        <script src="script.js"></script>
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
