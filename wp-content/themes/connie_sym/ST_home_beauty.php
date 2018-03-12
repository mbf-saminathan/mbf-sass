<?php 
/*
Template Name: Home(beauty)
*/
$homebeauties = get_post($postId);
$linkHeading = get_post_meta($postId, 'linkHeading', true);
$rlLinkUrl = get_post_meta($postId, 'rlLinkUrl', true);
$linkHeading = $linkHeading==''?'View More':$linkHeading;
$imageId = MultiPostThumbnails::get_post_thumbnail_id('page', 'page_banner', $post->ID);
$imageUrl = wp_get_attachment_url($imageId, NULL);

?>
<!-- fitness block -->
     <section class="fitness-section">
      <div class="container">
            <div class="row">
              <div class="col-10 center-block content-center">
                <h1><?php echo $homebeauties->post_title; ?></h1>
                <?php echo apply_filters('the_content',$homebeauties->post_content  ); ?>
            </div>
          </div>
        <div class="row">
              <?php
                $homBeauArgs = array(
                                      'post_type' => 'beauty',
                                      'order'         => 'ASC', 
                                      'orderby'       => 'menu_order', /* we can use it date order also.. */
                                      'post_status'   => 'publish',
                                      'numberposts' => 3,
                                      'meta_query' => array(
                                          array(
                                              'key' => 'show_in_home',
                                              'value' => 'yes',
                                          )
                                      )
                                    );
                $homebeauties = get_posts($homBeauArgs);
                if (is_array($homebeauties) && count($homebeauties)>0) {
                foreach ($homebeauties as $key => $homebeaut) {
                  $linkHeading = get_post_meta($homebeaut->ID, 'linkHeading', true);
                  $linkHeading = $linkHeading ==''?'View More':$linkHeading;
                  $beaImgUrlId = MultiPostThumbnails::get_post_thumbnail_id('beauty', 'iconimage', $homebeaut->ID);
                  $beaImgUrl = wp_get_attachment_url($beaImgUrlId, NULL);
                  $beaImgUrl = $beaImgUrl == ''? $defIcnImg:$beaImgUrl; 
              ?>
              <div class="col-4">
                <div class="card">
                  <figure><img src="<?php echo $beaImgUrl; ?>" alt="card<?php echo $key; ?>-image">
                    <figcaption>
                      <h3><?php echo $homebeaut->post_title; ?></h3>
                      <?php echo apply_filters('the_content',$homebeaut->post_excerpt); ?>
                      <a href="<?php echo get_permalink($homebeaut->ID); ?>" class="button-link"><?php echo $linkHeading; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </figcaption>
                  </figure>
                </div>
              </div>
              <?php 
                  }
                }
              ?>
            </div>
    </section>
     <!--  End of Beauty Section -->