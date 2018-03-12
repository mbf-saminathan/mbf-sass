<?php
add_action('admin_menu', 'whatwedo_options');

function whatwedo_options() {
    add_meta_box('whatwedo_options', 'What we do', 'whatwedo_options_design', 'page');
}

function whatwedo_options_design($post_id) {
    global $post;
    $assigned_case_studies = get_post_meta($post->ID, 'assigned_case_studies', true);
    //var_dump($assigned_case_studies);
    $assigned_case_studies_lists = explode(",", $assigned_case_studies);
    $args = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1
            );
    $case_studies_tot = get_posts($args); 
  
    ?>
    <table>
        <tr>
            <label for="tax-order" style="width: 15%; display: block; float: left; text-align: right; margin: 7px 1% 0 0; line-height: 1.4em;">Show Case:</label>
            <td>
                <select name="assigned_case_studies[]" multiple="multiple" style="overflow: auto; width: 660px; height: 250px; margin: 0; list-style: none; border: solid 1px #dedede;
    float: left; background: #fff;">
                    <?php foreach($case_studies_tot as $assigned_case){
                         $selected = (in_array($assigned_case->ID, $assigned_case_studies))?'selected="selected"':'';
                        ?>
                        <option value="<?php echo $assigned_case->ID; ?>" <?php echo $selected; ?>><?php echo $assigned_case->post_title; ?></option>
                    <?php }?>
                </select>
            </td>          
        </tr>
    </table>    
    <?php
}

add_action('save_post', 'save_whatwedo_options');

function save_whatwedo_options($post_id) {
    global $post;
    // do not save if this is an auto save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    //if($post->post_type=="project")
    //{
        $args = array(
            'post_type' => 'case_studies',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1
            );
    $case_studies_tot = get_posts($args); 


                update_post_meta($post->ID, 'assigned_case_studies', $_REQUEST['assigned_case_studies']);
           // }
            //}
        //}        
        
   // }
}
?>
