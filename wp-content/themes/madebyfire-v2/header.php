<!DOCTYPE html>
<html <?php echo $class = is_home()?'class = "homebg"':''; ?>>
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="google-site-verification" content="RwpAc7jlgdObzMBeMK5SXxm7nvXqCHedpaQkz80yhGk" />
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php $title = is_front_page() ? get_bloginfo('name') : $post->post_title." | ".get_bloginfo('name'); ?>
    <title><?php echo $title; ?></title>
    <!-- Font init -->
     <script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 'Montserrat:400,700', 'Open+Sans:400,700', 'Lekton:400,400italic,700'] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('head')[0];
        s.appendChild(wf, s);
      })();
    </script>
    <!-- Style sheet -->
    <link href="<?php echo get_bloginfo('template_url'); ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo('template_url'); ?>/style.css" rel="stylesheet">
   <!-- Modernizr -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        <!--[if lte IE 9]>
            <link href="<?php echo get_bloginfo('template_url'); ?>/css/ie.css" rel="stylesheet">
            <![endif]-->
        <script>
            var base_url = "<?php echo get_bloginfo('template_url'); ?>";
        </script>
        <?php \wp_head(); ?>
      	<?php if($post->ID==110) { ?>
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 923366436;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "s5OcCLq942QQpOiluAM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/923366436/?label=s5OcCLq942QQpOiluAM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
		<?php } ?>
<!-- <script>
 window.intercomSettings = {
   app_id: "zxtx6tv1"
 };
</script> -->
<!-- <script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/zxtx6tv1';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
</head>
<body> -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDH57RC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->