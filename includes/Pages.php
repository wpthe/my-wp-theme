<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

class Pages {

	use Abstracts\Singable;

	public function __construct() {
		$this->die_if_has_instance();

		add_filter( 'widget_text', array( $this, 'get_widget_text' ) );
	}

	public function get_widget_text( string $content ): string {
		return '<div class="my-content my-content_sm">' . $content . '</div>';
	}
}
