<?php
global $post;
$link_array = explode('/',$_SERVER['REQUEST_URI']);
$page_title=$link_array[count($link_array)-2];
$curr_term_id = get_queried_object()->term_id;
$post_term=get_queried_object();
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$postArgsBlog = array(
            'post_type' => 'blog',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1,
            'tax_query' =>  array(
                              array(
                                  'taxonomy' => 'blog_cat',
                                  'field' => 'id',
                                  'terms' => $post_term->term_id
                                  )
                               )
            );
$pages = get_posts($postArgsBlog);
$no_post = 2;
$pagination = new pagination;
$paged_media = $pagination->generate($pages, $no_post);
if ($page_title == 'all'){
    header('Location: '.get_bloginfo('url').'/blog');
  }
get_header();
get_header('new');
$option_name_templ = 'blog_cat_template_type_' . $curr_term_id;
$template_type = get_option( $option_name_templ );
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
<?php            if ($template_type=="normal") {

?>
<div class="portfolio-head">
    <div class="container">
    <div class="row">
        <div class="col-xs-8 generic">
            <h1><?php echo $post_term->name; ?></h1>
            <p><?php echo $post_term->description; ?></p>
        </div>
        <?php get_sidebar('related_link'); ?>

    </div>
        <div class="new-list-border"></div>
        <div class="generic  job-opp-container">

            <div class="col-xs-12 container-stretched">
            <?php
$postArgs_loc = array(
            'post_type' => 'blog',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1,
            'tax_query' =>  array(
                              array(
                                  'taxonomy' => 'blog_cat',
                                  'field' => 'id',
                                  'terms' => $post_term->term_id
                                  )
                               )
            );
$location_posts = get_posts($postArgs_loc);
$paged_loc_posts = $pagination->generate($location_posts, $no_post);
if(count($paged_loc_posts)>0){
    $count = 0;
    foreach ($paged_loc_posts as $location_post){
        $imgUrl = wp_get_attachment_url(get_post_thumbnail_id($location_post->ID));
?>
                <strong><?php echo $location_post->post_title; ?></strong><br />
                <span class="read_text"><?php echo date("d M Y", strtotime($location_post->post_date)); ?></span>                
                <?php if ($imgUrl!='') { ?>
                    <div style="">&nbsp;</div>
                    <div class=""><img class="alignnone wp-image-315" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($location_post->ID)); ?> " alt="Strum, strum, strum" /></div>
                <?php } ?>
            <div style="">&nbsp;</div>
            <div ><?php echo apply_filters('the_content', $location_post->post_content); ?></div>
            <div style="">&nbsp;</div>
            <div class="border_line_bottom"></div>
            <?php } ?>
<?php } ?>
            <?php
                if (count($pages) > $no_post) {
                    ?>

                <div class="pager clearfix">
                    <ul class="fL" >
                        <?php
                            echo $pagination->links('num');
                        ?>
                    </ul>
                </div>
                    <?php } ?>
            </div>

        </div>
    </div>
</div>
<?php }elseif($template_type=="accordion_type"){ ?>
<div class="portfolio-head">
<div class="container">
    <div class="row border-line <?php //if(($sidebar_links !='') && (count($menus) > 0)) { echo 'sidebar'; } else { echo ''; } ?>">
        <div class="col-xs-8">
            <h1><?php echo $post_term->name; ?></h1>
            <p><?php echo $post_term->description; ?></p>
            <div class="accordion">
                <?php


                $curr_opp_args = array(
                'post_type' => 'blog',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
                'tax_query' =>  array(
                                  array(
                                      'taxonomy' => 'blog_cat',
                                      'field' => 'id',
                                      'terms' => $post_term->term_id
                                      )
                                   )
                );
                $curr_opp_posts = get_posts($curr_opp_args);
                foreach ($curr_opp_posts as $curr_opp_post) {
                    ?>
                    <div class="accordion-item">
                        <h2><?php echo $curr_opp_post->post_title; ?></h2>
                        <div class="accordion-copy">
				<?php echo apply_filters('the_content', $curr_opp_post->post_content); ?>
                           <?php /*  <p><?php echo $curr_opp_post->post_content; ?></p> */ ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php get_sidebar('related_link'); ?>
    </div>
</div>
</div>
<?php } ?>
<?php get_footer(); ?>
