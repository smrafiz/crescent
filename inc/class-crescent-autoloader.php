<?php
/**
 * The theme autoloader.
 * Handles locating and loading other class-files.
 *
 * @package     Crescent
 * @since       1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Theme loader class.
 *
 * @since 1.0
 */
class Crescent_Autoloader {

	/**
	 * Directory Paths.
	 *
	 * @var array $required_dirs Required directory Paths.
	 * @access private
	 * @since  1.0
	 */
	private $required_dirs = array(
		'inc/core',
		'inc/admin',
		'inc/setup',
		'inc/lib',
		'inc/customizer',
	);

	/**
	 * Autoload function for registering with spl_autoload_register().
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register() {
		spl_autoload_register( array( $this, 'autoload_class' ) );
	}

	/**
	 * The class autoloader.
	 * Finds the path to a class that we're requiring and includes the file.
	 *
	 * @param string $class The name of the class we're trying to load.
	 * @access private
	 * @since  1.0
	 */
	private function autoload_class( $class ) {

		if ( 0 !== strpos( $class, 'Crescent_' ) ) {
			return;
		}

		foreach ( $this->required_dirs as $key => $required_dir ) {
			$abs_dir = trailingslashit( get_parent_theme_file_path( $required_dir ) );
			$file = $abs_dir . strtolower( str_replace( '_', '-', "class-$class.php" ) );

			if ( file_exists( $file ) ) {
				include_once wp_normalize_path( $file );
				return true;
			}
		}
	}
}
