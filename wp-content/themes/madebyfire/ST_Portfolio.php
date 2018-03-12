<?php 
/***********************
Template Name: Portfolio
************************/
get_header();
get_header('new');
?>
        <div class="breadCrumb">
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
<div class="mobwhiteBlock" id="madebyfire_post">
<?php 
	$args = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1
            );

$related_posts = get_posts($args); 
        $count =0;
        foreach ($related_posts as $related_post):            
        ?>
            <section id="post_<?php echo $related_post->ID; ?>">
            <?php
            $block_type = get_post_meta($related_post->ID, 'template_type', true);
            $sub_page = $related_post->ID;
            if($block_type == "secondBlock"){ 
                $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page));
                if($img_url!=''){
                ?>
                <div class="secondBlock">
                        <?php
                            
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth <?php if($count==0){ echo 'marginSet'; } ?>" alt="<?php echo $related_post->post_title; ?>"/>  
                        <?php  endif; ?>
                        <div class="absolute">
                            <div class="container">
                                <div class="col-xs-4 contextMore fR">
                                    <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } } elseif($block_type == "thirdBlock"){
                    $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page)); 
                    if($img_url!=''){
                ?>
                    <div class="container thirdBlock">
                        <div class="col-xs-5 contextMore text-right">
                            <a href="<?php echo get_permalink($sub_page);?>" data-animated="fadeIn" data-delay="0.6" title="<?php echo $related_post->post_title; ?>">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                            </a>
                        </div>
                        <div class="col-xs-7 text-left">
                            <?php
                            
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="1"/>  
                        <?php  endif; ?>
                        </div>
                    </div>
            <?php } } elseif($block_type == "fourthBlock"){
                    $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page));
                    if($img_url!=''){
             ?>
                     <div class="container fourthBlock">
                        <?php
                             
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" alt="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="1"/>  
                        <?php  endif; ?>
			<div class="col-xs-5 contextMore">
                            <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="0.6">
                                <h2><?php echo $related_post->post_excerpt; ?></h2>
                                <span class="readMe">READ THE STORY</span>
                            </a>
                        </div>
                    </div>
                
            <?php } }elseif($block_type == "fifthBlock"){  
                  $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page));
                  if($img_url!=''){
            ?>
                <div class="fifthBlock">
                          <?php
                            
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="1"/>  
                        <?php  endif; ?>			
			<div class="absolute">
                            <div class="container">
                                <div class="col-xs-5 contextMore text-right">
                                    <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>" data-animated="fadeIn" data-delay="0.6">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                                    </a>
                                </div>	
                            </div>
			</div>
                    </div> 
                <?php
                }
            }
            echo "</section>";
        endforeach;
        ?>
</div>
        <?php get_footer(); ?>
