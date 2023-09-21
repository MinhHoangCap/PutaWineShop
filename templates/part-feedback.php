<div class="feedback__wrapper">

    <img class='feedback__bg' src=<?php echo get_field("feedback_background",'options')?> alt="">
    <section class="splide feedback" aria-label="Splide Basic HTML Example"> 
        <div class="splide__track"> 
            <?php
                $rows = get_field('comment','options');
                if( $rows ) {?>
                    <ul class="splide__list">
                    <?php foreach( $rows as $row ) {
                        $image = $row['partner_logo'];
                        echo "<li class='splide__slide'>";
                            echo "<div class='feedback'>";
                                echo "<div class='partner_img'>";
                                    echo wp_get_attachment_image( $image['id']);
                                echo "</div>";
                                echo "<div class='partner_message'>".$row['partner_content']."</div>";
                                echo "<p class='partner_name'>".$row['partner_name']."</p>";
                            echo "</div>";
                        echo '</li>';
                    }

                    echo '</ul>';

                }
            
            ?>
        </div>
    </section>
</div>