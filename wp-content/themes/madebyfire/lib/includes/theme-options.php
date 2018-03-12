<?php

function theme_menu() {
    add_menu_page('Madebyfire Theme Options', 'Theme Options', 'administrator', 'options_page', 'theme_options_page');
}

add_action('admin_menu', 'theme_menu');

function theme_options_page() {
    if (isset($_REQUEST['submit'])) {
        update_option('footer_text', $_REQUEST['footer_text']);
        update_option('facebook', $_REQUEST['facebook']);
        update_option('twitter', $_REQUEST['twitter']);
        update_option('linkedin', $_REQUEST['linkedin']);
        update_option('youtube', $_REQUEST['youtube']);
        update_option('intagram', $_REQUEST['intagram']);       
        update_option('contact_form_to', $_REQUEST['contact_form_to']);
update_option('contact_form_cc', $_REQUEST['contact_form_cc']);
        
        
        $updated = 1;
    }
    ?>
    <?php if ($updated == 1) { ?>
        <div class="updated" style="margin-top: 10px;"><p>Details Updated Successfully</p></div>
    <?php } ?>
    <div id="usual2" class="usual"> 

        <form name="options" id="options" action="" method="post">
            <h1>Theme Options</h1>
            <ul> 
                <li><a href="#tabs1">Footer Settings</a></li> 
                <li><a href="#tabs2">Form Settings</a></li> 
            </ul> 
            <div id="tabs1" class="tab">
                
                 <div class="contaniner">
                    <div class="label">Footer text</div>
                    <div class="field"><input type="text" name="footer_text" id="footer_text" value="<?php echo get_option('footer_text'); ?>" /></div>
                </div>
                 <div class="contaniner">
                    <div class="label">Facebook</div>
                    <div class="field"><input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" /></div>
                </div>
                 <div class="contaniner">
                    <div class="label">Twitter</div>
                    <div class="field"><input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>" /></div>
                </div>
                 <div class="contaniner">
                    <div class="label">Linked In</div>
                    <div class="field"><input type="text" name="linkedin" id="linkedin" value="<?php echo get_option('linkedin'); ?>" /></div>
                </div>
                 <div class="contaniner">
                    <div class="label">Youtube</div>
                    <div class="field"><input type="text" name="youtube" id="youtube" value="<?php echo get_option('youtube'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Instagram</div>
                    <div class="field"><input type="text" name="intagram" id="intagram" value="<?php echo get_option('intagram'); ?>" /></div>
                </div>
            </div> 
            <div id="tabs2" class="tab">
                <div class="contaniner">
                    <div class="label">Contact form TO e-mail addresses</div>
                    <div class="field"><input type="text" name="contact_form_to" id="contact_form_to" value="<?php echo get_option('contact_form_to'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Contact form CC e-mail addresses</div>
                    <div class="field"><input type="text" name="contact_form_cc" id="contact_form_cc" value="<?php echo get_option('contact_form_cc'); ?>" /></div>
                </div>
            </div> 
            
            <br style="clear:both;" />
            <input type="submit" class="btn" name="submit" value="Save Options" style="margin-top:20px;" />
        </form>
    </div> 

    <script type="text/javascript"> 
        jQuery("#usual2 ul").idTabs(); 
    </script>

<?php }
?>
