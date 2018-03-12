<?php
get_header();
get_header('home');
?>

    <section class="madeIntro blackBg winHgt" >
        <?php $hom_id = 4;
            $home = get_post($hom_id);
        ?>
        <div class="container" id="page-<?php echo $home->id; ?>">
            <div class="row">
                <?php
                 if(count($related_posts) > 0) {
                foreach ($related_posts as $related_post): ?>
                        <section>
                            <?php  echo $related_post->ID;?>
                        </section>
                <?php endforeach;
		}
                ?>
                <div class="col-xs-7 padFifty center-block  index_content">
                    <?php /* <h1><?php echo $home->post_title; ?></h1> */ ?>
                    <p>
                      <?php echo apply_filters('the_content', $home->post_content); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div class="mobwhiteBlock" id="madebyfire_post">
        <?php $related_posts = MRP_get_related_posts( $hom_id, true, true, 'portfolio' );
        asort($related_posts);
        $count =0;
if(count($related_posts) > 0) {
foreach ($related_posts as $related_post):
        ?>
            <section id="post_<?php echo $related_post->ID; ?>">
            <?php
            $block_type = get_post_meta($related_post->ID, 'template_type', true);
            $sub_page = $related_post->ID;
            $imgThumbid = get_post_thumbnail_id($sub_page);
            $alt_img = get_post_meta($imgThumbid, '_wp_attachment_image_alt', true);
            if($block_type == "secondBlock"){
                $img_url = wp_get_attachment_url(get_post_thumbnail_id($sub_page));
                if($img_url!=''){
                ?>
                <div class="secondBlock">
                        <?php

                            if($img_url): ?>
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $alt_img; ?>"/>
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
                              <img src="<?php echo $img_url; ?>" class="" alt="<?php echo $alt_img; ?>" />
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
                              <img src="<?php echo $img_url; ?>" alt="<?php echo $alt_img; ?>" />
                        <?php  endif; ?>
            <div class="col-xs-4 contextMore">
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
                              <img src="<?php echo $img_url; ?>" class="fullWidth" alt="<?php echo $alt_img; ?>" />
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
   // }
            $count++;
        endforeach;
}
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
        		$external_link = get_post_meta($newsList->ID, 'external_link', true);

                        $new_window = get_post_meta($newsList->ID, 'new_window', true);
        		if($external_link !=''  && $new_window == 'new_window') {
                                   $link = $external_link;
                                   $target = 'target="_blank"';
                                }  else if($external_link !='' && $new_window == 'same_window') {
                                   $link = $external_link;
                                  $target = 'target="_sefl"';
                                } else {
                                   $link = get_permalink($newsList->ID);
                                   $target = '';
                                }
                    ?>
                    <div class="col-xs-4">
                        <div class="expt-desc">
                          <a href="<?php echo $link; ?>" <?php echo $target; ?> >
                            <h3><?php echo $newsList->post_title; ?></h3>
                            <span class="date"><?php echo date("d F, Y", strtotime($newsList->post_date)); ?></span>
                            <?php if($newsList->post_excerpt!="")
                            { ?>
                                <p><?php echo $newsList->post_excerpt ?></p>
                            <?php }?>
                            <a href="<?php echo $link; ?>" <?php echo $target; ?> class="moreLink">READ MORE</a>
                          </a>
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
<?php get_footer("home");?>
