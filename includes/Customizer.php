<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Customizer {

	use Abstracts\Singable;

	public function __construct() {
		$this->die_if_has_instance();

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_enqueue_assets' ) );
		add_action( 'customize_register', array( $this, 'register' ) );
	}

	public function controls_enqueue_assets() {
		Helpers\General::enqueue_style( 'my_theme_customizer_controls', 'customizer-controls', array( 'wp-color-picker' ) );
		Helpers\General::enqueue_script( 'my_theme_customizer_controls', 'customizer-controls', array( 'jquery', 'customize-controls', 'wp-color-picker' ) );
	}

	public function register( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_panel(
			'my_settings',
			array(
				'title'    => esc_html__( 'My Theme Settings', TEXTDOMAIN ),
				'priority' => 121,
			)
		);
		new Customizer\Addition_General( $wp_customize );
		new Customizer\Addition_Code_Fields( $wp_customize );
	}
}
