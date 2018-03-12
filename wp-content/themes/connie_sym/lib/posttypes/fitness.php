<?php add_action('init', 'create_fitness', 0);

function create_fitness() {
    $labels = array(
        'name' => _x('Fitness', 'post type general name'),
        'singular_name' => _x('Fitness', 'post type singular name'),
        'add_new' => _x('Add Fitness', 'Fitness'),
        'add_new_item' => __('Add Fitnes'),
        'edit_item' => __('Edit Fitness'),
        'new_item' => __('New Fitness'),
        'view_item' => __('View Fitness'),
        'search_items' => __('Search Fitness'),
        'not_found' => __('No Fitness found'),
        'not_found_in_trash' => __('No Fitness found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'fitness','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('fitness', $args);
    register_taxonomy("fitness_cat", "fitness", array("hierarchical" => true,
        "label" => "Fitness Categories",
        "singular_label" => "fitness",
        'rewrite' => array('slug' => 'fitness-cat','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>