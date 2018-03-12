<?php add_action('init', 'create_job', 0);

function create_job() {
    $labels = array(
        'name' => _x('Job', 'post type general name'),
        'singular_name' => _x('Job', 'post type singular name'),
        'add_new' => _x('Add Job', 'Job'),
        'add_new_item' => __('Add Job'),
        'edit_item' => __('Edit Job'),
        'new_item' => __('New Job'),
        'view_item' => __('View Job'),
        'search_items' => __('Search Job'),
        'not_found' => __('No Job found'),
        'not_found_in_trash' => __('No Job found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'jobs/%job_categories%','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('job', $args);
    //Register the case_studies_categories taxonomy.
    register_taxonomy("job_categories", "job", array("hierarchical" => true,
        "label" => "Job Categories",
        "singular_label" => "Job Categories",
        'rewrite' => array('slug' => 'jobs','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );
    add_filter('post_link', 'job_permalink', 1, 3);
    add_filter('post_type_link', 'job_permalink', 1, 3);

   function job_permalink($permalink, $post_id, $leavename)
   {
       //con %brand% catturo il rewrite del Custom Post Type
       if (strpos($permalink, '%job_categories%') === FALSE) return $permalink;
       // Get post
       $post = get_post($post_id);
       if (!$post) return $permalink;
       $args_proj_cate = array('orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'all');
       // Get taxonomy terms
       $terms = wp_get_object_terms($post->ID, 'job_categories',$args_proj_cate);
       $par_id = $post->post_parent;
       $terms_par = wp_get_object_terms($par_id, 'job_categories',$args_proj_cate);
       if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
           $taxonomy_slug = $terms[0]->slug;
       else $taxonomy_slug = $terms_par[0]->slug;

       return str_replace('%job_categories%', $taxonomy_slug, $permalink);
   }

}
?>
