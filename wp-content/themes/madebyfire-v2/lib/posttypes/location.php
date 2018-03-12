<?php add_action('init', 'create_locations', 0);

function create_locations() {
    $labels = array(
        'name' => _x('Location', 'post type general name'),
        'singular_name' => _x('Location', 'post type singular name'),
        'add_new' => _x('Add Location', 'Location'),
        'add_new_item' => __('Add Location'),
        'edit_item' => __('Edit Location'),
        'new_item' => __('New Location'),
        'view_item' => __('View Location'),
        'search_items' => __('Search Location'),
        'not_found' => __('No Location found'),
        'not_found_in_trash' => __('No Location found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'hello','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('location', $args);
}
?>
