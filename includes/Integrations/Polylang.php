<?php

namespace My_Theme\Integrations;

use My_Theme\Abstracts;

defined( 'ABSPATH' ) || exit;

class Polylang {

	use Abstracts\Singable;

	public function __construct() {
		$this->check_singable_instance();

		if ( function_exists( 'pll_the_languages' ) ) {
			add_filter( 'my_theme_home_url', array( $this, 'home_url' ) );
		}
	}

	public function home_url(): string {
		return pll_home_url();
	}
}
