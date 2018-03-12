<?php 
/*news letter subscription through ajax starts here*/
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');
$arvalue = array();
$message = array('');
if(isset($_REQUEST['news_email']) !=""){
    $arvalue['news_email'] = $_REQUEST['news_email'];  
    $arvalue['posted_date'] = date("Y-m-d h:i:s");
    $tableName =$wpdb->prefix ."news_letter";
    $query = "SELECT `news_email` FROM `".$tableName."` WHERE `news_email` = '".$_REQUEST['news_email']."'";
    $results = $wpdb->get_results($query);
    //var_dump($results);
    //var_dump(count($results));
    if(count($results) >= 1){
         $message['error'] = "You have already subscribed to this newsletter";
    }elseif(count($results)==0){
        $inserted = $wpdb->insert($tableName, $arvalue); 
        if($inserted){
             $message['success'] = "success";
        }else{
             $message['error'] = "Something went wrong! Try Again!";
        }
    }
    echo json_encode($message);
    //mail
    /*$message = "Hi,<br/>
                <p>" . $_REQUEST['news_email'] . " has sent an News letter subscription from ". get_bloginfo('url'). " . Please find the details below,</p>
                <table border=\"0\">
                    <tr><td>Email Address          </td><td>: " . $_REQUEST['news_email'] . "</td></tr>
                 </table><br/> 
                 Regards,
                 <br/>
                 ". get_bloginfo('url');
    //$cc = get_option('contact_form_cc');
    $from = $username . " <no-reply@madebyfire.co.uk>";
    $subject = "Newsletter Subscription received from " . get_bloginfo('url');
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From: " . $from;
    //$headers = "From: ". $from . "\r\n" . "CC: ". $cc;
    $to = get_option('contact_form_to');
    //$email->Send();
    mail($to, $subject, $message, $headers);*/
}
/*news letter subscription through ajax endss here*/
?>
