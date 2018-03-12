   jQuery(document).ready(function() {
    jQuery("form").attr("enctype", "multipart/form-data");
	
	//map
	 jQuery('.mapLocation').click(function(e) {
    var offset = jQuery(this).offset();
	var xc_m = Math.round(((e.clientX+jQuery(document).scrollLeft()) - offset.left));
	var yc_m = Math.round(((e.clientY+jQuery(document).scrollTop()) - offset.top));
    document.getElementById('map_x').value = xc_m;
   	document.getElementById('map_y').value = yc_m;
	jQuery('.mapLocation a').css("top",(yc_m-17));
	jQuery('.mapLocation a').css("left",(xc_m-2));
     });
	      });



function isValiddoc(imagename)
{	
	imagefile_value = imagename.value;
	var checkimg = imagefile_value.toLowerCase();
	if (!checkimg.match(/(\.pdf|\.xls|\.txt|\.doc|\.PDF|\.XLS|\.DOC|\.docx|\.DOCX)$/))
	{
		alert("Please Upload Pdf or Document File Only");
		imagename.focus(); 
		imagename.value="";
		return false;
	}
	else
	{
		return true;
	}
}

function addRow_band(tableID, flrprefix) 
{
    //var turl = document.getElementById('temp_url').value;
    var table_band = document.getElementById(tableID);
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
