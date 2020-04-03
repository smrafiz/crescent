<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	printf(
		'<p class="alert">%s</p>',
		esc_html__( 'This post is password protected. Enter the password to view comments.', 'crescent' ) );
	return;
}
?>

<?php
/**
 * Hook: crescent_before_comment_area, Contents before Comments area.
 *
 * @hooked crescent_comment_area_wrapper_start - 10
 */
do_action( 'crescent_before_comment_area' );

/**
 * Hook: crescent_comment_area, Comment area contents.
 *
 * @hooked crescent_render_comments_list - 10
 * @hooked crescent_render_comment_form  - 20
 */
do_action( 'crescent_comment_area' );

/**
 * Hook: crescent_after_comment_area, Contents after Comments area.
 *
 * @hooked crescent_comment_area_wrapper_close - 50
 */
do_action( 'crescent_after_comment_area' );
