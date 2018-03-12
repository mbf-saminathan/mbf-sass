 <?php
/*
* Template Name: Home(Instagram feeds)
*/
 ?>
 <!-- Instagram section-->
<section>
	<div class="container">
			<div class="insta-topContent border-row">
				<div class="row">
   				<div class="col-10 center-block content-center">
	       			<h1>Instagram</h1>
					<p> </p>
					<a href="<?php echo $instaUrl; ?>" class="button button-more">view profile</a>
		 		</div>
		 	</div>
		 	<div class="insta-slider">
			 	<div class="insta-gallery">
		 			<?php
		 			$instatoken = get_option('instatoken');
		 			$instausrid = get_option('instausrid');
					$instaCurl = "https://api.instagram.com/v1/users/".$instausrid."/media/recent/?access_token=".$instatoken;
					$returnInsta = connie_instagram_api_curl_connect($instaCurl);
		 			$i = 1;
					foreach ($returnInsta->data as $instaPost) {
		 				
		 				echo '<a href="'.$instaPost->link.'"><img class="insta-image" src="'.$instaPost->images->standard_resolution->url.'"alt="picture1"></a>';
		 				
		 			?>
		 			<?php 
		 			if($i == 8){
		 				echo '</div><div class="insta-gallery">';
		 					$i = 1;
		 			}else{
		 			$i++;
		 				
		 				}
		 			}
		 			 ?>
			    </div>
			 	
			</div>
			<div class="insta-arrow">
				<span class="prev"><i class='fa fa-arrow-left' aria-hidden='true'></i></span>
				<span class="next"><i class='fa fa-arrow-right' aria-hidden='true'></i></span>
			</div>
			</div>
		</div>
</section>
        <!-- end of Instagram section -->