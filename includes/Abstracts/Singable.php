<?php

namespace My_Theme\Abstracts;

use const My_Theme\TEXTDOMAIN;

defined( 'ABSPATH' ) || exit;

trait Singable {

	private static $has_instance = false;

	private function check_singable_instance() {
		if ( self::$has_instance ) {
			wp_die( sprintf( __( 'Class <code>%s</code> must have one instance.', TEXTDOMAIN ), static::class ) ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		self::$has_instance = true;
	}
}
