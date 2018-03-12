<?php

//   Category Meta Box for Product


add_action('portfolio_categories_edit_form_fields', 'category_metabox_edit_product', 10, 1);


function category_metabox_edit_product($tag) {
    $iconImage = get_term_meta($_REQUEST['tag_ID'], 't_order', true);
    var_dump($iconImage);
    ?>
    <table class="form-table">
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="cat_order">Show Index Icon Image</label>
            </th>
            <td>
                <input type="text" name="order" id="order"  style="width:200px;" value="<?php
                if ($iconImage) {
                    echo $iconImage;
                }
                ?>" />
                <p class="description"></p>
            </td>
        </tr> 
    </table>
    <?php
}


add_action('edited_portfolio_categories', 'save_catodr_meta_data_product', 10, 1);


function save_catodr_meta_data_product($term_id) {

    update_term_meta($term_id, 't_order', $_POST['order']);

}
?>