<?php
/**
 * Customizer Defaults Class.
 * This class contains all the default values of Customizer Controls.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Defaults Class.
 *
 * @since v1.0
 */
class Crescent_Customizer_Defaults {

	/**
	 * Customizer Default values.
     *
     * @static
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private static $defaults;

    /**
     * Refers to a single instance of this class.
     *
     * @static
     * @access public
     * @var null|object
     * @since  1.0
     */
    public static $instance = null;

    /**
     * Access the single instance of this class.
     *
     * @static
     * @access public
     * @return Crescent_Customizer_Defaults
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fetch Default Values.
     *
     * @static
     * @access public
     * @since  1.0
     */
	public static function fetch( $name ) {

        // Loading the defaults.
		self::customizer_defaults();

        // Checking for validity.
        if( ! array_key_exists( $name, self::$defaults ) ) {
            return;
        }

        // Fetching the desired default value.
        return self::$defaults[ $name ];

	}

    /**
     * Theme Defaults.
     *
     * @static
     * @access private
     * @since  1.0
     */
	private static function customizer_defaults() {
		self::$defaults = array(
			'crescent_enable_totop'  => 1,
            'crescent_logo_size'  => 200,
            'crescent_body_font' => array(
                'font-family'    => 'Source Sans Pro',
                'variant'    	 => 'regular',
                'font-size'      => '16px',
                'line-height'    => '1.5',
            ),
        );
	}

}
