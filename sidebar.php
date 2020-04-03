<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<aside id="secondary" class="widget-area">
    <?php
    if ( is_single() && is_active_sidebar( 'crescent-sidebar-blog' ) ) {
        dynamic_sidebar( 'crescent-sidebar-blog' );
    } elseif ( is_home() && is_active_sidebar( 'crescent-sidebar-blog' ) ) {
        dynamic_sidebar( 'crescent-sidebar-blog' );
    } elseif ( is_archive() && is_active_sidebar( 'crescent-sidebar-blog' ) ) {
        dynamic_sidebar( 'crescent-sidebar-blog' );
    } else {
        dynamic_sidebar( 'crescent-sidebar-general' );
    }
    ?>
</aside><!-- #secondary -->
