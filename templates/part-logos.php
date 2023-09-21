<?php 
        $logos = get_field("partner",'options');
        echo "<div class='logos'>";
        foreach($logos as $logo){
            $logo_img=$logo['logo'];
            echo "
            <div class='logo'>
                <img  src='$logo_img'/>
            </div>";
            
        }
        echo "</div>";
    ?>