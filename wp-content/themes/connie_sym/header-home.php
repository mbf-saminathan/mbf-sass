<?php
      $args = array('order' => 'ASC','menu_item_parent' => 0, 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
      $mainMenuItems = wp_get_nav_menu_items('mainmenu', $args);
      $menuCount = count($mainMenuItems);

      $subDivision = ceil($menuCount/2);

      if($menuCount>0)
        {
          $count =0;
    ?>
    <header>
      <a href="#" class="logo"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" alt="pagelogo" /></a>
      <nav class="menu-open">
        <a href="<?php echo get_bloginfo('url'); ?>" class="menu-close"><i class="fa fa-times" aria-hidden="true"></i></a>
        <ul class="nav-left">
          <?php 
            foreach ($mainMenuItems as $key => $mainMenuItem) {
              if($count == $subDivision){
                echo '</ul><ul class="nav-right">';
              }
           ?> 
          <li><a href="<?php echo $mainMenuItem->url; ?>" title="<?php echo $mainMenuItem->title; ?>"><?php echo $mainMenuItem->title; ?></a></li>
        
        <?php
        $count++;
         } 
         ?>
      </nav>
      <?php 
        }
      ?>
      </ul>
      <div class="menu-toggle">
        <div class="hamBurger"></div>
        <div class="hamBurger"></div>
        <div class="hamBurger"></div>
      </div>
    </header>