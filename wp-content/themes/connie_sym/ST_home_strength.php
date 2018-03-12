<?php
/*
Template Name: Home(Strength)
*/

$homeAbtStr = get_post($postId);
$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($postId));
$linkHeading = get_post_meta($postId, 'linkHeading', true);
$rlLinkUrl = get_post_meta($postId, 'rlLinkUrl', true);
$linkHeading = $linkHeading==''?'View More':$linkHeading;
?>
<!-- About starting strength -->
	<section class="section wrap-row starting-section">
		<div class="starting-topContent border-row">
			<div class="row">
				<div class="col-6">
   					<img src="<?php echo $imgUrl; ?>" alt="starting-image" class="book-image" />
   		   		</div>
   				<div class="col-6 about-content-block">
   					<h1><?php echo $homeAbtStr->post_title; ?> </h1>
   					<?php echo apply_filters('the_content',$homeAbtStr->post_content); ?>
   					<?php 
					if($linkHeading != '' && $rlLinkUrl != ''){ ?>
						<a href="<?php echo $rlLinkUrl; ?>" class="button button-primary"><?php echo $linkHeading; ?></a>
					<?php } ?>
   				</div>
			</div>
	   </div>
	</section>
</div>
<!-- End of starting section -->