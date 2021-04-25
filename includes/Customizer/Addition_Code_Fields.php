<?php

namespace My_Theme\Customizer;

use My_Theme\Abstracts;
use const My_Theme\TEXTDOMAIN;

defined( 'ABSPATH' ) || exit;

class Addition_Code_Fields extends Abstracts\Customizer\Section {

	use Abstracts\Singable;

	protected static $section_key = 'my_code_fields';

	protected static $defaults = array(
		'head' => '',
		'body' => '',
	);

	public function __construct( \WP_Customize_Manager $wp_customize ) {
		$this->check_singable_instance();

		$wp_customize->add_section(
			self::$section_key,
			array(
				'title' => esc_html__( 'Code Fields', TEXTDOMAIN ),
				'panel' => 'my_settings',
			)
		);

		$setting_key = 'head';
		$wp_customize->add_setting(
			self::apply_prefix( $setting_key ),
			array(
				'default'   => self::$defaults[ $setting_key ],
				'transport' => false,
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Code_Editor_Control(
				$wp_customize,
				self::apply_prefix( $setting_key ),
				array(
					'label'           => __( 'Code entry area before the closing </head> tag', TEXTDOMAIN ),
					'description'     => esc_html__( 'Only accepts JavaScript code wrapped with <script/> tags and HTML markup that is valid inside the </head> tag.', TEXTDOMAIN ),
					'editor_settings' => array(
						'codemirror' => array(
							'mode' => 'htmlmixed',
						),
					),
					'section'         => self::$section_key,
				)
			)
		);

		$setting_key = 'body';
		$wp_customize->add_setting(
			self::apply_prefix( $setting_key ),
			array(
				'default'   => self::$defaults[ $setting_key ],
				'transport' => false,
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Code_Editor_Control(
				$wp_customize,
				self::apply_prefix( $setting_key ),
				array(
					'label'           => __( 'Code entry area before the closing </body> tag', TEXTDOMAIN ),
					'description'     => esc_html__( 'Only accepts JavaScript code, wrapped with <script/> tags and valid HTML markup inside the </body> tag.', TEXTDOMAIN ),
					'editor_settings' => array(
						'codemirror' => array(
							'mode' => 'htmlmixed',
						),
					),
					'section'         => self::$section_key,
				)
			)
		);
	}
}
