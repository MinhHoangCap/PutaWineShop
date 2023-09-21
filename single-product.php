<?php get_header(); ?>
<main>
    <?php include("templates/part-page_banner.php")?>
    <?php
        $count = 0;
    ?>
    <div class="container-all container">
        <article>
            <?php echo "<div class='product_detail_infomation'>"; ?>
                <?php $photos = get_field("photos")?>

                <?php echo "<div class='product_detail_imgs'>"; ?>
                    <?php 
                        echo "<div class='product_detail_feature__img'>";
                            echo get_the_post_thumbnail();
                        echo "</div>";
                    
                    ?>
                    <?php 
                    echo "<div class='product_detail_list--imgs'>";
                    foreach($photos as $photo){
                        ?> <img class='product_detail_element--img' src=<?php echo $photo;?> alt="">
                        <?php
                        }
                    
                    echo "</div>";
                echo "</div>";?>
                <?php echo "<div class='product_detail_other-info'>";?>
                    <?php  echo "<h3 class='product_detail__name'>".get_the_title()."</h3>";?>
                    <?php echo "<div class ='product_detail__prices'>";?>
                        <?php echo "<p class='product_detail__price'>".get_field("gia")."</p>";?>
                        <?php $price_sale = get_field("gia")-5000;?>
                        <p class='product_detail__price--sale'><?php echo $price_sale?></p>
                    <?php echo "</div>";?>
                    <p class='product_detail__content'><?php echo  get_field("mo_ta");?></p>
                    <div class="count__button">
                        <div class='count_wrapper'>
                            <div class='count_change_btn decrease_btn'>
                                <i class='fa-solid fa-caret-left'></i>
                            </div>
                            <input type='number' class='product_count' min=0 value='<?php echo $count?>'>
                            <div class='count_change_btn increase_btn'>
                                <i class='fa-solid fa-caret-right'></i>
                            </div>
                        </div>
                        <button id=<?php echo get_the_ID() ?> class='buy__single_btn'>MUA NGAY</button>

                    </div>
                    <?php echo "</div>";?>        


            <?php echo "</div>" ?>
            <h3 class='description_heading'>Mô tả chi tiết</h3>
            <?php echo get_the_content();?>
            <input type="number" name="" id="">
           
            <?php include("templates/part-product_relates.php")?>
            <?php $category = get_the_category();
                get_product_relate($category[0]->name)?>
        </article>
    </div>
</main>
<?php get_footer(); ?>