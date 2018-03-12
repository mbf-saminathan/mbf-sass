<?php add_action('init', 'create_casestudies', 0);

function create_casestudies() {
    $labels = array(
        'name' => _x('Case studies', 'post type general name'),
        'singular_name' => _x('Case studies', 'post type singular name'),
        'add_new' => _x('Add Case studies', 'Case studies'),
        'add_new_item' => __('Add Case studies'),
        'edit_item' => __('Edit Case studies'),
        'new_item' => __('New Case studies'),
        'view_item' => __('View Case studies'),
        'search_items' => __('Search Case studies'),
        'not_found' => __('No Case studies found'),
        'not_found_in_trash' => __('No Case studies found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'case-studies','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('case_studies', $args);
    //Register the case_studies_categories taxonomy.
    register_taxonomy("case_studies_categories", "case_studies", array("hierarchical" => true,
        "label" => "Case studies Categories",
        "singular_label" => "Case studies Categories",
        'rewrite' => array('slug' => 'case-studies-categories','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>
