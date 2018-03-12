<?php 
/*
* Template Name:Thank you template
*/
get_header();
get_header('new');
?>
<section class="sub-introcontent thank-content">
            <div class="container">  
                <div class="row">
            <div class="col-xs-10">
                <div class="maindiv">  
                    <div class="breadCrumb">
                        <ul>
                            <?php  
                                if (function_exists('bcn_display')) {
                                    bcn_display();
                                }
                                ?>
                        </ul>
                        <h1><?php echo get_the_title(); ?></h1>
                    </div>     
                </div>
                <div class="introCaption">                      
                    <?php  echo apply_filters('the_content', $post->post_content); ?>
                </div>
            </div>
            <div class="col-xs-2 no-padding">
                <div class="sticky">
                    <?php 
                    if($link_heading!=''){
                    ?>
                        <h5><?php echo $link_heading; ?></h5>
                    <?php } ?>
                    <ul>
                        <?php
                            foreach ($rn_link_text as $key => $rn_link_text) {
                        ?>
                        <li>
                            <a href="<?php echo $rn_link_url[$key]; ?>" target="<?php echo $rn_link_target[$key]; ?>">
                                <?php echo $rn_link_text; ?>
                            </a>
                        </li>
                       <?php 
                            }
                         ?> 
                    </ul>
                </div>
            </div>
        </div> 
        </div>
        </section>
        <section class="portfolioSection">
		<?php
			$taxonomy = "portfolio_categories";
			$termArgs = array(
			    'orderby'           => 'name',
			    'order'             => 'DESC',
			    'hide_empty'        => true,
			    'exclude'           => array(),
			    'exclude_tree'      => array(),
			    'include'           => array(),
			    'number'            => '',
			    'fields'            => 'all',
			    'slug'              => '',
			    'parent'            => '',
			    'hierarchical'      => true,
			    'child_of'          => 0,
			    'childless'         => false,
			    'get'               => '',
			    'name__like'        => '',
			    'description__like' => '',
			    'pad_counts'        => false,
			    'offset'            => '',
			    'search'            => '',
			    'cache_domain'      => 'core'
			);
			$workTerms = get_terms($taxonomy, $termArgs);

			if(count($workTerms)>0){
			    $count = 0;
		?>
		
    	<?php  
    			}
    		 $postArgs = array(
	            'post_type' => 'portfolio',
	            'post_status' => 'publish',
	            'orderby' => 'menu_order',
	            'order' => 'ASC',
	            'numberposts' => 3,
	            'tax_query' => array(
	            array(
	                'taxonomy' => 'portfolio_categories',
	                'field' => 'slug',
	                'terms' => 'recent',
	            )),
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
				                $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'icon-image', $related_post->ID);
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
						<div class="news-card">
							<a href="<?php echo get_permalink($related_post->ID);?>" >
							<div class="news-cardOuter">
								<div class="news-cardInner">
									<?php if($imageUrl!=""){ ?>
                            			<img src="<?php echo $imageUrl; ?>" alt="<?php echo $imgAlt; ?>">
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
<?php get_footer('sub'); ?>