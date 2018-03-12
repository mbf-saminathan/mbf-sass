<?php add_action('init', 'create_services', 0);

function create_services() {
    $labels = array(
        'name' => _x('Service', 'post type general name'),
        'singular_name' => _x('Service', 'post type singular name'),
        'add_new' => _x('Add Service', 'Service'),
        'add_new_item' => __('Add Service'),
        'edit_item' => __('Edit Service'),
        'new_item' => __('New Service'),
        'view_item' => __('View Service'),
        'search_items' => __('Search Service'),
        'not_found' => __('No Service found'),
        'not_found_in_trash' => __('No Service found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'our-services','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('service', $args);
}
?>
