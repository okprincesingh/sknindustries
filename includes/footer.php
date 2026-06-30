<footer class="footer p-4">
        <div class="container-fluid">
                <div class="row">
                        <div class="col-md-4">
                                <img src="assets/imgs/logos/LOGO-SKN-T.png" alt="" srcset="" width="60%">
                                <p>SKN Industries is one of the leading manufacturers of corrugated boxes, shippers, and
                                        heavy-duty corrugation. We specialize in customized boxes with innovative
                                        solutions, wooden boxes, pallets, crates, and all types of packing films. Our
                                        products include LD bags, high-quality HDPE bags, films, PP straps, PET straps,
                                        angle and edge protectors, and all types of lashing straps. We also provide
                                        container stuffing products, rust preventive products (VCI), and a comprehensive
                                        range of packaging tools, including strapping and wrapping tools. Additionally,
                                        we offer reliable online packaging solutions designed to meet diverse industrial
                                        needs efficiently. </p>
                        </div>
                        <div class="col-md-2">
                                <h5>Quick Navigation</h5>
                                <ul class="p-0">
                                        <li><a href="https://sknindustries.com">
                                                        Home</a></li>
                                        <li><a href="about">
                                                        About</a></li>
                                        <li><a href="products">
                                                        Products</a></li>
                                        <li><a href="contact">
                                                        Contact</a></li>
                                        <li><a href="blogs">
                                                        Blogs</a></li>
                                        <li><a href="admin/login.php" target="_blank">
                                                        Admin Login</a></li>
                                        <li><a href="assets/imgs/catalogue/SKN Brochure new 2024 new (1).pdf">
                                                        Catalogue</a></li>
                                </ul>
                        </div>
                        <div class="col-md-3">
                                <h5>Our Products</h5>
                                <ul class="p-0">
                                <?php
                                  include "./admin/config/connection.php";
$sql = "SELECT * from pro_categories";
$result2 = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result2)) {
    $cat_name = $row['cat_name'];                          // Get category name
    $new_category = str_replace('-', ' ', $cat_name);       // Format category name for display
    $slug_url1 = $row['slug_url'];                           // Get the category's slug URL
    // Get the first subcategory for the current category
    $cat_slug = ltrim((string)$slug_url1, '/');
    echo " <li><a href='categories-details-" . htmlspecialchars($cat_slug) . "'>$new_category</a></li>";
}
?>
</ul>
</div>
<div class="col-md-3">
<h5>Contact</h5>


<?php
                    include "./admin/config/connection.php";

                    $select3 ="SELECT * FROM contact_details";

                    $row3 = mysqli_query($con, $select3);
                    
                    while($print = mysqli_fetch_assoc($row3)){
                ?>
<ul class="p-0">
<li>
  <span><i class="fa-solid fa-location-dot"></i></span>
  <a href="https://share.google/qcc0dyB22TU9GbyZq" target="_blank">
    <?= $print['address1'] ?>
  </a>
</li>
<br>
<li>
  <span><i class="fa-solid fa-phone"></i></span>

  <a href="tel:<?= $print['phone1'] ?>"><?= $print['phone1'] ?></a>  <a href="tel:<?= $print['phone2'] ?>"><?= $print['phone2'] ?></a><br>
  <a href="tel:<?= $print['phone3'] ?>"><?= $print['phone3'] ?></a>
</li>

                         <br>


<li>
  <a href="mailto:sknsales2@gmail.com" 
     onclick="handleEmailClick(event)" 
     style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: inherit;">
     
    <i class="fa-solid fa-envelope" style="pointer-events: none;"></i>
    <span>sknsales2@gmail.com</span>
  </a>
</li>

<script>
function handleEmailClick(e) {
    var email = "sknsales2@gmail.com";
    var isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

    if (!isMobile) {
        // Desktop → Open Gmail Web
        e.preventDefault();
        window.open(
          "https://mail.google.com/mail/?view=cm&fs=1&to=" + email,
          "_blank"
        );
    }
    // Mobile → Default mail app via mailto works automatically
}
</script>





                                </ul>

<?php
}?>

                        </div>


                </div>
        </div>

        <!-- footer band-->


</footer>

<div class=" container-fluid footer-end">
        <div class="row">
                <div class="col-lg-7">
                        <p class="justify-content-start"> &#169;
                                <?php echo Date('Y') ?> All Rights Reserved
                                SKN Industries
                        </p>
                </div>
                <div class="col-lg-5">
                        <p class="justify-content-end pr-0">
                                Designed & Developed By
                                <a href="https://www.jaikviktechnology.com/" target="_victor">Jaikvik Technology India
                                        Pvt Ltd</a>
                        </p>
                </div>
        </div>
</div>
<style>
.openModalBtn {
  padding: 12px;
  font-size: 18px;
  cursor: pointer;
  position: fixed;
  right: -55px;
  bottom: 300px;
  rotate: 90deg;
  z-index: 99;
  background-color: #2F3B97;
  color: #fff !important;
  border: none;
  outline: none;
  border-radius: 0 0 15px 15px;
  -webkit-border-radius: 0 0 15px 15px;
  -moz-border-radius: 0 0 15px 15px;
  -ms-border-radius: 0 0 15px 15px;
  -o-border-radius: 0 0 15px 15px;
  text-decoration: none;
  font-family: Arial, sans-serif;
}

.openModalBtn:hover {
  background-color: #2F3B97;
  color: #fff !important;
}

.openModalBtn i {
  margin-left: 8px;
  transform: rotate(-90deg);
}
</style>

<a href="contact" class="openModalBtn">
  Enquiry Now <i class="fa-solid fa-paper-plane"></i>
</a>

	<style>
/* Wrapper */
.contact-wrapper{
    position:fixed;
    bottom:25px;
    right:25px;
    z-index:9999;
}

/* ========== MAIN BUTTON ========== */

.main-btn{
    width:62px;
    height:62px;
    border-radius:50%;
    background:#111827; /* Universal professional color */
    position:relative;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 12px 30px rgba(0,0,0,0.25);
    transition:all 0.3s ease;
}

.main-btn:hover{
    transform:scale(1.07);
    background:#000;
}

/* Center Icon */
.main-btn i{
    font-size:22px;
    color:#fff;
}

/* ========== CONTACT ICONS ========== */

.contact-icons{
    position:absolute;
    bottom:85px;
    right:6px;
    display:flex;
    flex-direction:column;
    gap:14px;
    opacity:0;
    visibility:hidden;
    transform:translateY(10px);
    transition:all 0.3s ease;
}

.contact-wrapper.active .contact-icons{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

.contact-icons a{
    width:50px;
    height:50px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    color:#fff;
    text-decoration:none;
    box-shadow:0 8px 22px rgba(0,0,0,0.2);
    transition:all 0.3s ease;
}

.contact-icons a:hover{
    transform:translateY(-4px) scale(1.05);
}

/* Professional Brand Colors */
.whatsapp{ background:#25D366; }
.call{ background:#2563eb; }
.mail{ background:#dc2626; }

</style>
<div class="contact-wrapper" id="contactWrapper">

    <!-- Expanding Icons -->
    <div class="contact-icons">
        <a href="https://wa.me/9990623421" target="_blank" class="whatsapp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="tel:+91 9990623421" class="call">
            <i class="fas fa-phone-alt"></i>
        </a>
        <a  href="mailto:sknsales2@gmail.com"
     onclick="handleEmailClick(event)" class="mail">
            <i class="fas fa-envelope"></i>
        </a>
    </div>

    <!-- Main Button -->
    <div class="main-btn" onclick="toggleContact()">
        <i class="fas fa-comment-dots"></i>
    </div>

</div>

<script>
function toggleContact(){
    document.getElementById("contactWrapper").classList.toggle("active");
}
</script>
<script>
function handleEmailClick(e) {
    var email = "sknsales2@gmail.com";
    var isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

    if (!isMobile) {
        // Desktop → Open Gmail Web
        e.preventDefault();
        window.open(
          "https://mail.google.com/mail/?view=cm&fs=1&to=" + email,
          "_blank"
        );
    }
    // Mobile → Default mail app via mailto works automatically
}
</script>
