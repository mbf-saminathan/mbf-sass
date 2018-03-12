<?php
get_header();
get_header('subpage');
$current_user = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$customer_id = $current_user->ID;
?>
<body>
    <div id="subPage">
        <div class="logo text-center">            
            <img alt="<?php echo get_bloginfo('name'); ?>" src="<?php echo get_bloginfo('template_url'); ?>/images/logosub.png">
        </div>
        <?php
        $secoundry_img = MultiPostThumbnails::get_post_thumbnail_id('post', 'secondary-image', $post->ID);
        $header_url = wp_get_attachment_url($secoundry_img, NULL);
        if ($header_url != ""):
            ?>            
            <img src="<?php echo $header_url; ?>" class="fullImg" alt="<?php echo $post->post_title; ?>">
        <?php else: ?>
            <img src="<?php echo get_bloginfo('template_url') . "/images/imgBG1.jpg"; ?>" class="fullImg" alt="<?php echo $post->post_title; ?>">
<?php endif; ?>
        <div class="container">
            <div class="col-xs-8 generic center-block">
                <h1><?php echo ucfirst($current_user->display_name); ?> profile</h1>
                <div>
                    <?php echo get_avatar($current_user->ID, 36); ?>
                </div>                    
                <span class="block author-name"><?php echo $current_user->display_name; ?></span>
                <p><?php echo $current_user->user_email; ?></p>
                
            </div>             
        </div>
            <footer>
                <div class="container text-center">
                    &copy; <?php if (date('Y') == "2015") {
                echo 2015;
            } else {
                echo 2015 - date('Y');
            } ?> made by fire ltd. <span class="mobRight">All rights reserved</span>
                </div>
            </footer>
        <?php
        get_footer();
        ?>