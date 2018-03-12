<?php
add_action('admin_menu', 'rightnav_link_options');

function rightnav_link_options() {
    foreach (array('page','team','portfolio','project','news','case_studies','job','location','service') as $type) {   
add_meta_box('rightnav_link_options', 'Right Navigation links', 'rightnav_link_options_design', $type);
}
}

function rightnav_link_options_design($post_id) {
    global $post;
    $rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
    $rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
    $rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
    $link_heading = get_post_meta($post->ID, 'link_heading', true);
    ?>
   

    <div id="groundDiv" <?php echo $firstCls; ?> >       
        <table cellpadding="2" cellspacing="3" border="0" id='rgtlink_floor' class='fontsize10'   style='font-size: 11px;'>
            <tr>
            <td class="left"><label for="tax-order">Title</label></td>
            <td  class="right">
			<input type="textbox" name="link_heading" id="link_heading" value="<?php echo $link_heading; ?>" style="width: 100%;"></td>
        </tr>
    <?php for ($j = 0; $j < count($rn_link_text); $j++) { ?>
                <tr>       
                    <td><label for="tax-order">Link Text</label></td>
                    <td><input type="text" name="rn_link_text[]" value="<?php echo $rn_link_text[$j]; ?>" id="rn_link_text[]" style="width:170px;"/></td>
                    <td><label for="tax-order">Link Url</label></td>
                    <td><input type="text" name="rn_link_url[]"  value="<?php echo $rn_link_url[$j]; ?>" id="rn_link_url[]" style="width:170px;"/></td>
                    <td>
                       <select name="rn_link_target[]">
                        <option value="">Select</option>
                        <option value="_self" <?php if($rn_link_target[$j]=="_self"){ echo "selected='selected'"; } ?>>Self</option>
                        <option value="_blank" <?php if($rn_link_target[$j] =="_blank"){ echo "selected='selected'"; } ?>>New tab</option></select>     
                    </td>
                    <td align="right">
                        <?php if ($j == 0) { ?><span class='curpointer button' onclick="addRow_band('rgtlink_floor', 'rn')"><b> + </b></span>  <?php } else {
                ?><span class='curpointer button' onclick="deleteCurrentRow_band(this)"><b> - </b></span>          <?php } ?>
                    </td>
                </tr> 
    <?php } ?>
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_rightnav_link');

function save_rightnav_link($post_id) {
    global $post;

    get_post_type($post_id);

    //if (get_post_type($post_id) == 'project_post') {

        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;  

        for ($i = 0; $i < count($_REQUEST['rn_link_text']); $i++) {            
            update_post_meta($post_id, 'rn_link_text', $_REQUEST['rn_link_text']);
            update_post_meta($post_id, 'rn_link_url', $_REQUEST['rn_link_url']);
            update_post_meta($post_id, 'rn_link_target', $_REQUEST['rn_link_target']);
         }
         update_post_meta($post_id, 'link_heading', $_REQUEST['link_heading']);
    //}
}
?>
<script>
 function addRow_band(tableID, flrprefix) 
{
    //var turl = document.getElementById('temp_url').value;
    var table_band = document.getElementById(tableID);
    console.log('here');
    console.log(table_band);
    var rowCount_band = table_band.rows.length;
    var row_band = table_band.insertRow(rowCount_band);
    
  
    
    var cell1 = row_band.insertCell(0);
    var element1 = document.createElement("label");//element1.for = "cat_order";
    element1.innerHTML="Link Text";
    cell1.appendChild(element1);

    var cell2 =row_band.insertCell(1);
    var element2 = document.createElement("span");
    element2.innerHTML="<input type='text' name='"+flrprefix+"_link_text[]' value='' id='"+flrprefix+"_link_text[]' style=\"width:170px;\" />";
    cell2.appendChild(element2);  
    
    var cell3 = row_band.insertCell(2);
    var element3 = document.createElement("label");//element1.for = "cat_order";
    element3.innerHTML="Link Url";
    cell3.appendChild(element3);
    
    var cell4 =row_band.insertCell(3);
    var element4 = document.createElement("span");
    element4.innerHTML="<input type='text' name='"+flrprefix+"_link_url[]' value='' id='"+flrprefix+"_link_url[]' style=\"width:170px;\" />";
    cell4.appendChild(element4);
    

    var cell5 =row_band.insertCell(4);
    var element5 = document.createElement("span");
    element5.innerHTML='<select name="'+flrprefix+'_link_target[]" id="'+flrprefix+'_link_target[]"><option value="_self">Self</option><option value="_blank">New tab</option></select>';
    cell5.appendChild(element5);
    
    var cell6 =row_band.insertCell(5);
    var element6 = document.createElement("span");
    element6.innerHTML="<a href=\"javascript:void(0)\" class=\"button\" onclick=\"deleteCurrentRow_band(this)\" style=\"margin-left:5px;\"> - </a>";
    cell6.appendChild(element6);
}
function thisRow(obj) 
{
    var tr1 = obj;
    while ( tr1 && tr1.nodeName != 'TR' ){    tr1 = tr1.parentNode;   }
    return tr1;
}

function deleteCurrentRow_band(obj)
{   
    console.log(obj);
    var delRow = thisRow(obj);
    var tbl = delRow.parentNode.parentNode;
    var rIndex = delRow.sectionRowIndex;
    var rowArray = new Array(delRow);
    deleteRows_band(rowArray);              
}

function deleteRows_band(rowObjArray)
{
    for (var i=0; i<rowObjArray.length; i++) 
    {
        var rIndex = rowObjArray[i].sectionRowIndex;
        rowObjArray[i].parentNode.deleteRow(rIndex);
    }
}

</script>