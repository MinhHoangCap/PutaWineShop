<?php get_header(); ?>
<main>

    <?php 
    function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
    ?>
    <h3 class='search_heading'>Kết quả tìm kiếm cho : <?php echo $_GET['s']?></h3>
    <?php
        // $string= "Rượu";
        // echo $string;
        // echo "hello";
        // echo $_GET['s'];
        
        switch($_GET['s']){
            case "cat_ao" : {
                get_products_by_id(6);
                break;
            }
            case "cat_quan" :{
                get_products_by_id(7);
                break;
            }
            case "cat_giay" :{
                get_products_by_id(12);
                break;
            }
            default:{
                $args = array(
                    'posts_per_page'   => -1,
                    'post_type'        => 'product',
                );
                 $posts = new WP_Query( $args );
                if($posts->have_posts()){
                    echo "<div class='search_query'>"; 
                        echo "<div class='product__list'>";
                        while ($posts->have_posts()){
                            $id = get_the_id();
                    // 		echo $id;
                                $post = $posts->the_post();
                                $title = get_the_title($id);
    
                                //get by title
                                if(str_contains(strtolower(convert_vi_to_en($title)),strtolower(convert_vi_to_en($_GET['s'])))){
                                    // echo $title;
                                    // $product = product($id);
                                    // include("templates/part-product.php");
                                    
               
                $post;
                $gia=get_field("price",$id);
                $donvi= get_field("currency");
                $img_link = get_the_post_thumbnail($id) ;
                $post_link = get_permalink($id); 
                $type = get_term(wp_get_post_categories( $id )[0])->slug;
				 if(isset($_COOKIE['favourite_cart'])) 
                    {
                        $cart = json_decode(str_replace('\\', '', $_COOKIE['favourite_cart']));} 
                    else {$cart = array();};
                    (in_array($id,$cart))? $string = " fa-solid in-favourite" : $string = " fa-regular ";
                echo "<li class='product__element' product_id=$id >" ;
                echo "<a href='$post_link'>";
                echo "<div class='product__img'>".$img_link."
				  <button id='$id' class='like__btn' ><i class='fa-heart".$string."'></i></button>
				</div>";  
                echo "<p class='product__name'>".get_the_title($id)."</p>";
                echo "<div class='product__prices'>";
                        echo "<p class='product__price'>".(currency_format($gia))."</p>";
                        echo "<p class='product__price--sale'>".(currency_format($gia-5000))."</p>";
                    echo "</div>";
                echo '</a>';
                   
    
                    echo "<button id='$id' producttype='$type' class='buy__btn'>THÊM VÀO GIỎ HÀNG</button>";
                  
                echo '</li>';
                                }
    
    
    
                            }
                            
                        echo "</div>";
                    echo "</div>";
                    }
                else{
                    echo "khong cos post";
                }
            }
        }
    ?>
</main>
<?php get_footer(); ?>