<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="no-js ie6 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IEMobile 7]>
<html id="ie7" class="no-js iem7 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]&!(IEmobile)]>
<html id="ie7" class="no-js ie7 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[(IE 8)&!(IEMobile)]>
<html id="ie8" class="no-js ie8 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>

<!-- 320 and up -->
<!-- http://t.co/dKP3o1e -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,700italic|Cabin:400,600,400italic,600italic' rel='stylesheet' type='text/css'>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_enqueue_script('jquery'); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed">
  <div class="skip-link screen-reader-text visuallyhidden"><a href="#content" title="<?php // esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>

	<header id="branding" role="banner">

		<?php if ( is_active_sidebar( 'header-above' ) ) : ?>
		<section id="header-above" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'header-above' ); ?>
		</section><!-- #header-above .widget-area -->
		<?php endif; ?>

		<hgroup>
			<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php // bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="access" role="navigation">
			<h1 class="assistive-text section-heading visuallyhidden"><?php _e( 'Main menu', 'toolbox' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
      <div style="clear:both;"></div>
		</nav><!-- #access -->
	</header><!-- #branding -->

	<div id="main">
