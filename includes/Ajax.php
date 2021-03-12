<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Ajax {

	public function __construct() {
		new Ajax\Load_Cards();
	}
}
