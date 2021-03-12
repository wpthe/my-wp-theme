<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Templates {

	public static function is( string $slug ): bool {
		return is_page_template( 'templates/' . $slug . '.php' );
	}

	public static function get_part( string $slug = '', string $name = '', string $postfix = '', array $args = array() ) {
		$slug    = $slug && $name ? $slug . '-' : $slug;
		$postfix = $postfix ? '-' . $postfix : '';

		get_template_part( 'template-parts/' . $slug . $name . $postfix, null, $args );
	}

	public static function get_card( string $type = 'post', string $postfix = '', array $args = array() ) {
		self::get_part( $type, 'card', $postfix, $args );
	}

	public static function get_content( string $type = 'post', string $postfix = '', array $args = array() ) {
		self::get_part( $type, 'content', $postfix, $args );
	}
}
