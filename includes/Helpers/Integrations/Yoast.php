<?php

namespace My_Theme\Helpers\Integrations;

defined( 'ABSPATH' ) || exit;

class Yoast {

	public static function get_breadcrumbs( string $before, string $after ) {
		if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
			yoast_breadcrumb( $before, $after );
		}
	}

	public static function get_primary_term_id( int $post = 0, string $taxonomy = 'category' ) {
		if ( ! $post ) {
			$post = get_the_ID();
		}

		$terms = get_the_terms( $post, $taxonomy );
		if ( $terms ) {
			if ( class_exists( 'WPSEO_Primary_Term' ) ) {
				$primary_term = new \WPSEO_Primary_Term( $taxonomy, $post );
				$primary_term = $primary_term->get_primary_term();
				$term         = get_term( $primary_term );

				if ( is_wp_error( $term ) ) {
					return $terms[0]->term_id;
				} else {
					return $term->term_id;
				}
			} else {
				return $terms[0]->term_id;
			}
		}
		return false;
	}
}
