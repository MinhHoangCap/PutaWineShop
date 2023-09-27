<?php
/*
Template Name: Payment
*/
?>
<?php get_header(); ?>
<?php include("part-page_banner.php")?>

<main>
   <form id="payment-form" class="payment" action="" method="post">
        <div class="customer_infomation">
            <p>Thông tin thanh toán</p>
          <input type="text" name="name" placeholder = "Họ tên" >
            <input type="email" name="email" placeholder = "Email" >
            <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Điện thoại"/>
            <input type="text" name="address" placeholder = "Địa chỉ" >
            <input type="text" name="note" placeholder = "Ghi chú" >

        </div>
        <div class="cart_infomation">
            <p class="cart_heading">Thông tin đơn hàng</p>
            <?php 
            $tong = 0;
            foreach(array_keys($_SESSION['cart']) as $product_id){
                $count = $_SESSION['cart'][$product_id]['count'];
                $tong += get_field("price",$product_id)* $_SESSION['cart'][$product_id]['count'];
                echo "<div class='payment_product' product_id=$product_id count=$count>";
                    echo "<p>".get_the_title($product_id)." x ".$_SESSION['cart'][$product_id]['count']."</p>";
                    echo "<p>".currency_format(get_field("price",$product_id) * $_SESSION['cart'][$product_id]['count'])."</p>";
                echo "</div>";
            }
            echo "<div class='payment_field'>";
                    echo "<p>Tổng tiền</p>";
                    echo "<p>".currency_format($tong)."</p>";
            echo "</div>";
            echo "<div class='payment_field'>";
                    echo "<p>Thanh toán</p>";
                    echo "<p>".currency_format($tong)."</p>";
            echo "</div>";
            echo "<div class='loader'></div>";
            echo "<button class='payment_btn' type='submit'>Đặt ngay</button>"
            ?>
        </div>
    </form>
    

</main>
<?php get_footer(); ?>
