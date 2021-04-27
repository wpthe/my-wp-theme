<?php

namespace My_Theme\Customizer;

use My_Theme\Abstracts;

defined( 'ABSPATH' ) || exit;

abstract class Abstract_Section {

	use Abstracts\Singable;

	protected static $section_key = '';

	protected static $defaults = array();

	protected static function apply_prefix( string $key ): string {
		return static::$section_key . '_' . $key;
	}

	public static function get_setting( string $key ) {
		$setting = get_theme_mod( static::apply_prefix( $key ) );

		return ( false !== $setting && '' !== $setting ) ? $setting : static::$defaults[ $key ];
	}
}
