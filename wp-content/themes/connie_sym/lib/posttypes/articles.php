<?php add_action('init', 'create_articles', 0);

function create_articles() {
    $labels = array(
        'name' => _x('Articles', 'post type general name'),
        'singular_name' => _x('Articles', 'post type singular name'),
        'add_new' => _x('Add Articles', 'Articles'),
        'add_new_item' => __('Add Articles'),
        'edit_item' => __('Edit Articles'),
        'new_item' => __('New Articles'),
        'view_item' => __('View Articles'),
        'search_items' => __('Search Articles'),
        'not_found' => __('No Articles found'),
        'not_found_in_trash' => __('No Articles found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'articles','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('articles', $args);

}
?>