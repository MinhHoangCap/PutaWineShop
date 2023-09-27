<?php
/*
 Template Name: Danh sách yêu thích
 */
?>
<?php get_header(); ?>
<?php include("part-page_banner.php")?>
<?php 


    if(isset($_COOKIE['favourite_cart']))
    {
		$cart = json_decode(str_replace('\\', '', $_COOKIE['favourite_cart']));
        echo "
        <table class='favourite_list'>
        
            ";

		
        foreach($cart as $elementid ){

            $post =get_post($elementid);
            $title = $post->post_title;
            $price = get_field('price',$elementid);
            $photo = get_the_post_thumbnail_url($elementid);
            $category = get_the_terms($elementid,'product_cat');
            // print_r(->name);
            $string = "<tr class='product_element' product_id=$elementid>
                
                <td class='cart_product_img'><img  src=$photo></td>
                <td class='cart_product_info'>
                    <div class = 'cart_product_name'>$title</div>
                    <div class = 'cart_product_category'> Loại: ";
                        foreach($category as $cat){
                            $string.=$cat->name;
                        }
                    $string.= "</div>
                </td>
                <td class='unit_price' unit_price=$price>".currency_format($price)."</td>
                <td class='cart_product_buy_btn'><div class='buy__favourite_btn'>Mua</div></td>
               

            </tr>";
            echo $string;        
        };
        echo "</table>";
    }
        
    else{
        echo "<div class='message'>Không có mặt hàng trong danh sách yêu thích</div>";
    }
?>

<?php get_footer(); ?>