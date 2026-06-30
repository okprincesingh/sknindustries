<!-- Modal -->
<?php require_once __DIR__ . '/recaptcha-config.php'; ?>
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
foreach (array_slice($images222, 0, 1) as $index => $image1) {
?>
    <div style="margin-bottom:12px; text-align:center;">
        <img src="../product/images/<?php echo htmlspecialchars($image1[0]); ?>" 
             alt="product" width="100%" 
             style="max-height:200px; object-fit:contain; border-radius:6px;">
    </div>
<?php
}
?>

                        <div style="margin-bottom:12px !important;">
                        <label style="font-weight:600;">Product Name</label>
                        <input type="text" class="form-control" placeholder="Enter Your Phone"
                            name="product" required value="<?php echo "$product_url" ?>">
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
                        <div id="product-enquiry-recaptcha"></div>
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
    window.productEnquiryRecaptchaWidgetId = null;
    window.onProductEnquiryRecaptchaLoad = function () {
        var modalOpen = window.jQuery && jQuery('#exampleModalCenter').hasClass('show');
        if (modalOpen && window.productEnquiryRecaptchaWidgetId === null && typeof grecaptcha !== 'undefined') {
            window.productEnquiryRecaptchaWidgetId = grecaptcha.render('product-enquiry-recaptcha', {
                sitekey: '<?php echo htmlspecialchars(RECAPTCHA_SITE_KEY, ENT_QUOTES); ?>'
            });
        }
    };

    if (window.jQuery) {
        jQuery(function ($) {
            $('#exampleModalCenter').on('shown.bs.modal', function () {
                if (typeof grecaptcha === 'undefined') {
                    return;
                }
                if (window.productEnquiryRecaptchaWidgetId === null) {
                    window.productEnquiryRecaptchaWidgetId = grecaptcha.render('product-enquiry-recaptcha', {
                        sitekey: '<?php echo htmlspecialchars(RECAPTCHA_SITE_KEY, ENT_QUOTES); ?>'
                    });
                } else {
                    grecaptcha.reset(window.productEnquiryRecaptchaWidgetId);
                }
            });
        });
    }
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onProductEnquiryRecaptchaLoad&render=explicit" async defer></script>
