<?php  $template = get_page_template_slug( $post->ID ); ?>
    <div id="subPage" class="portfolioPage">
        <header>
            <div class="container">
                <div class="logo">
                    <a href="<?php echo get_site_url().'/'; ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/images/made-by-fire-digital-agency.png" alt="Made by Fire Digital Agency UK and India"></a>
                </div>
                <?php 
                if (is_user_logged_in()) {
                ?>
                <div class="logOut fR">
                    <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="fR">LOG OUT</a>
                </div>                
                <?php } ?>
            </div>
        </header>