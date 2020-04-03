<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>
			<?php
			/**
			 * Hook: crescent_content_bottom, Bottom Contents inside #content.
			 */
			do_action( 'crescent_content_bottom' );
			?>
		</div><!-- #content -->

		<?php
		/**
		 * Hook: crescent_before_footer, Contents before #colophon.
		 */
		do_action( 'crescent_before_footer' );
		?>

		<footer id="colophon" class="site-footer">

			<?php
			/**
			 * Hook: crescent_footer, Contents inside #colophon.
			 */
			do_action( 'crescent_footer' );
			?>

		</footer><!-- #colophon -->

		<?php
		/**
		 * Hook: crescent_after_footer, Contents after #colophon.
		 */
		do_action( 'crescent_after_footer' );
		?>

	</div><!-- #page -->

	<?php
	/**
	 * Hook: crescent_after_site, Contents after #page.
	 */
	do_action( 'crescent_after_site' );
	?>

	<?php wp_footer(); ?>

</body>
</html>
