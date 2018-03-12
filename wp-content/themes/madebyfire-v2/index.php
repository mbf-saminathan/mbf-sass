<?php
/***********************
Template Name: Home page
************************/
get_header();
get_header('home');
?>

    
    <section class="home-banner">
        <?php 
            $homeId = $post->ID;
            $home = get_post($homeId);
            $imgUrl = wp_get_attachment_url(get_post_thumbnail_id($homeId));
            $imageid = MultiPostThumbnails::get_post_thumbnail_id('page', 'secondary-image', $homeId);
            $mobImgUrl = wp_get_attachment_url($imageid);
            $alt_img = get_post_meta(get_post_thumbnail_id($homeId), '_wp_attachment_image_alt', true);
        ?>
        <img src="<?php echo $imgUrl; ?>" alt="<?php echo $alt_img; ?>" class="desktop-banner">
        <img src="<?php echo $mobImgUrl; ?>" alt="<?php echo $alt_img; ?>" class="mobile-banner">
       <div class="home-banner-content">
                <?php echo apply_filters('the_content', $home->post_content); ?>
        </div>
    </section>
    <?php 
        $subPageArgs = array( 
                        'post_parent'  => $homeId, /* for creating sub pages */
                        'post_type'     => 'page', 
                        'order'         => 'ASC', 
                        'orderby'       => 'menu_order', /* we can use it date order also.. */
                        'post_status'   => 'publish',   
                ); 
        $subPages = get_posts($subPageArgs);
        
        if (is_array($subPages) && count($subPages)>0) {
            foreach ($subPages as $subPage) {
                $postId = $subPage->ID;
                $pageTemplate = get_post_meta($postId, '_wp_page_template', true);
                include TEMPLATEPATH .'/'. $pageTemplate; /* showing the template subpages */
            }
        } 
    ?>  
        
<?php get_footer("home");?>
