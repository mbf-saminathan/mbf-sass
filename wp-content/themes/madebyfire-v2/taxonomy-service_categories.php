<?php 
get_header();
get_header('new');
global $post;
$link_array = explode('/',$_SERVER['REQUEST_URI']);
$page_title=$link_array[count($link_array)-2];
$curr_term_id = get_queried_object()->term_id;
$post_term=get_queried_object();
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$ptTax = $wp_taxonomies[$post_term->taxonomy]->object_type;
/*if ($page_title == 'all'){
    header('Location: '.get_bloginfo('url').'/portfolio');
  }
*/$breadcrumbDetails = get_option('bcn_options',true);
$root = "apost_" . $ptTax[0] . "_root";
$pageRoot = $breadcrumbDetails[$root];
if ($page_title == 'all'){
    header('Location: '.get_bloginfo('url').'/service');
  }
  $rn_link_text = get_post_meta($pageRoot, 'rn_link_text', true);   
$rn_link_url = get_post_meta($pageRoot, 'rn_link_url', true);
$rn_link_target = get_post_meta($pageRoot, 'rn_link_target', true);
$link_heading = get_post_meta($pageRoot, 'link_heading', true);
?>
<section class="wrapperBg">
	<div class="container">  
		<div class="row equaldiv">
			<div class="col-xs-8">  
				<div class="breadCrumb">
					<ul>
						<?php
				            if (function_exists('bcn_display')) {
				                bcn_display();
				            }
			            ?>
					</ul>
 			</div>     			
				<div class="introCaption">						
					<h1><?php echo $post_term->name; ?></h1>
        			<?php echo $post_term->description; ?>
				</div>
			</div>
		</div>	
	</div>
</section>
<section class="portfolioSection">
	<?php 
    	$postArgs = array(
            'post_type' => 'service',
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
			                $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('service', 'icon-image', $related_post->ID);
			                $imageUrl =  wp_get_attachment_url($iconImageID, NULL);
			                $imgAlt = get_post_meta($iconImageID, '_wp_attachment_image_alt', true);
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
					<div class="news-card <?php echo $termSlugs; ?>">
						<div class="news-cardOuter">
							<div class="news-cardInner">
								<a href="<?php echo get_permalink($related_post->ID);?>" >
									<?php if($imageUrl!=""){ ?>
                            			<img src="<?php echo $imageUrl; ?>" alt="<?php // echo $imgAlt; ?>">
                        			<?php } ?>
									<div class="news-desc">
										<h4><?php echo $related_post->post_title; ?></h4>
										<p><?php echo $related_post->post_excerpt;  ?></p>
									</div>
								</a>
							</div>
						</div>
					</div>
					<?php 
					} ?>
				</div>
			</div>			
		</div>
	<?php } ?>
	</section>
<?php get_footer('sub'); ?>