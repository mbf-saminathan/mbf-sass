<?php 
/*
Template Name: Home(Recipes)
*/

$homeRecipes = get_post($postId);
$linkHeading = get_post_meta($postId, 'linkHeading', true);
$rlLinkUrl = get_post_meta($postId, 'rlLinkUrl', true);
?>
<!-- reciepes block -->
 <section class="reciepe-section">
    <div class="container">
      <div class="reciepe-topContent border-row">
        <div class="col-10 center-block content-center">
          <h1><?php echo $homeRecipes->post_title; ?></h1>
            <?php echo apply_filters('the_content',$homeRecipes->post_content); ?>
         </div>
      </div>
      <div class="row row-top">
        <?php
          $homRecpArgs = array(
                                'post_type' => 'recipe',
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
          $homRecps = get_posts($homRecpArgs);
          if (is_array($homRecps) && count($homRecps)>0) {
          foreach ($homRecps as $key => $homRecp) {
            $linkHeading = get_post_meta($homRecp->ID, 'linkHeading', true);
            $linkHeading = $linkHeading==''?'View More':$linkHeading;
            $recImgUrlId = MultiPostThumbnails::get_post_thumbnail_id('recipe', 'recpiconimg', $homRecp->ID);
            $recImgUrl = wp_get_attachment_url($recImgUrlId, NULL);
            $recImgUrl = $recImgUrl == ''? $defIcnImg:$recImgUrl; 

        ?>
          <div class="col-4">
            <div class="card">
              <figure><img src="<?php echo $recImgUrl; ?>" alt="card<?php echo $key; ?>-image">
                <figcaption>
                  <h3><?php echo $homRecp->post_title; ?></h3>
                  <?php echo apply_filters('the_content',$homRecp->post_excerpt); ?>
                  <a href="<?php echo get_permalink($homRecp->ID); ?>" class="button-link"><?php echo $linkHeading; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
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