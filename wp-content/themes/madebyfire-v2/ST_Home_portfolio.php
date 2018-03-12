<?php 
/***********************
Template Name: Home Portfolio
************************/
get_header();
?>
<?php
$related_posts = MRP_get_related_posts( $subPage->ID, true, true, 'portfolio' );
asort($related_posts);
$count =0;
if(count($related_posts)>0){
?>
<div class="projects-container">
<?php foreach ($related_posts as $related_post){
	    $subtitle = get_post_meta($related_post->ID, 'subtitle', true); 
	    $display_home = get_post_meta($related_post->ID, 'display_home', true); 
	    $textContent = get_post_meta($related_post->ID,'SMTH_METANAME',true);
	    $args = array('orderby' => 'menu_order', 'order' => 'ASC', 'fields' => 'all');
	    $termsPorts = wp_get_post_terms( $related_post->ID, 'portfolio_categories', $args );
	    $featImage = wp_get_attachment_url(get_post_thumbnail_id($related_post->ID) );  
        $showInHome = get_post_meta($related_post->ID, 'show_in_home', true);
		?>
		<?php if($showInHome != "no") {?>
		<section class="section <?php echo $display_home ?>">
			<div class="container">
				<div class="row">
					<div class="col-xs-7 project-image">
					<div class="mobileres">
						<h6><?php echo $subtitle;?></h6>
						<h1><?php echo $related_post->post_title; ?></h1>
					</div>
						<img src="<?php echo $featImage ?>" alt="Fiternity" />
					</div>
					<div class="col-xs-5 project-description">
						<h6><?php echo $subtitle;?></h6>
						<h1><?php echo $related_post->post_title; ?></h1>
						<div class="clearfix dark-block">
							<div class="dark-wrapper-content">
								<?php echo wpautop(apply_filters('the_content',$textContent)); ?>
							</div>
							<ul>
								<?php 
								foreach ($termsPorts as $termsPort) { 
									if($termsPort->slug != "recent"){
										$iconImage = get_term_meta($termsPort->term_id, 't_order', true); ?>
										<li><a href="<?php echo get_term_link($termsPort); ?>"><i class="fa fa-<?php echo $iconImage ?>" aria-hidden="true"></i><?php echo 
										$termsPort->name; ?></a></li>
									<?php }
								} ?>
							</ul>
							</div>
							<div class="<?php if($display_home =='dark-wrapper'){echo 'dynamic-button'; } else {echo 'dynamic-button dynamic-button-primary'; }?>">
									<a href="<?php echo get_permalink($related_post->ID); ?>"> View Project</a>
							</div>
					</div>
				</div>	
			</div>
		
		</section>
		<?php }?>

		
		<?php } ?>
	</div>
<?php } ?>