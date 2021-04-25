<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

const TEXTDOMAIN = 'my_theme';

$composer = get_parent_theme_file_path( 'vendor/autoload.php' );

if ( ! file_exists( $composer ) ) {
	wp_die(
		__( 'You must run <code>composer install</code> from the theme directory.', TEXTDOMAIN ), // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_html__( 'Autoloader not found', TEXTDOMAIN )
	);
}

require_once $composer;

new Setup();
