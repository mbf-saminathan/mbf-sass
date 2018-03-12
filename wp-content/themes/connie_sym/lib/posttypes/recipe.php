<?php add_action('init', 'create_recipe', 0);

function create_recipe() {
    $labels = array(
        'name' => _x('Recipes', 'post type general name'),
        'singular_name' => _x('Recipes', 'post type singular name'),
        'add_new' => _x('Add Recipes', 'Recipes'),
        'add_new_item' => __('Add Recipes'),
        'edit_item' => __('Edit Recipes'),
        'new_item' => __('New Recipes'),
        'view_item' => __('View Recipes'),
        'search_items' => __('Search Recipes'),
        'not_found' => __('No Recipes found'),
        'not_found_in_trash' => __('No Recipes found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'recipe','with_front' => FALSE,),
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    register_post_type('recipe', $args);
    register_taxonomy("recipe_cat", "recipe", array("hierarchical" => true,
        "label" => "Recipe Categories",
        "singular_label" => "Recipe",
        'rewrite' => array('slug' => 'recipe-cat','with_front' => FALSE,),
        "query_var" => true,
        "show_ui" => true
            )
    );

}
?>