<?php 
/*
Template Name: Beauty
*/
get_header();
get_header('subpage');
$featImage = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$imageId = MultiPostThumbnails::get_post_thumbnail_id('page', 'page_banner', $post->ID);
$imageUrl = wp_get_attachment_url($imageId, NULL);
$defImg = get_option('defBanImg');
$defIcnImg = get_option('defIcnImg');
$imageUrl = $imageUrl == "" ? $defImg : $imageUrl;
$taxonomy = "beauty_cat";
$termArgs = array(
    'orderby'           => 'menu_order',
    'order'             => 'ASC',
    'hide_empty'        => true,
    'exclude'           => array(),
    'exclude_tree'      => array(),
    'include'           => array(),
    'number'            => '',
    'fields'            => 'all',
    'slug'              => '',
    'parent'            => '',
    'hierarchical'      => true,
    'child_of'          => 0,
    'childless'         => false,
    'get'               => '',
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false,
    'offset'            => '',
    'search'            => '',
    'cache_domain'      => 'core'
);
$beauTerms = get_terms($taxonomy, $termArgs);
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
            <h1><?php echo $post->post_title; ?></h1>
             <?php echo apply_filters('the_content',$post->post_content); ?>
        </div>
        <?php if($imageUrl) { ?>
          <div class="col-7">
              <div class="section-img border-row"> 
                <img src="<?php echo $imageUrl; ?>">
              </div>
          </div>
        <?php } ?>
    </div>
  </div>
</section>
<section class="generic generic-section">
  <div class="container">
    <div class="row menu-card">
          <?php
          if(is_array($beauTerms) && count($beauTerms)>0){
            foreach ($beauTerms as $key => $beauTerm) {
              $catImg = z_taxonomy_image_url($beauTerm->term_id);
        $catImg = $catImg == ''? $defIcnImg:$catImg; 
        
          ?>
          <div class="col-4 text-center">
            <div class="card-inner-bg">
                <h2><?php echo $beauTerm->name; ?></h2>
                <?php if($catImg!=''){ ?>
                <div class="card-inner-img">
                  <img src="<?php echo $catImg; ?>" alt="<?php echo $beauTerm->name; ?>">
                </div>
                <?php }?>
                <a class="button button-more" href="<?php echo get_term_link($beauTerm); ?>">view more</a>
            </div>
          </div>
          <?php 
            }
          } 
        ?>
      </div>
      <div class="tab-show">
        <ul class="menu-list">
          <?php
            if(is_array($beauTerms) && count($beauTerms)>0){
              foreach ($beauTerms as $beauTerm){
          ?>
          <li><a href="<?php echo get_term_link($beauTerm); ?>"><?php echo $beauTerm->name; ?></a></li>
          <?php
              } 
            }
          ?>
        </ul>
      </div>
  </div>
</section>  
<?php
  get_footer();
?>