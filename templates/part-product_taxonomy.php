<?php
    function get_product_by_taxonomy($slug){
        $posts = new WP_Query(array(
            'post_type' => 'product',
            'post-status' => 'publish',
            'orderby' => 'ID',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $slug,
                ),
            ),
            
        ));
        if($posts->have_posts()){
         
            echo "<ul class='product__list'>";
            while ($posts->have_posts()){
                $id = get_the_id();
                $post = $posts->the_post();
                $post;
                product($id);
            }
            echo '</ul>';
        } else{
            esc_html_e('Sorry, no posts matched you query');
        }
        wp_reset_postdata();
    }

?>
