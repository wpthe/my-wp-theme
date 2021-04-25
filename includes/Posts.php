<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Posts {

	use Abstracts\Singable;

	public function __construct() {
		$this->check_singable_instance();

		new Posts\Card();
		new Posts\Ajax_Load_Cards();
	}
}
