<?php 
get_header();
get_header('subpage');
$currTermId = get_queried_object()->term_id;
$postTerm=get_queried_object();
$postArgsBlog = array(
            'post_type' => 'beauty',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1,
            'tax_query' =>  array(
                              array(
                                  'taxonomy' => 'beauty_cat',
                                  'field' => 'id',
                                  'terms' => $postTerm->term_id
                                  )
                               )
            );
$beauPoststot = get_posts($postArgsBlog);
$noPost = 5;
$pagination = new pagination;
$beauPosts = $pagination->generate($beauPoststot, $noPost);
$ImgUrl = z_taxonomy_image_url($curr_term_id);
$defImg = get_option('defBanImg');
$ImgUrl = $ImgUrl == "" ? $defImg : $ImgUrl;
?>
<div class="breadcrumbs desktop-view">
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
<section class="generic generic-breakfastSection">
  <div class="container">
     <div class="row">
        <div class="col-5 content-block">
            <h1><?php echo $postTerm->name; ?></h1>
             <?php echo $postTerm->description; ?>
        </div>
        <?php if($ImgUrl!=''){ ?>
          <div class="col-7">
              <div class="section-img border-row"> 
                <img src="<?php echo $ImgUrl; ?>">
              </div>
          </div>
        <?php } ?>
    </div>
  </div>
</section>
<section class="generic">
  <div class="container">
    <div class="row listing-cards ">
        <?php
          if(is_array($beauPosts) && count($beauPosts)>0){
            $count = 0;
            foreach ($beauPosts as $beauPost){
              $beauImgUrl = wp_get_attachment_url(get_post_thumbnail_id($beauPost->ID));
        ?>
          <div class="col-4">
            <div class="card">
              <figure><a href="<?php echo get_permalink($beauPost->ID); ?>"><img src="<?php echo $beauImgUrl; ?>" alt="card1-image"></a>
                  <figcaption>
                    <h3><?php echo $beauPost->post_title; ?></h3>
                    <p><?php echo $beauPost->post_excerpt; ?></p>
                    <a href="<?php echo get_permalink($beauPost->ID); ?>" class="button-link">View Details <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                  </figcaption>
              </figure>
            </div>
          </div>
          <?php 
              }
            }

            if(count($beauPoststot)>$noPost){
          ?>
          </div>
          <div class="generic-pagination">
          <ul>
            <?php
                        echo $pagination->links('num');
                      ?>
          </ul>
        </div>
          <?php } ?>
      <div class="tab-show">
        <ul class="menu-list">
          <?php
            foreach ($beauPosts as $beauPost){
          ?>
          <li><a href="<?php echo get_permalink($beauPost->ID); ?>"><?php echo $beauPost->post_title; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      
  </div>
</section>  
<?php
  get_footer();
?>