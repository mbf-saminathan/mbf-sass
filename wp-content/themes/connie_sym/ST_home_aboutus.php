<?php
/*
Template Name: Home(About us)
*/

$homeAbtUs = get_post($postId);
$imgUrl = wp_get_attachment_url(get_post_thumbnail_id($postId));
$linkHeading = get_post_meta($postId, 'linkHeading', true);
$rlLinkUrl = get_post_meta($postId, 'rlLinkUrl', true);
$linkHeading = $linkHeading==''?'View More':$linkHeading;
?>
<!-- About section -->
		

<div class="container">
	<section class="section about-section">
		<div class="about-content">
			<div class="row">
				<div class="col-7 about-content-block">
					<h1><?php echo $homeAbtUs->post_title; ?></h1>
					<?php echo apply_filters('the_content',$homeAbtUs->post_content); ?>
					<?php 
					if($linkHeading != '' && $rlLinkUrl != ''){ ?>
						<a href="<?php echo $rlLinkUrl; ?>" class="button button-primary"><?php echo $linkHeading; ?></a>
					<?php } ?>
				</div>
				<div class="col-5">
					<div class="about-image">
						<img src="<?php echo $imgUrl; ?>" alt="about-image"/>
						<?php if($instaUrl=="" && $fbUrl == ""){ ?>
							<ul class="social-icons">
							<?php if($instaUrl!=''){ ?>									
						     <li><a href="<?php echo $instaUrl; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						     <?php }
						     if($fbUrl!=''){ ?>
							 <li><a href="<?php echo $fbUrl; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							 <?php } ?>
					   		</ul>
				   		<?php } ?>
					</div>
			   </div>
		   </div>
		</div>
	</section>
				
