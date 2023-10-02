<?php get_header(); ?>
<main>
    <?php include("templates/part-page_banner.php")?>
    <?php
        $count = 1;
    ?>
    <div class="container-all container">
        <article>
            <div class='product_detail_infomation'>
                <?php $photos = get_field("photos")?>

                <div class='product_detail_imgs'>
                    <div class='product_detail_feature__img'>
                        <!-- primary slide -->
                        <!-- echo get_the_post_thumbnail(); -->
                        <section class="splide primary_img" aria-label="Splide Basic HTML Example">
                            <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php 
                                        foreach($photos as $photo){
                                            // echo $photo;
                                        echo "<li class='splide__slide'>
                                            <img class='product_detail_element--img' src='".$photo."' alt=''>
                                        </li>";
                                    }
                                        ?>
                                    </ul>
                            </div>
                        </section>
                    </div>
                    <div class='product_detail_list--imgs'>
                        <section class="splide secondary_img" aria-label="Splide Basic HTML Example">
                            <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php 
                                        foreach($photos as $photo){
                                            // echo $photo;
                                        echo "<li class='splide__slide'>
                                            <img class='product_detail_element--img' src='".$photo."' alt=''>
                                        </li>";
                                    }
                                        ?>
                                    </ul>
                            </div>
                        </section>
                    </div>


                    
                    
                </div>
                <div class='product_detail_other-info'>
                    <h3 class='product_detail__name'><?php echo get_the_title()?> </h3>
                    <div class ='product_detail__prices'>
                        <?php $price_sale = get_field("price_sale");
                        if($price_sale != 0){
                        ?>
                        <p class='product__price sale'><?php echo currency_format(get_field("price_sale"))?></p>
                        <p class='product__price'><?php echo currency_format(get_field("price"))?></p>
                        <?php } else { ?>
                            <p class='product__price sale'><?php echo currency_format(get_field("price"))?></p>
                            <?php } ?>
                    </div>
                    <p class='product_detail__content'>
                        <?php echo  get_field("description");?>
                    </p>
                    <div class="count__button">
                        <div class='count_wrapper'>
                            <div class='count_change_btn decrease_btn'>
                                <i class='fa-solid fa-caret-left'></i>
                            </div>
                            <input type='number' class='product_count' min=0 disabled value='<?php echo $count?>'>
                            <div class='count_change_btn increase_btn'>
                                <i class='fa-solid fa-caret-right'></i>
                            </div>
                        </div>
                        <button id=<?php echo get_the_ID() ?> class='buy__single_btn'>MUA NGAY</button>

                    </div>
                </div>        
            </div>
            <h3 class='description_heading'>Mô tả chi tiết</h3>
            <p class='description_content'><?php echo get_the_content();?></p>
           
            <?php include("templates/part-product_relates.php")?>
            <?php 
            $terms = get_the_terms(get_the_ID(), 'product_cat');
            $first_term = reset($terms);
            get_product_relate($first_term->name)?>
        </article>
    </div>
</main>
<?php get_footer(); ?>