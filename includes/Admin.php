<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Admin {

	use Abstracts\Singable;

	public function __construct() {
		$this->check_singable_instance();

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	public function enqueue_assets(): void {
		Helpers\General::enqueue_style( 'my_theme_admin', 'admin' );
		Helpers\General::enqueue_script( 'my_theme_admin', 'admin' );
	}
}
