<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

$composer = get_parent_theme_file_path( 'vendor/autoload.php' );
if ( ! file_exists( $composer ) ) {
	wp_die(
		__( 'You must run <code>composer install</code> from the theme directory.', 'my_theme' ), // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_html__( 'Autoloader not found', 'my_theme' )
	);
}
require_once $composer;

if ( ! class_exists( 'My_Core\Setup' ) && ! is_admin() ) {
	wp_die(
		esc_html__( 'Please, check the warning notification on the admin panel.', 'my_theme' ),
		esc_html__( 'Setup is incomplete', 'my_theme' )
	);
}

new Setup();
