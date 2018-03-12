<?php
add_action('admin_menu', 'common_metabox_options');

function common_metabox_options() {
    $types = array( 'post', 'page','banner','recipe','fitness','beauty');
    foreach( $types as $type ) {
        add_meta_box('common_metabox_options', 'Post settings', 'common_metabox_options_design', $type);
    }
}

function common_metabox_options_design($post_id) {
    global $post;
    $showInHome = get_post_meta($post->ID, 'show_in_home', true);
    ?>
    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Show in home</label></td>
                    <td  class="right">
                        <select name="show_in_home">
                            <option <?php if($showInHome=="no"){ echo 'selected'; } ?> value="no">No</option>
                            <option <?php if($showInHome=="yes"){ echo 'selected'; } ?> value="yes">Yes</option>                            
                        </select>
                    </td>
                </tr> 
        </table>
    </div>   
<?php }

add_action('save_post', 'save_common_metabox');

function save_common_metabox($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;  
        if(array_key_exists('show_in_home', $_REQUEST))
        {
            update_post_meta($post_id, 'show_in_home', $_REQUEST['show_in_home']);
        }
}
?>
