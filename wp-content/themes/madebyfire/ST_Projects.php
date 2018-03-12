<?php 
/***********************
Template Name: Projects
************************/
get_header();
get_header('new');
$img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
?>

<?php
if (is_user_logged_in()) { /* User loged in start here*/
$user_id = get_current_user_id();
$user_details = get_userdata( $user_id );
$related_posts = "";
if(in_array('administrator',$user_details->roles))
{
    $postArgs = array(
                'post_type' => 'project',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
                );
    $related_posts = get_posts($postArgs);
}
else if(in_array('subscriber',$user_details->roles))
{
    $assigned_projects = get_user_meta($user_id, 'assigned_projects', true);
    if($assigned_projects!=""){
        $assigned_project_lists = explode(",", $assigned_projects); 
        $postArgs = array(
                    'post_type' => 'project',
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'post__in' => $assigned_project_lists,
                    'numberposts' => -1,
                    );
        $related_posts = get_posts($postArgs);
    }
}
if(count($related_posts)>0){
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
    <div class="portfolio-company text-center">
        <div class="container">
            <div class="portfolioItems demo-blk">
            <?php foreach ($related_posts as $related_post){
                    $get_project = get_post_meta($related_post->ID, 'setproject', true);
                    if($get_project!=''){
                    $external_url =  get_site_url().'/demo/'.$get_project;
                    $target_option = get_post_meta($related_post->ID, 'target_option', true);  
                    $target = ($target_option=="")? "_self": $target_option;
                    $imageUrl =  wp_get_attachment_url(get_post_thumbnail_id($related_post->ID));
                    if($imageUrl=="")
                    {
                        $imageUrl = get_bloginfo('template_url')."/images/default-img.png";
                    }
                ?>
                <div class="element-item <?php echo $termSlugs; ?> col-md-4 col-sm-6 col-xs-12">
                   <div class="pro-box">
                        <?php if($external_url!=""){ ?>
                        <a href="<?php echo $external_url; ?>" target="<?php echo $target; ?>"> 
                        <?php } ?>
                        <?php if($imageUrl!=""){ ?>
                        <img src="<?php echo $imageUrl; ?>" alt="">
                        <?php } ?>
                        <h5><?php echo $related_post->post_title; ?></h5>
                        <span class="read">View</span> 
                        <?php if($external_url!=""){ ?>                       
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } }  ?>
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
        <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $_REQUEST['redirect'] ?>">
        <input type="submit" class="btn btn-secondary btnmsg" value="Login">
    </div>
    </form>
</div>
<?php
/* User not loged in end here */
}
?>
<?php get_footer('projects'); ?>
