<?php 
get_header();
get_header('new');
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
?>

<!--#include file="subheader.shtml"-->
    <section class="sub-introcontent">
        <div class="container">
            <div class="row">
                <div class="col-xs-10">
                  <div class="maindiv">
                    <div class="breadCrumb">
                        <ul>
                            <?php 
                            if (function_exists('bcn_display')) {
                                bcn_display();
                            }
                            ?>
                        </ul>
                    </div>
                    </div>
                     <h1><?php echo $post->post_title; ?></h1>
                    <?php echo apply_filters('the_content',$post->post_content); ?>
                </div>
                <div class="col-xs-2 no-padding">
                  <div class="sticky">
                      <?php 
                      if($link_heading!=''){
                      ?>
                          <h5><?php echo $link_heading; ?></h5>
                      <?php } ?>
                      <ul>
                          <?php
                                foreach ($rn_link_text as $key => $rn_link_text) {
                                    if($rn_link_url[$key]!=''){
                            ?>
                            <li>
                                <a href="<?php echo $rn_link_url[$key]; ?>" target="<?php echo $rn_link_target[$key]; ?>">
                                    <?php echo $rn_link_text; ?>
                                </a>
                            </li>
                           <?php 
                                    }
                                }
                             ?>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <?php 
    $post_list = get_posts( array('order'            => 'ASC',
          'post_type'        => 'service',
          'post_status'      => 'publish', 
          //'meta_key'         => 'order_meta_field',
          'orderby'          => 'menu_order',
          'numberposts'      => -1
    ) );
     
    $posts = array();
     
    foreach ( $post_list as $post_single ) {
       $posts[] += $post_single->ID;
    }
    $current = array_search( $post->ID, $posts );
     if($current == 0) {$prevID= $posts[count($posts)-1];} else { $prevID= $posts[ $current-1 ]; }
     if($current == count($posts)-1) {$nextID= $posts[0];} else { $nextID= $posts[ $current+1 ]; }
    
    ?>
    <?php
    $relPages = MRP_get_related_posts( $post->ID, true, true );
        if($relPages){
    ?>
    <section class="portfolioSection">
        <?php 
        
            asort($relPages);/****** sleim *****/
        ?>
          <div class="work-company">
              <div class="container">
                  <div class="portfolioItems section">
                      <?php
                          if(count ($relPages)){
                              foreach ($relPages as $relPage){
                      ?>
                      <div class="news-card">
                      <a href="<?php echo get_permalink($relPage->ID);?>" >
                          <div class="news-cardOuter">
                              <div class="news-cardInner">
                                  <?php
                                  $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'icon-image', $relPage->ID);
                                  $imageUrl =  wp_get_attachment_url($iconImageID, NULL);
                                  $imgAlt = get_post_meta($iconImageID, '_wp_attachment_image_alt', true);
                                  if($imageUrl=="")
                                  {
                                      $imageUrl = get_bloginfo('template_url')."/images/default-img.png";
                                  }
                                  ?>
                                  <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imgAlt; ?>">
                                  <div class="news-desc">
                                      <h4><?php echo $relPage->post_title; ?></h4>
                                      <p><?php echo $relPage->post_excerpt;  ?></p>
                                  </div>
                              </div>
                          </div>
                      </a>
                      </div>
                      <?php
                              }
                          }
                      ?>
                  </div>
              </div>          
          </div>
    </section>
    <?php } ?>


    <div class="storylistblock">
      <div class="container">
           <div class="divider-line">
               <div class="fL">
                   <a href="<?php echo get_permalink ($prevID); ?>">
                       <i class="fa fa-chevron-left" aria-hidden="true"></i>PREVIOUS
                   </a>
               </div>
               <a class="stories-logo" alt="images" href="<?php echo get_bloginfo('url'); ?>/our-services/">
                   <img src="<?php echo get_bloginfo('template_url'); ?>/images/tb.png" alt="All stories">
               </a>
               <div class="fR">
                   <a href="<?php echo get_permalink( $nextID); ?>">NEXT 
                       <i class="fa fa-chevron-right" aria-hidden="true"></i>
                   </a>
               </div>
          </div>
       </div>
   </div>

<?php get_footer('sub'); ?>