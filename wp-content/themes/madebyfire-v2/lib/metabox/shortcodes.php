<?php

add_action('admin_menu', 'short_code');

function short_code() {
    $types = array( 'post', 'page','banner','blogs','leader','testimonials' );
foreach ($types as $type){
    add_meta_box('shortCodes', 'Add Short Codes', 'short_codes', $type,'normal', 'high');
}

}

function short_codes($post_id) {
    global $post;
    ?>

    <table class="shtCode" style="width:100%">
        <tr>
            <th style="text-align: left"><label for="image_left_aside">Short Codes</label></th>
            <th style="text-align: left"><p>Description</p></th>
    </tr>
    <tr>
        <td class="left heading">[introcontent]</td>
        <td  class="right description" ><p>Introduction</p></td>
    </tr>
    <tr>
        <td class="left heading">[intro_block]</td>
        <td  class="right description" ><p>Introduction block</p></td>
    </tr>
    <tr>
        <td class="left heading">[figure]</td>
        <td  class="right description" ><p>Figure</p></td>
    </tr>
    <tr>
        <td class="left heading">[figure_without_caption]</td>
        <td  class="right description" ><p>Figure without caption</p></td>
    </tr>
    <tr>
        <td class="left heading">[figure_caption]</td>
        <td  class="right description" ><p>Figure caption</p></td>
    </tr>
     <tr>
        <td class="left heading">[colum_row]</td>
        <td  class="right description" ><p>For single row</p></td>
    </tr>
    <tr>
        <td class="left heading">[span]</td>
        <td  class="right description" ><p>Span</p></td>
    </tr>
    <tr>
        <td class="left heading">[two_colum]</td>
        <td  class="right description" ><p>For two column</p></td>
    </tr>
    <tr>
        <td class="left heading">[said_by]</td>
        <td  class="right description" ><p>For blockquote author</p></td>
    </tr>
    <tr>
        <td class="left heading">[hist_wrap]</td>
        <td  class="right description" ><p>About us history wrapper</p></td>
    </tr>
    <tr>
        <td class="left heading">[hist_sld]</td>
        <td  class="right description" ><p>About us history slider</p></td>
    </tr>
    <tr>
        <td class="left heading">[hist_wrap_cont]</td>
        <td  class="right description" ><p>About us history wrapper content</p></td>
    </tr>
    <tr>
        <td class="left heading">[proj_cont]</td>
        <td  class="right description" ><p>Soul wrapper</p></td>
    </tr>
    <tr>
        <td class="left heading">[proj_desc_content]</td>
        <td  class="right description" ><p>About us right content</p></td>
    </tr>
     <tr>
        <td class="left heading">[button_link]</td>
        <td  class="right description" ><p>For button link</p></td>
    </tr>
     <tr>
        <td class="left heading">[proj_desc_img]</td>
        <td  class="right description" ><p>About us description image</p></td>
    </tr>
    <tr>
        <td class="left heading">[generic_list]</td>
        <td  class="right description" ><p>Generic list</p></td>
    </tr>
    <tr>
        <td class="left heading">[video_frame]</td>
        <td  class="right description" ><p>Video frame</p></td>
    </tr>
    <tr>
        <td class="left heading">[split_full_width]</td>
        <td  class="right description" ><p>Full width section for two column</p></td>
    </tr>
    <tr>
        <td class="left heading">[card_section]</td>
        <td  class="right description" ><p>Card section</p></td>
    </tr>
    <tr>
        <td class="left heading">[single_card]</td>
        <td  class="right description" ><p>Card single</p></td>
    </tr>
    <tr>
        <td class="left heading">[card_excerpt]</td>
        <td  class="right description" ><p>Card excerpt section</p></td>
    </tr>
    </table>
    <?php

}
?>