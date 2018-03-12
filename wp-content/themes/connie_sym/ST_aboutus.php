<?php 
/*
*Template Name:About us Template
*/
get_header();
get_header('subpage');
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$imageId = MultiPostThumbnails::get_post_thumbnail_id('page', 'page_banner', $post->ID);
$imageUrl = wp_get_attachment_url($imageId, NULL);
$defImg = get_option('defBanImg');
$imageUrl = $imageUrl == "" ? $defImg : $imageUrl;
?>
<div class="breadcrumbs desktop-view">
	<div class="container">			
    	<ul>
			<?php 
	            if (function_exists('bcn_display')) {
	                bcn_display();
	            }
	        ?>
    	</ul>
	</div>
</div>
<div class="container">

	<?php echo apply_filters('the_content',$post->post_content); ?>

</div>
<?php
	get_footer();
?>