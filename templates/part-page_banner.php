<?php
        if(is_page_template( "templates/about.php" )){
            echo "<div class='page__banner--aboutus'>";
                
                echo "<div class='title'>Về chúng tôi</div>";
            echo "</div>";
            
        }
        else if(is_page_template( "templates/cart.php" )){
            echo "<div class='page__banner--aboutus'>";
            
                echo "<div class='title'>Giỏ hàng</div>";
            echo "</div>";
            
        }
        else if(is_page_template( "templates/contact.php" )){
            echo "<div class='page__banner--aboutus'>";
            
                echo "<div class='title'>Liên hệ</div>";
            echo "</div>";
            
        }
		else if(is_page_template( "templates/payment.php" )){
            echo "<div class='page__banner--aboutus'>";
            
                echo "<div class='title'>Thanh toán</div>";
            echo "</div>";
            
        }
		else if(is_page_template( "templates/favourite.php" )){
					echo "<div class='page__banner--aboutus'>";

						echo "<div class='title'>Danh sách yêu thích</div>";
					echo "</div>";

				}
        else if(is_page_template( "templates/link_promotion.php" )){
            echo "<div class='page__banner--aboutus'>";
                echo "<div class='title'>Liên kết - khuyến mãi</div>";
            echo "</div>";
        }
        else if(is_single()){

            $category = get_the_category();
            echo "<div class='page__banner--aboutus'>";
                
                echo "<div class='title'>".$category[0]->name."</div>";
            echo "</div>";
        }
        else{
            echo "<div class='page__banner--aboutus'>";
                echo "<div class='title'>".get_queried_object()->name."</div>";
            echo "</div>";
        }

    ?>
