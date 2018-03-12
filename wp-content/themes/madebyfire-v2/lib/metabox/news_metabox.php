<?php
add_action('admin_menu', 'news_options');

function news_options() {
    add_meta_box('news_options', 'News Design Options', 'news_options_design', 'news');
}

function news_options_design($post_id) {
    global $post;
    $design_type = get_post_meta($post->ID, 'design_type', true);  
    $display_home = get_post_meta($post->ID, 'display_home', true);   
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order">Show in home</label></td>
            <td  class="right" width="400">
            <select name="display_home" id="display_home">
            <option value="no" <?php if($display_home=="no") { echo 'selected';}?>>No</option>
            <option value="yes" <?php if($display_home=="yes") { echo 'selected';}?>>Yes</option>
            
            </select></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Design type in news list</label></td>
            <td  class="right" width="400">
            <select name="design_type" id="design_type">
            <option value="normal" <?php if($design_type=="normal") { echo 'selected';}?>>Normal</option>
            <option value="background_image" <?php if($design_type=="background_image") { echo 'selected';}?>>Background Image</option>
            <option value="background_color" <?php if($design_type=="background_color") { echo 'selected';}?>>Background Color</option>
            <option value="newsletter" <?php if($design_type=="newsletter") { echo 'selected';}?>>Newsletter</option>
            </select></td>
        </tr>
    </table>    
    <?php
}

add_action('save_post', 'save_news_options');

function save_news_options($post_id) {
    global $post;

// do not save if this is an auto save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if($post->post_type=="news" && isset($_REQUEST['design_type']))
    {
        update_post_meta($post_id, 'design_type', $_REQUEST['design_type']);
    }
    if($post->post_type=="news" && isset($_REQUEST['display_home']))
    {
        update_post_meta($post_id, 'display_home', $_REQUEST['display_home']);
    }
    

    /* code to create a directory if it is not found */

}

add_action('admin_menu', 'news_image_options');

function news_image_options() {
    add_meta_box('news_image_options', 'Image Size Settings', 'news_image_design', 'news', 'side');
}

function news_image_design($post_id) {      
    ?>
    <table class="pdf" cellpadding="0" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order"><b>Case study image size</b></label></td>            
        </tr>
        <tr>            
            <td  class="right">Width: 470px  Height: 334px</td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order"><b>News image size</b></label></td>            
        </tr>
        <tr>            
            <td  class="right">Width: 225px  Height: 171px</td>
        </tr>
    </table>    
    <?php
}
?>