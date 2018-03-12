
<?php 
/*
* Template Name: Home page
*/
get_header();
get_header('home');
$homeId = $post->ID;
$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($homeId));
$homePost = get_post($homeId);
$tweetUrl = get_option('twitter');
$fbUrl   = get_option('facebook');
$instaUrl = get_option('instagram');
$defIcnImg = get_option('defIcnImg');
$HomeSubPageArgs = array( 
                'post_parent'  => $homeId, /* for creating sub pages */
                'post_type'     => 'page', 
                'order'         => 'ASC', 
                'orderby'       => 'menu_order', /* we can use it date order also.. */
                'post_status'   => 'publish',
                'numberposts'   => -1   
        ); 
$HomeSubPages = get_posts($HomeSubPageArgs);

?>
	<section class="banner" style="background-image:url(<?php echo $imgUrl; ?>);">
		<div class="banner-content">
			<div class="col-10 center-block">
				<h1><?php echo $homePost->post_title; ?></h1>
				<div><img class="arrow-img" src="<?php echo get_bloginfo('template_url'); ?>/images/arrow.png" alt="pagelogo" /></div>
			</div>
		</div>
	</section>
	<?php
		if (is_array($HomeSubPages) && count($HomeSubPages)>0) {
		            foreach ($HomeSubPages as $HomeSubPage) {
		                $postId = $HomeSubPage->ID;
		                $pageTemplate = get_post_meta($postId, '_wp_page_template', true);
		                include TEMPLATEPATH .'/'. $pageTemplate; /* showing the template subpages */
		            }
		        } 
	?>
<?php
	get_footer();
?>