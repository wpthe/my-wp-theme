<?php

namespace My_Theme\Integrations;

use My_Theme\Abstracts;

defined( 'ABSPATH' ) || exit;

class WC {

	use Abstracts\Singable;

	public function __construct() {
		$this->check_singable_instance();

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );

		if ( class_exists( 'woocommerce' ) ) {
			add_filter( 'use_block_editor_for_post_type', array( $this, 'enable_blocks' ), 10, 2 );
			add_filter( 'woocommerce_taxonomy_args_product_cat', array( $this, 'enable_rest' ) );
			add_filter( 'woocommerce_taxonomy_args_product_tag', array( $this, 'enable_rest' ) );
			add_filter( 'woocommerce_register_post_type_product', array( $this, 'enable_rest' ) );
		}
	}

	public function after_setup_theme(): void {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	public function enable_blocks( bool $can_edit, string $post_type ): bool {
		if ( 'product' === $post_type ) {
			$can_edit = true;
		}

		return $can_edit;
	}

	public function enable_rest( array $args ): array {
		$args['show_in_rest'] = true;

		return $args;
	}
}
