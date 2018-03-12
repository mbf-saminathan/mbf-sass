<?php  $template = get_page_template_slug( $post->ID ); ?>
    <div id="subPage" class="portfolioPage">
        <header>
            <div class="container">
                <div class="logo">
                    <a href="<?php echo get_site_url().'/'; ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logosub.png" alt=""></a>
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