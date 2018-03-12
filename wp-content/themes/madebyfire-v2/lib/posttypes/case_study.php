<?php add_action('init', 'create_case_study', 0);

function create_case_study() {
    $labels = array(
        'name' => _x('Case study', 'post type general name'),
        'singular_name' => _x('Case study', 'post type singular name'),
        'add_new' => _x('Add Case study', 'Case study'),
        'add_new_item' => __('Add Case study'),
        'edit_item' => __('Edit Case study'),
        'new_item' => __('New Case study'),
        'view_item' => __('View Case study'),
        'search_items' => __('Search Case studies'),
        'not_found' => __('No Case study found'),
        'not_found_in_trash' => __('No Case study found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'work/%case_study_categories%','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('case_study', $args);
    //Register the case_studies_categories taxonomy.
    register_taxonomy("case_study_categories", "case_study", array("hierarchical" => true,
        "label" => "Case study Categories",
        "singular_label" => "Case study Categories",
        'rewrite' => array('slug' => 'work','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );
    add_filter('post_link', 'case_study_permalink', 1, 3);
    add_filter('post_type_link', 'case_study_permalink', 1, 3);

   function case_study_permalink($permalink, $post_id, $leavename)
   {
       //con %brand% catturo il rewrite del Custom Post Type
       if (strpos($permalink, '%case_study_categories%') === FALSE) return $permalink;
       // Get post
       $post = get_post($post_id);
       if (!$post) return $permalink;
       $args_proj_cate = array('orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'all');
       // Get taxonomy terms
       $terms = wp_get_object_terms($post->ID, 'case_study_categories',$args_proj_cate);
       $par_id = $post->post_parent;
       $terms_par = wp_get_object_terms($par_id, 'case_study_categories',$args_proj_cate);
       if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
           $taxonomy_slug = $terms[0]->slug;
       else $taxonomy_slug = $terms_par[0]->slug;

       return str_replace('%case_study_categories%', $taxonomy_slug, $permalink);
   }

}
?>
