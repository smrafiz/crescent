<?php
/**
 * The template used for displaying page content in page.php.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<article id="page-<?php the_ID(); ?>" <?php post_class( array( 'page-entry-content' ) ); ?>>

	<?php
	/**
	 * Hook: crescent_page, Page contents.
	 *
	 * @hooked crescent_page_content - 10
	 */
	do_action( 'crescent_page' );
	?>

</article><!-- #post-## -->
