<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo get_field_acf('favicon'); ?>">
    <!-- Link css -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-grid.min.css"
        integrity="sha512-JQksK36WdRekVrvdxNyV3B0Q1huqbTkIQNbz1dlcFVgNynEMRl0F8OSqOGdVppLUDIvsOejhr/W5L3G/b3J+8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.css"
        integrity="sha512-HFaR9dTfvVVIkca85XvaYOlbZqtyRp5f7cyfb3ycnQU60RM1qjmJKq7qZPLDI+nudOkFDuY5giiwQqfbP7M36g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/splide.min.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/slick.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/slick-theme.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/main.css">
  
    <!-- Link script -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.1/jquery-migrate.min.js"
        integrity="sha512-t0ovA8ZOiDuaNN5DaQQpMn37SqIwp6avyoFQoW49hOmEYSRf8mTCY2jZkEVizDT+IZ9x+VHTZPpcaMA5t2d2zQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.0/jquery-migrate.min.js"
        integrity="sha512-QDsjSX1mStBIAnNXx31dyvw4wVdHjonOwrkaIhpiIlzqGUCdsI62MwQtHpJF+Npy2SmSlGSROoNWQCOFpqbsOg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.js"
        integrity="sha512-KX9LF4BMXOG6qr9aGjFIPK1xysZAHWXpuZW6gnRi6oM+41qa8x4zaLPkckNxz5veoSWzmV5HZqPMMtknU+431g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-3.7.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script defer src="<?php bloginfo('template_directory') ?>/assets/js/splide.min.js"></script>
<script defer src="<?php bloginfo('template_directory') ?>/assets/js/slick.min.js"></script>
<script defer src="<?php bloginfo('template_directory') ?>/assets/js/script.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
   
        
            <header>
                
                <?php $home_img = get_field("slider_home",'options');
                // style='padding-bottom: 100px;'
                ?>
                <div class="header" <?php if(is_home()) echo ""; else echo "style = 'background-color: white; padding:10px;'"; ?>>
                    <?php if(is_home()) { ?>
                    <div class="imgs" >
                        <?php
                            foreach($home_img as $img){
                                ?>
                                <div class="img">
                                    <img src=<?php echo $img?> alt=''>
                                </div>
                        <?php
                            }
                        
                        ?>
                    </div>					
                    <?php include("templates/part-social.php");}?>
                    <div class="shop_logo">
                        <a href='<?php echo home_url()?>'>
                            <?php 
                                if(is_home()) 
                                    echo wp_get_attachment_image(get_field("Logo",'options'));
                                else 
                                    echo wp_get_attachment_image(get_field("logo_not_home",'options'));
                            ?>

                        </a>
                    </div>
                    <?php include_once("templates/part-other.php")?>
                  
                
                    <div class="menu_btn" ><i class="fa-solid fa-bars"></i></div>
                    
                    <div class="menu" <?php if(!is_home()) echo "style='order: 0; width: 70%;'"?>>
                    <?php
                        
                            wp_nav_menu(array(
                                'menu'=> 'main nav',
                                'menu_class' => 'menu_home'
                            ));
                    ?>
                        <!-- <div class="close_menu_btn" ><i class="fa-solid fa-xmark"></i></div> -->
                    </div>
                    
                    <?php if(is_home()) {?>
                    <div class="heading"><?php echo get_field("name",'options')?></div>
                    <div class="link_field">
                        <a href = <?php echo get_field("page_content","options")?> class='find_out'>Tìm hiểu thêm</a>
                    </div>
                    <?php } ?>
                </div>
            </header>


        