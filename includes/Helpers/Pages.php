<?php

namespace My_Theme\Helpers;

use const My_Theme\TEXTDOMAIN;

defined( 'ABSPATH' ) || exit;

class Pages {

	public static function get_home_url(): string {
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
			return sprintf( esc_html__( 'Search Results for "%s"', TEXTDOMAIN ), get_search_query() );

		} elseif ( is_404() ) {
			return esc_html__( 'Not Found', TEXTDOMAIN );
		}

		return get_the_title();
	}

	public static function is_template( string $slug ): bool {
		return is_page_template( 'templates/' . $slug . '.php' );
	}

	public static function get_template_part( string $slug = '', string $name = '', string $addition = '', array $args = array() ): void {
		$slug     = $slug && $name ? $slug . '-' : $slug;
		$addition = $addition ? '-' . $addition : '';

		get_template_part( 'template-parts/' . $slug . $name . $addition, null, $args );
	}

	public static function get_card_template( string $type = 'post', string $addition = '', array $args = array() ): void {
		self::get_template_part( $type, 'card', $addition, $args );
	}

	public static function get_content_template( string $type = 'post', string $addition = '', array $args = array() ): void {
		self::get_template_part( $type, 'content', $addition, $args );
	}
}
