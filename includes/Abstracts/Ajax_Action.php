<?php

namespace My_Theme\Abstracts;

abstract class Ajax_Action {

	use Singable;

	private $action;

	public function __construct( string $action ) {
		$this->action = $action;

		add_action( "wp_ajax_${action}", array( $this, 'callback' ) );
		add_action( "wp_ajax_nopriv_${action}", array( $this, 'callback' ) );
	}

	abstract public function callback(): void;
}
