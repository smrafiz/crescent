<?php
/**
 * The template for displaying the header.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>
	<![endif]-->

	<?php
	/**
	 * Hook: crescent_before_site, Contents before #page.
	 *
	 * @hooked crescent_mobile_navigation      - 10
	 * @hooked crescent_mobile_navigation_mask - 15
	 */
	do_action( 'crescent_before_site' );
	?>
	<div id="page" class="<?php crescent_page_class(); ?>">

		<?php
		/**
		 * Hook: crescent_before_header, Contents before #masthead.
		 */
		do_action( 'crescent_before_header' );
		?>
		<header id="masthead" class="<?php crescent_header_class(); ?>">
			<?php
			/**
			 * Hook: crescent_header, Contents inside #masthead.
			 *
			 * @hooked crescent_skip_links                       - 0
			 * @hooked crescent_header_area_wrapper_start        - 5
			 * @hooked crescent_header_container_start           - 10
			 * @hooked crescent_site_branding                    - 15
			 * @hooked crescent_primary_navigation_wrapper_start - 20
			 * @hooked crescent_primary_navigation               - 25
			 * @hooked crescent_mobile_navigation_activator      - 30
			 * @hooked crescent_primary_navigation_wrapper_close - 35
			 * @hooked crescent_header_container_close           - 40
			 * @hooked crescent_header_area_wrapper_close        - 45
			 * @hooked crescent_fixed_header_height_placeholder  - 50
			 */
			do_action( 'crescent_header' );
			?>
		</header><!-- #masthead -->

		<?php
		/**
		 * Hook: crescent_before_content, Contents before #content.
		 *
		 * @hooked crescent_page_title - 10
		 */
		do_action( 'crescent_before_content' );
		?>
		<div id="content" class="site-content" tabindex="-1">

			<?php
			/**
			 * Hook: crescent_content_top, Top Contents inside #content.
			 */
			do_action( 'crescent_content_top' );
			?>
