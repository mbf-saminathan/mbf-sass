<?php 
/***********************
Template Name: Swivel template
************************/
get_header();
get_header('new');
$pages = get_posts(array('post_parent' => $post->ID, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order', 'numberposts' => -1));
$args = array('order' => 'ASC', 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
$sidebar_links = get_post_meta($post->ID, 'sidebar_links', true);
$nav_menu = wp_get_nav_menu_object($sidebar_links);
$menus = wp_get_nav_menu_items($nav_menu->name, $args); 
?>
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
        <div class="mainLanding portfolio-head " >
            <div class="container">
                <div class="row border-line <?php if(($sidebar_links !='') && (count($menus) > 0)) { echo 'sidebar'; } else { echo ''; } ?>">
                  <div class="col-xs-8">
                    <h1><?php echo strtoupper($post->post_title); ?></h1>
                   <?php /* <p><?php echo $post->post_content; ?></p> */ ?>
                    <div><?php echo apply_filters('the_content', $post->post_content); ?></div>
                   <?php /* if (isset($pages) && $pages!='') { ?>
                       
                    <div class="what-we-do">
                        <ul>
                            <?php foreach($pages as $sub_page) { ?>
                            <li><a href="<?php echo get_permalink($sub_page->ID); ?>"><?php echo $sub_page->post_title; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                   <?php } */ ?>
                </div>
 <?php echo get_sidebar('menu'); ?>
              </div>
            </div>
        </div>
          <?php get_footer(); ?>
