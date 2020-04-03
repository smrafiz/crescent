<?php
/**
 * Template to display admin welcome page header.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<div class="header">
    <h1><?php echo esc_html__( 'Welcome to ', 'crescent' ) . esc_html( Crescent_Base::get_instance()->get_theme_name() ); ?></h1>
    <h4><?php echo esc_html__( 'Theme Version: ', 'crescent' ); ?><span><?php echo esc_html( Crescent_Base::get_instance()->get_theme_version() ); ?></span></h4>
    <p class="about-theme">
        <?php
        echo sprintf(
            '%1$s %2$s. %3$s',
            esc_html__( 'Thank you for choosing', 'crescent' ),
            esc_html( Crescent_Base::get_instance()->theme_name ),
            esc_html__( 'The WordPress theme is now installed and ready to use! Get ready to build some awesome websites. Check out the below tabs for more information and updates. We hope you will love it.', 'crescent' )
        );
        ?>
    </p>
</div>
