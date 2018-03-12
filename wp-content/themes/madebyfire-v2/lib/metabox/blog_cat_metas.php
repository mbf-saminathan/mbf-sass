<?php
/** Add Custom Field To Category Form */
add_action( 'blog_cat_add_form_fields', 'category_form_custom_field_add', 10 );
add_action( 'blog_cat_edit_form_fields', 'category_form_custom_field_edit', 10, 2 );
 
function category_form_custom_field_add( $taxonomy ) {
?>
<tr>
        <td class="left"><label for="tax-order">Short Description</label></td>
        <td><textarea cols="60" name="short_desc" id="short_desc" rows="5"><?php echo stripslashes($short_desc); ?> </textarea></td>    
        </td>
    </tr>
<tr>
    
    <td class="left"><label for="tax-order">Design type in news list</label></td>
        <td  class="right" width="400">
            <select name="design_type" id="design_type">
                <option value="normal" <?php if($design_type=="normal") { echo 'selected';}?>>Normal</option>
                <option value="background_image" <?php if($design_type=="background_image") { echo 'selected';}?>>Background Image</option>
                <option value="background_color" <?php if($design_type=="background_color") { echo 'selected';}?>>Background Color</option>
        </select>
        </td>
    </tr>
    <tr>
        <td class="left"><label for="tax-order">Template Type</label></td>
            <td  class="right" width="400">
                <select name="template_type" id="template_type">
                    <option value="normal" <?php if($template_type=="normal") { echo 'selected';}?>>Normal</option>
                    <option value="accordion_type" <?php if($template_type=="accordion_type") { echo 'selected';}?>>Accordion type</option>
            </select>
        </td>
    </tr>
    
<?php
}
function category_form_custom_field_edit( $tag, $taxonomy ) {
    $option_name = 'blog_cat_design_type_' . $tag->term_id;
    $option_name_templ = 'blog_cat_template_type_' . $tag->term_id;
    $option_short_desc = 'blog_cat_short_desc_' . $tag->term_id;
    $category_design_type = get_option( $option_name );
    $template_type = get_option( $option_name_templ );
    $short_desc = get_option($option_short_desc);
?>
    <tr>
        <td class="left"><label for="tax-order">Short Description</label></td>
           <td><textarea rows="5" name="short_desc" id="short_desc" cols="60"><?php echo stripslashes($short_desc); ?> </textarea></td>    
        </td>
    </tr>
    <tr>
        <td class="left"><label for="tax-order">Design type in Blog list</label></td>
            <td  class="right" width="400">
                <select name="design_type" id="design_type">
                    <option value="normal" <?php if($category_design_type=="normal") { echo 'selected';}?>>Normal</option>
                    <option value="background_image" <?php if($category_design_type=="background_image") { echo 'selected';}?>>Background Image</option>
                    <option value="background_color" <?php if($category_design_type=="background_color") { echo 'selected';}?>>Background Color</option>
            </select>
            </td>
        </tr>
    <tr>
        <td class="left"><label for="tax-order">Template Type</label></td>
            <td  class="right" width="400">
                <select name="template_type" id="template_type">
                    <option value="normal" <?php if($template_type=="normal") { echo 'selected';}?>>Normal</option>
                    <option value="accordion_type" <?php if($template_type=="accordion_type") { echo 'selected';}?>>Accordion type</option>
            </select>
        </td>
    </tr>
    
<?php
}
 
/** Save Custom Field Of Category Form */
add_action( 'created_blog_cat', 'category_form_custom_field_save', 10, 2 ); 
add_action( 'edited_blog_cat', 'category_form_custom_field_save', 10, 2 );
 
function category_form_custom_field_save( $term_id, $tt_id ) {
    if ( isset( $_POST['design_type'] ) ) {
        $option_name = 'blog_cat_design_type_' . $term_id;
        update_option( $option_name, $_POST['design_type'] );
    }
    if ( isset( $_POST['template_type'] ) ) {
        $option_name_templ = 'blog_cat_template_type_' . $term_id;
        update_option( $option_name_templ, $_POST['template_type'] );
    }
    if ( isset( $_POST['short_desc'] ) ) {
        $option_short_desc = 'blog_cat_short_desc_' . $term_id;
        update_option( $option_short_desc, $_POST['short_desc'] );
    }
}
