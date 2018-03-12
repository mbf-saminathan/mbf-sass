<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php wp_title() ?></title>
  <!-- <link rel="stylesheet" type="text/css" href="css/app.css"> --> 
  <!-- Montserrat font included -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
  <!-- modernizr included -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  <?php wp_head(); ?>
    <script type="text/javascript">
        var templateUri = "<?php echo get_bloginfo('template_url'); ?>";
        var blogUri = "<?php echo get_bloginfo('url'); ?>";
        var templateUri = '<?php echo TMPL_URL; ?>';
    </script>
    <style type="text/css">
        body{
          background-color: #fff;
        }  
        .render-blk{ opacity:0; }
    </style>
    <script type="text/javascript">
        var styleSheets = ["css/app.css","style.css"];
        for (i = 0; i < styleSheets.length; i++) { 
           var linkVal = "<?php echo get_bloginfo('template_url'); ?>/"+styleSheets[i];
           var link = document.createElement('link')
           link.setAttribute('rel', 'stylesheet')
           link.setAttribute('type', 'text/css')
           link.setAttribute('href', linkVal);
           document.getElementsByTagName('head')[0].appendChild(link)
        }
   </script>
    <noscript>
        <style type="text/css" media="screen">
      .render-blk{ opacity: 1; }  
        </style>
    </noscript>

</head>
<body <?php body_class(); ?> >
  <div class="render-blk">
    