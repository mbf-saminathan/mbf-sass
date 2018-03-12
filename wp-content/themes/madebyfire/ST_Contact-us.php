<?php 
/*
* Template Name: Contact us
*/
global $wpdb;
    
if (isset($_POST['user_data'])  && $_POST['user_data'] == '' && isset($_POST[date('ymmddY')]) ){
    $name = $_POST["username"];
    $number = $_POST["phone"];
    $comment = $_POST["tellusyourstory"];
    $email = $_POST["email"];
	$city = $_POST["city"];
    $type = $_POST["selected_category"];

    /*
     * ** VALIDATION
     */
    $err = 0;
    if ($name == "") {
        $error['username'] = "Please enter your name";
        $err++;
    }
    if (is_numeric($number) == "") {
        $error['phone'] = "Please enter your mobile number";
        $err++;
    }
    if ($comment == "") {
        $error['tellusyourstory'] = "Please enter your Comments";
        $err++;
    }
    if ($email == "") {
        $error['email'] = "Please enter your Email";
        $err++;
    }
	if ($city == "") {
        $error['city'] = "Please enter your city";
        $err++;
    }
    /*
     * ** STORE THE VALUES
     */
    //$comment = str_replace ("'","\'",$comment);

    if ($err == 0) {
        $table_name = $wpdb->prefix."talktous";
        
        $form_data = array(
            'name' => $name,
            'phone' => $number,
            'email' => $email,
			 'city' => $city,
            'tellusyourstory' => $comment,
            'posted_date' => date('Y-m-d H:i:s')
        );
        $wpdb->insert($table_name, $form_data);     
        if($wpdb->insert_id) {
            $to  = get_option('contact_form_to');
            $cc  = get_option('contact_form_cc');
            //$to  = 'sathis@raisingibrows.com';
            //$to  = 'thennarasu@raisingibrows.com';
            $subject = 'Enquiry from madebyfire.com';
            
            $contmessage = $name .'<br />'. $email .'<br />'. $number .'<br />'. $city .'<br /><br />'. htmlspecialchars($comment);
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: '.$name.' <noreply@madebyfire.com> ' . "\r\n";
$headers .= 'Reply-to: '.$name.' '.$email. "\r\n";
$headers .= 'Cc: '. $cc . "\r\n";

// Mail it

if(wp_mail($to, $subject, $contmessage)) {

//echo $message;
//echo 'success';
wp_redirect(get_site_url().'/thank-you'); 
//exit;
//die;
}
else {
   // echo 'Not sent';
}
               
            //header('Location: thankyou.php');
        }
    }
}

get_header();
get_header('new');
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
if ($img_url != ""):
    ?>            
    <img src="<?php echo $img_url; ?>" class="fullImg post_img" alt="">
<?php endif; ?>
    <div class="breadCrumb">
        <div class="container">
            <ul>
                <?php  
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </ul>
        </div>
    </div>
<div class="portfolio-head">
<div class="container">
    <div class="row">
    <div class="col-xs-8   contact-cuctom">
        <?php
        $post_author = get_userdata($post->post_author);
        //var_dump($post_author);
        ?> 
        <h1><?php echo get_the_title(); ?></h1>

        <?php echo apply_filters('the_content', $post->post_content); ?>
        
        <?php /*<div class="talkToUs sectionBlk">
            <form name="talktousName" id="talktous_frm" method="post" action="">
                <div class="globalError">Oops! There seem to be some mistakes in your submission. Please see below.</div>
                            <h1>Message </h1>
                            <div class="formWrap">
                                <?php if (!empty($error['tellusyourstory'])) { ?>
                                    <div class="error-message"><?php echo $error['tellusyourstory']; ?></div>
                                <?php } ?> 
                                <div class="formField">
                                    <textarea class="textarea" name="tellusyourstory" id="tellusyourstory" value="<?php echo (isset($_POST['tellusyourstory'])) ? $_POST['tellusyourstory'] : ''; ?>" autofocus></textarea>
                                </div>
                                <div class="formField">
                                    <div class="formField">
                                        <?php if (!empty($error['username'])) { ?>
                                            <div class="error-message"><?php echo $error['username']; ?></div>
                                        <?php } ?>   
                                        <div class="formBlk">
                                            <label><span>Your Name</span></label>
                                            <input type="text" class="textBox" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : ''; ?>" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="formField">
                                        <?php if (!empty($error['phone'])) { ?>
                                            <div class="error-message"><?php echo $error['phone']; ?></div>
                                        <?php } ?>
                                        <div class="formBlk">
                                            <label><span>Phone</span></label>
                                            <input type="text" class="textBox" name="phone" id="phone" maxlength="15" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : ''; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="formField">
                                        <?php if (!empty($error['email'])) { ?>
                                            <div class="error-message"><?php echo $error['email']; ?></div>
                                        <?php } ?>
                                        <div class="formBlk">
                                            <label><span>Email</span></label>
                                            <input type="text" class="textBox" name="email" id="email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="selected_category" name="selected_category" value="">
                                <input type="text" id="user_data" name="user_data" value="">
                                <input type="text" id="madebyfire_data" name="<?php echo date('ymmddY'); ?>" value="<?php echo date('Yddmmy'); ?>">
                                <input type="submit" name="talktous_submit" id="talktous_submit" class="btn btn-secondary btnmsg" value="Send my enquiry">
                            </div>
            </form>
        </div> */ ?>
    </div>    
    </div>
</div>
</div>
<?php get_footer(); ?>
<script>
/*function onformSubmit() {
    var $errorDiv = $('.mbf-theme-globalerror'),
        valid = true;
    var a = document.forms["talktousName"]["tellusyourstory"].value;
    var b = document.forms["talktousName"]["username"].value;
    var c = document.forms["talktousName"]["phone"].value;
    var f = document.forms["talktousName"]["email"].value;

    if (a == "" || b == "" || c == "" || f == "") {
        valid = false;
    }
    if (valid) {
        $errorDiv.slideUp();
    } else {
        $errorDiv.slideDown(500, function() {
            $('html, body').animate({
                scrollTop: $('.mbf-theme-globalerror').offset().top
            }, 800);
        });
    }
}
function textareaRequired(){
	if(event.keyCode == 13){
		$(".btnSubmit").trigger("click");
		return false;
	}
}*/
</script>
