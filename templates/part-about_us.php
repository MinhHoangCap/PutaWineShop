<?php 
        $aboutUsId = 502;
        $aboutUs = get_post($aboutUsId);
    ?>
<div class="about_us">
    <div class="content">
        <div class="about_us__heading"><?php echo $aboutUs->post_title?></div>
        <div class="about_us__content">

            <?php echo $aboutUs->post_content?>
        </div>
        <a class="about_us__link" href=<?php echo $aboutUs->guid?>>Tìm hiểu thêm</a>
    </div>
    <img src=<?php echo get_site_url()."/wp-content/uploads/2023/07/about_us_img.png"?> alt="">
</div>