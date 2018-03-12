<?php
/***********************
Template Name: News Template
************************/

get_header();
get_header('new');
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
require_once('TwitterAPIExchange.php');
require_once('TwitterTextFormatter.php');
use Netgloo\TwitterTextFormatter;
/** Set access tokens here - see: https://dev.twitter.com/apps/ * */
$settings = array(
    'oauth_access_token' => "762607039143153664-bIpZ40LjfBpscNobIbqOUn7RaXvhXaP",
    'oauth_access_token_secret' => "eQEW5HKWvzJWgvX2ncBce3TWbHZO1w8j5pghnz2lLEnT9",
    'consumer_key' => "RE5C9m3m4GU0ffogIolTGKWsE",
    'consumer_secret' => "7YlwouqUwEreNbr9j9UrX0NfLKdAHGc9V0g88ZAupaoLA3anI4"
);

// We are using GET Method to Fetch the latest tweets.
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

// Set your screen_name to your twitter screen name. Also set the count to the number of tweets you want to be fetched. Here we are fetching 5 latest tweets.
$getfield = '?screen_name=MbFDesigns&include_rts=false&count=1';
$requestMethod = 'GET';

// Making an object to access our library class
$twitter = new TwitterAPIExchange($settings);
$store = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();
// Since the returned result is in json format, we need to decode it
$result = json_decode($store);
$taxonomy = "news_categories";
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
$terms = get_terms($taxonomy, $termArgs);
$noOfPost = 25;
$postArgs = array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => $noOfPost,
                );
$newsLists  = get_posts($postArgs);

$postArgsCount = array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
                );
$newsListsCount  = get_posts($postArgsCount);
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
            if(count($terms)>0)
                    { ?>
            <div class="new-list-border" >
                <ul class="new-list clearfix" style="display:none;">
                    <li data-filter=".all" data-count="<?php echo count($newsListsCount); ?>" class="active" data-id='all'><a href="javascript:void(0);">All</a></li>
                    <?php
                        foreach($terms as $termItem)
                        {
                            $termNewsLists = "";
                            $termPostArgs = array(
                                'post_type' => 'news',
                                'post_status' => 'publish',
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'numberposts' => -1,
                                'tax_query'=>array(array('taxonomy'=>'news_categories',
                                    'field'=>'term_id',
                                    'terms'=>$termItem->term_id
                                    ))
                                );
                            $termNewsLists  = get_posts($termPostArgs);
                            echo '<li data-count="'. count($termNewsLists).'" data-filter=".'.$termItem->slug.'" data-id="'.$termItem->term_id.'"><a href="javascript:void(0);">'.$termItem->name.'</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <?php } ?>
            <?php
            if(count($newsLists)>0)
            {
            ?>
            <div class="news-wrap">
               <div id="news-row" class="news-row clearfix">
                    <div class="grid-sizer"></div>
                    <?php
                    $news_count == 0;
                    foreach($newsLists as $newsList)
                    {
                        $imgUrl = "";
                        $imgSrc = "";
                        $postExcerpt = "";
                        $termName = "";
                        $termSlugs = "";
                        $curTermName = "";
                        $curTermSlugs = "";
                        $designType = "";
                        $termList = "";
                        $curTermSlugs = wp_get_post_terms($newsList->ID, $taxonomy, array("fields" => "slugs"));
                        $termSlugs = implode(" ",$curTermSlugs);
                        $curTermName = wp_get_post_terms($newsList->ID, $taxonomy, array("fields" => "names"));
                        $termName = implode(", ",$curTermName);
                        $designType = get_post_meta($newsList->ID, 'design_type', true);
                        $external_link = get_post_meta($newsList->ID, 'external_link', true);
                        $new_window = get_post_meta($newsList->ID, 'new_window', true);
                        if($external_link !=''  && $new_window == 'new_window') {
                           $link = $external_link;
                           $target = 'target="_blank"';
                        }  else if($external_link !='' && $new_window == 'same_window') {
                           $link = $external_link;
                          // $target = 'target="_blank"';
                        } else {
                           $link = get_permalink($newsList->ID);
                           $target = '';
                        }
                        if($newsList->post_excerpt!="")
                        {
                            $postExcerpt = '<p>'.$newsList->post_excerpt.'</p>';
                        }
                        $imgUrl = wp_get_attachment_url(get_post_thumbnail_id($newsList->ID));
                        $imgNewThumbid = get_post_thumbnail_id($newsList->ID);
                        $altImgNews = get_post_meta($imgNewThumbid, '_wp_attachment_image_alt', true);
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
                              $imgSrc = '<img src="'.get_bloginfo('template_url') . '/thumb.php?h='.$height.'&w='.$width.'&src='.$imgUrl.'" alt="'.$altImgNews.'">';

                            //$imgSrc = '<img src="'.$imgUrl.'" alt="">';
                        }
                        if($termName!="")
                        {
                            $termList = '<h6>'.$termName.'</h6>';
                        }

                        if($news_count == '3'){

                            echo'<div class="grid mobile-app all"><div class="red-card-slider"><div class="slideImgtwit">';
                                foreach($result as $singTweet){
                            echo '<div>
                                    <div class="red-card-desc">
                                        <h3><a href="https://twitter.com/MbFDesigns" target="_blank">MbF@Twitter</a></h3>
                                             <p> '. TwitterTextFormatter::format_text($singTweet).'</p>
                                    </div>
                                  </div>';
                            }
                            echo '</div><a href="https://twitter.com/MbFDesigns" class="btn btn-primary btnSubmit button-submit" target="_blank">Follow Us</a></div></div>';
                        }
                        $termList ="";
                        switch ($designType) {
                            case 'background_image':
                                echo '
                                        <div data-id="'.$newsList->ID.'" class="image-blk grid '. $termSlugs .' all">
                                           <a href="'. $link .'" '.$target.'><div class="images-col">
                                               '.$imgSrc.'

                                               <div class="image-desc">
                                                   '.$termList.'
                                                    <h4>'.$newsList->post_title.'</h4>
                                                   '.$postExcerpt.'
                                               </div>

                                           </div></a>
                                        </div>';
                            break;
                            case 'background_color':
                                echo '<a href="'. $link .'" '.$target.'><div data-id="'.$newsList->ID.'" class="grid '. $termSlugs .' all">
                                        <div class="red-card">
                                             <div class="red-card-desc">
                                                    '.$termList.'
                                                   <h3>'.$newsList->post_title.'</h3>
                                                   '.$postExcerpt.'
                                               </div>
                                        </div>
                                   </div></a>';
                            break;
                            case 'newsletter':
                                echo '<div data-id="'.$newsList->ID.'" class="grid all">
                                        <div class="red-card">
                                            <div class="red-card-news">
                                                <div class="email-blk">
                                                    <img src="'.get_bloginfo('template_url').'/images/news-logo.png" alt="">
                                                    <h4>Subscribe to <br />our newsletter</h4>
                                                    <input type="text" class="text-box newsletter_email">
                                                    <input type="submit" class="btn email-btn newsletter_submit">
                                                    <div class="spinner" style="display:none;">
                                                      <div class="double-bounce1"></div>
                                                      <div class="double-bounce2"></div>
                                                    </div>
                                                </div>
                                                <div class="thank-u">
                                                    <img src="'.get_bloginfo('template_url').'/images/news-logo.png" alt="">
                                                    <h4>Success!</h4>
                                                    <p>You’ve subscribed to our newsletter.</p>
                                                    <span class="done-btn">Done</span>
                                                </div>
                                                <img id="loading-image" src="'.get_bloginfo('template_url').'/images/fancybox_loading.gif" style="display:none;"/>
                                            </div>
                                        </div>
                                   </div>';
                            break;
                            default:
                                echo '<div data-id="'.$newsList->ID.'" class="grid grid-col '. $termSlugs .' all">
                                    <a href="'. $link .'" '.$target.'>
                                          '.$imgSrc.'
                                           <div class="grid-col-desc">
                                               '.$termList.'
                                               <h3>'.$newsList->post_title.'</h3>
                                               '.$postExcerpt.'
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
                <div class="load-more" <?php if(count($newsListsCount)<$noOfPost){ echo "style='display:none;'"; } ?>>
                    <div class="whitelinebtn">
           <a href="javascript:void(0);" class="load-more-news btn button-primary">LOAD MORE NEWS</a>
        </div>
                </div>

            </div>

            <?php } ?>
        </div>
    </div>
<?php get_footer(); ?>
