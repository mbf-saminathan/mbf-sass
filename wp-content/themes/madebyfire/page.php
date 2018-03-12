<?php 
get_header();
get_header('new');
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$args = array('order' => 'ASC', 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
$sidebar_links = get_post_meta($post->ID, 'sidebar_links', true);
$nav_menu = wp_get_nav_menu_object($sidebar_links);
$menus = wp_get_nav_menu_items($nav_menu->name, $args); 
if ($img_url != ""):
    ?>            
    <img src="<?php echo $img_url; ?>" class="fullImg post_img" alt="">
<?php endif; ?>
<section class="wrapperBg">
        <div class="container">  
            <div class="row">
                <div class="col-xs-8">  
                    <div class="breadCrumb">
                        <ul>
                            <?php
                                if (function_exists('bcn_display')) {
                                    bcn_display();
                                }
                            ?>
                        </ul>
                </div>              
                <div class="introCaption">                      
                        <h1>
                            <?php 
                                echo strtoupper(get_the_title()); 
                            ?>
                                
                        </h1>
                            <?php
                                echo apply_filters('the_content', $post->post_content); 
                            ?>
                    </div>
                </div>
            </div>  
        </div>
    </section>
    
<?php get_footer(); ?>
