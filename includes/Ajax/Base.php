<?php

namespace My_Theme\Ajax;

abstract class Base {

	private $action;

	public function __construct( string $action ) {
		$this->action = $action;

		add_action( "wp_ajax_${action}", array( $this, 'callback' ) );
		add_action( "wp_ajax_nopriv_${action}", array( $this, 'callback' ) );
	}

	public function callback() {
	}
}
