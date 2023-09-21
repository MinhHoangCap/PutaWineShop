<?php get_header(); ?>
<section>
    
    <!-- <?php include("templates/part-product_taxonomy.php")?> -->
    <?php
    include("templates/part-page_banner.php");
    get_product_by_taxonomy(get_queried_object()->slug);
    ?>
    <?php ?>
</section>
<?php get_footer(); ?>