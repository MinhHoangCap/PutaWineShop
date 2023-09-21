<?php
/*
 Template Name: Liên hệ
 */
?>
<?php
    function contact_info($name,$classname,$icon){
        echo "<div class='contact_info $classname'>
            <div class='wrapper'>
                <div class='title'>$name</div>
                <div class='icon'>".$icon."</div>
            </div>
            <hr/>
            <div class='infomation'>
                ".get_field($classname,'option')."
            </div>
        </div>";
    }

?>
<?php get_header(); ?>
<main>
    <?php include('part-page_banner.php'); ?>
    <div class="contact_infomation">
        <?php contact_info('Hotline','hotline','<i class="fa-sharp fa-solid fa-phone-volume"></i>')?>
        <?php contact_info('Địa chỉ','address','<i class="fa-sharp fa-solid fa-location-dot"></i>')?>
        <?php contact_info('Email','email','<i class="fa-sharp fa-regular fa-envelope"></i>')?>
    </div>
    <div class="gg_map_contact_form">
        <div class="google-map-contact">
            <?php include("part-google_map.php")?>

        </div>
        <?php include("part-contact_form.php")?>

    </div>
    
</main>
<?php get_footer(); ?>