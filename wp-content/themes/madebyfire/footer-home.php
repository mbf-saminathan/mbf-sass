<footer>
	<div class="container">
		<div class="clearfix">
			<div class="fR social">
				<ul class="clearfix">
					<?php
					$facebook = get_option('facebook');
					$twitter = get_option('twitter');
					$linkedin = get_option('linkedin');
					$youtube = get_option('youtube');
					$intagram = get_option('intagram');
					?>
					<?php
					if($facebook!=""){
						?>
						<li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php
					}
					if($twitter!=""){
					?>
						<li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<?php
					}
					if($linkedin!=""){
					?>
						<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<?php
					}
					if($youtube!=""){
					?>
						<li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
					<?php
					}
					if($intagram!=""){
					?>
						<li><a href="<?php echo $intagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
					<?php
					}					
					?></ul>
			</div>
			<div class="fL">
				<?php  
			$currentYear = date("Y");
			$designYear = 2017;
			$year = ($currentYear > $designYear) ? $designYear." - ".date("y") : $currentYear;
			?>
				&copy; <?php echo $year; ?> made by fire ltd. <span class="mobRight">All rights reserved | LONDON | EDINBURGH | CHENNAI | BENGALURU | MUMBAI</span>
			</div>
		</div>
	</div>
</footer>
</div>
</div>
<?php /* <script data-main="<?php echo get_bloginfo('template_url'); ?>/js/app" src="<?php echo get_bloginfo('template_url'); ?>/js/lib/require.js"></script> */ ?>
<script src="<?php echo get_bloginfo('template_url'); ?>/js/global.min.js"></script>

</body>
</html>
