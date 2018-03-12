<?php add_action('init', 'create_blogs', 0);

function create_blogs() {
    $labels = array(
        'name' => _x('Blogs', 'post type general name'),
        'singular_name' => _x('Blog', 'post type singular name'),
        'add_new' => _x('Add Blog', 'Blog'),
        'add_new_item' => __('Add Blog'),
        'edit_item' => __('Edit Blog'),
        'new_item' => __('New Blog'),
        'view_item' => __('View Blog'),
        'search_items' => __('Search Blog'),
        'not_found' => __('No Blogs found'),
        'not_found_in_trash' => __('No Blogs found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'blog','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('blog', $args);
    
    register_taxonomy("blog_cat", "blog", array("hierarchical" => true,
        "label" => "Blog Categories",
        "singular_label" => "Blog Category",
        'rewrite' => array('slug' => 'join-us','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>
