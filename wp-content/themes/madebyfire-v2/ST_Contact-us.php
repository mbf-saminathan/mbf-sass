<?php 
/*
* Template Name: Contact us
*/
global $wpdb;


if ($_POST['contact_us_form'] != "" && $_POST['contactform'] == "") {
    $name = $_POST["cont_name"];
    $number = $_POST["cont_phone"];
    $comment = $_POST["cont_tellusyourstory"];
    $email = $_POST["cont_email"];
	$city = $_POST["cont_city"];
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
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Additional headers
            $headers .= 'From: '.$name.' <noreply@madebyfire.com> ' . "\r\n";
            $headers .= 'Reply-to: '.$name.' '.$email. "\r\n";
            $headers .= 'Cc: '. $cc . "\r\n";

if(wp_mail($to, $subject, $contmessage)) {
wp_redirect(get_site_url().'/thank-you'); 
}
else {
   // echo 'Not sent';
}
               
    }
}
}

get_header();
get_header('new');
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$alt_img = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
if ($img_url != ""):
    ?>            
    <img src="<?php echo $img_url; ?>" class="fullImg post_img" alt="<?php echo $alt_img; ?>">
<?php endif; ?> 
<section class="sub-introcontent">
    <div class="container">  
        <div class="row">
            <div class="col-xs-10">
                    <div class="maindiv">  
                        <div class="breadCrumb">
                            <ul>
                                <?php  
                                    if (function_exists('bcn_display')) {
                                        bcn_display();
                                    }
                                    ?>
                            </ul>
                            <h1><?php echo get_the_title(); ?></h1>
                        </div>     
                    </div>
                    <div class="introCaption">                      
                        <?php  echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                </div>
                <div class="col-xs-2 no-padding">
                    <div class="sticky">
                        <?php 
                        if($link_heading!=''){
                        ?>
                            <h5><?php echo $link_heading; ?></h5>
                        <?php } ?>
                        <ul>
                            <?php
                                foreach ($rn_link_text as $key => $rn_link_text) {
                                    if($rn_link_url[$key]!=''){
                            ?>
                            <li>
                                <a href="<?php echo $rn_link_url[$key]; ?>" target="<?php echo $rn_link_target[$key]; ?>">
                                    <?php echo $rn_link_text; ?>
                                </a>
                            </li>
                           <?php 
                                    }
                                }
                             ?>
                        </ul>
                    </div>
                </div>
        </div>  

    </div>
</section>
<section class="contactDetails">
<div class="container">
<div class="row">
    <div class="col-xs-8 contact-card">
        <form name="talktousName" id="talktous_frm" method="post" action="">
            <div class="row">
                <?php wp_nonce_field('conactus_nonce','contact_us_form'); ?>
                <div class="col-xs-6">
                    <div class="form-row">
                        <label class="floating-item" data-error="Please enter your name ">
                            <input type="text" name="cont_name" id="cont_name" onkeypress="return onlyAlphabets(event, this)" class="floating-item-input input-item"  maxlength="150"/>
                            <span class="floating-item-label">Name</span>
                        </label>
                         <div class="notvalid-error-message" id="err_name">Please enter your name</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-row align-left">
                        <label class="floating-item" data-error="Please enter your phone number">
                            <input type="text" name="cont_phone" id="cont_phone" onkeypress="return isNumber(event)" class="floating-item-input input-item validate-mobile"  maxlength="15"/>
                            <span class="floating-item-label">Phone</span>
                        </label>
                         <div class="notvalid-error-message" id="err_phone">Please enter your city</div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-row">
                        <label class="floating-item" data-error="Please enter your email address" data-error-valid="Please enter a valid email address">
                            <input type="text" name="cont_email" id="cont_email" class="floating-item-input input-item validate-email"  maxlength="150"/>
                            <span class="floating-item-label">Email</span>
                        </label>
                         <div class="notvalid-error-message" id="err_login_email">Please enter your city</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-row align-left">
                        <label class="floating-item" data-error="Please enter your city">
                          <input type="text" name="cont_city" id="cont_city" class="floating-item-input input-item"  maxlength="150"/>
                          <span class="floating-item-label">City</span>
                        </label>
                        <div class="notvalid-error-message" id="err_city">Please enter your city</div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-row message-row">
                        <label class="floating-item" data-error="Please enter your message">
                            <textarea class="floating-item-input input-item " name="cont_tellusyourstory" id="cont_tellusyourstory" rows="7"  maxlength="1500"></textarea>
                           <span class="floating-item-label">Message</span>
                            <div class="notvalid-error-message" id="err_message">Please enter a message</div>
                        </label>
                    </div>
                </div>  
                <div id ="dispnone" class="dispnone" style="display: none;">
                    <input type="text" name="contactform" id="contactform" value="">
                </div>
            </div>
            <button class="button button-contact " name="cont_submit" id="contact_submit">Send</button>
        </form> 
    </div>
</div> 
<?php //echo apply_filters('the_content', $post->post_excerpt); ?>
</div>
<?php
$subPageArgs = array( 
                'post_parent'  => $post->ID, /* for creating sub pages */
                'post_type'     => 'page', 
                'order'         => 'ASC', 
                'orderby'       => 'menu_order', /* we can use it date order also.. */
                'post_status'   => 'publish',   
        ); 
$subPages = get_posts($subPageArgs);
if (is_array($subPages) && count($subPages)>0) {
    foreach ($subPages as $subPage) {
        $postId = $subPage->ID;
        $pageTemplate = get_post_meta($postId, '_wp_page_template', true);
        include TEMPLATEPATH .'/'. $pageTemplate; /* showing the template subpages */
    }
}
?>
</section>
<?php get_footer('sub'); ?>

