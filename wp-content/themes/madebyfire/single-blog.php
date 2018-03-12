<?php 
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
        <div class="mainLanding portfolio-head">
            <div class="container">
                <div class="row">
                <div class="col-xs-8 singleBlog generic">
                    <h1><?php echo $post->post_title; ?></h1>
                    <?php /* <p><?php echo $post->post_content; ?></p> */ ?>
                    <?php if ($imgUrl!='') { ?>
                        <div class=""><img class="alignnone wp-image-315" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?> " alt="Strum, strum, strum" /></div>
                    <?php } ?>
                    <div><?php echo apply_filters('the_content', $post->post_content); ?></div>
                </div>
              </div>
            </div>
        </div>
        <?php       
       get_footer(); ?>
