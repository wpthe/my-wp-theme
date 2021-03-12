<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Posts {

	public function __construct() {
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		add_filter( 'widget_text', array( $this, 'widget_text' ) );
	}

	public function excerpt_more(): string {
		return '...';
	}

	public function widget_text( $content ): string {
		return '<div class="my-content my-content_sm">' . $content . '</div>';
	}

	public static function get_home_url() {
		return apply_filters( 'my_theme_home_url', home_url( '/' ) );
	}

	public static function get_title(): string {
		if ( is_home() ) {
			$home = get_option( 'page_for_posts', true );
			if ( $home ) {
				return get_the_title( $home );
			}

			return '';

		} elseif ( is_archive() ) {
			return single_cat_title( '', false );

		} elseif ( is_search() ) {
			/* translators: %s: Search query text */
			return sprintf( esc_html__( 'Search Results for "%s"', 'my_theme' ), get_search_query() );

		} elseif ( is_404() ) {
			return esc_html__( 'Not Found', 'my_theme' );
		}

		return get_the_title();
	}
}
