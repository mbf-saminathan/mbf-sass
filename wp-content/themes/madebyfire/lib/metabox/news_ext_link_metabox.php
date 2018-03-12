<?php
add_action('admin_menu', 'news_link_options');

function news_link_options() {
    add_meta_box('news_link_options', 'External link', 'news_link_options_design', 'news');
}

function news_link_options_design($post_id) {
    global $post;
    $external_link = get_post_meta($post->ID, 'external_link', true);    
    $new_window = get_post_meta($post->ID, 'new_window', true);
    $image_path = wp_upload_dir();
    $base_dir = $image_path['baseurl'];
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order">News External link</label></td>
            <td  class="right" width="200"><input type="text" id="external_link" name="external_link" value="<?php echo $external_link; ?>"></td>
            <td><select name="new_window" id="new_window">
            <option value="new_window" <?php if($new_window=="new_window") { echo 'selected';}?>>Open in New window</option>
            <option value="same_window" <?php if($new_window=="same_window") { echo 'selected';}?>>Open in same window</option>
            
            </select></td>
        </tr>
    </table>    
    <?php
}

add_action('save_post', 'save_news_link_options');

function save_news_link_options($post_id) {
    global $post;

// do not save if this is an auto save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if($post->post_type=="news" && isset($_REQUEST['external_link']))
    {
        update_post_meta($post_id, 'external_link', $_REQUEST['external_link']);
    }
    
    if($post->post_type=="news" && isset($_REQUEST['new_window']))
    {
        update_post_meta($post_id, 'new_window', $_REQUEST['new_window']);
    }
    /* code to create a directory if it is not found */

}
?>
