<?php 
get_header(); 
setpostview(get_the_id());
?>
<main>
	<?php include("templates/part-page_banner.php")?>
    <div class="container-all container">
        <article>
            <div class="link_promotion">
                <!-- <aside> -->
                    <?php get_sidebar();
                    ?>
                <!-- </aside> -->
                <div class="content">
                    <p class="link_post__title">
                        <?php echo get_the_title()?>
                    </p>
                    <p>
                        <?php 
                        $content = apply_filters('the_content', get_the_content());
                        echo $content ; ?>
                    </p>
                </div>
                
            </div>
        </article>
    </div>
</main>
<?php get_footer(); ?>