<?php 
/***********************
Template Name: About New
************************/

get_header();
get_header('new');
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
?>
<section class="wrapperBg">
	<div class="container">  
		<div class="row equaldiv">
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
                        
                    </div>     
                    <h1><?php echo get_the_title(); ?></h1>
                </div>
                <div class="introCaption">                      
                    <?php echo apply_filters('the_content', $post->post_content); ?>
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
<?php
	// echo wpautop(apply_filters('the_content', $post->post_content)); 
 ?>

<?php
	get_footer('sub'); 
?>