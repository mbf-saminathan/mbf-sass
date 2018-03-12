<?php
global $post;
$link_array = explode('/',$_SERVER['REQUEST_URI']);
$page_title=$link_array[count($link_array)-2];
$curr_term_id = get_queried_object()->term_id;
$post_term=get_queried_object();
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
if ($page_title == 'all'){
    header('Location: '.get_bloginfo('url').'/portfolio');
  }
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
        <div class="col-xs-8 ">
            <h1><?php echo $post_term->name; ?></h1>
            <?php echo $post_term->description; ?>
        </div>
    </div>
    </div>
</div>
<?php
$taxonomy = "portfolio_categories";
$termArgs = array(
    'orderby'           => 'name',
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
$terms = get_terms($taxonomy, $termArgs);
if(count($terms)>0){
    $count = 0;
?>
<div class="portfolioNav portfolioMenu">
            <div class="container">
                <ul class="text-center clearfix">
                <?php /* ?> <li><a href="<?php echo get_bloginfo('url'); ?>/portfolio/">All</a></li> <?php */ ?>
                <?php foreach($terms as $post_term){
                     ?>
                <li><a href="<?php echo get_term_link($post_term); ?>" <?php if($curr_term_id==$post_term->term_id ){ ?> class="active" <?php } ?> ><?php echo $post_term->name; ?></a></li>
                <?php }
                 ?>
            </ul>
            </div>
        </div>
<?php
}
$postArgs = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1,
            'tax_query' =>  array(
                              array(
                                  'taxonomy' => 'portfolio_categories',
                                  'field' => 'id',
                                  'terms' => $curr_term_id
                                  )
                               )
            );
$related_posts = get_posts($postArgs);
if(count($related_posts)>0){
?>
<div class="portfolio-company text-center">
    <div class="container">
        <div class="portfolioItems">
        <?php foreach ($related_posts as $related_post){
                $curTerm = wp_get_post_terms($related_post->ID, $taxonomy, array("fields" => "slugs"));
                $termSlugs = implode(" ",$curTerm);
                $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'icon-image', $related_post->ID);
                $imageUrl =  wp_get_attachment_url($iconImageID, NULL);
                if($imageUrl=="")
                {
                    $imageUrl = get_bloginfo('template_url')."/images/default-img.png";
                }
                $homeBannerURL = get_the_post_thumbnail_url($related_post->ID);
                if($homeBannerURL=="")
                {
                    $homeBannerURL = get_bloginfo('template_url')."/images/default-img.png";
                }
            ?>
            <div class="element-item <?php echo $termSlugs; ?> mobile-app">
                <a href="<?php echo get_permalink($related_post->ID); ?>" class="photo-container">
                    <div class="portfolio-logo">
                        <?php if($imageUrl!=""){ ?>
                            <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imgAlt; ?>">
                        <?php } ?>
                    </div>
                    <div class="pro-box">
                        <p><?php echo $related_post->post_excerpt;  ?></p>
                    </div>
                    <div class="hoverContent">
                        <?php if($homeBannerURL!=""){ ?>
                            <img src="<?php echo $homeBannerURL; ?>" alt="">
                        <?php } ?>
                        <span class="hoverLink"><?php echo $related_post->post_title; ?></span>
                    </div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
