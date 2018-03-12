<?php 
/***********************
Template Name: Work
************************/
get_header();
get_header('new');
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
?>
<section class="sub-introcontent">
        <div class="container">  
            <div class="row equaldiv">
                <div class="col-xs-8">
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
                        <h1><?php echo get_the_title(); ?></h1>
                    </div>
                    <div class="introBlock">                      
                        <?php  echo apply_filters('the_content', $post->post_content); ?>
                    </div>
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
                        </ul>
                    </div>
                </div>
        </div> 
        </div>
    </section>
    <section class="portfolioSection">
        <?php
            $taxonomy = "portfolio_categories";
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
            $workTerms = get_terms($taxonomy, $termArgs);

            if(count($workTerms)>0){
                $count = 0;
        ?>
        <div class="portfolioNav portfolioMenu">
            <div class="container">
                <ul class="text-center clearfix">
                    <?php foreach($workTerms as $workTerm){ ?>
                        <li <?php if('recent'==$workTerm->slug ){ ?> class="active" <?php } ?>>
                            <a href="<?php echo get_term_link($workTerm); ?>" <?php if('recent'==$workTerm->slug ){ ?> class="active" <?php } ?> ><?php echo $workTerm->name; ?></a>
                        </li>
                    <?php 
                        }
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
        <div class="container">
                <div class="portfolioItems section">
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
                    <div class="news-card">
                        <a href="<?php echo get_permalink($related_post->ID);?>" >
                        <div class="news-cardOuter">
                            <div class="news-cardInner">
                                    <?php if($imageUrl!=""){ ?>
                                        <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imgAlt; ?>">
                                    <?php } ?>
                                    <div class="news-desc">
                                        <h4><?php echo $related_post->post_title; ?></h4>
                                        <p><?php echo $related_post->post_excerpt;  ?></p>
                                    </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <?php 
                    } 
                    /*
                    $tesArgs = array(
                                'post_type' => 'testimonial',
                                'post_status' => 'publish',
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'numberposts' => -1,
                                );
                    $testimonials = get_posts($tesArgs);
                    foreach($testimonials as $testimonial){
                    ?>
                    <div class="news-card news-quote">
                      <blockquote>
                        <span><img src="<?php echo get_bloginfo('template_url'); ?>/images/quote-black.png" alt=""></span>
                            <?php echo apply_filters('the_content', $testimonial->post_content); ?>
                            <h4><?php echo $testimonial->post_title; ?> </h4>
                            <h6><?php echo $testimonial->post_excerpt; ?></h6>
                      </blockquote>
                    </div>
                    <?php } */ ?>
                </div>
            </div>          
        <?php } ?>
        </section>
<?php get_footer('sub'); ?>