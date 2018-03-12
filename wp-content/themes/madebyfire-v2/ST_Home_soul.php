<?php 
/***********************
Template Name: Home Soul
************************/

$postDetails = get_post($postId);
$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($postId));
$alt_img = get_post_meta(get_post_thumbnail_id($postId), '_wp_attachment_image_alt', true);
?>
<section class="section light-wrapper-center">
	<div class="container">
		<h2><?php echo $postDetails->post_title; ?></h2>
		<div class="col-xs-6 center-block">
			<?php echo apply_filters('the_content', $postDetails->post_content); ?>
		</div>
	</div>
	<img src="<?php echo $imgUrl; ?>" alt="<?php echo $alt_img; ?>">
</section>