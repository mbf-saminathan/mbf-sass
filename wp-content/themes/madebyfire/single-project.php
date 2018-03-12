<?php
if (!is_user_logged_in()) {
    wp_redirect(get_site_url().'/demos');
    exit;
    } else {
        $external_url_link = get_post_meta($post->ID, 'external_url', true);
        $external_url = ($external_url_link!="")? $external_url_link : get_permalink($post->ID);
        
        $target_option = get_post_meta($post->ID, 'target_option', true);  
        $target = ($target_option=="")? "_self": $target_option;

        if($external_url_link!=''){
            
            //wp_redirect($external_url_link);
            header('Location: '.$external_url_link);
            exit;
        } else {
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Madebyfire
 * @since Madebyfire 1.0
 */
get_header();
get_header('subpage');
$mrg_class = '';
$secoundry_img = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'secondary-image', $post->ID);
$header_url = wp_get_attachment_url($secoundry_img, NULL);
if ($header_url != ""):
    ?>            
    <img src="<?php echo $header_url; ?>" class="fullImg post_img" alt="<?php echo $post->post_title; ?>">
<?php 
    else: 
       // $mrg_class = ' portfolio-margin';
    endif; ?> 
<div class="breadCrumb">
    <div class="container">
        <ul>
            <?php  
            if (function_exists('bcn_display')) {
                bcn_display();
            }
            ?>
        </ul>
    </div>
</div>
<div class="mainLanding portfolio-head">
    <div class="navPager">
 <?php 
    $next_link = get_links_current_post($post->ID, $post->post_type, 'next');
    $previous_link = get_links_current_post($post->ID, $post->post_type, 'previous');
    ?>
        <?php if($previous_link!=""){?>
        <div class="prev"><a href="<?php echo $previous_link; ?>">Previous STORY</a></div>
        <?php } if($next_link!=""){?>
        <div class="next"><a href="<?php echo $next_link; ?>">NEXT STORY</a></div>
        <?php } ?>​
    </div>       
    <div class="container">
        <div class="row">
            <div class="col-xs-8 portfolioh1 contentCustom generic <?php echo $mrg_class; ?>">
                <?php
                $post_author = get_userdata($post->post_author);
                ?> 
                <div class="author"><?php echo $post->post_title; ?></div>
                <h1><?php echo $post->post_excerpt; ?></h1>
                <?php echo apply_filters('the_content', $post->post_content); ?>                
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<?php } } ?>