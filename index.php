<?php
/*
 Template Name: Trang chủ
 Version: 1.0.1
 */
?>
<?php 
    get_header(); 
?>
<main>
    <?php include("templates/part-about_us.php") ?>
    <?php include("templates/part-product_id.php")?>
<?php
    $img_1 = get_field('banner1','option');
    $link_1 = get_field('banner1_link','option');
    $img_2 = wp_get_attachment_image_url(get_field('banner2','option'));
    $link_2 = get_field('banner2_link','option');
?>
<?php
    $ids = get_field('above_banner_1','option');
    foreach($ids as $id){
        get_product_by_id($id);
    }
?>
    <div class="banner">
            <img src=<?php echo $img_1?> alt="" srcset="">
            <div class="banner__content">
                <div class="wrapper">
                    <div class="banner__heading"><?php echo get_field("banner_1_heading",'options')?></div>
                    <div class="banner__subheading"><?php echo get_field("banner_1_content",'options')?></div>
                    <a class="banner__link" href = <?php echo $link_1?>>Xem thêm</a>
                </div>
            </div>
    </div>

<?php
    $id = get_field('above_banner_2','option');
    get_product_by_id($id)
?>
    <div class="banner">
        <img src=<?php echo $img_2?> alt="" srcset="">
        <div class="banner__content">
            <div class="wrapper">
                <div class="banner__heading"><?php echo get_field("banner_2_heading",'options')?></div>
                <div class="banner__subheading"><?php echo get_field("banner_2_content",'options')?></div>
                <a class="banner__link" href = "<?php echo $link_2?>">Xem thêm</a>
            </div>
        </div>
    </div>
<?php
    $posts = get_posts( 
        array(
            'post-type' =>'post',
            'numberposts' => -1,
            'posts_per_page' => 5
        ) );
    echo "<div class='wp_blog'>";
        echo " <h2 class='blog_heading'>Blog</h2>";
            echo "<div class='wrapper'>";?>
                <section class="splide blog" aria-label="Splide Basic HTML Example">
                <!-- <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            Prev
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            Next
                        </button>
                </div> -->
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php 
                        foreach($posts as $post){
                                echo "
                                <li class='splide__slide'>
                                    <a href=".get_the_permalink($post->id).">
                                        <div class='wp_blog__element'>
                                            <div class='img'>".get_the_post_thumbnail($post->ID)."</div>
                                            <div class='wrapper'>
                                                <div class='wp_blog__element--heading'>".get_the_title($post->id)."</div>
                                                <div class='wp_blog__element--content'>".get_the_excerpt($post->id)."</div>
                                                <div class='see_more_btn'>Xem thêm</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                ";
                        };?>
                    </ul>
                </div>
                </section>
            <?php echo"</div>";
            echo "<div class='wp_blog__img'><img src='http://localhost/default/wp-content/uploads/2023/09/819wzjkae1L._AC_SL1500_.jpg' alt=''></div>";
        echo"</div>";
    echo"</div>";
?>
    <?php include("templates/part-feedback.php") ?>
    <?php include("templates/part-logos.php") ?>
    <div class="google-map">
        <?php include("templates/part-google_map.php") ?>
    </div>
</main>

<?php get_footer(); ?>