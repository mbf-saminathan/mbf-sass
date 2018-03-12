<?php  $template = get_page_template_slug( $post->ID ); ?>
    <div id="subPage" class="portfolioPage <?php is_page_template('ST_Contact-us.php')?"contactUs":""?>>
        <header class="subpageheader">
        <div class="container">
        <div class="row">
        <div class="col-xs-1">
        <div class="logo">
            <a href="<?php echo get_site_url().'/'; ?>">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/made-by-fire-digital-agency.png" class="desktop-logo" alt="Made by Fire Digital Agency UK and India">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/logo-mob.png" class="mobile-logo" alt="">
            </a>
        </div>
        </div>
        <?php
        $args = array('order' => 'ASC','menu_item_parent' => 0, 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
        $mainMenuItems = wp_get_nav_menu_items('Main_menu', $args);
        $menuCount = count($mainMenuItems);
        $subDivision = ceil($menuCount/2);
        if($menuCount>0)
        {
            
        ?>
        <div class="col-xs-11">
            <nav class="deskMenu">
                <div class="menuBlk">
                    <ul>
                        <?php foreach($mainMenuItems as $mainMenuItem){ 
                            
                        ?>
                        <li <?php if($post->ID==$mainMenuItem->object_id || $post->post_type==strtolower($mainMenuItem->title) || (is_tax('portfolio_categories') && $mainMenuItem->title =="Work")){ echo 'class="active"'; }?>><a href="<?php echo $mainMenuItem->url; ?>" ><?php echo $mainMenuItem->title; ?></a></li>
                       <?php } ?> 
                    </ul>
                </div>
            </nav>
        <?php
        
        } 
        ?>
        <div class="menuHum">
            <span><!-- --></span>
            <span><!-- --></span>
            <span><!-- --></span>
        </div>
       <?php $mainMenuArgs = array(
                        'theme_location'  => 'Main Navigation',
                        'menu'            => 'Main_menu',
                        'container'       => 'div',
                        'container_class' => 'mobiMenu',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'menu_id'         => '',
                        'echo'            => true,
                        //'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 1,
                        'walker'          => ''
                    );

                    wp_nav_menu( $mainMenuArgs ); 
                    ?>
        </div>
    </div>
</div>
        </header>