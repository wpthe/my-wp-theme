<?php

namespace My_Theme\Posts;

use My_Theme\Abstracts;
use My_Theme\Helpers;

defined( 'ABSPATH' ) || exit;

class Ajax_Load_Cards extends Abstracts\Ajax_Action {

	use Abstracts\Singable;

	private $post_type;

	public function __construct( string $post_type = 'post' ) {
		$this->die_if_has_instance();

		parent::__construct( 'my_load_cards' );

		$this->post_type = $post_type;
	}

	public function callback(): void {
		// TODO: rewrite. Reason: too much denial of standards.
		// @codingStandardsIgnoreStart
		// WordPress.PHP.DiscouragedPHPFunctions.serialize_unserialize
		// WordPress.Security.NonceVerification.Missing
		// WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		// WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$args                = isset( $_POST['query_vars'] ) ? unserialize( stripslashes( $_POST['query_vars'] ) ) : '';
		$args['paged']       = isset( $_POST['page'] ) ? $_POST['page'] + 1 : '';
		$args['post_type']   = $this->post_type;
		$args['post_status'] = 'publish';

		// It is usually better to use WP_Query but not here. Can be corrected if this statement is not relevant.
		query_posts( $args ); // @codingStandardsIgnoreLine WordPress.WP.DiscouragedFunctions.query_posts_query_posts

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				Helpers\Pages::get_card_template( $this->post_type, '', array( 'className' => $_POST['card_class'] ) );
			}
		}
		die();
		// @codingStandardsIgnoreEnd
	}

	public static function get_attrs( \WP_Query $query, $card_class ): string {
		$card_class   = isset( $card_class ) ? ( 'data-my-card-class="' . $card_class . '" ' ) : '';
		$current_page = 'data-my-current-page="' . ( $query->get( 'paged' ) ? $query->get( 'paged' ) : 1 ) . '" ';
		$max_pages    = 'data-my-max-pages="' . $query->max_num_pages . '" ';
		$query_vars   = 'data-my-query-vars="' . esc_attr( serialize( $query->query_vars ) ) . '"'; // @codingStandardsIgnoreLine WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize

		return $card_class . $current_page . $max_pages . $query_vars;
	}
}
