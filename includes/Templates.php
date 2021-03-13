<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Templates {

	public static function is( string $slug ): bool {
		return is_page_template( 'templates/' . $slug . '.php' );
	}

	public static function get_part( string $slug = '', string $name = '', string $addition = '', array $args = array() ) {
		$slug     = $slug && $name ? $slug . '-' : $slug;
		$addition = $addition ? '-' . $addition : '';

		get_template_part( 'template-parts/' . $slug . $name . $addition, null, $args );
	}

	public static function get_card( string $type = 'post', string $addition = '', array $args = array() ) {
		self::get_part( $type, 'card', $addition, $args );
	}

	public static function get_content( string $type = 'post', string $addition = '', array $args = array() ) {
		self::get_part( $type, 'content', $addition, $args );
	}
}
