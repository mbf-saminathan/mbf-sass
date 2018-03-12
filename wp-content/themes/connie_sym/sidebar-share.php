<?php 
$postpermalink = urlencode( get_permalink($post->ID) );
$shrImgUrl = urlencode( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) );
$defImg = get_option('defBanImg');
$shrImgUrl = $imageurl == ''?$defImg:$shrImgUrl;
$currLnk = get_permalink($post->ID);
?>
<div class="col-3 share">
	<h6>Share This</h6>
	<ul class="share-icons">
		<li>
			<a target="blank" href="http://www.facebook.com/sharer.php?u=<?php echo $currLnk; ?>&t=<?php echo $post->post_title; ?>" title="facebook">
				<i class="fa fa-facebook" aria-hidden="true"></i>
			</a>
		</li>
		<li>
			<a target="blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $currLnk; ?>&media=<?php echo $shrImgUrl; ?>&description=<?php $post->post_title; ?>" title="Pinterest">
				<i class="fa fa-pinterest-p" aria-hidden="true"></i>
			</a>
		</li>
		<li>
			<a target="blank" href="http://twitter.com/home?status=<?php echo $currLnk; ?>" title="Twitter">
				<i class="fa fa-twitter" aria-hidden="true"></i>
			</a>
		</li>
		<li>
			<a target="blank" href="https://plus.google.com/share?url=<?php echo $currLnk; ?>" title="Google Plus">
				<i class="fa fa-google-plus" aria-hidden="true"></i>
			</a>
		</li>
	</ul>
</div>
