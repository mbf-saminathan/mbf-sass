<?php
add_action('admin_menu', 'portfolio_options');

function portfolio_options() {
    add_meta_box('portfolio_options', 'Home Page Display Options', 'portfolio_options_design', 'portfolio');
}

function portfolio_options_design($post_id) {
    global $post;
    $template_type = get_post_meta($post->ID, 'template_type', true);    

    $image_path = wp_upload_dir();
    $base_dir = $image_path['baseurl'];
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order">Show on Index position</label></td>
            <td  class="right" width="400"><input type="text" id="template_type" name="template_type" value="<?php echo $template_type; ?>"></td>
        </tr>
    </table>    
    <?php
}

add_action('save_post', 'save_portfolio_options');

function save_portfolio_options($post_id) {
    global $post;

// do not save if this is an auto save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if($post->post_type=="portfolio" && isset($_REQUEST['template_type']))
    {
        update_post_meta($post_id, 'template_type', $_REQUEST['template_type']);
    }
    

    /* code to create a directory if it is not found */

}
?>