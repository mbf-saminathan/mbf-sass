<?php
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0].'wp-load.php'; 
$taxonomy = "news_categories";
$noOfPost = 10;
if(isset($_POST) && $_POST['categoryId']!="")
{
	$categoryId = $_POST['categoryId'];
	$excludePostArray = $_POST['postIdArray'];
	if($categoryId=="all")
	{
		$postArgs = array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'exclude' => $excludePostArray,
                'numberposts' => $noOfPost,
                );

	}
	else
	{
		$postArgs = array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'exclude' => $excludePostArray,
                'numberposts' => $noOfPost,
                'tax_query'=>array(array('taxonomy'=>'news_categories',
					'field'=>'term_id',
					'terms'=>$categoryId
					))
                );

	}
	
	$newsLists  = get_posts($postArgs);
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
        if($newsList->post_excerpt!="")
        {
            $postExcerpt = '<p>'.$newsList->post_excerpt.'</p>';
        } 
        $imgUrl = wp_get_attachment_url(get_post_thumbnail_id($newsList->ID));
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
        }
        if($termName!="")
        {
            $termList = '<h6>'.$termName.'</h6>';
        }
        $termList ="";
        switch ($designType) {
            case 'background_image':
                echo '
                        <div data-id="'.$newsList->ID.'" class="image-blk grid '. $termSlugs .' all">
                           <div class="images-col">
                               '.$imgSrc.'
                               
                               <div class="image-desc">
                                   '.$termList.'
                                   <h4><a href="'. get_permalink($newsList->ID) .'">'.$newsList->post_title.'</a></h4>
                                   '.$postExcerpt.'
                               </div>
                               
                           </div>
                        </div>';
            break;
            case 'background_color':
                echo '<div data-id="'.$newsList->ID.'" class="grid '. $termSlugs .' all">
                        <div class="red-card">
                            
                               <div class="red-card-desc">
                                   '.$termList.'
                                  <a href="'. get_permalink($newsList->ID) .'"> <h3>'.$newsList->post_title.'</h3></a>
                                   '.$postExcerpt.'
                               </div>
                            
                        </div>
                   </div>';                                   
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
                    <a href="'. get_permalink($newsList->ID) .'">
                          '.$imgSrc.'</a>
                           <div class="grid-col-desc">
                               '.$termList.'
                              <a href="'. get_permalink($newsList->ID) .'"> <h3>'.$newsList->post_title.'</h3></a>
                               '.$postExcerpt.'
                           </div>                       
                    </div>';
            break;
        }
    }
}
?>