<?php
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0].'wp-load.php'; 
global $post;
$hom_id = 4;
$related_posts = MRP_get_related_posts( $hom_id, true, true, 'portfolio' ); 
asort($related_posts);
$count =0;
foreach ($related_posts as $related_post):            
        ?>
            <?php if($count !=0) { ?>
            <section id="post_<?php echo $related_post->ID; ?>">
            	<?php //} ?>
            <?php
            $block_type = get_post_meta($related_post->ID, 'template_type', true);
            $sub_page = $related_post->ID;?>
            <?php 
            if($block_type == "secondBlock"){ 
                $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page));
                if($img_url!=''){
                ?>
                <div class="secondBlock">
                        <?php
                            
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>"/>  
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
            <?php } } else if($block_type == "thirdBlock"){
                    $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page)); 
                    if($img_url!=''){
                ?>
                    <div class="container thirdBlock">
                        <div class="col-xs-5 contextMore text-right">
                            <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>">
                                        <h2><?php echo $related_post->post_excerpt; ?></h2>
                                        <span class="readMe">READ THE STORY</span>
                            </a>
                        </div>
                        <div class="col-xs-7 text-left">
                            <?php
                            
                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>" />  
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
                              <img src="<?php echo $img_url; ?>" alt="<?php echo $related_post->post_title; ?>" />  
                        <?php  endif; ?>
			<div class="col-xs-5 contextMore">
                            <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>" >
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
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $related_post->post_title; ?>" />  
                        <?php  endif; ?>			
			<div class="absolute">
                            <div class="container">
                                <div class="col-xs-5 contextMore text-right">
                                    <a href="<?php echo get_permalink($sub_page);?>" title="<?php echo $related_post->post_title; ?>" >
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
          // if($count !=0) {
            echo "</section>";
    }
            $count++;
        endforeach;
?>

<?php
/* News section */
$postArgs = array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'numberposts' => 3,
                'meta_query' => array(
                    array(
                        'key' => 'display_home',
                        'value' => 'yes',
                    )
                )
                );
$newsLists  = get_posts($postArgs);
if(count($newsLists)>0){
?>
<section class="sixthBlock">
    <div class="container">
        <div class="row">
            <?php 
            foreach($newsLists as $newsList){
            ?>
            <div class="col-xs-4">
                <div class="expt-desc">
                    <h3><a href="<?php echo get_permalink($newsList->ID);?>" ><?php echo $newsList->post_title; ?></a></h3>
                    <span class="date"><?php echo date("d F, Y", strtotime($newsList->post_date)); ?></span>
                    <?php if($newsList->post_excerpt!="")
                    { ?>
                        <p><?php echo $newsList->post_excerpt ?></p>
                    <?php }?>                    
                    <a href="<?php echo get_permalink($newsList->ID);?>" class="moreLink">READ MORE</a>
                </div>
            </div>
            <?php } ?>            
        </div>
        <div class="text-center whitelinebtn">
            <a href="<?php echo get_bloginfo('url'); ?>/news" class="btn">MORE NEWS</a>
        </div>
    </div>
</section>
<?php } ?>