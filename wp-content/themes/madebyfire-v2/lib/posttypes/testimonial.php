<?php add_action('init', 'create_testimonial', 0);

function create_testimonial() {
    $labels = array(
        'name' => _x('Testimonial', 'post type general name'),
        'singular_name' => _x('testimonial', 'post type singular name'),
        'add_new' => _x('Add Testimonial', 'Testimonial'),
        'add_new_item' => __('Add Testimonial'),
        'edit_item' => __('Edit Testimonial'),
        'new_item' => __('New Testimonial'),
        'view_item' => __('View Testimonial'),
        'search_items' => __('Search Testimonial'),
        'not_found' => __('No Testimonial found'),
        'not_found_in_trash' => __('No Testimonial found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'testimonial','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );
register_post_type('testimonial', $args);
 
}
?>
