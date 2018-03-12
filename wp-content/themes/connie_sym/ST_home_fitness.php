<?php 
/*
Template Name: Home(fitness)
*/

$homeFitness = get_post($postId);
$linkHeading = get_post_meta($postId, 'linkHeading', true);
$rlLinkUrl = get_post_meta($postId, 'rlLinkUrl', true);
$linkHeading = $linkHeading==''?'View More':$linkHeading;
?>
<!-- reciepes block -->
 <section class="fitness-section">
  <div class="container">
    <div class="row">
      <div class="col-10 center-block content-center">
        <h1><?php echo $homeFitness->post_title; ?></h1>
        <?php echo wpautop($homeFitness->post_content); ?>
       </div>
    </div>
    <div class="row">
      <?php
        $homFitnArgs = array(
                              'post_type' => 'fitness',
                              'order'         => 'ASC', 
                              'orderby'       => 'menu_order', /* we can use it date order also.. */
                              'post_status'   => 'publish',
                              'numberposts' => -1,
                              'meta_query' => array(
                                  array(
                                      'key' => 'show_in_home',
                                      'value' => 'yes',
                                  )
                              )
                            );
        $homFitns = get_posts($homFitnArgs);
        if (is_array($homFitns) && count($homFitns)>0) {
        foreach ($homFitns as $key => $homFitn) {
          $linkHeading = get_post_meta($homFitn->ID, 'linkHeading', true);
          $linkHeading = $linkHeading==''?'View More':$linkHeading;
          $fitImgUrlId = MultiPostThumbnails::get_post_thumbnail_id('fitness', 'fiticonimg', $homFitn->ID);
          $fitImgUrl = wp_get_attachment_url($fitImgUrlId, NULL);
          $fitImgUrl = $fitImgUrl == ''? $defIcnImg:$fitImgUrl; 
        
      ?>
        <div class="col-4">
          <div class="card">
            <figure><img src="<?php echo $fitImgUrl; ?>" alt="card<?php echo $key; ?>-image">
              <figcaption>
                <h3><?php echo $homFitn->post_title; ?></h3>
                <?php echo apply_filters('the_content',$homFitn->post_content); ?>
                <a href="<?php echo get_permalink($homFitn->ID); ?>" class="button-link"><?php echo $linkHeading; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
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
    <!--  End of recipe section -->