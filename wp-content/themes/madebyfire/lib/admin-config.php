<?php
 if (is_admin()) {
   wp_enqueue_script("rm_script", get_bloginfo('template_url') . "/lib/js/common.js", false, "1.0");
} 
/* if (is_admin()) {
    //wp_enqueue_script("rmscript", get_bloginfo('template_url') . "/lib/common/common.js", false, "1.0");
    wp_enqueue_script("tabs", get_bloginfo('template_url') . "/lib/common/jquery.idTabs.min.js", false, "1.0");

    function load_styles() {
        wp_enqueue_style('demo', get_bloginfo('template_url') . '/lib/common/demos.css', false, '1.1', 'all');
	wp_enqueue_style('common', get_bloginfo('template_url') . '/lib/css/common.css', false, '1.1', 'all');
    }

    add_action('init', 'load_styles');
} */

include('posttypes/portfolio.php'); 
include('posttypes/projects.php'); 
include('posttypes/blog.php'); 
include('posttypes/news.php'); 
include('posttypes/team.php'); 
//include('posttypes/case_studies.php');
include('metabox/sidebar_menus.php'); 
include('metabox/portfolio_metabox.php');
include('metabox/news_ext_link_metabox.php');
include('metabox/project_metabox.php'); 
include('metabox/what_we_do.php');
include('metabox/related_link.php');
include('metabox/news_metabox.php');
include('metabox/team_metabox.php');
include('metabox/sidebar_content.php');
include('metabox/blog_cat_metas.php');

include('metabox/display_sb.php');
include('includes/pagination.php'); 
include('includes/contactlist.php'); 
include('includes/theme-options.php'); 
include('includes/newsletter_list.php');

?>
