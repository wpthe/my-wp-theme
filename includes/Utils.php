<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Utils {

	public static function enqueue_style( string $handle, string $slug, array $deps = array() ) {
		wp_enqueue_style( $handle, get_parent_theme_file_uri( 'assets/styles/' . $slug . '.min.css' ), $deps, filemtime( get_parent_theme_file_path( 'assets/styles/' . $slug . '.min.css' ) ) );
	}

	public static function enqueue_script( string $handle, string $slug, array $deps = array(), bool $in_footer = true ) {
		wp_enqueue_script( $handle, get_parent_theme_file_uri( 'assets/scripts/' . $slug . '.min.js' ), $deps, filemtime( get_parent_theme_file_path( 'assets/scripts/' . $slug . '.min.js' ) ), $in_footer );
	}

	public static function tel_to_url( string $tel ): string {
		return 'tel:' . str_replace( array( '-', ' ', '(', ')' ), '', $tel );
	}
}
