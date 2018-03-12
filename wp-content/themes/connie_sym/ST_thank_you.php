<?php 
/*
*Template Name: Thank you
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
<section class="generic generic-breakfastSection">
  <div class="container">
     <div class="row">
        <div class="col-5 content-block">
            <h1><?php echo $post->post_title; ?></h1>
            <?php echo apply_filters('the_content',$post->post_content); ?>
        </div>
        <?php if($imageUrl) { ?>
          <div class="col-7">
              <div class="section-img border-row"> 
                <img src="<?php echo $imageUrl; ?>">
                
              </div>
          </div>
        <?php } ?>
    </div>
  </div>
</section>
<?php
	get_footer();
?>