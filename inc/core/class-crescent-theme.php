<?php
/**
 * The main theme initialization class.
 * We're using this one to instantiate other classes
 * and access the main theme objects.
 *
 * @package     Crescent
 * @since       1.0
 */

// Do not allow directly accessing this file.
if ( ! defined('ABSPATH' ) ) {
    exit( 'This script cannot be accessed directly.' );
}

final class Crescent_Theme {

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
     * @return Crescent_Theme
     * @since  1.0
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Store all the classes.
     *
     * @access private

     * @since  1.0
     */
    private function get_classes() {
        $classes = array(
            Crescent_Widgets::class,
            Crescent_Menus::class,
            Crescent_Setup::class,
            Crescent_Scripts::class,
        );

        if( class_exists( 'TGM_Plugin_Activation' ) ) {
            array_push( $classes, Crescent_Admin::class );
        }

        if( class_exists( 'kirki' ) ) {
            array_push( $classes, Crescent_Customizer::class );
        }

        return $classes;
    }

    /**
     * Store all the files.
     *
     * @access private

     * @since  1.0
     */
    private function get_files() {
        $files = array(

            // Framework files.
            $this->base->get_framework_directory() . 'functions/helpers',
            $this->base->get_framework_directory() . 'functions/sanitization',
            $this->base->get_framework_directory() . 'functions/template-hooks',
            $this->base->get_framework_directory() . 'functions/template-functions',

            // Vendor files.
            $this->base->get_vendor_directory() . 'tgmpa/class-tgm-plugin-activation',
            $this->base->get_vendor_directory() . 'kirki/class-kirki-installer-section',
        );

        return $files;
    }

    /**
     * Method to register the services and functions.
     *
     * @access public
     * @since  1.0
     */
    public function register_services() {

        // Base Class.
        $this->base = Crescent_Base::get_instance();

        // Registering Functions & Services.
        $this->functions()->services();
    }

    /**
     * Method to register the functions.
     *
     * @access private
     * @since  1.0
     */
    private function functions() {
        foreach ( $this->get_files() as $file ) {
            $this->base::require_file( "$file.php" );
        }

        return $this;
    }

    /**
     * Method to register the services.
     *
     * @access private
     * @since  1.0
     */
    private function services() {
        foreach ( $this->get_classes() as $class ) {
            $service = $class::get_instance();

            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }

        // Kirki fallback.
        // if( ! class_exists( 'kirki' ) ) {
        //     new Crescent_Customizer_Kirki_fallback;
        // }
    }
}
