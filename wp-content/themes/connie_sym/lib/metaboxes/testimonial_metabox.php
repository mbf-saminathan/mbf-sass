<?php
add_action('admin_menu', 'testimonial_metabox_options');

function testimonial_metabox_options() {
    $types = array( 'testimonial');
    foreach( $types as $type ) {
        add_meta_box('testimonial_metabox_options', 'Testimonial settings', 'testimonial_metabox_options_design', $type);
    }
}

function testimonial_metabox_options_design($post_id) {
    global $post;
    $name = get_post_meta($post->ID, 'name', true);
    $position = get_post_meta($post->ID, 'position', true);
    $year = get_post_meta($post->ID, 'year', true);
    ?>
    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='ground_floor' class='fontsize10'   style='font-size: 11px;'>
                <tr> 
                    <td class="left"><label for="tax-order">Name</label></td>
                    <td  class="right">
                        <input type="text" name="name" value="<?php  echo $name; ?>" />
                    </td>
                </tr> 
                <tr> 
                    <td class="left"><label for="tax-order">Position</label></td>
                    <td  class="right">
                        <input type="text" name="position" value="<?php  echo $position; ?>"/>
                    </td>
                </tr> 
                <tr> 
                    <td class="left"><label for="tax-order">Year</label></td>
                    <td  class="right">
                        <input type="text" name="year" value="<?php  echo $year; ?>"/>
                    </td>
                </tr> 
        </table>
    </div>   
<?php }

add_action('save_post', 'save_testimonial_metabox');

function save_testimonial_metabox($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;  
        if(array_key_exists('name', $_REQUEST))
        {
            update_post_meta($post_id, 'name', $_REQUEST['name']);
        }
        if(array_key_exists('position', $_REQUEST))
        {
            update_post_meta($post_id, 'position', $_REQUEST['position']);
        }
         if(array_key_exists('year', $_REQUEST))
        {
            update_post_meta($post_id, 'year', $_REQUEST['year']);
        }
}
?>
