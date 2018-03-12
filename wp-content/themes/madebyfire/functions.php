<?php
if( !defined( 'TMPL_URI' ) ) define( 'TMPL_URI', get_template_directory_uri() );

add_theme_support( 'post-thumbnails' );

register_nav_menu('mainmenu', 'Main Navigation');
show_admin_bar(false);
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(array(
        'label' => 'Details page banner',
        'id' => 'secondary-image',
        'post_type' => 'portfolio'
            ));
    new MultiPostThumbnails(array(
        'label' => 'Icon image',
        'id' => 'icon-image',
        'post_type' => 'portfolio'
            ));
}
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
require_once(TEMPLATEPATH . "/lib/admin-config.php");

if(is_admin()):
    // Load admin custom scripts.
    wp_enqueue_style('admin_css', TMPL_URI.'/css/admin-style.css', false, '1.0', 'all');
endif;

add_action('init', 'my_add_excerpts_to_pages');

function my_add_excerpts_to_pages() {
    add_post_type_support('page', 'excerpt');
}

function company_change_featured_image_metabox_title( $post_type, $post ) {
    if ( $post_type === 'portfolio' ) {
        //remove original featured image metabox
        remove_meta_box( 'postimagediv', 'portfolio', 'side' );

        //add our customized metabox
        add_meta_box( 'postimagediv', __('Home page banner'), 'post_thumbnail_meta_box', 'portfolio', 'side', 'low' );
    }
}
function my_default_image_size () {
    return 'full';
}
function shortcode_empty_paragraph_fix($content) {

    $array = array (
            '<p>[' => '[',
		'<p>]' => ']',
            ']</p>' => ']',
            '</p>[' => '[',
            ']<br />' => ']',
	    ']<br>' => ']',
	    '<br />[' => '[',
	    '<br>[' => '[',
            '<br>' => '',
	    '<p></p>' => '','<p>&nbsp;</p>' => '',
        );

        $content = strtr($content, $array);

        return $content;
}
add_filter( 'pre_option_image_default_size', 'my_default_image_size' );

add_action( 'add_meta_boxes', 'company_change_featured_image_metabox_title', 10, 2 );

    add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
    add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
    add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );

    function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
    }

function description($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="strapDesc">' . do_shortcode($content) . '</div>';

}

add_shortcode('description', 'description');


function colum_row($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="row">' . do_shortcode($content) . '</div>';

}
add_shortcode('colum_row', 'colum_row');



function two_colum($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="col-xs-6">' . do_shortcode($content) . '</div>';

}
add_shortcode('two_colum', 'two_colum');

function colum_row_full($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    $content = str_replace("<p></p>","",$content);
    return '<div class="container-stretched" ><div class="row">' . do_shortcode($content) . '</div></div>';

}
add_shortcode('colum_row_full', 'colum_row_full');

function three_column($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    $content = str_replace("<p></p>","",$content);
    return '<div class="col-xs-4">' . do_shortcode($content) . '</div>';

}
add_shortcode('three_column', 'three_column');

function three_fourth_column($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    $content = str_replace("<p></p>","",$content);
    return '<div class="col-xs-11">' . do_shortcode($content) . '</div>';

}
add_shortcode('three_fourth_column', 'three_fourth_column');

function three_fourth_column_plain($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    $content = str_replace("<p></p>","",$content);
    return '<div class="container no-padding" ><div class="row"><div class="col-xs-11">' . do_shortcode($content) . '</div></div></div>';

}
add_shortcode('three_fourth_column_plain', 'three_fourth_column_plain');

  function separator_line($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    $content = str_replace("<p></p>","",$content);
    return '<div class="border_line_bottom container-stretched">' . do_shortcode($content) . '</div>';

}
add_shortcode('separator_line', 'separator_line');

function empty_line($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div style="">&nbsp;</div>';

}
add_shortcode('empty_line', 'empty_line');

function button_icon($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="linkTask">' . do_shortcode($content) . '</div>';

}
add_shortcode('button_icon', 'button_icon');
/*video Container*/
function video_container($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="container-stretched">'. do_shortcode($content) .'</div>';

}
add_shortcode('video_container', 'video_container');
/* vimeo link */
function vimeo_link($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="container-stretched"><div class="embed-responsive embed-responsive-16by9">
				            <iframe class="embed-responsive-item" src="'. do_shortcode($content) .'" frameborder="0" allowfullscreen></iframe>
				          </div></div>';

}
add_shortcode('vimeo_link', 'vimeo_link');
/*Video caption*/
function caption($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="imagecap">'. do_shortcode($content) .'</div>';

}
add_shortcode('caption', 'caption');
/*RED HEADING
function red_heading($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="redtitle"><h2>'. do_shortcode($content) .'</h2></div>';

}
add_shortcode('red_heading', 'red_heading');
*/

/*Read more link*/

function read_text($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<span class="read_text">'. do_shortcode($content) .'</a></span>';

}
add_shortcode('read_text', 'read_text');
function red_line($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="red_line">'. do_shortcode($content) .'</a></span>';

}
add_shortcode('red_line', 'red_line');

/*slider image*/
function portfolio_slider_cont($atts, $content = null){
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="container-stretched">
              <div class="row">
                <div class="genericpageslider-js genericpageslider-css">'. do_shortcode($content) .'</div>
				     </div>
                </div>';

}
add_shortcode('portfolio_slider_cont', 'portfolio_slider_cont');

function slider_cont($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div>' . do_shortcode($content) . '</div>';

}
add_shortcode('slider_cont', 'slider_cont');


function full_width_img($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    $cap_cont= $atts['cap_cont'];
    return '<div class="outContain"><div class="fullslider">' . do_shortcode($content) . '<div class="imagecap"><div class="container">'.$cap_cont.'</div></div></div></div>';

}
add_shortcode('full_width_img', 'full_width_img');

function portfolio_banner($atts, $content = null) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content = shortcode_empty_paragraph_fix($content);
   $content = str_replace("<p></p>","",$content);
$content = str_replace("<p>","",$content);
$content = str_replace("</p>","",$content);
$content = str_replace("<br>","",$content);
$text = do_shortcode($content);
$text = str_replace("<br>","",$text);
   return '<div class="singlebanner"><div class="container-stretched">'.$text.'</div></div>';

}
add_shortcode('portfolio_banner', 'portfolio_banner');

add_filter('the_content', 'remove_empty_p',99999);
function remove_empty_p($content){
    $content = force_balance_tags($content);
    $content = str_replace("<p></p>","",$content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}

add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function tgm_io_shortcode_empty_paragraph_fix( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}

/*function portfolio_banner($atts, $content = null) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content = shortcode_empty_paragraph_fix($content);
   $content = do_shortcode($content);
   preg_match('/src="([^"]+)/i', $content, $result);
   $imgSrc = str_replace('src="', '', $result[0]);
   // return   $content;
   return '<a class="popup-image" href="'.$imgSrc.'"><img src= "'.$imgSrc.'" alt="image" /></a>';
}
add_shortcode('portfolio_banner', 'portfolio_banner');*/

function banner_desc($atts, $content = null) {
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
    $content = shortcode_empty_paragraph_fix($content);
    return '<div class="slideCap">' . do_shortcode($content) . '</div>';

}
add_shortcode('banner_desc', 'banner_desc');

function banner($atts, $content = null) {
    global $wpdb;
    $banner_group = preg_replace('#^<\/p>|<p>$#', '', $content);

    $bannersql = "SELECT * FROM `" .$wpdb->prefix. "bannerize` WHERE `group` = '" . $banner_group . "' and   enabled='1' and `trash`='0' order by sorter ASC";
    $bannerresults = $wpdb->get_results($bannersql);
    $data='<div class="outContain group-' . $banner_group . '">
            <div class="fullslider">
            <div class="slideImg">';
                foreach($bannerresults as $banner){
                    if($banner->url){
                        $data.='<div>
                                <div class="image-slider">
                                    <img src="'.$banner->filename.'" alt="'.$banner->title.'">
                                </div>';
                        if($banner->description!=""){
                         $data.='<div class="slideCap">' .$banner->description.'</div>';
                     }
                         $data.='</div>';
                    }else{
                        $data.='<div>
                                  <div class="image-slider">  <img src="'.$banner->filename.'" alt="'.$banner->title.'"> </div>' ;
                                       if($banner->description!=""){
                         $data.='<div class="slideCap">' .$banner->description.'</div>';
                     }
                               $data.='</div>';
                    }
                }
            $data.='</div>
                </div>
            </div>';

  return $data;

}
add_shortcode('banner', 'banner');

// function banner($atts, $content = null) {
//     global $wpdb;
//     $banner_group = preg_replace('#^<\/p>|<p>$#', '', $content);

//     $bannersql = "SELECT * FROM `" .$wpdb->prefix. "bannerize` WHERE `group` = '" . $banner_group . "' and   enabled='1' and `trash`='0' order by sorter ASC";
//     $bannerresults = $wpdb->get_results($bannersql);
//     $data='<div class="outContain group-' . $banner_group . '">
//             <div class="fullslider">
//             <div class="slideImg">';
//                 foreach($bannerresults as $banner){
//                     if($banner->url){
//                         $data.='<div>
//                                 <a class="popup-image" href="'.$banner->filename.'">
//                                     <img src="'.$banner->filename.'" alt="'.$banner->title.'">
//                                 </a>';
//                         if($banner->description!=""){
//                          $data.='<div class="slideCap">' .$banner->description.'</div>';
//                      }
//                          $data.='</div>';
//                     }else{
//                         $data.='<div>
//                                   <a class="popup-image" href="'.$banner->filename.'">  <img src="'.$banner->filename.'" alt="'.$banner->title.'"> </a>' ;
//                                        if($banner->description!=""){
//                          $data.='<div class="slideCap">' .$banner->description.'</div>';
//                      }
//                                $data.='</div>';
//                     }
//                 }
//             $data.='</div>
//                 </div>
//             </div>';

//   return $data;

// }
// add_shortcode('banner', 'banner');

function form_shorcode($atts, $content = null) {
    $form = '<form name="talktousName" id="talktous_frm" method="post" action="">
        <div class="form-wrap">
            <div class="form-row">
                <label class="floating-item" data-error="Please enter your name">
                    <input type="text" name="username" id="username" class="floating-item-input input-item" value="" maxlength="150"/>
                    <span class="floating-item-label">Name</span>
                </label>
            </div>
            <div class="form-row">
                <label class="floating-item" data-error="Please enter your phone number">
                    <input type="text" name="phone" id="phone" class="floating-item-input input-item" value="" maxlength="15"/>
                    <span class="floating-item-label">Phone</span>
                </label>
            </div>
            <div class="form-row">
                <label class="floating-item" data-error="Please enter your email address" data-email-error="Please enter a valid email address">
                    <input type="email" name="email" id="email" class="floating-item-input input-item" value="" maxlength="150"/>
                    <span class="floating-item-label">Email</span>
                </label>
                 <div class="notvalid-error-message">Please enter a valid email address</div>
            </div>
            <div class="form-row">
                <label class="floating-item" data-error="Please enter your city">
                    <input type="text" name="city" id="city" class="floating-item-input input-item" value="" maxlength="150"/>
                    <span class="floating-item-label">City</span>
                </label>
            </div>
             <div class="form-row">
                <label class="floating-item" data-error="Please enter your message">
                    <textarea class="floating-item-input input-item " name="tellusyourstory" id="tellusyourstory" rows="7" value="" maxlength="5000"></textarea>
                    <span class="floating-item-label">Message</span>
                </label>
            </div>
            <div class="form-row">
                <input type="hidden" id="selected_category" name="selected_category" value="">
                <input type="text" id="user_data" name="user_data" value="">
                <input type="text" id="madebyfire_data" name="'.date('ymmddY').'" value="'.date('ymmddY').'">
                <button class="btn btn-secondary btnSubmit button-submit">Send my enquiry</button>
            </div>
        </div>
    </form>';
        return $form;
    }
add_shortcode('contact_form', 'form_shorcode');

function underline_bottom($atts, $content = null) {
     return "<div class='borderBottom'></div>";
    }
add_shortcode('underline_bottom', 'underline_bottom');


/* Login code start here */

    global $login_error;
    global $user_current_role;
    if( isset($_POST['loginname']) && isset($_POST['userpassword']) ):

            $creds = array( 'user_login' =>  $_POST['loginname'], 'user_password' => $_POST['userpassword'] );
            $user = wp_signon( $creds, false );
            if ( !is_wp_error($user) ) {
                wp_set_current_user($user->ID);
                if($user->ID) {

                $userroles = $user->caps;
                $rolecount = count($userroles);
                if($rolecount > 1) {
                    foreach($userroles as $rolekey => $roleval) {

                    }
                }
                else {

                    $user_current_role = key($userroles);
                }

                }
                if(isset($_POST['redirect_url']) && $_POST['redirect_url']!=''){

                    $get_redirect_url = base64_decode($_POST['redirect_url']);
                    wp_redirect($get_redirect_url);
                    exit;
                } else {
                return $user;
                }
            } else {
            $login_error = 'Please check your login details';
            }
    endif;

    function get_links_current_post($post_id, $post_type, $link_type)
{
    $post_url = "";
    $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1,
            'fields' => 'ids'
            );

    $post_lists = get_posts($args);
    $array_count = count($post_lists);
    $key = array_search($post_id, $post_lists);
    if($link_type == "next")
    {
        $current_key = $key + 1;
        if($array_count==$current_key)
        {
            $current_key = 0;
        }
    }
    else
    {
        $current_key = $key - 1;
        if($current_key<0)
        {
            $current_key = $array_count - 1;
        }
    }
    $current_value = $post_lists[$current_key];
    if($current_value != $post_id)
    {
        $post_url = get_permalink($current_value);
    }
   return $post_url;
}
add_filter( 'wp_nav_menu_items', 'add_logout_link', 10, 2 );

function add_logout_link( $items, $args ) {
   //if ($args->theme_location == 'primary') {
      if (is_user_logged_in()) {
         $items .= '<li><a href="'. wp_logout_url(home_url()) .'">'. __("Log Out") .'</a></li>';
      }
  // }
   return $items;
}
?>
