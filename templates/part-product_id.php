<?php
    
    function get_product_by_id($id){
        $posts = new WP_Query(array(
            'post_type' => 'product',
            'post-status' => 'publish',
            'orderby' => 'ID',
            'order' => 'ASC',

            'tax_query' => array(
                array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $id,
                
                ),
            ),
            
        ));

        $term_name = get_term( $id )->name;
        echo "<h2 class='taxonomy__title'>".$term_name."</h2>";
        if($posts->have_posts()){
         
            echo "<ul class='taxonomy__list'>";
            while ($posts->have_posts()){
                $post = $posts->the_post();
                $post_id = get_the_ID();
                product($post_id);

            }
            echo '</ul>';
        } else{
            esc_html_e('Sorry, no posts matched you query');
        }
        wp_reset_postdata();
    }

?>