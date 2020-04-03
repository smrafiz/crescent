<?php
/**
 * The template for displaying all single posts.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

get_header(); ?>

	<div id="primary" class="content-area">
		<?php
		/**
		 * Hook: crescent_primary_top, Top Contents inside #primary.
		 *
		 * @hooked crescent_content_area_container_start - 0
		 * @hooked crescent_main_wrapper_start           - 5
		 */
		do_action( 'crescent_primary_top' );
		?>
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			/**
			 * Hook: crescent_single_post_before, Contents before single post content.
			 */
			do_action( 'crescent_single_post_before' );

			get_template_part( 'template-parts/content/content', 'single' );

			/**
			 * Hook: crescent_single_post_after, Contents after single post content.
			 */
			do_action( 'crescent_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
		<?php
		/**
		 * Hook: crescent_sidebar, Renders sidebar contents.
		 *
		 * @hooked crescent_main_wrapper_close    - 0
		 * @hooked crescent_sidebar_wrapper_start - 5
		 */
		do_action( 'crescent_sidebar' );

		/**
		 * Hook: crescent_primary_bottom, Bottom Contents inside #primary.
		 *
		 * @hooked crescent_sidebar_wrapper_close        - 0
		 * @hooked crescent_content_area_container_close - 50
		 */
		do_action( 'crescent_primary_bottom' );
		?>
	</div><!-- #primary -->

<?php
get_footer();
