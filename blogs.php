<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SKN Industries Blog: Insights on Packaging Solutions</title>
     <meta name="description" content="Stay updated with the latest trends, tips, and innovations in the packaging industry through the SKN Industries blog." />
     <meta name="Keyword" content="Corrugated Boxes,Corrugated Boxes Manufacturers,Wooden Pallets Manufacturers,Wooden Pallets" />

    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
      <link rel="icon" type="image/x-icon" href="assets/imgs/logos/fav.png">
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
     <link rel="canonical" href="https://www.sknindustries.com/blogs" />
</head>

<body>
    <?php include 'includes/header.php' ?>

    <div class="py-0">
        <div class="row g-0">
            <img src="assets/imgs/banners/blogs.jpeg" alt="Skn industries" width="100%">
        </div>
    </div>

    <div>
        <div>
            <h3 class="title mb-2">OUR BLOGS</h3>
            <div class="t-border"></div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <div>
                    <?php
include "./admin/config/connection.php";

    $sql = "SELECT * FROM blog ORDER BY id DESC";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $title = $row['title'];
        $slug_url = $row['slug_url'];
        $slug_for_url = ltrim((string)$slug_url, '/');
        $slug_for_url = preg_replace('/\s+/', '-', trim($slug_for_url));
        if ($slug_for_url === '') {
            $slug_for_url = str_replace(' ', '-', $title);
        }
        $image = $row['image'];
        $admin_name = $row['admin_name'];
        $date = $row['date'];
        $description = $row['description'];
        echo '
         <div class="container border py-2 my-2">
                            <div class="row">
                                <div class="col-lg-4">
                                    <img src="./admin/blog/' . $image . '" alt="skn industries" width="100%" class="hover">
                                </div>
                                <div class="col-lg-8">
                                    <h3>' . $title . '</h3>
                                    <p>By ' . htmlspecialchars($admin_name) . ' | ' . htmlspecialchars($date) . '</p>
                         <p>' . substr($description, 0, 100) . '...</p>
                                    <a href="blog-detail-' . htmlspecialchars($slug_for_url, ENT_QUOTES, 'UTF-8') . '" style="text-decoration:none">
                                        <button class="frm-btn">Read More</button>
                                    </a>
                                </div>
                            </div>
                        </div>';
    }
?>
                    </div>

                </div>
                <div class="col-lg-3 b-sticky">
                    <h3 class="text-center">Popular Posts</h3>

                    <ul class="b-links">
                    <?php
include "./admin/config/connection.php";

    $sql = "SELECT * FROM blog ORDER BY id ASC LIMIT 8";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $title = $row['title'];
        $slug_url = $row['slug_url'];
        $slug_for_url = ltrim((string)$slug_url, '/');
        $slug_for_url = preg_replace('/\s+/', '-', trim($slug_for_url));
        if ($slug_for_url === '') {
            $slug_for_url = str_replace(' ', '-', $title);
        }
        $image = $row['image'];
        $date = $row['date'];
        $description = $row['description'];
        echo '<li>
         <a href="blog-detail-' . htmlspecialchars($slug_for_url, ENT_QUOTES, 'UTF-8') . '" class="a">
                              ' . $title . '</a></li>
<hr 
 ';
    }
?>
                    </ul>

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
    <script src="script.js"></script>
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
