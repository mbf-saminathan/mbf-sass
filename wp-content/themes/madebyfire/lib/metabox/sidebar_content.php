<?php
add_action('admin_menu', 'sidebar_content_options');

function sidebar_content_options() {
     foreach (array('page','team','portfolio','project','news','case_studies') as $type) {	
    add_meta_box('sidebar_content_options', 'Sidebar Content', 'sidebar_content_options_design', $type);
	}
}

function sidebar_content_options_design($post_id) {
    global $post;
    $sidebar_title = get_post_meta($post->ID, 'sidebar_title', true);
    $sidebar_content_options_design = get_post_meta($post->ID, 'sidebar_content_options_design', true);
    ?>
    <table cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="sidebar_content_options_design">Title : </label></td>
            <td  class="right" >
                <input type="textbox" id="sidebar_title" name="sidebar_title" value="<?php echo $sidebar_title; ?>">
            </td>
        </tr>
        <tr>
            <td class="left"><label for="sidebar_content_options_design">Content : </label></td>
            <td  class="right" >
                <textarea id="sidebar_content_options_design" name="sidebar_content_options_design" rows="5" cols="100"><?php echo $sidebar_content_options_design; ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post', 'save_sidebar_content_options');

function save_sidebar_content_options($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if(isset($_POST['sidebar_title'])){
        update_post_meta($post_id, 'sidebar_title',$_POST['sidebar_title']);
    }
    if(isset($_POST['sidebar_content_options_design'])){
        update_post_meta($post_id, 'sidebar_content_options_design',$_POST['sidebar_content_options_design']);
    }
}
?>
