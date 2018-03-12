<?php
	@ini_set( 'upload_max_size' , '64M' );
	@ini_set( 'post_max_size', '64M');
	@ini_set( 'max_execution_time', '300' );    
	add_action('init', 'init_custom_load');
	if (!defined('TMPL_URL')) {
	    define('TMPL_URL', get_template_directory_uri());
	}
	function init_custom_load(){
	    
	if(is_admin()) {
	    wp_enqueue_style('admin_css', TMPL_URL.'/lib/css/admin_css.css', false, '1.0', 'all');
	    wp_enqueue_style('font-awesome.min', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	    wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	    wp_enqueue_script('admin_js', TMPL_URL.'/js/lib/admin.js', false, '1.0', 'all');
	}
	}
	remove_action('wp_head', 'wp_generator');
	show_admin_bar(false);
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	
	/*For woocommerce sites only*/
	/*	
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}*/
	
	/* For post types and metabox */
	require_once(TEMPLATEPATH . "/lib/admin-config.php");

	/* Featured Image */
	add_theme_support('post-thumbnails');
	
	/*	Menu Backend */
	add_theme_support( 'menus' );
	
	/*	Multipost Thumbnail Image */
	if (class_exists('MultiPostThumbnails')) {
	    new MultiPostThumbnails(array(
	        'label' => 'mobile image',
	        'id' => 'mobileimage',
	        'post_type' => 'banners'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Icon Image',
	        'id' => 'iconimage',
	        'post_type' => 'beauty'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Page Banner Image',
	        'id' => 'page_banner',
	        'post_type' => 'page'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Recipe Banner Image',
	        'id' => 'recp_banner',
	        'post_type' => 'recipe'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Fintess Banner Image',
	        'id' => 'fitn_banner',
	        'post_type' => 'fitness'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Beauty Banner Image',
	        'id' => 'beau_banner',
	        'post_type' => 'beauty'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Icon Image',
	        'id' => 'recpiconimg',
	        'post_type' => 'recipe'
	        )
	    );
	    new MultiPostThumbnails(array(
	        'label' => 'Icon Image',
	        'id' => 'fiticonimg',
	        'post_type' => 'fitness'
	        )
	    );
	}
	/*	For Excerpt */
	add_post_type_support('page', 'excerpt');

	/* Format the content */
	function content_formatter($content) {
	    $bad_content = array('<p></div></p>', '<p><div class="full', '_width"></p>', '</div></p>', '<p><ul', '</ul></p>', '<p><div', '<p><block', 'quote></p>', '<p><hr /></p>', '<p><table>', '<td></p>', '<p></td>', '</table></p>', '<p></div>', 'nosidebar"></p>', '<p><p>', '<p><a', '</a></p>', '_half"></p>', '_third"></p>', '_fourth"></p>', '<p><p', '</p></p>', 'child"></p>', '<p></p>');
	    $good_content = array('</div>', '<div class="full', '_width">', '</div>', '<ul', '</ul>', '<div', '<block', 'quote>', '<hr />', '<table>', '<td>', '</td>', '</table>', '</div>', 'nosidebar">', '<p>', '<a', '</a>', '_half">', '_third">', '_fourth">', '<p', '</p>', 'child">', '');
	    $new_content = str_replace($bad_content, $good_content, $content);
	    return $new_content;
	}
	remove_filter('the_content', 'wpautop');
	add_filter('the_content', 'wpautop', 10);
	add_filter('the_content', 'content_formatter', 11);

	/* For empty paragraph */
	function shortcode_empty_paragraph_fix_tag($content) {
	   $array = array(
	      '<p>[' => '[',
	      ']</p>' => ']',
	      '<p></p>' => '',
	      ']<br />' => ']'
	   );
	   $content = strtr($content, $array);
	   return $content;
	}
	/****************************
	Get Menus In Header And Footer
	*****************************/
	function countMenu($menuName){
		$countMenuArgs = array(
		'order' => 'ASC', 
		'post_type' => 'nav_menu_item', 
		'post_status' => 'publish',
		'output' => ARRAY_A,
		'output_key' => 'menu_order', 
		'nopaging' => true,
		'update_post_term_cache' => false,
		'menu_item_parent' => 1
		);
		$menuCountItems = wp_get_nav_menu_items($menuName, $countMenuArgs); 
		$menuItemsCount = 0;
		foreach ($menuCountItems as $key => $menuCountItem) {
			if ($menuCountItem->menu_item_parent == '0'){
				$menuItemsCount++;
			}
		}
		return $menuItemsCount;
	}
	/*********
    Remove Image Height and Width
    **********/
	add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10,3 );
	add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

	function remove_width_attribute( $html ) {
	 $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	 return $html;
	}

	add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
	function remove_thumbnail_dimensions( $html ) {
	  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	  return $html;
	}
	/*********
    Remove P tag from images
    **********/
	function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	}
	add_filter('acf_the_content', 'filter_ptags_on_images');
	add_filter('the_content', 'filter_ptags_on_images');

	/********
	Shortcodes
	*********/

	function span( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<span>'.do_shortcode($content).'</span>';
	}
	add_shortcode('span', 'span');

	function break_tag( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<br/>';
	}
	add_shortcode('break_tag', 'break_tag');

	function div_tag( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div>'.do_shortcode($content).'</div>';
	}
	add_shortcode('div_tag', 'div_tag');

	


	/*********
	new shortcodes
	**********/
	/*
	*Connie html shortcoes
	*/
	function full_column( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="col-12">'.do_shortcode($content).'</div>';
	}
	add_shortcode('full_column', 'full_column');

	function two_column( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="col-6">'.do_shortcode($content).'</div>';
	}
	add_shortcode('two_column', 'two_column');

	function twocol_image( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="col-6 padding-row"><div class="genericSample-image border-row">'.do_shortcode($content).'</div></div>';
	}
	add_shortcode('twocol_image', 'twocol_image');
	function twocol_img_cont( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="col-6 genericSample-image-content">'.do_shortcode($content).'</div>';
	}
	add_shortcode('twocol_img_cont', 'twocol_img_cont');
	function center_blk_column( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="col-10 center-block">'.do_shortcode($content).'</div>';
	}
	add_shortcode('center_blk_column', 'center_blk_column');
	add_shortcode('general_list', 'general_list');
	function quote_head( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="col-6 heading">'.do_shortcode($content).'</div>';
	}
	add_shortcode('quote_head', 'quote_head');
	/*
	function general_list( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="generic-paraList">'.do_shortcode($content).'</div>';
	}
	function order_list( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="orderedList">'.do_shortcode($content).'</div>';
	}
	add_shortcode('order_list', 'order_list');
	function chk_list( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="unordered">'.do_shortcode($content).'</div>';


	}
	add_shortcode('general_list', 'general_list');
	*/

	function accordion( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="accordion">'.do_shortcode($content).'</div>';
	}
	add_shortcode('accordion', 'accordion');
	function accord_item( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="accordion-item">'.do_shortcode($content).'</div>';
	}
	add_shortcode('accord_item', 'accord_item');
	function accord_cont( $atts, $content = null ) {
	   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	   $content=shortcode_empty_paragraph_fix_tag($content);
	   return '<div class="accordion-content">'.do_shortcode($content).'</div>';
	}
	add_shortcode('accord_cont', 'accord_cont');

	function row($atts, $content = null) {
    	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	    $content=shortcode_empty_paragraph_fix_tag($content);
	    return '<div class="row">' .do_shortcode($content).'</div>';

	}
	add_shortcode('row', 'row');
/*
* About us section
*/
function aboutus_first_section($atts, $content = null) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content=shortcode_empty_paragraph_fix_tag($content);
    return '<section class="generic about-section"><div class="about-content"><div class="row">'.do_shortcode($content).'</div></div></section>';

}
add_shortcode('aboutus_first_section', 'aboutus_first_section');

function aboutus_left_content($atts, $content = null) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content=shortcode_empty_paragraph_fix_tag($content);
    return '<div class="col-7 about-content-block">'.do_shortcode($content).'</div>';

}
add_shortcode('aboutus_left_content', 'aboutus_left_content');

function aboutus_right_image($atts, $content = null) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content=shortcode_empty_paragraph_fix_tag($content);
    return '<div class="col-5"><div class="about-image">'.do_shortcode($content).'</div></div>';

}
add_shortcode('aboutus_right_image', 'aboutus_right_image');

function aboutus_second_section($atts, $content = null) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content=shortcode_empty_paragraph_fix_tag($content);
    return '<section class="generic generic-startSection"><div class="starting-topContent border-row">
					<div class="row">'.do_shortcode($content).'</div></div></section>';

}
add_shortcode('aboutus_second_section', 'aboutus_second_section');

function aboutus_right_content($atts, $content = null) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content=shortcode_empty_paragraph_fix_tag($content);
    return '<div class="col-6 about-content-block">'.do_shortcode($content).'</div>';

}
add_shortcode('aboutus_right_content', 'aboutus_right_content');




function aboutus_left_image($atts, $content = null) {
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content=shortcode_empty_paragraph_fix_tag($content);
    return '<div class="col-6 generic-paddingLeft">'.do_shortcode($content).'</div>';

}
add_shortcode('aboutus_left_image', 'aboutus_left_image');
	
function removeEmptyParagraphs($content) {

    $pattern = "/<p[^>]*><\\/p[^>]*>/";   
    $content = preg_replace($pattern, '', $content);
    $content = str_replace("<p></p>","",$content);
    return $content;
}

add_filter('the_content', 'removeEmptyParagraphs',99999);

	/*
	*Instagram feeds 
	*/
	function connie_instagram_api_curl_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}
?>