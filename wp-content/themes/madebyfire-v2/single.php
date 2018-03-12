<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Madebyfire
 * @since Madebyfire 1.0
 */ 
get_header();
$rn_link_text = get_post_meta($post->ID, 'rn_link_text', true);   
$rn_link_url = get_post_meta($post->ID, 'rn_link_url', true);
$rn_link_target = get_post_meta($post->ID, 'rn_link_target', true);
$link_heading = get_post_meta($post->ID, 'link_heading', true);
?>
<div id="subPage">
<!--#include file="subheader.shtml"-->
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
                    </div>
                    </div>
                     <h1><?php echo $post->post_title; ?></h1>
                    <?php echo apply_filters('the_content',$post->post_content); ?>
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
<!--#include file="subfooter.shtml" -->
</div>
<?php get_footer(); ?>