<?php
/**
 * Customizer Fields Class.
 * This class will tap into Kirki to create fields.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Fields Class.
 *
 * @since v1.0
 */
class Crescent_Customizer_Fields {

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
     * @return Crescent_Customizer_Fields
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Sections.
     *
     * @access public
     * @since  1.0
     */
	public function register() {
        $this->add_fields();
	}

    /**
     * Theme Sections.
     *
     * @access private
     * @since  1.0
     */
	private function add_fields() {

        Crescent_Customizer::add_field( 'crescent_enable_totop', array(
            'type'              => 'switch',
            'label'             => esc_html__( 'Enable Scroll To-Top Button?', 'crescent' ),
            'description'       => esc_html__( 'Enables a scroll to top button at bottom right corner of the screen', 'crescent' ),
            'section'           => 'crescent_extra_settings',
            'priority'          => 10,
            'choices'           => array(
                'on'  => esc_html__( 'On', 'crescent' ),
                'off' => esc_html__( 'Off', 'crescent' ),
            ),
            'default'           => Crescent_Customizer_Defaults::fetch( 'crescent_enable_totop' ),
            'sanitize_callback' => array( Crescent_Sanitization::class, 'checkbox' ),
        ) );

        Crescent_Customizer::add_field( 'crescent_logo_size', array(
            'type'              => 'slider',
            'label'             => esc_html__( 'Logo Size', 'crescent' ),
            'description'       => esc_html__( 'Specify Logo width in px (Default: 180)', 'crescent' ),
            'section'           => 'title_tagline',
            'priority'          => 50,
            'choices'           => array(
                'max'  => 300,
                'min'  => 0,
                'step' => 1,
            ),
            'transport'         => 'auto',
            'default'           => Crescent_Customizer_Defaults::fetch( 'crescent_logo_size' ),
            'output'            => Crescent_Customizer_Outputs::print( 'crescent_logo_size' ),
            'sanitize_callback' => array( Crescent_Sanitization::class, 'number' ),
        ) );

        Crescent_Customizer::add_field( 'crescent_body_font', array(
            'type'        => 'typography',
            'label'       => esc_html__( 'Body Font Style', 'crescent' ),
            'description' => esc_html__( 'Change Body font family and font style.', 'crescent' ),
            'section'     => 'crescent_typography_body',
            'priority'    => 10,
            'choices'     => array(
                'font-style'  => true,
                'font-family' => true,
                'font-size'   => true,
                'line-height' => true,
                'font-weight' => true,
            ),
            'transport'   => 'auto',
            'default'     => Crescent_Customizer_Defaults::fetch( 'crescent_body_font' ),
            'output'      => Crescent_Customizer_Outputs::print( 'crescent_body_font' ),
        ) );
	}

}
