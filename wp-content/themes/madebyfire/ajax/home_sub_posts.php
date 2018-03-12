<?php 
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');
$hom_id = 4;
$related_posts = MRP_get_related_posts( $hom_id, true, true, 'portfolio' );

foreach ($related_posts as $related_post):    ?>
        <section id="post_<?php echo $related_post->ID; ?>">
            <?php
            $block_type = get_post_meta($related_post->ID, 'template_type', true);
            $sub_page = $related_post->ID;
            switch ($block_type) {                
                case "secondBlock": ?>
                    <div class="secondBlock">
                        <?php
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page)); 
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>"/>  
                        <?php  endif; ?>
                        <div class="absolute">
                            <div class="container">
                                <div class="col-xs-4 contextMore fR" data-animated="fadeIn" data-delay="10">
                                    <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
                break;
                case "thirdBlock": ?>
                    <div class="container thirdBlock">
                        <div class="col-xs-5 contextMore text-right">
                            <a href="<?php echo get_permalink($sub_page);?>" data-animated="fadeInUp" data-delay="2" title="<?php echo $related_post->post_title; ?>">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                            </a>
                        </div>
                        <div class="col-xs-7 text-left">
                            <?php
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page)); 
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="1"/>  
                        <?php  endif; ?>
                        </div>
                    </div>
        <?php             
                break;
                case "fourthBlock": ?>        
                    <div class="container fourthBlock">
                        <?php
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page)); 
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" alt="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="2"/>  
                        <?php  endif; ?>
			<div class="col-xs-5 contextMore">
                            <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>" data-animated="fadeInUp" data-delay="1">
                                <h2><?php echo $related_post->post_excerpt; ?></h2>
                                <span class="readMe">READ THE STORY</span>
                            </a>
                        </div>
                    </div>
       <?php     
                break;
                case "fifthBlock"; ?>
                    <div class="fifthBlock">
                          <?php
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page)); 
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="2"/>  
                        <?php  endif; ?>
			<img src="images/imgBG41.jpg" class="fullWidth" alt="" data-animated="fadeIn" data-delay="2"/>
			<div class="absolute">
                            <div class="container">
                                <div class="col-xs-5 contextMore text-right">
                                    <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>" data-animated="fadeInUp" data-delay="1">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                                    </a>
                                </div>	
                            </div>
			</div>
                    </div>          
       <?php   break;
                default:
                    echo "Your favorite color is neither red, blue, nor green!";
            }
            ?>
        </section>
<?php endforeach; ?>