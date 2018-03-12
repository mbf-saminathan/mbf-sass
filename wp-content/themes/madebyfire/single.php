<?php
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
        $mrg_class = ' portfolio-margin';
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
<div class="container portfolio-head">
    <div class="row">
        <div class="col-xs-8 contentCustom <?php echo $mrg_class; ?>">
            <?php
            $post_author = get_userdata($post->post_author);
            ?> 
            <h1><?php echo $post->post_title; ?></h1>
            <div class="intro-text"><?php echo $post->post_excerpt; ?></div>
            <?php echo apply_filters('the_content', $post->post_content); ?>                
        </div>
    </div>
</div>

<?php get_footer(); ?>