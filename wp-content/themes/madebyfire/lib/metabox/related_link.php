<?php
add_action('admin_menu', 'related_link_options');

function related_link_options() {
add_meta_box('related_link_options', 'Related link', 'related_link_options_design', 'portfolio');
}

function related_link_options_design($post_id) {
    global $post;
    //for($i=0; $i<count($_REQUEST['gf_flat_name']); $i++){   
   
    $rl_link_text = get_post_meta($post->ID, 'rl_link_text', true);   
    $rl_link_url = get_post_meta($post->ID, 'rl_link_url', true);
    $link_heading = get_post_meta($post->ID, 'link_heading', true);   
    $rl_link_target = get_post_meta($post->ID, 'rl_link_target', true);
    ?>
   

    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
            <tr>
            <td class="left"><label for="tax-order">Title</label></td>
            <td  class="right">
			<input type="textbox" name="link_heading" id="link_heading" value="<?php echo $link_heading; ?>" style="width: 100%;"></td>
        </tr>
    <?php for ($j = 0; $j < count($rl_link_text); $j++) { ?>
                <tr>       
                    <td><label for="tax-order">Link Text</label></td>
                    <td><input type="text" name="rl_link_text[]" value="<?php echo $rl_link_text[$j]; ?>" id="rl_link_text[]" style="width:170px;"/></td>
                    <td><label for="tax-order">Link Url</label></td>
                    <td><input type="text" name="rl_link_url[]"  value="<?php echo $rl_link_url[$j]; ?>" id="rl_link_url[]" style="width:170px;"/></td>
                    <td>
                       <select name="rl_link_target[]"><option value="_self" <?php if($rl_link_target[$j]=="_self"){ echo "selected='selected'"; } ?>>Self</option>
                    <option value="_blank" <?php if($rl_link_target[$j] =="_blank"){ echo "selected='selected'"; } ?>>New tab</option></select>     
                    </td>
                    <td align="right">
                        <?php if ($j == 0) { ?><span class='curpointer button' onclick="addRow_band('ground_floor', 'rl')"><b> + </b></span>  <?php } else {
                ?><span class='curpointer button' onclick="deleteCurrentRow_band(this)"><b> - </b></span>          <?php } ?>
                    </td>
                </tr> 
    <?php } ?>
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_related_link');

function save_related_link($post_id) {
    global $post;

    get_post_type($post_id);

    //if (get_post_type($post_id) == 'project_post') {

        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;  

        for ($i = 0; $i < count($_REQUEST['rl_link_text']); $i++) {            
            update_post_meta($post_id, 'rl_link_text', $_REQUEST['rl_link_text']);
            update_post_meta($post_id, 'rl_link_url', $_REQUEST['rl_link_url']);
            update_post_meta($post_id, 'rl_link_target', $_REQUEST['rl_link_target']);
         }
         update_post_meta($post_id, 'link_heading', $_REQUEST['link_heading']);
    //}
}
?>
