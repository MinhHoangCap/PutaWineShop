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
        <table class='cart_list'>
            <tr>

                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá tiền</th>


            </tr>";

		
        foreach($cart as $elementid ){

            $post =get_post($elementid);
            $title = $post->post_title;
            $price = get_field('gia',$elementid);
            $photo = get_the_post_thumbnail_url($elementid);
           
           
            echo "<tr class='product_element' product_id=$elementid>

                <td class='cart_product_img'><img  src=$photo></td>
                <td class='cart_product_name'>$title</td>
                <td class='unit_price' unit_price=$price>".number_format($price,0,'.',',')."đ</td>
               

            </tr>";          
        };
        echo "</table>";
    }
        
    else{
        echo "<div class='message'>Không có mặt hàng trong danh sách yêu thích</div>";
    }
?>

<?php get_footer(); ?>