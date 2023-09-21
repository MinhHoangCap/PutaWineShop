<?php
//Add theme support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );


//Remove notification update admin screen
function hide_update_nag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}

add_action('admin_menu','hide_update_nag');
//Revert classic editor and  manage widget
add_filter('use_block_editor_for_post', '__return_false');
add_filter( 'use_widgets_block_editor', '__return_false' );
//Disable auto update theme and plugin
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
function shapeSpace_disable_image_sizes($sizes) {
	unset($sizes['small']); // disable small size 
	unset($sizes['medium']); // disable medium size 
	unset($sizes['large']); // disable large size 
	unset($sizes['medium_large']); // disable medium-large size 
	unset($sizes['1536x1536']); // disable 2x medium-large size 
	unset($sizes['2048x2048']); // disable 2x large size 
	return $sizes;
  }
add_action('intermediate_image_sizes_advanced', 'shapeSpace_disable_image_sizes');
add_filter( 'big_image_size_threshold', '__return_false' );
//Remove comment, user page, ACF plugin, theme and theme editor
// add_action('admin_menu', function () {
//     remove_menu_page('edit-comments.php');
// 	remove_menu_page('users.php');
// 	remove_menu_page('plugins.php');
// 	remove_menu_page('tools.php');
// 	remove_menu_page('edit.php?post_type=acf-field-group');
// 	remove_submenu_page( 'themes.php', 'themes.php' );
// 	remove_submenu_page( 'themes.php', 'theme-editor.php' );
// 	remove_submenu_page( 'themes.php', 'nav-menus.php' );
// }, 999);
// // Remove comments links from admin bar
// add_action('init', function () {
//     if (is_admin_bar_showing()) {
//         remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
//     }
// });
// function plt_hide_custom_post_type_ui_menus() {
// 	remove_menu_page('cptui_main_menu');
// 	remove_submenu_page('cptui_main_menu', 'cptui_manage_post_types');
// 	remove_submenu_page('cptui_main_menu', 'cptui_manage_taxonomies');
// 	remove_submenu_page('cptui_main_menu', 'cptui_listings');
// 	remove_submenu_page('cptui_main_menu', 'cptui_tools');
// 	remove_submenu_page('cptui_main_menu', 'cptui_support');
// 	remove_submenu_page('cptui_main_menu', 'cptui_main_menu');
// }
// add_action('admin_menu', 'plt_hide_custom_post_type_ui_menus', 11);

function detect_device() {
	if( ! class_exists( 'Mobile_Detect' ) )
	require_once( __DIR__ . '/MobileDetect.php' );
	$detect = new \Detection\MobileDetect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	return $deviceType;
}

function get_thumb($post_id, $class="", $src = false) {
	$thumb_post_mobile = 'thumbnail_post_mobile';
	if ( detect_device() === 'computer' || detect_device() === 'tablet') {
		$image = ($src === false) ? get_the_post_thumbnail($post_id, 'full', array( "class" => $class )): get_the_post_thumbnail_url($post_id, 'full');
	} else if (detect_device() === 'phone') {
		$image = ($src === false) ? wp_get_attachment_image(chooseImageAvatar($thumb_post_mobile, $post_id), 'full', '', array( "class" => $class )) : wp_get_attachment_image_url(chooseImageAvatar($thumb_post_mobile, $post_id), 'full');
	}
	return $image;
}

function get_img_repeater($id, $class = "", $src = false){
	$img_info = "";
	if (detect_device() === 'computer' || detect_device() === 'tablet') {
		$img_info = ($src === false) ? wp_get_attachment_image($id, 'full', "", array("class" => $class)) : wp_get_attachment_image_url($id, 'full');
	} else if (detect_device() === 'phone') {
		$img_info = ($src === false) ? wp_get_attachment_image($id, 'full', "", array("class" => $class)) : wp_get_attachment_image_url($id, 'medium');
	}
	return $img_info;
}

function chooseImageAvatar($fieldName="", $option='option') {
	if (get_field_acf($fieldName, $option)) {
		$postThumbnailID = get_field_acf($fieldName, $option);
		return $postThumbnailID;
	} else if (get_first_post_image_or_default()) {
		return get_first_post_image_or_default();
	}
}

function get_first_post_image_or_default() {
	global $post, $posts;
	$default_image = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$default_image = $matches [1] [0];
	if ($default_image) {
		return $default_image;
	} else {
		$default_image = get_field_acf('image_non_select');
		return $default_image;
	}
}
if ( function_exists('pll_current_language')){
	$GLOBALS['lang_cur'] = '_'.pll_current_language('slug');
	if($GLOBALS['lang_cur'] == '_vi') $GLOBALS['lang_cur'] = '';
}

function get_field_acf($field, $option = 'option') {
	if (get_field($field.$GLOBALS['lang_cur'], $option)) {
		return get_field($field.$GLOBALS['lang_cur'], $option);
	} else if(get_field($field.'_en', $option)) {
		return get_field($field.'_en', $option);
	} else {
		return get_field($field, $option);
	}
}

//Tạo menu
function register_my_menu() {
    register_nav_menu('main-menu', __( 'Main menu' ));
    register_nav_menu('footer-menu', __( 'Footer menu' ));
	// mytheme_register_nav_menu();
}
add_action( 'init', 'register_my_menu' );

//Add custom option
if ( function_exists('acf_add_options_page')) {
	acf_add_options_page(array (
		'page_title' 	=> 'Theme Home Options',
		'menu_title'	=> 'Cấu hình web',
	));
	acf_add_options_page(array (
		'page_title' 	=> 'Manual',
		'menu_title'	=> 'Hướng dẫn sử dụng',)
	);
};

// định dạng tiền tệ
if (!function_exists('currency_format')) {
	function currency_format($number, $suffix = 'đ') {
		if (!empty($number)) {
			return number_format($number, 0, '.', '.') . "{$suffix}";
		}
	}
}

// thêm vào giỏ hàng
//Thêm luật
function rewrite_rules($rules) {
    $new_rules = array();
    $new_rules['(gio-hang)/(them|xoa)/([0-9]+)/?'] = 'index.php?pagename=$matches[1]&action=$matches[2]&pro_id=$matches[3]';
    return $new_rules + $rules;
}
add_action("rewrite_rules_array", "rewrite_rules");
add_action("init", "mySessionStart", 1);
add_action("wp_logout", "mySessionEnd");
add_action("wp_login", "mySessionEnd");

//Session
function mySessionStart()
{
    ob_start();
    if (!session_id()) {
        session_start();
    }
}
function mySessionEnd()
{
    session_destroy();
}

function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
	return '<span class="divider white-text fs-15px"><i class="fa-solid fa-arrow-right-long"></i></span>';
};
// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);

function base_pagination() {
	global $wp_query;
	$big = 999999999;
	
	$paginate = paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'type' => 'array',
	'total' => $wp_query->max_num_pages,
	'format' => '/paged/',
	'current' => max( 1, get_query_var('paged') ),
	'prev_next' => false,
	));
	
	// Display the pagination if more than one page is found
	if ( $wp_query->max_num_pages > 1 ){
	echo '<div class="quatrang df aic">';
		foreach ( $paginate as $page ) {
		if(strpos($page, 'current')!==false){
		echo $page;
		}
		else echo$page;
		}
		echo '</div>';
	}
	wp_reset_query();
	}

// SMTP Authentication
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = 'smtp.gmail.com';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = '587';
	$phpmailer->Username   = 'servermail2048@gmail.com';
	$phpmailer->Password   = 'foteoujossylqbay';
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->From       = get_field('email','option');
	$phpmailer->FromName   = get_field('name','option');
}

//mail
add_action('wp_enqueue_scripts', 'enqueue_jquery_form');
function enqueue_jquery_form() {
    wp_enqueue_script('jquery-form');
}

add_action( 'wp_ajax_footer_form', 'footer_form' );
add_action( 'wp_ajax_nopriv_footer_form', 'footer_form' );
function footer_form() {
	$footer_email = $_POST["footer_email"];
	
	$emailTo = get_text_acf('email');
	$subject = 'Email đăng kí nhận khuyến mãi';
	$body = "Email: ".$footer_email;
	$rs = wp_mail($emailTo, $subject, $body);
	if($rs) $rs = 'Đăng kí thành công!';
	else $rs = 'Lỗi: Đăng kí không thành công!';
	exit($rs);
}

add_action( 'wp_ajax_contact_form', 'contact_form' );
add_action( 'wp_ajax_nopriv_contact_form', 'contact_form' );
function contact_form() {
	$name = $_POST["name"];
	// $contact_address = $_POST["contact_address"];
	// $contact_email = $_POST["contact_email"];
	$phone = $_POST["phone"];
	$content = $_POST["message"];
	// exit($name." đã liên hệ thành công");
	// echo $name;
	// echo $phone;
	// echo $content;

	// <p>Địa chỉ: '.$contact_address.'</p>
	// <p>Mmail:'.$contact_email.' </p>
	$emailTo = get_field('email','option');
	// $emailTo = 'minhhoangcap@gmail.com';
	$subject = 'Thông báo yêu cầu liên hệ mới !';
	$body = "<h2><Thông tin liên hệ/h2>";
	$body .= '
	<p>Họ tên: '.$name.'</p>
	<p>Điện thoại: '.$phone.'</p>
	<p>Nội dung yêu cầu: '.$content.'</p>
	';
	// echo $body;
	$rs = wp_mail($emailTo, $subject, $body);
	if($rs) $rs = 'success:Đăng kí thành công!';
	else $rs = 'error: Đăng kí không thành công!';
	exit($rs);
}
//cookie favourite list
function cookie_favourite_list(){
	if(!empty($_COOKIE['favourite_cart'])){
		return $_COOKIE['favourite_cart'];
	}
	else{
		return array()	;
	}
	
}

//favourite list
add_action( 'wp_ajax_favourite_list', 'favourite_list' );
add_action( 'wp_ajax_nopriv_favourite_list', 'favourite_list' );

function favourite_list() {


	$id = $_POST['id'];
	
	$favourite_cart = cookie_favourite_list();
	if(gettype($favourite_cart)=== 'array'){
		array_push($favourite_cart,$id);
	}
	else{
		$favourite_cart = str_replace('\\', '', $favourite_cart);
		$favourite_cart = json_decode($favourite_cart);
		if(!in_array($id,$favourite_cart)){
			array_push($favourite_cart,$id);
	
		}
		else{
			$product_id = array_search($id,$favourite_cart);
			array_splice($favourite_cart,$product_id,1);
		}
	}
	

	$favourite_cart = json_encode($favourite_cart);

	setcookie('favourite_cart',$favourite_cart,time() + 60*60*24,"/");
	
	exit($favourite_cart);

	// set favourite_cart là null
	// setcookie('favourite_cart',"",time() - 3600,"/");
}
//buy list
add_action( 'wp_ajax_buy_list', 'buy_list' );
add_action( 'wp_ajax_nopriv_buy_list', 'buy_list' );

function buy_list() {
	$id = $_POST['id'];
	$count = $_POST['count'];
	$_SESSION['cart'][$id]=['count'=>$count];
	exit(json_encode($_SESSION['cart']));
	

	// set favourite_cart là null
	// setcookie('favourite_cart',null,time() - 3600);
}
add_action( 'wp_ajax_remove_cart', 'remove_cart' );
add_action( 'wp_ajax_nopriv_remove_cart', 'remove_cart' );

function remove_cart(){
	$id =$_POST['id'];
	unset($_SESSION['cart'][$id]);
	if(empty($_SESSION['cart'])){
		unset($_SESSION['cart']);
	}
	// print_r($id);
	exit($_SESSION);
}
add_action( 'wp_ajax_edit_count_cart', 'edit_count_cart' );
add_action( 'wp_ajax_nopriv_edit_count_cart', 'edit_count_cart' );

function edit_count_cart(){
	$id =$_POST['id'];
	$count = $_POST['count'];
	$_SESSION['cart'][$id]['count'] = $count;
	return $_SESSION['cart'];
}
add_action( 'wp_ajax_update_cart', 'update_cart' );
add_action( 'wp_ajax_nopriv_update_cart', 'update_cart' );

function update_cart(){
	
	$data = $_POST['data'];
	$data =str_replace("\\","",$data);
	$data = json_decode($data);

	foreach ($data as $key => $value) {
		# code...
		$id = key($value);
		$count = current($value);
		$_SESSION['cart'][$id]['count'] = $count;
	}
	
	exit($_SESSION['cart']);

}

add_action( 'wp_ajax_payment', 'payment' );
add_action( 'wp_ajax_nopriv_payment', 'payment' );

function payment(){
	$payment_list = $_POST['payment_list'];

	foreach($payment_list as $payment_item){
		update_field('ordered_quantity', get_field('ordered_quantity', $payment_item['id']) + (int)$payment_item['count'], $payment_item['id']);
	}
	
	unset($_SESSION['cart']);
	exit("da post thanh cong");
}

// views
function setpostview($postID) {
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function getpostviews($postID) {
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');
function wpdocs_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
