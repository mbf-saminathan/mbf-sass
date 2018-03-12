<?php
/***********************
Template Name: Portfolio New
************************/
get_header();
get_header('new');
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

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
    <div class="row border-line">
        <div class="col-xs-8 ">
            <h1><?php echo strtoupper(get_the_title()); ?></h1>
            <?php echo apply_filters('the_content', $post->post_content); ?>
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
<div class="portfolioNav portfolioMenu portfolioCenter">
    <div class="container">
        <ul class="text-center clearfix">
            <!-- <li><a href="<?php //echo get_bloginfo('url'); ?>/portfolio/" class="active">All</a></li>  -->
            <?php foreach($terms as $post_term){ ?>
            <li><a href="<?php echo get_term_link($post_term); ?>" <?php if('recent'==$post_term->slug ){ ?> class="active" <?php } ?> ><?php echo $post_term->name; ?></a></li>
            <?php }
             ?>
        </ul>
    </div>
</div>
<?php  }
$postArgs = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1,
            'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_categories',
                'field' => 'slug',
                'terms' => 'recent',
            )),
            );
$related_posts = get_posts($postArgs);
if(count($related_posts)>0){
?>
<div class="portfolio-company text-center portfolioCenter">
    <div class="container">
        <div class="portfolioItems">
        <?php foreach ($related_posts as $related_post){
                $curTerm = wp_get_post_terms($related_post->ID, $taxonomy, array("fields" => "slugs"));
                $termSlugs = implode(" ",$curTerm);
                $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'icon-image', $related_post->ID);
                $imageUrl =  wp_get_attachment_url($iconImageID, NULL);
                $imgAlt = get_post_meta($iconImageID, '_wp_attachment_image_alt', true);
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
                            <img src="<?php echo $homeBannerURL; ?>" alt="<?php echo $imgAlt; ?>">
                        <?php } ?>
                        <span class="hoverLink"><?php echo $related_post->post_title; ?></span>
                    </div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php } if ($img_url != ""): /* ?>
<div class="outContain singlebanner"><div><div class="slideImg"><div><img src="<?php echo $img_url; ?>"  alt=""></div></div></div></div>
<?php */ endif; ?>
<?php get_footer(); ?>
