<?php
add_action('admin_menu', 'sidebar_menus_options');

function sidebar_menus_options() {
    add_meta_box('sidebar_menus_options', 'Sidebar Options', 'sidebar_menus_options_design', 'page');
}

function sidebar_menus_options_design($post_id) {
    global $post;    
    $sidebar_links = get_post_meta($post->ID, 'sidebar_links', true);
    $appearance_menus = wp_get_nav_menus();
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order">Sidebar Menus</label></td>
            <td  class="right" width="400">
                <select name="sidebar_links" style="width:200px;">
                	    <option value="">Select</option>  
                    <?php foreach($appearance_menus as $appearance_menu){ ?>
                        <option value="<?php echo $appearance_menu->term_id; ?>" <?php if($sidebar_links==$appearance_menu->term_id){ echo 'selected="selected"'; } ?>><?php echo $appearance_menu->name; ?></option>
                    <?php } ?>
                </select>
            </td>          
        </tr>
    </table>    
    <?php
}

add_action('save_post', 'save_sidebar_menus_options');

function save_sidebar_menus_options($post_id) {
    global $post;
    // do not save if this is an auto save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if($post->post_type=="page")
    {
       // if(isset($_REQUEST['sidebar_links']) && $_REQUEST['sidebar_links']!="")
        //{
            update_post_meta($post_id, 'sidebar_links', $_REQUEST['sidebar_links']);
       // }
    }
}
?>