<?php
add_action('admin_menu', 'related_link_options');

function related_link_options() {
    $types = array( 'post', 'page','banner','recipe','fitness');
    foreach( $types as $type ) {
        add_meta_box('related_link_options', 'External link', 'related_link_options_design', $type);
    }
}

function related_link_options_design($post_id) {
    global $post;
        $linkHeading = get_post_meta($post->ID, 'linkHeading', true);
        $rlLinkUrl = get_post_meta($post->ID, 'rlLinkUrl', true);
        $rlLinkTarget = get_post_meta($post->ID, 'rlLinkTarget', true);
        $pounds = get_post_meta($post->ID, 'pounds', true);
    ?>
    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Link Title</label></td>
                    <td  class="right">
                        <input type="textbox" name="linkHeading" id="linkHeading" value="<?php echo $linkHeading; ?>" style="width: 100%;">
                    </td>      
                    
                    <td><label for="tax-order">Link Url</label></td>
                    <td><input type="text" name="rlLinkUrl"  value="<?php echo $rlLinkUrl; ?>" id="rlLinkUrl" style="width:170px;"/></td>
                    <td>
                       <select name="rlLinkTarget"><option value="_self" <?php if($rlLinkTarget=="_self"){ echo "selected='selected'"; } ?>>Self</option>
                    <option value="_blank" <?php if($rlLinkTarget =="_blank"){ echo "selected='selected'"; } ?>>New tab</option></select>     
                    </td>
                    <td class="left"><label for="tax-order">Pounds</label></td>
                    <td  class="right">
                        <input type="textbox" name="pounds" id="pounds" value="<?php echo $pounds; ?>" style="width: 100%;">
                    </td>      
                </tr> 
        </table>
    </div>   
    <?php } 

add_action('save_post', 'save_related_link');

function save_related_link($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;  
        if(array_key_exists('linkHeading', $_REQUEST))
        {
            update_post_meta($post_id, 'linkHeading', $_REQUEST['linkHeading']);
        }
        if(array_key_exists('rlLinkUrl', $_REQUEST))
        {
            update_post_meta($post_id, 'rlLinkUrl', $_REQUEST['rlLinkUrl']);
        }
        if(array_key_exists('rlLinkTarget', $_REQUEST))
        {
            update_post_meta($post_id, 'rlLinkTarget', $_REQUEST['rlLinkTarget']);
        }
        if(array_key_exists('pounds', $_REQUEST))
        {
            update_post_meta($post_id, 'pounds', $_REQUEST['pounds']);
        }
}
?>
