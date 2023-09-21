<button onclick="topFunction()" id="moveTopBtn" title="Go to top"><i class="fa-sharp fa-solid fa-angle-up"></i></button>
<div id="snackbar">Đã thêm vào giỏ hàng</div>
<div id="payment_alert">Đã thanh toán</div>
<div id="contact_alert"></div>
<div id="toast"></div>
<footer class="footer" style="background:url(<?php echo get_field('background_footer','options')?>) round">

        
        <div class="footer-info">
            <div class="logo"><img src="https://putademo.com/academyhoangwine/wp-content/uploads/2023/07/LOGO.png" alt=""></div>
            <div class="infomation flat">
                <div class="footer__heading">Thông tin liên hệ</div>

                <p>Địa chỉ:206/60A Đường 2/4 Vạn Thắng - TP. Nha Trang</p>
                <p>Email:<?php echo get_field("email","options")?></p>
                <p>Hotline:<?php echo get_field("hotline","options")?></p>
                <p>Online:Truy cập</p>

            </div>
            <div class="infomation">
                <div class="footer__heading">Thông tin chung</div>
                <a class="footer__link" href = <?php echo get_site_url()?>><i class="fa-solid fa-caret-right"></i> Trang chủ</a>
                
                <a class="footer__link" href = <?php echo get_site_url()."/about-us"?>><i class="fa-solid fa-caret-right"></i> Giới thiệu</a>
                
                <a class="footer__link" href = <?php echo get_site_url()."/product_cat/ruou/"?>><i class="fa-solid fa-caret-right"></i> Sản phẩm</a>
                
                <a class="footer__link" href = <?php echo get_site_url()."/product_cat/dung-cu-va-qua-tang/"?>><i class="fa-solid fa-caret-right"></i> Dụng cụ quà tặng</a>
                
            </div>
            <div class="infomation">
                <div class="footer__heading">Thông tin chung</div>

                <a class="footer__link" href = <?php echo get_site_url()."/product_cat/thuc-pham"?>><i class="fa-solid fa-caret-right"></i> Thực phẩm</a>
             
     
                <a class="footer__link" href = <?php echo get_site_url()."/lien-ket-va-khuyen-mai"?>><i class="fa-solid fa-caret-right"></i> Liên kết</a>
             
                  
                <a class="footer__link" href = <?php ?>><i class="fa-solid fa-caret-right"></i> Blog - Tin tức</a>
                          
                <a class="footer__link" href = <?php echo get_site_url()."/lien-he"?>><i class="fa-solid fa-caret-right"></i> Liên hệ</a>
                 
            </div>
        </div>
        <div class="copy-right">&copy 2021 Vạn Tín Wine Shop. All Rights Reserved Designed by PutaDesign.</div>
   
</footer>
</body>

</html>