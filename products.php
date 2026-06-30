<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Products | SKN Industries</title>
 <meta name="description" content="Explore our wide range of products, including corrugated boxes, wooden pallets, packing films, and more, tailored to meet your industrial needs" />
  <meta name="Keyword" content="Corrugated Boxes,Corrugated Boxes Manufacturers,Wooden Pallets Manufacturers,Wooden Pallets" />
  <link rel="icon" type="image/x-icon" href="assets/imgs/logos/fav.png">
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
        <link rel="canonical" href="https://www.sknindustries.com/products"/>

    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'includes/header.php' ?>

    <div class="py-0">
        <div class="row g-0">
            <img src="assets/imgs/banners/2 (2).png" alt="Skn industries" width="100%">
        </div>
    </div>

    <div class="all-products">

        <div class="py-4">
            <h1 class="blue text-center fw-bold text-uppercase">Our Best Products</h1>
            <h6 class="text-center grey"><i>Streamline your operations with our advanced packaging solutions. Unlock
                    efficiency, productivity, and growth potential with our innovative products</i></h6>
        </div>

        <div class="container">
            <div class="row">

            <?php
include "./admin/config/connection.php";
$sql = "SELECT * FROM pro_categories";
$result = mysqli_query($con, $sql);
$category_count = 0; 

while ($row = mysqli_fetch_array($result)) {
    $cat_name = $row['cat_name'];
    $new_category = str_replace('-', ' ', $cat_name);
    $cat_url = str_replace(' ', '-', $cat_name);
    $cat_id = $row['catid'];
    $cat_url1 = $row['cat_url'];
    $image = $row['image'];
    $cat_slug = ltrim((string)$row['slug_url'], '/');

    // Limit category description to 100 characters
    $category_description = isset($row['description']) ? $row['description'] : 'No description available.';
    $short_description = strlen($category_description) > 300 ? substr($category_description, 0, 300) . '...' : $category_description;
?>
    <div class="py-2 my-2 box-shadow">
        <div class="p-card container">
            <div class="row">
                <!-- Category Image Section -->
                <div class="col-lg-3">
                    <img src="./admin/product/<?php echo $image; ?>" alt="Skn industries" width="100%" class="hover">
                </div>

                <!-- Category Details -->
                <!-- Category Details -->
<div class="col-lg-9 d-flex flex-column">
    <h5><?php echo $cat_url1; ?></h5>
    <p><?php echo $short_description; ?></p>

    <!-- Product Listing -->
    <div class="container">
        <div class="row">
            <?php
            $sql1 = "SELECT * FROM product WHERE catid = $cat_id";
            $result1 = mysqli_query($con, $sql1);
            while ($row1 = mysqli_fetch_array($result1)) {
                $product_name = $row1['product_name'];
                $product_url  = $row1['product_url'];
                $product_slug = ltrim((string)$row1['slug_url'], '/');
            ?>
                <a href="product-details-<?php echo htmlspecialchars($product_slug); ?>" 
                   style="color:#000" class="col-6">
                    <li class="fw-bold"><?php echo $product_url; ?></li>
                </a>
            <?php } ?>
        </div>
    </div>

    <!-- View Products Button -->
    <a href="categories-details-<?php echo htmlspecialchars($cat_slug); ?>" style="text-decoration:none">
        <button class="frm-btn">View Products</button>
    </a>
</div>
            </div>
        </div>
    </div>
<?php
    $category_count++;
}
?>

              
                


<!-- 
                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/7xm.xyz410076.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Wooden Pallets</h5>
                                <p>Wooden pallets are flat wooden structures that serve as the foundation for storing
                                    and moving products. To transport goods securely from one place to another, they are
                                    frequently used in the production, shipping, and warehousing sectors of the economy.
                                </p>
                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="plywoodPallet.php" style="color:#000" class="col-6">
                                                <li><b>Plywood Pallets</b></li>
                                            </a>
                                            <a href="pinewoodPallet.php" style="color:#000" class="col-6">
                                                <li><b>Pinewood Pallets</b></li>
                                            </a>
                                            <a href="E-pallet.php" style="color:#000" class="col-6">
                                                <li><b>Eucalyptus Pallets</b></li>
                                            </a>
                                        </div>

                                    </ul>
                                </div>
<a href="pp-woodenpallets.php" style="text-decoration:none">
<button class="frm-btn">View Products</button>
</a>
                               
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/7xm.xyz178100.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Wooden Packaging Boxes</h5>
                                <p>Wooden packaging boxes are ideal for food and beverage packaging, grocery, telecom,
                                    dairy, automobile, chemical, and building industries. Local businesses can produce
                                    and fix the containers. Wooden packaging boxes can be reused and, in case they are
                                    damaged, they can be easily repaired as well.</p>
                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="cfb-Box.php" style="color:#000" class="col-6">
                                                <li><b>Custimized CFB Box</b></li>
                                            </a>
                                            <a href="plywoodBox.php" style="color:#000" class="col-6">
                                                <li><b>Plywood Boxes</b></li>
                                            </a>
                                            <a href="pinewoodBox.php" style="color:#000" class="col-6">
                                                <li><b>Pinewood Boxes</b></li>
                                            </a>
                                            <a href="e-s-boxes.php" style="color:#000" class="col-6">
                                                <li><b>Eucalyptus Storage Boxes</b></li>
                                            </a>
                                            <a href="e-boxes.php" style="color:#000" class="col-6">
                                                <li><b>Ecuplatus Wood Box</b></li>
                                            </a>
                                            <a href="jumbo-box.php" style="color:#000" class="col-6">
                                                <li><b>Jumbo Packaging Box</b></li>
                                            </a>
                                        </div>
                                    </ul>
                                </div>
<a href="pp-woodenboxes.php" style="text-decoration:none">

<button class="frm-btn">View Products</button>
</a>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/Container-Packaging-Services.webp" alt="Container Packaging Services" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Packaging Services</h5>
                                <p>Packaging services consider the design, development, production, and delivery of
                                    product packaging solutions. They must protect the product from harm both during
                                    transportation from the manufacturing plant to the retailer and while it is on the
                                    shelf.</p>
                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="on-site.php" style="color:#000" class="col-6">
                                                <li><b>On-Site Containers</b></li>
                                            </a>
                                            <a href="container-pkg.php" style="color:#000" class="col-6">
                                                <li><b>Container Packaging Services</b></li>
                                            </a>
                                        </div>
                                    </ul>
                                </div>
<a href="pp-packgservices.php" style="text-decoration: none;">

    <button class="frm-btn">View Products</button>
</a>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/angle.jpg" alt="Angle" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Angle Edge Protector</h5>
                                <p>An angle edge protector is a packaging material designed to protect the corners and
                                    edges of items during shipping or storage. Made from materials like cardboard,
                                    plastic, or foam, it prevents damage by distributing pressure and providing
                                    cushioning, especially for fragile or heavy goods. It’s commonly used in conjunction
                                    with strapping or shrink wrap for added security.</p>
<a href="angle.php" style="text-decoration: none;">

    <button class="frm-btn">View Products</button>
</a>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/7xm.xyz591596.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>PET Strapping</h5>
                                <p>SKN Pet Strap is very good quality strap and available in different sizes from 09mm
                                    to 25mm. We always suggest the strap to the customers according to the application
                                    and trials.</p>

                                    <a href="pet-strap.php" style="text-decoration: none;">
                                        <button class="frm-btn">View Products</button>
                                    </a>
                                
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/7xm.xyz206186.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Stretch Wrapping</h5>
                                <p>We have the best quality of our wrappers andstretch films that ensure the best
                                    possible package security and durability.
                                    Stretch wrapping is a packaging method where a highly stretchable plastic film,
                                    typically made of polyethylene, is wrapped tightly around items or pallets. The
                                    film's elasticity secures and stabilizes the load, protecting it from dust,
                                    moisture, and damage during shipping or storage. It's commonly used in logistics and
                                    warehousing for bundling and securing goods.
                                </p>
<a href="stretch-wrap.php" style="text-decoration: none;">
    <button class="frm-btn">View Products</button>
</a>
                             
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/pp strap.jpg" alt="pp strap" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>PolyPropylene (PP) Strap</h5>
                                <p>PP (Polypropylene) strap is a lightweight, durable, and flexible plastic strapping
                                    used for securing packages, pallets, and bundles. It’s ideal for light to medium
                                    loads, resistant to moisture, and cost-effective, making it widely used in shipping,
                                    logistics, and packaging industries.</p>

                                    <a href="PP-straps.php">
                                        <button class="frm-btn">View Products</button>
                                    </a>
                              
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/ind tapes.jpg" alt="Tapes" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Industrial Tapes</h5>
                                <p>Industrial tapes are strong adhesive tapes used in various industries for bonding,
                                    sealing, masking, or insulating. They come in different types, like duct tape,
                                    masking tape, and electrical tape, and are made from materials like cloth, plastic,
                                    or metal. Industrial tapes are designed to withstand harsh conditions such as high
                                    temperatures, moisture, and heavy-duty use.</p>

                                    <a href="ind-straps.php">
                                        <button class="frm-btn">View Products</button>
                                    </a>
                           
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/7xm.xyz680952.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Shrink Wrapping</h5>
                                <p>Shrink wrapping is a packaging technique where a plastic film, such as PVC or
                                    polyethylene, is wrapped around an item and then heated to shrink tightly around it.
                                </p>
                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="PVCsf.php" style="color:#000" class="col-6">
                                                <li><b>PVC Shrink Film</b></li>
                                            </a>
                                            <a href="LDsf.php" style="color:#000" class="col-6">
                                                <li><b>LD Shrink Film</b></li>
                                            </a>
                                            <a href="POFsf.php" style="color:#000" class="col-6">
                                                <li><b>POF Shrink Film</b></li>
                                            </a>
                                        </div>

                                    </ul>
                                </div>
<a href="pp-shrinkwrap.php" style="text-decoration: none;">
    <button class="frm-btn">View Products</button>
</a>
                               
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/pet strap tool.jpg" alt="pet strap tool" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Strapping Tools</h5>
                                <p>Strapping tools are frequently employed in sectors like building, warehousing, and
                                    logistics. These are used to tighten or secure straps around items for shipping,
                                    packaging, and other related uses. Strapping tools are used most frequently for hand
                                    strapping include cutters, tensioners, and sealers.</p>
                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="strap-tool-2.php" style="color:#000" class="col-6">
                                                <li><b>Pneumatic PET Strapping Tool</b>
                                                </li>
                                            </a>
                                            <a href="strap-tool-1.php" style="color:#000" class="col-6">
                                                <li><b>Compressed Strap Air Tools</b></li>
                                            </a>
                                        </div>
                                    </ul>
                                </div>
<a href="pp-straptools.php" style="text-decoration: none;">
    <button class="frm-btn">View Products</button>
</a>
                               
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/pckg.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Packaging Consumables</h5>
                                <p>Packaging consumables are items used in the packaging of commodities or products.
                                    These supplies, which can include things like boxes, tape, shrink wrap, bubble wrap,
                                    packing peanuts, labels, and more, are usually used to safeguard, store, or
                                    transport items.

                                </p>
                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="angleboard.php" style="color:#000" class="col-6">
                                                <li><b>Angle Board</b>
                                                </li>
                                            </a>
                                            <a href="angleedgeboard.php" style="color:#000" class="col-6">
                                                <li><b>Angle Edge Board</b></li>
                                            </a>
                                            <a href="EPEroll.php" style="color:#000" class="col-6">
                                                <li><b>EPE Foam Roll</b></li>
                                            </a>
                                            <a href="dunnage.php" style="color:#000" class="col-6">
                                                <li><b>Dunnage Air Bags</b></li>
                                            </a>
                                        </div>
                                    </ul>
                                </div>
<a href="pp-packgconsumables.php" style="text-decoration: none;">
    <button class="frm-btn">View Products</button>
</a>
                               
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/products/Vehicle-Lashing-Services.webp" alt="Vehicle Lashing Services" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Vehicle Lashing</h5>
                                <p>Vehicle lashing services are the procedure of securing vehicles onto a trailer or
                                    carrier for transportation. Straps, chains, winches, and ratchets are frequently
                                    used tools in vehicle lashing services. These are used to secure the vehicle to the
                                    trailer and stop it from shifting.</p>

                                    <a href="vehicle lashing.php" style="text-decoration:none">
                                        <button class="frm-btn">View Products</button>
                                    </a>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="py-2 my-2 box-shadow">
                    <div class="p-card container">
                        <div class="row">

                            <div class="col-lg-3">
                                <img src="assets/imgs/product2/download.jpg" alt="Skn industries" width="100%" class="hover">
                            </div>
                            <div class="col-lg-9">
                                <h5>Packaging Tapes</h5>
                                <p>BOPP (Biaxially Oriented Polypropylene) tapes are widely used adhesive tapes made
                                    from a durable plastic film with a water-based or acrylic adhesive. The biaxial
                                    orientation process improves the tape’s strength, making it resistant to tearing,
                                    stretching, and moisture. BOPP tapes are commonly used in packaging for sealing
                                    cartons, boxes, and other materials. They offer strong adhesion, clarity, and
                                    durability, making them suitable for both manual and machine applications in
                                    industries such as shipping, logistics, and retail. The tapes are also customizable
                                    in terms of color, width, and branding.</p>

                                <div>
                                    <ul class="container">
                                        <div class="row">
                                            <a href="Tape-1.php" style="color:#000" class="col-6">
                                                <li><b>Transparent Bopp Tape</b>
                                                </li>
                                            </a>
                                            <a href="BTape-2.php" style="color:#000" class="col-6">
                                                <li><b>Brown Bopp Tape</b></li>
                                            </a>
                                        </div>
                                    </ul>
                                </div>
                                <a href="pp-bopptapes.php" style="text-decoration:none">
                                    <button class="frm-btn">View Products</button>
                                </a>

                            </div>


                        </div>


                    </div>
                </div> -->

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
