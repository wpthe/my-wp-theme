<?php

namespace My_Theme\Posts;

use My_Theme\Abstracts;

defined( 'ABSPATH' ) || exit;

class Card {

	use Abstracts\Singable;

	public function __construct() {
		$this->die_if_has_instance();

		add_filter( 'excerpt_more', array( $this, 'get_excerpt_more' ) );
	}

	public function get_excerpt_more(): string {
		return '...';
	}
}
