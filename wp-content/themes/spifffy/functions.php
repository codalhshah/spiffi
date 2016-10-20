<?php
add_action('init', 'redirect');

function redirect(){
 setcookie("PopupBoxCookie", 'popupboxx', time()+3600); 
}


function theme_prefix_setup() {
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

add_theme_support( 'custom-logo', array(
   'height'      => 175,
   'width'       => 400,
   'flex-width' => true,
) );

add_theme_support( 'custom-logo', array(
   'header-text' => array( 'site-title', 'site-description' ),
) );

/**
 * enqueue bootstrap css And Js
 */ 
function aht_enque_scripts() {
    wp_register_style( 'aht_fontawesome_lib', get_template_directory_uri() . '/css/font-awesome.css' );
    wp_enqueue_style( 'aht_fontawesome_lib' );

    wp_register_style( 'aht_bootstrap_lib_min', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'aht_bootstrap_lib_min' );

    wp_register_style( 'aht_owl_theme_min', get_template_directory_uri() . '/css/owl.theme.css' );
    wp_enqueue_style( 'aht_owl_theme_min' );

    wp_register_style( 'aht_owl_transitions_min', get_template_directory_uri() . '/css/owl.transitions.css' );
    wp_enqueue_style( 'aht_owl_transitions_min' );

    wp_register_style( 'aht_owl_carousel_min', get_template_directory_uri() . '/css/owl.carousel.css' );
    wp_enqueue_style( 'aht_owl_carousel_min' );

    wp_register_style( 'aht_style', get_bloginfo('stylesheet_url') );
    wp_enqueue_style( 'aht_style' );

    wp_register_style( 'aht_responsive_css', get_template_directory_uri() . '/css/responsive.css' );
    wp_enqueue_style( 'aht_responsive_css' );

    wp_register_script( 'aht_meanmenujs', get_template_directory_uri().'/js/jquery.meanmenu.min.js', array('jquery'), '1.0', false );
	wp_enqueue_script( 'aht_meanmenujs' );

	wp_register_script( 'aht_owlcarouseljs', get_template_directory_uri().'/js/owl.carousel.min.js', array('jquery'), '1.0', false );
	wp_enqueue_script( 'aht_owlcarouseljs' );

    wp_register_script( 'aht_js', get_template_directory_uri().'/js/jquery.custom.js', array('jquery'), '1.0', false );
	wp_enqueue_script( 'aht_js' );
}
add_action( 'wp_enqueue_scripts', 'aht_enque_scripts' );

/**
 * Register custom sidebars
 */
add_action( 'widgets_init', 'theme_slug_widgets_init' );
	function theme_slug_widgets_init() {
		register_sidebar(array(
			'name' =>  __( 'Left Footer', 'stiffi' ),
			'id' => 'left-footer',
			'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'stiffi' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',	
			'after_widget' => '</li>',	
			'before_title' => '<h3 class="widget-title">',	
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => __( 'Right Footer', 'stiffi' ),
			'id' => 'right-footer',
			'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'stiffi' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',	
			'after_widget' => '</li>',	
			'before_title' => '<h3 class="widget-title">',	
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Sidebar',
			'id' => 'sidebar-1',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',	
			'after_widget' => '</li>',	
			'before_title' => '<h3 class="widget-title"><span>',	
			'after_title' => '</span></h3>',
		));
	}

/**
 * Register Menus
 */
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'stiffi' ),
));
register_nav_menus( array(
	'footer' => __( 'Footer Navigation', 'stiffi' ),
));

/**
 * Add thumbnail support
 */
if (function_exists( 'add_theme_support' )) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 175, 175, true ); 
}

/**
 * Add custom class to menu item
 */
function aht_first_last_menu_class($items) {
    $items[1]->classes[] = 'first-menu-item';
    $items[count($items)]->classes[] = 'last-menu-item';
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'aht_first_last_menu_class' );

/**
 * Custom body class based on browsers
 */
function aht_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) {
		$classes[] = 'ie';
		if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
		$classes[] = 'ie'.$browser_version[1];
	} else $classes[] = 'unknown';
	if($is_iphone) $classes[] = 'iphone';
	if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
		$classes[] = 'osx';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
		$classes[] = 'linux';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
		$classes[] = 'windows';
	}
	return $classes;
}
add_filter( 'body_class', 'aht_browser_body_class' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function aht_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
	return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
	$title .= " $sep " . sprintf( __( 'Page %s' ), $paged, $page );

	$title = ucfirst($title);

	return $title;
}
add_filter( 'wp_title', 'aht_wp_title', 10, 2 );

/**
 * Customization excerpt
 */
function aht_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<ul><li><p><br><em>&nbsp;<strong>');

		$excerpt_length = 90;
		$words = explode(' ', $text, $excerpt_length + 1);

		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...<br/><a class="read-more" href="'.get_permalink().'" title="View full article">Read more</a>');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'aht_trim_excerpt' );

/**
 * Custom function to show limited category in loop post
 */
function aht_list_cats($num){
	$temp = get_the_category();
	$count = count($temp);// Getting the total number of categories the post is filed in.
	for($i=0; $i<$num && $i<$count; $i++){
		$cat_string .= '<a href="'.get_category_link( $temp[$i]->cat_ID ).'">'.$temp[$i]->cat_name.'</a>';
		if($i!=$num-1&&$i+1<$count){
			$cat_string .= ', ';
		}
	}
	echo $cat_string;
}

/**
 * Get tags by post ID
 */
function aht_get_tags_by_ID($post_ID, $list = false){
	if( !$post_ID ){
		global $post;
		$post_ID = $post->ID;
	}

	$all_tags = wp_get_post_tags($post_ID);
	$tags_count = count($all_tags);

	$outt = '';
	if($list === true){
		foreach( $all_tags as $tag ){
			$outt .= '<a href="'.get_tag_link($tag->term_id).'" title="View more from - '.$tag->name.'">'.$tag->name.'</a>,&nbsp';
		}
	}else{
		$tag_rand = rand(0, $tags_count-1);
		$outt .= '<a href="'.get_tag_link($all_tags[$tag_rand]->term_id).'" title="View more from - '.$all_tags[$tag_rand]->name.'">'.$all_tags[$tag_rand]->name.'</a>';
	}

	$outt = rtrim($outt, ',&nbsp');

	return $outt;
}

function aht_validate_gravatar($email) {
	$hash = md5($email);
	$uri = 'http://www.gravatar.com/avatar/'.$hash.'?d=404';
	$headers = @get_headers($uri);
	if (!preg_match("|200|", $headers[0])) {
		$has_valid_avatar = FALSE;
	} else {
		$has_valid_avatar = TRUE;
	}
	return $has_valid_avatar;
}

/**
 * Get all author with pic
 */
function aht_get_author_with_pic(){
	$args = array(
		'orderby' => 'post_count',
		'order' => 'DESC'
	);
	$blog_users = get_users($args);

	$outt = '';
	$count = 1;
	foreach($blog_users as $user){
		if($count > 25){ break; }

		$count++;
		$roles = $user->roles;
		if( in_array('administrator', $roles) || in_array('contributor', $roles) || in_array('editor', $roles) || in_array('author', $roles) ){
			$author_linkk = get_author_posts_url( $user->ID, $user->user_nicename );

			$author_pic_src = get_the_author_meta('author_profile_picture', $user->ID);
			if( aht_validate_gravatar($user->user_email) && empty($author_pic_src) ){
				$author_pic_src = 'http://www.gravatar.com/avatar/'.md5($user->user_email).'?s=85';
			}else{
				$author_pic_src = get_template_directory_uri().'/images/author-pic.png';
			}

			$outt .= '<div class="author-info" data-count="'.$count.'">
				<a href="'.$author_linkk.'" title="Posts by '.$user->user_nicename.'"><img src="'.$author_pic_src.'" title="Posts by '.$user->user_nicename.'" alt="'.$user->user_nicename.'"></a>
			</div>';
		}else{
			continue;
		}
	}

	return $outt;
}

/*
** Custom Post Type For Slider
*/
function st_slider_post_type() {
	$labels = array(
		'name' => __( 'Slides', 'stiffi' ),
		'singular_name' =>__( 'Slide', 'stiffi' ),
		'add_new' => __( 'Add New Slide ', 'stiffi' ),
		'add_new_item' => __( 'Add New Slide', 'stiffi' ),
		'edit_item' => __( 'Edit Slide', 'stiffi' ),
		'new_item' => __( 'New Slide', 'stiffi' ),
		'view_item' => __( 'View Slide', 'stiffi' ),
		'search_items' => __( 'Search Slides', 'stiffi' ),
		'not_found' =>  __( 'No slides found', 'stiffi' ),
		'not_found_in_trash' => __( 'No slides found in trash', 'stiffi' ),
		'parent_item_colon' => __( '', 'stiffi' ),
		'menu_name' => __( 'Slides', 'stiffi' )
	);
	
	$args = array(
		'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
		'supports' => array( 'title','editor','thumbnail','excerpt' )
	); 

	register_post_type( 'slide', $args );
}
add_action( 'init', 'st_slider_post_type' );


/*
** Custom Post Type For Stiffi Logo
*/
function st_Cleaning_post_type() {
	$labels = array(
		'name' => __( 'Cleanings', 'stiffi' ),
		'singular_name' => __( 'Cleaning', 'stiffi' ),
		'add_new' => __( 'Add New Cleaning', 'stiffi' ),
		'add_new_item' => __( 'Add New Cleaning', 'stiffi' ),
		'edit_item' => __( 'Edit Cleaning', 'stiffi' ),
		'new_item' => __( 'New Cleaning', 'stiffi' ),
		'view_item' => __( 'View Cleaning', 'stiffi' ),
		'search_items' => __( 'Search Cleaning', 'stiffi' ),
		'not_found' =>  __( 'No Cleaning found', 'stiffi' ),
		'not_found_in_trash' => __( 'No Cleaning found in trash', 'stiffi' ),
		'parent_item_colon' => __( '', 'stiffi' ),
		'menu_name' => __( 'Cleaning', 'stiffi' )
	);
	
	$args = array(
		'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
		'supports' => array( 'title','editor','thumbnail','excerpt' )
	); 

	register_post_type( 'Cleaning', $args );
}
add_action( 'init', 'st_Cleaning_post_type' );


/*
** Testimonial Post Type
*/
add_action( 'init', 'st_testimonials_post_type' );
function st_testimonials_post_type() {
    $labels = array(
        'name' => __( 'Testimonials', 'stiffi' ),
        'singular_name' => __( 'Testimonial', 'stiffi' ),
        'add_new' => __( 'Add New', 'stiffi' ),
        'add_new_item' => __( 'Add New Testimonial', 'stiffi' ),
        'edit_item' => __( 'Edit Testimonial', 'stiffi' ),
        'new_item' => __( 'New Testimonial', 'stiffi' ),
        'view_item' => __( 'View Testimonial', 'stiffi' ),
        'search_items' => __( 'Search Testimonials', 'stiffi' ),
        'not_found' =>  __( 'No Testimonials found', 'stiffi' ),
        'not_found_in_trash' => __( 'No Testimonials in the trash', 'stiffi' ),
        'parent_item_colon' => '',
    );
 
    register_post_type( 'testimonials', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 11,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'register_meta_box_cb' => 'testimonials_meta_boxes' // Callback function for custom metaboxes
    ) );
}

/*
** How It Works CPT
*/
add_action( 'init', 'st_Works_post_type' );
function st_Works_post_type() {
    $labels = array(
        'name' => __( 'Works', 'stiffi' ),
        'singular_name' => __( 'Work', 'stiffi' ),
        'add_new' => __( 'Add New', 'stiffi' ),
        'add_new_item' => __( 'Add New Work', 'stiffi' ),
        'edit_item' => __( 'Edit Work', 'stiffi' ),
        'new_item' => __( 'New Work', 'stiffi' ),
        'view_item' => __( 'View Work', 'stiffi' ),
        'search_items' => __( 'Search Works', 'stiffi' ),
        'not_found' =>  __( 'No Works found', 'stiffi' ),
        'not_found_in_trash' => __( 'No Works in the trash', 'stiffi' ),
        'parent_item_colon' => '',
    );
 
    register_post_type( 'Works', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 11,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'register_meta_box_cb' => 'Works_meta_boxes' // Callback function for custom metaboxes
    ) );
}


/*
** Logo Post Type
*/
add_action( 'init', 'st_logos_post_type' );
function st_logos_post_type() {
    $labels = array(
        'name' => __( 'Logos', 'stiffi' ),
        'singular_name' => __( 'Logo', 'stiffi' ),
        'add_new' => __( 'Add New', 'stiffi' ),
        'add_new_item' => __( 'Add New Logo', 'stiffi' ),
        'edit_item' => __( 'Edit Logo', 'stiffi' ),
        'new_item' => __( 'New Logo', 'stiffi' ),
        'view_item' => __( 'View Logo', 'stiffi' ),
        'search_items' => __( 'Search Logos', 'stiffi' ),
        'not_found' =>  __( 'No Logos found', 'stiffi' ),
        'not_found_in_trash' => __( 'No Logos in the trash', 'stiffi' ),
        'parent_item_colon' => '',
    );
 
    register_post_type( 'Logos', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 11,
        'supports' => array( 'title','thumbnail' ),
        'register_meta_box_cb' => 'Logos_meta_boxes' // Callback function for custom metaboxes
    ) );
}

/*harsh for checkout page*/
function spiffy_all_scriptsandstyles() {
   
    wp_register_script ('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array(),'1',false);
    wp_enqueue_script('bootstrap');
    
    
    if(is_page('checkout')){
        wp_register_script ('validate', get_stylesheet_directory_uri() .'/js/jquery.validate.min.js', array( 'jquery' ),'1',false);
        wp_enqueue_script('validate');
        
        wp_register_script ('validate_additional', get_stylesheet_directory_uri() .'/js/additional-methods.min.js', array(),'1',false);
        wp_enqueue_script('validate_additional');

        wp_register_script ('payment', get_stylesheet_directory_uri() .'/js/jquery.payment.min.js', array( 'jquery' ),'1',false);
        wp_enqueue_script('payment');

        wp_register_script ('stripe', 'https://js.stripe.com/v2/', array(),'1',false);
        wp_enqueue_script('stripe');
        
        wp_register_script ('checkout', get_stylesheet_directory_uri() . '/js/checkout.js', array(),'1',false);
        wp_enqueue_script('checkout');
    }
    
    wp_enqueue_script( 'bspopup', get_stylesheet_directory_uri() . '/js/popup.js', array(  ), '1.0', true );
     
    wp_register_style ('custom', get_stylesheet_directory_uri() .'/css/custom.css', array(),'2','all');
    wp_enqueue_style( 'custom');
}
add_action( 'wp_enqueue_scripts', 'spiffy_all_scriptsandstyles' );

/*code to change url for particular form*/
//add_filter('wpcf7_form_action_url', 'wpcf7_custom_form_action_url');
//function wpcf7_custom_form_action_url($url)
//{
//    
//    global $post, $wpcf7;
//    
//    if($post->ID == 216){
//        $wpcf7->skip_mail = 1;
//        return get_site_url().'/checkout';
//    } else{
//        return $url;
//    }
//        
//
 
define('CHARGEBEE_BASE', ABSPATH.'chargebee-php-master'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);
define('ENVIRONMENT', 'DEVELOPMENT');
if(ENVIRONMENT == 'DEVELOPMENT'){
    define('KEY', 'test_ZkVQAiR0kv93qwaowWWLmdHbPcux0spod');
    define('SITE', 'getspiffi-test');
}else{
    define('KEY', 'live_B2kS2xmFuwUii0dFWrbwKwL7WicdBccuVu');
    define('SITE', 'getspiffi');
}