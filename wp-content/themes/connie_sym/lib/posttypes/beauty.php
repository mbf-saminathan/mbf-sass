<?php add_action('init', 'create_beauty', 0);

function create_beauty() {
    $labels = array(
        'name' => _x('Beauty', 'post type general name'),
        'singular_name' => _x('Beauty', 'post type singular name'),
        'add_new' => _x('Add Beauty', 'Beauty'),
        'add_new_item' => __('Add Beauty'),
        'edit_item' => __('Edit Beauty'),
        'new_item' => __('New Beauty'),
        'view_item' => __('View Beauty'),
        'search_items' => __('Search Beauty'),
        'not_found' => __('No Beauty found'),
        'not_found_in_trash' => __('No Beauty found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'beauty','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('beauty', $args);
    register_taxonomy("beauty_cat", "beauty", array("hierarchical" => true,
        "label" => "Beauty Categories",
        "singular_label" => "Beauty",
        'rewrite' => array('slug' => 'beauty-cat','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>