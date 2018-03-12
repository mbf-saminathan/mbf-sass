<?php
ob_start();
global $wpdb;

if(isset($_REQUEST['export']) && $_REQUEST['export'] == 'contactlist'):
    
    /*
     * #Export (Currency Orders)
     */
    $file_name = 'contactlist_'.date("M_d_Y_H_i").'.csv';
    $field_args = array(
        'name'         => 'Name',
        'email'        => 'Email',
        'phone'        => 'Phone',
		'city'        => 'City',
        'tellusyourstory'        => 'Queries',
        'posted_date'       => 'Posted date'
    );

    
    // Send Header info.
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename='".$file_name."'");
    
    $fh = fopen('php://output', 'w');
    
    // Send Export file columns.
    fputcsv($fh, $field_args);
    
    // Write Currency Columns.
    
    // Read from Database.
    $query = "SELECT * FROM ".$wpdb->prefix."talktous ORDER BY `posted_date` desc";
    $sql = $wpdb->get_results($query);
    $sql_count = count($sql);
	
    if($sql_count > 0):
			// Write to export file.
			foreach($sql as $x=>$row):
				$line = array();
				foreach($field_args as $column_name=>$field):
					$line[]	= $row->$column_name;
				endforeach;
				fputcsv($fh, $line);
			endforeach;
    else:
        fputcsv($fh, array('No results found!.'));
    endif;
    exit;
endif; /** Export - End **/

add_action('admin_menu', 'contact_list');

function contact_list() {
    add_menu_page('Contact List', 'Contact List', 'add_users', 'contactlist.php', 'contactlist');
}

function contactlist() {
    global $wpdb;
    $sql = "SELECT * FROM ". $wpdb->prefix ."talktous order by posted_date desc";
    ?>
<style type="text/css">
        table
        {
            border-collapse:collapse;
            text-align: left;
        }
        table,th, td
        {
            border: 1px solid black !important;
        }
        td
        {
            border-left:  1px solid black !important;
        }
        th{
            text-align: right;
        }
    </style>
	
	
<div class="wrap">
    <h2 style="float:left; clear: both;">Contact List</h2>
		<span style="float:right; margin-bottom: 29px; margin-top: 9px;"><a href="?page=<?php echo $_REQUEST['page']?>&export=contactlist" id="export-contactlist" class="button" >Export</a></span>
   <table class="wp-list-table widefat fixed posts">
	  <thead>
			<tr>
                <th>Name</th>
				<th>Email</th>
                <th>Phone</th>
				<th>City</th>
				<th>Queries</th>
                <th>Posted Date</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php
            $rows = $wpdb->get_results($sql);

            if ($_REQUEST['num'] > 1) {
                $i = 1 + (($_REQUEST['num'] - 1) * 30);
            } else {
                $i = 1;
            }
            $pagination = new pagination();
            $paged_rows = $pagination->generate($rows, 30);
            foreach ($paged_rows as $row) {
				if($i % 2 == 0) $class = ' alternate ';
				else $class =  '';
			?> 	           
                <tr valign="top" class="<?php echo $class; ?>">            
                    <td><?php echo $row->name; ?></td>
					<td><?php echo $row->email; ?></td>
                    <td><?php echo $row->phone; ?></td>
					<td><?php echo $row->city; ?></td>
					<td><?php $comment = str_replace ("\'","'",$row->tellusyourstory);
                    echo $comment; ?>
                    </td>
                    <td><?php if($row->posted_date!="0000-00-00 00:00:00") { echo date("d M Y", strtotime($row->posted_date)); } else { echo "-"; } ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php
    echo '<ul class="pagination">';
    echo $pagination->links();
    echo '</ul>';?>
</div>

<?php	}
?>
