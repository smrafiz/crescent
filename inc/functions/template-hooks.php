<?php
/**
 * Template hooks
 * List of all template hooks used on the theme.
 *
 * @package 	Crescent
 * @since 		1.0
 */

/**
 * General.
 *
 * @see crescent_mobile_navigation()
 * @see crescent_page_title()
 * @see crescent_get_sidebar()
 */
add_action( 'crescent_before_site', 'crescent_mobile_navigation', 10 );
add_action( 'crescent_before_site', 'crescent_mobile_navigation_mask', 15 );
add_action( 'crescent_before_content', 'crescent_page_title', 10 );
add_action( 'crescent_primary_top', 'crescent_content_area_container_start', 0 );
add_action( 'crescent_primary_top', 'crescent_main_wrapper_start', 5 );
add_action( 'crescent_sidebar', 'crescent_main_wrapper_close', 0 );
add_action( 'crescent_sidebar', 'crescent_sidebar_wrapper_start', 5 );
add_action( 'crescent_sidebar', 'crescent_get_sidebar', 10 );
add_action( 'crescent_primary_bottom', 'crescent_sidebar_wrapper_close', 0 );
add_action( 'crescent_primary_bottom', 'crescent_content_area_container_close', 50 );

/**
 * Header.
 *
 * @see crescent_skip_links()
 * @see crescent_site_branding()
 * @see crescent_primary_navigation()
 * @see crescent_mobile_navigation_activator()
 */
add_action( 'crescent_header', 'crescent_skip_links', 0 );
add_action( 'crescent_header', 'crescent_header_area_wrapper_start', 5 );
add_action( 'crescent_header', 'crescent_header_container_start', 10 );
add_action( 'crescent_header', 'crescent_site_branding', 15 );
add_action( 'crescent_header', 'crescent_primary_navigation_wrapper_start', 20 );
add_action( 'crescent_header', 'crescent_primary_navigation', 25 );
add_action( 'crescent_header', 'crescent_mobile_navigation_activator', 30 );
add_action( 'crescent_header', 'crescent_primary_navigation_wrapper_close', 35 );
add_action( 'crescent_header', 'crescent_header_container_close', 40 );
add_action( 'crescent_header', 'crescent_header_area_wrapper_close', 45 );
add_action( 'crescent_header', 'crescent_fixed_header_height_placeholder', 50 );

/**
 * Footer.
 *
 * @see crescent_footer_widget_area()
 * @see crescent_footer_copyright()
 */
add_action( 'crescent_footer', 'crescent_footer_widget_area', 10 );
add_action( 'crescent_footer', 'crescent_footer_copyright', 15 );

/**
 * Homepage.
 *
 */

/**
 * Posts.
 *
 * @see crescent_post_header()
 * @see crescent_post_thumbnail()
 * @see crescent_post_content()
 * @see crescent_post_footer()
 * @see crescent_pagination()
 */
add_action( 'crescent_loop_before', 'crescent_posts_loop_wrapper_start', 10 );
add_action( 'crescent_loop_post', 'crescent_post_header', 10 );
add_action( 'crescent_post_content_before', 'crescent_post_thumbnail', 10 );
add_action( 'crescent_loop_post', 'crescent_post_content', 15 );
add_action( 'crescent_loop_post', 'crescent_post_footer', 20 );
add_action( 'crescent_loop_after', 'crescent_posts_loop_wrapper_close', 10 );
add_action( 'crescent_loop_after', 'crescent_pagination', 15 );
add_action( 'crescent_single_post', 'crescent_post_header', 10 );
add_action( 'crescent_single_post', 'crescent_post_content', 15 );
add_action( 'crescent_single_post', 'crescent_post_footer', 20 );
add_action( 'crescent_single_post_bottom', 'crescent_post_nav', 10 );
add_action( 'crescent_single_post_bottom', 'crescent_render_comments', 15 );

/**
 * Pages.
 *
 * @see crescent_page_content()
 * @see crescent_render_comments()
 */
add_action( 'crescent_page', 'crescent_page_content', 10 );
add_action( 'crescent_page_after', 'crescent_render_comments', 10 );

/**
 * Comment Area.
 *
 * @see crescent_render_comments_list()
 * @see crescent_render_comment_form()
 */
add_action( 'crescent_before_comment_area', 'crescent_comment_area_wrapper_start', 10 );
add_action( 'crescent_comment_area', 'crescent_render_comments_list', 10 );
add_action( 'crescent_comment_area', 'crescent_render_comment_form', 20 );
add_action( 'crescent_after_comment_area', 'crescent_comment_area_wrapper_close', 50 );
