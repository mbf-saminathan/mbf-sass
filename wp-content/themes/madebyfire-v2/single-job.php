<?php 
get_header();
get_header('new');
$locTerm = $_GET['loc_id'];
$locName = get_term_by( "id", $locTerm, "job_categories");
$loc = $locName->name;
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
?>

    <section class="sub-introcontent">
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
                     <h1><?php echo $post->post_title; ?></h1>
                    </div>
                    <?php echo apply_filters('the_content',$post->post_content); ?>
                    <div class="dynamic-button dynamic-button-primary"><a href="<?php echo get_bloginfo('url')."/apply-now/"."?locat=".$locTerm.'&jobid='.$post->ID; ?>" class="button button-primary">Apply now</a></div>             
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
                        ?>
                        <li>
                            <a href="<?php echo $rn_link_url[$key]; ?>" target="<?php echo $rn_link_target[$key]; ?>">
                                <?php echo $rn_link_text; ?>
                            </a>
                        </li>
                       <?php 
                            }
                         ?> 
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </section>
`
<?php get_footer('sub'); ?>