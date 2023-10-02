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
                $id = get_the_ID();
                $price=get_field("price");
                $price_sale = get_field("price_sale");
                $img_link = get_the_post_thumbnail() ;
                ?>
                <li class='category__element'>
                
                <div class='product__img'><?php echo $img_link?></div>  
                <div class='wrapper'>
                    <p class='product__name'><?php echo get_the_title()?></p>
                    <div class ='product_detail__prices'>
                        <?php
                            if($price_sale != 0){
                                ?>
                                <p class='product__price sale'><?php echo currency_format($price_sale)?></p>
                                <p class='product__price'><?php echo currency_format($price)?></p>
                            <?php } else { ?>
                                <p class='product__price sale'><?php echo currency_format($price)?></p>
                            <?php } ?>
                    </div>
                
                 <?php   echo "<button id ='$id' class='buy__btn'>THÊM GIỎ HÀNG</button>";
                echo "</div>";
                ?>
                </li>
                <?php
            }
            echo '</ul>';
        } else{
            esc_html_e('Sorry, no posts matched you query');
        }
        wp_reset_postdata();
    }

?>