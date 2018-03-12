<?php 
/***********************
Template Name: Blogs
************************/
get_header();
get_header('new');
$pages = get_posts(array('post_type' => 'blog', 'order' => 'ASC', 'orderby' => 'menu_order', 'numberposts' => -1));
$no_post = 10;
$pagination = new pagination;
$paged_media = $pagination->generate($pages, $no_post);
?>

<?php
if (is_user_logged_in()) { /* User loged in start here*/
$user_id = get_current_user_id();
$user_details = get_userdata( $user_id );

if(count($pages)>0){
    ?>
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
    <div class="mainLanding portfolio-head " >
            <div class="container">
                <div class="row border-line">
                  <div class="col-xs-8">
                    <h1><?php echo strtoupper($post->post_title); ?></h1>
                   <?php /* <p><?php echo $post->post_content; ?></p> */ ?>
                    <div><?php echo apply_filters('the_content', $post->post_content); ?></div>
                    <div class="what-we-do">
                        <ul>
                            <?php foreach($paged_media as $sub_page) { ?>
                            <li><a href="<?php echo get_permalink($sub_page->ID); ?>"><?php echo $sub_page->post_title; ?></a></li>
                            <?php } ?>
                        </ul>

                    </div>
                    <?php if (count($pages) > $no_post) { ?>
                    <ul class="clearfix" id="pagination">
                        <?php
                            echo $pagination->links('num');                                
                        ?>  
                    </ul>
                    <?php } ?>
                </div>
              </div>
            </div>
        </div>
    <?php } 
} /* User loged in end here */
else { /* User not loged in start here */
?>
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
<div class="container loginPage">
    
    <form method="post" id="loginForm" name="loginForm" onsubmit="return siginvalidation();">
    <div class="loginForm portfolio-head">
    <?php
        if(isset($login_error) && $login_error!=''){
            echo '<h2 class="loginerror">'.$login_error.'</h2>';
        }
    ?>
            <h1>Login</h1>
        <div class="formField">
            <div class="formBlk">
                <label><span>Username</span></label>
                <input type="text" class="textBox" name="loginname" id="loginname" value="" autocomplete="off">
            </div>
        </div>
        <div class="formField">
            <div class="formBlk">
                <label><span>Password</span></label>
                <input type="password" class="textBox" name="userpassword" id="userpassword" value="" autocomplete="off">
            </div>
        </div>
       
        <input type="submit" class="btn btn-secondary btnmsg" value="Login"> 
    </div>
    </form>
</div>
<?php
/* User not loged in end here */
}
?>
<?php get_footer(); ?>
