 <?php  $template = get_page_template_slug( $post->ID ); ?>
 <div id="subPage" class="portfolioPage <?php echo $cls_404 = is_404()?'nopage':''; ?><?php $portfolioList = get_page_template_slug($post->ID); if ($portfolioList == "ST_Portfolionew.php") { echo "wideTemplate"; } ?><?php echo $singPortfolio = is_singular("portfolio")||is_singular("news")||( is_page() && $post->post_parent )?'portfolioSingle wideTemplate':''; ?>">
    <div class="theme-globalerror">
            <div class="container">
                Oops! There seems to be some mistakes in your submission. Please see below.
            </div>
            <i class="fa fa-times-circle close-button"></i>
        </div>
        <header>
            <div class="container">
              <?php
              /*For responsive back button */
                if(!is_home()){

                  $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                  // $prev_url =
                  // $url['scheme']
                  // . "://"
                  // . $url['host']
                  // . pathinfo($url['path'], PATHINFO_DIRNAME );
                  // var_dump($result);
                  // // var_dump(get_permalink($post->ID));
                   $current_url = explode('/', $url);
                   $current_url =array_filter($current_url);
                   array_pop($current_url);

                   $prev_url = implode('/', $current_url);

                    $prev_url = str_replace("http:/", "http://", $prev_url);
                    if(is_tax('portfolio_categories')){
                      $prev_url = get_home_url()."/portfolio/";
                    }else{
                      $prev_url = str_replace("http:/", "http://", $prev_url);
                    }

                }

                /*$redirUrl = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER']:get_home_url();*/

               ?>
				<a href="<?php echo $prev_url; ?>" class="mobile-show"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <?php if(is_singular("portfolio")){ ?>
                    <h2><a href="<?php echo get_home_url(); ?>/portfolio/">Portfolio</a></h2>
                    <?php }elseif(is_singular("news")){ ?>
                      <h2><a href="<?php echo get_home_url(); ?>/news/">News</a></h2>
                    <?php }elseif ( is_page() && $post->post_parent ){ ?>
                        <h2><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a></h2>
                      <?php } ?>
                    <div class="logo fL">
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
                <div class="menuBlk">
                    <ul>
                        <?php foreach($mainMenuItems as $mainMenuItem){
                            // if($count==$subDivision)
                            // {
                            //     echo '</ul></div><div class="menuBlk fR"><ul class="clearfix fL">';
                            // }
                        $parent_id = wp_get_post_parent_id( $post_ID );
                        ?>
                        <li id="<?php echo  strtolower(str_replace(' ', '_', $mainMenuItem->title)); ?>" <?php if($post->ID==$mainMenuItem->object_id || $mainMenuItem->object_id==$parent_id || $post->post_type==strtolower($mainMenuItem->title)){ echo 'class="active "'; }?>><a href="<?php echo $mainMenuItem->url; ?>" ><?php echo $mainMenuItem->title; ?></a></li>
                        <?php } ?>

<?php /*if (is_user_logged_in()) { ?>
                        <li><a href="<?php echo wp_logout_url(home_url()) ?>">Log Out</a></li>        <?php } */ ?>
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
