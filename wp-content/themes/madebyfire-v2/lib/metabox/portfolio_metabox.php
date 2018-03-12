<?php
add_action('admin_menu', 'portfolio_options');

function portfolio_options() {
    add_meta_box('portfolio_options', 'Home Page Display Options', 'portfolio_options_design', 'portfolio');
}

function portfolio_options_design($post_id) {
    global $post;
    $template_type = get_post_meta($post->ID, 'template_type', true); 
    $display_home = get_post_meta($post->ID, 'display_home', true);  
    $subtitle = get_post_meta($post->ID, 'subtitle', true); 
    $showInHome = get_post_meta($post->ID, 'show_in_home', true);
    $image_path = wp_upload_dir();
    $base_dir = $image_path['baseurl'];
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order">Show on Index position</label></td>
            <td  class="right" width="400"><input type="text" id="template_type" name="template_type" value="<?php echo $template_type; ?>"></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Show on Index Subtitle</label></td>
            <td  class="right" width="400"><input type="text" id="subtitle" name="subtitle" value="<?php echo $subtitle; ?>"></td>
        </tr>
        <td  class="right" width="400"><label for="tax-order">Show on Index Background color</label>
            <select name="display_home" id="display_home">
            <option value ="">Please select options</option>
            <option value="dark-wrapper" <?php if($display_home=="dark-wrapper") { echo 'selected';}?>>Black</option>
            <option value="light-wrapper" <?php if($display_home=="light-wrapper") { echo 'selected';}?>>White</option>
            <option value="spreading-wrapper" <?php if($display_home=="spreading-wrapper") { echo 'selected';}?>>Grey</option>
            </select>
        </td>

         <tr> 
            <td class="left"><label for="tax-order">Show in home</label></td>
                <td  class="left">
                    <select name="show_in_home">
                        <option <?php if($showInHome=="no"){ echo 'selected'; } ?> value="no">No</option>
                        <option <?php if($showInHome=="yes"){ echo 'selected'; } ?> value="yes">Yes</option>                    </select>
                </td>
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
    if($post->post_type=="portfolio" && isset($_REQUEST['display_home']))
    {
        update_post_meta($post_id, 'display_home', $_REQUEST['display_home']);
    }
    if($post->post_type=="portfolio" && isset($_REQUEST['subtitle']))
    {
        update_post_meta($post_id, 'subtitle', $_REQUEST['subtitle']);
    }
    if($post->post_type=="portfolio" && isset($_REQUEST['show_in_home']))
    {
        update_post_meta($post_id, 'show_in_home', $_REQUEST['show_in_home']);
    }
    /* code to create a directory if it is not found */

}
?>