<?php get_header(); ?>
<main>
    <div class="container-all container">
        <div class="row category_page--wrap">
            <div class="col-xl-9 col-lg-8">
                <div class="news_category_page--wrap">
                    <?php 
                        global $post; 
                            if (have_posts()) {
                                while (have_posts()) : the_post(); 
                                    echo get_field("vu_khi");
                                endwhile;
                            } 
                            else {
                                echo  "<p>Không có</p>";
                            }
                    base_pagination(); 
                echo "</div>";
            echo "</div>" ?>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>