<?php
/**
 * Admin Class.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Main Admin Class.
 * This Class uses admin related methods
 * by tapping into the settings API class.
 *
 * @since v1.0
 */
class Crescent_Admin {

	/**
	 * Stores the instance of the Settings API Class.
	 *
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private $settings;

	/**
	 * Stores the instance of the Settings Callbacks Class.
	 *
	 * @access private
	 * @var object
	 * @since  1.0
	 */
	private $callback;

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
	 * @return Crescent_Admin
	 * @since  1.0
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initialize Admin page with scripts.
	 *
	 * @access public
	 * @since  v1.0
	 */
	public function register() {

		// Redirect to admin page on theme activation.
		add_action( 'after_switch_theme', array( $this, 'welcome_page' ) );

		// Required and recommended plugins.
		add_action( 'tgmpa_register', array( Crescent_Plugins::get_instance(), 'register_plugins' ) );

		// Custom button for TGMPA notice.
		add_filter( 'tgmpa_notice_action_links', array( Crescent_Plugins::get_instance(), 'edit_tgmpa_notice_action_links' ) );

		// Base Class.
		$this->base = Crescent_Base::get_instance();

		// Settings API.
		$this->settings = Crescent_Settings::get_instance();

		// Settings Callbacks.
		$this->callback = Crescent_Settings_Callbacks::get_instance();

		// Init admin page with styles and scripts.
		$this->enqueue()->pages()->admin_init();
	}

	/**
	 * Redirect to admin page on theme activation.
	 *
	 * @access public
	 * @since  v1.0
	 */
	public function welcome_page() {
		if ( current_user_can('edit_theme_options' ) ) {
			header( 'Location:' . esc_url( admin_url() ) . 'themes.php?page=' . esc_attr( $this->base->get_theme_slug() . '-admin-dashboard' ) );
		}
	}

	/**
	 * Triggers the register method of the Settings API Class.
	 *
	 * @access private
	 * @since  v1.0
	 */
	private function admin_init() {
		$this->settings->register();
	}

	/**
	 * Enqueue scripts in specific admin pages.
	 *
	 * @access private
	 * @return object
	 * @since  v1.0
	 */
	private function enqueue() {

		// Multidimensional array for styles and scripts.
		$scripts = array(
			'style' => array(
				array(
					'handle' 		=> 'crescent-welcome-styles',
					'asset_uri' 	=> $this->base->get_css_uri() . 'admin/welcome-page.css',
					'dependency'	=> array(),
					'version' 		=> '1.0',
				),
			),

			'script' => array(
				array(
					'handle' 		=> 'crescent-welcome-script',
					'asset_uri' 	=> $this->base->get_js_uri() . 'admin/welcome-page.js',
					'dependency'	=> array( 'jquery' ),
					'version' 		=> '1.0',
				),
			),
		);

		// Pages array to where enqueue scripts.
		$pages = array( 'appearance_page_' . esc_attr( $this->base->get_theme_slug() . '-admin-dashboard' ) );

		// Enqueue scripts in Admin area.
		$this->settings->admin_enqueue( $scripts, $pages );

		return $this;
	}

	/**
	 * Registers theme page.
	 *
	 * @access private
	 * @return object
	 * @since  v1.0
	 */
	private function pages() {

		// Theme Page args.
		$theme_page = array(
			array(
				'page_title'	=> esc_html( $this->base->get_theme_name() . ' Theme' ),
				'menu_title' 	=> esc_html( $this->base->get_theme_name() . ' Theme' ),
				'capability' 	=> 'manage_options',
				'menu_slug' 	=> esc_attr( $this->base->get_theme_slug() . '-admin-dashboard' ),
				'callback' 		=> array( $this->callback, 'admin_dashboard' ),
			)
		);

		// Creating Theme Page.
		$this->settings->add_page( $theme_page );

		return $this;
	}
}
