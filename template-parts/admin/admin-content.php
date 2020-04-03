<?php
/**
 * Template to display admin welcome page content.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<div id="crescent-content-tab">
    <?php
    echo '<p class="required-plugin-description">' . esc_html__( 'Crescent Companion Plugin is required to use with ', 'crescent' ) . esc_html( Crescent_Base::get_instance()->get_theme_name() ) . esc_html__( '. The recommended plugins offer design integrations for this theme. Install and activate all the plugins to get the full flavour of the theme.', 'crescent' ) . '</p>'
    ?>

    <h2 class="nav nav-tab-wrapper">
        <?php

        // Initializing rendering.
        $content_render = Crescent_Settings_Callbacks::get_instance();

        // Building up tab content.
        $admin_tabs = array(
            __( 'dashboard', 'crescent' ) => array(
                array(
                    'title'     => esc_html__( 'Install Plugins', 'crescent' ),
                    'description'      => esc_html__( 'We have created a curated list of recommended plugins. Please install and activate these plugins for using core functionalities of Crescent WP theme.', 'crescent' ),
                    'column'    => 'col col-4',
                    'button'    => array(
                        'text'          => esc_html__( 'Install Plugins', 'crescent' ),
                        'link'          => esc_url( '#tab-recommened-plugins' ),
                        'need_button'   => true,
                        'new_tab'       => false,
                    ),
                ),
                array(
                    'title'     => esc_html__( 'Documentation', 'crescent' ),
                    'description'      => esc_html__( 'Need assistance? Learn more about any aspect of Crescent WP Theme.', 'crescent' ),
                    'column'    => 'col col-4',
                    'button'    => array(
                        'text'          => esc_html__( 'Read Documentation', 'crescent' ),
                        'link'          => esc_url( 'https://themeitems.com' ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ),
                ),
                array(
                    'title'     => esc_html__( 'Customize Crescent WP', 'crescent' ),
                    'description'      => esc_html__( 'You can customize everything in Crescent WP theme using the powerful WordPress Customizer.', 'crescent' ),
                    'column'    => 'col col-4',
                    'button'    => array(
                        'text'          => esc_html__( 'Customize', 'crescent' ),
                        'link'          => esc_url( admin_url( 'customize.php' ) ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ),
                ),
            ),
            __( 'recommened-plugins', 'crescent' ) => array(
                array(
                    'title'             => esc_html__( 'Plugins', 'crescent' ),
                    'description'      => esc_html__( 'You can customize everything in Crescent WP theme using the powerful WordPress Customizer.', 'crescent' ),
                    'column'            => 'col col-12',
                ),
            ),
            __( 'support', 'crescent' ) => array(
                array(
                    'title'             => esc_html__( 'Need Some Help?', 'crescent' ),
                    'description'       => esc_html__( 'Please contact us for any kind of help. We would love to be of any assistance.', 'crescent' ),
                    'icon'              => esc_html__( '', 'crescent' ),
                    'column'            => 'col col-4',
                    'button'            => array(
                        'text'          => esc_html__( 'Contact Us', 'crescent' ),
                        'link'          => esc_url( '#' ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ),
                ),
                array(
                    'title'             => esc_html__( 'Documentation', 'crescent' ),
                    'description'       => esc_html__( 'Need assistance? Learn more about any aspect of Crescent WP Theme.', 'crescent' ),
                    'column'            => 'col col-4',
                    'button'            => array(
                        'text'          => esc_html__( 'Read Documentation', 'crescent' ),
                        'link'          => esc_url( 'https://themeitems.com' ),
                        'need_button'   => true,
                        'new_tab'       => true,
                    ),
                ),
                array(
                    'title'             => esc_html__( 'Changelog', 'crescent' ),
                    'description'       => esc_html__( 'Need to check the recent changes? Please check our changelog to get a summary of the recent fixes and implementions.', 'crescent' ),
                    'column'            => 'col col-4',
                    'button'            => array(
                        'text'          => esc_html__( 'Read Changelog', 'crescent' ),
                        'link'          => esc_url( '#tab-changelog' ),
                        'need_button'   => true,
                        'new_tab'       => false,
                    ),
                ),
            ),
            __( 'demo-import', 'crescent' ) => array(
                array(
                    'title'             => esc_html__( 'Import Demo Contents', 'crescent' ),
                    'description'       => esc_html__( 'Clone a demo site in a few clicks.', 'crescent' ),
                    'column'            => 'col col-12',
                ),
            ),
            __( 'changelog', 'crescent' ) => array(
                array(
                    'title'             => esc_html__( 'Crescent WP Changelog', 'crescent' ),
                    'description'       => esc_html__( 'Check for any recent changes', 'crescent' ),
                    'column'            => 'col col-12',
                ),
            ),
        );

        $tab_list = '';

        foreach( $admin_tabs as $key => $value ) {
            $tab_list .= '<a class="nav-tab" href="#tab-' . $key . '">' . esc_attr( ucfirst( str_replace( '-', ' ', $key ) ) ) . '</a>';
        }

        echo $tab_list; // WPCS: XSS ok.
        ?>

    </h2>

	<div class="tab-content">
        <div class="container">
            <?php
            $tab_content = '';

            $i = 0;
            foreach( $admin_tabs as $key => $value ) {
                $active = ( 0 === $i ) ? ' active' : '';
                $tab_content .= '<div class="tab-pane' . esc_attr( $active ) . '" id="tab-' . $key . '">';
                $tab_content .= $content_render->section_render( $value );

                    switch( $key ) {
                        case 'recommened-plugins':
                            $tab_content .= Crescent_Plugins::get_instance()->render();
                            break;

                        default:
                            break;
                    }
                $tab_content .= '</div>';

                $i++;
            }

            echo $tab_content; // WPCS: XSS ok.
            ?>
        </div><!-- .container -->
	</div><!-- .tab-content -->
</div><!-- .crescent-content-tab -->
