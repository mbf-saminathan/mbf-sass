<?php
      $args = array('order' => 'ASC','menu_item_parent' => 0, 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
      $mainMenuItems = wp_get_nav_menu_items('mainmenu', $args);
      $menuCount = count($mainMenuItems);
      if($menuCount>0)
        {
          $count =0;
    ?>
    <header class="sub-header">
      <div class="container">
        <div class="row">
          <a href="<?php echo get_bloginfo('url'); ?>" class="sub-logo col-3"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" alt="pagelogo" /></a>
            <nav class="menu-open col-9">
              <a href="#" class="menu-close"><i class="fa fa-times" aria-hidden="true"></i></a>
              <ul class="sub-menu">
                <?php 
                  foreach ($mainMenuItems as $key => $mainMenuItem) {
                 ?> 
                <li>
                  <a href="<?php echo $mainMenuItem->url; ?>" title="<?php echo $mainMenuItem->title; ?>">
                    <?php echo $mainMenuItem->title; ?>
                  </a>
                </li>
              <?php
              $count++;
               } 
               ?>
              </ul>
            </nav>
      <?php 
        } 
      ?>
      <div class="menu-toggle">
        <div class="hamBurger"></div>
        <div class="hamBurger"></div>
        <div class="hamBurger"></div>
        </div>
        </div>
      </div>
    </header>