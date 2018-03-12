<?php  $template = get_page_template_slug( $post->ID ); ?>
    <div id="subPage" class="portfolioPage">
        <header>
        <div class="container">
        <div class="logo">
            <a href="<?php echo get_site_url().'/'; ?>">
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/logosub.png" alt="">
            </a>
        </div>
        <?php
        $args = array('order' => 'ASC','menu_item_parent' => 0, 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
        $mainMenuItems = wp_get_nav_menu_items('Main_menu', $args);
        $menuCount = count($mainMenuItems);
        $subDivision = ceil($menuCount/2);
        if($menuCount>0)
        {
            $count =0;
        ?>
            <nav class="clearfix deskMenu">
                <div class="menuBlk fL">
                    <ul class="fR clearfix">
                        <?php foreach($mainMenuItems as $mainMenuItem){ 
                            if($count==$subDivision)
                            {
                                echo '</ul></div><div class="menuBlk fR"><ul class="clearfix fL">';
                            }
                        ?>
                        <li <?php if($post->ID==$mainMenuItem->object_id || $post->post_type==strtolower($mainMenuItem->title)){ echo 'class="active"'; }?>><a href="<?php echo $mainMenuItem->url; ?>" ><?php echo $mainMenuItem->title; ?></a></li>
                        <?php $count++;} ?>                        
                    </ul>
                </div>
            </nav>
        <?php
        } ?>
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

                    wp_nav_menu( $mainMenuArgs ); ?>
        </div>
        </header>