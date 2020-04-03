<?php
/**
 * Customizer Class.
 * We are using Kirki Customizer toolkit to define
 * panels, sections and controls.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Initialization Class.
 *
 * @since v1.0
 */
class Crescent_Customizer {

	/**
	 * Base Class.
	 *
	 * @access private
	 * @var object
	 * @since  1.0
	 */
    private $base;

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
     * @return Crescent_Customizer
     * @since  1.0
     */
    public static function get_instance() {
        if( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Init Customizer.
     *
     * @access public
     * @since  1.0
     */
	public function register() {

        // Framework Base.
        $this->base = Crescent_Base::get_instance();

        // Initializing Customizer.
        $this->customizer_init()->customizer_preview_scripts();

        // Registering modules.
        foreach ( $this->get_classes() as $class ) {
            $theme_customizer = $class::get_instance();

            if ( method_exists( $theme_customizer, 'register' ) ) {
                $theme_customizer->register();
            }
        }

        $this->kirki_fallback();
    }

    /**
     * Customizer initialization with Kirki.
     *
     * @access private
     * @since  1.0
     */
    private function customizer_init() {

        // Setting up Kirki.
        add_action( 'init', array( $this, 'setup_kirki' ) );

        // Modifying existing controls.
        add_action( 'customize_register', array( $this, 'modify_customizer' ) );

        // Disabling kirki Custom Loader.
        add_filter( 'kirki/config', array( $this, 'customizer_styles' ) );

        return $this;
    }

    /**
     * Customizer preview styles & scripts.
     *
     * @access private
     * @since  1.0
     */
    private function customizer_preview_scripts() {

        // Selective refresh js.
        add_action( 'customize_preview_init', array( $this, 'customizer_preview_js' ) );

        // Customizer controls css.
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_enqueue_scripts' ), 11 );
    }

    /**
     * Store all the customizer classes.
     *
     * @access private
     * @since  1.0
     */
    private function get_classes() {
        $classes = array(
            Crescent_Customizer_Panels::class,
            Crescent_Customizer_Sections::class,
            Crescent_Customizer_Fields::class,
        );

        return $classes;
    }

	/**
	 * Initializing Kirki Toolkit.
	 *
	 * @access public
	 * @since  v1.0
	 */
	public function setup_kirki() {

        // Config name.
        $config_id = 'crescent';

        // Config args.
		$args = array(
			'capability'    => 'edit_theme_options',
			'option_type'   => 'theme_mod',
        );

		// Adding kirki configuration.
		Kirki::add_config( $config_id, $args );
    }

	/**
	 * Modifying some existing sections and controls.
	 *
     * @param  object $wp_customize An instance of the WP_Customize_Manager class.
	 * @access public
	 * @since  v1.0
	 */
	public function modify_customizer( $wp_customize ) {

		// Move background color setting alongside background image.
		$wp_customize->get_control( 'background_color' )->section  = 'background_image';
		$wp_customize->get_control( 'background_color' )->priority = 20;

		$wp_customize->get_control( 'header_textcolor' )->section  = 'header_image';
		$wp_customize->get_control( 'header_textcolor' )->priority = 11;

		// Change some default title and description.
		$wp_customize->get_section( 'background_image' )->title       = esc_html__( 'Site Background', 'crescent' );
		$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Site Background Options', 'crescent' );
		$wp_customize->get_section( 'title_tagline' )->title 		  = esc_html__( 'Site Logo/Title/Tagline', 'crescent' );
		$wp_customize->get_section( 'header_image' )->title 	   	  = esc_html__( 'Header Background &amp; Color', 'crescent' );

		// move some general controls.
		$wp_customize->get_section( 'static_front_page' )->panel = 'crescent_general_settings';
		$wp_customize->get_section( 'title_tagline' )->panel     = 'crescent_general_settings';
		$wp_customize->get_section( 'background_image' )->panel  = 'crescent_general_settings';
		$wp_customize->get_section( 'header_image' )->panel      = 'crescent_header_settings';

		// Selective refresh.
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => 'header #header-text',
			'render_callback' => function() {
				bloginfo( 'name' );
			},
		));

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => 'header .site-description',
			'render_callback' => function() {
				bloginfo( 'description' );
			},
		));
    }

	/**
	 * Disabling Kirki custom loader.
	 *
     * @param  array $config Configuration array.
	 * @access public
	 * @since  v1.0
	 */
	public function customizer_styles( $config ) {
		return wp_parse_args( array(
			'disable_loader'  => true,
		), $config );
    }

	/**
	 * JS for Live Preview.
	 *
	 * @access public
	 * @since  v1.0
	 */
	public function customizer_preview_js() {
        wp_enqueue_script( 'crescent-customizer-preview-js', $this->base->get_js_uri() . 'admin/customize-preview.js', array( 'customize-preview', 'jquery' ), $this->base->get_theme_version() );
    }

	/**
	 * Customizer Controls CSS.
	 *
     * @param  object $wp_customize An instance of the WP_Customize_Manager class.
     * @access public
	 * @since  v1.0
	 */
	public function controls_enqueue_scripts( $wp_customize ) {
        wp_enqueue_style( 'crescent-customizer-controls-styles', $this->base->get_css_uri() . 'admin/customizer.css', array(), $this->base->get_theme_version() );
    }

	/**
	 * Method for adding panels.
	 *
     * @static
	 * @access public
	 * @since  v1.0
	 */
	public static function add_panel( $panel_id, $panel_args ) {
        return Kirki::add_panel( $panel_id, $panel_args );
    }

	/**
	 * Method for adding sections.
	 *
     * @static
	 * @access public
	 * @since  v1.0
	 */
	public static function add_section( $section_id, $section_args ) {
        return Kirki::add_section( $section_id, $section_args );
    }

	/**
	 * Method for adding fields.
	 *
     * @static
	 * @access public
	 * @since  v1.0
	 */
	public static function add_field( $field_id, $field_args ) {

        // Config name.
        $config_id = 'crescent';

        // Settings name.
        $settings_name = array(
            'settings'    => $field_id,
        );

        // Merging with settings.
        $args = wp_parse_args( $field_args, $settings_name );

        // Connecting with Kirki.
        return Kirki::add_field( $config_id, $args );
    }

	/**
	 * Kirki fallback.
	 *
	 * @access private
	 * @since  v1.0
	 */
	public function kirki_fallback() {
        new Crescent_Customizer_Kirki_fallback();
    }
}
