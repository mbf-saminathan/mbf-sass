<?php
/*
*Template Name:Home(Articles)
*/
$homeArticles = get_post($postId);
$linkHeading = get_post_meta($postId, 'linkHeading', true);
$rlLinkUrl = get_post_meta($postId, 'rlLinkUrl', true);
$linkHeading = $linkHeading==''?'View More':$linkHeading;
?>
<!-- 	client section -->
 <section>
 	<div class="client-content">
	 	<div class="container">
				<div class="col-10 center-block content-center">
       			<h1><?php echo $homeArticles->post_title; ?></h1>
				<?php echo apply_filters('the_content',$homeArticles->post_content); ?>
	 		</div>
 			<div class="slider-side">
 				<div class="client-slider">
				    <?php
	                $homArtArgs = array(
			                          'post_type' => 'articles',
			                          'order'         => 'ASC', 
			                          'orderby'       => 'menu_order', /* we can use it date order also.. */
			                          'post_status'   => 'publish',
			                          'numberposts' => -1,
			                       );
                	$homArts = get_posts($homArtArgs);
		                foreach ($homArts as $key => $homArt) {
		                	$homArtUrl = wp_get_attachment_url(get_post_thumbnail_id($homArt->ID));
		                	$linkHeading = get_post_meta($homArt->ID, 'linkHeading', true);
			                	?>
		 						<img src="<?php echo $homArtUrl; ?>" alt="client-img">
		 				<?php } ?>
 				</div>
			</div>
		</div>
 	</div>
 </section>
		<!--  end of client section -->