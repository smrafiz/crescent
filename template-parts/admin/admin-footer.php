<?php
/**
 * Template to display admin welcome page footer.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<div class="footer">
    <h4><?php esc_html_e( 'Leave us a review', 'crescent' ); ?></h4>
    <p>
    <?php
    echo sprintf(
        '%1$s %2$s? %3$s',
        esc_html__( 'Are you enjoying', 'crescent' ),
        esc_html( Crescent_Base::get_instance()->theme_name ),
        esc_html__( 'We would love your feedback.', 'crescent' )
    );
    ?>
    </p>
    <a href="#" class="button button-primary"><?php esc_html_e( 'Submit a Review', 'crescent' ); ?></a>
</div>
