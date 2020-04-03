<?php
/**
 * Customizer Panel Class.
 * This class will tap into Kirki to create panels.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Panels Class.
 *
 * @since v1.0
 */
class Crescent_Customizer_Panels {

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
     * @return Crescent_Customizer_Panels
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Panels.
     *
     * @access public
     * @since  1.0
     */
	public function register() {
		$this->add_panels();
	}

    /**
     * Theme Panels.
     *
     * @access private
     * @since  1.0
     */
	private function add_panels() {

        Crescent_Customizer::add_panel( 'crescent_general_settings', array(
            'priority'    => 10,
            'title'       => esc_html__( 'General Settings', 'crescent' ),
            'description' => esc_html__( 'General Settings', 'crescent' ),
            'icon' 		  => 'dashicons-admin-generic',
        ) );

        Crescent_Customizer::add_panel( 'crescent_header_settings', array(
            'priority'    => 11,
            'title'       => esc_html__( 'Header Settings', 'crescent' ),
            'description' => esc_html__( 'Logo and Page Title settings', 'crescent' ),
            'icon' 		  => 'dashicons-editor-kitchensink',
        ) );

        Crescent_Customizer::add_panel( 'crescent_typography_settings', array(
            'priority'    => 12,
            'title'       => esc_html__( 'Typography Settings', 'crescent' ),
            'description' => esc_html__( 'All the typography settings', 'crescent' ),
            'icon' 		  => 'dashicons-editor-spellcheck',
        ) );

        Crescent_Customizer::add_panel( 'crescent_blog_settings', array(
            'priority'    => 25,
            'title'       => esc_html__( 'Blog Settings', 'crescent' ),
            'description' => esc_html__( 'Blog, Archive and Single Post settings', 'crescent' ),
            'icon' 		  => 'dashicons-schedule',
        ) );

        Crescent_Customizer::add_panel( 'crescent_footer_settings', array(
            'priority'    => 27,
            'title'       => esc_html__( 'Footer Settings', 'crescent' ),
            'description' => esc_html__( 'Footer Settings', 'crescent' ),
            'icon' 		  => 'dashicons-download',
        ) );
	}

}
