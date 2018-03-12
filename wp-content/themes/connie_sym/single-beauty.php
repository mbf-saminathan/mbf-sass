<?php 
get_header();
get_header('subpage');
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$imageId = MultiPostThumbnails::get_post_thumbnail_id('beauty', 'beau_banner', $post->ID);
$imageUrl = wp_get_attachment_url($imageId, NULL);
$defImg = get_option('defBanImg');
$breadcrumbDetails = get_option('bcn_options',true);
$root = "apost_" . $post->post_type . "_root";
$pageRoot = $breadcrumbDetails[$root];
$pageRootImgId = MultiPostThumbnails::get_post_thumbnail_id('page', 'page_banner', $pageRoot);
$rootImgUrl = wp_get_attachment_url($pageRootImgId, NULL);
$imageUrl = $featImage == "" ? ($rootImgUrl?$rootImgUrl:$defImg) : $featImage;

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
<div class="mobile-heading tab-show">
	<h6>
		<?php echo date('jS F Y', strtotime($post->post_date)); ?>
	</h6>
	<h2>
		<?php echo $post->post_title; ?>
	</h2>
</div>
<?php if($imageUrl!=''){ ?><
<section class="generic generic-breakfastSection">
  <div class="container">
     <div class="row">
        <div class="col-5 content-block">
            <h1><?php echo $post->post_title; ?></h1>
            <?php //echo apply_filters('the_content',$post->post_content); ?>
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
<?php } ?>
<div class="container">
	<section class="generic">
		<div class="row">
			<div class="col-9">
				<div class="desktop-view">
					<h6><?php echo date('jS F Y', strtotime($post->post_date));; ?></h6>
					<h2>
						<?php echo $post->post_title; ?>
					</h2>
		        </div>
				<?php 
					echo apply_filters('the_content',$post->post_content  ); 
				?>
			</div>
			<?php
				get_sidebar('share');
			?>
		</div>
	</section>
</div>
<?php
	get_footer();
?>