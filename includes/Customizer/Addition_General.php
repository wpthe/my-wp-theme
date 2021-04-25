<?php

namespace My_Theme\Customizer;

use My_Theme\Abstracts;
use const My_Theme\TEXTDOMAIN;

defined( 'ABSPATH' ) || exit;

class Addition_General extends Abstracts\Customizer\Section {

	use Abstracts\Singable;

	protected static $section_key = 'my_settings_general';

	protected static $defaults = array(
		'clean_head'            => false,
		'remove_jquery_migrate' => false,
		'hide_acf_menu'         => false,
	);

	public function __construct( \WP_Customize_Manager $wp_customize ) {
		$this->check_singable_instance();

		$wp_customize->add_section(
			self::$section_key,
			array(
				'title' => esc_html__( 'General', TEXTDOMAIN ),
				'panel' => 'my_settings',
			)
		);

		$setting_key = 'clean_head';
		$wp_customize->add_setting(
			self::apply_prefix( $setting_key ),
			array(
				'default'   => self::$defaults[ $setting_key ],
				'transport' => false,
			)
		);
		$wp_customize->add_control(
			self::apply_prefix( $setting_key ),
			array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Clear the <head> from potentially unnecessary tags on the client side.', TEXTDOMAIN ),
				'section' => self::$section_key,
			)
		);

		$setting_key = 'remove_jquery_migrate';
		$wp_customize->add_setting(
			self::apply_prefix( $setting_key ),
			array(
				'default'   => self::$defaults[ $setting_key ],
				'transport' => false,
			)
		);
		$wp_customize->add_control(
			self::apply_prefix( $setting_key ),
			array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Disable jQuery Migrate on the client side.', TEXTDOMAIN ),
				'section' => self::$section_key,
			)
		);

		if ( class_exists( 'ACF' ) ) {
			$setting_key = 'hide_acf_menu';
			$wp_customize->add_setting(
				self::apply_prefix( $setting_key ),
				array(
					'default'   => self::$defaults[ $setting_key ],
					'transport' => false,
				)
			);
			$wp_customize->add_control(
				self::apply_prefix( $setting_key ),
				array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Hide the Advanced Custom Fields menu item on the admin panel.', TEXTDOMAIN ),
					'section' => self::$section_key,
				)
			);
		}
	}
}
