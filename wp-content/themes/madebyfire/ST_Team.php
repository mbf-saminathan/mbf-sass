<?php
/***********************
Template Name: Team Template
************************/

get_header();
get_header('new');

$postArgs = array(
                'post_type' => 'team',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
                );
$teamLists  = get_posts($postArgs);


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
<div class="news-landing portfolio-head">
<div class="container">
<div class="row">
 <div class="col-xs-8">
      <h1><?php echo $post->post_title; ?></h1>
      <?php echo apply_filters('the_content', $post->post_content); ?>
 </div>
<?php echo get_sidebar('related_link'); ?>
</div>
            <div class="new-list-border " >

            </div>
            <?php
            if(count($teamLists)>0)
            {
            ?>
            <div class="news-wrap team-wrap">
               <div id="team-row" class="news-row clearfix">
                    <div class="grid-sizer"></div>
                    <?php

                    foreach($teamLists as $teamList)
                    {


                           $link = get_permalink($teamList->ID);
                           $designType = get_post_meta($teamList->ID, 'team_design_type', true);

                        if($teamList->post_excerpt!="")
                        {
                            $postExcerpt = '<p>'.$teamList->post_excerpt.'</p>';
                        }
                        $imgUrl = wp_get_attachment_url(get_post_thumbnail_id($teamList->ID));
                        $imgTeamsThumbid = get_post_thumbnail_id($teamList->ID);
                        $altImgTeam = get_post_meta($imgTeamsThumbid, '_wp_attachment_image_alt', true);
                        if($imgUrl!="")
                        {
                               $height="";
                              $width="";
                              if($designType == 'background_image')
                              {
                                  $height = "334";
                                  $width = "470";
                              }
                              else
                              {
                                  $height = "171";
                                  $width = "225";
                              }
                              $imgSrc = '<img src="'.$imgUrl.'" alt="'.$altImgTeam.'">';

                            //$imgSrc = '<img src="'.$imgUrl.'" alt="">';
                        }

                              switch ($designType) {
                            case 'background_image':
                                echo '
                                        <div data-id="'.$teamList->ID.'" class="image-blk grid  all">
                                            <h2>'.$teamList->post_title.'</h2>
                                                <div class="images-col grid-accord">
                                               '.$imgSrc.'

                                               <div class="image-desc ">
                                                    <h4>'.$teamList->post_title.'</h4>
                                                   '.$postExcerpt.'
                                               </div>

                                           </div>
                                        </div>';
                            break;
                            case 'background_color':
                                echo '<div data-id="'.$teamList->ID.'" class="grid all">
                                        <h2>'.$teamList->post_title.'</h2>
                                        <div class="red-card grid-accord">
                                             <div class="red-card-desc">

                                                   <h3>'.$teamList->post_title.'</h3>
                                                   '.$postExcerpt.'
                                               </div>
                                        </div>
                                   </div>';
                            break;

                            default:
                                echo '<div data-id="'.$teamList->ID.'" class="grid grid-col  all">
                                        <h2>'.$teamList->post_title.'</h2>
                                        <div class="grid-col-white grid-accord">

                                            '.$imgSrc.'
                                              <div class="grid-col-desc">

                                                 <h3>'.$teamList->post_title.'</h3>
                                                  '.$postExcerpt.'
                                              </div>
                                          </div>
                                       </div>';
                            break;
                        }

                        }
                    }
                    ?>
                </div>



            </div>



</div>


        </div>
<?php
//echo get_sidebar('related_link');
        ?>

    </div>
<?php get_footer(); ?>
