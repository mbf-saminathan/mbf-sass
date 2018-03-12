<?php 
/***********************
Template Name: Soul
************************/
get_header();
get_header('new');
?>
<section class="sub-introcontent">
        <div class="container">  
            <div class="row equaldiv">
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
                    <h1><?php echo get_the_title(); ?></h1>
                </div>
                <div class="introCaption">                      
                    <?php  echo wpautop(do_shortcode($post->post_content)); ?>
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
            $postArgs = array(
                'post_parent' => $post->ID,
                'post_type' => 'page',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
                );
            $soulTechposts = get_posts($postArgs);
            if(count($soulTechposts)>0){
        ?>
        <div class="work-company">
            <div class="container">
                    <div class="portfolioItems section">
                        <?php foreach ($soulTechposts as $soulTechpost){
                                $iconImageID = MultiPostThumbnails::get_post_thumbnail_id('page', 'secondary-image', $soulTechpost->ID);
                                $imageUrl =  wp_get_attachment_url($iconImageID, NULL);
                                $imgAlt = get_post_meta($iconImageID, '_wp_attachment_image_alt', true);
                                if($imageUrl=="")
                                {
                                    $imageUrl = get_bloginfo('template_url')."/images/default-img.png";
                                }
                                $homeBannerURL = get_the_post_thumbnail_url($soulTechpost->ID);
                                if($homeBannerURL=="")
                                {
                                    $homeBannerURL = get_bloginfo('template_url')."/images/default-img.png";
                                }
                                $short_desc_options_design = get_post_meta($soulTechpost->ID, 'short_desc_options_design', true);
                 
                            ?>
                        <div class="news-card">
                            <a href="<?php echo get_permalink($soulTechpost->ID);?>" >
                            <div class="news-cardOuter">
                                <div class="news-cardInner">
                                        <?php if($imageUrl!=""){ ?>
                                            <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imgAlt; ?>">
                                        <?php } ?>
                                        <div class="news-desc">
                                            <h4><?php echo $soulTechpost->post_title; ?></h4>
                                            <p><?php echo $short_desc_options_design;  ?></p>
                                        </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php 
                        } ?>
                    </div>
                </div>          
            </div>
        <?php } ?>
        </section>
        <?php get_footer('sub'); ?>