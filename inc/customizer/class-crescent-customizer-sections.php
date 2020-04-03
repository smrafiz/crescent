<?php
/**
 * Customizer Section Class.
 * This class will tap into Kirki to create sections.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Customizer Sections Class.
 *
 * @since v1.0
 */
class Crescent_Customizer_Sections {

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
     * @return Crescent_Customizer_Sections
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
		$this->add_sections();
	}

    /**
     * Theme Sections.
     *
     * @access private
     * @since  1.0
     */
	private function add_sections() {

        Crescent_Customizer::add_section( 'crescent_google_map_settings', array(
            'title'          => esc_html__( 'Google Map Settings', 'crescent' ),
            'description'    => esc_html__( 'Google Map Settings', 'crescent' ),
            'panel'          => 'crescent_general_settings',
            'priority'       => 200,
        ) );

        Crescent_Customizer::add_section( 'crescent_extra_settings', array(
            'title'          => esc_html__( 'Extra Settings', 'crescent' ),
            'description'    => esc_html__( 'Extra Settings', 'crescent' ),
            'panel'          => 'crescent_general_settings',
            'priority'       => 201,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_body', array(
            'title'          => esc_html__( 'Body Font', 'crescent' ),
            'description'    => esc_html__( 'Specify the body font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 10,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_header', array(
            'title'          => esc_html__( 'Header Text Font', 'crescent' ),
            'description'    => esc_html__( 'Specify the Header Text font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 15,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_nav', array(
            'title'          => esc_html__( 'Main Menu Font', 'crescent' ),
            'description'    => esc_html__( 'Specify the Navigation Menu font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 20,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_page_title', array(
            'title'          => esc_html__( 'Page Title Font', 'crescent' ),
            'description'    => esc_html__( 'Specify the Page Title font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 25,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_h1', array(
            'title'          => esc_html__( 'Heading 1 Font', 'crescent' ),
            'description'    => esc_html__( 'Specify h1 font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 30,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_h2', array(
            'title'          => esc_html__( 'Heading 2 Font', 'crescent' ),
            'description'    => esc_html__( 'Specify h2 font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 40,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_h3', array(
            'title'          => esc_html__( 'Heading 3 Font', 'crescent' ),
            'description'    => esc_html__( 'Specify h3 font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 50,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_h4', array(
            'title'          => esc_html__( 'Heading 4 Font', 'crescent' ),
            'description'    => esc_html__( 'Specify h4 font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 60,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_h5', array(
            'title'          => esc_html__( 'Heading 5 Font', 'crescent' ),
            'description'    => esc_html__( 'Specify h5 font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 70,
        ) );

        Crescent_Customizer::add_section( 'crescent_typography_h6', array(
            'title'          => esc_html__( 'Heading 6 Font', 'crescent' ),
            'description'    => esc_html__( 'Specify h6 font properties.', 'crescent' ),
            'panel'          => 'crescent_typography_settings',
            'priority'       => 80,
        ) );

        Crescent_Customizer::add_section( 'crescent_color_scheme', array(
            'title'          => esc_html__( 'Colors', 'crescent' ),
            'description'    => esc_html__( 'Color Properties', 'crescent' ),
            'priority'       => 15,
            'icon'			 => 'dashicons-admin-customizer',
        ) );

        Crescent_Customizer::add_section( 'crescent_logo_section', array(
            'title'          => esc_html__( 'Logo', 'crescent' ),
            'description'    => esc_html__( 'Logo Properties', 'crescent' ),
            'panel'          => 'crescent_header_settings',
            'priority'       => 10,
        ) );

        Crescent_Customizer::add_section( 'crescent_header_options', array(
            'title'          => esc_html__( 'Header Options', 'crescent' ),
            'description'    => esc_html__( 'Misc. header settings', 'crescent' ),
            'panel'          => 'crescent_header_settings',
            'priority'       => 100,
        ) );

        Crescent_Customizer::add_section( 'crescent_page_title_section', array(
            'title'          => esc_html__( 'Page Title &amp; Breadcrumb Settings', 'crescent' ),
            'description'    => esc_html__( 'Page Title &amp; Breadcrumb Properties', 'crescent' ),
            'panel'          => 'crescent_header_settings',
            'priority'       => 105,
        ) );

        Crescent_Customizer::add_section( 'crescent_blog_section', array(
            'title'          => esc_html__( 'Blog and Archive Settings', 'crescent' ),
            'description'    => esc_html__( 'Blog and Archive Properties', 'crescent' ),
            'panel'          => 'blog_settings',
            'priority'       => 10,
        ) );

        Crescent_Customizer::add_section( 'crescent_blog_single_section', array(
            'title'          => esc_html__( 'Blog Single Settings', 'crescent' ),
            'description'    => esc_html__( 'Blog Single Properties', 'crescent' ),
            'panel'          => 'blog_settings',
            'priority'       => 15,
        ) );

        Crescent_Customizer::add_section( 'crescent_social_profiles', array(
            'title'          => esc_html__( 'Social Media Settings', 'crescent' ),
            'description'    => esc_html__( 'Please enter your Social Media Profile information', 'crescent' ),
            'priority'       => 26,
            'icon'           => 'dashicons-admin-site',
        ) );

        Crescent_Customizer::add_section( 'crescent_footer_section', array(
            'title'          => esc_html__( 'Footer Options', 'crescent' ),
            'description'    => esc_html__( 'Footer Properties', 'crescent' ),
            'panel'          => 'footer_settings',
            'priority'       => 10,
        ) );

        Crescent_Customizer::add_section( 'crescent_footer_copy_section', array(
            'title'          => esc_html__( 'Footer Copyright Options', 'crescent' ),
            'description'    => esc_html__( 'Footer Copyright Properties', 'crescent' ),
            'panel'          => 'footer_settings',
            'priority'       => 20,
        ) );
	}

}
