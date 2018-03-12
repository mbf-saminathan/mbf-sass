<?php add_action('init', 'create_portfolio', 0);

function create_portfolio() {
    $labels = array(
        'name' => _x('Portfolio', 'post type general name'),
        'singular_name' => _x('Portfolio', 'post type singular name'),
        'add_new' => _x('Add Portfolio', 'Portfolio'),
        'add_new_item' => __('Add Portfolio'),
        'edit_item' => __('Edit Portfolio'),
        'new_item' => __('New Portfolio'),
        'view_item' => __('View Portfolio'),
        'search_items' => __('Search Portfolio'),
        'not_found' => __('No Portfolio found'),
        'not_found_in_trash' => __('No Portfolio found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'work/%portfolio_categories%','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('portfolio', $args);
    //Register the case_studies_categories taxonomy.
    register_taxonomy("portfolio_categories", "portfolio", array("hierarchical" => true,
        "label" => "Portfolio Categories",
        "singular_label" => "Portfolio Categories",
        'rewrite' => array('slug' => 'work','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );
    add_filter('post_link', 'portfolio_permalink', 1, 3);
    add_filter('post_type_link', 'portfolio_permalink', 1, 3);

   function portfolio_permalink($permalink, $post_id, $leavename)
   {
       //con %brand% catturo il rewrite del Custom Post Type
       if (strpos($permalink, '%portfolio_categories%') === FALSE) return $permalink;
       // Get post
       $post = get_post($post_id);
       if (!$post) return $permalink;
       $args_proj_cate = array('orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'all');
       // Get taxonomy terms
       $terms = wp_get_object_terms($post->ID, 'portfolio_categories',$args_proj_cate);
       $par_id = $post->post_parent;
       $terms_par = wp_get_object_terms($par_id, 'portfolio_categories',$args_proj_cate);
       if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
           $taxonomy_slug = $terms[0]->slug;
       else $taxonomy_slug = $terms_par[0]->slug;

       return str_replace('%portfolio_categories%', $taxonomy_slug, $permalink);
   }

}
?>
