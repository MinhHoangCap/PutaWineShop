<div class="other" <?php if(!is_home()) echo "style='order: 1;transform: translate(0px, -8%);'"?>>
    <!-- <div class="flex_center"> -->
        
        <div class="search social_icon">
            <form action=<?php bloginfo('url')?> method="get" class="form_search">
                <input type="text" placeholder="Type your seaching" name="s">
                <button type="submit">Tìm</button>
            </form>    
            <p  class='search_icon'><i class="fa-solid fa-magnifying-glass"></i></p>
        </div>
    <!-- </div> -->
    <!-- <div class="flex_center"> -->
        <div class="like social_icon">
            <a href='<?php echo get_site_url()."/danh-sach-yeu-thich/"?>'>
                <i class="fa-regular fa-heart"></i>
                <i class="fa-solid fa-heart"></i>
            </a>
            <div class="like_count">
                <p class="like_count--text">
                    <?php 
                    if(isset($_COOKIE['favourite_cart']))
                    {
                        $likeCart = json_decode(str_replace('\\', '', $_COOKIE['favourite_cart']));
                        echo count($likeCart);
                    }    
                    ?>
                </p>
            </div>
        </div>

    <!-- </div> -->
    <!-- <div class="flex_center"> -->
        <div class="cart social_icon">
            <a href='<?php echo get_site_url()."/cart/"?>'>
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            
            
            <div class='cart_count'>
            <p class='cart_count--text'>
                <?php 
                    if(isset($_SESSION['cart']))
                    {
                     
                            $cart =  $_SESSION['cart'];
                            echo count($cart);
                    }
                ?>
                </p>
            </div>
        </div>

    </div>
<!-- </div> -->

<?php 
echo '<script type="text/JavaScript">
    if('.!isset($_SESSION['cart']).')
    {
        document.querySelector(".cart_count--text").parentElement.style.display = "none";
    }
    </script>';
?>

