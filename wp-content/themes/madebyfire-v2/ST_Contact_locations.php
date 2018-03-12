<?php 
/*
* Template Name: Contact locations
*/
$postDetails = get_post($postId);
?>
<section class="sub-introcontent">
    <div class="container">  
        <div class="row">
            <div class="col-xs-8"> 
                <div class="introCaption">                      
                    <h1><?php echo $postDetails->post_title; ?></h1>
                    <?php  echo apply_filters('the_content', $postDetails->post_content); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="portfolioSection">
<?php
	$postArgs = array(
        'post_type' => 'location',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'numberposts' => -1,
        );
	$related_posts = get_posts($postArgs);
	if(count($related_posts)>0){
?>
<div class="work-company">
<div class="container">
	<div class="portfolioItems section">
		<?php foreach ($related_posts as $related_post){
                $curTerm = wp_get_post_terms($related_post->ID, $taxonomy, array("fields" => "slugs"));
                $termSlugs = implode(" ",$curTerm);
                $iconImageID = wp_get_attachment_url(get_post_thumbnail_id($related_post->ID));
                $alt_img = get_post_meta(get_post_thumbnail_id($related_post->ID), '_wp_attachment_image_alt', true);
                if($imageUrl=="")
                {
                    $imageUrl = get_bloginfo('template_url')."/images/default-img.png";
                }
                $homeBannerURL = get_the_post_thumbnail_url($related_post->ID);
                if($homeBannerURL=="")
                {
                    $homeBannerURL = get_bloginfo('template_url')."/images/default-img.png";
                }
            ?>
		<div class="news-card">
			<a href="<?php echo get_permalink($related_post->ID);?>" >
			<div class="news-cardOuter">
				<div class="news-cardInner">
					<?php if($imageUrl!=""){ ?>
            			<img src="<?php echo $iconImageID; ?>" alt="<?php echo $alt_img; ?>">
        			<?php } ?>
					<div class="news-desc">
						<h4><?php echo $related_post->post_title; ?></h4>
						<p><?php echo $related_post->post_excerpt;  ?></p>
					</div>
				</div>
			</div>
        	</a>
		</div>
		<?php } ?>
	</div>
</div>
</div>
<?php } ?>
</section>