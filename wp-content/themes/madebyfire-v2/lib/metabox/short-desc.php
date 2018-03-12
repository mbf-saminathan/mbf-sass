<?php
add_action('admin_menu', 'short_desc_options');

function short_desc_options() {
     foreach (array('page','team','portfolio','project','news','case_studies') as $type) {	
    add_meta_box('short_desc_options', 'Short description', 'short_desc_options_design', $type);
	}
}

function short_desc_options_design($post_id) {
    global $post;
    $short_desc_options_design = get_post_meta($post->ID, 'short_desc_options_design', true);
    ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="short_desc_options_design">Content : </label></td>
            <td  class="right" >
                <textarea id="short_desc_options_design" name="short_desc_options_design" rows="5" cols="100"><?php echo $short_desc_options_design; ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post', 'save_short_desc_options');

function save_short_desc_options($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    
    if(isset($_POST['short_desc_options_design'])){
        update_post_meta($post_id, 'short_desc_options_design',$_POST['short_desc_options_design']);
    }
}
?>
