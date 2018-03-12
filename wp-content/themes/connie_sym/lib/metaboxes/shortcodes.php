<?php

add_action('admin_menu', 'short_code');

function short_code() {
    $types = array( 'post', 'page', 'recipe', 'fitness', 'beauty');
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
            <td class="left heading">[span]</td>
            <td  class="right description" ><p>Span tag.</p></td>
        </tr>
        <tr>
            <td class="left heading">[break_tag]</td>
            <td  class="right description" ><p>Break tag.</p></td>
        </tr>
         <tr>
            <td class="left heading">[div_tag]</td>
            <td  class="right description" ><p>Div tag.</p></td>
        </tr>
         <tr>
            <td class="left heading">[row]</td>
            <td  class="right description" ><p>It will add row container.</p></td>
        </tr>
        <tr>
            <td class="left heading">[full_column]</td>
            <td  class="right description" ><p>It will add full width container</p></td>
        </tr>
         <tr>
            <td class="left heading">[two_column]</td>
            <td  class="right description" ><p>It will add seperate half width column for current container column.(to use as two column for content)  </p></td>
        </tr>
         <tr>
            <td class="left heading">[twocol_image]</td>
            <td  class="right description" ><p>It will enable to put image as two column </p></td>
        </tr>
         <tr>
            <td class="left heading">[twocol_img_cont]</td>
            <td  class="right description" ><p>Two column image Container.</p></td>
        </tr>
        <tr>
            <td class="left heading">[center_blk_column]</td>
            <td  class="right description" ><p>It will add two third of current container container with center aligned block.</p></td>
        </tr>
        <tr>
            <td class="left heading">[quote_head]</td>
            <td  class="right description" ><p>In order to put quote on respective pages.</p></td>
        </tr>
         <tr>
            <td class="left heading">[accordion]</td>
            <td  class="right description" ><p>Container for about us content.</p></td>
        </tr>
         <tr>
            <td class="left heading">[accord_cont]</td>
            <td  class="right description" ><p>Need to add for each row of accordion.</p></td>
        </tr>
         <tr>
            <td class="left heading">[accordion_content]</td>
            <td  class="right description" ><p>Container for accordion content.</p></td>
        </tr>
         <tr>
            <td class="left heading">[abt_lft]</td>
            <td  class="right description" ><p>The container for about us content with right side image</p></td>
        </tr>
         <tr>
            <td class="left heading">[abtlft_cont]</td>
            <td  class="right description" ><p>It will add Content for about us with right side image</p></td>
        </tr>
         <tr>
            <td class="left heading">[abtlft_img]</td>
            <td  class="right description" ><p>It will enable image on right side on about us section</p></td>
        </tr>
         <tr>
            <td class="left heading">[abt_rgt]</td>
            <td  class="right description" ><p>The container for about us content with left side image</p></td>
        </tr>
         <tr>
            <td class="left heading">[abtrgt_cont]</td>
            <td  class="right description" ><p>It will add Content for about us with left side image</p></td>
        </tr>
         <tr>
            <td class="left heading">[abtrgt_img]</td>
            <td  class="right description" ><p>It will enable image on left side on about us section</p></td>
        </tr>
    </table>
    <?php
}
?>