<?php
/***********************
Template Name: Join Us new Template
************************/

get_header();
get_header('new');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$taxonomy = "blog_cat";
$termArgs = array(
    'orderby'           => 'name',
    'order'             => 'ASC',
    'hide_empty'        => false,
    'exclude'           => array(),
    'exclude_tree'      => array(),
    'include'           => array(),
    'number'            => '',
    'fields'            => 'all',
    'slug'              => '',
    'parent'            => '',
    'hierarchical'      => true,
    'child_of'          => 0,
    'childless'         => true,
    'get'               => '',
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false,
    'offset'            => '',
    'search'            => '',
    'cache_domain'      => 'core'
);
$blog_terms = get_terms($taxonomy, $termArgs);

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
<div class="news-landing">
<div class="container">

            <div class="title-row portfolio-head">
                         <h1><?php echo strtoupper($post->post_title); ?></h1>
                         <?php echo apply_filters('the_content', $post->post_content); ?>
            </div>


            <?php
            if(count($blog_terms)>0)
            {
            ?>
            <div class="news-wrap">
               <div id="news-row" class="news-row clearfix">
                    <div class="grid-sizer"></div>
                    <?php
                    $news_count == 0;
                    $termList = '';
                    $blogPostExcerpt = '';
                    foreach($blog_terms as $blog_term)
                    {
                        $imgUrl = "";


                        $category_option_name = 'blog_cat_design_type_' . $blog_term->term_id;
                        $category_design_type = get_option( $category_option_name );
                        $link = get_term_link($blog_term);
                        $termList ="";
                        $option_short_desc = 'blog_cat_short_desc_' . $blog_term->term_id;
                        $short_desc = get_option($option_short_desc);
                       if($short_desc!=''){
                           $blogPostExcerpt = '<p>'.stripslashes($short_desc).'</p>';
                        }elseif($blog_term->description!="")
                        {
                            $blogPostExcerpt = '<p>'.stripslashes($blog_term->description).'</p>';
                        }
                        $imgUrl =  z_taxonomy_image_url($blog_term->term_id,NULL, TRUE);
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
                              $imgSrc = '<img src="'.get_bloginfo('template_url') . '/thumb.php?h='.$height.'&w='.$width.'&src='.$imgUrl.'" alt="">';

                            //$imgSrc = '<img src="'.$imgUrl.'" alt="">';
                        }
                        if($termName!="")
                        {
                            $termList = '<h6>'.$termName.'</h6>';
                        }

                        $termList ="";
                        switch ($category_design_type) {
                            case 'background_image':
                                echo '
                                        <div data-id="'.$blog_term->term_id.'" class="image-blk grid '. $termSlugs .' all">
                                           <a href="'. $link .'"><div class="images-col">
                                               '.$imgSrc.'

                                               <div class="image-desc">
                                                    <h4>'.$blogList->name.'</h4>
                                                   '.$blogPostExcerpt.'
                                               </div>

                                           </div></a>
                                        </div>';
                            break;
                            case 'background_color':
                                echo '<a href="'. $link .'" ><div data-id="'.$blog_term->term_id.'" class="grid '. $termSlugs .' all">
                                        <div class="red-card">
                                             <div class="red-card-desc">

                                                   <h3>'.$blog_term->name.'</h3>
                                                   '.$blogPostExcerpt.'
                                               </div>
                                        </div>
                                   </div></a>';
                            break;

                            default:
                                echo '<div data-id="'.$blog_term->term_id.'" class="grid grid-col '. $termSlugs .' all">
                                    <a href="'. $link .'" '.$target.'>
                                          '.$imgSrc.'
                                           <div class="grid-col-desc">
                                               '.$termList.'
                                               <h3>'.$blog_term->name.'</h3>
                                               '.$blogPostExcerpt.'
                                           </div>
                                      </a>
                                    </div>';
                            break;
                        }

                        $news_count++;
                    }
                    ?>
                </div>

                <input type="hidden" class='total-count' value="<?php echo count($newsLists); ?>" />


            </div>
          </div>
            <?php } ?>

    </div>
<?php get_footer(); ?>
