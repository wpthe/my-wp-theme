<?php

namespace My_Theme\Integrations;

use My_Theme\Abstracts;
use My_Theme\Customizer;
use const My_Theme\TEXTDOMAIN;

defined( 'ABSPATH' ) || exit;

class ACF {

	use Abstracts\Singable;

	public function __construct() {
		$this->die_if_has_instance();

		if ( class_exists( 'ACF' ) && Customizer\Addition_General::get_setting( 'hide_acf_menu' ) ) {
			add_filter( 'acf/settings/show_admin', '__return_false' );
		}

		if ( function_exists( 'acf_register_block_type' ) && function_exists( 'register_block_type' ) ) {
			add_action( 'acf/init', array( $this, 'autoload_blocks' ) );
		}
	}

	public function autoload_blocks() {
		$path = 'acf-blocks';
		$dir  = get_theme_file_path( $path );

		if ( file_exists( $dir ) ) {
			$dir_iterator = new \DirectoryIterator( $dir );

			foreach ( $dir_iterator as $fileinfo ) {
				if ( ! $fileinfo->isDot() ) {
					$slug = str_replace( '.php', '', $fileinfo->getFilename() );

					$file_headers = get_file_data(
						get_theme_file_path( "${path}/${slug}.php" ),
						array(
							'name'        => 'Block Name',
							'description' => 'Block Description',
							'category'    => 'Block Category',
							'icon'        => 'Block Icon',
							'keywords'    => 'Block Keywords',
							'post_types'  => 'Block Post Types',
						)
					);

					acf_register_block_type(
						array(
							'name'            => $slug,
							'title'           => esc_html__( $file_headers['name'], TEXTDOMAIN ), // @codingStandardsIgnoreLine phpWordPress.WP.I18n.NonSingularStringLiteralText
							'description'     => esc_html__( $file_headers['description'], TEXTDOMAIN ), // @codingStandardsIgnoreLine phpWordPress.WP.I18n.NonSingularStringLiteralText
							'category'        => $file_headers['category'],
							'icon'            => $file_headers['icon'],
							'keywords'        => explode( ', ', $file_headers['keywords'] ),
							'post_types'      => explode( ', ', trim( $file_headers['post_types'] ) ),
							'mode'            => 'edit',
							'supports'        => array(
								'mode'  => false,
								'align' => false,
							),
							'render_callback' => function ( array &$args ) use ( $path, $slug ) {
								require_once get_theme_file_path( "${path}/${slug}.php" );
							},
						)
					);
				}
			}
		}
	}
}
