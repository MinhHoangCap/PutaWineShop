<?php
/*
 Template Name: Liên kết khuyến mãi
 */
?>
<?php get_header(); ?>
<main>
    <?php
    include("part-page_banner.php");
    ?>
    <div class='link_promotion'>
        <?php
            get_sidebar();
        ?>
        <div class="content">
            <?php 
                $query = new WP_Query(array(
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => 'lien-ket-khuyen-mai',
                        ),
                    ),
                )
            );
                if ( $query->have_posts() ) {

                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $post_id = get_the_ID() ;
                        ?>
                        <div class="post__element">
								<div class="post__img"><?php echo get_the_post_thumbnail($post_id);?></div>
								<div class="wrapper">
									<div class="post__heading"><?php echo get_the_title( $post_id )?></div>
									<div class="post__content"><?php echo get_the_content();?></div>
									<a class="post__link" href='<?php echo get_the_permalink($post_id)?>'>Xem thêm</a>
								</div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>