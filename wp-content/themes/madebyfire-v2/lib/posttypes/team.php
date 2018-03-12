<?php add_action('init', 'create_team', 0);

function create_team() {
    $labels = array(
        'name' => _x('Team', 'post type general name'),
        'singular_name' => _x('team', 'post type singular name'),
        'add_new' => _x('Add Team', 'Team'),
        'add_new_item' => __('Add Team'),
        'edit_item' => __('Edit Team'),
        'new_item' => __('New Team'),
        'view_item' => __('View Team'),
        'search_items' => __('Search Team'),
        'not_found' => __('No Team found'),
        'not_found_in_trash' => __('No Team found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'team','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('team', $args);
//    //Register the case_studies_categories taxonomy.
//    register_taxonomy("team_categories", "team", array("hierarchical" => true,
//        "label" => "Team Categories",
//        "singular_label" => "Team Categories",
//        'rewrite' => array('slug' => 'team_categories','with_front' => FALSE,),
//        "query_var" => true,
//        "show_ui" => true
//            )
//    );

}
?>
