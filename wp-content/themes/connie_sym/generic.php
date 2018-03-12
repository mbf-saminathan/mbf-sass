<?php
	/*
	*Template Name: Generic
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
<div class="sub-banner">
 	<div class="container">	
			<div class="subpage-banner border-row">
			<img src="<?php echo $imageUrl; ?>" alt="">
		</div>
	</div>
</div>
<section class="generic generic-section">
	<div class="container">
		<div class="row">
			<div class="col-9">
				<div class="row">
					
						<h4>
							<?php echo $post->post_title; ?>
						</h4>
	            		<?php echo apply_filters('the_content',$post->post_content  ); ?>
					
				</div>
			</div>
			<?php
			get_sidebar('share');
			?>
		</div>
	</div>
</section>	
<?php
	get_footer();
?>