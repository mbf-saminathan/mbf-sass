<!-- footer section -->
<?php 
    $currentYear = date("Y");
    $designYear = 2018;
    $year = ($currentYear > $designYear) ? $designYear." - ".date("y") : $currentYear;
?>
<footer>
	<div class="container">
	        	<div class="row">
	        		<div class="col-2">
	        			<a href="#" class="footer-logo"><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" alt="pagelogo" /></a>
	        		</div>
	        		<div class="col-8">
	        			<ul class="footer-nav">
	        				<?php
	        					$footerargs = array('order' => 'ASC','menu_item_parent' => 0, 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
								$footerMenuItems = wp_get_nav_menu_items('footermenu', $footerargs);
								foreach ($footerMenuItems as $key => $footerMenuItem) {
	        				?>
							<li><a href="<?php echo $footerMenuItem->url; ?>" title="<?php echo $footerMenuItem->title; ?>"><?php echo $footerMenuItem->title; ?></a></li>
							<?php } ?>
						</ul>
	        		</div>
	        		<?php 
        				$instaUrl = get_option('instagram');
        				$fbUrl = get_option('facebook');
        				if($instaUrl!=''&& $fbUrl!=''){
	        			?>
	        		<div class="col-2 footer-social">
	        			<?php if($fbUrl!=''){ ?>
	        				<a target=blank href="<?php echo $fbUrl; ?>" class="footer-icons"><i class="fa fa-instagram" aria-hidden="true"></i></a>
	        			<?php } ?>
	        			<?php if($instaUrl!=''){ ?>
	        				<a target=blank href="<?php echo $instaUrl; ?>" class="footer-icons"><i class="fa fa-facebook" aria-hidden="true"></i></a>
	        			<?php } ?>
	        		</div>
	        		<?php
		        	}
		        	?>
	        	</div>
	        	<a href="#" class="footer-sublogo"><img src="img/logo.png" alt="pagesublogo" /></a>
	        	<div class="footer-divider">
	        		<hr/>
	        		<p>@<?php echo $year; ?> connie simmonds. All rights reserved.</p>
	        	</div>
       		 </div>
</footer>
<!-- end of footer section -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script type="text/javascript">
	//nprogress init
NProgress.configure({ showSpinner: false }).start();
</script>
<script src="<?php echo get_bloginfo('template_url'); ?>/js/wow.js"></script>
<script src="<?php echo get_bloginfo('template_url'); ?>/js/app.js"></script>
<script src="<?php echo get_bloginfo('template_url'); ?>/js/custom.js"></script>

	</body>
</html>

