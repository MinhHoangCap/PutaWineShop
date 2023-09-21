<?php
/*
 Template Name: Giới thiệu
 Version: 1.0.1
 */
?>
<?php get_header(); ?>
<main>
    <?php include("part-page_banner.php")?>
    <?php include("part-about_us.php")?>
    <?php include("part-feedback.php")?>
    <?php include("part-logos.php")?>
    <div class="google-map">
        <?php include("part-google_map.php") ?>
    </div>
</main>
<script>

document.addEventListener( 'DOMContentLoaded', function() {
    var splide = new Splide( '.splide' );
    splide.mount();
} );
</script>
<?php get_footer(); ?>
