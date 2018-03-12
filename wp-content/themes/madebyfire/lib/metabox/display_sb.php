<?php
add_action('admin_menu', 'disp_sb_metabox');

function disp_sb_metabox() {
    $arrPosttypes = array('page','portfolio');
    foreach ($arrPosttypes as $key => $arrPosttypes) {
        add_meta_box('Disp_sb_metaboxcb', 'Display in Sidebar', 'disp_sb_metaboxcb', $arrPosttypes ,"side");
    }
    
}

function disp_sb_metaboxcb($post_id) {
    global $post;
    $dispSb = get_post_meta($post->ID, 'dispSb', true);
    ?>
    <table>
    <tr>
        <td class="left">Display Sidebar: </td>
        <td class="right">
           <input type="checkbox" id="dispSb" name="dispSb" value="1" <?php if($dispSb=="1"){ echo "checked='checked'"; } ?>>
            </select>
        </td>
    </tr>
    </table>
    <?php
}

add_action('save_post', 'save_sb_mb');

function save_sb_mb($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    update_post_meta($post_id, 'dispSb', $_REQUEST['dispSb']);
}
?>