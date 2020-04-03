<?php
/**
 * Theme Engine Room.
 * This theme uses OOP logic instead of procedural coding.
 * Every function, hook and action is properly organized inside related folders and files.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * This Theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/utils/back-compat.php';
	return;
}

if ( file_exists( get_parent_theme_file_path( 'inc/class-crescent-autoloader.php' ) ) ) {
    require_once get_parent_theme_file_path( 'inc/class-crescent-autoloader.php' );

    // Initializing Autoloading.
    $crescent_loader = new Crescent_autoloader();
    $crescent_loader->register();
}

if ( class_exists( 'Crescent_Theme' ) ) {

	// Starting the app.
	$theme = Crescent_Theme::get_instance();
	$theme->register_services();
}
