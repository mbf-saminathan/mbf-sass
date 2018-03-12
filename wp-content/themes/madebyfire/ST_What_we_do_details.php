<?php 
/***********************
Template Name: what we do details
************************/
get_header();
get_header('new');
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$args = array('order' => 'ASC', 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
$sidebar_links = get_post_meta($post->ID, 'sidebar_links', true);
$nav_menu = wp_get_nav_menu_object($sidebar_links);
$menus = wp_get_nav_menu_items($nav_menu->name, $args);
?> 
<!-- Google Code for MbF - Conatct us Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 923366436;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "4HwACI6C_msQpOiluAM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/923366436/?label=4HwACI6C_msQpOiluAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
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
            <div class="container">
                <div class="row border-line <?php /* if(($sidebar_links !='') && (count($menus) > 0)) { echo 'sidebar'; } else { echo ''; } */ ?>">
                <div class="col-xs-8 generic brand-identity-design">
                    <h1><?php echo $post->post_title; ?></h1>
                    <?php /* <p><?php echo $post->post_content; ?></p> */ ?>
                    <div><?php echo apply_filters('the_content', $post->post_content); ?></div>
                </div>
                  <?php get_sidebar('related_link'); ?>
                  <div class="wrapblk"></div>
              </div>
            
            </div>
        </div>
        <?php
        $assigned_case_studies = get_post_meta($post->ID, 'assigned_case_studies', true);
        //print_r($assigned_case_studies);
        if($assigned_case_studies != '') {
        ?>
        <div class="portfolio-company text-center">
            <div class="container">
                <div class="portfolioItems">
                    <?php foreach($assigned_case_studies as $case_study) { 
                         $study = get_post($case_study);
                         $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'icon-image', $study->ID);
                $imageUrl =  wp_get_attachment_url($iconImageID, NULL);
                        ?>
                    <div class="element-item mobile-app">
                        <div class="pro-box">
                                <a href="<?php echo get_permalink($study->ID); ?>">
                                <?php if($imageUrl !='') { ?>
                                <img src="<?php echo $imageUrl; ?>" alt="">
                                <?php } ?>
                                <p><?php echo $study->post_excerpt; ?></p>
                               </a>
                        </div>
                    </div>
                  <?php } ?>
                </div>
            </div>
        </div>
		<script>
        var d = document.getElementById("what_we_do");
        d.className += " active";
        </script>
       <?php 
    }
       get_footer(); ?>
