<!doctype html>  

<html <?php language_attributes(); ?>>

<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<title>
		<?php wp_title('//', true, 'right'); ?>
	</title>
	
	<!-- mobile meta -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	

	<!-- wordpress head functions -->
	<?php wp_head(); ?>

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() ?>/library/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri() ?>/library/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri() ?>/library/icons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_stylesheet_directory_uri() ?>/library/icons/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri() ?>/library/icons/safari-pinned-tab.svg" color="#016979">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/library/icons/favicon.ico">
  <meta name="apple-mobile-web-app-title" content="PPSri.org">
  <meta name="application-name" content="PPSri.org">
  <meta name="msapplication-TileColor" content="#016979">
  <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri() ?>/library/icons/mstile-150x150.png">
  <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri() ?>/library/icons/mstile-144x144.png">
  <meta name="msapplication-config" content="<?php echo get_stylesheet_directory_uri() ?>/library/icons/browserconfig.xml">
  <meta name="theme-color" content="#D7F5FA">
  <?php
    // Google Analytics 4 for the Guide. Same property ID the pps-2025 theme assigns to site 2.
    if ( ! is_user_logged_in() ) : ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-CYJ3R9M540"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-CYJ3R9M540');
  </script>
  <?php endif; ?>

  <!-- create template directory url variable to be used in our javascript -->
  <script>
  var stylesheetDir = "<?php bloginfo('stylesheet_directory') ?>";
  </script>

</head>

<body <?php body_class(); ?>>

<?php get_template_part('partials/nav'); ?>
