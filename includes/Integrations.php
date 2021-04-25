<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Integrations {

	use Abstracts\Singable;

	public function __construct() {
		$this->check_singable_instance();

		new Integrations\ACF();
		new Integrations\Polylang();
		new Integrations\WC();
	}
}
