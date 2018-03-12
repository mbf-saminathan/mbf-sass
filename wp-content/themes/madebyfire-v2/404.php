<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
get_header('new'); ?>
<div class="portfolio-head">
<div class="container">
    <div class="row border-line <?php if(($sidebar_links !='') && (count($menus) > 0)) { echo 'sidebar'; } else { echo ''; } ?>">
        <div class="col-xs-12 generic">
            <?php
            $post_author = get_userdata($post->post_author);
            //var_dump($post_author);
            ?> 
            <h1>Unknown page</h1>

            <p><?php echo 'Wet land. Move to a drier land to light your fire.'; ?></p>
        </div>
        
    </div>    
</div>
</div>
<?php get_footer(); ?>
