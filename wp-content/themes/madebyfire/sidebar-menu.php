<?php
$args = array('order' => 'ASC', 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
$sidebar_links = get_post_meta($post->ID, 'sidebar_links', true);
$nav_menu = wp_get_nav_menu_object($sidebar_links);
$menus = wp_get_nav_menu_items($nav_menu->name, $args); 
if(($sidebar_links !='') && (count($menus) > 0)) {
?>
    
    <div class="col-xs-4 generic sidebar--line">
        <div class="asideBorder"></div>
        <ul>
         <?php
            foreach ($menus as $menu) {
                if($menu->object_id != $post->ID) { 
          ?>
            <li><a href="<?php echo $menu->url; ?>"><?php echo $menu->title; ?></a></li>
            <?php
                }
            } ?>
        </ul>
        <div>
            <?php
            $sidebar_title = get_post_meta($post->ID, 'sidebar_title', true);
            $sidebar_content = get_post_meta($post->ID,
                    'sidebar_content_options_design', true);
            ?>
            <?php
            if (isset($sidebar_content) && $sidebar_content != '') {
                echo "<h1>" . $sidebar_title . "</h1>";
                echo "<p>" . $sidebar_content . "</p>";
            } else {
                ?>
                <h1>Send us an enquiry</h1>
                <p>If you’d like to know how we can help you accelerate the design and build of your digital product, then please get in touch with us.</p>
            <?php } ?>
            <p><a href="<?php echo get_bloginfo('url'); ?>/contact-us/" class="btn btn-secondary btn-fluid">Contact us</a></p>
        </div>
     </div>
     <?php } ?>
