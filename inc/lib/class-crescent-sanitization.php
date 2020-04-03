<?php
/**
 * Theme Sanitization Class.
 * This class contains various sanitization definitions.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Theme Sanitization Class.
 *
 * @since v1.0
 */
class Crescent_Sanitization {

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
     * @return Crescent_Sanitization
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Checkbox sanitization callback.
     *
     * @static
     * @param  bool $checked Whether the checkbox is checked.
     * @return bool Whether the checkbox is checked.
     * @access public
     * @since  1.0
     */
    public static function checkbox( $checked ) {
        return ( ( isset( $checked ) && ( true === $checked || 'on' === $checked ) ) ? true : false );
    }

    /**
     * Number sanitization callback
     *
     * @static
     * @param  mixed $value The number to sanitize.
     * @return int Sanitized number.
     * @access public
     * @since  1.0
     */
    public static function number( $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $key => $v ) {
                $value[ $key ] = is_numeric( $v ) ? $v : intval( $v );
            }
            return $value;
        } else {
            return ( is_numeric( $value ) ) ? $value : intval( $value );
        }
    }

}
