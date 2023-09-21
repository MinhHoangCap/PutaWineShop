<?php
    
    function get_product_sidebar($name){
        $posts = new WP_Query(array(
            'post_type' => 'product',
            'post-status' => 'publish',
            'orderby' => 'ID',
            'order' => 'ASC',
            'showposts' => 3,
            'tax_query' => array(
                array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $name,
                ),
            ),
            
        ));
        
        if($posts->have_posts()){
            $term_name = get_term_by('slug', $name, 'product' );
            echo "<ul class='category'>";
            while ($posts->have_posts()){
                $post = $posts->the_post();
                $post;
                $gia=get_field("gia");
                $donvi= get_field("currency");
                $img_link = get_the_post_thumbnail() ;
                echo "<li class='category__element'>" ;
                
                echo "<div class='product__img'>".$img_link."</div>";  
                echo "<div class='wrapper'>";
                    echo "<p class='product__name'>".get_the_title()."</p>";
                    echo "<div class='product__prices'>";
                        echo "<p class='product__price'>".($gia.$donvi)."</p>";
                        echo "<p class='product__price--sale'>".(($gia - 50).$donvi)."</p>";
                    echo "</div>";
                
                    echo "<button class='buy__btn'>THÊM VÀO GIỎ HÀNG</button>";
                echo "</div>";
                
                echo '</li>';
            }
            echo '</ul>';
        } else{
            esc_html_e('Sorry, no posts matched you query');
        }
        wp_reset_postdata();
    }

?>