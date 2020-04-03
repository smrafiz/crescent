<?php
/**
 * Customizer Output Class.
 * This class contains all the output values of Customizer Controls.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Output Class.
 *
 * @since v1.0
 */
class Crescent_Customizer_Outputs {

	/**
	 * Customizer Default values.
     *
     * @static
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private static $outputs;

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
     * @return Crescent_Customizer_Outputs
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Print Outputs.
     *
     * @static
     * @access public
     * @since  1.0
     */
	public static function print( $name ) {

        // Loading the outputs.
		self::customizer_outputs();

        // Checking for validity.
        if( ! array_key_exists( $name, self::$outputs ) ) {
            return;
        }

        // Printing the desired output.
        return self::$outputs[ $name ];

	}

    /**
     * Theme Outputs.
     *
     * @static
     * @access private
     * @since  1.0
     */
	private static function customizer_outputs() {
		self::$outputs = array(
			'crescent_logo_size'  => array(
                array(
                    'element'  => '.header .logo img',
                    'property' => 'width',
                    'units'    => 'px',
                ),
            ),
            'crescent_body_font' => array(
                array(
                    'element' => 'body, button, input, select, textarea',
                ),
            ),
        );
	}

}
