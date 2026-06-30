<?php
include "./admin/config/connection.php";
?>
<script async src="https://www.googletagmanager.com/gtm.js?id=GTM-XXXX"></script>

<div>
  <div class="nav-top">
    <div class=" laptop " >
      <img src="assets/imgs/New folder/Frame 150 (1).png" alt="" width="100%">
    </div>

    <div class=" mob-nav "id="mobile" >
      <div class="row">
      <div class="col-4">
        <a href="https://sknindustries.com/">
          <img src="assets/imgs/logos/LOGO-SKN-T.png" alt="" width="100%">
        </a>
      
      </div>

      <div class="col-8 d-flex justify-content-center align-items-center">
        <div class="humBtn">
          <ul class="d-flex top-links" style="list-style: none;">
            <li> 
              <div>
                <span>
                  <a href="mailto:sknsales2@gmail.com" >
                    <img src="assets/imgs/icons/images-removebg-preview.png" alt="" class="nav-img0">
                  </a>
                </span>
              </div>
              
          </li>
            <li>
              <div>
                <span><a href="tel:+919990623421" >
                  <img src="assets/imgs/icons/phone-removebg-preview.png" alt="" class="nav-img00">
                </a></span>
              </div>
              
            </li>
            <li>
              <div>
                <span>
                 <a href="https://wa.me/919990623421">
  <img src="assets/imgs/icons/download-removebg-preview.png" alt="" class="nav-img">
</a>
                </span>
              </div>
              
            </li>
            <li>
              <div>
                <span class="menuToggle" id="toggle"><i class="fa-solid fa-bars h3"></i></span>
              </div>
              
            </li>
          </ul>
        </div>
      </div>
      </div>
     
    </div>
  </div>
</div>


<!-- desktop navbar -->
<header class="container-fluid py-3 laptop">
  <div class="row">
    <div class="col-lg-2 align-items-center center my-1">
      <a href="https://sknindustries.com/" style="text-decoration: none;">
        <img src="assets/imgs/logos/images.jpg" alt="" width="100%">
      </a>
    </div>

    <div class="col-lg-8 my-1">
      
      <!--<div class="input-box d-flex">
        <input type="text" class="form-control" placeholder="Try Our Easy Search">
        <span><i class="fa fa-search" style="color:#000"></i></span>

      </div>-->

<div>
  <h5>
  <?php
                    include "./admin/config/connection.php";

                    $select4 ="SELECT * FROM contact_details";

                    $row4 = mysqli_query($con, $select4);
                    
                    while($print = mysqli_fetch_assoc($row4)){
                ?>
    <ul class="d-flex hero-link">
      <li>
        <a href="mailto:<?= $print['email1']?>" ><?= $print['email1']?></a>
      </li>
      <li>
        <a href="mailto:<?= $print['email2']?>"><?= $print['email2']?> /</a>
      </li>
      <li>
        <a href="tel:<?= $print['phone1']?>"><?= $print['phone1']?> /</a>
      </li>
      <li>
        <a href="tel:<?= $print['phone2']?>"><?= $print['phone2']?> </a>
      </li>
      <li>
        <a href="https://wa.me/<?= $print['phone1']?>">
          <img src="assets/imgs/icons/download-removebg-preview.png" alt=""  class="nav-img1"> 
          </a>
      </li>
    </ul>
    <?php
    }
    ?>
  </h5>
 
</div>

    </div>

    <div class="col-lg-2 col-12 part2  align-items-center d-flex my-1">



      <div class=" btn-grp d-flex">


        <a href="assets/imgs/catalogue/SKN Brochure new 2024 new (1).pdf" style="text-decoration:none">
          <button type="button" class=" font-weight-bold nav-btns">

            Catalogue</button>
        </a>

      </div>

    </div>
  </div>


</header>

<!-- mobile -->
<div class="nav border ">
  <div class="container col-lg-12" height="100%">
    <div height="100vh">
      <div class="nav-link main side-open">

        <ul class="nav main">
          <div class="closebtn"><i class="fa-solid fa-xmark h2"></i></div>
          <li><a href="/">HOME</a></li>
          <li><a href="about">ABOUT US</a></li>
          <li><a href="products">ALL PRODUCTS</a></li>
          <li><a href="blogs">BLOGS</a></li>

          <li><a href="contact">CONTACT US</a></li>
        </ul>
      </div>
    </div>

  </div>
</div>


<!--

        <div class="nav-btm">
      <div class="container-fluid">
       
        <h6 style=text-align:center;margin-bottom:0>"Our MISSION is to give our customers the very best in packaging, keeping constantly in mind the
            latest developments, with that purpose, we are eagerly planning to meet the challenges of the future"
        </h6>
      </div>
    </div>

-->

</div>

<script>
  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });
</script>