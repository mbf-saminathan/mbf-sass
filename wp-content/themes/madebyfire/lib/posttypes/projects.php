<?php add_action('init', 'create_projects', 0);

function create_projects() {
    $labels = array(
        'name' => _x('Projects', 'post type general name'),
        'singular_name' => _x('Projects', 'post type singular name'),
        'add_new' => _x('Add Project', 'Project'),
        'add_new_item' => __('Add Project'),
        'edit_item' => __('Edit Project'),
        'new_item' => __('New Project'),
        'view_item' => __('View Project'),
        'search_items' => __('Search Project'),
        'not_found' => __('No Projects found'),
        'not_found_in_trash' => __('No Projects found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'projects','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('project', $args);

}
?>
