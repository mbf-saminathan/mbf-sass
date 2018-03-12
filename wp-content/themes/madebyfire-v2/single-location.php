<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Madebyfire
 * @since Madebyfire 1.0
 */
get_header();
get_header('new');
$secoundry_img = wp_get_attachment_url(get_post_thumbnail_id($post->ID) );
$header_url = wp_get_attachment_url($secoundry_img, NULL);
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
if ($header_url != ""):
    ?>            
    <img src="<?php echo $header_url; ?>" class="fullImg post_img" alt="<?php echo $post->post_title; ?>">
<?php 
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
<div class="mainLanding">
    <div class="container">
        <div class="row equaldiv">
            <div class="col-xs-10">
                <div class="contentCustom <?php echo $mrg_class; ?> generic">
                    <?php
                    $post_author = get_userdata($post->post_author);
                    ?> 
                    <h1><?php echo $post->post_title; ?></h1>
                    <?php echo apply_filters('the_content', $post->post_content); ?>   
                    
                </div>
            </div>
            <div class="col-xs-2 no-padding">
                <div class="sticky">
                    <?php 
                    if($link_heading!=''){
                    ?>
                        <h5><?php echo $link_heading; ?></h5>
                    <?php } ?>
                    <ul>
                        <?php
                            foreach ($rn_link_text as $key => $rn_link_text) {
                        ?>
                        <li>
                            <a href="<?php echo $rn_link_url[$key]; ?>" target="<?php echo $rn_link_target[$key]; ?>">
                                <?php echo $rn_link_text; ?>
                            </a>
                        </li>
                       <?php 
                            }
                         ?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer('sub'); ?>
