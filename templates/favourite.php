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
        echo "<table class='favourite_list'>";
        foreach($cart as $elementid ){
            $post =get_post($elementid);
            $title = $post->post_title;
            $price = get_field('price',$elementid);
            $price_sale = get_field('price_sale',$elementid);
            $photo = get_the_post_thumbnail_url($elementid);
            $category = get_the_terms($elementid,'product_cat');
            // print_r(->name);
            ?>
            <tr class='product_element' product_id='<?php echo $elementid?>'>
                <td class='cart_product_delete'>
                    <div class='loader'></div>
                    <button id=<?php echo $elementid?> type='button' class='favourite_delete'>X</button>
                </td>
                <td class='cart_product_img'><img  src='<?php echo $photo?>' ></td>
                <td class='cart_product_info'>
                    <div class = 'cart_product_name'><?php echo $title ?></div>
                    <div class = 'cart_product_category'> Loại: 
                    <?php    foreach($category as $cat){
                            echo $cat->name;
                        }
                    ?>
                    </div>
                </td>
                <td class='unit_price' unit_price='<?php echo $price?>' ><?php echo currency_format($price)?></td>
                <td class='cart_product_buy_btn'><div class='buy__favourite_btn'>Mua</div></td>
            </tr>
            <?php } ?>
        </table>
    <?php } 
        
    else{?>
        <div class='message'>Không có mặt hàng trong danh sách yêu thích</div>
    <?php }
?>

<?php get_footer(); ?>