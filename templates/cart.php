<?php
/*
 Template Name: Giỏ hàng
 */
get_header();
?>

<main>
    <?php include('part-page_banner.php'); 
	
// 	if(wp_is_mobile()){
		
// 		if(isset($_SESSION['cart']))
//     	{
//         echo "
//         <table class='cart_list'>
//             <tr>
//                 <th></th>
//                 <th></th>
//                 <th></th>
//             </tr>";
			
// 			 $sum =0;
//         foreach($_SESSION['cart'] as $elementid => $value ){
//             $post =get_post($elementid);
//             $title = $post->post_title;
//             $price = get_field('price',$elementid);
//             $photo = get_the_post_thumbnail_url($elementid);
//             $count = $value['count'];
//             $permalink = get_permalink($elementid);
//             $sum_product =$price * $count;
//             $sum +=  $sum_product;
			
// 			// number_format($sum_product,0,'.',',')
//             echo "<tr class='product_element' product_id=$elementid>

//                 <td class='cart_product_img'><img  src=$photo></td>
                
//                 <td class='cart_product_name'>
//                     <a href='$permalink'>
//                     $title
//                     </a>
//                 </td>
               
//                 <td>
//                     <div class='count_wrapper'>
//                         <div class='count_change_btn decrease_btn'>
//                             <i class='fa-solid fa-caret-left'></i>
//                         </div><input type='number' class='product_count' min=0 value=$count>
//                         <div class='count_change_btn increase_btn'>
//                             <i class='fa-solid fa-caret-right'></i>
//                         </div>
//                     </div>
// 				</td>
//                 <td class='unit_price' unit_price=$price>".number_format($price,0,'.',',')."đ</td>

//             </tr>";  	
			
                    
//         };
			
			
// 		echo"</table>";
		
// 		  echo "<div class='display_sum_cart'>";
//         echo "<p>Tổng tiền cần thanh toán:</p>"."<p class='sum_cart' sum_cart=$sum>".number_format($sum,0,'.',',')."</p>";
//         echo "</div>";

//         echo "
//         <div class = 'payment__field'>
//             <input type='submit' value='Thanh toán' class='update_btn'>
//         </div>";
//         echo "<div class='message'></div>";

//     }
        
//     else{
//         echo "<div class='message'>Không có mặt hàng trong giỏ hàng</div>";
//     }
// }
// 	else{
	?>
    
<form action="" method="post">
<?php 
	
	if(isset($_SESSION['cart']))
    {
        echo "
        <table class='cart_list'>
            <tr>
                <th></th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>


            </tr>";
        $sum =0;
        foreach($_SESSION['cart'] as $elementid => $value ){
            $post =get_post($elementid);
            $title = $post->post_title;
            $price = get_field('price',$elementid);
            $photo = get_the_post_thumbnail_url($elementid);
            $permalink = get_permalink($elementid);
            $count = $value['count'];
            $sum_product =$price * $count;
            $sum +=  $sum_product;
			
			// number_format($sum_product,0,'.',',')
            echo "<tr class='product_element' product_id=$elementid>
                <td><button id=$elementid type='button' class='cart_delete'>X</button></td>
                <td class='cart_product_img'><img  src=$photo></td>
                <td class='cart_product_name'>
                    <a href='$permalink'>
                        $title
                    </a>
                </td>
                <td class='unit_price' unit_price=$price>".number_format($price,0,'.',',')."đ</td>
                <td class='cart_product_count' >
                    <div class='count_wrapper'>
                        <div class='count_change_btn decrease_btn'>
                            <i class='fa-solid fa-angle-left'></i>
                        </div>
                        <input type='number' class='product_count' min=0 value=$count>
                        <div class='count_change_btn increase_btn'>
                        <i class='fa-solid fa-angle-right'></i>
                        </div>
                    </div>
                </td>
                <td class='sum_product' sum_product=$sum_product>".currency_format($sum_product)."</td>

            </tr>";  	
			
                    
        };
        echo "</table>";
        echo "<div class='display_sum_cart'>";
        echo "<p>Tổng tiền cần thanh toán:</p>"."<p class='sum_cart' sum_cart=$sum>".number_format($sum,0,'.',',')."</p>";
        echo "</div>";

        echo "
        <div class = 'payment__field'>
            <input type='submit' value='Thanh toán' class='update_btn'>
        </div>";
        echo "<div class='message'></div>";

    }
        
    else{
        echo "<div class='message'>Không có mặt hàng trong giỏ hàng</div>";
    }
	// }
    
?>
</form>
</main>
<?php get_footer(); ?>