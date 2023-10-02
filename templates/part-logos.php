<?php 
        $logos = get_field("partner",'options');
        // print_r($logos);?>
        <div class='logos' partner_size='<?php echo count($logos);?>'>
        <?php foreach($logos as $logo){
            $logo_img=$logo['logo'];
            echo "
            <div class='logo'>
                <div class='logo_img'>
                    <img  src='$logo_img'/>
                </div>
            </div>";
            
        }
        echo "</div>";
    ?>