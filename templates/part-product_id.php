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
                $gia=get_field("price");
                $donvi= get_field("currency");
                $img_link = get_the_post_thumbnail() ;
                $post_link = get_permalink(); 
                $type = get_term(wp_get_post_categories( $post_id )[0])->slug;
				if(isset($_COOKIE['favourite_cart'])) 
                    {
                        $cart = json_decode(str_replace('\\', '', $_COOKIE['favourite_cart']));
                    } 
                    else {
                        $cart = array();
                    }
                    (in_array($post_id,$cart))? $string = " fa-solid in-favourite" : $string = " fa-regular ";
                echo "<a href='$post_link'>";
                    echo "<li class='product__element'>" ;
                
                    echo "<div class='product__img'>".$img_link."
							<button id=$post_id class='like__btn' ><i class='fa-heart".$string."'></i></button>
						</div>";  
                    echo "<p class='product__name'>".get_the_title()."</p>";
                    echo "<div class='product__prices'>";
                        echo "<p class='product__price'>".(number_format($gia,0,'.',',').$donvi)."</p>";
                        echo "<p class='product__price--sale'>".(number_format($gia -50,0,'.',',').$donvi)."</p>";
                    echo "</div>";
                    echo "<button id=$post_id producttype=$type class='buy__btn'>THÊM VÀO GIỎ HÀNG</button>";
//                     echo "";
                    echo '</li>';
                echo '</a>';
            }
            echo '</ul>';
        } else{
            esc_html_e('Sorry, no posts matched you query');
        }
        wp_reset_postdata();
    }

?>