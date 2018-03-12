<?php
add_action('admin_menu', 'project_options');

function project_options() {
    add_meta_box('project_options', 'Project Options', 'project_options_design', 'project');
}

function project_options_design($post_id) {
    global $post;
    $assigned_users = get_post_meta($post->ID, 'assigned_users', true);
    $assigned_user_lists = explode(",", $assigned_users);  
    $setproject = get_post_meta($post->ID, 'setproject', true);
    $target_option = get_post_meta($post->ID, 'target_option', true); 
    $args=array('role' => 'subscriber');
    $user_lists = get_users( $args );
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">
        <tr>
            <td class="left"><label for="tax-order">Assign users</label></td>
            <td  class="right" width="400">
                <select name="assigned_users[]" multiple="" style="width:200px;">
                    <?php foreach($user_lists as $user_list){
                        $assigned_projects = get_user_meta($user_list->ID, 'assigned_projects', true);
                        $assigned_project_lists = explode(",", $assigned_projects);
                        ?>
                        <option value="<?php echo $user_list->ID; ?>" <?php if(in_array($post->ID, $assigned_project_lists)){ echo 'selected="selected"'; } ?>><?php echo $user_list->display_name; ?></option>
                    <?php }?>
                </select>
            </td>          
        </tr>
        <?php /*?><tr>
            <td class="left"><label for="tax-order">External url</label></td>
            <td  class="right" width="400">
                <input type="text" name="external_url" value="<?php echo $external_url; ?>"/>
            </td>          
        </tr><?php */?>
        <?php
            // Get path directory for project
            $getProjectpath = ABSPATH.'demo';
            $directories = glob($getProjectpath . '/*' , GLOB_ONLYDIR);
            
        ?>
        <tr>
            <td class="left"><label for="tax-order">Select project</label></td>
            <td  class="right" width="400">
                <select name="setproject" id="setproject">
                    <option value="">Select</option>
                    <?php 
                    foreach($directories as $directory) {

                        $getfile = explode('/', $directory);
                        $fileName = end($getfile);
                        ?>
                        <option value="<?php echo $fileName; ?>" <?php if($setproject==$fileName){ echo 'selected';} ?>><?php echo $fileName; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>          
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Open in</label></td>
            <td  class="right" width="400">
                <select name="target_option"> 
                    <option value="">Select</option>                   
                    <option value="_self" <?php if($target_option=="_self"){ echo 'selected="selected"'; } ?>>Self</option>
                    <option value="_blank" <?php if($target_option=="_blank"){ echo 'selected="selected"'; } ?>>New window</option>               
                </select>
            </td>          
        </tr>
    </table>    
    <?php
}

add_action('save_post', 'save_project_options');

function save_project_options($post_id) {
    global $post;
    // do not save if this is an auto save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if($post->post_type=="project")
    {
        $args=array('role' => 'subscriber');
        $user_lists = get_users( $args );
        if(count($user_lists)>0)
        {
            foreach($user_lists as $user_list)
            {
                $assigned_projects = "";
                $assigned_project_lists = "";
                $assigned_projects = get_user_meta($user_list->ID, 'assigned_projects', true);
                $assigned_project_lists = explode(",", $assigned_projects);                
                if(in_array($user_list->ID, $_REQUEST['assigned_users']))
                {
                    if(($key = array_search($post->ID, $assigned_project_lists)) === false) {
                        array_push($assigned_project_lists, $post->ID);
                    }
                }
                else
                {                    
                    if(($key = array_search($post->ID, $assigned_project_lists)) !== false) {
                        unset($assigned_project_lists[$key]);
                    }
                }
                $assigned_project_lists = array_filter($assigned_project_lists);
                $assigned_project_list_values = implode(',', $assigned_project_lists);
                update_user_meta($user_list->ID, 'assigned_projects', $assigned_project_list_values);
            }
        }        
        if(isset($_REQUEST['setproject']) && $_REQUEST['setproject']!="")
        {
            update_post_meta($post_id, 'setproject', $_REQUEST['setproject']);
        }
        if(isset($_REQUEST['target_option']) && $_REQUEST['target_option']!="")
        {
            update_post_meta($post_id, 'target_option', $_REQUEST['target_option']);
        }
    }
}
?>