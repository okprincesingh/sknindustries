<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . '/includes/recaptcha-config.php'; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact SKN Industries: Get in Touch</title>
   <meta name="description" content="Reach out to SKN Industries for inquiries about our products and services. We're here to provide you with the best packaging solutions." />
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
     <link rel="canonical" href="https://www.sknindustries.com/contact" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>


<body>
    <?php include 'includes/header.php' ?>
    <?php
                    include "./admin/config/connection.php";

                    $select5 ="SELECT * FROM contact_details";

                    $row5 = mysqli_query($con, $select5);

                    while($print = mysqli_fetch_assoc($row5)){
                ?>
    <div class="py-0">
        <div class="row g-0">
            <img src="assets/imgs/banners/contact.jpeg" alt="Skn industries" width="100%">
        </div>
    </div>

    <div class=" py-3">


<div>
<h3 class="title mb-2 text-uppercase">Contact Us</h3>
<div class="t-border"></div>
    <h5 class="p-2 text-center"><i>Listening to customized needs and Customization is our Motto !</i></h5>
</div>
<div class="container py-4">
    <div class="row">
        
        <div class="col-lg-6">

            <form class="banner p-4" style="border:1px dashed #2A3695 ; background:#fbf7f7" action="mail-enquery.php" method="post">
                <div class="form-row d-flex gap-2">
                     <div style="display:none;">
                                    <label for="honeypot">Leave this field blank:</label>
                                    <input type="text" name="hidden_input" />
                                </div>
                    <div class="form-group col-md-6 frm ">
                        <label for="inputName">FullName</label>
                        <input type="text" class="form-control" id="name"
                            placeholder="FullName" required name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="text" class="form-control" id="email"
                            placeholder="Email" required name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhone">Phone</label>
                    <input type="text" class="form-control" id="inputPhone"
                        placeholder="Phone" required name="phone">
                </div>

                <div class="form-row d-flex py-2 gap-2">
                    <div class="form-group col-md-6 frm">
                        <label for="inputCity">Company</label>
                        <input type="text" class="form-control" id="inputCompany" placeholder="Company" required name="company">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">State</label>
                        <input type="text" class="form-control" id="inputState" placeholder="State" required name="state">
                    </div>
                </div>

                <div class="form-group">
                    <label for="Message">Message</label>
                    <textarea class="form-control" id="Message" rows="3"
                        placeholder="Type Here..."  name="msg"></textarea>
                </div>
                <div class="mt-3">
                    <div class="g-recaptcha" data-sitekey="<?php echo htmlspecialchars(RECAPTCHA_SITE_KEY); ?>"></div>
                </div>
                
                <button type="submit" name="submit" class="frm-btn mt-4">Submit</button>
            </form>
        </div>
        <div class="col-lg-6 banner py-2">
        <iframe src="<?= $print['googlemap']?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
</div>
<div class="container p-2 align-items-center">
    <div class="row justify-content-center g-2">

        <div class="col-lg-6 c-grp d-flex ">
            <div>
                <h5><span><i class="fa-solid fa-location-dot" style="margin-right:8px;"></i></span>Address 1</h5>
                <p>
                <?= $print['address1']?>
                </p>
            </div>

        </div>

        <div class="col-lg-6 " width="100%">
            <div class="c-grp d-flex">

                <div>
                    <h5><span><i class="fa-solid fa-envelope" style="margin-right:8px;"></i></span>Email</h5>
                    <p><?= $print['email2']?><?= $print['email1']?></p>
                </div>

            </div>

            <div class="c-grp d-flex mt-2">

                <div>
                    <h5><span><i class="fa-solid fa-envelope" style="margin-right:8px;"></i></span>Phone</h5>
                    <p><?= $print['phone1']?>/<?= $print['phone2']?><?= $print['phone3']?></p>
                </div>

            </div>

        </div>

        <!--<div class="col-lg-3 c-grp d-flex">-->
        <!--    <div>-->
        <!--        <h5><span><i class="fa-solid fa-location-dot"></i></span>Address 2</h5>-->
        <!--        <p><?= $print['address2']?></p>-->
        <!--    </div>-->

        <!--</div>-->

    </div>
</div>




<div>
    <h4 class="text-center mt-4">Get In Touch With Us Now!</h4>
</div>
</div>

<?php
                    }
                    ?>


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
