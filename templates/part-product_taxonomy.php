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
                $gia=get_field("gia");
                $donvi= get_field("currency");
                $img_link = get_the_post_thumbnail() ;
                $post_link = get_permalink(); 
                $type = get_term(wp_get_post_categories( $id )[0])->slug;
				 if(isset($_COOKIE['favourite_cart'])) 
                    {
                        $cart = json_decode(str_replace('\\', '', $_COOKIE['favourite_cart']));} 
                    else {$cart = array();};
                    (in_array($id,$cart))? $string = " fa-solid in-favourite" : $string = " fa-regular ";
                echo "<li class='product__element' product_id=$id >" ;
                echo "<a href='$post_link'>";
                echo "<div class='product__img'>".$img_link."
				  <button id='$id' class='like__btn' ><i class='fa-heart".$string."'></i></button>
				</div>";  
                echo "<p class='product__name'>".get_the_title()."</p>";
                echo "<div class='product__prices'>";
                        echo "<p class='product__price'>".(number_format($gia,0,'.',',').$donvi)."</p>";
                        echo "<p class='product__price--sale'>".(number_format($gia-5000,0,'.',',').$donvi)."</p>";
                    echo "</div>";
                echo '</a>';
                   
    
                    echo "<button id='$id' producttype='$type' class='buy__btn'>THÊM VÀO GIỎ HÀNG</button>";
                  
                echo '</li>';
            }
            echo '</ul>';
        } else{
            esc_html_e('Sorry, no posts matched you query');
        }
        wp_reset_postdata();
    }

?>
